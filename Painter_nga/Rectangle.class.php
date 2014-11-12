<?php

class Rectangle extends Shape
{
	protected $height;
	protected $width;

	public function __construct()
	{
		// Appelle le constructeur de la classe parent, la classe Shape.
		parent::__construct();

		$this->height = 0;
		$this->width  = 0;
	}

	public function draw(Renderer $renderer)
	{
		// Utilisation de l'objet renderer pour dessiner un rectangle avec ses propriétés.
		
		// ???
        // la methode 'drawRectangle'(defini dans "rendener" ) a besoin de 5 param :
        // Point $origin, $color, $opacity, $width, $height
        // $origin correspond à l'obj 'location' qu'on hérite de "shape"
        // puisqu'on a dejà nommé "location" dans "shape" , donc ici j'attache
        // "location" à cet obj $renderer ( mais on sait que c'est pour faire 'origin'

        $renderer->drawRectangle
            (
                $this->location,
                $this->color ,
                $this->opacity,
                $this->width,
                $this->height
            );
	}

    // la methode 'drawRectangle'(defini dans "rendener" ) a besoin de  param :
    // Point $origin, $color, $opacity, $width, $height
    // dont 3 sont hérité de "sa mère shape" : Point $origin, $color, $opacity
    // et 2 restent : $width, $height à définir sur place ici(car ça concerne qu'ici)
    // Attention : le Point $origin n'est pas encore détaillé dans sa mère !
    // il était un obj créé par sa mère , mais c'est à la fille ici à détailler
    // ses valeur
    // d'où : on a 2 functions :setOrigin ,setSize

	public function setOrigin($x, $y)
	{
		// Accès à la propriété origin(~~ location dans "shape" )
		// qui est un objet de la classe Point.

		// ???

        // j'attache la propriété 'location' à cette classe $this
        // Location est un obj de type Point.
        // Donc pour créer cet obj, faut lui attacher ces propriétés(x,y)
        // x et y qu'on attend dans les  param

        $this->location->x = $x;
        $this->location->y = $y;
	}

	public function setSize($width, $height)
	{
		// ???

        // ces 2 proriétés (width ,height )sont déclarées en haut de cette classe
        // les valeurs de (width ,height ) qu'on attend en param
        $this->width = $width ;
        $this->height = $height ;
	}
}