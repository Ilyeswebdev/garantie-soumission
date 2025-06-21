<?php
class GarantieModel
{
    private $conn;
    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function insertGarantie($numeroGarantie, $MonnaieId, $agenceId, $soumissionerId, $validiteId, $AO, $montant, $dateDepo, $dateEchu)
    {
        $query = "INSERT INTO 
        garantie (num_G, 
        monnaiecod_M, 
        agencecode_AG, 
        soumissionercode_som, 
        validitecode_validite, 
        reference_AO, 
        montant, 
        date_depo, 
        date_echu) 
        VALUES (:numgarantie, :monnaieid , :agenceid , :soumissionerid , :validiteid , :ao , :montant  , :datedepo , :dateechu );";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":numgarantie", $numeroGarantie);
        $stmt->bindParam(":monnaieid", $MonnaieId);
        $stmt->bindParam(":agenceid", $agenceId);
        $stmt->bindParam(":soumissionerid", $soumissionerId);
        $stmt->bindParam(":validiteid", $validiteId);
        $stmt->bindParam(":ao", $AO);
        $stmt->bindParam(":montant", $montant);
        $stmt->bindParam(":datedepo", $dateDepo);
        $stmt->bindParam(":dateechu", $dateEchu);
        return $stmt->execute();
    }
    public function insertDocumentGarantie($numGarantie, $nomDocument, $chemain)
    {
        $query = "INSERT INTO document_garantie (code_DG, garanienum_G, nom_G, chemin_G) VALUES (NULL, :numgarantie, :nomdocument, :chemain);";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":numgarantie", $numGarantie);
        $stmt->bindParam(":nomdocument", $nomDocument);
        $stmt->bindParam(":chemain", $chemain);
        return $stmt->execute();
    }
    public function selectMonnaie()
    {
        $query = "SELECT * FROM monnaie";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function selectValidite()
    {
        $query = "SELECT * FROM validite";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function selectSoumissioner()
    {
        $query = "SELECT soumissioner.code_som , num_registre , nom_som , code_pay , pays.designation_pays FROM soumissioner INNER JOIN pays on payscode_pay = pays.code_pay;";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function selectBanque()
    {
        $query = "SELECT * FROM banque";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function selectAgence($banqueid)
    {
        $query = "SELECT * FROM agence where banquecode_bank = :banquecode_bank";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":banquecode_bank", $banqueid);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function checkNumeroGarantie($numeroGarantie)
    {
        $query = "SELECT * FROM garantie where num_G =:numgarantie";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":numgarantie", $numeroGarantie);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    // , document_garantie.chemin_G as chemain
    // garantie.num_G = document_garantie.garanienum_G 
    public function selectGarantie()
    {
        $query = "SELECT garantie.num_G , reference_AO , montant ,date_depo,date_Echu, 
        monnaie.code_monnaie AS monnaie , agence.designation_AG AS agence, 
        soumissioner.nom_som AS soumissioner  FROM garantie INNER JOIN monnaie ON monnaiecod_M = monnaie.cod_M INNER JOIN agence ON agencecode_AG = agence.code_AG INNER JOIN soumissioner ON soumissionercode_som = soumissioner.code_som 
        ORDER BY date_depo DESC;";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $exist = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $exist;
    }
    public function selectDocumentGarantie($numGarantie)
    {
        $query = "SELECT * FROM document_garantie WHERE garanienum_G = :numgarantie ;";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":numgarantie", $numGarantie);
        $stmt->execute();
        $exist = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $exist;
    }
    public function deleteGarantie($id)
    {
        $query = "DELETE FROM garantie WHERE num_G = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }
    public function deleteDocumentGarantie($id)
    {
        $query = "DELETE FROM document_garantie WHERE code_DG = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }
    public function updateGarantie($numeroGarantie, $MonnaieId, $agenceId, $soumissionerId, $validiteId, $AO, $montant, $dateDepo, $dateEchu)
    {
        $query = "UPDATE garantie 
                SET monnaiecod_M = :monnaieid , 
                    agencecode_AG = :agenceid , 
                    soumissionercode_som = :soumissionerid , 
                    validitecode_validite = :validiteid , 
                    reference_AO = :ao, 
                    montant = :montant , 
                    date_depo = :datedepo , 
                    date_echu = :dateechu 
                    WHERE num_G = :numgarantie;
                    ";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":numgarantie", $numeroGarantie);
        $stmt->bindParam(":monnaieid", $MonnaieId);
        $stmt->bindParam(":agenceid", $agenceId);
        $stmt->bindParam(":soumissionerid", $soumissionerId);
        $stmt->bindParam(":validiteid", $validiteId);
        $stmt->bindParam(":ao", $AO);
        $stmt->bindParam(":montant", $montant);
        $stmt->bindParam(":datedepo", $dateDepo);
        $stmt->bindParam(":dateechu", $dateEchu);
        return $stmt->execute();
    }
}
