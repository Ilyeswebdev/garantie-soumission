<?php
ob_start();
require_once  '..\config\Database.php';
require_once '..\app\models\authentificationModel.php';

class authentificationController
{
    private $model;
    public function __construct()
    {

        $database = new Database();
        $db = $database->connect();
        $this->model = new authentificationModel($db);
    }

    public function showAuthentification()
    {
        // $utilisateurs = $this->model->selectUtilisateurs();
        $numg = trim($_POST['numg']) ?? '';
        $authentification = $this->model->selectAuthentification($numg);
        $documentauth = $this->model->selectDocumentAuthentification($numg);
        include '../app/views/authentification/voireAuthentification.php';
    }

    public function ajouterauthentification()
    {


        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $numauth = trim($_POST['numauth'] ?? '');
            $numg = trim($_POST['numg']) ?? '';
            $dateauth = trim($_POST['dateauth'] ?? 0);
            $datedepo = trim($_POST['datedepo'] ?? 0);
            $file = $_FILES["docauth"] ?? '';
            $error = [];
            if (empty($numauth)) {
                $error['numauth'] = "veuillez remplir ce champ  .";
            }
            if (empty($dateauth)) {
                $error['dateauth'] = "veuillez remplir ce champ .";
            }
            if (empty($datedepo)) {
                $error['datedepo'] = "veuillez remplir ce champ .";
            }
            if (count($this->model->checkNumeroAuthentification($numauth)) > 0) {
                $error['numauth'] = "CE NUMERO EXISTE DEJA !";
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
                $this->model->inserDocumentAuthentification($numauth, $fileName, $path);
                if ($this->model->insertauthentification($numauth, $numg, $dateauth, $datedepo)) {
                    ob_end_clean();
                    $authentification = $this->model->selectAuthentification($numg);
                    $documentauth = $this->model->selectDocumentAuthentification($numg);
                    include '../app/views/authentification/voireAuthentification.php';

                    exit();
                }
            }
        }
        include '../app/views/authentification/insertauthentification.php';
    }
    public function ajouterDocumentAuthentification()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $numauth = htmlspecialchars(trim($_POST['numauth'] ?? ''));
            $numg = trim($_POST['numg']) ?? '';
            $dateauth =  trim($_POST['dateauth'] ?? 0);
            $datedepo = trim($_POST['datedepo'] ?? 0);
            $file = $_FILES["docauth"] ?? '';
            $error = [];


            if (isset($_POST['ajouter'])) {
                if (!empty($file)) {
                    $tmpPath = $file['tmp_name'];
                    $fileName = basename($file['name']);
                    $path = 'documents/' . $fileName;
                    $type = $file['type'];
                    $size = $file['size'];
                    $filParts = explode('.', $fileName);
                    $fileExtention = strtolower(end($filParts));
                    $allowedTypes = ['pdf', 'png', 'jpeg', 'jpg'];
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
                    $this->model->inserDocumentAuthentification($numauth, $fileName, $path);
                }
            } elseif (isset($_POST['sup'])) {
                $id = $_POST['sup'];
                $this->model->deleteDocumentauth($id);
            }
            $authentification = $this->model->selectAuthentification($numg);
            $documentauth = $this->model->selectDocumentAuthentification($numg);

            include '../app/views/authentification/voireAuthentification.php';
        }
    }
}
ob_end_flush();
