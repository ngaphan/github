<?php

// model/Commande_manager.class.php

/**
 * Classe permettant de gérer les commandes
 */
class CommandeManager extends Model
{
    /**
     * Récupère la liste des Commandes sous la forme d'un tableau à deux dimensions
     *
     * @return array Tableau à deux dimensions listant les Commandes
     */
    public function listAll()
    {
        // On prépare notre requête SQL
        $query = "SELECT * FROM commandes ORDER BY idCommande";

        // On charge notre requête SQL dans la couche d'abstraction PDO
        $statement = $this->PDO->prepare($query);

        // On exécute notre requête SQL
        $statement->execute();

        // On retourne nos résultats SQL (liste des Commandes)
        // sous la forme d'un tableau à deux dimensions
        return $statement->fetchAll();
    }

    /**
     * Ajoute un nouveau Commande dans la BDD
     *
     * @param  string refCommande          Réference du Commande
     * @param  string nomCommande          nom du Commande
     * @param  string descriptionCommande  description du Commande
     * @return void
     */
    public function add($idCommande ,$refCommande, $nomCommande,$descriptionCommande , $stock)
    {
        // On prépare notre requête SQL
        $query = "INSERT INTO commandes (idCommande,refCommande, nomCommande,descriptionCommande,stock) VALUES (:idCommande,:refCommande, :nomCommande, :descriptionCommande, :stock)";

        // On prépare notre tableau faisant le "binding" entre les valeurs de nos variables
        // et celles qui sont envoyées dans la requête SQL (pour éviter les injections)
        $boundValues = [
            'idCommande' => $idCommande,
            'refCommande' => $refCommande,
            'nomCommande' => $nomCommande,
            'descriptionCommande' => $descriptionCommande,
            'stock' => $stock
        ];

        // On charge notre requête SQL dans la couche d'abstraction PDO
        $statement = $this->PDO->prepare($query);

        // On exécute notre requête SQL (en liant notre tableau de "binding")
        $statement->execute($boundValues);
    }

    /**
     * Supprime une Commande de la BDD à partir de son identifiant
     *
     * @param  int    $idCommande     Identifiant du Commande
     * @return void
     */
    public function delete($idCommande)
    {
        // On prépare notre requête SQL
        $query = "DELETE FROM commandes WHERE idCommande = :idCommande";

        // On prépare notre tableau faisant le "binding" entre les valeurs de nos variables
        // et celles qui sont envoyées dans la requête SQL (pour éviter les injections)
        $boundValues = [
            'idCommande' => $idCommande
        ];

        // On charge notre requête SQL dans la couche d'abstraction PDO
        $statement = $this->PDO->prepare($query);

        // On exécute notre requête SQL (en liant notre tableau de "binding")
        $statement->execute($boundValues);
    }

    /**
     * Crée un objet Commande_manager en récupérant ses propriétés à partir de la BDD
     *
     * @param  int    $idCommande  Identifiant de la Commande
     * @return mixed 		Renvoie un objet Commande si le Commande existe, FALSE sinon
     */
    public function create($idCommande)
    {
        // Si aucun dragon n'existe avec cet identifiant
        if (!$this->exists($idCommande))
        {
            // On ne fait rien et on renvoie FALSE
            return false;
        }
        // Sinon (s'il existe)
        else
        {
            // On prépare notre requête SQL
            $query = "SELECT * FROM commandes WHERE idCommande = :idCommande";

            // On prépare notre tableau faisant le "binding" entre les valeurs de nos               //variables
            // et celles qui sont envoyées dans la requête SQL (pour éviter les injections)
            $boundValues = [
                'idCommande' => $idCommande
            ];

            // On charge notre requête SQL dans la couche d'abstraction PDO
            $statement = $this->PDO->prepare($query);

            // On exécute notre requête SQL (en liant notre tableau de "binding")
            $statement->execute($boundValues);

            /* On récupère la ligne correspondante de la table "Commandes" sous la forme                   d'un tableau*/

            $commandeManagerArray = $statement->fetch();

            // On instancie notre classe CommandeManager pour créer un objet                            // commandeManager
            // avec pour propriétés les données récupérées à partir de la BDD

            // $idCommande ,$refCommande, $nomCommande,$descriptionCommande , $stock

            $commandeManagerObj = new CommandeManager($commandeManagerArray['idCommande'],
                $commandeManagerArray['refCommande'], $commandeManagerArray['nomCommande'], $commandeManagerArray['descriptionCommande'],$commandeManagerArray['stock']);

            // On retourne notre objet Dragon
            return $commandeManagerObj;
        }
    }

    /**
     * Contrôle s'il existe un Commande ayant cet identifiant dans la BDD
     *
     * @param  int    $idCommande    Identifiant du Commande
     * @return bool                Renvoie TRUE si c'est le cas, FALSE sinon
     */
    public function exists($idCommande)
    {
        // On prépare notre requête SQL
        $query = "SELECT * FROM commandes WHERE idCommande = :idCommande";

        // On prépare notre tableau faisant le "binding" entre les valeurs de nos variables
        // et celles qui sont envoyées dans la requête SQL (pour éviter les injections)
        $boundValues = [
            'idCommande' => $idCommande
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

    // calculer le nouveauStock des commandes qui restent dans la BDD
    public function calcStockCommandes($idCommande ,$quantitéCommandesCommandes)
    {
        // On prépare notre requête SQL pour compter tous les commandes en stock de la BDD
        $query = "SELECT count(*) FROM commandes WHERE idCommande = :idCommande";

        // On prépare notre tableau faisant le "binding" entre les valeurs de nos variables
        // et celles qui sont envoyées dans la requête SQL (pour éviter les injections)
        $boundValues = [
            'idCommande' => $idCommande
        ];

        // On charge notre requête SQL dans la couche d'abstraction PDO
        $statement = $this->PDO->prepare($query);

        // On exécute notre requête SQL (en liant notre tableau de "binding")
        // $ancienStock = resultat de cette exécution
        $ancienStock = $statement->execute($boundValues);

        $nouveauStock = $ancienStock -$quantitéCommandesCommandes ;
        return $nouveauStock ;
    }

}
