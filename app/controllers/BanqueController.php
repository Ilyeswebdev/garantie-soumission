<?php
ob_start();
require_once  '..\config\Database.php';
require_once '..\app\models\BanqueModel.php';

class BanqueController
{
    private $model;
    public function __construct()
    {

        $database = new Database();
        $db = $database->connect();
        $this->model = new BanqueModel($db);
    }
    public function showBanquePage()
    {
        $banques = $this->model->selectBanque();
        include '../app/views/banque/showBanque.php';
    }

    public function insertBanque()
    {

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $code = trim($_POST['code']);
            $designation = $_POST['designation'];
            $error = [];
            if (empty($code)) {
                $error['code'] = "veuillez remplir ce champ .";
            }
            if (empty($designation)) {
                $error['designation'] = "veuillez remplir ce champ .";
            }

            if (empty($error)) {
                if ($this->model->insertBanque($code, $designation)) {
                    ob_end_clean();
                    header("Location: index.php?page=banque&code=$code&ajout");
                    exit();
                }
            }
        }
        include '../app/views/banque/insertBanque.php';
    }
    public function updateBanque()
    {

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $code = $_POST['code'] ?? '';
            $designation = $_POST['designation'] ?? '';
            $id = $_POST['modif-id'];
            if (empty($code)) {
                $error['code'] = "veuillez remplir ce champ .";
            }
            if (empty($designation)) {
                $error['designation'] = "veuillez remplir ce champ .";
            }


            if (empty($error)  && isset($_POST['update'])) {
                if ($this->model->updateBanque($code, $designation, $id)) {
                    ob_end_clean();
                    header("Location: index.php?page=banque&code=$code&modif");
                    exit();
                }
            }
            include '../app/views/banque/modifierBanque.php';
        }
    }
    public function deleteBanque()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id = $_POST['supp-id'];
            $this->model->deleteBanque($id);
            header("Location: index.php?page=banque");
            exit();
        }
    }
}
ob_end_flush();
