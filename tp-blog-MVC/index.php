<?php
session_start(); 

require('modele.php');

//On définit les variables nécessaires à l'affichage de la page d'accueil
if(isset($_GET['num_page']))
{
    $num_page = numeroPage($_GET['num_page']);
}
else
{
    $num_page = 1;
}
$articles_par_page = 2;
$nbr_pages = nombrePages($articles_par_page);
$liste_articles = recupererArticles($num_page,$articles_par_page);

require('afficher-accueil.php'); 