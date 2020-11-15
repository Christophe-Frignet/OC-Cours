<?php session_start();

require('modele.php');

if(isset($_GET['id_article'])) 
{
    $id_article = idArticle($_GET['id_article']);
}
else
{
    header('Location: index.php');
}

$article = recupererUnArticle($id_article);

if($article != false)
{
    require('afficher-article.php');

    $commentaires = recupererCommentaires($id_article);
    require('afficher-commentaires.php');
    require('afficher-ajout-commentaire.php');
}
else
{
    header('Location: index.php');
}

