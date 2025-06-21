<?php
class BanqueModel
{
    private $conn;
    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function insertBanque($nom, $adress)
    {
        $query = "INSERT INTO banque (nom_banque, adress_banque) VALUES (:nombanque, :adressbanque)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":nombanque", $nom);
        $stmt->bindParam(":adressbanque", $adress);
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
    // public function checkcode($code)
    // {
    //     $query = "SELECT * FROM monnaie where code_monnaie =:code_monnaie  ";
    //     $stmt = $this->conn->prepare($query);
    //     $stmt->bindParam(":code_monnaie", $code);
    //     $stmt->execute();
    //     return $stmt->fetchAll(PDO::FETCH_ASSOC);
    // }
    public function selectBanque()
    {
        $query = "SELECT * FROM banque ORDER BY code_bank DESC ";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $exist = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $exist;
    }
    public function deleteBanque($id)
    {
        $query = "DELETE FROM banque WHERE code_bank = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }
    public function updateBanque($nom, $adress, $id)
    {
        $query = "UPDATE banque SET nom_banque = :nombanque , adress_banque = :adressbanque WHERE code_bank = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":nombanque", $nom);
        $stmt->bindParam(":adressbanque", $adress);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }
}
