<?php
require_once('vendor/autoload.php');

use Modele\Frontend\FrontEnd;

function afficherAccueil()
{
    if(isset($_GET['num_page']))
    {
        $frontEnd = new FrontEnd();
        $num_page = $frontEnd->numeroPage($_GET['num_page']);
    }
    else
    {
        $frontEnd = new FrontEnd();
        $num_page = 1;
    }

    $articles_par_page = 2;

    $nbr_pages = $frontEnd->nombrePages($articles_par_page);

    if (!empty($nbr_pages)) {
        $liste_articles = $frontEnd->recupererListeArticles($num_page,$articles_par_page);
    } else {
        throw new Exception('Le nombre de pages n\'est pas défini');
    }
    
    require('view/afficher-accueil.php'); 
}

function afficherArticle($id_article)
{
    $frontEnd = new FrontEnd();
    $article = $frontEnd->recupererUnArticle($id_article);

    if($article != false)
    {
        require('view/afficher-article.php');

        $commentaires = $frontEnd->recupererCommentaires($id_article);

        require('view/afficher-commentaires.php');
        require('view/afficher-ajout-commentaire.php');
    }
    else
    {
        throw new Exception('Aucun article retourné par la base');
    } 
}

function afficherModificationArticle($id_article)
{
    $frontEnd = new FrontEnd();
    $article = $frontEnd->recupererUnArticle($id_article);

    $titre_article = $article['titre'];
    $contenu_article = $article['contenu'];

    require('view/afficher-modification-article.php');
}


function ajouterCommentaireController($id_article,$date_commentaire,$auteur,$commentaire)
{
    $frontEnd = new FrontEnd();
    $commentaire_ajout = $frontEnd->ajouterCommentaire($id_article,$date_commentaire,$auteur,$commentaire);

    if ($commentaire_ajout === false) {
        throw new Exception('L\'ajout de commentaire a échoué');
    } else {
        header('Location: index.php?action=afficherArticle&id_article=' . $id_article .'');
    }
}

function connecterBdd()
{
    $dsn = 'mysql:host=localhost;dbname=tp_blog';
    $username = 'root';
    $password = '';

    try
    {
        $bdd = new PDO($dsn, $username, $password,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        return $bdd;
    }
    catch(Exception $e)
    {
        die('Erreur : '.$e->getMessage());
    }
}
