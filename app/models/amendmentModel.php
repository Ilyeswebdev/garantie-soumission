<?php
class amendmentModel
{
    private $conn;
    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function insertAmendment($numAmm, $numg, $typeAmm, $dateAmm, $dateProgation, $montant, $obs)
    {

        $query = "INSERT INTO amendment (num_AM	
        , garanienum_G 
        , type_amendmentcode_typeAM 
        , date_amendment 
        ,date_progation
        ,montant_AM
        ,observation ) 
        VALUES (:num_AM, :garanienum_G , :type_amendmentcode_typeAM , :date_amendment
         ,:date_progation , :montant_AM ,:observation)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":num_AM", $numAmm);
        $stmt->bindParam(":garanienum_G", $numg);
        $stmt->bindParam(":type_amendmentcode_typeAM", $typeAmm);
        $stmt->bindParam(":date_amendment", $dateAmm);
        $stmt->bindParam(":date_progation", $dateProgation);
        $stmt->bindParam(":montant_AM", $montant);
        $stmt->bindParam(":observation", $obs);

        return $stmt->execute();
    }
    public function modifAmendment($numAmm, $typeAmm, $dateAmm, $dateProgation, $montant, $obs)
    {

        $query = "UPDATE amendment SET 	
        type_amendmentcode_typeAM = :type_amendmentcode_typeAM 
        , date_amendment = :date_amendment
        ,date_progation = :date_progation
        ,montant_AM = :montant_AM
        ,observation = :observation  
        WHERE num_AM = :num_AM";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":num_AM", $numAmm);

        $stmt->bindParam(":type_amendmentcode_typeAM", $typeAmm);
        $stmt->bindParam(":date_amendment", $dateAmm);
        $stmt->bindParam(":date_progation", $dateProgation);
        $stmt->bindParam(":montant_AM", $montant);
        $stmt->bindParam(":observation", $obs);

        return $stmt->execute();
    }
    public function inserDocumentAmendment($numAm, $nomdoc, $chemain)
    {

        $query = "INSERT INTO document_amendment (amendmentnum_AM	, nom_AM , chemin_AM  ) 
        VALUES (:authentificationnum_ANT, :nom_DA , :chemin_DA  )";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":authentificationnum_ANT", $numAm);
        $stmt->bindParam(":nom_DA", $nomdoc);
        $stmt->bindParam(":chemin_DA", $chemain);
        return $stmt->execute();
    }

    public function checkNumeroAmendment($numeroAm)
    {
        $query = "SELECT * FROM amendment where num_AM =:num";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":num", $numeroAm);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function selectAmendment($numg)
    {
        $query = "SELECT * FROM amendment 
        JOIN type_amendment ON amendment.type_amendmentcode_typeAM = type_amendment.code_typeAM 
        where garanienum_G = :numg ";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":numg", $numg);
        $stmt->execute();
        $exist = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $exist;
    }
    public function selectTypeAmendment()
    {
        $query = "SELECT * FROM type_amendment  ";
        $stmt = $this->conn->prepare($query);

        $stmt->execute();
        $exist = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $exist;
    }
    public function selectDocumentAmendment($numg)
    {
        $query = "select document_amendment.* , 
        amendment.garanienum_G 
        from document_amendment 
        JOIN amendment on document_amendment.amendmentnum_AM =amendment.num_AM 
        WHERE garanienum_G = :numg";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":numg", $numg);
        $stmt->execute();
        $exist = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $exist;
    }
    public function deleteDocumentAmendment($id)
    {
        $query = "DELETE FROM document_amendment WHERE code_DAM = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }
    public function deleteAmendment($id)
    {
        $query = "DELETE FROM amendment WHERE num_AM = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }
}
