<?php

// model/weapon_manager.class.php

/**
 * Classe permettant de gérer les armes
 */
class WeaponManager extends Model
{
	/**
   * Récupère la liste des armes sous la forme d'un tableau à deux dimensions
   * 
   * @return array Tableau à deux dimensions listant les armes
   */
	public function listAll()
	{
    // On prépare notre requête SQL
		$query = "SELECT * FROM weapons ORDER BY weaponName";

    // On charge notre requête SQL dans la couche d'abstraction PDO
		$statement = $this->PDO->prepare($query);

    // On exécute notre requête SQL
    $statement->execute();

		// On retourne nos résultats SQL (liste des armes)
		// sous la forme d'un tableau à deux dimensions
		return $statement->fetchAll();
	}

  /**
   * Ajoute une nouvelle arme dans la BDD
   * 
   * @param  string $weaponName    Nom de l'arme
   * @param  string $weaponForce   Force de l'arme
   * @return void
   */
	public function add($weaponName, $weaponForce)
	{
    // On prépare notre requête SQL
		$query = "INSERT INTO weapons (weaponName, weaponForce) VALUES (:weaponName, :weaponForce)";
		
    // On prépare notre tableau faisant le "binding" entre les valeurs de nos variables
    // et celles qui sont envoyées dans la requête SQL (pour éviter les injections)
		$boundValues = [
			'weaponName' => $weaponName,
			'weaponForce' => $weaponForce
		];

    // On charge notre requête SQL dans la couche d'abstraction PDO
		$statement = $this->PDO->prepare($query);

    // On exécute notre requête SQL (en liant notre tableau de "binding")
    $statement->execute($boundValues);
	}

  /**
   * Supprime une arme de la BDD à partir de son identifiant
   * 
   * @param  int    $weaponId     Identifiant de l'arme
   * @return void
   */
	public function delete($weaponId)
	{
    // On prépare notre requête SQL
		$query = "DELETE FROM weapons WHERE weaponId = :weaponId";
		
    // On prépare notre tableau faisant le "binding" entre les valeurs de nos variables
    // et celles qui sont envoyées dans la requête SQL (pour éviter les injections)
		$boundValues = [
			'weaponId' => $weaponId
		];

    // On charge notre requête SQL dans la couche d'abstraction PDO
		$statement = $this->PDO->prepare($query);

    // On exécute notre requête SQL (en liant notre tableau de "binding")
    $statement->execute($boundValues);
	}

  /**
   * Crée un objet Weapon en récupérant ses propriétés à partir de la BDD
   * 
   * @param  int    $weaponId Identifiant de l'arme
   * @return mixed 					  Renvoie un objet Weapon si l'arme existe, FALSE sinon
   */
	public function create($weaponId)
	{
    // Si aucune arme n'existe avec cet identifiant
		if (!$this->exists($weaponId))
		{
      // On ne fait rien et on renvoie FALSE
			return false;
		}
		// Sinon (si elle existe)
		else
		{
	    // On prépare notre requête SQL
			$query = "SELECT * FROM weapons WHERE weaponId = :weaponId";
			
	    // On prépare notre tableau faisant le "binding" entre les valeurs de nos variables
	    // et celles qui sont envoyées dans la requête SQL (pour éviter les injections)
			$boundValues = [
				'weaponId' => $weaponId
			];

	    // On charge notre requête SQL dans la couche d'abstraction PDO
			$statement = $this->PDO->prepare($query);

    // On exécute notre requête SQL (en liant notre tableau de "binding")
    $statement->execute($boundValues);

			// On récupère la ligne correspondante de la table "characters" sous la forme d'un tableau
			$weaponArray = $statement->fetch();
			
			// On instancie notre classe Weapon pour créer un objet Weapon
			// avec pour propriétés les données récupérées à partir de la BDD
			$weaponObject = new Weapon($weaponArray['weaponId'], $weaponArray['weaponName'], $weaponArray['weaponForce']);

			// On retourne notre objet Weapon
			return $weaponObject;
		}
	}

  /**
   * Contrôle s'il existe une arme ayant cet identifiant dans la BDD
   * 
   * @param  int    $weaponId    Identifiant de l'arme
   * @return bool                Renvoie TRUE si c'est le cas, FALSE sinon
   */
	public function exists($weaponId)
	{
    // On prépare notre requête SQL
		$query = "SELECT * FROM weapons WHERE weaponId = :weaponId";
		
    // On prépare notre tableau faisant le "binding" entre les valeurs de nos variables
    // et celles qui sont envoyées dans la requête SQL (pour éviter les injections)
		$boundValues = [
			'weaponId' => $weaponId
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
