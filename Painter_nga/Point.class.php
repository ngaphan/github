<?php

class Point
{
	public $x;
	public $y;

	public function __construct()
	{
		$this->x = 0;
		$this->y = 0;
		// initialisation x,y à 0, mais si on veut redonner 1 nouvelle valeur lors de la création d cet Obj,
		// ça va écraser l'ancienne value , et prend la nouvelle
	}
}