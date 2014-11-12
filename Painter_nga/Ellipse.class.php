<?php

class Ellipse extends Shape
{
	protected $xRadius;
	protected $yRadius;

	public function __construct()
	{
		// Appelle le constructeur de la classe parent, la classe Shape.
		parent::__construct();

		$this->xRadius = 0;
		$this->yRadius = 0;
	}

	public function draw(Renderer $renderer)
	{
		// Utilisation de l'objet renderer pour dessiner une ellipse avec ses propriétés.
		
		// ???

        // la methode 'drawEllipse'(defini dans "rendener" ) a besoin de 5 param :
        // Point $origin, $color, $opacity, $xRadius, $yRadius
        // $origin correspond à l'obj 'location' qu'on hérite de "shape"
        // puisqu'on a dejà nommé "location" dans "shape" , donc ici j'attache
        // "location" à cet obj $renderer ( mais on sait que c'est pour faire 'origin'

        $renderer->drawEllipse
            (
                $this->location,
                $this->color,
                $this->opacity,
                $this->xRadius,
                $this->yRadius

        );

	}

    // la methode 'drawEllipse'(defini dans "rendener" ) a besoin de 5 param :
    // Point $origin, $color, $opacity, $xRadius, $yRadius
    // dont 3 sont hérité de "sa mère shape" : Point $origin, $color, $opacity
    // et 2 restent : $xRadius, $yRadius à définir sur place ici(car ça concerne qu'ici)
    // Attention : le Point $origin n'est pas encore détaillé dans sa mère !
    // il était un obj créé par sa mère , mais c'est à la fille ici à détailler
    // ses valeur
    // d'où : on a 2 functions :setCenter ,setRadius

	public function setCenter($x, $y)
	{
		// Accès à la propriété origin
		// qui est un objet de la classe Point.
		
		// ???
        // j'attache la propriété 'location' à cette classe $this
        // Location est un obj de type Point.
        // Donc pour créer cet obj, faut lui attacher ces propriétés(x,y)
        // x et y qu'on attend dans les  param
        $this->location->x = $x ;
        $this->location->y = $y ;
	}

	public function setRadius($xRadius, $yRadius)
	{
		// ???
        // ces 2 proriétés (xRadius ,yRadius )sont déclarées en haut de cette classe
        // les valeurs de (xRadius ,yRadius ) qu'on attend en param
        $this->xRadius = $xRadius ;
        $this->yRadius = $yRadius ;
	}
}