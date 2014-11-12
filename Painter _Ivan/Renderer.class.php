<?php

abstract class Renderer
{
	// Tableau de chaînes de caractères.
	protected $results;

	// Tableau d'objets géométriques.
	private $shapes;


	abstract public function drawCircle(Point $origin, $color, $opacity, $radius);
	abstract public function drawEllipse(Point $origin, $color, $opacity, $xRadius, $yRadius);
	abstract public function drawRectangle(Point $origin, $color, $opacity, $width, $height);
	abstract public function getResults();


	public function __construct()
	{
		$this->results = array(); // pour créer 1 array vide
		$this->shapes  = array();
	}

	protected function addResult($result)
	{
		// Ajout d'une chaîne de caractères au tableau de chaînes.
		array_push($this->results, $result);
	}

	public function addShape(Shape $shape)
	{
		// Ajout d'un objet géométrique au tableau d'objets.
		array_push($this->shapes, $shape);
	}

	public function run()
	{
		// Boucle sur le tableau d'objets géométriques.
		foreach($this->shapes as $shape)
		{
            /** @type Shape $shape */

			// Chaque objet se dessine en utilisant nos propres méthodes (nous-même = this).
			$shape->draw($this);
		}
	}
}