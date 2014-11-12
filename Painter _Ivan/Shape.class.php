<?php

abstract class Shape
{
	protected $color;
	protected $location;
  protected $opacity;

	abstract public function draw(Renderer $renderer);

	public function __construct()
	{
		$this->color    = 'black';
    $this->location = new Point();
		$this->opacity  = 1;
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
