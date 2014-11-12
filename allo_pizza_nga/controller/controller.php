<?php

/* =========================================================
|                          GENERAL                         |
========================================================= */

// -------------------------------------------------------
// Création des objets permettant de gérer les données
// à partir des modèles

$categoryModel = new CategoryModel($PDO);

// -------------------------------------------------------
// Gestion des actions du client

// Si le client se connecte
if (isset($_POST['action']) && $_POST['action'] === 'customerConnect')
{
    $customerModel = new CustomerModel($PDO);

    if ($customerArray = $customerModel->connect())
    {
        $_SESSION['customerArray'] = $customerArray;
    }

    header('Location: index.php');
}

// Si le client se déconnecte
if (isset($_GET['action']) && $_GET['action'] === 'customerDisconnect')
{
    $_SESSION = [];
    session_destroy();

    header('Location: index.php');
}

if (isset($_SESSION['customerArray']))
{
    $customerIsConnected = true;
}
else
{
    $customerIsConnected = false;
}

// -------------------------------------------------------
// Récupération des listes à afficher

// On récupère la liste des catégories
$categoriesList = $categoryModel->listAll();


/* =====================  ! GENERAL  ==================== */

/* =========================================================
|                           SHOP                           |
========================================================= */

if ($menu === 'shop')
{
    // -------------------------------------------------------
    // Création des objets permettant de gérer les données
    // à partir des modèles

    $cartModel = new CartModel($PDO);
    $categoryModel = new CategoryModel($PDO);
    $productModel = new ProductModel($PDO);

    // On initialize le panier s'il n'existe pas
    if (!isset($_SESSION['cartId']))
    {
        $_SESSION['cartId'] = $cartModel->initialize();
    }

    // -------------------------------------------------------
    // Gestion des actions du client

    // Si le client ajoute un produit au panier
    // (en cliquant sur "Ajouter au pannier")
    if (isset($_GET['action']) && $_GET['action'] === 'cartProductAdd')
    {
        if (isset($_GET['productId']) && $productModel->exists($_GET['productId']))
        {
            $cartModel->add($_GET['productId']);
        }
    }

    // Si le client retire un produit du panier
    // (en cliquant sur "x" dans le panier)
    if (isset($_GET['action']) && $_GET['action'] === 'cartProductRemove')
    {
        if (isset($_GET['n']) && $cartModel->exists($_GET['n']))
        {
            $cartModel->remove($_GET['n']);
        }
    }

    // Si le client réduit la quantité d'un produit dans le panier
    // (en cliquant sur "-" dans le panier)
    if (isset($_GET['action']) && $_GET['action'] === 'cartProductQuantityDecrease')
    {
        if (isset($_GET['n']) && $cartModel->exists($_GET['n']))
        {
            $cartModel->decrease($_GET['n']);
        }
    }

    // Si le client augmente la quantité d'un produit dans le panier
    // (en cliquant sur "+" dans le panier)
    if (isset($_GET['action']) && $_GET['action'] === 'cartProductQuantityIncrease')
    {
        if (isset($_GET['n']) && $cartModel->exists($_GET['n']))
        {
            $cartModel->increase($_GET['n']);
        }
    }

    // Si le client passe commande (en cliquant sur "COMMANDER")
    if (isset($_GET['action']) && $_GET['action'] === 'orderSend')
    {
        $orderModel = new OrderModel($PDO);

        if ($orderModel->add())
        {
            $cartModel->remove($_SESSION['cartId']);

            unset($_SESSION['cartId']);

            echo 'yeah !';

            header('Location: index.php?menu=order');

            exit();
        }
    }

    if (isset($_GET['action']) || isset($_POST['action']))
    {
        if (isset($_GET['categoryId']))
        {
            header('Location: index.php?categoryId=' . $_GET['categoryId']);
        }
        else
        {
            header('Location: index.php');
        }
    }

    // -------------------------------------------------------
    // Récupération des listes à afficher

    // Si le client a cliqué sur une catégorie spécifique
    if (isset($_GET['categoryId']) && $categoryModel->exists($_GET['categoryId']))
    {
        // On récupère la liste des produits
        // de la catégorie d'identifiant $_GET['categoryId']
        $productsList = $productModel->listAll($_GET['categoryId']);

        $selectedCategoryName = $categoryModel->getName($_GET['categoryId']);
    }
    else
    {
        $selectedCategoryName = false;
    }

    // On récupère la liste des produits du panier
    $cartProductsList = $cartModel->listAll();

    // S'il n'y a aucun produit dans le panier
    if (count($cartProductsList) === 0)
    {
        // On assigne la valeur true au marqueur de panier vide
        $cartIsEmpty = true;
    }
    // Sinon (s'il y a des produits dans le panier)
    else
    {
        // On assigne la valeur false au marqueur de panier vide
        $cartIsEmpty = false;

        // On initialise le prix total du panier
        $cartTotalPrice = 0;

        // Pour chaque produit du panier
        foreach($cartProductsList as $cartProduct)
        {
            // On ajoute son prix x sa quantité au prix total du panier
            $cartTotalPrice += $cartProduct['productPrice'] * $cartProduct['cartProductQuantity'];
        }

        // On formatte le prix total
        // pour qu'il comporte deux chiffres après la virgule
        $cartTotalPrice = number_format($cartTotalPrice, 2);
    }
}

/* ======================  ! SHOP  ====================== */

/* =========================================================
|                       INSCRIPTION                        |
========================================================= */

if ($menu === 'signup')
{
    // -------------------------------------------------------
    // Création des objets permettant à partir des modèles

    $customerModel = new CustomerModel($PDO);

    // -------------------------------------------------------
    // Gestion des actions du clients

    // Si le client clique sur "S'INSCRIRE"
    if (isset($_POST['action']) && $_POST['action'] === 'customerSignUp')
    {
        // On tente de créer le nouveau client dans la BDD
        $customerModel->add();

        // Si la connection du nouveau client se passe bien
        // (ce qui nous permet de vérifier en même temps si la création s'est bien passée)
        if ($customerArray = $customerModel->connect())
        {
            // On stocke ses informations dans la session
            $_SESSION['customerArray'] = $customerArray;

            // S'il s'agit d'une redirection sur la page d'inscription
            // après une commande passée sans être authentifié
            if (isset($_GET['action']) && $_GET['action'] === 'orderSend')
            {
                // On le redirige pour envoyer la commande
                header('Location: index.php?action=orderSend');
            }
            else
            {
                header('Location: index.php');
            }
        }
        else
        {
            header('Location: index.php?menu=signup');
        }
    }

    // Si l'inscription provient d'un client ayant tenté
    // de commander sans être connecté
    if (isset($_GET['action']) && $_GET['action'] === 'orderSend')
    {
        $orderWithoutAuth = true;
    }
    else
    {
        $orderWithoutAuth = false;
    }
}

/* ==================  ! INSCRIPTION  =================== */

/* =========================================================
|                      ADMINISTRATION                      |
========================================================= */

if ($menu === 'administration')
{
    // -------------------------------------------------------
    // Création des objets permettant à partir des modèles

    $categoryModel = new CategoryModel($PDO);
    $customerModel = new CustomerModel($PDO);
    $orderModel = new OrderModel($PDO);
    $productModel = new ProductModel($PDO);

    // -------------------------------------------------------
    // Gestion des actions du clients

    // Si l'administrateur supprime une commande
    if (isset($_GET['action']) && $_GET['action'] === 'orderDelete')
    {
        if (isset($_GET['orderId']) && $orderModel->exists($_GET['orderId']))
        {
            $orderModel->remove($_GET['orderId']);
        }
    }

    // Si l'administrateur supprime un client
    if (isset($_GET['action']) && $_GET['action'] === 'customerDelete')
    {
        if (isset($_GET['customerId']) && $customerModel->exists($_GET['customerId']))
        {
            $customerModel->remove($_GET['customerId']);
        }
    }

    // Si l'administrateur ajoute un nouveau produit
    if (isset($_POST['action']) && $_POST['action'] === 'productAdd')
    {
        $productId = $productModel->add();

        print_r($_FILES);

        if (isset($_FILES['productImage']['name']))
        {
            $productImagePath = 'view/img/products/' . $productId . '.jpg';

            if (file_exists($productImagePath))
            {
                unlink($productImagePath);
            }

            move_uploaded_file($_FILES['productImage']['tmp_name'], $productImagePath);
        }
    }

    // Si l'administrateur supprime un produit
    if (isset($_GET['action']) && $_GET['action'] === 'productDelete')
    {
        if (isset($_GET['productId']) && $productModel->exists($_GET['productId']))
        {
            // On demande la suppression de ce produit
            // (d'identifiant $_GET['productId'])
            $productModel->remove($_GET['productId']);

            // On prépare le nom de l'image correspondante au produit
            // (chemin + identifiant du produit + extension JPG)
            $productImagePath = 'view/img/products/' . $_GET['productId'] . '.jpg';

            // Si cette image existe
            if (file_exists($productImagePath))
            {
                // On la supprime
                unlink($productImagePath);
            }
        }
    }

    // Si l'administrateur ajoute une nouvelle catégorie
    if (isset($_POST['action']) && $_POST['action'] === 'categoryAdd')
    {
        $categoryModel->add();
    }

    // Si l'administrateur supprime un produit
    if (isset($_GET['action']) && $_GET['action'] === 'categoryDelete')
    {
        if (isset($_GET['categoryId']) && $categoryModel->exists($_GET['categoryId']))
        {
            $categoryModel->remove($_GET['categoryId']);
        }
    }

    if (isset($_GET['action']) || isset($_POST['action']))
    {
        header('Location: index.php?menu=administration');
    }

    // -------------------------------------------------------
    // Récupération des tableaux à afficher

    // On récupère la liste des catégories
    //$categoriesList = $categoryModel->listAll();

    // On récupère la liste des clients
    $customersList = $customerModel->listAll();

    // On récupère la liste des commandes
    $ordersList = $orderModel->listAll();

    // On récupère la liste des produits
    $productsList = $productModel->listAll();
}

/* =================  ! ADMINISTRATION  ================= */
