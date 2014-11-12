<?php

// model/model.class.php

/**
 * Classe mère permettant de faire de la composition en utilisant
 * le constructeur pour attacher l'objet représentant la connexion à la BDD
 * à la propriété $PDO des modèles ayant besoin d'effectuer des requêtes SQL
 *
 * Cette classe est déclarée en tant que classe abstraite (abstract)
 * pour éviter qu'on puisse l'instancier directement (= créer un objet type Model)
 *
 * @abstract
 */
abstract class Model
{
  protected $SQLQueryManager;// prpopriété

	/**
   * Constructeur
   * 
   * @param PDO $PDO Un objet PDO représentant la connexion à la BDD
   */
  public function __construct($PDO)
	{
        $SQLQueryManager = new SQLQueryManager($PDO);
        // variable local , cré Obj $SQLQueryManager = new SQLQueryManager($PDO);
		$this->setSQLQueryManager($SQLQueryManager);
        //
	}

  // Mutateur (setter) pour la propriété $SQLQueryManager
  protected function setSQLQueryManager(SQLQueryManager $SQLQueryManager)
  {
    // On assigne la valeur de $SQLQueryManager (un objet SQLQueryManager)
    // à la propriété "SQLQueryManager" de l'objet en cours
    $this->SQLQueryManager = $SQLQueryManager;

    // on attache l'obj SQLQueryManager à cette propriété
    // cet obj SQLQueryManager lui meme est 1 obj de type " SQLQueryManager "
  }

  public function listAll()
  {
    return $this->SQLQueryManager->select($this->table);
    // je n'ai pas encore créé la propriété $table , mais j'écris ici ($this->table )
    // car je prévoir que dans la class fille , elle a besoin de cette propriété
    //
  }

  /**
   * Contrôle s'il existe un élément ayant cet identifiant dans la BDD
   * 
   * @param  int    $id     Identifiant à rechercher
   * @return bool           Renvoie TRUE si c'est le cas, FALSE sinon
   */
  public function exists($id)
  {
    $queryResults = $this->SQLQueryManager->select($this->table, [$this->tableIdColumn => $id]);

    // S'il n'y a aucun enregistrement dans la BDD
    if (count($queryResults) === 0)
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
   * Supprime l'élément d'une table dans la BDD (à partir de l'identifiant $id)
   * 
   * @param  int  $id Identifiant à rechercher
   * @return void
   */
  public function remove($id)
  {
    $this->SQLQueryManager->delete($this->table, [$this->tableIdColumn => $id]);
  }
}
