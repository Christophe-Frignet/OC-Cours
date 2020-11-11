<?php
$id_article = $_GET['id'];

//on se connecte à la base de données
include('connexion_bdd.php');

//On met à jour les champs récupérés dans le formulaire de modification d'article
$sql ='DELETE FROM billets WHERE id = :id';
$req = $bdd->prepare($sql);

$req->execute(array(
    'id' => $id_article
    ));

$req->closeCursor(); // Important : on libère le curseur pour la prochaine requête

header('Location: index.php');

?>
