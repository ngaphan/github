<?php

// controller/actions.php

/* ================================================
	Rubrique : Accueil
================================================ */

// Si l'utilisateur est sur la page d'accueil
if ($menu === 'home')
{
	// On instancie les objets $dragonManager, $characterManager et $weaponManager
	// pour pouvoir lister et créer nos dragons sur la page d'accueil
	$dragonManager = new DragonManager($PDO);
	$characterManager = new CharacterManager($PDO);
	$weaponManager = new WeaponManager($PDO);
	
	// Pour chaque sélection nulle (= l'utilisateur n'a pas encore sélectionné sur une des listes),
	// on l'initialise à la valeur 0 pour éviter un undefined dans notre template
	// (voir la classe CSS "active" dans les listes du bas du fichier home.phtml)
	if (!isset($_SESSION['selectedDragonId'])) $_SESSION['selectedDragonId'] = 0;
	if (!isset($_SESSION['selectedCharacterId'])) $_SESSION['selectedCharacterId'] = 0;
	if (!isset($_SESSION['selectedWeaponId'])) $_SESSION['selectedWeaponId'] = 0;

	// Si l'utilisateur a cliqué sur un des dragons de la liste (pour le sélectionner)
	if (isset($_GET['action']) && $_GET['action'] === 'dragonSelect')
	{
		// S'il existe bien un dragon ayant cet identifiant
		if (isset($_GET['dragonId']) && $dragonManager->exists($_GET['dragonId']))
		{
			// On enregistre la sélection de ce dragon dans la session / $_SESSION
			$_SESSION['selectedDragonId'] = $_GET['dragonId'];
		}

		// On redirige l'utilisateur sur la page d'accueil
		// (pour éviter le maintien de nos paramètres d'URL / $_GET)
		header('Location: index.php');
	}

	// Si l'utilisateur a cliqué sur un des personnages de la liste (pour le sélectionner)
	if (isset($_GET['action']) && $_GET['action'] === 'characterSelect')
	{
		// S'il existe bien un personnage ayant cet identifiant
		if (isset($_GET['characterId']) && $characterManager->exists($_GET['characterId']))
		{
			// On enregistre la sélection de ce personnage dans la session / $_SESSION
			$_SESSION['selectedCharacterId'] = $_GET['characterId'];
		}

		// On redirige l'utilisateur sur la page d'accueil
		// (pour éviter le maintien de nos paramètres d'URL / $_GET)
		header('Location: index.php');
	}

	// Si l'utilisateur a cliqué sur une des armes de la liste (pour la sélectionner)
	if (isset($_GET['action']) && $_GET['action'] === 'weaponSelect')
	{
		// S'il existe bien une arme ayant cet identifiant
		if (isset($_GET['weaponId']) && $weaponManager->exists($_GET['weaponId']))
		{
			// On enregistre la sélection de cette arme dans la session / $_SESSION
			$_SESSION['selectedWeaponId'] = $_GET['weaponId'];
		}

		// On redirige l'utilisateur sur la page d'accueil
		// (pour éviter le maintien de nos paramètres d'URL / $_GET)
		header('Location: index.php');
	}

	if ($_SESSION['selectedDragonId'] != 0 && $_SESSION['selectedWeaponId'] != 0 && $_SESSION['selectedCharacterId'] != 0)
	{
		// On crée l'objet Dragon correspondant au dragon sélectionné par l'utilisateur
		// et on le sérialise avant de le stocker dans le tableau de la session
		$_SESSION['selectedDragonObject'] = serialize($dragonManager->create($_SESSION['selectedDragonId']));
		
		// On crée l'objet Weapon correspondant à l'arme sélectionnée par l'utilisateur
		$weaponObject = $weaponManager->create($_SESSION['selectedWeaponId']);
		
		// On crée l'objet Character correspondant au personnage sélectionné par l'utilisateur,
		// en n'oubliant pas du lui envoyer en second paramètre l'objet Weapon pour pouvoir le lui attacher,
		// et on le sérialise avant de le stocker dans le tableau de la session
		$_SESSION['selectedCharacterObject'] = serialize($characterManager->create($_SESSION['selectedCharacterId'], $weaponObject));

		// On détruit nos trois indices du tableau des sessions pour éviter
		// la re-création des objets créés ci-dessus à chaque nouveau chargement de la page d'accueil
		unset($_SESSION['selectedDragonId'], $_SESSION['selectedWeaponId'], $_SESSION['selectedCharacterId']);
	}

	// Si les deux objets (sérialisés) Dragon et Character existent bien dans la session / $_SESSION
	if (isset($_SESSION['selectedDragonObject']) && isset($_SESSION['selectedCharacterObject']))
	{
		// On définit une variable "marqueur" pour dire que la partie est prête (ou en cours)
		$gameIsReady = true;
		
		// On récupère notre objet Dragon en le désérialisant à partir de la session / $_SESSION
		$selectedDragonObject = unserialize($_SESSION['selectedDragonObject']);
		
		// On récupère notre objet Character en le désérialisant à partir de la session / $_SESSION
		$selectedCharacterObject = unserialize($_SESSION['selectedCharacterObject']);
	}
	// Sinon (si les deux objets n'existent pas)
	else
	{
		// On définit une variable "marqueur" pour dire que la partie n'est pas (encore) prête
		$gameIsReady = false;
	}

	// Si l'utilisateur a cliqué sur "ATTAQUER LE PERSONNAGE"
	if (isset($_GET['action']) && $_GET['action'] === 'dragonAttack')
	{
		// On utilise la méthode Dragon::attack(Character $character)
		// pour infliger des dégâts au personnage
		$selectedDragonObject->attack($selectedCharacterObject);
		
		// On sérialise et on stocke l'objet Personnage dans la session / $_SESSION
    $_SESSION['selectedCharacterObject'] = serialize($selectedCharacterObject);

		// On redirige l'utilisateur sur la page d'accueil
		// (pour éviter le maintien de nos paramètres d'URL / $_GET)
		header('Location: index.php');
	}

	// Si l'utilisateur a cliqué sur "ATTAQUER LE DRAGON"
	if (isset($_GET['action']) && $_GET['action'] === 'characterAttack')
	{
		// On utilise la méthode Character::attack(Dragon $dragon)
		// pour infliger des dégâts au dragon
		$selectedCharacterObject->attack($selectedDragonObject);
    
		// On sérialise et on stocke l'objet Dragon dans la session / $_SESSION
    $_SESSION['selectedDragonObject'] = serialize($selectedDragonObject);

		// On redirige l'utilisateur sur la page d'accueil
		// (pour éviter le maintien de nos paramètres d'URL / $_GET)
		header('Location: index.php');
	}

	// On récupère nos 3 tableaux listant les dragons, personnages et armes
	$dragons = $dragonManager->listAll();
	$characters = $characterManager->listAll();
	$weapons = $weaponManager->listAll();
}

/* ================================================
	Rubrique : Inscription
================================================ */

// Si l'utilisateur est sur la page d'inscription
if ($menu === 'signup')
{
	// Si l'utilisateur a cliqué sur "S'INCRIRE"
	if (isset($_POST['action']) && $_POST['action'] === 'userSignUp')
	{
		// On instancie l'objet permettant de gérer les utilisateurs
		$userManager = new UserManager($PDO);

    // S'il n'y a aucun utilisateur déjà enregistré avec cet email
		if (!$userManager->check($_POST['userEmail']))
		{
			// On ajoute cet utilisateur à la BDD
			$userManager->add($_POST['userName'], $_POST['userEmail'], $_POST['userPassword']);

			// On crée l'objet User représentant le nouvel utilisateur
			$userObject = $userManager->create($_POST['userEmail']);

			// On sérialise l'objet User et on le stocke dans la session / $_SESSION
			$_SESSION['connectedUserObject'] = serialize($userObject);
		}

		// On redirige l'utilisateur sur la page d'accueil
		// (pour éviter le maintien de l'envoi de nos données de formulaire / $_POST)
		header('Location: index.php');
	}
}

/* ================================================
	Rubrique : Administration
================================================ */

// Si l'utilisateur est sur la page d'administration
if ($menu === 'admin')
{
	// S'il ne s'agit pas d'un utilisateur connecté
	// (pour éviter que quelqu'un puisse directement taper l'adresse "index.php?menu=administration"
	// pour accéder à l'administration sans être connecté)
	if (!isset($_SESSION['connectedUserObject']))
	{
		// On le renvoie sur la page d'accueil
		header('Location: index.php');
	}
	// Sinon (s'il s'agit bien d'un utilisateur connecté)
	else
	{
		// On instancie les objets $dragonManager, $characterManager, $weaponManager et $userManager
		// pour pouvoir lister nos dragons, personnages, armes et utilisateurs sur la page d'administration
		$dragonManager = new DragonManager($PDO);
		$characterManager = new CharacterManager($PDO);
		$weaponManager = new WeaponManager($PDO);
		$userManager = new UserManager($PDO);
		
		// Si l'utilisateur a cliqué sur "AJOUTER" dans le formulaire d'ajout d'un dragon
		if (isset($_POST['action']) && $_POST['action'] === 'dragonAdd')
		{
			// On ajoute le dragon dans la BDD
			$dragonManager->add($_POST['dragonName'], $_POST['dragonLifeMax'], $_POST['dragonForce']);

			// On redirige l'utilisateur sur la page d'administration
			// (pour éviter le maintien de l'envoi de nos données de formulaire / $_POST)
			header('Location: index.php?menu=admin');
		}

		// Si l'utilisateur a cliqué sur "AJOUTER" dans le formulaire d'ajout d'un personnage
		if (isset($_POST['action']) && $_POST['action'] === 'characterAdd')
		{
			// On ajoute le personnage dans la BDD
			$characterManager->add($_POST['characterName'], $_POST['characterLifeMax'], $_POST['characterArmor']);

			// On redirige l'utilisateur sur la page d'administration
			// (pour éviter le maintien de l'envoi de nos données de formulaire / $_POST)
			header('Location: index.php?menu=admin');
		}

		// Si l'utilisateur a cliqué sur "AJOUTER" dans le formulaire d'ajout d'une arme
		if (isset($_POST['action']) && $_POST['action'] === 'weaponAdd')
		{
			// On ajoute l'arme dans la BDD
			$weaponManager->add($_POST['weaponName'], $_POST['weaponForce']);

			// On redirige l'utilisateur sur la page d'administration
			// (pour éviter le maintien de l'envoi de nos données de formulaire / $_POST)
			header('Location: index.php?menu=admin');
		}

		// Si l'utilisateur a cliqué sur "SUPPRIMER" dans le tableau listant les dragons
		if (isset($_GET['action']) && $_GET['action'] === 'dragonDelete')
		{
			// On supprime le dragon dans la BDD
			$dragonManager->delete($_GET['dragonId']);

			// On redirige l'utilisateur sur la page d'administration
			// (pour éviter le maintien de nos paramètres d'URL / $_GET)
			header('Location: index.php?menu=admin');
		}

		// Si l'utilisateur a cliqué sur "SUPPRIMER" dans le tableau listant les personnage
		if (isset($_GET['action']) && $_GET['action'] === 'characterDelete')
		{
			// On supprime le personnage dans la BDD
			$characterManager->delete($_GET['characterId']);

			// On redirige l'utilisateur sur la page d'administration
			// (pour éviter le maintien de nos paramètres d'URL / $_GET)
			header('Location: index.php?menu=admin');
		}

		// Si l'utilisateur a cliqué sur "SUPPRIMER" dans le tableau listant les armes
		if (isset($_GET['action']) && $_GET['action'] === 'weaponDelete')
		{
			// On supprime l'arme dans la BDD
			$weaponManager->delete($_GET['weaponId']);

			// On redirige l'utilisateur sur la page d'administration
			// (pour éviter le maintien de nos paramètres d'URL / $_GET)
			header('Location: index.php?menu=admin');
		}

		// Si l'utilisateur a cliqué sur "SUPPRIMER" dans le tableau listant les utilisateurs
		if (isset($_GET['action']) && $_GET['action'] === 'userDelete')
		{
			// On supprime l'utilisateur dans la BDD
			$userManager->delete($_GET['userId']);

			// On redirige l'utilisateur sur la page d'administration
			// (pour éviter le maintien de nos paramètres d'URL / $_GET)
			header('Location: index.php?menu=admin');
		}

		// On récupère nos 4 tableaux listant les dragons, personnages, armes et utilisateurs
		// après que l'ensemble des actions d'ajout et de suppression sur ces tables aient pu être exécutées
		// pour s'assurer qu'elles soit bien à jour
		$dragons = $dragonManager->listAll();
		$characters = $characterManager->listAll();
		$weapons = $weaponManager->listAll();
		$users = $userManager->listAll();
	}
}

/* ================================================
	Général (= sur toutes les rubriques)
================================================ */

// Si l'utilisateur a cliqué sur "CONNEXION"
if (isset($_POST['action']) && $_POST['action'] === 'userConnect')
{
	// On instancie l'objet permettant de gérer les utilisateurs
	$userManager = new UserManager($PDO);

	// S'il y a bien un utilisateur ayant cet email et ce mot de passe
	if ($userManager->check($_POST['userEmail'], $_POST['userPassword']))
	{
			// On crée l'objet User représentant le nouvel utilisateur
			$userObject = $userManager->create($_POST['userEmail']);

			// On sérialise l'objet User et on le stocke dans la session / $_SESSION
			$_SESSION['connectedUserObject'] = serialize($userObject);

			// Si l'utilisateur a coché la case "Se souvenir de moi"
			// Note : on utilise un opérateur de comparaison large pour assurer une compatibilité optimale
			// (on ne sait pas s'il s'agira de la chaîne de caractère "1" ou de l'entier 1)
			if ($_POST['userDoNotForget'] == 1)
			{
				// On crée un premier cookie avec l'identifiant de l'utilisateur
				setcookie('USER_ID', $userObject->getId(), time()+2592000);

				// On crée un second cookie avec un UUID à notre sauce :
		    $key = $userObject->getId() . PASS_PHRASE_FOR_COOKIES . $_SERVER['REMOTE_ADDR'];
				$UUID = UUID($key);
				setcookie('UUID', $UUID, time()+2592000);
			}
	}

	// On redirige l'utilisateur sur la page d'accueil
	// (pour éviter le maintien de l'envoi de nos données de formulaire / $_POST)
	header('Location: index.php');
}

// Si l'utilisateur a cliqué sur "Déconnexion"
if (isset($_GET['action']) && $_GET['action'] === 'userDisconnect')
{
	$_SESSION = [];
	session_destroy();
	setcookie('PHPSESSID', '', time()-86400);
	setcookie('USER_ID', '', time()-86400);
	setcookie('UUID', '', time()-86400);

	header('Location: index.php');
}

// Si l'objet User existe dans la session / $_SESSION
if (isset($_SESSION['connectedUserObject']))
{
	// On définit une variable "marqueur" pour dire qu'un utilisateur est connecté
	$userIsConnected = true;

	// On récupère notre objet User (= utilisateur connecté) en le désérialisant à partir de la session / $_SESSION
	$connectedUserObject = unserialize($_SESSION['connectedUserObject']);
}
// Sinon (s'il n'existe pas)
else
{
	// S'il existe un cookie permettant d'identifier l'utilisateur sur ce navigateur
	// et qu'il existe bien aussi le second cookie UUID
	if (isset($_COOKIE['USER_ID']) && isset($_COOKIE['UUID']))
	{
		// On instancie l'objet permettant de gérer les utilisateurs
		$userManager = new UserManager($PDO);
		
		// Si l'utilisateur existe (avec cet identifiant)
		if ($userManager->exists($_COOKIE['USER_ID']))
		{
	    $key = $_COOKIE['USER_ID'] . PASS_PHRASE_FOR_COOKIES . $_SERVER['REMOTE_ADDR'];
	    echo UUID($key);
	    
	    // Si l'UUID correspond bien
	    if ($_COOKIE['UUID'] === UUID($key))
	    {
		    // On prépare notre requête SQL
				$query = "SELECT * FROM users WHERE userId = :userId";
				
		    // On prépare notre tableau faisant le "binding" entre les valeurs de nos variables
		    // et celles qui sont envoyées dans la requête SQL (pour éviter les injections)
				$boundValues = [
					'userId' => $_COOKIE['USER_ID']
				];

		    // On charge notre requête SQL dans la couche d'abstraction PDO
				$statement = $PDO->prepare($query);
				
	      // On exécute notre requête SQL (en liant notre tableau de "binding")
	      $statement->execute($boundValues);

				// On récupère la ligne correspondante de la table "dragons" sous la forme d'un tableau
				$dragonArray = $statement->fetch();

				// On crée l'objet User représsentant le nouvel utilisateur
				$userObject = $userManager->create($userArray['userEmail']);

				// On sérialise l'objet User et on le stocke dans la session / $_SESSION
				$_SESSION['connectedUserObject'] = serialize($userObject);

				// On redirige l'utilisateur sur la page d'accueil
				header('Location: index.php');
	    }
		}
	}

	// On définit une variable "marqueur" pour dire qu'aucun utilisateur est connecté
	$userIsConnected = false;
}
