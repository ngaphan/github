<?php

    abstract class Model
    {
    /** @var PDO Un objet PDO représentant la connexion à la BDD */
    protected $PDO;

    /**
    * Constructeur
    *
    * @param PDO $PDO Un objet PDO représentant la connexion à la BDD
    */
    public function __construct($PDO)
    {
        $this->setDBConnection($PDO);
    }

    // Mutateur (setter) pour la propriété $DBConnectionObject
    protected function setDBConnection(PDO $PDO)
    {
    // On assigne la valeur de $PDO (un objet PDO) à la propriété "PDO" de l'objet en cours
        $this->PDO = $PDO;
    }
}