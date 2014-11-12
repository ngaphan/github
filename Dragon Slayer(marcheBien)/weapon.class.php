<?php

class Weapon
{
    protected $weaponName;
    protected $weaponForce;

    public function __construct($weaponName,$weaponForce)
    {
        $this->setWeaponName($weaponName);
        $this->setWeaponForce($weaponForce);
    }

    public function setWeaponName($weaponName)
    {
        if(is_string($weaponName))
        {
            $this->weaponName = $weaponName ;
        }
        else {echo $weaponName ." doit être une chaîne de caractères. " ;}
    }
    public function setWeaponForce($weaponForce)
    {
        if(is_int($weaponForce))
        {
            $this->weaponForce = $weaponForce;
        }
        else { echo $weaponForce ." life doit être un nombre positif." ;}
    }

    public function  getWeaponName(){return $this->weaponName ;   }
    public function getWeaponForce(){return $this->weaponForce ;  }
}




