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

    public function add($weaponName , $weaponForce )// ces variables vont à droite de $bound
    {
        $query =" INSERT INTO weapons (weaponName,weaponForce)
                 VALUES(:weaponName,:weaponForce ) ";// ces valeurs vont à gauche de $bound        
        $boundBD = [
                        "weaponName" => $weaponName,           
                        "weaponForce" => $weaponForce
                    ];

        $statement = $this->DBConnection->prepare($query);
        $statement->execute($boundBD);

    }
    public function delete($weaponId)
    {
        $query ="DELETE FROM weapons WHERE weaponId = :id "  ;        
        $boundBD = [ "weaponId" => $weaponId ];

        $statement = $this->DBConnection->prepare($query);
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
            $weaponObj = new Weapon ($weaponArray["weaponId"] , $weaponArray["weaponName"],
                                     $weaponArray["weaponForce"]);
            return $weaponObj ;
        }
    }
}