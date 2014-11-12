<?php

// Les constantes décrivant les différents moteurs de rendu.
define('RENDERER_TYPE_STRING', 'string');
define('RENDERER_TYPE_SVG', 'svg');


// Liste des classes dans l'ordre des dépendances.
include 'Point.class.php';
include 'Shape.class.php';

include 'Ellipse.class.php';
include 'Circle.class.php';
include 'Rectangle.class.php';
include 'Square.class.php';

include 'Renderer.class.php';
include 'StringRenderer.class.php';
include 'SvgRenderer.class.php';

include 'Program.class.php';



/********** CODE PRINCIPAL **********/

// Création d'une instance de notre programme puis exécution.
$program  = new Program();
$renderer = $program->createRenderer(RENDERER_TYPE_SVG);
$program->run($renderer);


// Inclusion du template.
include 'index.phtml';