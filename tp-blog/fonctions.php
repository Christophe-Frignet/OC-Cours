<?php

function numero_page()
{
    //si un numéro de page est transmis en GET
    if(isset($_GET['num_page']))
    {
        //on réduit la faille XSS de la donnée récupérée
        $num_page = htmlspecialchars($_GET['num_page']);

        //on s'assure du bon typage de la donnée
        $num_page = (int)$num_page;

        //on limite la plage de valeurs du numéro de page transmis
        if($num_page > 100)
        {
            ?>
                <section class="bloc center padding"  style="text-align:center;">
                <h2>Le numéro de page est supérieur à 100, c'est étrange ;)</h2>
                </section>
            <?php
         }
    }
    //sinon on considère être sur la page n°1
    else
    {
        $num_page = 1;
    }

    return $num_page;
}