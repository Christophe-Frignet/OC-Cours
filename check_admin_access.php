<?php

echo '> La page est chargée <br>';

if (isset($_POST['id_admin_access']) AND isset($_POST['pwd_admin_access'])) {

    echo '> les variables sont passées <br>';
    echo '<p>l\'identifiant envoyé est : ' .$_POST['id_admin_access']. '</p>';
    echo '<p>le mot de passe envoyé est : ' .$_POST['pwd_admin_access']. '</p>';
    
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

    //On cherche dans la BDD le mot de passe qui correspond à l'identifiant
    $id_admin = $_POST['id_admin_access'];

    $sql = 'SELECT id, id_admin, pwd_admin FROM acces_admin WHERE id_admin = :id_admin;';

    $req = $bdd->prepare($sql);

    $req->execute(array(
        'id_admin' => $id_admin
        ));

    $res = $req->fetch();

    echo '<p>le mot de passe correspondant à "' .$res['id_admin'] .'" est : "' . $res['pwd_admin'] .'"</p>';

    // On compare le pass envoyé avec le pass dans la base
    $pass_soumis = $_POST['pwd_admin_access'];
    $pass_base = $res['pwd_admin'];
    if (password_verify($pass_soumis, $pass_base)) {
        echo 'Le mot de passe est valide !';
    } else {
        echo 'Le mot de passe est invalide.';
    }
    
    
//si les variables de session ne sont pas là ...
} else {
    echo 'Les variables n\'existent pas !';
}