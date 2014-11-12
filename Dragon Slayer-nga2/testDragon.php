<?php

// conection à la base de données
require_once'dbconnect.php';

// chargement des classes
require_once'character-manager.class.php';
require_once'character.class.php';
require_once'weapon-manager.class.php';
require_once'weapon.class.php';
require_once'dragon-manager.class.php';
require_once'dragon.class.php';

// Gestion des actions
require_once'actions.php';

//Affiche de nos templates
require_once'top.phtml';
//require_once'menu.php';
require_once'bottom.phtml';


//  Les tests de la class weapon :

$weapon = new Weapon("baguette", 20 );
print_r($weapon) ;


$name = $weapon->getWeaponName() ;
print_r($name);

print_r($weapon->getWeaponName()) ;
echo "<br><br>";
print_r($weapon->getWeaponForce()) ;
echo "<br><br>" ;

//  Les tests de la class Character:

$myCharacter = new Character("fire", 2 , 5, $weapon) ;

print_r($myCharacter->getCharacterName()) ;
echo '<br><br>' ;

print_r($myCharacter->getCharacterArmor()) ;
echo '<br><br>' ;

print_r($myCharacter->getCharacterLifeMax()) ;
echo '<br><br>' ;

print_r($myCharacter->getCharacterLife()) ;
echo '<br><br>' ;

print_r($myCharacter->getCharacterWeapon()) ;
echo '<br><br>' ;

//  Les tests de la class dragon :

$myDragon = new Dragon("water" , 5 , 10);
print_r($myDragon->getDragonForce());
echo '<br><br>' ;

print_r($myDragon->getDragonLife());
echo '<br><br>' ;

print_r($myDragon->getDragonLifeMax());
echo '<br><br>' ;

print_r($myDragon->getDragonName());
echo '<br><br>' ;

