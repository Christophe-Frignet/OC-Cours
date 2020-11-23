<?php

require_once('vendor/autoload.php');

use Modele\Backend\{
    Article,
    Admin,
};

function afficherAjoutArticle()
{
    require('view/ajout-article.php');
}

function ajouterArticleController($post_titre_article,$post_contenu_article)
{
    $articleBackendManager = new Article();
    $req = $articleBackendManager->ajouterArticle($post_titre_article, $post_contenu_article);
    
    header('Location: index.php');
}

function afficherModificationArticle($id_article)
{
    $articles = new Article();
    $article = $articles->recupererUnArticle($id_article);

    $titre_article = $article['titre'];
    $contenu_article = $article['contenu'];

    require('view/modification-article.php');
}

function modifierArticleController($id_article, $titre_article, $contenu_article)
{
    $articleBackendManager = new Article();
    $req = $articleBackendManager->modifierArticle($id_article, $titre_article, $contenu_article);
    
    header('Location: index.php?action=afficherArticle&id_article=' . $id_article . '');
}

function supprimerArticleController($id_article)
{
    $articleBackendManager = new Article();
    $req = $articleBackendManager->supprimerArticle($id_article);
    
    header('Location: index.php');
}

function afficherConnexionAdmin()
{
    require('view/connexion-admin.php');
}

function connecterAdminController($id_admin,$mdp_formulaire)
{
    $adminBackendManager = new Admin();
    $adminBackendManager->connecterAdmin($id_admin,$mdp_formulaire);
    
    if($_SESSION['access'] == 'admin'){

        header('Location: index.php');
    }
    else{

        header('Location: index.php?action=afficherConnexionAdmin');
    }
}

function afficherCreationAdmin()
{
    require('view/creation-admin.php');
}

function creerAdminController($id_admin,$mdp_admin)
{
    $adminBackendManager = new Admin();
    $req = $adminBackendManager->creerAdmin($id_admin,$mdp_admin);
    
    header('Location: index.php?action=afficherConnexionAdmin');
}

function deconnecterAdminController()
{
    $adminBackendManager = new Admin();
    $page_deconnexion = $adminBackendManager->deconnecterAdmin();

    header('Location: ' . $page_deconnexion . '');
}


