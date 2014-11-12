<?php

class Circle extends Ellipse
{

    /*
     *
     *public function draw(Renderer $renderer)
	{
		// Utilisation de l'objet renderer pour dessiner un cercle avec ses propriétés.
		

        // ???

	}
    */

    /*draw
     * On veut surcharger la méthode setRadius() de l'ellipse pour qu'elle fonctionne
     * différemment. Pour cela il suffit de la réécrire ici dans la classe Circle.
     *
     * Problème : la surcharge en PHP oblige à respécifier tous les arguments de la
     * méthode originale, or on n'a besoin que d'un seul argument pour spécifier le
     * rayon d'un cercle.
     *
     * Si on ne fait rien cela oblige à écrire :
     * $circle = new Circle();
     * $circle->setCircle(100, 0); <==== le 0 est de trop mais obligatoire
     *
     * Alors que l'on voudrait pouvoir écrire :
     * $circle->setCircle(100);
     *
     *
     * Il faut donc rendre le deuxième argument optionnel, avec la syntaxe
     * ci-dessous.
     *
     * Note : les arguments optionnels existent autant en programmation procédurale
     * qu'en programmation orientée objet.
     *
     */
	
     // Méthode setRadius (à écrire)


    public function setRadius($xRadius, $yRadius=null)
    {
        // ???

        // un circle est un élipse dont les 2 côtés sont égales
        // donc on a besoin juste 1 seul param (1seule côte)
        // Mais puisque la class Circle s'hérite de la class Elipse
        // elle a les memes caractères que le Elipse sauf sa hauteur
        // donc je rend $yRadius en optionnel en lui donnant la value null
        // mais il faut que ça existe , sinon il n'a pas de hauter, il peut pas afficher
        // Lors de la création de "new Circle" dans "program.class" , on donne 1 seul param
        // Puis on attribute ce seul param à 2 propriétés (xRadius,yRadius),
        // ça rend les deux côtés ont de même taille

        $this->xRadius = $xRadius ;
        $this->yRadius = $xRadius ;
    }

}