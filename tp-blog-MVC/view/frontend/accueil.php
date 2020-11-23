<?php
$titre_page = 'Accueil';

ob_start();
    require('view/acces.php');
    ?>

    <h1>Accueil</h1>

    <?php
    require('view/backend/option-ajout-article.php');
    require('view/frontend/modules/liste-articles.php');
    require('view/frontend/modules/pagination.php');

$contenu_page = ob_get_clean();

require('view/frontend/templates/template.php');
?> 
