<?php
    // je suis dans : actions.php

    // création des Obj
    $dragonManager = new DragonManager($PDOConnectionObject);
    $characterManager = new CharacterManager($PDOConnectionObject);
    $weaponManager = new WeaponManager($PDOConnectionObject);
    $userManager = new UserManager($PDOConnectionObject);

/*
	Home : actions
    J'ai mis home2 d'Ivan à la place de home.phtml
*/

if($menu==='home')
{
    // créer les obj temporaires pour la partie connexion


    //$exist = $userManager->existsUserNamePassword($_GET['username'] , $_GET['mdp']) ;

    if(isset($_GET['userId']))
    {
        $_SESSION['userId']= $_GET['userId'];
        $userObj = $userManager->create($_SESSION['userId']) ;
        $_SESSION['connectedUserObj'] = serialize($userObj) ;        
        unset($_SESSION['userId']) ;        
    }
    if(isset($_SESSION['connectedUserObj']))
        {
            $connectedUserObj = unserialize($_SESSION['connectedUserObj']);
            print_r( $connectedUserObj ) ;

        }
    
    
    // partie jeux

    if(isset($_GET['action'])&& $_GET['action']=== "dragonSelect")
    {
        $_SESSION['selectedDragonId']= $_GET['dragonId'];
    }
    if(isset($_GET['action'])&& $_GET['action']=== "characterSelect")
    {
        $_SESSION['selectedCharacterId']= $_GET['characterId'];
    }
    if(isset($_GET['action'])&& $_GET['action']=== "weaponSelect")
    {
        $_SESSION['selectedWeaponId']= $_GET['weaponId'];
    }

    /* si j'ai dejà créé 3 $_SESSION ['...Id'] , je vais créer l'obj grace à ses $_SESSION ['...Id']*/

    if(isset($_SESSION['selectedWeaponId']) && isset($_SESSION['selectedDragonId']) && isset($_SESSION['selectedCharacterId']))
    {
        // créations des obj
        $weaponObj = $weaponManager->create($_SESSION['selectedWeaponId']);
        $dragonObj = $dragonManager->create($_SESSION['selectedDragonId']);
        $characterObj = $characterManager->create($_SESSION['selectedCharacterId'],$weaponObj);

        // après avoir créer les obj , je les stock dans les $_SESSION['les selectedObj']

        $_SESSION['selectedDragonObj'] = serialize($dragonObj);
        $_SESSION['selectedCharacterObj'] = serialize($characterObj);

        unset($_SESSION['selectedWeaponId'],$_SESSION['selectedDragonId'],$_SESSION['selectedCharacterId']);
    }
        //si les dragon et le personnages sont bien créés , je cré l'obj dragon et personnage
    if(isset($_SESSION['selectedDragonObj']) && isset($_SESSION['selectedCharacterObj']))
    {
        $selectedDragonObj= unserialize($_SESSION['selectedDragonObj']) ;
        $selectedCharacterObj = unserialize($_SESSION['selectedCharacterObj']) ;
        $gameIsReady = true;
    }
    else
    {
        $gameIsReady = false;
    }

    if(isset($_GET['action'])&& $_GET['action']=== "dragonAttack")
    {
        // récupérer les obj à partir des obj temporaire

        $enjeu = $selectedDragonObj->attack($selectedCharacterObj);

        $_SESSION['selectedCharacterObj'] = serialize($selectedCharacterObj);

        echo " Le character a perdu : " . $enjeu . " points" ;

        $characterLifeRest = 100 * $selectedCharacterObj->getLife() / $selectedCharacterObj->getLifeMax() ;
        echo " <br> La  vie de character reste : " . $characterLifeRest . " %  " ;
        if ($characterLifeRest <= 0)
        {
            echo " Le personnage et mort " ;
        }
    }


    if(isset($_GET['action'])&& $_GET['action']=== "characterAttack")
    {
        // récupérer les obj à partir des obj temporaire

        $enjeu = $selectedCharacterObj->attack($selectedDragonObj);

        $_SESSION['selectedDragonObj'] = serialize($selectedDragonObj);

        echo " Le dragon a perdu : " . $enjeu . " points" ;

        $dragonLifeRest = 100 * $selectedCharacterObj->getLife() / $selectedCharacterObj->getLifeMax() ;
        echo "<br> La  vie de dragon reste : " . $dragonLifeRest . " %  " ;
        if ($dragonLifeRest <= 0)
        {
            echo " Le dragon et mort " ;
        }
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


/*
       Inscription : actions
*/

    if($menu === 'signup')
    {
        if( isset($_POST['action']) && $_POST['action'] === "addUser" )
        {
            $userManager->add($_POST['username'],$_POST['mdp'] , $_POST['nom'] ,$_POST['prenom'] , $_POST['email'] ) ;
            header('Location: index.php') ;
        }

        if(isset($_GET['action']) && $_GET['action'] === "userDelete")
        {
                $userManager->delete($_GET['userId']) ;
        }



    }


    $dragonsArray = $dragonManager->listAll();
    $charactersArray = $characterManager->listAll();
    $weaponsArray = $weaponManager->listAll();
    $usersArray = $userManager->listAll();



