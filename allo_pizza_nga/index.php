<?php

// index.php

// Vous pouvez ignorer ces 2 lignes de code qui sont spécifiques à la configuration de mon PHP
ini_set('display_errors', 'On');
ini_set('error_reporting', E_ALL);

// Constantes (globales)
define('PASS_PHRASE', 'VoiciUnExempleDePassPhrase');
define('PASS_PHRASE_FOR_COOKIES', 'VoiciUnAutreExempleDePassPhraseUnPeuPlusLongue');

/*
	On démarre la session
	ATTENTION : on la démarre avant d'écrire le moindre HTML
	(comme pour la fonction header())
 */
session_start();

// Création de l'objet PDO qui représente la connexion à la BDD
require_once 'dbconnect.php';

// Chargement des librairies :
require_once 'library/Model.class.php';
require_once 'library/SQLQueryManager.class.php';

// Chargement des modèles :
require_once 'model/CartModel.class.php';
require_once 'model/CategoryModel.class.php';
require_once 'model/CustomerModel.class.php';
require_once 'model/OrderModel.class.php';
require_once 'model/ProductModel.class.php';

// Chargement du fichier de routing
require_once 'routing.php';

// Chargement du contrôleur
require_once 'controller/controller.php';

// Chargement des vues (templates)
require_once 'view/top.phtml';
require_once 'view/' . $menu . '.phtml';
require_once 'view/bottom.phtml';
