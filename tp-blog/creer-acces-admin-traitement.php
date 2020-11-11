<?php

//si les variables sont bien passées en POST
if (isset($_POST['id_admin']) AND isset($_POST['pwd_admin'])) {
    
    //On se connecte à la BDD
    include('connecter-bdd.php');

    //On enregistre le nouvel accès dans la BDD
    $sql = 'INSERT INTO acces_admin (id_admin, pwd_admin) VALUES (:id, :pwd);';

    $req = $bdd->prepare($sql);

    $id = $_POST['id_admin'];
    $pwd = password_hash($_POST['pwd_admin'], PASSWORD_DEFAULT);

    $req->execute(array(
        'id' => $id,
        'pwd' => $pwd
        ));
    
    //on retourne sur la page createadminaccess
    header('Location: connecter-admin.php');
    
//sinon, si aucune variable n'est passée en POST, on affiche un message d'erreur
} else {
    echo 'Les variables n\'existent pas !';
}