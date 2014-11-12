<?php

// model/dragon_manager.class.php

/**
 * Classe permettant de gérer les dragons
 */
class DragonManager extends Model
{
	/**
   * Récupère la liste des dragons sous la forme d'un tableau à deux dimensions
   * 
   * @return array Tableau à deux dimensions listant les dragons
   */
  public function listAll()
	{
    // On prépare notre requête SQL
		$query = "SELECT * FROM dragons ORDER BY dragonName";
    
    // On charge notre requête SQL dans la couche d'abstraction PDO
		$statement = $this->PDO->prepare($query);

    // On exécute notre requête SQL
		$statement->execute();

		// On retourne nos résultats SQL (liste des dragons)
    // sous la forme d'un tableau à deux dimensions
		return $statement->fetchAll();
	}

  /**
   * Ajoute un nouvel utilisateur dans la BDD
   * 
   * @param  string $dragonName    Nom du dragon
   * @param  string $dragonLifeMax Vie max. du dragon
   * @param  string $dragonForce   Force du dragon
   * @return void
   */
	public function add($dragonName, $dragonLifeMax, $dragonForce)
	{
    // On prépare notre requête SQL
		$query = "INSERT INTO dragons (dragonName, dragonLifeMax, dragonForce) VALUES (:dragonName, :dragonLifeMax, :dragonForce)";
		
    // On prépare notre tableau faisant le "binding" entre les valeurs de nos variables
    // et celles qui sont envoyées dans la requête SQL (pour éviter les injections)
		$boundValues = [
			'dragonName' => $dragonName,
			'dragonLifeMax' => $dragonLifeMax,
			'dragonForce' => $dragonForce
		];

    // On charge notre requête SQL dans la couche d'abstraction PDO
		$statement = $this->PDO->prepare($query);
		
    // On exécute notre requête SQL (en liant notre tableau de "binding")
    $statement->execute($boundValues);
	}

  /**
   * Supprime un dragon de la BDD à partir de son identifiant
   * 
   * @param  int    $dragonId     Identifiant du dragon
   * @return void
   */
	public function delete($dragonId)
	{
    // On prépare notre requête SQL
		$query = "DELETE FROM dragons WHERE dragonId = :dragonId";
		
    // On prépare notre tableau faisant le "binding" entre les valeurs de nos variables
    // et celles qui sont envoyées dans la requête SQL (pour éviter les injections)
		$boundValues = [
			'dragonId' => $dragonId
		];

    // On charge notre requête SQL dans la couche d'abstraction PDO
		$statement = $this->PDO->prepare($query);
		
    // On exécute notre requête SQL (en liant notre tableau de "binding")
    $statement->execute($boundValues);
	}

  /**
   * Crée un objet Dragon en récupérant ses propriétés à partir de la BDD
   * 
   * @param  int    $dragonId Identifiant du dragon
   * @return mixed 					  Renvoie un objet Dragon si le dragon existe, FALSE sinon
   */
	public function create($dragonId)
	{
    // Si aucun dragon n'existe avec cet identifiant
		if (!$this->exists($dragonId))
		{
      // On ne fait rien et on renvoie FALSE
			return false;
		}
		// Sinon (s'il existe)
		else
		{
	    // On prépare notre requête SQL
			$query = "SELECT * FROM dragons WHERE dragonId = :dragonId";
			
	    // On prépare notre tableau faisant le "binding" entre les valeurs de nos variables
	    // et celles qui sont envoyées dans la requête SQL (pour éviter les injections)
			$boundValues = [
				'dragonId' => $dragonId
			];

	    // On charge notre requête SQL dans la couche d'abstraction PDO
			$statement = $this->PDO->prepare($query);
			
      // On exécute notre requête SQL (en liant notre tableau de "binding")
      $statement->execute($boundValues);

			// On récupère la ligne correspondante de la table "dragons" sous la forme d'un tableau
			$dragonArray = $statement->fetch();
			
			// On instancie notre classe Dragon pour créer un objet Dragon
			// avec pour propriétés les données récupérées à partir de la BDD
			$dragonObject = new Dragon($dragonArray['dragonId'], $dragonArray['dragonName'], $dragonArray['dragonLifeMax'], $dragonArray['dragonForce']);

			// On retourne notre objet Dragon
			return $dragonObject;
		}
	}

  /**
   * Contrôle s'il existe un dragon ayant cet identifiant dans la BDD
   * 
   * @param  int    $dragonId    Identifiant du dragon
   * @return bool                Renvoie TRUE si c'est le cas, FALSE sinon
   */
	public function exists($dragonId)
	{
    // On prépare (= "charge") notre requête SQL dans la couche d'abstraction PDO
		$query = "SELECT * FROM dragons WHERE dragonId = :dragonId";
		
    // On prépare notre tableau faisant le "binding" entre les valeurs de nos variables
    // et celles qui sont envoyées dans la requête SQL (pour éviter les injections)
		$boundValues = [
			'dragonId' => $dragonId
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
