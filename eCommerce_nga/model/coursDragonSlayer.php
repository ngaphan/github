<?php

// routing.php

// On crée un tableau listant l'ensemble de rubriques
$contents = ['home', 'signup', 'admin'];

// On vérifie si $_GET['menu'] et s'il existe bien
// dans notre tableau des rubriques
if (isset($_GET['menu']) && in_array($_GET['menu'], $contents))
{
    $menu = $_GET['menu'];
}
// S'il n'est pas défini ou qu'il n'existe pas dans notre tableau,
// on assigne par défaut à $menu la première rubrique de notre tableau
else
{
    $menu = $contents[0];
}
                                mandes
    idCommande
    idClient
    refProduit
    dateCommande
    quantiteProduitCommande

prixHT
    idPrix
    refProduit
    prixHT
    refTauxTVA

produits
    idProduit
    refProduit
    nomProduit
    descriptionProduit
    stock

tauxTVA
    idTauxTVA
    refTauxTVA
    valeurTauxTVA

panier
    idPanier
    idProduit
    quantitéProduitChoisit




    *****************

string

    // Mutateur (setter) pour l'attribut protégé $name
  public function setName($name)
{
    // Si la valeur de $name n'est pas une chaîne de caratères
    if (!is_string($name))
    {
        echo 'Class ' . get_class($this) . ': $name doit être une chaîne de caractères.';
    }
    // Sinon (si c'est bien une chaîne de caractère)
    else
    {
        // On assigne la valeur de $name à la propriété "name" de l'objet en cours
        $this->name = $name;
    }
}

*****************************

int

 // Mutateur (setter) pour l'attribut protégé $lifeMax
  public function setLifeMax($lifeMax)
{
    // On transtype (cast) le paramètre $lifeMax en nombre flottant (à virgule)
    $lifeMax = (float) $lifeMax;

    // Si la valeur de $lifeMax est négative
    if ($lifeMax < 0)
    {
        echo 'Class ' . get_class($this) . ': $lifeMax doit être un nombre positif.';
    }
    // Sinon (si elle est positive ou égale à 0)
    else
    {
        // On assigne la valeur de $lifeMax à la propriété "lifeMax" de l'objet en cours
        $this->lifeMax = $lifeMax;
    }
}