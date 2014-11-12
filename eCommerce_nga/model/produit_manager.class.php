<?php

// model/Produit_manager.class.php

/**
 * Classe permettant de gérer les armes
 */
class ProduitManager extends Model
{
    /**
     * Récupère la liste des Produits sous la forme d'un tableau à deux dimensions
     * @param $idCategorie = indentifiant de la categorie choisit en cours     
     * @return array Tableau à deux dimensions listant les Produits
     */

    public function listAllProduits($idCategorie)
    {
        // On prépare notre requête SQL
        $query = "SELECT * FROM produits  WHERE refProduit = :idCategorie ORDER BY idProduit";                    
        // On prépare notre tableau faisant le "binding" entre les valeurs de nos variables
        // et celles qui sont envoyées dans la requête SQL (pour éviter les injections)
        $boundValues = [
            'idCategorie' => $idCategorie           
        ];

        // On charge notre requête SQL dans la couche d'abstraction PDO
        $statement = $this->PDO->prepare($query);

        // On exécute notre requête SQL
        $statement->execute($boundValues);

        // On retourne nos résultats SQL (liste des Produits)
        // sous la forme d'un tableau à deux dimensions
        return $statement->fetchAll();
    }

    /**
     * Récupère la liste des caractéristiques d'un produit sous la forme d'un tableau à deux dimensions
     * @param $idCategorie = indentifiant de la categorie choisit en cours     
     * @return array Tableau à deux dimensions listant les Produits
     */

    public function detailsProduit($idProduit)
    {
        // On prépare notre requête SQL
        $query = "SELECT * FROM produits  WHERE idProduit = :idProduit";                    
        // On prépare notre tableau faisant le "binding" entre les valeurs de nos variables
        // et celles qui sont envoyées dans la requête SQL (pour éviter les injections)
        $boundValues = [
            'idProduit' => $idProduit           
        ];

        // On charge notre requête SQL dans la couche d'abstraction PDO
        $statement = $this->PDO->prepare($query);

        // On exécute notre requête SQL
        $statement->execute($boundValues);

        // On retourne nos résultats SQL (liste des Produits)
        // sous la forme d'un tableau à deux dimensions
        return $statement->fetchAll();
    }


    /**
     * Ajouter/ravitaller un nouveau Produit dans la BDD
     *
     * @param  string refProduit          Réference du Produit
     * @param  string nomProduit          nom du Produit
     * @param  string descriptionProduit  description du Produit
     * @return void
     */
    
    public function add($idProduit ,$refProduit, $nomProduit, $descriptionProduit , $stock)
    {
        // On prépare notre requête SQL
        $query = "INSERT INTO produits (idProduit,refProduit, nomProduit,descriptionProduit,stock) VALUES (:idProduit,:refProduit, :nomProduit, :descriptionProduit, :stock)";

        // On prépare notre tableau faisant le "binding" entre les valeurs de nos variables
        // et celles qui sont envoyées dans la requête SQL (pour éviter les injections)
        $boundValues = [
            'idProduit' => $idProduit,
            'refProduit' => $refProduit,
            'nomProduit' => $nomProduit,
            'descriptionProduit' => $descriptionProduit,
            'stock' => $stock
        ];

        // On charge notre requête SQL dans la couche d'abstraction PDO
        $statement = $this->PDO->prepare($query);

        // On exécute notre requête SQL (en liant notre tableau de "binding")
        $statement->execute($boundValues);
    }

    /**
     * Supprimer/enlever  une Produit de la BDD à partir de son identifiant
     *
     * @param  int    $idProduit     Identifiant du Produit
     * @return void
     */  

    public function delete($idProduit)
    {
        // On prépare notre requête SQL
        $query = "DELETE FROM produits WHERE idProduit = :idProduit";

        // On prépare notre tableau faisant le "binding" entre les valeurs de nos variables
        // et celles qui sont envoyées dans la requête SQL (pour éviter les injections)
        $boundValues = [
            'idProduit' => $idProduit
        ];

        // On charge notre requête SQL dans la couche d'abstraction PDO
        $statement = $this->PDO->prepare($query);

        // On exécute notre requête SQL (en liant notre tableau de "binding")
        $statement->execute($boundValues);
    }

    
    /**
     * Contrôle s'il existe un Produit ayant cet identifiant dans la BDD
     *
     * @param  int    $idProduit    Identifiant du Produit
     * @return bool                Renvoie TRUE si c'est le cas, FALSE sinon
     */
    public function exists($idProduit)
    {
        // On prépare notre requête SQL
        $query = "SELECT * FROM produits WHERE idProduit = :idProduit";

        // On prépare notre tableau faisant le "binding" entre les valeurs de nos variables
        // et celles qui sont envoyées dans la requête SQL (pour éviter les injections)
        $boundValues = [
            'idProduit' => $idProduit
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
    *
    * Calculer le nouveauStock des produits qui restent dans la BDD
    *
    * @param $idProduit identifiant du produit
    * @param $quantitéProduitsCommandes  = quantité de Produits Commandés
    *
    */
    public function calcStockProduits($idProduit ,$quantiteProduitsCommandes)
    {
        // On prépare notre requête SQL pour compter tous les produits en stock de la BDD
        $query = "SELECT count(*) FROM produits WHERE idProduit = :idProduit";

        // On prépare notre tableau faisant le "binding" entre les valeurs de nos variables
        // et celles qui sont envoyées dans la requête SQL (pour éviter les injections)
        $boundValues = [
            'idProduit' => $idProduit
        ];

        // On charge notre requête SQL dans la couche d'abstraction PDO
        $statement = $this->PDO->prepare($query);

        // On exécute notre requête SQL (en liant notre tableau de "binding")
        // $ancienStock = resultat de cette exécution
        $ancienStock = $statement->execute($boundValues);

        $nouveauStock = $ancienStock -$quantiteProduitsCommandes ;
        return $nouveauStock ;
    }

    /**************************************************************************************************************/
    /**************************************************************************************************************/
    /**************************************************************************************************************/

    /*
     * Crée un objet Produit_manager en récupérant ses propriétés à partir de la BDD
     *
     * @param  int    $idProduit  Identifiant de la Produit
     * @return mixed        Renvoie un objet Produit si le Produit existe, FALSE sinon
     */
    public function create($idProduit)
    {
        // Si aucun dragon n'existe avec cet identifiant
        if (!$this->exists($idProduit))
        {
            // On ne fait rien et on renvoie FALSE
            return false;
        }
        // Sinon (s'il existe)
        else
        {
            // On prépare notre requête SQL
            $query = "SELECT * FROM produits WHERE idProduit = :idProduit";

            // On prépare notre tableau faisant le "binding" entre les valeurs de nos               //variables
            // et celles qui sont envoyées dans la requête SQL (pour éviter les injections)
            $boundValues = [
                'idProduit' => $idProduit
            ];

            // On charge notre requête SQL dans la couche d'abstraction PDO
            $statement = $this->PDO->prepare($query);

            // On exécute notre requête SQL (en liant notre tableau de "binding")
            $statement->execute($boundValues);

            /* On récupère la ligne correspondante de la table "Produits" sous la forme                   d'un tableau*/

            $produitManagerArray = $statement->fetch();

            // On instancie notre classe ProduitManager pour créer un objet                            // produitManager
            // avec pour propriétés les données récupérées à partir de la BDD

           // $idProduit ,$refProduit, $nomProduit,$descriptionProduit , $stock

            $produitManagerObj = new ProduitManager($produitManagerArray['idProduit'],
                $produitManagerArray['refProduit'], $produitManagerArray['nomProduit'], $produitManagerArray['descriptionProduit'],$produitManagerArray['stock']);

            // On retourne notre objet Dragon
            return $produitManagerObj;
        }
    }


}
