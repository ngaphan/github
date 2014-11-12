<?php

class Program
{
    // Méthode createRenderer (à créer)


    public function createRenderer($typeRenderer)
    {
        if($typeRenderer === RENDERER_TYPE_STRING)
        {
            $typeRendererObj = new StringRenderer() ;
        }
        else
        {
            $typeRendererObj = new SvgRenderer() ;
        }

        return  $typeRendererObj ;


        // StringRenderer et SvgRenderer sont hérités de la class Renderer, donc
        // l'obj $typeRendererObj est aussi l'obj de type Renderer
        // on retourne ici , ça va être reçu dans index.php par :
        // $renderer = $program->createRenderer(RENDERER_TYPE_SVG);
    }

    public function run(Renderer $renderer)
    {
        // Création et initialisation d'un rectangle.
        // - origine: 50, 20
        // - couleur: firebrick
        // - taille: 200, 100

        $rectangleObj = new Rectangle ();
        $rectangleObj->setOrigin(50,20);
        $rectangleObj->setSize(200,100);
        $rectangleObj->setColor("firebrick" );

        //$rectangleObj->draw($renderer);//pour tester directement



        // Création et initialisation d'un carré.
        // - origine: 350, 200
        // - couleur: deepskyblue
        // - opacité: 0.5
        // - taille: 100


        $squareObj = new Square ();
        $squareObj->setOrigin(350,200);
        $squareObj->setSize(100);
        $squareObj->setColor("deepskyblue" );
        $squareObj->setOpacity(0.5) ;

        //$squareObj->draw($renderer);//pour tester directement



        // Création et initialisation d'une ellipse.
        // - centre: 600, 180
        // - couleur: seagreen
        // - rayon: 40, 80

        $elipseObj = new Ellipse ();
        $elipseObj->setCenter(600,180);
        $elipseObj->setRadius(40,80);
        $elipseObj->setColor("seagreen" );

        //$elipseObj->draw($renderer);//pour tester directement



        // Création et initialisation d'un cercle.
        // - centre: 300, 150
        // - couleur: gold
        // - opacité: 0.33
        // - rayon: 180

        $circleObj = new Circle ();
        $circleObj->setCenter(300, 150);
        $circleObj->setRadius(180, 50);
        $circleObj->setColor("gold" );
        $circleObj->setOpacity(0.33) ;

        //$circleObj->draw($renderer);//pour tester directement



        // Ajout des différents objets géométriques au moteur graphique.
        //on a dejà la function addShape préparée dans Renderer.class
        // pour ajouter toutes les forms par "push-array"
        // exécuter par la function "run" (étape en-desous

        $renderer->addShape($rectangleObj);
        $renderer->addShape($squareObj);
        $renderer->addShape($elipseObj);
        $renderer->addShape($circleObj);

		// Exécution du moteur graphique.

        $renderer->run() ;

    }
}