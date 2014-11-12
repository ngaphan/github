<?php

// model/weapon.class.php

/**
 * Classe représentant le "modèle" d'une arme,
 * héritant de la classe Entity
 */
class Weapon extends Entity
{
  // Attributs de la classe Weapon
	private $force;

	public function __construct($id, $name, $force)
	{
		$this->setForce($force);
		$this->setId($id);
		$this->setName($name);
	}

  // Liste des accesseurs (getters) pour les attributs protégés ou privés
  // (protégé = accessible seulement au sein de cette classe et des classes qui en sont héritées)
  // (privé = accessible seulement au sein de cette classe)
	public function getForce() { return $this->force; }

  // Mutateur (setter) pour l'attribut privé $force
	public function setForce($force)
	{
    // On transtype (cast) le paramètre $force en nombre entier
		$force = (int) $force;
		
    // Si la valeur de $force est négative
		if ($force < 0)
		{
			echo 'Class Weapon : $force doit être un nombre entier positif.';
		}
    // Sinon (si elle est positive ou égale à 0)
		else
		{
      // On assigne la valeur de $force à la propriété "force" de l'objet en cours
			$this->force = $force;
		}
	}
}