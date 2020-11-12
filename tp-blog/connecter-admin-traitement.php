<?php
session_start();

//si on a bien un id et un mot de passe passés par le formulaire
if (isset($_POST['id_admin_access']) AND isset($_POST['pwd_admin_access'])) {

    //on limite les risques de faille XSS
    $id_admin = htmlspecialchars($_POST['id_admin_access']);
    $mdp_formulaire = htmlspecialchars($_POST['pwd_admin_access']);

    //On se connecte à la BDD
    include('connecter-bdd.php');

    //on prépare la requête qui trouvera le mot de passe correspondant à l'id
    $sql = 'SELECT id, id_admin, pwd_admin FROM acces_admin WHERE id_admin = :id_admin;';

    //on exécute la requête
    $req = $bdd->prepare($sql);
    $req->execute(array(
        'id_admin' => $id_admin
        ));

    //on recupère le mot de passe
    $res = $req->fetch();
    $mdp_bdd = $res['pwd_admin'];

    //si le mot de passe envoyé par le formulaire correspond au mot de passe récupéré
    if (password_verify($mdp_formulaire, $mdp_bdd)) {
        
        //on enregistre l'accès "admin" dans la session
        $_SESSION['access'] = 'admin';

        //et on retourne sur la page principale
        header('Location: index.php?');
    
    //sinon on rafraîchit le formulaire de connection admin
    } else {
        header('Location: connecter-admin.php?');
    }
    
//sinon, si les $_POST attendues ne sont pas là
} else {
    //on charge la page principale
    header('Location: index.php?');
}