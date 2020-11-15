<?php session_start();

require('modele.php');

//On contrôle l'ID passé en GET
if(isset($_GET['id_article'])) 
{
    $id_article = securiserIdArticle($_GET['id_article']);
}
else
{
    header('Location: index.php');
}

//Si il y a bien un article avec cet ID en BDD on l'affiche
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

