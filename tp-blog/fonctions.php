<?php

function numero_page()
{
    //si on connait le numéro de page on s'en sert
    if(isset($_GET['num_page']))
    {
        $num_page = $_GET['num_page'];
    }
    //sinon on considère être sur la page n°1
    else
    {
        $num_page = 1;
    }

    return $num_page;
}