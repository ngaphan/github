<?php

abstract class Shape
{
	protected $color;
    protected $opacity;
	protected $location;


	abstract public function draw(Renderer $renderer);

	public function __construct()
	{
		$this->color    = 'black';
        $this->opacity  = 1;
        $this->location = new Point();
        // propriété 'location' de cette class 'shape' est un obj créé de la class Point
        // les détails seront définits dans les classes filles (ex: rectangle)
	}

	public function setColor($color)
	{
		$this->color = $color;
	}

	public function setOpacity($opacity)
	{
		$this->opacity = $opacity;
	}
}
