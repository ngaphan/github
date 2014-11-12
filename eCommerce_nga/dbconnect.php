<?php
/*
// dbconnect.php

try
{
    $PDO = new PDO("mysql:host=localhost;dbname=eCommerce;charset=UTF8", "3wa", "troiswa");
}
catch (PDOException $exceptionObject)
{
    echo 'Erreur de connection PDO (' . $exceptionObject->getCode() . '): ' . $exceptionObject->getMessage();

    exit();
}

*/
try
{
    $PDO = new PDO("mysql:host=localhost;dbname=eCommerce;charset=UTF8", "root", "");
}
catch (PDOException $exceptionObject)
{
    echo 'Erreur de connection PDO (' . $exceptionObject->getCode() . '): ' . $exceptionObject->getMessage();

    exit();
}
