<?php
$titre_page = 'Accueil';

ob_start();
    require('afficher-acces.php'); ?>

    <h1>Accueil</h1>

    <?php
    require('afficher-option-ajout-article.php');
    require('afficher-liste-articles.php');
    require('afficher-pagination.php');

    $contenu_page = ob_get_clean();

require('template.php');
?>
