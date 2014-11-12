<?php

class Dragon extends Being
{
    protected $force;

    public function __construct($id, $name, $lifeMax, $force)
    {
        $this->setForce($force);
        $this->setId($id);
        $this->setLife($lifeMax);
        $this->setLifeMax($lifeMax);
        $this->setName($name);
    }

    public function getForce() { return $this->force; }

    public function setForce($force)
    {
        $force = (int) $force;

        if ($force < 0)
        {
            echo 'Class Dragon : $force doit être un nombre entier positif.';
        }
        else
        {
            $this->force = $force;
        }
    }

    public function attack(Character $characterObject)
    {
        // On calcule les points de dégât
        $injuries = $this->getForce() - $characterObject->getArmor();

        // On calcule les points de vie restants
        // du personnage après l'attaque
        $characterNewLife = $characterObject->getLife() - $injuries;

        // Si le nombre de points vie restant est négatif, on les "limite" à 0
        if ($characterNewLife < 0)
        {
            $characterNewLife = 0;
        }

        // On met à jour les points de vie du personnage
        $characterObject->setLife($characterNewLife);

        // On retourne les point de dégât
        return $injuries;
    }
}
