<?php
class Character extends Being
{
	protected $armor;
	protected $weapon;

	public function __construct($id, $name, $lifeMax, $armor, $weapon = null)
	{
		$this->setArmor($armor);
		$this->setId($id);
		$this->setLife($lifeMax);
		$this->setLifeMax($lifeMax);
		$this->setName($name);

		if (!is_null($weapon))
		{
			$this->setWeapon($weapon);
		}
	}

	public function getArmor() { return $this->armor; }
	public function getWeapon() { return $this->weapon; }

	public function setArmor($armor)
	{
		$armor = (int) $armor;

		if ($armor < 0)
		{
			echo 'Class Character : $armor doit être un nombre entier positif.';
		}
		else
		{
			$this->armor = $armor;
		}
	}

	public function setWeapon(Weapon $weaponObject)
	{
		$this->weapon = $weaponObject;
	}

	public function attack(Dragon $dragonObject)
	{
		// On calcule les points de dégât
		$injuries = $this->weapon->getForce();

		// On calcule les points de vie restants
		// du personnage après l'attaque
		//echo $dragonObject->getLife();
		$dragonNewLife = $dragonObject->getLife() - $injuries;
		//echo $dragonNewLife;

		// Si le nombre de points vie restant est négatif, on les "limite" à 0
		if ($dragonNewLife < 0)
		{
			$dragonNewLife = 0;
		}

		// On met à jour les points de vie du personnage
		$dragonObject->setLife($dragonNewLife);

		// On retourne les point de dégât
		return $injuries;
	}
}


