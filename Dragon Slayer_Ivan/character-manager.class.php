<?php

class CharacterManager
{
	protected $DBConnection;

	public function __construct($DBConnection)
	{
		$this->setDBConnection($DBConnection);
	}

	public function setDBConnection(PDO $DBConnectionObject)
	{
		$this->DBConnection = $DBConnectionObject;
	}

	public function listAll()
	{
		$query = "SELECT * FROM characters ORDER BY characterName";
		$statement = $this->DBConnection->prepare($query);
		$statement->execute();

		return $statement->fetchAll();
	}

	public function add($characterName, $characterLifeMax, $characterArmor)
	{
		$query = "INSERT INTO characters (characterName, characterLifeMax, characterArmor) VALUES (:characterName, :characterLifeMax, :characterArmor)";

		$boundValues = [
			'characterName' => $characterName,
			'characterLifeMax' => $characterLifeMax,
			'characterArmor' => $characterArmor
		];

		$statement = $this->DBConnection->prepare($query);
		$statement->execute($boundValues);
	}

	public function delete($characterId)
	{
		$query = "DELETE FROM characters WHERE characterId = :characterId";

		$boundValues = [
			'characterId' => $characterId
		];

		$statement = $this->DBConnection->prepare($query);
		$statement->execute($boundValues);
	}

	public function create($characterId, Weapon $weaponObject)
	{
		$query = "SELECT * FROM characters WHERE characterId = :characterId";

		$boundValues = [
			'characterId' => $characterId
		];

		$statement = $this->DBConnection->prepare($query);
		$statement->execute($boundValues);

		if ($statement->rowCount() === 0)
		{
			return false;
		}
		else
		{
			$characterArray = $statement->fetch();
			$characterObject = new Character($characterArray['characterId'], $characterArray['characterName'], $characterArray['characterLifeMax'], $characterArray['characterArmor'], $weaponObject);

			return $characterObject;
		}
	}
}


