<?php

//on récupère les données
$titre_article = $_POST['titre'];
$contenu_article = $_POST['contenu'];
$id_article = $_POST['id'];

//on se connecte à la base de données
include('connecter-bdd.php');

//On met à jour les données dans la table 
$req = $bdd->prepare('UPDATE billets SET titre = :titre , contenu = :contenu WHERE id = :id');

$req->execute(array(
    'titre' => $titre_article,
    'contenu' => $contenu_article,
    'id' => $id_article
    ));

//on libère le curseur pour la prochaine requête
$req->closeCursor(); 

//on affiche la page de l'article modifié
header('Location: article.php?id_billet= ' . $id_article . '');

?>
