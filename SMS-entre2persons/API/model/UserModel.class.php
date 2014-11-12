<?php

// model/UserModel.class.php

/**
 * Classe permettant de gérer les clients
 */
class UserModel extends Model
{
    public function listAll()
    {
        // On prépare notre requête SQL
        $query = "SELECT * FROM users ORDER BY userNickname";

        // On charge notre requête SQL dans la couche d'abstraction PDO
        $statement = $this->PDO->prepare($query);

        // On exécute notre requête SQL
        $statement->execute();

        // On retourne nos résultats SQL (liste des personnages)
        // sous la forme d'un tableau à deux dimensions

        $recup = json_encode($statement->fetchAll());

        echo $recup ;

    //echo "bonjour" ;
    // attention !!! après le echo de 'json_encode...' ,
    // on ne peut plus faire echo de quoi que ce soit, on peut continuer de faire         // les codes mais pas de écho "bonjour" quoi que ce soit
    }

    // pour vérifier si le nickname existe deja dans la BDD
    // on peut le faire en 2 methodes
    // methode 1 consists de 2 fonctions "add" et "addIfNotExists"

 
    public function add($userNickname)
    {
        // On prépare notre requête SQL
        $query = "INSERT INTO users (userNickname)
                  VALUES (:userNickname)";
        $boundDB = [
            "userNickname" => $userNickname
        ];

        // On charge notre requête SQL dans la couche d'abstraction PDO
        $statement = $this->PDO->prepare($query);

        // On exécute notre requête SQL
        $statement->execute($boundDB);

        return $this->PDO->lastInsertId()  ;

    }

    public function addIfNotExists($userNickname)
    {
        // On prépare notre requête SQL
        $query = "SELECT * FROM users WHERE userNickname =:userNickname ";
        $boundDB = [
            "userNickname" => $userNickname
        ];

        // On charge notre requête SQL dans la couche d'abstraction PDO
        $statement = $this->PDO->prepare($query);// recçoit un obj de type PDOStatement

        // On exécute notre requête SQL
        $statement->execute($boundDB);

        //si aucun nickname corrrespondant à $userNickname n'a été trouvé
        if($statement->rowCount()===0)
        {
            // je vais le créer
            $returnedId = $this->add($userNickname) ;
            return $returnedId ;

        }
        // sinon
        else
        {
            //return false ;
            return " Ce nickname est deja pris !";
        }

    }

    /*
     * methode 2:
     * 2 functions 'add' et 'addIfNotExists' peuvent rassemblé en 1 seule function         * suivant:
     *
     */


/*
    public function exists($userNickname)
    {
        // chercher tous le nicknames dans BDD
        // On prépare notre requête SQL
        $query = "SELECT * FROM users WHERE userNickname =:userNickname ";
        $boundDB = [
            "userNickname" => $userNickname
        ];

        // On charge notre requête SQL dans la couche d'abstraction PDO
        $statement = $this->PDO->prepare($query);// recçoit un obj de type PDOStatement

        // On exécute notre requête SQL
        $statement->execute($boundDB);

        //si le nickname corrrespondant à $userNickname est trouvé
        // c'est à dire ce nickname exist dejà-> return " Ce nickname est deja pris !";

        if($statement->rowCount()!==0)
        {
            return " Ce nickname est deja pris !";
        }

        // sinon, si ça n'existe pas encore, je vais le créer
        else
        {
            // je vais l'ajouter dans la BDD
            // On prépare notre requête SQL

        $query = "INSERT INTO users (userNickname)
                  VALUES (:userNickname)";
        $boundDB = [
            "userNickname" => $userNickname
        ];

        // On charge notre requête SQL dans la couche d'abstraction PDO
        $statement = $this->PDO->prepare($query);

        // On exécute notre requête SQL
        $statement->execute($boundDB);

        $recup = $statement->fetchAll();

        echo json_encode($recup) ;

        }
    }
*/

    
}


