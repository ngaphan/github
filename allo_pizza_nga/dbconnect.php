<?php

// dbconnect.php

try
{
	$PDO = new PDO("mysql:host=localhost;dbname=allo_rapido_pizza;charset=UTF8", "root", "");
}
catch (PDOException $exceptionObject)
{
	echo 'Erreur de connection PDO (' . $exceptionObject->getCode() . '): ' . $exceptionObject->getMessage();

	exit();
}
