<?php

$dragonManager = new DragonManager($PDOConnectionObject);
$characterManager = new CharacterManager($PDOConnectionObject);
$weaponManager = new WeaponManager($PDOConnectionObject);



/*
	Home : actions
*/
if($menu==='home')
{
    $gameIsReady = false ;// pr éviter l'erreur
}

/*
	Administration : actions
*/

if ($menu === 'admin')
{
    if (isset($_POST['action']) && $_POST['action'] === 'dragonAdd')
    {
        $dragonManager->add($_POST['dragonName'], $_POST['dragonLifeMax'], $_POST['dragonForce']);

        header('Location: index.php?menu=admin');
    }

    if (isset($_POST['action']) && $_POST['action'] === 'characterAdd')
    {
        $characterManager->add($_POST['characterName'], $_POST['characterLifeMax'], $_POST['characterArmor']);

        header('Location: index.php?menu=admin');
    }

    if (isset($_POST['action']) && $_POST['action'] === 'weaponAdd')
    {
        $weaponManager->add($_POST['weaponName'], $_POST['weaponForce']);

        header('Location: index.php?menu=admin');
    }

    if (isset($_GET['action']) && $_GET['action'] === 'dragonDelete')
    {
        $dragonManager->delete($_GET['dragonId']);

        header('Location: index.php?menu=admin');
    }

    if (isset($_GET['action']) && $_GET['action'] === 'characterDelete')
    {
        $characterManager->delete($_GET['characterId']);

        header('Location: index.php?menu=admin');
    }

    if (isset($_GET['action']) && $_GET['action'] === 'weaponDelete')
    {
        $weaponManager->delete($_GET['weaponId']);

        header('Location: index.php?menu=admin');
    }

}

$dragonsArray = $dragonManager->listAll();
$charactersArray = $characterManager->listAll();
$weaponsArray = $weaponManager->listAll();