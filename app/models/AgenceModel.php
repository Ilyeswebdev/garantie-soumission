<?php
class AgenceModel
{
    private $conn;
    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function insertAgence($codeBanque, $adress, $designation)
    {
        $query = "INSERT INTO agence (banquecode_bank, adress_AG ,designation_AG) VALUES (:banquecode, :adress,:designation)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":banquecode", $codeBanque);
        $stmt->bindParam(":adress", $adress);
        $stmt->bindParam(":designation", $designation);
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
    public function selectAgence($codeBanque)
    {
        $query = "SELECT * FROM agence where banquecode_bank=:codeBanque ORDER BY code_AG DESC ";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":codeBanque", $codeBanque);
        $stmt->execute();
        $exist = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $exist;
    }
    public function deleteAgence($id)
    {
        $query = "DELETE FROM agence WHERE code_AG = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }
    public function updateAgence($designation, $adress, $id)
    {
        $query = "UPDATE agence SET adress_AG = :nombanque , designation_AG = :adressbanque WHERE code_AG = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":nombanque", $designation);
        $stmt->bindParam(":adressbanque", $adress);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }
}
