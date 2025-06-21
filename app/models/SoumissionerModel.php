<?php
class SoumissionerModel
{
    private $conn;
    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function insertSoumissioner($paysCode, $numRegistre, $nom)
    {
        $query = "INSERT INTO soumissioner (payscode_pay, num_registre, nom_som) VALUES (:payscode_pay, :num_registre , :nom_som)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":payscode_pay", $paysCode);
        $stmt->bindParam(":num_registre", $numRegistre);
        $stmt->bindParam(":nom_som", $nom);
        return $stmt->execute();
    }
    public function checkcode($numRegistre, $id)
    {
        $query = "SELECT * FROM soumissioner where num_registre =:numregistre and code_som !=:id ";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":numregistre", $numRegistre);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function selectpays()
    {
        $query = "SELECT * FROM pays ";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function selectSoumissioner()
    {
        $query = "SELECT soumissioner.code_som , num_registre , nom_som , code_pay , pays.designation_pays FROM soumissioner INNER JOIN pays on payscode_pay = pays.code_pay;";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $exist = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $exist;
    }
    public function deleteSoumissioner($id)
    {
        $query = "DELETE FROM soumissioner WHERE code_som = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }
    public function updateSoumissioner($paysCode, $numRegistre, $nom, $id)
    {
        $query = "UPDATE soumissioner SET payscode_pay = :payscode , num_registre = :numregistre , nom_som = :nom WHERE code_som = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":payscode", $paysCode);
        $stmt->bindParam(":numregistre", $numRegistre);
        $stmt->bindParam(":nom", $nom);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }
}
