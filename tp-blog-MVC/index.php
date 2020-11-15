<?php
session_start(); 

require('modele.php');

require('definir-numero-page.php');

$articles_par_page = articlesParPage(2);
$nbr_pages = nombrePages($articles_par_page);
$requete = recupererArticles($num_page,$articles_par_page);

require('afficher-accueil.php');

?>