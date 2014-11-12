<?php

// model/prix_manager.class.php

/**
 * Classe permettant de gérer les prix
 */
class PrixManager extends Model
{
    /**
     * Récupère la liste des prix sous la forme d'un tableau à deux dimensions
     *
     * @return array Tableau à deux dimensions listant les prix
     */
    public function listAll()
    {
        // On prépare notre requête SQL
        $query = "SELECT * FROM prix ORDER BY idPrix";

        // On charge notre requête SQL dans la couche d'abstraction PDO
        $statement = $this->PDO->prepare($query);

        // On exécute notre requête SQL
        $statement->execute();

        // On retourne nos résultats SQL (liste des prixs)
        // sous la forme d'un tableau à deux dimensions
        return $statement->fetchAll();
    }

    /**
     * Ajoute un nouveau Prix dans la BDD
     * @return void
     */

    public function add($idPrix ,$refProduit, $prix , $refTauxTVA)
    {
        // On prépare notre requête SQL
        $query = "INSERT INTO prix (idPrix,refProduit, prix, refTauxTVA) VALUES (:idPrix,:refProduit, :prix , :refTauxTVA)";

        // On prépare notre tableau faisant le "binding" entre les valeurs de nos variables
        // et celles qui sont envoyées dans la requête SQL (pour éviter les injections)
        $boundValues = [
            'idPrix' => $idPrix,
            'refProduit' => $refProduit,
            'prix' => $prix,
            'refTauxTVA' => $refTauxTVA
        ];

        // On charge notre requête SQL dans la couche d'abstraction PDO
        $statement = $this->PDO->prepare($query);

        // On exécute notre requête SQL (en liant notre tableau de "binding")
        $statement->execute($boundValues);
    }

    /**
     * Supprime une Prix de la BDD à partir de son identifiant
     *
     * @param  int    $idPrix     Identifiant du Prix
     * @return void
     */
    public function delete($idPrix)
    {
        // On prépare notre requête SQL
        $query = "DELETE FROM prix WHERE idPrix = :idPrix";

        // On prépare notre tableau faisant le "binding" entre les valeurs de nos variables
        // et celles qui sont envoyées dans la requête SQL (pour éviter les injections)
        $boundValues = [
            'idPrix' => $idPrix
        ];

        // On charge notre requête SQL dans la couche d'abstraction PDO
        $statement = $this->PDO->prepare($query);

        // On exécute notre requête SQL (en liant notre tableau de "binding")
        $statement->execute($boundValues);
    }

    /**
     * Crée un objet prix_manager en récupérant ses propriétés à partir de la BDD
     *
     * @param  int    $idPrix  Identifiant de la Prix
     * @return mixed 		Renvoie un objet Prix si le Prix existe, FALSE sinon
     */
    public function create($idPrix)
    {
        // Si aucun dragon n'existe avec cet identifiant
        if (!$this->exists($idPrix))
        {
            // On ne fait rien et on renvoie FALSE
            return false;
        }
        // Sinon (s'il existe)
        else
        {
            // On prépare notre requête SQL
            $query = "SELECT * FROM prix WHERE idPrix = :idPrix";

            // On prépare notre tableau faisant le "binding" entre les valeurs de nos               //variables
            // et celles qui sont envoyées dans la requête SQL (pour éviter les injections)
            $boundValues = [
                'idPrix' => $idPrix
            ];

            // On charge notre requête SQL dans la couche d'abstraction PDO
            $statement = $this->PDO->prepare($query);

            // On exécute notre requête SQL (en liant notre tableau de "binding")
            $statement->execute($boundValues);

            /* On récupère la ligne correspondante de la table "prixs" sous la forme                   d'un tableau*/

            $prixManagerArray = $statement->fetch();

            // On instancie notre classe prixManager pour créer un objet                            // prixManager
            // avec pour propriétés les données récupérées à partir de la BDD

            // $idprix ,$refprix, $nomprix,$descriptionprix , $stock

            $prixManagerObj = new PrixManager($prixManagerArray['idPrix'],
                $prixManagerArray['refProduit'], $prixManagerArray['prix'], $prixManagerArray['refTauxTVA']);

            // On retourne notre objet Dragon
            return $prixManagerObj;
        }
    }

    /**
     * Contrôle s'il existe un prix ayant cet identifiant dans la BDD
     *
     * @param  int    $idprix    Identifiant du prix
     * @return bool                Renvoie TRUE si c'est le cas, FALSE sinon
     */
    public function exists($idPrix)
    {
        // On prépare notre requête SQL
        $query = "SELECT * FROM prix WHERE idPrix = :idPrix";

        // On prépare notre tableau faisant le "binding" entre les valeurs de nos variables
        // et celles qui sont envoyées dans la requête SQL (pour éviter les injections)
        $boundValues = [
            'idPrix' => $idPrix
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
