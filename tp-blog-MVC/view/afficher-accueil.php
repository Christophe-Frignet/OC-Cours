<?php
$titre_page = 'Accueil';

ob_start();
    require('view/afficher-acces.php'); ?>

    <h1>Accueil</h1>

    <?php
    require('view/afficher-option-ajout-article.php');
    require('view/afficher-liste-articles.php');
    require('view/afficher-pagination.php');

    $contenu_page = ob_get_clean();

require('view/template.php');
?>
