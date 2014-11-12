<?php

mot clé : keithwood cube 3d
http://keith-wood.name/imagecube.html


jquery :
cest un moule, tos les points communs de fonctionnelment des tous les entreprise, de ts les langages de progralmlaion;

permet de normaliser le code et de simplifier/résumer le code'


ex :
$(function() {$("body").html("C'est bientôt le debut !");});

$                   = pour appeller "jquery";
(function()         = documentContentWrited ;
$(function()        = ready, je suis pret, mon DOM est chargé, on peut commencer
$(selector).action/methode() = $("body").html();

$("body") = document.queryselector("body") = DOMObj("body") est chargé;

action/methode(): peut être installEventHandler/innerhtml/onclick/.....

ex :
$recup1 = $("body").html();//je veux récupérer tout le contenu de 'html'
donc mon $recup1 = C'est bientôt le debut !

$recup2 = $("body").html("hello");//je veux changer le contenu de 'html' par "hello" maintenant
donc mon $recup2 = hello






//document.write("C'est bientot la fin !");
//console.log();
// ecrire en jquery

$(function()
{
    /*
    $("body").html("C'est bientot le debut !");

    var recup1 = $("body").html();

    console.log(recup1);

    var recup2 = $("body").html("hello");

    console.log(recup2);
    */

    /*
    $("#blueSquare").slideDown(1er param = miliseconde,2eparam=function callback) ;//

    function callback : à nous de écrire cette function
    function callback :   veut dire faut attendre la fin de l*animation du 1er param avant de lancer le 2e param

    Si on donne 1 seul param, il fini l*animation est rester où il est à sa fin(il retourn pas à la place par default)

    */

    //$("#blueSquare").slideUp(1200) ;// () est le temps en milliseconde
   // $("#blueSquare").slideDown(1200) ;//

/*
    console.log("l'animation demarre") ;
    $("#blueSquare").fadeOut(2000,function()
    {
        console.log("L'animation1 est finie");
    }*/
    /* pas ok

    console.log("l'animation demarre") ;
    $("#blueSquare").fadeOut(2000,function()
        {
            console.log("L'animation1 est finie");
            $("#blueSquare").fadeOut(2000,function()
            {
                console.log("l'animation2 redemarre") ;
                $("#blueSquare").fadeOut(2000,function()
                {
                    console.log("l'animation2 est finie") ;
                }
            }
        }


    */

    // le chainage des methodes / ce n'est pas callback, il attend pas

/* ok
    // 1 : change color de background
    //1erparam = selector,2e: nouvelcolor
    $("#blueSquare").css("background-color","red") ;//1erparam = selector,2e: nouvelcolor


    //2:  ajouter un border
    $("#blueSquare").css("border","solid 0.5rem #000");

    //2:  ajouter encore un border , puis bcp d'autre
    $("#blueSquare")
        .css("background-color", "red")
        .css("border", "solid 2rem #000").slideUp(1500);

*/
    //parcontre si on ajoute 1 autre animation, il faut refaire comme au debut
    $("#blueSquare")
    .css("background-color", "red")
    .css("border", "solid 2rem #000")
    .slideUp(
        1500,
        function()
        {
            $("#blueSquare").slideDown(
                500,
                function()
                {
                    $("#blueSquare").fadeOut(800);
                }
            );
        }
    );

    /*

    // On chaîne les méthodes sans callba
    $("#blueSquare")
        .css("background-color", "red")
        .css("border", "solid 2rem #000")
        .slideUp(1500)
        .slideDown(500)
        .fadeOut(800);
    // c'est pas bien , tout va essayer de faire en meme temps

    */
});

les 4 principal selectors

  $("  ")
    id:             "#___";
    class :         ".___";
    tag:            "___";
    attribut:       [type=""] ou input[type="text"];




//document.write("C'est bientot la fin !");
//console.log();
// ecrire en jquery

$(function()
{
    /*
    $("body").html("C'est bientot le debut !");

    var recup1 = $("body").html();

    console.log(recup1);

    var recup2 = $("body").html("hello");

    console.log(recup2);
    */

    /*
    $("#blueSquare").slideDown(1er param = miliseconde,2eparam=function callback) ;//

    function callback : à nous de écrire cette function
    function callback :   veut dire faut attendre la fin de l*animation du 1er param avant de lancer le 2e param

    Si on donne 1 seul param, il fini l*animation est rester où il est à sa fin(il retourn pas à la place par default)

    */

    //$("#blueSquare").slideUp(1200) ;// () est le temps en milliseconde
    // $("#blueSquare").slideDown(1200) ;//

    /*
        console.log("l'animation demarre") ;
        $("#blueSquare").fadeOut(2000,function()
        {
            console.log("L'animation1 est finie");
        }*/
    /* pas ok

    console.log("l'animation demarre") ;
    $("#blueSquare").fadeOut(2000,function()
        {
            console.log("L'animation1 est finie");
            $("#blueSquare").fadeOut(2000,function()
            {
                console.log("l'animation2 redemarre") ;
                $("#blueSquare").fadeOut(2000,function()
                {
                    console.log("l'animation2 est finie") ;
                }
            }
        }


    */

    // le chainage des methodes / ce n'est pas callback, il attend pas

    /* ok
        // 1 : change color de background
        //1erparam = selector,2e: nouvelcolor
        $("#blueSquare").css("background-color","red") ;//1erparam = selector,2e: nouvelcolor


        //2:  ajouter un border
        $("#blueSquare").css("border","solid 0.5rem #000");

        //2:  ajouter encore un border , puis bcp d'autre
        $("#blueSquare")
            .css("background-color", "red")
            .css("border", "solid 2rem #000").slideUp(1500);

    */
    //parcontre si on ajoute 1 autre animation, il faut refaire comme au debut
    $("#blueSquare")
    .css("background-color", "red")
    .css("border", "solid 0.5rem yellow")
    .slideUp(
        1500,
        function()
        {
            $("#blueSquare").slideDown(
                500,
                function()
                {
                    $(this).fadeOut(
                        800,
                        function()
                        {
                            $(this).fadeIn(
                                800,
                                function()
                                {
                                    $(this).slideUp(
                                        1000,
                                        function()
                                        {
                                            $(this).slideDown(800).click(function()
                                            {
                                                console.log("Coucou !");
                                                $(this).fadeOut(
                                                    800,
                                                    function()
                                                    {
                                                        $(this).fadeIn(1000);
                                                    });

                                            });
                                        });
                                }
                            );
                        }
                    );
                }
            );
        }
    /*

    // On chaîne les méthodes sans callba
    $("#blueSquare")
        .css("background-color", "red")
        .css("border", "solid 2rem #000")
        .slideUp(1500)
        .slideDown(500)
        .fadeOut(800);
    // c'est pas bien , tout va essayer de faire en meme temps

    */
});

gestions de sévenement

$("#blueSquare").click(
    function(){
        console.log("cliquer moi !");
    }
);


LES CODES D.ERREURS

Liste officielle des réponses HTTP:
http://www.ietf.org/assignments/http-status-codes/http-status-codes.xml