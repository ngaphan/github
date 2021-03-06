<?php

// model/Categorie_manager.class.php

/**
 * Classe permettant de gérer les armes
 */
class CategorieManager extends Model
{
    /**
     * Récupère la liste des Categories sous la forme d'un tableau à deux dimensions
     *
     * @return array Tableau à deux dimensions listant les Categories
     */
    public function listAllCategories()
    {
        // On prépare notre requête SQL
        $query = "SELECT * FROM categories ORDER BY idCategorie";

        // On charge notre requête SQL dans la couche d'abstraction PDO
        $statement = $this->PDO->prepare($query);

        // On exécute notre requête SQL
        $statement->execute();

        // On retourne nos résultats SQL (liste des Categories)
        // sous la forme d'un tableau à deux dimensions
        return $statement->fetchAll();
    }

    /**
     * Ajoute un nouveau Categorie dans la BDD
     *
     * @param  string refCategorie          Réference du Categorie
     * @param  string nomCategorie          nom du Categorie
     * @param  string descriptionCategorie  description du Categorie
     * @return void
     */
    public function add($idCategorie ,$refCategorie, $nomCategorie,$descriptionCategorie)
    {
        // On prépare notre requête SQL
        $query = "INSERT INTO categories (idCategorie,refCategorie, nomCategorie,descriptionCategorie) VALUES (:idCategorie,:refCategorie, :nomCategorie, :descriptionCategorie)";

        // On prépare notre tableau faisant le "binding" entre les valeurs de nos variables
        // et celles qui sont envoyées dans la requête SQL (pour éviter les injections)
        $boundValues = [
            'idCategorie' => $idCategorie,
            'refCategorie' => $refCategorie,
            'nomCategorie' => $nomCategorie,
            'descriptionCategorie' => $descriptionCategorie           
        ];

        // On charge notre requête SQL dans la couche d'abstraction PDO
        $statement = $this->PDO->prepare($query);

        // On exécute notre requête SQL (en liant notre tableau de "binding")
        $statement->execute($boundValues);
    }

    /**
     * Supprime une Categorie de la BDD à partir de son identifiant
     *
     * @param  int    $idCategorie     Identifiant du Categorie
     * @return void
     */
    public function delete($idCategorie)
    {
        // On prépare notre requête SQL
        $query = "DELETE FROM categories WHERE idCategorie = :idCategorie";

        // On prépare notre tableau faisant le "binding" entre les valeurs de nos variables
        // et celles qui sont envoyées dans la requête SQL (pour éviter les injections)
        $boundValues = [
            'idCategorie' => $idCategorie
        ];

        // On charge notre requête SQL dans la couche d'abstraction PDO
        $statement = $this->PDO->prepare($query);

        // On exécute notre requête SQL (en liant notre tableau de "binding")
        $statement->execute($boundValues);
    }

    /**
     * Crée un objet Categorie_manager en récupérant ses propriétés à partir de la BDD
     *
     * @param  int    $idCategorie  Identifiant de la Categorie
     * @return mixed 		Renvoie un objet Categorie si le Categorie existe, FALSE sinon
     */
    public function create($idCategorie)
    {
        // Si aucun dragon n'existe avec cet identifiant
        if (!$this->exists($idCategorie))
        {
            // On ne fait rien et on renvoie FALSE
            return false;
        }
        // Sinon (s'il existe)
        else
        {
            // On prépare notre requête SQL
            $query = "SELECT * FROM categories WHERE idCategorie = :idCategorie";

            // On prépare notre tableau faisant le "binding" entre les valeurs de nos               //variables
            // et celles qui sont envoyées dans la requête SQL (pour éviter les injections)
            $boundValues = [
                'idCategorie' => $idCategorie
            ];

            // On charge notre requête SQL dans la couche d'abstraction PDO
            $statement = $this->PDO->prepare($query);

            // On exécute notre requête SQL (en liant notre tableau de "binding")
            $statement->execute($boundValues);

            /* On récupère la ligne correspondante de la table "Categories" sous la forme                   d'un tableau*/

            $CategorieManagerArray = $statement->fetch();

            // On instancie notre classe CategorieManager pour créer un objet                            // CategorieManager
            // avec pour propriétés les données récupérées à partir de la BDD

           // $idCategorie ,$refCategorie, $nomCategorie,$descriptionCategorie , $stock

            $categorieManagerObj = new CategorieManager($categorieManagerArray['idCategorie'],
                $categorieManagerArray['refCategorie'], $categorieManagerArray['nomCategorie'], $categorieManagerArray['descriptionCategorie']);

            // On retourne notre objet Dragon
            return $categorieManagerObj;
        }
    }

    /**
     * Contrôle s'il existe un Categorie ayant cet identifiant dans la BDD
     *
     * @param  int    $idCategorie    Identifiant du Categorie
     * @return bool                Renvoie TRUE si c'est le cas, FALSE sinon
     */
    public function exists($idCategorie)
    {
        // On prépare notre requête SQL
        $query = "SELECT * FROM categories WHERE idCategorie = :idCategorie";

        // On prépare notre tableau faisant le "binding" entre les valeurs de nos variables
        // et celles qui sont envoyées dans la requête SQL (pour éviter les injections)
        $boundValues = [
            'idCategorie' => $idCategorie
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
