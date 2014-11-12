<?php
/*
    try
    {
        $PDOConnectionObject = new PDO("mysql:host=localhost;dbname=dragons_slayer;charset=UTF8", "3wa", "troiswa");
        // je recupe 1obj de type PDO qui a pr but de connecter aux BDD
        // je vais le mettre en param lors de  la création des class Manager
        // dans actions.php
    }
    catch (PDOException $exceptionObject)
    {   // je veux attrapper que les  objets de type PDOException
        // (sous entendu = qui ont été instancié par la classe PDOException )
        echo 'Erreur de connection PDO (' . $exceptionObject->getCode() .
                                        '): ' . $exceptionObject->getMessage();
        exit();
    } 

*/
	
	try
    {
        $PDOConnectionObject = new PDO("mysql:host=localhost;
                        dbname=dragons_slayer;charset=UTF8", "root", "");
        
    }
    catch (PDOException $exceptionObject)
    {      
        echo 'Erreur de connection PDO (' . $exceptionObject->getCode() .
                                        '): ' . $exceptionObject->getMessage();
		exit();										
    } 
	
	


?>