<?php
$titre_page = 'Accueil';

ob_start();
    require('view/acces.php');
    ?>

    <h1>Accueil</h1>

    <?php
    require('view/option-ajout-article.php');
    require('view/liste-articles.php');
    require('view/pagination.php');

$contenu_page = ob_get_clean();

require('view/template.php');
?> 
