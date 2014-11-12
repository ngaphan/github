<?php

// model/MessageModel.class.php

/**
 * Classe permettant de gérer les clients
 */
class MessageModel extends Model
{


    public function listAll()
    {
        // On prépare notre requête SQL
        $query = "SELECT * FROM messages ORDER BY messageDate ASC";

        // On charge notre requête SQL dans la couche d'abstraction PDO
        $statement = $this->PDO->prepare($query);

        // On exécute notre requête SQL
        $statement->execute();

        // On retourne nos résultats SQL (liste des personnages)
        // sous la forme d'un tableau à deux dimensions


        $recup = json_encode($statement->fetchAll());

        echo $recup ;
        //echo "hello" ;

    }

    public function add($userId, $messageValue)
    {
        // On prépare notre requête SQL
        $query = "INSERT INTO messages (userId, messageValue)
                  VALUES (:userId,:messageValue)";
        $boundDB = [
            "userId" => $userId,
            "messageValue"=>$messageValue
        ];

        // On charge notre requête SQL dans la couche d'abstraction PDO
        $statement = $this->PDO->prepare($query);

        // On exécute notre requête SQL
        $statement->execute($boundDB);

        // On retourne nos résultats SQL (liste des personnages)
        // sous la forme d'un tableau à deux dimensions

    }


}


