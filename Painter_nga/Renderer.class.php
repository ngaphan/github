<?php

abstract class Renderer
{
	// Tableau de chaînes de caractères.
	protected $results; 
	// cette propriété appartient à la class Renderer


	// Tableau d'objets géométriques.
	private $shapes; 
	// cette propriété appartient à la class Renderer


	abstract public function drawCircle(Point $origin, $color, $opacity, $radius);
	abstract public function drawEllipse(Point $origin, $color, $opacity, $xRadius, $yRadius);
	abstract public function drawRectangle(Point $origin, $color, $opacity, $width, $height);
	abstract public function getResults();


	public function __construct()
	{
		$this->results = array();// création du tableau "résultats" qui est égale à un tableau vide
		$this->shapes  = array();
		// $this = moi même = la class Renderer
		// les 2 lignes au -dessus veulent dire que j'attache mes propriétés à moi même
	}


	protected function addResult($result)
	{
		// cette function est pour "Ajouter une chaîne de caractères au tableau de chaînes."
		array_push($this->results, $result);
		// faire quoi ? réponse :  array_push , ça veut dire : ranger-moi (quelque chose) dans ...
		// ranger où ? réponse : dans ( $this->results ),ça veut dire : dans le tableau $results de moi-même
		// ranger quoi ? réponse : $result que j'ai reçu en param
		// donc, ranger moi le $result que j'ai reçu en param dans le tableau $results 
		// créé dans la fonction construct just en haut
	}

	public function addShape(Shape $shape)
	{
		// Ajout d'un objet géométrique au tableau d'objets.
		array_push($this->shapes, $shape);
		// faire quoi ? réponse :  array_push , ça veut dire : ranger-moi (quelque chose) dans ...
		// ranger où ? réponse : dans ( $this->shapes ),ça veut dire : dans le tableau $shapes de moi-même
		// ranger quoi ? réponse : $result que j'ai reçu en param
		// donc, ranger moi le $result que j'ai reçu en param dans le tableau $results 
		// créé dans la fonction construct just en haut

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

/*
 * Explication de la fonction 'run'
 *
// $this->shapes: est un tableau de plusieurs "$shape" qui appartient à cette class
// foreach (= pour chaque) : cette fonction est pour lister ligne par ligne , 
// ($this->shapes as $shape) veut dire :chaque ligne représente 1 $shape
// foreach($this->shapes as $shape) = pour chaque ligne que j'ai listé (à partir du tableau $shapes)
// pour chaque $shape , je lui attache "une technique de dessiner" = la méthode "drawé"
// on appel la fonction "draw" qui est définie dans chaque class enfant(rectangle,ellipse...)
// en lui donnant 1 param $this ,$this ici veut dire que : "toutes les méthodes qu'on a pour dessiner".
// comme cette class possède les méthodes: "drawCircle" ,"drawEllipse" ,"drawRectangle" (tout en haut)
// donc , on envoie le tout comme 1 grande boite à outil(qui peut le plus peut le moins).
// Si qn veut dessiner un rectangle , il prend l'outil : drawRectangle ( pour le cas de la class Rectangle)

*/

	