<?php

class SvgRenderer extends Renderer
{
	public function drawCircle(Point $origin, $color, $opacity, $radius)
	{
		// Ajout d'une balise SVG <circle>
		$this->addResult
		(
			"<circle cx='$origin->x' cy='$origin->y' r='$radius' fill='$color' opacity='$opacity' />"
		);
	}

	public function drawEllipse(Point $origin, $color, $opacity, $xRadius, $yRadius)
	{
		// Ajout d'une balise SVG <ellipse>
		$this->addResult
		(
			"<ellipse cx='$origin->x' cy='$origin->y' rx='$xRadius' ry='$yRadius' fill='$color' opacity='$opacity' />"
		);
	}

	public function drawRectangle(Point $origin, $color, $opacity, $width, $height)
	{
		// Ajout d'une balise SVG <rect>
		$this->addResult
		(
			"<rect x='$origin->x' y='$origin->y' width='$width' height='$height' fill='$color' opacity='$opacity' />"
		);
	}

	public function getResults()
	{
		// Ajout d'un conteneur SVG et concaténation de toutes les chaînes de balises SVG.
		$svgContainer  = '<svg height="480px" width="640px">';
		$svgContainer .= implode('', $this->results);
		$svgContainer .= '</svg>';

		return $svgContainer;
	}
}