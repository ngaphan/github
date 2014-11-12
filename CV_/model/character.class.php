<?php

// model/character.class.php

/**
 * Classe représentant le "modèle" d'un personnage,
 * héritant de la classe Being (qui elle-même hérite de la classe Entity)
 */
class Character extends Being
{
  // Attributs de la classe Character
	private $armor;
	private $weapon;

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

  // Liste des accesseurs (getters) pour les attributs protégés ou privés
  // (protégé = accessible seulement au sein de cette classe et des classes qui en sont héritées)
  // (privé = accessible seulement au sein de cette classe)
	public function getArmor() { return $this->armor; }
	public function getWeapon() { return $this->weapon; }

  // Mutateur (setter) pour l'attribut privé $armor
	public function setArmor($armor)
	{
    // On transtype (cast) le paramètre $armor en nombre entier
		$armor = (int) $armor;
		
    // Si la valeur de $armor est négative
		if ($armor < 0)
		{
			echo 'Class Character : $armor doit être un nombre entier positif.';
		}
    // Sinon (si elle est positive ou égale à 0)
		else
		{
      // On assigne la valeur de $armor à la propriété "armor" de l'objet en cours
			$this->armor = $armor;
		}
	}

  // Mutateur (setter) pour l'attribut privé $weapon
	public function setWeapon(Weapon $weaponObject)
	{
    // On assigne la valeur de $weaponObject (un objet Weapon) à la propriété "weapon" de l'objet en cours
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
		
		// Si le nombre de points vie restant est négatif
		if ($dragonNewLife < 0)
		{
			// On les "limite" à 0
			$dragonNewLife = 0;
		}

		// On met à jour les points de vie du personnage
		$dragonObject->setLife($dragonNewLife);

		// On retourne les points de dégât
		return $injuries;
	}
}