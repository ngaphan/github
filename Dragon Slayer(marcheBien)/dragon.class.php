<?php

class Dragon
{
    protected $dragonName;
    protected $dragonLife;
    protected $dragonLifeMax;
    protected $dragonForce;

    public function __construct($dragonName,$dragonLifeMax,$dragonForce)
    {
        $this->setDragonName($dragonName) ;
        $this->setDragonLife($dragonLifeMax) ;
        $this->setDragonLifeMax($dragonLifeMax) ;
        $this->setDragonForce($dragonForce);
    }

    public   function setDragonName($dragonName)
    {
        if(is_string($dragonName))
        {
            $this->dragonName = $dragonName;
        }
        else
        {
            echo $dragonName ." doit être une chaîne de caractères ";
        }
    }
    public   function setDragonLife($dragonLife)
    {
        if(!is_numeric($dragonLife)|| $dragonLife < 0 )
        {
            echo $dragonLife ." doit être un nombre positif. ";
        }
        else
        {
            $this->dragonLife = (float) $dragonLife;
        }
    }
    public   function setDragonLifeMax($dragonLifeMax)
    {
        if(!is_numeric($dragonLifeMax)|| $dragonLifeMax < 0 )
        {
            echo $dragonLifeMax ." doit être un nombre positif. ";
        }
        else
        {
            $this->dragonLifeMax = (float) $dragonLifeMax;
        }
    }
    public   function setDragonForce($dragonForce)
    {
        if(!is_int($dragonForce))
        {
            echo $dragonForce ." doit être un nombre entier .";
        }
        else
        {
            $this->dragonForce = $dragonForce;
        }
    }

    public function getDragonName()
    {
        return $this->dragonName;
    }
    public function getDragonLife()
    {
        return $this->dragonLife;
    }
    public function getDragonLifeMax()
    {
        return $this->dragonLifeMax;
    }
    public function getDragonForce()
    {
        return $this->dragonForce;
    }

    public function attack(Character $characterObj)
    {
        echo " Dragon va attacker " . $characterObj->getCharacterName()."<br>" ;

       $injuries = $this->getDragonForce()-$characterObj->getCharacterArmor() ;

       $characterObj->setCharacterLife($characterObj->getCharacterLife() - $injuries ) ;

        return $injuries ;
    }
}
