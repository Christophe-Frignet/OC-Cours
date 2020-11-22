<?php
namespace Modele\Backend; 

require_once('vendor/autoload.php');

use Modele\ModeleGeneral;

class Admin extends ModeleGeneral {

    function connecterAdmin($id_admin,$mdp_formulaire)
    {
        //on limite les risques de faille XSS
        $id_admin = htmlspecialchars($_POST['id_admin']);
        $mdp_formulaire = htmlspecialchars($_POST['mdp_formulaire']);
    
        //on s'assure du typage des données
        $id_admin = (string)$id_admin;
        $mdp_formulaire = (string)$mdp_formulaire;
    
        //On se connecte à la BDD
        $bdd = $this->connecterBdd();
    
        //on prépare la requête qui trouvera le mot de passe correspondant à l'id
        $sql = 'SELECT id, id_admin, mdp_admin FROM acces_admin WHERE id_admin = :id_admin;';
    
        //on exécute la requête
        $req = $bdd->prepare($sql);
        $req->execute(array(
            'id_admin' => $id_admin
            ));
    
        //on recupère le mot de passe
        $res = $req->fetch();
        $mdp_bdd = $res['mdp_admin'];
    
        //si le mot de passe envoyé par le formulaire correspond au mot de passe récupéré
        if (password_verify($mdp_formulaire, $mdp_bdd)) {
            
            //on enregistre l'accès "admin" dans la session
            $_SESSION['access'] = 'admin';
        }
        else
        {
            header('Location: index.php?action=afficherConnexionAdmin');
        }
    }
    
    function creerAdmin($id_admin,$mdp_admin)
    {
        //on réduit la faille XSS
        $id_admin = htmlspecialchars($_POST['id_admin']);
        $mdp_admin = htmlspecialchars($_POST['mdp_admin']);
    
        //on s'assure du typage des données
        $id_admin = (string)$id_admin;
        $mdp_admin = (string)$mdp_admin;
    
        //on crypte le mot de passe avant de le mettre dans la bdd
        $mdp_admin_crypte = password_hash($mdp_admin, PASSWORD_DEFAULT);
    
        //On se connecte à la BDD
        $bdd = $this->connecterBdd();
    
        //On prépare la requête d'enregistrement des accès
        $sql = 'INSERT INTO acces_admin (id_admin, mdp_admin) VALUES (:id, :pwd);';
        $req = $bdd->prepare($sql);
    
        //on exécute la requête
        $req->execute(array(
            'id' => $id_admin,
            'pwd' => $mdp_admin_crypte
            ));

        return $req;
    }
    
    function deconnecterAdmin()
    {
        //on supprime l'accès
        session_destroy();
    
        //on récupère la page qui a demandé la déconnexion
        $page_deconnexion = $_SERVER['HTTP_REFERER'];
    
        return $page_deconnexion;
    }    
}