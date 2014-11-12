<?php

// model/Client_manager.class.php

/**
 * Classe permettant de gérer les armes
 */
class ClientManager extends Model
{
    /**
     * Récupère la liste des Clients sous la forme d'un tableau à deux dimensions
     *
     * @return array Tableau à deux dimensions listant les Clients
     */
    public function listAll()
    {
        // On prépare notre requête SQL
        $query = "SELECT * FROM clients ORDER BY idClient";

        // On charge notre requête SQL dans la couche d'abstraction PDO
        $statement = $this->PDO->prepare($query);

        // On exécute notre requête SQL
        $statement->execute();

        // On retourne nos résultats SQL (liste des Clients)
        // sous la forme d'un tableau à deux dimensions
        return $statement->fetchAll();
    }

    /**
     * Ajoute un nouveau Client dans la BDD
     *
     * @return void
     */
    public function add($idClient, $nomClient,$prenomClient ,$email ,$adresseClient,$adresseLivraison )
    {
        // On prépare notre requête SQL
        $query = "INSERT INTO clients (idClient, nomClient,prenomClient,email,adresseClient,adresseLivraison) VALUES (:idClient, :nomClient, :prenomClient,:email ,:adresseClient,:adresseLivraison )";

        // On prépare notre tableau faisant le "binding" entre les valeurs de nos variables
        // et celles qui sont envoyées dans la requête SQL (pour éviter les injections)
        $boundValues = [
            'idClient' => $idClient,
            'nomClient' => $nomClient,
            'prenomClient' => $prenomClient,
            'email' => $email,
            'adresseClient' => $adresseClient,
            'adresseLivraison' => $adresseLivraison
        ];

        // On charge notre requête SQL dans la couche d'abstraction PDO
        $statement = $this->PDO->prepare($query);

        // On exécute notre requête SQL (en liant notre tableau de "binding")
        $statement->execute($boundValues);
    }

    /**
     * Supprime une Client de la BDD à partir de son identifiant
     *
     * @param  int    $idClient     Identifiant du Client
     * @return void
     */
    public function delete($idClient)
    {
        // On prépare notre requête SQL
        $query = "DELETE FROM clients WHERE idClient = :idClient";

        // On prépare notre tableau faisant le "binding" entre les valeurs de nos variables
        // et celles qui sont envoyées dans la requête SQL (pour éviter les injections)
        $boundValues = [
            'idClient' => $idClient
        ];

        // On charge notre requête SQL dans la couche d'abstraction PDO
        $statement = $this->PDO->prepare($query);

        // On exécute notre requête SQL (en liant notre tableau de "binding")
        $statement->execute($boundValues);
    }

    /**
     * Crée un objet Client_manager en récupérant ses propriétés à partir de la BDD
     *
     * @param  int    $idClient  Identifiant de la Client
     * @return mixed 		Renvoie un objet Client si le Client existe, FALSE sinon
     */
    public function create($idClient)
    {
        // Si aucun dragon n'existe avec cet identifiant
        if (!$this->exists($idClient))
        {
            // On ne fait rien et on renvoie FALSE
            return false;
        }
        // Sinon (s'il existe)
        else
        {
            // On prépare notre requête SQL
            $query = "SELECT * FROM clients WHERE idClient = :idClient";

            // On prépare notre tableau faisant le "binding" entre les valeurs de nos               //variables
            // et celles qui sont envoyées dans la requête SQL (pour éviter les injections)
            $boundValues = [
                'idClient' => $idClient
            ];

            // On charge notre requête SQL dans la couche d'abstraction PDO
            $statement = $this->PDO->prepare($query);

            // On exécute notre requête SQL (en liant notre tableau de "binding")
            $statement->execute($boundValues);

            /* On récupère la ligne correspondante de la table "Clients" sous la forme                   d'un tableau*/

            $clientManagerArray = $statement->fetch();

            // On instancie notre classe ClientManager pour créer un objet                            // clientManager
            // avec pour propriétés les données récupérées à partir de la BDD

            $clientManagerObj = new ClientManager($clientManagerArray['idClient'],
                $clientManagerArray['refClient'], $clientManagerArray['nomClient'], $clientManagerArray['prenomClient'],$clientManagerArray['email'],
                $clientManagerArray['adresseClient'], $clientManagerArray['adresseLivraison']);

            // On retourne notre objet Dragon
            return $clientManagerObj;
        }
    }

    /**
     * Contrôle s'il existe un Client ayant cet identifiant dans la BDD
     *
     * @param  int    $idClient    Identifiant du Client
     * @return bool                Renvoie TRUE si c'est le cas, FALSE sinon
     */
    public function exists($idClient)
    {
        // On prépare notre requête SQL
        $query = "SELECT * FROM clients WHERE idClient = :idClient";

        // On prépare notre tableau faisant le "binding" entre les valeurs de nos variables
        // et celles qui sont envoyées dans la requête SQL (pour éviter les injections)
        $boundValues = [
            'idClient' => $idClient
        ];

        // On charge notre requête SQL dans la couche d'abstraction PDO
        $statement = $this->PDO->prepare($query);

        // On exécute notre requête SQL (en liant notre tableau de "binding")
        $statement->execute($boundValues);

        // S'il n'y a aucun enregistrement dans la BDD
        if ($statement->rowCount() === 0)
        {
            // On retourne la valeur FALSE
            return false;
        }
        // Sinon (s'il n'y aucun enregistrement)
        else
        {
            // On retourne la valeur TRUE
            return true;
        }
    }


}
