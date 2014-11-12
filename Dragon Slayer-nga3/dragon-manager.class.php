<?php

class DragonManager
{
    protected $DBConnection;
    // mon param attendu ici = $DBConnection qui attend le param envoyé ($PDOConnectionObject)
    // une fois reçoit le param, je cré l'obj "DBConnection" par "setDBConnection".
    // Ici il est toujours de type PDO
    // J'utilise cet obj dans les functions plus bas ( create , par ex )( regarder la partie plus basse )

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
        $query = "SELECT * FROM dragons ORDER BY dragonName";
        $statement = $this->DBConnection->prepare($query);
        $statement->execute();

        return $statement->fetchAll();
    }

    public function add($dragonName , $dragonLifeMax, $dragonForce )// ces variables vont à droite de $bound
    {
        $query =" INSERT INTO dragons (dragonName, dragonLifeMax, dragonForce)
                 VALUES(:dragonName, :dragonLifeMax, :dragonForce ) ";// ces valeurs vont à gauche de $bound
        
        $boundBD = [
                        "dragonName" => $dragonName,
                        "dragonLifeMax" => $dragonLifeMax,
                        "dragonForce" => $dragonForce
                    ];

        $statement = $this->DBConnection->prepare($query);
        $statement->execute($boundBD);
    }

    public function delete($dragonId)
    {
        $query ="DELETE FROM dragons WHERE dragonId = :dragonId "  ;       
        $boundBD = ["dragonId" => $dragonId ];
        $statement = $this->DBConnection->prepare($query);
        $statement->execute($boundBD);
    }

    public function modify($id, $name , $lifeMax , $force)
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

    public function create($dragonId)
    {
        // je fais ma requete
        $query = " SELECT * FROM dragons WHERE dragonId = :dragonId ";

        // je fais la corespondance entre la valeur reçu en param av BDD
        $boundBD = ["dragonId"        =>  $dragonId       ];

        $statement = $this->DBConnection->prepare($query);// je prepare ma requete
        // $this->DBConnection veut dire que j'attache la propriété "DBConnection" à moi meme
        // j'attache la methode "prepare" à ma propriété
        // methode "prepare" retourn " 1 obj de type PDOStatement"( voir "return values")
        // le récupe et le mettre dans la variable " $statement "

        $statement->execute($boundBD);// j'execute ma requete
        // methode "execute" retourn " 1 obj de type PDOStatement"

        if($statement->rowCount() === 0)
        // rowCount est 1 methode de PDOStatement( chercher ds php.net)
        // vérifie si l'indice exist ,ex: on a que 10dragon , il ns donne l'indice 14
        {
            return false ;
        }
        else
        {
            $dragonArray = $statement->fetch() ;
            //return :false si erreur et return 1 obj, ou 1 tab depend de ce qu'il a récupérer

            $dragonObj = new Dragon ($dragonArray["dragonId"] ,$dragonArray["dragonName"], $dragonArray["dragonLifeMax"], $dragonArray["dragonForce"]);

            return $dragonObj ;
        }

    }

}