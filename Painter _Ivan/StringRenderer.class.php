<?php

class StringRenderer extends Renderer
{
	public function drawCircle(Point $origin, $color, $opacity, $radius)
	{
		// Ajout d'une chaîne décrivant un cercle.
		$this->addResult
		(
			"Drawing a $color circle with opacity $opacity at ".
			"($origin->x,$origin->y) ".
			"with radius $radius."
		);
	}

	public function drawEllipse(Point $origin, $color, $opacity, $xRadius, $yRadius)
	{
		// Ajout d'une chaîne décrivant une ellipse.
		$this->addResult
		(
			"Drawing a $color ellipse with opacity $opacity at ".
			"($origin->x,$origin->y) ".
			"with x-radius $xRadius and y-radius $yRadius."
		);
	}

	public function drawRectangle(Point $origin, $color, $opacity, $width, $height)
	{
		if($width == $height)
		{
			$type = 'square';
		}
		else
		{
			$type = 'rectangle';
		}

		// Ajout d'une chaîne décrivant un rectangle.
		$this->addResult
		(
			"Drawing a $color $width x $height $type with opacity $opacity at ".
			"($origin->x,$origin->y)."
		);
	}

	public function getResults()
	{
		// Concaténation du tableau de chaînes avec une balise HTML <br>
		return implode('<br>', $this->results);
	}
}