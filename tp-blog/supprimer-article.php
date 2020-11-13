<?php

//si un id est récupéré dans $_GET
if(isset($_GET['id']))
{
    //on réduit la faille XSS de l'id récupéré
    $id_article = htmlspecialchars($_GET['id']);

    //on s'assure du bon typage de l'id
    $id_article = (int)$id_article;

    //on se connecte à la base de données
    include('connecter-bdd.php');

    //on prépare la requête de suppresion de l'article
    $sql ='DELETE FROM billets WHERE id = :id';
    $req = $bdd->prepare($sql);

    //on exécute la requête
    $req->execute(array(
        'id' => $id_article
        ));

    //on libère le curseur pour la prochaine requête
    $req->closeCursor(); 
}
    //on retourne sur la page d'accueil dans tous les cas
    header('Location: index.php');
