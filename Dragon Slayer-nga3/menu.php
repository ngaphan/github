<?php

//j'ai mis home2 d'Ivan à la place de home
    // on crée un tableau listant l'ensemble de rubiques
    $contents =['home', 'admin','signup'] ;

    // 'menu' est établie lors sde la création de lien du button "SUPPRIMER" OU "AJOUTER" (voir admin.phtml)
    // On vérifie si $_GET['menu'] et s'il existe bien dans notre tableau des rubriques    

    if(isset($_GET['menu']) && in_array($_GET['menu'], $contents))
    {
        $menu = $_GET['menu'];
    }

    // s'il n'est pas défini ou qu'il est "faux" ,
    // on assigne par default à $menu la première rubrique de notre tableau
    else
    {
        $menu = $contents[0] ;// càd = 'home'
    }

?>