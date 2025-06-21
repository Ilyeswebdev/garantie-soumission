<?php
ob_start();
require_once  '..\config\Database.php';
require_once '..\app\models\UtilisateursModel.php';

class UtilisateursController
{
    private $model;
    public function __construct()
    {

        $database = new Database();
        $db = $database->connect();
        $this->model = new UtilisateursModel($db);
    }
    public function showUtilisateurs()
    {
        $utilisateurs = $this->model->selectUtilisateurs();

        include '../app/views/utilisateurs/showUtilisateurs.php';
    }

    public function ajouterUtilisateurs()
    {
        $roles = $this->model->selectRoles();

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $nom = trim($_POST['nom'] ?? '');
            $prenom = trim($_POST['prenom'] ?? '');
            $username = trim($_POST['username'] ?? '');
            $password  = trim($_POST['password']);

            $confirmpassword = $_POST['confirmpassword'];
            $role =  trim($_POST['role']);
            $error = [];
            if (empty($nom)) {
                $error['nom'] = "veuillez remplir ce champ du nom .";
            }
            if (empty($prenom)) {
                $error['prenom'] = "veuillez remplir ce champ .";
            }
            if (empty($username)) {
                $error['username'] = "veuillez remplir ce champ .";
            }
            if (count($this->model->checkUsername($username)) > 0) {
                $error['username'] = "cette utilisateur existe deja.";
            }
            if (empty($password)) {
                $error['password'] = "veuillez remplir ce champ .";
            }
            if (strlen($password) < 3) {
                $error['password'] = "Le mot de passe doit contenir plus de 3 caractères.";
            }
            if (empty($confirmpassword)) {
                $error['confirmpassword'] = "veuillez remplir ce champ .";
            }
            if ($password !== $confirmpassword) {
                $error['confirmpassword'] = "Le mot de passe et sa confirmation ne correspondent pas !";
            }
            if ($role < 0) {
                $error['role'] = "veuillez choisire un role  .";
            }

            // if (count($this->model->checkcode($code)) > 0) {
            //     $error['code'] = "Ce code est déjà pris.";
            // }
            // count($this->model->checkcode($code)) == 0
            if (empty($error)) {
                $passwordHashed = password_hash($password, PASSWORD_DEFAULT);
                if ($this->model->insertUtilisateurs($nom, $prenom, $username, $passwordHashed, $role)) {
                    ob_end_clean();
                    header("Location: index.php?page=utilisateurs&code=$nom&ajout");
                    exit();
                }
            }
        }
        include '../app/views/utilisateurs/insertUtilisateurs.php';
    }
    public function updateStatus()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id = $_POST['id'];
            $status = $_POST['status'];
            $new_status = ($status === 'active') ? 'inactive' : 'active';
            $this->model->updateStatus($new_status, $id);
            header("Location: index.php?page=utilisateurs");
            exit();
        }
    }
    public function Utilisateurslogin()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = htmlspecialchars(trim($_POST['username'] ?? ''));
            $password  = htmlspecialchars(trim($_POST['password']));
            $user = $this->model->checkUsername($username);

            if (empty($username)) {
                $error = "u";
                header("Location: login.php?error=$error");
            } elseif (empty($password)) {
                $error = "p";
                header("Location: login.php?error=$error");
            } elseif (empty($user)) {
                $error = "u1";
                header("Location: login.php?error=$error");
            } elseif (count($user) > 0) {
                if (password_verify($password, $user['0']['password'])) {
                    if ($user['0']['account'] === 'inactive') {
                        $error = "a";
                        header("Location: login.php?error=$error");
                    } else {
                        // session_start();
                        $role = $user['0']['profileid'];
                        $_SESSION['username'] = $username;
                        $_SESSION['role'] = $role;
                    }
                } else {
                    $error = "p1";
                    header("Location: login.php?error=$error");
                }
            }
        }
    }
    public function logout()
    {
        session_start();
        $_SESSION = [];
        session_destroy();
        header("Location: login.php");
        exit;
    }
    public function deleteUtilisateurs()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id = $_POST['sup'];
            $this->model->deleteUtilisateur($id);
            header("Location: index.php?page=utilisateurs");
            exit();
        }
    }
}
ob_end_flush();
