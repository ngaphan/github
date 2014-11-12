<?php

// routing.php

// On crée un tableau listant l'ensemble de rubriques
$contents = ['shop', 'signup', 'customer', 'administration', 'order'];

// On vérifie si $_GET['menu'] et s'il existe bien
// dans notre tableau des rubriques
if (isset($_GET['menu']) && in_array($_GET['menu'], $contents))
{
  $menu = $_GET['menu'];
}
// S'il n'est pas défini ou qu'il n'existe pas dans notre tableau,
// on assigne par défaut à $menu la première rubrique de notre tableau
else
{
  $menu = $contents[0];
}
