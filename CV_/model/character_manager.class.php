<?php

// model/character_manager.class.php

/**
 * Classe permettant de gérer les personnages
 */
class CharacterManager extends Model
{
	/**
   * Récupère la liste des personnages sous la forme d'un tableau à deux dimensions
   * 
   * @return array Tableau à deux dimensions listant les personnages
   */
	public function listAll()
	{
    // On prépare notre requête SQL
		$query = "SELECT * FROM characters ORDER BY characterName";
    
    // On charge notre requête SQL dans la couche d'abstraction PDO
		$statement = $this->PDO->prepare($query);

    // On exécute notre requête SQL
		$statement->execute();

		// On retourne nos résultats SQL (liste des personnages)
		// sous la forme d'un tableau à deux dimensions
		return $statement->fetchAll();
	}

  /**
   * Ajoute un nouvel utilisateur dans la BDD
   * 
   * @param  string $characterName    Nom du personnage
   * @param  string $characterLifeMax Vie max. du personnage
   * @param  string $characterArmor   Armure du personnage
   * @return void
   */
	public function add($characterName, $characterLifeMax, $characterArmor)
	{
    // On prépare notre requête SQL
		$query = "INSERT INTO characters (characterName, characterLifeMax, characterArmor) VALUES (:characterName, :characterLifeMax, :characterArmor)";
		
    // On prépare notre tableau faisant le "binding" entre les valeurs de nos variables
    // et celles qui sont envoyées dans la requête SQL (pour éviter les injections)
		$boundValues = [
			'characterName' => $characterName,
			'characterLifeMax' => $characterLifeMax,
			'characterArmor' => $characterArmor
		];

    // On charge notre requête SQL dans la couche d'abstraction PDO
		$statement = $this->PDO->prepare($query);

    // On exécute notre requête SQL (en liant notre tableau de "binding")
    $statement->execute($boundValues);
	}

  /**
   * Supprime un personnage de la BDD à partir de son identifiant
   * 
   * @param  int    $characterId  Identifiant du personnage
   * @return void
   */
	public function delete($characterId)
	{
    // On prépare notre requête SQL
		$query = "DELETE FROM characters WHERE characterId = :characterId";
		
    // On prépare notre tableau faisant le "binding" entre les valeurs de nos variables
    // et celles qui sont envoyées dans la requête SQL (pour éviter les injections)
		$boundValues = [
			'characterId' => $characterId
		];

    // On charge notre requête SQL dans la couche d'abstraction PDO
		$statement = $this->PDO->prepare($query);

    // On exécute notre requête SQL (en liant notre tableau de "binding")
    $statement->execute($boundValues);
	}

  /**
   * Crée un objet Character en récupérant ses propriétés à partir de la BDD
   * 
   * @param  int    $dragonId Identifiant du personnage
   * @return mixed 					  Renvoie un objet Character si le personnage existe, FALSE sinon
   */
	public function create($characterId, Weapon $weaponObject)
	{
    // Si aucun personnage n'existe avec cet identifiant
		if (!$this->exists($characterId))
		{
      // On ne fait rien et on renvoie FALSE
			return false;
		}
		// Sinon (s'il existe)
		else
		{
	    // On prépare notre requête SQL
			$query = "SELECT * FROM characters WHERE characterId = :characterId";
			
	    // On prépare notre tableau faisant le "binding" entre les valeurs de nos variables
	    // et celles qui sont envoyées dans la requête SQL (pour éviter les injections)
			$boundValues = [
				'characterId' => $characterId
			];

	    // On charge notre requête SQL dans la couche d'abstraction PDO
			$statement = $this->PDO->prepare($query);

      // On exécute notre requête SQL (en liant notre tableau de "binding")
      $statement->execute($boundValues);
			
			// On récupère la ligne correspondante de la table "characters" sous la forme d'un tableau
			$characterArray = $statement->fetch();

			// On instancie notre classe Character pour créer un objet Character
			// avec pour propriétés les données récupérées à partir de la BDD
			$characterObject = new Character($characterArray['characterId'], $characterArray['characterName'], $characterArray['characterLifeMax'], $characterArray['characterArmor'], $weaponObject);

			// On retourne notre objet Character
			return $characterObject;
		}
	}

  /**
   * Contrôle s'il existe un personnage ayant cet identifiant dans la BDD
   * 
   * @param  int    $characterId   Identifiant du personnage
   * @return bool                  Renvoie TRUE si c'est le cas, FALSE sinon
   */
	public function exists($characterId)
	{
    // On prépare notre requête SQL
		$query = "SELECT * FROM characters WHERE characterId = :characterId";
		
    // On prépare notre tableau faisant le "binding" entre les valeurs de nos variables
    // et celles qui sont envoyées dans la requête SQL (pour éviter les injections)
		$boundValues = [
			'characterId' => $characterId
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
