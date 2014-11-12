<?php

    try
    {
        $PDOConnectionObject = new PDO("mysql:host=localhost;
                        dbname=dragons_slayer;charset=UTF8", "root", "");
    }
    catch (PDOException $exceptionObject)
    {
        // je veux attrapper que les  objets de type PDOException
        // (sous entendu = qui ont été instancié par la classe PDOException )

        echo 'Erreur de connection PDO (' . $exceptionObject->getCode() .
                                        '): ' . $exceptionObject->getMessage();
        exit();
    }


?>