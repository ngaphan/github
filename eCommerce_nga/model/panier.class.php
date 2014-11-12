<?php

// model/panier.class.php

/**
 * Classe représentant le "modèle" d'un panier,
 * héritant de la classe Entity
 */
class Panier
{
    // Attributs de la classe Panier
    private $idPanier;
    private $idProduitAjoute;
    private $quantiteProduitsAjoutes;
    private $quantiteProduitsCommandes;

    public function __construct($idPanier, $idProduitAjoute, $quantiteProduitsAjoutes,$quantiteProduitsCommandes)
    {
        $this->setIdPanier($idPanier);
        $this->setIdProduitAjoute($idProduitAjoute);
        $this->setQuantiteProduitsAjoutes($quantiteProduitsAjoutes);
        $this->setQuantiteProduitsCommandes($quantiteProduitsCommandes);
    }

    // Liste des accesseurs (getters) pour les attributs protégés ou privés
    // (protégé = accessible seulement au sein de cette classe et des classes qui en sont héritées)
    // (privé = accessible seulement au sein de cette classe)
    public function getIdPanier()                  { return $this->idPanier; }
    public function getIdProduitAjoute()           { return $this->idProduitAjoute; }
    public function getQuantiteProduitsAjoutes()   { return $this->quantiteProduitsAjoutes; }
    public function getQuantiteProduitsCommandes() { return $this->quantiteProduitsCommandes; }

    // Mutateur (setter) pour l'attribut privé $idPanier
    public function setIdPanier($idPanier)
    {
        // On transtype (cast) le paramètre $idPanier en nombre entier
        $idPanier = (int) $idPanier;

        // Si la valeur de $idPanier est négative
        if ($idPanier < 0)
        {
            echo 'Class Panier : $idPanier doit être un nombre entier positif.';
        }
        // Sinon (si elle est positive ou égale à 0)
        else
        {
            // On assigne la valeur de $force à la propriété "idPanier" de l'objet en cours
            $this->idPanier = $idPanier;
        }
    }

    // Mutateur (setter) pour l'attribut privé $getIdProduitAjoute
    public function setIdProduitAjoute($idProduitAjoute)
    {
        // On transtype (cast) le paramètre $idPanier en nombre entier
        $idProduitAjoute = (int) $idProduitAjoute;

        // Si la valeur de $idPanier est négative
        if ($idProduitAjoute < 0)
        {
            echo 'Class Panier : $idProduitAjoute doit être un nombre entier positif.';
        }
        // Sinon (si elle est positive ou égale à 0)
        else
        {
            // On assigne la valeur de $idProduitAjoute à la propriété "idProduitAjoute"
            //de l'objet en cours
            $this->idProduitAjoute = $idProduitAjoute;
        }
    }

    // Mutateur (setter) pour l'attribut privé $getQuantiteProduitsAjoutes
    public function setQuantiteProduitsAjoutes($quantiteProduitsAjoutes)
    {
        // On transtype (cast) le paramètre $quantiteProduitsAjoutes en nombre entier
        $quantiteProduitsAjoutes = (int) $quantiteProduitsAjoutes;

        // Si la valeur de $quantiteProduitsAjoutes est négative
        if ($quantiteProduitsAjoutes < 0)
        {
            echo 'Class Panier : $quantiteProduitsAjoutes doit être un nombre entier positif.';
        }
        // Sinon (si elle est positive ou égale à 0)
        else
        {
            // On assigne la valeur de $quantiteProduitsAjoutes à la propriété
            //"quantiteProduitsAjoutes" de l'objet en cours

            $this->quantiteProduitsAjoutes = $quantiteProduitsAjoutes;
        }
    }

    // Mutateur (setter) pour l'attribut privé $getQuantiteProduitsCommandes
    public function setQuantiteProduitsCommandes($quantiteProduitsCommandes)
    {
        // On transtype (cast) le paramètre $quantiteProduitsAjoutes en nombre entier
        $quantiteProduitsCommandes = (int) $quantiteProduitsCommandes;

        // Si la valeur de $quantiteProduitsCommandes est négative
        if ($quantiteProduitsCommandes < 0)
        {
            echo
            'Class Panier : $quantiteProduitsCommandes doit être un nombre entier positif.';
        }
        // Sinon (si elle est positive ou égale à 0)
        else
        {
            // On assigne la valeur de $quantiteProduitsCommandes à la propriété
            //"quantiteProduitsCommandes" de l'objet en cours

            $this->quantiteProduitsCommandes = $quantiteProduitsCommandes;
        }
    }

}
