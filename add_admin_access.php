<?php

if (isset($_POST['id_admin']) AND isset($_POST['pwd_admin'])) {
    
    //On se connecte à la BDD
    $dsn = 'mysql:host=localhost;dbname=test';
    $username = 'root';
    $password = '';
    try
    {
        $bdd = new PDO($dsn, $username, $password,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    }
    catch(Exception $e)
    {
            die('Erreur : '.$e->getMessage());
    }

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
    header('Location: createadminaccess.php');
    
//si les variables de session ne sont pas là ...
} else {
    echo 'Les variables n\'existent pas !';
}