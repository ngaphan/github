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

    public function listAll()
    {
        $query = "SELECT * FROM weapons ORDER BY weaponName";
        $statement = $this->DBConnection->prepare($query);
        $statement->execute();

        return $statement->fetchAll();
    }

    public function add($name , $force )// ces variables vont à droite de $bound
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
    public function delete($id)
    {
        $query ="DELETE FROM weapons WHERE weaponId = :id "  ;
        $statement = $this->DBConnection->prepare($query);
        $boundBD = ["id" => $id ];
        $statement->execute($boundBD);
    }

    public function create($weaponId)
    {
        $query = " SELECT * FROM weapons WHERE weaponId = :weaponId ";
        $boundBD = ["weaponId" => $weaponId ];
        $statement = $this->DBConnection->prepare($query);
        $statement->execute($boundBD);
        if ($statement->rowCount() === 0){return false; }
        else
        {
        $weaponArray = $statement->fetch() ;
        $weaponObj = new Weapon ($weaponArray["weaponId"] ,$weaponArray["weaponName"],
                                 $weaponArray["weaponForce"]);
        return $weaponObj ;
        }
    }
}


