<?php
require_once('vendor/autoload.php');

use Modele\Frontend\{
    Articles,
    Commentaires
};

function afficherAccueil()
{
    if(isset($_GET['num_page']))
    {
        $frontEnd = new Articles();
        $num_page = $frontEnd->numeroPage($_GET['num_page']);
    }
    else
    {
        $frontEnd = new Articles();
        $num_page = 1;
    }

    $articles_par_page = 2;

    $nbr_pages = $frontEnd->nombrePages($articles_par_page);

    if (!empty($nbr_pages)) {
        $liste_articles = $frontEnd->recupererListeArticles($num_page,$articles_par_page);
    } else {
        throw new Exception('Le nombre de pages n\'est pas défini');
    }
    
    require('view/frontend/accueil.php'); 
}

function afficherArticle($id_article)
{
    $article = new Articles();
    $article = $article->recupererUnArticle($id_article);

    if($article != false)
    {
        $commentaires = new Commentaires();
        $commentaires = $commentaires->recupererCommentaires($id_article);

        require('view/frontend/article.php');
        
    }
    else
    {
        throw new Exception('Aucun article retourné par la base');
    } 
}

function ajouterCommentaireController($id_article,$date_commentaire,$auteur,$commentaire)
{
    $commentaire_ajout = new Commentaires();
    $commentaire_ajout = $commentaire_ajout->ajouterCommentaire($id_article,$date_commentaire,$auteur,$commentaire);

    if ($commentaire_ajout === false) {
        throw new Exception('L\'ajout de commentaire a échoué');
    } else {
        header('Location: index.php?action=afficherArticle&id_article=' . $id_article .'');
    }
}

function supprimerCommentaireControleur($id_article,$id_commentaire)
{
    $commentaire_suppression = new Commentaires();
    $commentaire_suppression = $commentaire_suppression->supprimerCommentaire($id_commentaire);

    if ($commentaire_suppression === false) {
        throw new Exception('La suppression de commentaire a échoué');
    } else {
        header('Location: index.php?action=afficherArticle&id_article=' . $id_article .'');
    }
    
}