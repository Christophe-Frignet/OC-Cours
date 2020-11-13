<?php
//si tous les POST sont passés
if(isset($_POST['id_article']) AND isset($_POST['auteur']) AND isset($_POST['commentaire']) AND isset($_POST['date_commentaire']))
{
	//on réduit la faille XSS des données récupérées
	$id_article = htmlspecialchars($_POST['id_article']);
	$auteur = htmlspecialchars($_POST['auteur']);
	$commentaire = htmlspecialchars($_POST['commentaire']);
	$date_commentaire = htmlspecialchars($_POST['date_commentaire']);

	//on s'assure du typage des données transmises
	$id_article = (int)$id_article;
	$auteur = (string)$auteur;
	$commentaire = (string)$commentaire;
	$date_commentaire = (string)$date_commentaire;

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
}
else
{
	//on retourne sur la page d'accueil
	header('Location: index.php');
}


?>