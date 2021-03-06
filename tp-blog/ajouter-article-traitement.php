<?php
if(isset($_POST['titre']) AND isset($_POST['contenu']))
{
    //on réduit la faille XSS sur la récupération des données
    $titre_article = htmlspecialchars($_POST['titre']);
    $contenu_article = htmlspecialchars($_POST['contenu']);

    //on s'assure du typage des données transmises
    $contenu_article = (string)$contenu_article;
    $titre_article = (string)$titre_article;

    //on se connecte à la base de données
    include('connecter-bdd.php');

    //On enregistre les nouvelles données dans la table
    $sql = 'INSERT INTO articles (titre, contenu) VALUES ( :titre, :contenu)';
    $req = $bdd->prepare($sql);

    $req->execute(array(
        'titre' => $titre_article,
        'contenu' => $contenu_article
        ));

    //on libère le curseur pour la prochaine requête
    $req->closeCursor(); 

    //on retourne à la page d'accueil
    header('Location: index.php');
}
else
{
    //on retourne à la page d'accueil
    header('Location: index.php');
}
