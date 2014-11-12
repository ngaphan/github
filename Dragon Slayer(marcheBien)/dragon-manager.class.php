<?php

class DragonManager
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

    public function listDragons()
    {
        $query = "SELECT * FROM dragons ORDER BY dragonName";
        $statement = $this->DBConnection->prepare($query);
        $statement->execute();

        return $statement->fetchAll();
    }

    public function addDragon($name , $lifeMax, $force )// ces variables vont à droite de $bound
    {
        $query =" INSERT INTO dragons (dragonName, dragonLifeMax, dragonForce)
                 VALUES(:name, :lifeMax, :force ) ";// ces valeurs vont à gauche de $bound
        $statement = $this->DBConnection->prepare($query);
        $boundBD = [
            "name" => $name,
            "lifeMax" => $lifeMax,
            "force" => $force
        ];
        $statement->execute($boundBD);

    }
    public function deleteDragon($id)
    {
        $query ="DELETE FROM dragons WHERE dragonId = :id "  ;
        $statement = $this->DBConnection->prepare($query);
        $boundBD = ["id" => $id ];
        $statement->execute($boundBD);
    }

    public function modifyDragon($id, $name , $lifeMax , $force)
    {
        $query = "UPDATE dragons SET dragonName = :dragonName, dragonLifeMax = :dragonLifeMax, dragonForce = :dragonForce
                        WHERE dragonId = :dragonId";
    
        $statement = $this->DBConnection->prepare($query);        
        $boundBD = [
                        "id" => $id,
                        "name" =>  $name,
                        "lifeMax" =>  $lifeMax,
                        "force" => $force
                   ];
        $statement->execute($boundBD);
    }
}