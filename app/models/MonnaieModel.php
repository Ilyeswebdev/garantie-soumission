<?php
class MonnaieModel
{
    private $conn;
    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function insertMonnaie($code, $designation)
    {
        $query = "INSERT INTO monnaie (code_monnaie, designation) VALUES (:code_monnaie, :designation)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":code_monnaie", $code);
        $stmt->bindParam(":designation", $designation);
        return $stmt->execute();
    }
    public function checkcodeUpdate($code, $id)
    {
        $query = "SELECT * FROM monnaie where code_monnaie =:code_monnaie and cod_M !=:id ";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":code_monnaie", $code);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function checkcode($code)
    {
        $query = "SELECT * FROM monnaie where code_monnaie =:code_monnaie  ";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":code_monnaie", $code);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function selectMonnaie()
    {
        $query = "SELECT * FROM monnaie ORDER BY cod_M DESC ";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $exist = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $exist;
    }
    public function deleteMonnaie($id)
    {
        $query = "DELETE FROM monnaie WHERE cod_M = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }
    public function updateMonnaie($code, $designation, $id)
    {
        $query = "UPDATE monnaie SET code_monnaie = :code_monnaie , designation = :designation WHERE cod_M = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":code_monnaie", $code);
        $stmt->bindParam(":designation", $designation);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }
}
