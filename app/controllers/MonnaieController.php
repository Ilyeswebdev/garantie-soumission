<?php
ob_start();
require_once  '..\config\Database.php';
require_once '..\app\models\MonnaieModel.php';

class MonnaieController
{
    private $model;
    public function __construct()
    {

        $database = new Database();
        $db = $database->connect();
        $this->model = new MonnaieModel($db);
    }
    public function showMonnaiePage()
    {
        $monnaies = $this->model->selectMonnaie();
        include '../app/views/monnaie/ShowMonnaie.php';
    }

    public function insertMonnaie()
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
            if (count($this->model->checkcode($code)) > 0) {
                $error['code'] = "Ce code est déjà pris.";
            }

            if (empty($error)) {
                if ($this->model->insertMonnaie($code, $designation)) {
                    ob_end_clean();
                    header("Location: index.php?page=monnaie&code=$code&ajout");
                    exit();
                }
            }
        }
        include '../app/views/monnaie/insertMonnaie.php';
    }
    public function updateMonnaie()
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
            if (count($this->model->checkcodeUpdate($code, $id)) > 0) {
                $error['code'] = "Ce code est déjà pris.";
            }

            if (empty($error)  && isset($_POST['update'])) {
                if ($this->model->updateMonnaie($code, $designation, $id)) {
                    ob_end_clean();
                    header("Location: index.php?page=monnaie&code=$code&modif");
                    exit();
                }
            }
            include '../app/views/monnaie/modifierMonnaie.php';
        }
    }
    public function deleteMonnaie()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id = $_POST['supp-id'];
            $this->model->deleteMonnaie($id);
            header("Location: index.php?page=monnaie");
            exit();
        }
    }
}
ob_end_flush();
