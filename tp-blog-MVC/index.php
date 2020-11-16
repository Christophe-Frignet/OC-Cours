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
}
else{
    afficherAccueil();
}