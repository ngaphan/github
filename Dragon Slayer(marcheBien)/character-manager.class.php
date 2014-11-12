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

    public function listCharacters()
    {
        $query = "SELECT * FROM characters ORDER BY characterName";
        $statement = $this->DBConnection->prepare($query);
        $statement->execute();

        return $statement->fetchAll();
    }

    public function addCharacter($name , $lifeMax, $armor )// ces variables vont à droite de $bound
    {
        $query =" INSERT INTO characters (characterName, characterLifeMax, characterArmor)
                 VALUES(:name, :lifeMax, :armor ) ";// ces valeurs vont à gauche de $bound
        $statement = $this->DBConnection->prepare($query);
        $boundBD = [
            "name" => $name,
            "lifeMax" => $lifeMax,
            "armor" => $armor
        ];
        $statement->execute($boundBD);
    }
    public function deleteCharacter($id)
    {
        $query ="DELETE FROM characters WHERE characterId = :id "  ;
        $statement = $this->DBConnection->prepare($query);
        $boundBD = ["id" => $id ];
        $statement->execute($boundBD);
    }
}