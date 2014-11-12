<?php

header('Content-type:text/html ; charset= UTF-8');

// http://192.168.1.99/ShareCode/bfi

// conection à la base de données
require_once'dbconnect.php';

// chargement des classes

require_once 'element.class.php';
require_once 'being.class.php';
require_once'character-manager.class.php';
require_once'character.class.php';
require_once'weapon-manager.class.php';
require_once'weapon.class.php';
require_once'dragon-manager.class.php';
require_once'dragon.class.php';


//gestion du menu(= des rubriques )
require_once'menu.php';

// Gestion des actions
require_once'actions.php';

/*
$dragonManager = new DragonManager($PDOConnectionObject);

$dragonsArray = $dragonManager->listAll();

$dragonsArray2 = $dragonManager->add('MonDRagon', 2100, 500);

$dragonManager->delete(13);
*/

//Affiche de nos templates
require_once'top.phtml';
require_once $menu.'.phtml';
require_once'bottom.phtml';


/*

$nightFury = new Dragon('Night Fury', 20, 10);
$sword = new Weapon('Sword', 10);
$hiccup = new Character('Hiccup', 20, 5, $sword);

echo '<p><b>' . $hiccup->getCharacterName() . '</b>, equipped with a <b>' . $hiccup->getCharacterWeapon()->getWeaponName() . '</b>, has a life level of ' . $hiccup->getCharacterLife(). '.<br><b>' . $hiccup->getCharacterName() . '</b> has <b>' . $nightFury->getDragonLife() . '</b> points of life.</p>';

while ($hiccup->getCharacterLife() > 0 && $nightFury->getDragonLife() > 0)
{
    $injuries = $hiccup->attack($nightFury);

    echo '<p><b>' . $hiccup->getCharacterName() . '</b> attacks <b>' . $nightFury->getDragonName() . '</b>, who losts <b>' . $injuries . '</b> points of life.<br><b>' . $hiccup->getCharacterName() . '</b> has now <b>' . $nightFury->getDragonLife() . '</b> points of life.<br>';

    if ($nightFury->getDragonLife() == 0) break;

     $injuries = $nightFury->attack($hiccup);

     echo '<p><b>' . $nightFury->getDragonName() . '</b> attacks <b>' . $hiccup->getCharacterName() . '</b>, who losts <b>' . $injuries . '</b> points of life.<br><b>' .  $nightFury->getDragonName() . '</b> has now <b>' . $hiccup->getCharacterLife() . '</b> points of life.</p>';
 }

 if ($nightFury->getDragonLife() == 0)
 {
     echo '<p><b>' . $nightFury->getDragonName() . '</b> est mort.<p>';
 }
 else
 {
     echo '<p><b>' . $hiccup->getCharacterName() . '</b> est mort.<p>';
 }
*/