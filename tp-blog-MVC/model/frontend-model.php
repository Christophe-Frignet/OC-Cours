<?php
function numeroPage($get)
{
    //on réduit la faille XSS du $_GET reçu
    $get = htmlspecialchars($get);

    //on s'assure du typage de la donnée
    $num_page = (int)$get;
    
    //on définit le numéro de la page
    if ($num_page < 100)
    {
        return $num_page;
    }
    else
    {
        $num_page = 1;
        return $num_page;
    } 
}

function nombrePages($articles_par_page)
{
    //on se connecte à la bdd
    $bdd = connecterBdd();

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

function recupererListeArticles($num_page,$articles_par_page) 
{
    //On calcul le n° de l'article qui doit s'afficher en premier
    $num_article = ($num_page-1)*$articles_par_page;

    //on se connecte à la bdd
    $bdd = connecterBdd();

    //on prépare la requête de récupération des articles
    $sql = 'SELECT id, titre, contenu, DATE_FORMAT(date_creation,  \'%d/%m/%Y %H:%i:%s\') AS date_creation_fr FROM articles ORDER BY date_creation DESC LIMIT ' . $num_article . ',' . $articles_par_page . '';

    $liste_articles = $bdd->prepare($sql);

    //on place la requête exécutée dans une variable
    $liste_articles->execute();

    //on retourne la requête exécutée
    return $liste_articles; 
}
