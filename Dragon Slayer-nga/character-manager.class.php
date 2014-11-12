<?php

class CharacterManager
{
    protected $DBConnection;

    public function __construct($DBConnection)
    {
        $this->setDBConnection($DBConnection);
    }

    public function setDBConnection(PDO $DBConnectionObject)
    {
        $this->DBConnection = $DBConnectionObject;
    }

    public function listAll()
    {
        $query = "SELECT * FROM characters ORDER BY characterName";
        $statement = $this->DBConnection->prepare($query);
        $statement->execute();

        return $statement->fetchAll();// Returns an array containing all of the result set rows 
    }

    public function add($characterName , $characterLifeMax, $characterArmor )// ces variables vont à droite de $bound
    {
        $query =" INSERT INTO characters (characterName, characterLifeMax, characterArmor)
                 VALUES(:characterName, :characterLifeMax, :characterArmor ) ";// ces valeurs vont à gauche de $bound        
        $boundBD = [
                        "characterName" => $characterName,
                        "characterLifeMax" => $characterLifeMax,
                        "characterArmor" => $characterArmor
                    ];

        $statement = $this->DBConnection->prepare($query);
        $statement->execute($boundBD);
    }

    public function delete($characterId)
    {
        $query ="DELETE FROM characters WHERE characterId = :characterId "  ;        
        $boundBD = ["characterId" => $characterId ];

        $statement = $this->DBConnection->prepare($query);
        $statement->execute($boundBD);
    }

    public function create($characterId, Weapon $weaponObject)
    {
        $query = "SELECT * FROM characters WHERE characterId = :characterId";
        $boundBD = [
            'characterId' => $characterId
        ];

        $statement = $this->DBConnection->prepare($query);
        $statement->execute($boundBD);

        if ($statement->rowCount() === 0)  { return false;   } // rowCount est une methode de $PDOStatement
        else
        {
            $characterArray = $statement->fetch();// Fetches the next row from a result set 
            $characterObjEtSonArm = new Character($characterArray['characterId'], $characterArray['characterName'], $characterArray['characterLifeMax'], 
                                             $characterArray['characterArmor'], $weaponObject);

            return $characterObjEtSonArm;
        }
    }
}