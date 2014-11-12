<?php

// model/Panier_manager.class.php

/**
 * Classe permettant de gérer le Panier
 */
class PanierManager extends Model
{
    /**
     * Ajoute un nouveau produit dans le Panier
     *
     * @param  string refPanier          Réference du Panier
     * @param  string nomPanier          nom du Panier
     * @param  string descriptionPanier  description du Panier
     * @return void
     */

    public function add($idProduitAjoute, $quantiteProduitsAjoutes)
    {
        // On prépare notre requête SQL
        $query = "INSERT INTO paniers (idProduitAjoute,quantiteProduitsAjoutes) VALUES (:idProduitAjoute, :quantiteProduitsAjoutes)";

        // On prépare notre tableau faisant le "binding" entre les valeurs de nos variables
        // et celles qui sont envoyées dans la requête SQL (pour éviter les injections)
        $boundValues = [
            'idProduitAjoute' => $idProduitAjoute,
            'quantiteProduitsAjoutes' => $quantiteProduitsAjoutes
        ];

        // On charge notre requête SQL dans la couche d'abstraction PDO
        $statement = $this->PDO->prepare($query);

        // On exécute notre requête SQL (en liant notre tableau de "binding")
        $statement->execute($boundValues);
    }

    /**
     * Contrôle s'il existe un Panier ayant cet identifiant dans la BDD
     *
     * @param  int    $idPanier    Identifiant du Panier
     * @return bool                Renvoie TRUE si c'est le cas, FALSE sinon
     */
    public function exists($idPanier)
    {
        // On prépare notre requête SQL
        $query = "SELECT * FROM paniers WHERE idPanier = :idPanier";

        // On prépare notre tableau faisant le "binding" entre les valeurs de nos variables
        // et celles qui sont envoyées dans la requête SQL (pour éviter les injections)
        $boundValues = [
            'idPanier' => $idPanier
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

    /**
     * Récupère la liste des produits ajoutés dans le Panier sous la forme d'un tableau
     * à deux dimensions
     *
     * @return array Tableau à deux dimensions listant les Paniers
     */

    public function listAll()
    {
        // On prépare notre requête SQL
        $query = "SELECT * FROM paniers ORDER BY idPanier";

        // On charge notre requête SQL dans la couche d'abstraction PDO
        $statement = $this->PDO->prepare($query);

        // On exécute notre requête SQL
        $statement->execute();

        // On retourne nos résultats SQL (liste des Paniers)
        // sous la forme d'un tableau à deux dimensions
        return $statement->fetchAll();
    }


    /**
     * Supprime une Panier de la BDD à partir de son identifiant
     *
     * @param  int    $idPanier     Identifiant du Panier
     * @return void
     */
    public function delete($idPanier)
    {
        // On prépare notre requête SQL
        $query = "DELETE FROM paniers WHERE idPanier = :idPanier";

        // On prépare notre tableau faisant le "binding" entre les valeurs de nos variables
        // et celles qui sont envoyées dans la requête SQL (pour éviter les injections)
        $boundValues = [
            'idPanier' => $idPanier
        ];

        // On charge notre requête SQL dans la couche d'abstraction PDO
        $statement = $this->PDO->prepare($query);

        // On exécute notre requête SQL (en liant notre tableau de "binding")
        $statement->execute($boundValues);
    }

    /**
     * Crée un objet Panier en récupérant ses propriétés à partir de la BDD
     *
     * @param  int    $idPanier  Identifiant de la Panier
     * @return mixed 		Renvoie un objet Panier si le Panier existe, FALSE sinon
     */
    public function create($idPanier)
    {
        // Si aucun dragon n'existe avec cet identifiant
        if (!$this->exists($idPanier))
        {
            // On ne fait rien et on renvoie FALSE_manager
            return false;
        }
        // Sinon (s'il existe)
        else
        {
            // On prépare notre requête SQL
            $query = "SELECT * FROM paniers WHERE idPanier = :idPanier";

            // On prépare notre tableau faisant le "binding" entre les valeurs de nos               //variables
            // et celles qui sont envoyées dans la requête SQL (pour éviter les injections)
            $boundValues = [
                'idPanier' => $idPanier
            ];

            // On charge notre requête SQL dans la couche d'abstraction PDO
            $statement = $this->PDO->prepare($query);

            // On exécute notre requête SQL (en liant notre tableau de "binding")
            $statement->execute($boundValues);

            /* On récupère la ligne correspondante de la table "Paniers" sous la forme                   d'un tableau*/

            $panierManagerArray = $statement->fetch();

            // On instancie notre classe PanierManager pour créer un objet                            // panierManager
            // avec pour propriétés les données récupérées à partir de la BDD
            $panierManagerObj = new Panier( $panierManagerArray['idPanier'],
                                            $panierManagerArray['idProduitAjoute'],
                                            $panierManagerArray['quantiteProduitsAjoutes'],
                                            $panierManagerArray['quantiteProduitsCommandes']
                                           );

            // On retourne notre objet Dragon
            return $panierManagerObj;
        }
    }


}
