<?php

//si les variables sont bien passées en POST
if (isset($_POST['id_admin']) AND isset($_POST['mdp_admin'])) {
    
    //on réduit la faille XSS
    $id_admin = htmlspecialchars($_POST['id_admin']);
    $mdp_admin = htmlspecialchars($_POST['mdp_admin']);

    //on s'assure du typage des données
    $id_admin = (string)$id_admin;
    $mdp_admin = (string)$mdp_admin;

    //on crypte le mot de passe avant de le mettre dans la bdd
    $mdp_admin_crypte = password_hash($mdp_admin, PASSWORD_DEFAULT);

    //On se connecte à la BDD
    include('connecter-bdd.php');

    //On prépare la requête d'enregistrement des accès
    $sql = 'INSERT INTO acces_admin (id_admin, pwd_admin) VALUES (:id, :pwd);';
    $req = $bdd->prepare($sql);

    //on exécute la requête
    $req->execute(array(
        'id' => $id_admin,
        'pwd' => $mdp_admin_crypte
        ));
    
    //on retourne sur la page de connexion admin
    header('Location: connecter-admin.php');
    
//sinon, si aucune variable n'est passée en POST, on affiche un message d'erreur
} else {
    echo 'Les variables n\'existent pas !';
}