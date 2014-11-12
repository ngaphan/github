<?php

// model/TauxTVA_manager.class.php

/**
 * Classe permettant de gérer les TauxTVA
 */
class TauxTVAManager extends Model
{
    /**
     * Récupère la liste des TauxTVA sous la forme d'un tableau à deux dimensions
     *
     * @return array Tableau à deux dimensions listant les TauxTVA
     */
    public function listAll()
    {
        // On prépare notre requête SQL
        $query = "SELECT * FROM tauxtva ORDER BY idTauxTVA";

        // On charge notre requête SQL dans la couche d'abstraction PDO
        $statement = $this->PDO->prepare($query);

        // On exécute notre requête SQL
        $statement->execute();

        // On retourne nos résultats SQL (liste des TauxTVAs)
        // sous la forme d'un tableau à deux dimensions
        return $statement->fetchAll();
    }

    /**
     * Ajoute un nouveau TauxTVA dans la BDD
     *
     * @param  string refTauxTVA          Réference du TauxTVA
     * @param  string nomTauxTVA          nom du TauxTVA
     * @param  string descriptionTauxTVA  description du TauxTVA
     * @return void
     */
    public function add($idTauxTVA ,$refTauxTVA, $valeurTauxTVA)
    {
        // On prépare notre requête SQL
        $query = "INSERT INTO tauxtva (idTauxTVA,refTauxTVA, valeurTauxTVA,) VALUES (:idTauxTVA,:refTauxTVA, :valeurTauxTVA)";

        // On prépare notre tableau faisant le "binding" entre les valeurs de nos variables
        // et celles qui sont envoyées dans la requête SQL (pour éviter les injections)
        $boundValues = [
            'idTauxTVA' => $idTauxTVA,
            'refTauxTVA' => $refTauxTVA,
            'valeurTauxTVA' => $valeurTauxTVA
        ];

        // On charge notre requête SQL dans la couche d'abstraction PDO
        $statement = $this->PDO->prepare($query);

        // On exécute notre requête SQL (en liant notre tableau de "binding")
        $statement->execute($boundValues);
    }

    /**
     * Supprime une TauxTVA de la BDD à partir de son identifiant
     *
     * @param  int    $idTauxTVA     Identifiant du TauxTVA
     * @return void
     */
    public function delete($idTauxTVA)
    {
        // On prépare notre requête SQL
        $query = "DELETE FROM tauxtva WHERE idTauxTVA = :idTauxTVA";

        // On prépare notre tableau faisant le "binding" entre les valeurs de nos variables
        // et celles qui sont envoyées dans la requête SQL (pour éviter les injections)
        $boundValues = [
            'idTauxTVA' => $idTauxTVA
        ];

        // On charge notre requête SQL dans la couche d'abstraction PDO
        $statement = $this->PDO->prepare($query);

        // On exécute notre requête SQL (en liant notre tableau de "binding")
        $statement->execute($boundValues);
    }

    /**
     * Crée un objet TauxTVA_manager en récupérant ses propriétés à partir de la BDD
     *
     * @param  int    $idTauxTVA  Identifiant de la TauxTVA
     * @return mixed 		Renvoie un objet TauxTVA si le TauxTVA existe, FALSE sinon
     */
    public function create($idTauxTVA)
    {
        // Si aucun dragon n'existe avec cet identifiant
        if (!$this->exists($idTauxTVA))
        {
            // On ne fait rien et on renvoie FALSE
            return false;
        }
        // Sinon (s'il existe)
        else
        {
            // On prépare notre requête SQL
            $query = "SELECT * FROM tauxtva WHERE idTauxTVA = :idTauxTVA";

            // On prépare notre tableau faisant le "binding" entre les valeurs de nos               //variables
            // et celles qui sont envoyées dans la requête SQL (pour éviter les injections)
            $boundValues = [
                'idTauxTVA' => $idTauxTVA
            ];

            // On charge notre requête SQL dans la couche d'abstraction PDO
            $statement = $this->PDO->prepare($query);

            // On exécute notre requête SQL (en liant notre tableau de "binding")
            $statement->execute($boundValues);

            /* On récupère la ligne correspondante de la table "TauxTVAs" sous la forme                   d'un tableau*/

            $tauxTVAManagerArray = $statement->fetch();

            // On instancie notre classe TauxTVAManager pour créer un objet                            // TauxTVAManager
            // avec pour propriétés les données récupérées à partir de la BDD

            // $idTauxTVA ,$refTauxTVA, $nomTauxTVA,$descriptionTauxTVA , $stock

            $tauxTVAManagerObj = new TauxTVAManager($tauxTVAManagerArray['idTauxTVA'],
                $tauxTVAManagerArray['refTauxTVA'], $tauxTVAManagerArray['valeurTauxTVA']);

            // On retourne notre objet Dragon
            return $tauxTVAManagerObj;
        }
    }

    /**
     * Contrôle s'il existe un TauxTVA ayant cet identifiant dans la BDD
     *
     * @param  int    $idTauxTVA    Identifiant du TauxTVA
     * @return bool                Renvoie TRUE si c'est le cas, FALSE sinon
     */
    public function exists($idTauxTVA)
    {
        // On prépare notre requête SQL
        $query = "SELECT * FROM tauxtva WHERE idTauxTVA = :idTauxTVA";

        // On prépare notre tableau faisant le "binding" entre les valeurs de nos variables
        // et celles qui sont envoyées dans la requête SQL (pour éviter les injections)
        $boundValues = [
            'idTauxTVA' => $idTauxTVA
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
