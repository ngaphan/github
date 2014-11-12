<?php

// index.php
// Ivan nous voit grace à ses 2 lignes-là
header('Content-type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');

session_start();

// Création de l'objet PDO qui représente la connexion à la BDD
require_once 'dbconnect.php';

// Chargement des librairies :
require_once 'library/Model.class.php';

// Chargement des modèles :
require_once 'model/MessageModel.class.php';
require_once 'model/UserModel.class.php';

// Chargement du contrôleur
require_once 'controller/controller.php';


