AJAX , cote client

Asynchonous Javascript And XMl( à lépoque il y a que les XML)
 C 1 mode 20005 , 2008

cote utilisateur , une fois la page chargé (html, img, js, php...) ,par la porte derrière, on a besoin que appel ajax chercher les nouveau info par la requsete GET envers le serveur par php, puis afficher les nouveau ( pas besoin de recharger le rest(html, img, js,...))

par la porte devant du cote client , ça se voit rien , ça saffiche tj la page actuel
 Mais après recoit nouvel news , il sera afficher(actualiser) le nouveau news, donc client voir tout suite le nouvel news sans rien fait (pas besoin de cliquer)


4 types de requetes http en ajax

GET = récupéréer les info => select

POST : insérer/ ajouter des données (insert)

PUT : mettre à jour => update

DELETE : effacer => delete


souvent les programmeur utilise POST pr faire les requsete 'put / delete'

API ??

verifier l'existence de qc', mieux de le verifier le code de reponseHTTP

// ici jajoute
if(isset($_GET['userNickname']))
{
    $http_response_code(208);
    echo false ;
}
else
{
    $http_response_code(201);
    echo " c'est bon" ;
    echo json_encode($userModel->addIfNotExists($_GET['userNickname']));
}

// ici fin l'ajout