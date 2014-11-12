<?php

class Square extends Rectangle
{
    /*
     * On veut surcharger la méthode setSize() du rectangle pour qu'elle fonctionne
     * différemment. Pour cela il suffit de la réécrire ici dans la classe Square.
     *
     * Problème : la surcharge en PHP oblige à respécifier tous les arguments de la
     * méthode originale, or on n'a besoin que d'un seul argument pour spécifier la
     * taille d'un carré.
     *
     * Si on ne fait rien cela oblige à écrire :
     * $square = new Square();
     * $square->setSize(100, 0); <==== le 0 est de trop mais obligatoire
     *
     * Alors que l'on voudrait pouvoir écrire :
     * $square->setSize(100);
     *
     *
     * Il faut donc rendre le deuxième argument optionnel, avec la syntaxe
     * ci-dessous.
     *
     * Note : les arguments optionnels existent autant en programmation procédurale
     * qu'en programmation orientée objet.
     *
     */
	
     // Méthode setSize (à écrire)

    public function setSize($width, $height=null)
    {
        // ???

    // un carré est un rectangle dont les 2 côtés sont égaux
    // donc on a besoin juste 1 seul param
    // Mais puisque la class Quare s'hérite de la class Rectangle
    // elle a les memes caractères que le rectangle sauf sa hauteur
    // donc je rend $height en optionnel en lui donnant la value null
    // mais il faut que ça existe , sinon il n'a pas de hauter, il peut pas afficher
    // Lors de la création de "new Square" dans "program.class" , on donne 1 seul param
    // Puis on attribute ce seul param à 2 propriétés (width,height),
    // ça rend les deuc côtés ont de même taille
        $this->width = $width ;
        $this->height = $width ;
    }
}