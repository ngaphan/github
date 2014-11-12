<?php

class Character extends Being
{
    protected $armor;
    protected $weapon ;

    public function __construct( $id,$name,$lifeMax,$armor, $weapon=null)
    {
        $this->setId($id);
        $this->setName($name);
        $this->setLife($lifeMax);
        $this->setLifeMax($lifeMax);
        $this->setArmor($armor);

        if(!is_null($weapon))
        {
            $this->setWeapon($weapon) ;
        }
    }

    public  function getArmor()    {    return $this->armor ;    }
    public  function getWeapon()   {    return $this->weapon ;   }



    public   function setArmor($armor)
    {
        $armor = (int) $armor ;

        if($armor < 0 )
        {
            echo '$armor doit être un nbr entier positif ' ;
        }
        else
        {
            $this->armor = $armor ;
        }
    }
    public function setWeapon(Weapon $weaponObj)
    {
        $this->weapon = $weaponObj;
    }

    public function attack(Dragon $dragonObj)
    {
        //echo " Le Character va attacker le " . $dragonObj->getDragonName();

        // On calcule les points de dégât
        $injuries = $this->weapon->getForce();

        // On calcule les points de vie restants
        // du personnage après l'attaque
        //echo $dragonObject->getLife();
        $dragonNewLife = $dragonObj->getLife() - $injuries;
        //echo $dragonNewLife;

        // Si le nombre de points vie restant est négatif, on les "limite" à 0
        if ($dragonNewLife < 0)
        {
            $dragonNewLife = 0;
        }

        // On met à jour les points de vie du personnage
        $dragonObj->setLife($dragonNewLife);

        // On retourne les point de dégât
        return $injuries;


    }
}



