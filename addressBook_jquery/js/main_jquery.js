
$(function()
{
   $("#blueSquare")
       .before("before1<br>")
       .before("before2<br>")
       .before("before3<br>")
       .after("after1<br>")
       .after("after2<br>")
       .after("after3<br>")
       .prepend("prepend1")
       .append("append2")
});

$("#blueSquare").click(
    function(){
        console.log("cliquer moi !");
        //le message s'affiche lors qu'on click sur le selector("#blueSquare")
        // ici c'est le carré, le compteur compte le nombre de click
    }
);

// on peut remplacer le selector par this si ça répète tout le temps

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
                                            $(this).fadeIn(
                                                1000,
                                            function()
                                            {
                                                $("p").html("<h1>COUCOU !</h1>");
                                            })
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

    // la fin de la function "ready"

);

