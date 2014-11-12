<?php

class Dragon extends Being
{

    protected $force;

    public function __construct($id , $name , $lifeMax , $force)
    {
       
        $this->setId($id);
        $this->setName($name);
        $this->setLife($lifeMax);
        $this->setLifeMax($lifeMax);
        $this->setForce($force);
    }

    public function getForce()   {  return $this->force ;    }

    public   function setForce($force)
    {
        $force = (int) $force ;

        if($force < 0)
        {
            echo 'Class Dragon : $force doit être un nombre entier positif.';
        }
        else
        {
            $this->force = $force;
        }
    }


    public function attack(Character $characterObj)
    {
        //echo " Dragon va attacker " . $characterObj->getCharacterName()."<br>" ;

       // On calcule les points de dégât
        $injuries = $this->getForce() - $characterObj->getArmor();

        // On calcule les points de vie restants
        // du personnage après l'attaque
        $characterNewLife = $characterObj->getLife() - $injuries;

        // Si le nombre de points vie restant est négatif, on les "limite" à 0
        if ($characterNewLife < 0)
        {
            $characterNewLife = 0;
        }

        // On met à jour les points de vie du personnage
        $characterObj->setLife($characterNewLife);

        // On retourne les point de dégât
        return $injuries;
    }
}

