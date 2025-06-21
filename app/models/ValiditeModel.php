<?php
class ValidieModel
{
    private $conn;
    public function __construct($db)
    {
        $this->conn = $db;
    }
    public function insertValidite($designation)
    {
        $query = "INSERT INTO validite (disignation_validite) VALUES (:designation)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":designation", $designation);
        return $stmt->execute();
    }
    public function selectValidite()
    {
        $query = "SELECT * FROM validite ORDER BY code_validite DESC ";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $exist = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $exist;
    }
    public function deleteValidite($id)
    {
        $query = "DELETE FROM validite WHERE code_validite = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }
    public function checkValidite($validite)
    {
        $query = "SELECT * FROM validite where disignation_validite =:disignation_validite ";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":disignation_validite", $validite);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
