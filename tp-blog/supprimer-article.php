<?php

//on récupère l'id de l'article à supprimer
$id_article = $_GET['id'];

//on se connecte à la base de données
include('connecter-bdd.php');

//on supprime dans la table la ligne correspondant à l'article 
$sql ='DELETE FROM billets WHERE id = :id';
$req = $bdd->prepare($sql);

$req->execute(array(
    'id' => $id_article
    ));

$req->closeCursor(); // Important : on libère le curseur pour la prochaine requête

//on retourne sur la page d'accueil
header('Location: index.php');

?>
