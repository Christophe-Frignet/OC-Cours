<?php
$titre_article = $_POST['titre'];
$contenu_article = $_POST['contenu'];
$id_article = $_POST['id'];

//on se connecte à la base de données
include('connexion_bdd.php');

//On met à jour les champs récupérés dans le formulaire de modification d'article
$req = $bdd->prepare('UPDATE billets SET titre = :titre , contenu = :contenu WHERE id = :id');

$req->execute(array(
    'titre' => $titre_article,
    'contenu' => $contenu_article,
    'id' => $id_article
    ));

$req->closeCursor(); // Important : on libère le curseur pour la prochaine requête

header('Location: commentaires.php?id_billet= ' . $id_article . '');

?>
