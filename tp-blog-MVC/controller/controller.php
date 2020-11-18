<?php
require('model/modele.php');

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

function afficherAjoutArticle()
{
    require('view/afficher-ajout-article.php');
}

function ajouterArticleController($post_titre_article,$post_contenu_article)
{
    ajouterArticle($post_titre_article,$post_contenu_article);
    header('Location: index.php');
}

function ajouterCommentaireController($id_article,$date_commentaire,$auteur,$commentaire)
{
    ajouterCommentaire($id_article,$date_commentaire,$auteur,$commentaire);
    header('Location: index.php?action=afficherArticle&id_article=' . $id_article .'');
}

function afficherConnexionAdmin()
{
    require('view/afficher-connexion-admin.php');
}

function connecterAdminController($id_admin,$mdp_formulaire)
{
    connecterAdmin($id_admin,$mdp_formulaire);

    if($_SESSION['access'] == 'admin'){

        header('Location: index.php');
    }
    else{

        header('Location: index.php?action=afficherConnexionAdmin');
    }
}

function afficherCreationAdmin()
{
    require('view/afficher-creation-admin.php');
}

function creerAdminController($id_admin,$mdp_admin)
{
    creerAdmin($id_admin,$mdp_admin);
    header('Location: index.php?action=afficherConnexionAdmin');
}

function deconnecterAdminController()
{
    $page_deconnexion = deconnecterAdmin();
    header('Location: ' . $page_deconnexion . '');
}

function afficherModificationArticle($id_article)
{
    $article = recupererUnArticle($id_article);

    $titre_article = $article['titre'];
    $contenu_article = $article['contenu'];

    require('view/afficher-modification-article.php');
}

function modifierArticleController($id_article, $titre_article, $contenu_article)
{
    modifierArticle($id_article, $titre_article, $contenu_article);
    header('Location: index.php?action=afficherArticle&id_article=' . $id_article . '');
}

function supprimerArticleController($id_article)
{
    supprimerArticle($id_article);
    header('Location: index.php');
}