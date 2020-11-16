<?php
session_start();
require('controller/controller.php');

if(isset($_GET['action'])){
    if($_GET['action'] == 'afficherAccueil'){
        afficherAccueil();
    }
    elseif ($_GET['action'] == 'afficherArticle' AND isset($_GET['id_article'])) {
        afficherArticle();//fonctionne si un id_article est passé en GET
    }
    elseif ($_GET['action'] == 'afficherAjoutArticle') {
        afficherAjoutArticle();
    }
    elseif ($_GET['action'] == 'ajouterArticle' AND isset($_POST['titre']) AND isset($_POST['contenu'])) {
        $post_titre_article = $_POST['titre'];
        $post_contenu_article = $_POST['contenu'];
        ajouterArticleController($post_titre_article,$post_contenu_article);
    }
}
else{
    afficherAccueil();
}