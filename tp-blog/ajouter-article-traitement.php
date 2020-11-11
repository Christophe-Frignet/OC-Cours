<?php
$titre_article = $_POST['titre'];
$contenu_article = $_POST['contenu'];

//on se connecte à la base de données
include('connexion_bdd.php');

//On met à jour les champs récupérés dans le formulaire de modification d'article
$sql = 'INSERT INTO billets (titre, contenu) VALUES ( :titre, :contenu)';
$req = $bdd->prepare($sql);

$req->execute(array(
    'titre' => $titre_article,
    'contenu' => $contenu_article
    ));

$req->closeCursor(); // Important : on libère le curseur pour la prochaine requête

header('Location: index.php');

?>
