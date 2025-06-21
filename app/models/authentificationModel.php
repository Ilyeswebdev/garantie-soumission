<?php
class authentificationModel
{
    private $conn;
    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function insertauthentification($numauth, $numg, $dateauth, $datedepo)
    {

        $query = "INSERT INTO authentification (num_ANT	, garanienum_G , date_authentification , date_depo_authentification ) 
        VALUES (:num_ANT, :garanienum_G , :date_authentification , :date_depo_authentification )";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":num_ANT", $numauth);
        $stmt->bindParam(":garanienum_G", $numg);
        $stmt->bindParam(":date_authentification", $dateauth);
        $stmt->bindParam(":date_depo_authentification", $datedepo);

        return $stmt->execute();
    }
    public function inserDocumentAuthentification($numauth, $nomdoc, $chemain)
    {

        $query = "INSERT INTO document_authentification (authentificationnum_ANT	, nom_DA , chemin_DA  ) 
        VALUES (:authentificationnum_ANT, :nom_DA , :chemin_DA  )";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":authentificationnum_ANT", $numauth);
        $stmt->bindParam(":nom_DA", $nomdoc);
        $stmt->bindParam(":chemin_DA", $chemain);


        return $stmt->execute();
    }

    public function checkNumeroAuthentification($numeroAuth)
    {
        $query = "SELECT * FROM authentification where num_ANT =:num_ANT";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":num_ANT", $numeroAuth);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function selectAuthentification($numg)
    {
        $query = "SELECT * FROM authentification where garanienum_G = :numg ";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":numg", $numg);
        $stmt->execute();
        $exist = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $exist;
    }
    public function selectDocumentAuthentification($numg)
    {
        $query = "select document_authentification.* , authentification.garanienum_G 
        from document_authentification 
        JOIN authentification on document_authentification.authentificationnum_ANT =authentification.num_ANT 
        WHERE garanienum_G = :numg";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":numg", $numg);
        $stmt->execute();
        $exist = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $exist;
    }
    public function deleteDocumentauth($id)
    {
        $query = "DELETE FROM document_authentification WHERE code_DANT = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }
}
