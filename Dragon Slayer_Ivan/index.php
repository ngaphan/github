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


//Affiche de nos templates
require_once'top.phtml';
require_once $menu.'.phtml';
require_once'bottom.phtml';


