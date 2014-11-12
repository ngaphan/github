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
	/** @var PDO Un objet PDO représentant la connexion à la BDD */
  protected $PDO;

	/**
   * Constructeur
   * 
   * @param PDO $PDO Un objet PDO représentant la connexion à la BDD
   */
  public function __construct($PDO)
	{
		$this->setDBConnection($PDO);
	}

	// Mutateur (setter) pour la propriété $DBConnectionObject
  protected function setDBConnection(PDO $PDO)
	{
    // On assigne la valeur de $PDO (un objet PDO) à la propriété "PDO" de l'objet en cours
		$this->PDO = $PDO;
	}
}
