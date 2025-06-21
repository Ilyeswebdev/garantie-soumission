<?php
ob_start();
require_once  '..\config\Database.php';
require_once '..\app\models\SoumissionerModel.php';

class SoumissionerController
{
    private $model;
    public function __construct()
    {

        $database = new Database();
        $db = $database->connect();
        $this->model = new SoumissionerModel($db);
    }
    public function showSoumissioner()
    {
        $soumissioners = $this->model->selectSoumissioner();
        include '../app/views/soumissioner/showSoumissioner.php';
    }

    public function insertSoumissioner()
    {
        $pays = $this->model->selectpays();

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $paysCode = trim($_POST['payscode']);
            $numRegistre = trim($_POST['numregistre']);
            $nom = trim($_POST['nom']);
            $error = [];
            if ($paysCode < 0) {
                $error['payscode'] = "veuillez choisire un pays .";
            }
            if (empty($numRegistre)) {
                $error['numregistre'] = "veuillez remplir ce champ .";
            }
            if (empty($nom)) {
                $error['nom'] = "veuillez remplir ce champ .";
            }
            // if (count($this->model->checkcode($code)) > 0) {
            //     $error['code'] = "Ce code est déjà pris.";
            // }
            if (empty($error)) {
                if ($this->model->insertSoumissioner($paysCode, $numRegistre, $nom)) {
                    ob_end_clean();
                    header("Location: index.php?page=soumissioner&code=$nom&ajout");
                    exit();
                }
            }
        }
        include '../app/views/soumissioner/insertSoumissioner.php';
    }
    public function updateSoumissioner()
    {

        $pays = $this->model->selectpays();
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $paysCode = trim($_POST['payscode']);
            $pay1 = $_POST['pay'];
            $numRegistre = trim($_POST['numregistre']);
            $nom = $_POST['nom'];
            $id = $_POST['modif-id'];
            $error = [];
            $test = '';
            if ($paysCode < 0) {
                $error['payscode'] = "veuillez choisire un pays .";
            }
            if (empty($numRegistre)) {
                $error['numregistre'] = "veuillez remplir ce champ .";
            }
            if (empty($nom)) {
                $error['nom'] = "veuillez remplir ce champ .";
            }
            $code = $this->model->checkcode($numRegistre, $id);

            if (count($code) > 0) {
                $error['numregistre'] = "ce num de registre est deja pris .";
            }

            // if ($code[0]['num_registre'] === $numRegistre) {
            //     $error = [];
            // }
            if (empty($error) && isset($_POST['update'])) {
                if ($this->model->updateSoumissioner($paysCode, $numRegistre, $nom, $id)) {
                    ob_end_clean();
                    header("Location: index.php?page=soumissioner&code=$nom&modif");
                    exit();
                }
            }
            include '../app/views/soumissioner/modifierSoumissioner.php';
        }
    }
    public function deleteSoumissioner()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id = $_POST['supp-id'];
            $this->model->deleteSoumissioner($id);
            header("Location: index.php?page=soumissioner");
            exit();
        }
    }
}
ob_end_flush();
