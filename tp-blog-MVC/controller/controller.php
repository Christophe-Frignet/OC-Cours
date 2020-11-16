<?php
require('model/modele.php');

function afficherAccueil()
{
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
    
    require('view/afficher-accueil.php'); 
}

function afficherArticle()
{
    $id_article = idArticle($_GET['id_article']);

    $article = recupererUnArticle($id_article);

    if($article != false)
    {
        require('view/afficher-article.php');

        $commentaires = recupererCommentaires($id_article);
        require('view/afficher-commentaires.php');
        require('view/afficher-ajout-commentaire.php');
    }
    else
    {
        header('Location: index.php');
    } 
}
