<?php
ob_start();
require_once  '..\config\Database.php';
require_once '..\app\models\ValiditeModel.php';
class ValiditeController
{
    private $model;
    public function __construct()
    {
        $database = new Database();
        $db = $database->connect();
        $this->model = new ValidieModel($db);
    }
    public function insertValdite()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {


            $designation = $_POST['designation'];
            $error = [];

            if (empty($designation)) {
                $error['designation'] = "veuillez remplir ce champ .";
            }
            if ($designation >= 300) {
                $error['designation'] = "la validite ne peut pas depasseer 200 jours .";
            }

            if (count($this->model->checkValidite($designation)) > 0) {
                $error['designation'] = "cette validite existe deja . ";
            }

            if (empty($error)) {
                if ($this->model->insertValidite($designation)) {
                    ob_end_clean();
                    header("Location: index.php?page=validite&code=$designation&ajout");
                    exit();
                }
            }
        }
        include '../app/views/validite/insertValidite.php';
    }

    public function selectValidite()
    {
        $valites = $this->model->selectValidite();
        include '../app/views/validite/ShowValidite.php';
    }
    public function deleteValidite()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id = $_POST['supp-id'];
            $this->model->deleteValidite($id);
            header("Location: index.php?page=validite");
            exit();
        }
    }
}
