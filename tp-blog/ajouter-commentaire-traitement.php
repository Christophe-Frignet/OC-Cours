<?php

//on réduit la faille XSS des données récupérées
$id_article = htmlspecialchars($_POST['id_article']);
$auteur = htmlspecialchars($_POST['auteur']);
$commentaire = htmlspecialchars($_POST['commentaire']);
$date_commentaire = htmlspecialchars($_POST['date_commentaire']);

//On se connecte à la bdd
include('connecter-bdd.php');

//On ajoute le nouveau commentaire dans la BDD
$req = $bdd->prepare('INSERT INTO commentaires (id_billet, auteur, commentaire, date_commentaire) VALUES ( :id_article, :auteur, :commentaire, :date_commentaire)');

$req->execute(array(
	'id_article' => $id_article,
	'auteur' => $auteur,
	'commentaire' => $commentaire,
	'date_commentaire' => $date_commentaire
	));

//on libère le curseur pour la prochaine requête
$req->closeCursor(); 

//on retourne sur la page de l'article
header('Location: article.php?id_billet=' . $id_article);

?>