<?php
ob_start();
require_once  '..\config\Database.php';
require_once '..\app\models\mainleveeModel.php';


class mainleveeController
{
    private $model;
    public function __construct()
    {
        $database = new Database();
        $db = $database->connect();
        $this->model = new mainleveeModel($db);
    }
    public function mainlevee()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $success = 0;
            $page = $_POST['mainlevee'];
            $numg = trim($_POST['numg']) ?? '';
            $types = $this->model->selectTypeMainlevee();

            if ($page === 'show') {

                $mainlevee = $this->model->selectMainlevee($numg);
                $documentMl = $this->model->selectDocumentMainlevee($numg);
                include '../app/views/mainlevee/voiremainlevee.php';
            } elseif ($page === 'ajouterpage') {
                include '../app/views/mainlevee/insertmainlevee.php';
            } elseif ($page === 'ajouter') {
                $numml = trim($_POST['numml'] ?? '');
                $numg = trim($_POST['numg']) ?? '';
                $typeml = trim($_POST['typeml'] ?? 0);
                $dateml = trim($_POST['dateml'] ?? 0);

                $montant = trim($_POST['montant'] ?? 0);
                $obs = trim($_POST['obs'] ?? '');
                $file = $_FILES["docml"] ?? '';
                $error = [];
                if (empty($numml)) {
                    $error['numml'] = "veuillez remplir ce champ  .";
                }
                if (empty($typeml)) {
                    $error['typeml'] = "veuillez selectioner ce champ .";
                }
                if (empty($dateml)) {
                    $error['dateml'] = "veuillez choisire une date .";
                }

                if (empty($montant)) {
                    $error['montant'] = "veuillez remplir ce champ  .";
                }
                if (count($this->model->checkNumeroMainlevee($numml)) > 0) {
                    $error['numam'] = "CE NUMERO EXISTE DEJA !";
                }
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
                    }
                } else {
                    $error['userfile'] = 'veuillez choisire un fishier';
                }
                if (empty($error)) {
                    $this->model->inserDocumentMainlevee($numml, $fileName, $path);
                    $this->model->insertMainlevee($numml, $typeml, $numg, $dateml, $montant, $obs);
                    ob_end_clean();

                    $mainlevee = $this->model->selectMainlevee($numg);
                    $documentMl = $this->model->selectDocumentMainlevee($numg);

                    include '../app/views/mainlevee/voiremainlevee.php';
                    exit();
                    $page = 'show';
                }

                include '../app/views/mainlevee/insertmainlevee.php';
            } elseif ($page === 'sup') {
                $id = $_POST['id'];
                $this->model->deleteDocumentMainlevee($id);
                $mainlevee = $this->model->selectMainlevee($numg);
                $documentMl = $this->model->selectDocumentMainlevee($numg);
                include '../app/views/mainlevee/voiremainlevee.php';
            } elseif ($page === 'ajouterdocument') {

                $numml = trim($_POST['numml'] ?? '');
                $numg = trim($_POST['numg']) ?? '';
                $typeml = trim($_POST['typeml'] ?? 0);
                $dateml = trim($_POST['dateml'] ?? 0);

                $montant = trim($_POST['montant'] ?? 0);
                $obs = trim($_POST['obs'] ?? '');
                $file = $_FILES["docml"] ?? '';
                $error = [];
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
                    }
                } else {
                    $error['userfile'] = 'veuillez choisire un fishier';
                }
                if (empty($error)) {
                    $this->model->inserDocumentMainlevee($numml, $fileName, $path);

                    ob_end_clean();

                    $mainlevee = $this->model->selectMainlevee($numg);
                    $documentMl = $this->model->selectDocumentMainlevee($numg);

                    include '../app/views/mainlevee/voiremainlevee.php';
                    exit();
                }

                $mainlevee = $this->model->selectMainlevee($numg);
                $documentMl = $this->model->selectDocumentMainlevee($numg);
                include '../app/views/mainlevee/voiremainlevee.php';
            }
        }
    }
}
