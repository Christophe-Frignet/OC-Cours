<?php
session_start(); 

require('modele.php');

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

$liste_articles = recupererListeArticles($num_page,$articles_par_page);
require('afficher-accueil.php'); 