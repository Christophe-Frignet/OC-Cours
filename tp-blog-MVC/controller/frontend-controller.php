<?php
require('model/frontend-model.php');

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

    if (!empty($nbr_pages)) {
        $liste_articles = recupererListeArticles($num_page,$articles_par_page);
    } else {
        throw new Exception('Le nombre de pages n\'est pas défini');
    }
    
    require('view/afficher-accueil.php'); 
}

function afficherArticle($id_article)
{
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
        throw new Exception('Aucun article retourné par la base');
    } 
}

function ajouterCommentaireController($id_article,$date_commentaire,$auteur,$commentaire)
{
    $commentaire_ajout = ajouterCommentaire($id_article,$date_commentaire,$auteur,$commentaire);

    if ($commentaire_ajout === false) {
        throw new Exception('L\'ajout de commentaire a échoué');
    } else {
        header('Location: index.php?action=afficherArticle&id_article=' . $id_article .'');
    }
}
