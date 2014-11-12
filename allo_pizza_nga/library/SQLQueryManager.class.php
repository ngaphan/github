<?php

// class/SQLQueryManager.class.php

/**
 * Classe mère permettant de faire de la composition en utilisant
 * le constructeur pour attacher l'objet représentant la connexion à la BDD
 * à la propriété $PDO des modèles ayant besoin d'effectuer des requêtes SQL
 *
 * Cette classe est déclarée en tant que classe abstraite (abstract)
 * pour éviter qu'on puisse l'instancier directement (= créer un objet type Model)
 */
class SQLQueryManager
{  
  /** @var PDO Un objet PDO représentant la connexion à la BDD */
  private $PDO;

  /**
   * Constructeur
   * 
   * @param PDO $PDO Un objet PDO représentant la connexion à la BDD
   */
  public function __construct($PDO)
  {
    $this->setPDO($PDO);
  }

  // Mutateur (setter) pour la propriété $DBConnectionObject
  protected function setPDO(PDO $PDO)
  {
    // On assigne la valeur de $PDO (un objet PDO) à la propriété "PDO" de l'objet en cours
    $this->PDO = $PDO;
  }
  
  /**
   * Retourne le jeu d'enregistrements d'une table de la BDD
   * sous la forme d'un tableau à deux dimensions
   * 
   * @param  string  $whereArray     Tableau du "WHERE"
   * @param  string  $orderBy        Nom de colonne de tri
   * @param  integer $limit          Nombre de résultats
   * @param  integer $offset         Décalage (à partir du n-ième résultat)
   * @return array                   Tableau à deux dimensions listant les catégories
   */
  public function select($table, $whereArray = [], $orderBy = null, $limit = null, $offset = 0)
  {
    // On prépare la requête SQL
    $query = "SELECT * FROM " . $table;

    // On prépare le tableau faisant le "binding" entre les valeurs de nos variables
    // et celles qui sont envoyées dans la requête SQL (pour éviter les injections)
    $boundValues = [];

    if (count($whereArray) != 0)
    {
      // On complète la requête SQL
      $query .= " WHERE ";

      foreach ($whereArray as $column => $value)
      {
        // On complète la requête SQL
        $query .= $column . " = :" . $column . ' AND ';

        // On complète le "binding"
        $boundValues[$column] = $value;
      }

      // On supprime le dernier " AND " (qui est en trop)
      $query = substr($query, 0, strlen($query)-5);
    }

    if (!is_null($orderBy))
    {
      // On complète la requête SQL
      $query .= " ORDER BY :orderBy";
      
      // On complète le "binding"
      $boundValues['orderBy'] = $orderBy;
    }

    if (!is_null($limit))
    {
      // On complète la requête SQL
      $query .= " LIMIT :offset, :limit";
      
      // On complète le "binding"
      $boundValues['offset'] = $offset;
      $boundValues['limit'] = $limit;
    }

    // On charge la requête SQL dans la couche d'abstraction PDO
    $statement = $this->PDO->prepare($query);

    // On exécute la requête SQL
    $statement->execute($boundValues);

    // On retourne les résultats SQL (liste des catégories)
    // sous la forme d'un tableau à deux dimensions
    return $statement->fetchAll();
  }

  /**
   * Insère un nouvel élément dans $table de la BDD
   * 
   * @param  string $table       Nom de la table
   * @param  string $valuesArray Tableau des associations "colonne => valeur" à insérer
   * @return int                 Retourne l' identifiant de l'élément inséré
   */
  public function insert($table, $valuesArray)
  {
    // On prépare la requête SQL
    $query = "INSERT INTO " . $table . " (";
    
    // On prépare le tableau faisant le "binding" entre les valeurs de nos variables
    // et celles qui sont envoyées dans la requête SQL (pour éviter les injections)
    $boundValues = [];

    // On complète la requête SQL en ajoutant l'ensemble des colonnes
    // dans lesquelles insérer nos valeurs
    foreach ($valuesArray as $column => $value)
    {
      $query .= $column . ", ";
    }

    // On supprime le dernier ", " (qui est en trop)
    $query = substr($query, 0, strlen($query)-2);

    // On complète la requête SQL
    $query .= ") VALUES (";
    
    // On complète la requête SQL en ajoutant l'ensemble des valeurs à insérer
    foreach ($valuesArray as $column => $value)
    {
      // On complète la requête SQL
      $query .= ":" . $column . ", ";

      // On complète le "binding"
      $boundValues[$column] = $value;
    }
    
    // On supprime le dernier ", " (qui est en trop)
    $query = substr($query, 0, strlen($query)-2);

    // On complète la requête SQL
    $query .= ")";

    // On charge la requête SQL dans la couche d'abstraction PDO
    $statement = $this->PDO->prepare($query);

    // On exécute la requête SQL (en liant le tableau de "binding")
    $statement->execute($boundValues);

    // On retourne l'identifiant de l'élément inséré
    return $this->PDO->lastInsertId();
  }

  /**
   * Supprime un personnage de la BDD à partir de son identifiant
   * 
   * @param  string $table       Nom de la table
   * @param  array $whereArray Tableau du "WHERE"
   * @return void
   */
  public function delete($table, $whereArray)
  {
    // On prépare la requête SQL
    $query = "DELETE FROM " . $table . " WHERE ";
    
    // On prépare le tableau faisant le "binding" entre les valeurs de nos variables
    // et celles qui sont envoyées dans la requête SQL (pour éviter les injections)
    $boundValues = [];

    foreach ($whereArray as $column => $value)
    {
      // On complète la requête SQL
      $query .= $column . " = :" . $column . " AND ";

      // On complète le "binding"
      $boundValues[$column] = $value;
    }

    // On supprime le dernier " AND " (qui est en trop)
    $query = substr($query, 0, strlen($query)-5);

    // On charge la requête SQL dans la couche d'abstraction PDO
    $statement = $this->PDO->prepare($query);

    // On exécute la requête SQL (en liant le tableau de "binding")
    $statement->execute($boundValues);
  }

  /**
   * Exécute directement une requête SQL
   * 
   * @param  string $query         Requête SQL
   * @param  array  $boundValues   Tableau du "binding" SQL
   * @param  bool   $returnResults Renvoyer un jeu d'enregistrements ? (true: oui, false: non)
   * @return mixed                 Peut renvoyer un résultat si $returnResults est défini à true
   */
  public function query($query, $boundValues, $returnResults = false)
  {
    // On charge la requête SQL dans la couche d'abstraction PDO
    $statement = $this->PDO->prepare($query);

    // On exécute la requête SQL (en liant le tableau de "binding")
    $statement->execute($boundValues);

    // Si le paramètre $returnResults est défini à true
    if ($returnResults)
    {
      // On retourne les résultats SQL (liste des catégories)
      // sous la forme d'un tableau à deux dimensions
      return $statement->fetchAll();
    }
  }
}
