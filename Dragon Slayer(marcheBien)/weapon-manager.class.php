<?php

class WeaponManager
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

    public function listWeapons()
    {
        $query = "SELECT * FROM weapons ORDER BY weaponName";
        $statement = $this->DBConnection->prepare($query);
        $statement->execute();

        return $statement->fetchAll();
    }

    public function addWeapon($name , $force )// ces variables vont à droite de $bound
    {
        $query =" INSERT INTO weapons (weaponName,weaponForce)
                 VALUES(:name,:force ) ";// ces valeurs vont à gauche de $bound
        $statement = $this->DBConnection->prepare($query);
        $boundBD = [
            "name" => $name,           
            "force" => $force
                     ];
        $statement->execute($boundBD);

    }
    public function deleteWeapon($id)
    {
        $query ="DELETE FROM weapons WHERE weaponId = :id "  ;
        $statement = $this->DBConnection->prepare($query);
        $boundBD = ["id" => $id ];
        $statement->execute($boundBD);
    }
}