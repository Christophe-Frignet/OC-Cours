<?php

use \Tpblog\Model\{
    ArticleBackendManager,
    AdminBackendManager
};

require_once('model/BackendArticleManager.php');
require_once('model/BackendAdminManager.php');

function afficherAjoutArticle()
{
    require('view/afficher-ajout-article.php');
}

function ajouterArticleController($post_titre_article,$post_contenu_article)
{
    $articleBackendManager = new ArticleBackendManager();
    $req = $articleBackendManager->ajouterArticle($post_titre_article, $post_contenu_article);
    
    header('Location: index.php');
}

function modifierArticleController($id_article, $titre_article, $contenu_article)
{
    $articleBackendManager = new ArticleBackendManager();
    $req = $articleBackendManager->modifierArticle($id_article, $titre_article, $contenu_article);
    
    header('Location: index.php?action=afficherArticle&id_article=' . $id_article . '');
}

function supprimerArticleController($id_article)
{
    $articleBackendManager = new ArticleBackendManager();
    $req = $articleBackendManager->supprimerArticle($id_article);
    
    header('Location: index.php');
}

function afficherConnexionAdmin()
{
    require('view/afficher-connexion-admin.php');
}

function connecterAdminController($id_admin,$mdp_formulaire)
{
    $adminBackendManager = new AdminBackEndManager();
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
    require('view/afficher-creation-admin.php');
}

function creerAdminController($id_admin,$mdp_admin)
{
    $adminBackendManager = new AdminBackendManager();
    $req = $adminBackendManager->creerAdmin($id_admin,$mdp_admin);
    
    header('Location: index.php?action=afficherConnexionAdmin');
}

function deconnecterAdminController()
{
    $adminBackendManager = new AdminBackendManager();
    $page_deconnexion = $adminBackendManager->deconnecterAdmin();

    header('Location: ' . $page_deconnexion . '');
}


