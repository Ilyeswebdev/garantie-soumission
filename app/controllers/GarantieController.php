<?php
ob_start();
require_once  '..\config\Database.php';
require_once '..\app\models\GarantieModel.php';

class GarantieController
{
    private $model;
    public function __construct()
    {

        $database = new Database();
        $db = $database->connect();
        $this->model = new GarantieModel($db);
    }
    public function showGarantiePage()
    {
        $garanties = $this->model->selectGarantie();
        // $documents = $this->model->selectDocumentGarantie();
        if (isset($_POST['numg'])) {
            $documents = $this->model->selectDocumentGarantie($_POST['numg'] ?? '');
        }
        include '../app/views/Garantie/ShowGarantie.php';
    }

    public function insertGarantie()
    {
        $monnaies = $this->model->selectMonnaie();
        $validites = $this->model->selectValidite();
        $soumissioners = $this->model->selectSoumissioner();
        // $agences = $this->model->selectAgence();
        $banques = $this->model->selectBanque();
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $numGarantie = htmlspecialchars(trim($_POST['num-garentie'])) ?? '';
            $AO = htmlspecialchars(trim($_POST['ao'])) ?? '';
            $montant = htmlspecialchars(trim($_POST['montant'])) ?? '';
            $monnaiesId = htmlspecialchars(trim($_POST['monnaie'])) ?? 0;
            $dateDepo = htmlspecialchars(trim($_POST['date-depo'])) ?? 0;
            $soumissioner = htmlspecialchars(trim($_POST['soumissioner'])) ?? '';
            $agence = htmlspecialchars(trim($_POST['agence'])) ?? '';
            if (isset($_POST['validite'])) {
                $validite = htmlspecialchars(trim($_POST['validite'])) ?? '';
                $dateDepoToDate =  new DateTime($dateDepo);
                $dateEchu = $dateDepoToDate->modify('+' . $validite . 'days')->format('y-m-d');
            }
            $error = [];
            $file = $_FILES["userfile"] ?? '';
            if (!empty($file)) {
                $tmpPath = $file['tmp_name'];
                $fileName = basename($file['name']);
                $path = 'documents/' . $fileName;
                $type = $file['type'];
                $size = $file['size'];
                $filParts = explode('.', $fileName);
                $fileExtention = strtolower(end($filParts));
                $allowedTypes = ['pdf']; //'pdf', 'png', 'jpeg', 'jpg'
                if (!in_array($fileExtention, $allowedTypes)) {
                    $error['userfile'] = 'Type de fichier invalide. Seuls les fichiers  PDF sont autorisés.';
                } elseif ($size > 5 * 1024 * 1024) {
                    $error['userfile'] = 'La taille du fichier dépasse 5 Mo..';
                } else {
                    move_uploaded_file($tmpPath,  $path);
                    $this->model->insertDocumentGarantie($numGarantie, $fileName, $path);
                }
            } else {
                $error['userfile'] = 'veuillez choisire un fishier';
            }
            if (count($this->model->checkNumeroGarantie($numGarantie)) > 0) {
                $error['num-garentie'] = "CE NUMERO EXISTE DEJA !";
            }
            if (empty($numGarantie)) {
                $error['num-garentie'] = "veuillez remplir ce champ .";
            }

            if (empty($AO)) {
                $error['ao'] = "veuillez remplir ce champ .";
            }
            if (empty($montant)) {
                $error['montant'] = "veuillez remplir ce champ .";
            }
            if ($monnaiesId <= 0) {
                $error['monnaiesId'] = "veuillez choisire une  monnaie .";
            }
            $format = 'Y-m-d';
            $d = DateTime::createFromFormat($format, $dateDepo);
            if ($d && $d->format($format) === $dateDepo) {
                $year = explode("-", $dateDepo)[0]; // Get the year part


                if (ctype_digit($year) && strlen($year) === 4 && $year < 2100) {
                } else {
                    $error['datedepo'] = "date incorrect.";
                }
            } else {
                $error['datedepo'] = "date incorrect.";
            }
            if (empty($validite)) {
                $error['validite'] = 'veuillez choisire une validite ';
            }
            if ($soumissioner <= 0) {
                $error['soumissioner'] = 'veuillez choisire un soumissioner ';
            }
            if ($agence <= 0) {
                $error['agence'] = 'veuillez choisire une agence ';
            }


            if (empty($error)) {

                if ($this->model->insertGarantie($numGarantie, $monnaiesId, $agence, $soumissioner, $validite, $AO, $montant, $dateDepo, $dateEchu)) {
                    ob_end_clean();
                    header("Location: index.php?page=garantie&code=$numGarantie&ajout");
                    exit();
                }
            }
        }
        include '../app/views/Garantie/insertGarantie.php';
    }
    public function ajouterDocumentGarantie()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $numGarantie = htmlspecialchars(trim($_POST['numg'])) ?? '';
            $error = [];
            $file = $_FILES["docgarantie"] ?? '';
            if (!empty($file)) {
                $tmpPath = $file['tmp_name'];
                $fileName = basename($file['name']);
                $path = 'documents/' . $fileName;
                $type = $file['type'];
                $size = $file['size'];
                $filParts = explode('.', $fileName);
                $fileExtention = strtolower(end($filParts));
                $allowedTypes = ['pdf', 'png', 'jpeg', 'jpg']; //'pdf', 'png', 'jpeg', 'jpg'
                if (!in_array($fileExtention, $allowedTypes)) {
                    $error['userfile'] = 'Type de fichier invalide. Seuls les fichiers  PDF sont autorisés.';
                } elseif ($size > 5 * 1024 * 1024) {
                    $error['userfile'] = 'La taille du fichier dépasse 5 Mo..';
                } else {
                    move_uploaded_file($tmpPath,  $path);
                    $this->model->insertDocumentGarantie($numGarantie, $fileName, $path);
                    header("Location: index.php?page=garantie");
                    exit();
                }
            } else {
                $error['userfile'] = 'veuillez choisire un fishier';
            }
        }
    }


    public function deleteGarantie()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id = $_POST['supp-id'];
            $this->model->deleteGarantie($id);
            header("Location: index.php?page=garantie");
            exit();
        }
    }
    public function deleteDocumentGarantie()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id = $_POST['supp-doc'];
            $this->model->deleteDocumentGarantie($id);
            header("Location: index.php?page=garantie");
            exit();
        }
    }
}
ob_end_flush();
