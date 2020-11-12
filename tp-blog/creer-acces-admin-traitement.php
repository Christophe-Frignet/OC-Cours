<?php

//si les variables sont bien passées en POST
if (isset($_POST['id_admin']) AND isset($_POST['pwd_admin'])) {
    
    //on initialise les variables pour la requête bdd
    $id = $_POST['id_admin'];
    $pwd = password_hash($_POST['pwd_admin'], PASSWORD_DEFAULT);

    //On se connecte à la BDD
    include('connecter-bdd.php');

    //On prépare la requête d'enregistrement des accès
    $sql = 'INSERT INTO acces_admin (id_admin, pwd_admin) VALUES (:id, :pwd);';
    $req = $bdd->prepare($sql);

    //on exécute la requête
    $req->execute(array(
        'id' => $id,
        'pwd' => $pwd
        ));
    
    //on retourne sur la page de connexion admin
    header('Location: connecter-admin.php');
    
//sinon, si aucune variable n'est passée en POST, on affiche un message d'erreur
} else {
    echo 'Les variables n\'existent pas !';
}