<?php
/*
// test du transtypage ou cast :

// Code permettant de comprendre le transtypage
// (ou "cast" en anglais)

$myVar = '42'; // écrit donc en tant que chaîne de caractères

echo 'La variable $myVar est originellement un '. gettype($myVar) . '.<br>';

// On "transtype" notre variable pour la transformer
// en entier :
$myVar = (int) $myVar;

echo 'La variable $myVar est devenu un '. gettype($myVar) . '.';
*/



<?php

// dans DragonManager

class DragonManager
{
    protected $DBConnection;// ma main

    public function __construct($DBConnection)
    {
        // le moment qon cré 1 Obj( new DBConnection ,ex) je l'envoie en l'air
        $this->setDBConnection($DBConnection);
        // le moment j'attrap le $DBConnection, c'est à moi maintenant= étape setDBConnection
    }

    public function setDBConnection(PDO $DBConnectionObject)
    {
        $this->DBConnection = $DBConnectionObject;
    }

    public function listAll()
    {
        $query = "SELECT * FROM dragons ORDER BY dragonName";
        $statement = $this->DBConnection->prepare($query);
        $statement->execute();

        return $statement->fetchAll();// créer 1 tab 2 dimention
    }
}
