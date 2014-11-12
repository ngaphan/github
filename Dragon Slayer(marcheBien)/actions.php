<?php

    // partie control dragonManager

    $dragonManager = new DragonManager($PDOConnectionObject);

    if (isset($_POST['action']) && $_POST['action'] === 'addDragon')
    {
        $dragonsArray = $dragonManager->addDragon($_POST["dragonName"], $_POST["dragonLifeMax"],
                                            $_POST["dragonForce"]);
        header("Location: index.php");
    }

    if (isset($_GET['action']) && $_GET['action'] === 'deleteDragon')
    {
        $dragonsArray = $dragonManager->deleteDragon($_GET["dragonId"]);
        header("Location: index.php");
    }

    if (isset($_POST['action']) && $_POST['action'] === 'listDragons')
    {
        $dragonsArray = $dragonManager->listDragons();
        header("Location: index.php");
    }

    if (isset($_POST['action']) && $_POST['action'] === 'updateDragon')
    {        
        $dragonsArray = $dragonManager->modifyDragon($_GET["dragonId"] , $_POST["dragonName"] , $_POST["dragonLifeMax"], $_POST["dragonForce"]) ;
        header("Location: index.php");
    }

    $dragonsArray = [];
    $result = $PDOConnectionObject->query("SELECT * FROM dragons");
    while ($rowArray = $result->fetch())
    {
        $dragonsArray[] = $rowArray;
    }




 // partie control characterManager

$characterManager = new CharacterManager($PDOConnectionObject);

if (isset($_POST['action']) && $_POST['action'] === 'addCharacter')
{
    $charactersArray = $characterManager->addCharacter($_POST["characterName"], $_POST["characterLifeMax"],
        $_POST["characterArmor"]);

    header("Location: index.php");
}

if (isset($_GET['action']) && $_GET['action'] === 'deleteCharacter')
{
    $charactersArray = $characterManager->deleteCharacter($_GET["characterId"]);
    header("Location: index.php");
}

if (isset($_POST['action']) && $_POST['action'] === 'listCharacters')
{
    $charactersArray = $characterManager->listCharacters();
    header("Location: index.php");
}

$charactersArray = [];
$result = $PDOConnectionObject->query("SELECT * FROM characters");
while ($rowArray = $result->fetch())
{
    $charactersArray[] = $rowArray;
}

// partie control weaponManager

    $weaponManager = new WeaponManager($PDOConnectionObject);

    if (isset($_POST['action']) && $_POST['action'] === 'addWeapon')
    {
        $weaponsArray = $weaponManager->addWeapon($_POST["weaponName"], $_POST["weaponForce"]);
        header("Location: index.php");
    }

    if (isset($_GET['action']) && $_GET['action'] === 'deleteWeapon')
    {
        $weaponsArray = $weaponManager->deleteWeapon($_GET["weaponId"]);
        header("Location: index.php");
    }

    if (isset($_POST['action']) && $_POST['action'] === 'listWeapons')
    {
        $weaponsArray = $weaponManager->listWeapons();
        header("Location: index.php");
    }

    $weaponsArray = [];
    $result = $PDOConnectionObject->query("SELECT * FROM weapons");
    while ($rowArray = $result->fetch())
    {
        $weaponsArray[] = $rowArray;
    }
