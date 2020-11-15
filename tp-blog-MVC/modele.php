<?php

function recupererArticles($num_p,$art_p)
{
    //on récupère le numéro de page
    $num_page = $num_p;

    //on définit le nombre d'articles par page 
    $articles_par_page = $art_p;

    //Puis on calcul le n° de l'article qui doit s'afficher en premier
    $num_article = ($num_page-1)*$articles_par_page;

    //on se connecte à la bdd
    require('connecter-bdd.php');

    //on prépare la requête de récupération des articles
    $sql = 'SELECT id, titre, contenu, DATE_FORMAT(date_creation,  \'%d/%m/%Y %H:%i:%s\') AS date_creation_fr FROM articles ORDER BY date_creation DESC LIMIT ' . $num_article . ',' . $articles_par_page . '';

    $liste_articles = $bdd->prepare($sql);

    //on place la requête exécutée dans une variable
    $liste_articles->execute();

    //on retourne la requête exécutée
    return $liste_articles;
}

function nombrePages($art_p)
{

    $articles_par_page = $art_p;
    //on prépare la requête de récupération de tous les articles

    require('connecter-bdd.php');

    $sql = 'SELECT COUNT(*) AS nb_articles FROM articles';
    $req = $bdd->prepare($sql);

    //on exécute la requête préparée
    $req->execute();

    //on récupère le nombre d'articles
    $res = $req->fetch();
    $nbr_articles = $res['nb_articles'];

    //on déduit le nombre de pages nécessaires
    $nbr_pages = ceil(($nbr_articles/$articles_par_page));

    return $nbr_pages;
}

function numeroPage($get)
{
        //on réduit la faille XSS de la donnée récupérée
        $get = htmlspecialchars($get);

        //on s'assure du bon typage de la donnée
        $num_page = (int)$get;

        //si le numéro de page est supérieur à 100
        if($num_page > 100)
        {   //on affiche un message d'erreur
            ?>
                <section class="bloc center padding"  style="text-align:center;">
                <h2>Bizarre ce numéro de page...</h2>
                </section>
            <?php
         }

    return $num_page;
}

function articlesParPage($nbr)
{
    $articles_par_page = $nbr;
    return $articles_par_page;
}