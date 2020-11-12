<?php

//on récupère l'id de l'article à supprimer
$id_article = $_GET['id'];

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

//on retourne sur la page d'accueil
header('Location: index.php');

?>
