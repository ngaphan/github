<?php

// model/dragon.class.php

/**
 * Classe représentant le "modèle" d'un dragon,
 * héritant de la classe Being (qui elle-même hérite de la classe Entity)
 */
class Dragon extends Being
{
  // Attributs de la classe Dragon
	private $force;

	public function __construct($id, $name, $lifeMax, $force)
	{
		$this->setForce($force);
		$this->setId($id);
		$this->setLife($lifeMax);
		$this->setLifeMax($lifeMax);
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
			echo 'Class Dragon : $force doit être un nombre entier positif.';
		}
    // Sinon (si elle est positive ou égale à 0)
		else
		{
      // On assigne la valeur de $force à la propriété "force" de l'objet en cours
			$this->force = $force;
		}
	}

	public function attack(Character $characterObject)
	{
		// On calcule les points de dégât
		$injuries = $this->getForce() - $characterObject->getArmor();
		
		// On calcule les points de vie restants
		// du personnage après l'attaque
		$characterNewLife = $characterObject->getLife() - $injuries;

		// Si le nombre de points vie restant est négatif
		if ($characterNewLife < 0)
		{
			// On les "limite" à 0
			$characterNewLife = 0;
		}

		// On met à jour les points de vie du personnage
		$characterObject->setLife($characterNewLife);

		// On retourne les points de dégât
		return $injuries;
	}
}