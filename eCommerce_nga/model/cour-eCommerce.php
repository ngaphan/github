<?php

http://imac.epfl.ch/files/content/sites/imac/files/Enseignement-Teaching/informatique/Aide3.1.pdf

http://startbootstrap.com/template-overviews/shop-homepage/
-> télécharger le css

abstract class MyAbstractClass

peut pas instancier la class directment

abstract public MyAbstractMethod()

fait sur class mere , forcer à définir les method ds class fille



***************************

LA BASE DE DONNES


categories
    idCategorie
    refCategorie
    nomCategorie
    descriptionCategorie

clients
    idClient
    nomClient
    prenomClient
    email
    adresseClient
    adresseLivraison

commandes
    idCommande
    idClient
    refProduit
    dateCommande
    quantiteProduitCommande

prix
    idPrix
    refProduit
    prix
    refTauxTVA

produits
    idProduit
    refProduit
    nomProduit
    descriptionProduit
    stock

tauxtva
    idTauxTVA
    refTauxTVA
    valeurTauxTVA

paniers
    idPanier
    idProduitAjoute
    quantiteProduitsAjoutes
    quantiteProduitsCommandes




    *****************

'ENVOI DUN FICHER À TRAVERS UN FORMULAIRE

        AJOUTER UN CHAMPS PUIS ENVOYER AU SERVEUR AUTOMATIQUEMENT


                    TRES IMPORTANT :
 AJOUTER DANS <FORM......'JAMAIS OUBLIER"
 1/ <form ...... enctype="multipart/form-data"> : pour envoyer n'import quel fichier( html, txt , img , .doc

 2/ <input type ="file" name="comme on veut pour récupérer ds php par $_POST"

 <?php   print_r ($_FILES) ; ?>


<form name ="myForm" action ="" enctype="multipart/form-data" method="post">
    <input name ="myFile" type ="file" ></input>
    <input type ="submit"value ="Envoyer"></input>

</form>

<?php

    move_uploaded_file ($_FILES["myFile"]["tmp_name"] ,"leNomJeVeux " ) ;
move_uploaded_file ($_FILES["myFile"]["tmp_name"] ,"../eCommerce/model/leNomJeVeux " ) ;

?>

<?php
/*



cote server

Array ( [myFile] =>
                    Array ( [name] => 01_calcul.js
                            [type] => application/javascript
                            [tmp_name] => /tmp/php13ilfN
                            [error] => 0
                            [size] => 52
                        )
       )



1er[] = le name de <input> (devient les indices ds table $_FILES)
2e[] = le name fichier (devient les indices ds table $_FILES)
[type] => application/javascript
[tmp_name] => /tmp/php13ilfN
[error] = en cas d'erreur ,envoyer code d'eeuer
[size] = [size] de ficher
*
 *
 *

La funcion permet de déplacer le ficher au serveur

bool move_uploaded_file ( string $filename , string $destination )
move_uploaded_file ($_FILES["name dans <input>"]["tmp_name"] ," leNomJeveux ou leNomJeveux et le chemin relatif (ou absolute) vers l'endroit où on veut enregistrer"
 *
 * si je donne que "leNomJeveux" il va l'enregistrer là où je suis en train de travailler(à * * cote du ficher que lance sur internet)
 * si le veux qu'il enregistre dans le ficher que je veux, il faut lui donner le chemin complet
 * d'abord il faut mettre les 2 point(..) pour quil sort de son endroit actuel , puis (/) et le répertoir voulu , puis / leNomJeveux
*
 * ex1 : move_uploaded_file ($_FILES["myFile"]["tmp_name"] ,"leNomJeVeux " ) ;
 * ex2 : move_uploaded_file ($_FILES["myFile"]["tmp_name"] ,"../model/leNomJeVeux " ) ;
 * /




?>