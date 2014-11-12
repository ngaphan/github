<?php   

$dragonManager = new DragonManager($PDOConnectionObject);
$characterManager = new CharacterManager($PDOConnectionObject);
$weaponManager = new WeaponManager($PDOConnectionObject);
// lors que je fais "new" -> ça appelle automatiquement la __construct de la class corespondant
// j'envoie en param l'obj connection de type PDO ($PDOConnectionObject)
// il va être reçu dans (param attendu) de la __construct()de la class corespondant
// va dans dragonManager pr plus d'information / plus de commentaire

/*
    Home : actions
*/


if ($menu === 'home')
{
    if (isset($_GET['action']) && $_GET['action'] === 'dragonSelect')
    {       
        $_SESSION['selectedDragonId'] = $_GET['dragonId'];        
        header('Location: index.php');
    }
    if (isset($_GET['action']) && $_GET['action'] === 'weaponSelect')
    {     
        $_SESSION['selectedWeaponId'] = $_GET['weaponId'];        
        header('Location: index.php');
    }

    if (isset($_GET['action']) && $_GET['action'] === 'characterSelect')
    {     
        $_SESSION['selectedCharacterId'] = $_GET['characterId'];      
        header('Location: index.php');
    }

    if(isset($_SESSION['selectedDragonId']) && isset($_SESSION['selectedWeaponId']) && isset($_SESSION['selectedCharacterId']))
    {
    	$weaponObj = $weaponManager->create($_GET['weaponId']) ;
    	$dragonObj = $dragonManager->create($_GET['dragonId']) ;
    	$characterObj = $characterManager->create($_GET['characterId'] , $weaponObj);

    	$_SESSION['selectedDragonObj'] = serialize($dragonObj);
		$_SESSION['selectedCharacterObj'] = serialize($characterObj);
		unset($_SESSION['selectedDragonId'],$_SESSION['selectedWeaponId'],$_SESSION['selectedCharacterId']);
    }
    if(isset($_SESSION['selectedDragonObj']) && isset($_SESSION['selectedCharacterObj']))
    {
    	$selectedDragonObj 		= unserialize($_SESSION['selectedDragonObj']);
    	$selectedCharacterObj 	= unserialize($_SESSION['selectedCharacterObj']);
    	$gameIsReady = true;
    	header('Location: index.php');
    }
    else
    {
        $gameIsReady = false;
    }    

    if(isset($_GET['action']) && $_GET['action'] === "dragonAttack")
    {
    	$enjeu = $selectedDragonObj->attack($selectedCharacterObj) ;
    	$selectedCharacterObj = serialize($selectedCharacterObj) ;
    	echo $enjeu ;
    	header('Location: index.php');
    }
    if(isset($_GET['action']) && $_GET['action'] === "characterAttack")
    {
    	$enjeu = $selectedCharacterObj->attack($selectedDragonObj) ;
    	$selectedDragonObj = serialize($selectedDragonObj) ;
    	echo $enjeu ;
    	header('Location: index.php');
    }
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
