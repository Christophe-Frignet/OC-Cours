<?php

//on récupère les données
$titre_article = $_POST['titre'];
$contenu_article = $_POST['contenu'];

//on se connecte à la base de données
include('connecter-bdd.php');

//On enregistre les nouvelles données dans la table
$sql = 'INSERT INTO billets (titre, contenu) VALUES ( :titre, :contenu)';
$req = $bdd->prepare($sql);

$req->execute(array(
    'titre' => $titre_article,
    'contenu' => $contenu_article
    ));

$req->closeCursor(); // Important : on libère le curseur pour la prochaine requête

//on retourne à la page d'accueil
header('Location: index.php');

?>
