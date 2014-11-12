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

// Chargement des modèles (classes) :
// - classes "mères"
require_once 'model/model.class.php';
//require_once 'model/entity.class.php';
//require_once 'model/being.class.php';
// - classes "filles"
require_once 'model/categorie_manager.class.php';
require_once 'model/prix_manager.class.php';
require_once 'model/client_manager.class.php';
require_once 'model/tauxtva_manager.class.php';
require_once 'model/produit_manager.class.php';
require_once 'model/commande_manager.class.php';
require_once 'model/panier_manager.class.php';


// Chargement des fonctions
require_once 'functions/uuid_v5.php';

/*
	Chargement du fichier de routing (simplifié) :
	le routing consiste à savoir quelles vues afficher selon l'url qui est tapée
	Ex: index.php?menu=signup affichera 'view/signup.phtml' grâce à l'include 'view/' . $menu . '.phtml';
 */
require_once 'routing.php';

/*
	On charge notre contrôleur (simplifié)
	qui permet d'utiliser les modèles (classes) pour :
	- récupérer des données à partir des modèles et les préparer pour nos vues
	- récupérer des données envoyées par les requêtes HTTP du client ($_GET et $_POST) pour les envoyer aux modèles
 */
require_once 'controller/actions.php';

// Affichage de nos vues (templates)
require_once 'view/top.phtml';
require_once 'view/' . $menu . '.phtml';
require_once 'view/bottom.phtml';
