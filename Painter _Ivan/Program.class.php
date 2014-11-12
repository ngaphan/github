<?php

class Program
{
	public function createRenderer($type)
	{
		switch($type)
		{
			case RENDERER_TYPE_STRING:
			return new StringRenderer();

			case RENDERER_TYPE_SVG:
			return new SvgRenderer();

			default:
			die("ERREUR : Le type de renderer '$type' est inconnu !");
		}
	}

    public function run(Renderer $renderer)
    {
        // Création et initialisation d'un rectangle.
        $rectangle1 = new Rectangle();
		$rectangle1->setOrigin(50, 20);
        $rectangle1->setColor('firebrick');
        $rectangle1->setSize(200, 100);

		// Création et initialisation d'une ellipse.
		$ellipse1 = new Ellipse();
		$ellipse1->setCenter(600, 180);
        $ellipse1->setColor('seagreen');
		$ellipse1->setRadius(40, 80);

        // Création et initialisation d'un carré.
        $square1 = new Square();
		$square1->setOrigin(350, 200);
        $square1->setColor('deepskyblue');
		$square1->setOpacity(0.5);
        $square1->setSize(100);

        // Création et initialisation d'un cercle.
        $circle1 = new Circle();
        $circle1->setCenter(300, 150);
        $circle1->setColor('gold');
		$circle1->setOpacity(0.33);
        $circle1->setRadius(180);


        // Ajout des différents objets géométriques au moteur graphique.
        $renderer->addShape($rectangle1);
        $renderer->addShape($square1);
        $renderer->addShape($circle1);
        $renderer->addShape($ellipse1);

		// Exécution du moteur graphique.
        $renderer->run();
    }
}