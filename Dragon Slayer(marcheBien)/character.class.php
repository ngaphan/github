<?php

class Character
{
    protected $characterName;
    protected $characterLife;
    protected $characterLifeMax;
    protected $characterArmor;

    protected $characterWeapon ;

    public function __construct( $characterName,$characterLifeMax,$characterArmor, $characterWeapon=null)
    {
        $this->setCharacterName($characterName);//definir name de character
        $this->setCharacterLife($characterLifeMax);
        $this->setCharacterLifeMax($characterLifeMax);
        $this->setCharacterArmor($characterArmor);
        if(!is_null($characterWeapon))
        {
            $this->setCharacterWeapon($characterWeapon) ;
        }
    }

    public  function setCharacterName($characterName)
    {
        if(!is_string($characterName))
        {
            echo $characterName.' doit être une chaîne de caractères.';
        }
        else
        {
            $this->characterName=$characterName ;
        }
    }
    public  function setCharacterLife($characterLife)
    {
        if(!is_numeric($characterLife)|| $characterLife < 0)
        {
            echo $characterLife.' doit être un nombre positif.';
        }
        else
        {
            $this->characterLife = (float) $characterLife ;
        }
    }
    public   function setCharacterLifeMax($characterLifeMax)
    {
        if(!is_numeric($characterLifeMax) || $characterLifeMax < 0 )
        {
            echo $characterLifeMax.' doit être un nombre positif.';
        }
        else
        {
            $this->characterLifeMax = (float) $characterLifeMax ;
        }
    }
    public   function setCharacterArmor($characterArmor)
    {
        if(!is_int($characterArmor)|| $characterArmor < 0 )
        {
            echo $characterArmor." doit être un nbr entier positif " ;
        }
        else
        {
            $this->characterArmor = $characterArmor ;
        }
    }
    public function setCharacterWeapon(Weapon $characterWeapon)
    {
        $this->characterWeapon = $characterWeapon;
    }
    public function getCharacterName()
    {
        return $this->characterName ;
    }
    public function getCharacterLife()
    {
        return $this->characterLife ;
    }
    public function getCharacterLifeMax()
    {
        return $this->characterLifeMax ;
    }
    public  function getCharacterArmor()
    {
        return $this->characterArmor ;
    }
    public  function getCharacterWeapon()
    {
        return $this->characterWeapon ;
    }
    public function attack(Dragon $dragon)
    {
        echo " Le Character va attacker le " . $dragon->getDragonName()."<br>" ;

        $injuries = $dragon->getDragonForce()-$this->getCharacterWeapon()->getWeaponForce() ;
        $dragon->setDragonLife($dragon->getDragonLife()-$injuries);
        return $injuries ;

    }
}




