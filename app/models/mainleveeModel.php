<?php
class mainleveeModel
{
    private $conn;
    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function insertMainlevee($numMl, $typeMl, $numg, $dateMl, $montant, $obs)
    {

        $query = "INSERT INTO main_levee 
        (num_ML, type_mainleveecode_typeML, garanienum_G, date_ML, montant_ML, observaation)
         VALUES 
        (:numMl, :typeMl, :garanienum_G, :dateMl, :montant, :observation);";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":numMl", $numMl);
        $stmt->bindParam(":typeMl", $typeMl);
        $stmt->bindParam(":garanienum_G", $numg);
        $stmt->bindParam(":dateMl", $dateMl);
        $stmt->bindParam(":montant", $montant);
        $stmt->bindParam(":observation", $obs);

        return $stmt->execute();
    }
    public function inserDocumentMainlevee($numMl, $nomdoc, $chemain)
    {

        $query = "INSERT INTO document_mainlevee (main_leveenum_ML, nom_ML , chemin_ML  ) 
        VALUES (:numMl, :nomdoc , :chemain  )";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":numMl", $numMl);
        $stmt->bindParam(":nomdoc", $nomdoc);
        $stmt->bindParam(":chemain", $chemain);
        return $stmt->execute();
    }

    public function checkNumeroMainlevee($numeroMl)
    {
        $query = "SELECT * FROM main_levee where num_ML =:num";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":num", $numeroMl);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function selectMainlevee($numg)
    {
        $query = "SELECT * FROM main_levee 
        JOIN type_mainlevee ON main_levee.type_mainleveecode_typeML = type_mainlevee.code_typeML     
        where garanienum_G = :numg ";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":numg", $numg);
        $stmt->execute();
        $exist = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $exist;
    }
    public function selectTypeMainlevee()
    {
        $query = "SELECT * FROM type_mainlevee  ";
        $stmt = $this->conn->prepare($query);

        $stmt->execute();
        $exist = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $exist;
    }
    public function selectDocumentMainlevee($numg)
    {
        $query = "select document_mainlevee.* , 
        main_levee.garanienum_G 
        from document_mainlevee 
        JOIN main_levee on document_mainlevee.main_leveenum_ML =main_levee.num_ML 
        WHERE garanienum_G = :numg";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":numg", $numg);
        $stmt->execute();
        $exist = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $exist;
    }
    public function deleteDocumentMainlevee($id)
    {
        $query = "DELETE FROM document_mainlevee WHERE code_DML = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }
}
