<?php

if(isset($_POST['titre']) AND isset($_POST['contenu']) AND isset($_POST['id']))
{
    //on réduit la faille XSS sur la récupération des données
    $titre_article = htmlspecialchars($_POST['titre']);
    $contenu_article = htmlspecialchars($_POST['contenu']);
    $id_article = htmlspecialchars($_POST['id']);

    //on s'assure du bon typage des données
    $titre_article = (string)$titre_article;
    $contenu_article = (string)$contenu_article;
    $id_article = (int)$id_article;

    //on se connecte à la base de données
    include('connecter-bdd.php');

    //on prépare la requête de mise à jour des données dans la table
    $sql = 'UPDATE billets SET titre = :titre , contenu = :contenu WHERE id = :id'; 
    $req = $bdd->prepare($sql);

    //on exécute la requête
    $req->execute(array(
        'titre' => $titre_article,
        'contenu' => $contenu_article,
        'id' => $id_article
        ));

    //on libère le curseur pour la prochaine requête
    $req->closeCursor(); 

    //on affiche la page de l'article modifié
    header('Location: article.php?id_billet= ' . $id_article . '');
}
//sinon sans les variables récupérées dans le $_POST[]
else
{
    //on charge la page d'accueil
    header('Location: index.php');
}
?>
