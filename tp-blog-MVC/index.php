<?php
session_start();

require('controller/frontend-controller.php');
require('controller/backend-controller.php');

try {
    if(isset($_GET['action'])){

        if($_GET['action'] == 'afficherAccueil'){
            afficherAccueil();
        }

        elseif ($_GET['action'] == 'afficherArticle') {

            if(isset($_GET['id_article'])) {

                $id_article = $_GET['id_article'];
                afficherArticle($id_article);
            }
            else {
                throw new Exception('Aucun id article envoyé');
            }
            
        }

        elseif ($_GET['action'] == 'afficherAjoutArticle') {
            afficherAjoutArticle();
        }

        elseif ($_GET['action'] == 'ajouterArticle') {

            if (isset($_POST['titre']) AND isset($_POST['contenu'])) {

                $post_titre_article = $_POST['titre'];
                $post_contenu_article = $_POST['contenu'];
        
                ajouterArticleController($post_titre_article,$post_contenu_article);
            }

            else {
                throw new Exception('Il faut ajouter l\'article avec le formulaire d\'ajout');
            }
        }

        elseif ($_GET['action'] == 'ajouterCommentaire') {

            if (isset($_POST['id_article']) AND isset($_POST['date_commentaire']) AND isset($_POST['auteur']) AND isset($_POST['commentaire'])) {

                $id_article = $_POST['id_article'];
                $date_commentaire = $_POST['date_commentaire'];
                $auteur = $_POST['auteur'];
                $commentaire = $_POST['commentaire'];
        
                ajouterCommentaireController($id_article,$date_commentaire,$auteur,$commentaire);
    
            } else {
                throw new Exception('Il manque des données pour ajouter un commentaire');
            }
            
        }

        elseif ($_GET['action'] == 'afficherConnexionAdmin') {
            afficherConnexionAdmin();
        }

        elseif ($_GET['action'] == 'connecterAdmin') {

            if (isset($_POST['id_admin']) AND isset($_POST['mdp_formulaire'])) {

                $id_admin = $_POST['id_admin'];
                $mdp_formulaire = $_POST['mdp_formulaire'];
        
                connecterAdminController($id_admin,$mdp_formulaire);
                }
            
            else {
                throw new Exception('Il manque des données pour établir la connexion');
            }
        }

        elseif ($_GET['action'] == 'afficherCreationAdmin') {
            afficherCreationAdmin();
        }

        elseif ($_GET['action'] == 'creerAdmin') {

            if (isset($_POST['id_admin']) AND isset($_POST['mdp_admin'])) {

                $id_admin = $_POST['id_admin'];
                $mdp_admin = $_POST['mdp_admin'];
        
                creerAdminController($id_admin,$mdp_admin);

            }
            
            else {
                throw new Exception('Il manque des données pour créer l\'admin');
            }
        }

        elseif ($_GET['action'] == 'deconnecterAdmin') {
            deconnecterAdminController();
        }

        elseif ($_GET['action'] == 'afficherModificationArticle') {

            if (isset($_GET['id_article'])) {

                $id_article = $_GET['id_article'];
                afficherModificationArticle($id_article);

            }
            
            else {
                throw new Exception('Il manque l\'id de l\'article');
            }
            
        }
        
        elseif ($_GET['action'] == 'modifierArticle') {

            if (isset($_POST['id']) AND isset($_POST['titre']) AND isset($_POST['contenu'])) {
               
                $id_article = $_POST['id'];
                $titre_article = $_POST['titre'];
                $contenu_article = $_POST['contenu'];
        
                modifierArticleController($id_article, $titre_article, $contenu_article);

            }
            
            else {
                throw new Exception('Il manque des données pour modifier l\'article');
            }
        }

        elseif ($_GET['action'] == 'supprimerArticle') {

            if (isset($_GET['id'])) {

                $id_article = $_GET['id'];
                supprimerArticleController($id_article);

            }
            
            else {
                throw new Exception('Il manque l\'id pour supprimer l\'article');
            }
        }
    }

    else {
        afficherAccueil();
    }
}

catch (Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}

