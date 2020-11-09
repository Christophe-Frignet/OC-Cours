<?php
session_start();

//si on a bien un id et un mot de passe passés par le formulaire
if (isset($_POST['id_admin_access']) AND isset($_POST['pwd_admin_access'])) {

    //On ouvre les deux variables de session
    $_SESSION['id_admin'] = $_POST['id_admin_access'];
    $_SESSION['pass_admin'] = $_POST['pwd_admin_access'];

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

    // On compare le pass envoyé avec le pass dans la base
    $res = $req->fetch();
    $pass_soumis = $_POST['pwd_admin_access'];
    $pass_base = $res['pwd_admin'];

    if (password_verify($pass_soumis, $pass_base)) {
        //si l'id et le mot de passe sont ok, on retourne sur la page principale
        //avec l'accès "admin" enregistré dans la session
        $_SESSION['access'] = 'admin';
        header('Location: index.php?');
    } else {
        //sinon on recharge le formulaire d'accès admin
        header('Location: adminaccessform.php?');
    }
    
    
//si les variables de session ne sont pas là ...
} else {
    echo 'Les variables n\'existent pas !';
}