<?php
ob_start();
require_once  '..\config\Database.php';
require_once '..\app\models\amendmentModel.php';

class amendmentController
{
    private $model;
    public function __construct()
    {

        $database = new Database();
        $db = $database->connect();
        $this->model = new amendmentModel($db);
    }

    public function showAmendment()
    {


        if (isset($_POST['ajouterdocument'])) {
            $file = $_FILES["docam"] ?? '';
            if (!empty($file)) {
                $tmpPath = $file['tmp_name'];
                $numam = trim($_POST['numam'] ?? '');
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
                $this->model->inserDocumentAmendment($numam, $fileName, $path);
            }
        } elseif (isset($_POST['suprimeramendment'])) {
            $id = $_POST['supp-code'];
            $this->model->deleteAmendment($id);
        }
        $numg = trim($_POST['numg']) ?? '';
        $amendements = $this->model->selectAmendment($numg);
        $documentsam = $this->model->selectDocumentAmendment($numg);
        include '../app/views/amendment/tableammendement.php';
    }

    public function ajouterAmendment()
    {
        $types = $this->model->selectTypeAmendment();

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $numam = trim($_POST['numam'] ?? '');
            $numg = trim($_POST['numg']) ?? '';
            $typeam = trim($_POST['typeam'] ?? 0);
            $dateam = trim($_POST['dateam'] ?? 0);
            $datepro = trim($_POST['datepro'] ?? 0);
            $montant = trim($_POST['montant'] ?? 0);
            $obs = trim($_POST['obs'] ?? '');
            $file = $_FILES["docam"] ?? '';
            $error = [];
            if (empty($numam)) {
                $error['numam'] = "veuillez remplir ce champ  .";
            }
            if (empty($typeam)) {
                $error['typeam'] = "veuillez selectioner ce champ .";
            }
            if (empty($dateam)) {
                $error['dateam'] = "veuillez choisire une date .";
            }
            if (empty($datepro)) {
                $error['datepro'] = "veuillez choisire une date .";
            }
            if (empty($montant)) {
                $error['montant'] = "veuillez remplir ce champ  .";
            }
            if (count($this->model->checkNumeroAmendment($numam)) > 0) {
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
                $this->model->inserDocumentAmendment($numam, $fileName, $path);
                if ($this->model->insertAmendment($numam, $numg, $typeam, $dateam, $datepro, $montant, $obs)) {
                    ob_end_clean();

                    print_r("<form id='redirectForm' action='index.php?page=amendment' method='POST'>
                    <input type='hidden' name='numg' value='{$numg}'>
      
                 
                   </form>
                   <script>
                   
                   document.getElementById('redirectForm').submit();
                  
                   </script>");
                    exit();
                }
            }
        }
        include '../app/views/amendment/insertAmendment.php';
    }

    public function modifAmendment()
    {
        $types = $this->model->selectTypeAmendment();

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $numam = trim($_POST['numam'] ?? '');
            $numg = trim($_POST['numg']) ?? '';
            $typeam = trim($_POST['typeam'] ?? 0);
            $typeamdeg = trim($_POST['typeamdeg'] ?? '');
            $dateam = trim($_POST['dateam'] ?? 0);
            $datepro = trim($_POST['datepro'] ?? 0);
            $montant = trim($_POST['montant'] ?? 0);
            $obs = trim($_POST['obs'] ?? '');

            $error = [];
            if (empty($numam)) {
                $error['numam'] = "veuillez remplir ce champ  .";
            }
            if (empty($typeam)) {
                $error['typeam'] = "veuillez selectioner ce champ .";
            }
            if (empty($dateam)) {
                $error['dateam'] = "veuillez choisire une date .";
            }
            if (empty($datepro)) {
                $error['datepro'] = "veuillez choisire une date .";
            }
            if (empty($montant)) {
                $error['montant'] = "veuillez remplir ce champ  .";
            }




            if (empty($error) && isset($_POST['modifier'])) {

                if ($this->model->modifAmendment($numam, $typeam, $dateam, $datepro, $montant, $obs)) {
                    ob_end_clean();

                    print_r("<form id='redirectForm' action='index.php?page=amendment' method='POST'>
                    <input type='hidden' name='numg' value='{$numg}'>
      
                 
                   </form>
                   <script>
                   
                   document.getElementById('redirectForm').submit();
                  
                   </script>");
                    exit();
                }
            }
        }
        include '../app/views/amendment/modifAmmendment.php';
    }

    public function deleteDocumentAmmendement()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $id = $_POST['supp-doc'];
            $numg = trim($_POST['numg']) ?? '';
            $this->model->deleteDocumentAmendment($id);
            print_r("<form id='redirectForm' action='index.php?page=amendment' method='POST'>
            <input type='hidden' name='numg' value='{$numg}'>
           </form>
           <script>
           
           document.getElementById('redirectForm').submit();
          
           </script>");
            exit();
        }
    }
}
ob_end_flush();
