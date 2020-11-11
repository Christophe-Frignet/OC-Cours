<?php
session_start();

//si on a bien un id et un mot de passe passés par le formulaire
if (isset($_POST['id_admin_access']) AND isset($_POST['pwd_admin_access'])) {

    //On ouvre les deux variables de session
    $_SESSION['id_admin'] = $_POST['id_admin_access'];
    $_SESSION['pass_admin'] = $_POST['pwd_admin_access'];

    //On se connecte à la BDD
    include('connecter-bdd.php');

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

    //si l'id et le mot de passe sont ok
    if (password_verify($pass_soumis, $pass_base)) {
        
        //on enregistre l'accès "admin" dans la session
        $_SESSION['access'] = 'admin';

        //et on retourne sur la page principale
        header('Location: index.php?');
    
    //sinon on rafraîchit le formulaire de connection admin
    } else {
        header('Location: connecter-admin.php?');
    }
    
//sinon, si les variables ne sont pas passées par le formulaire
} else {
    echo 'L\'accès direct à cette page est interdit !';
}