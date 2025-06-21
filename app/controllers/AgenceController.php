<?php
ob_start();
require_once  '..\config\Database.php';
require_once '..\app\models\AgenceModel.php';

class AgenceController
{
    private $model;

    public function __construct()
    {

        $database = new Database();
        $db = $database->connect();
        $this->model = new AgenceModel($db);
    }
    public function showAgencePage()
    {

        if (isset($_POST['banque-id'])) {
            $banqueId = $_POST['banque-id'];
            $banqueNom = $_POST['banque-nom'] ?? '';
            $agences = $this->model->selectAgence($banqueId);
            include '../app/views/agences/showAgences.php';
        }
    }

    public function insertAgence()
    {

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $banqueId = $_POST['banque-id'];
            $banqueNom = $_POST['banque-nom'];
            if (isset($_POST['add'])) {
                $code = trim($_POST['code']);
                $designation = $_POST['designation'];
                $banqueId = $_POST['banque-id'];
                $banqueNom = $_POST['banque-nom'];
                $error = [];
                if (empty($code)) {
                    $error['code'] = "veuillez remplir ce champ .";
                }
                if (empty($designation)) {
                    $error['designation'] = "veuillez remplir ce champ .";
                }
                if (empty($banqueId)) {
                    $error['designation'] = "banque id  .";
                }

                if (empty($error)) {
                    if ($this->model->insertAgence($banqueId, $code, $designation)) {

                        echo "<form id='redirectForm' action='index.php?page=agence&code=$code&ajout' method='POST'>
                             <input type='hidden' name='banque-id' value='{$banqueId}'>
                             <input type='hidden' name='banque-nom' value='{$banqueNom}'>
                            </form>
                            <script>document.getElementById('redirectForm').submit();</script>";
                    }
                }
            }
            include '../app/views/agences/insertAgences.php';
        }
    }
    public function updateAgence()
    {

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $banqueId = $_POST['banque-id'];
            $banqueNom = $_POST['banque-nom'];
            $code = $_POST['code'] ?? '';
            $designation = $_POST['designation'] ?? '';
            $id = $_POST['modif-id'];
            if (empty($code)) {
                $error['code'] = "veuillez remplir ce champ .";
            }
            if (empty($designation)) {
                $error['designation'] = "veuillez remplir ce champ .";
            }
            if (empty($banqueId)) {
                $error['designation'] = "banque id  .";
            }

            if (empty($error)  && isset($_POST['update'])) {
                if ($this->model->updateAgence($code, $designation, $id)) {
                    echo "<form id='redirectForm' action='index.php?page=agence&code=$code&modif' method='POST'>
                        <input type='hidden' name='banque-id' value='{$banqueId}'>
                        <input type='hidden' name='banque-nom' value='{$banqueNom}'>
                       </form>
                       <script>document.getElementById('redirectForm').submit();</script>";
                }
            }
            include '../app/views/agences/modifierAgences.php';
        }
    }
    public function deleteAgence()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $banqueId = $_POST['banque-id'];
            $banqueNom = $_POST['banque-nom'];
            $id = $_POST['supp-id'];
            $this->model->deleteAgence($id);
            echo "<form id='redirectForm' action='index.php?page=agence' method='POST'>
            <input type='hidden' name='banque-id' value='{$banqueId}'>
            <input type='hidden' name='banque-nom' value='{$banqueNom}'>
           </form>
           <script>document.getElementById('redirectForm').submit();</script>";


            exit();
        }
    }
}
ob_end_flush();
