<?php
class UtilisateursModel
{
    private $conn;
    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function insertUtilisateurs($nom, $prenom, $username, $password, $profileid)
    {
        $active = 'active';
        $query = "INSERT INTO utilisateurs (nom, prenom , username , password , account , profileid) VALUES (:nom, :prenom , :username , :password ,:account , :profileid )";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":nom", $nom);
        $stmt->bindParam(":prenom", $prenom);
        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":password", $password);
        $stmt->bindParam(":account", $active);
        $stmt->bindParam(":profileid", $profileid);
        return $stmt->execute();
    }
    // public function checkcodeUpdate($code, $id)
    // {
    //     $query = "SELECT * FROM monnaie where code_monnaie =:code_monnaie and cod_M !=:id ";
    //     $stmt = $this->conn->prepare($query);
    //     $stmt->bindParam(":code_monnaie", $code);
    //     $stmt->bindParam(":id", $id);
    //     $stmt->execute();
    //     return $stmt->fetchAll(PDO::FETCH_ASSOC);
    // }
    public function checkUsername($username)
    {
        $query = "SELECT * FROM utilisateurs  where username =:username  ";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":username", $username);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function selectUtilisateurs()
    {
        $query = "SELECT utilisateurs.id, nom , username , prenom , account , profile.label   FROM utilisateurs JOIN profile ON utilisateurs.profileid = profile.id;";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $exist = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $exist;
    }
    public function selectRoles()
    {
        $query = "SELECT * FROM profile ";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $exist = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $exist;
    }
    public function updateStatus($account, $id)
    {
        $query = "UPDATE utilisateurs SET account = :account  WHERE id = :id ";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":account", $account);
        $stmt->bindParam("id", $id);
        return $stmt->execute();
    }
    public function deleteUtilisateur($id)
    {
        $query = "DELETE FROM utilisateurs WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }
    // public function updateMonnaie($code, $designation, $id)
    // {
    //     $query = "UPDATE monnaie SET code_monnaie = :code_monnaie , designation = :designation WHERE cod_M = :id";
    //     $stmt = $this->conn->prepare($query);
    //     $stmt->bindParam(":code_monnaie", $code);
    //     $stmt->bindParam(":designation", $designation);
    //     $stmt->bindParam(":id", $id);
    //     return $stmt->execute();
    // }
}
