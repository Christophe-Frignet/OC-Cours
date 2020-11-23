<!DOCTYPE html>

<html lang="fr">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="public/css/style.css">
        <title><?=$titre_page?></title>
    </head>

    <body>
        <?php
        require('view/acces.php');
        ?>

        <h1>Accueil</h1>

        <?php
        require('view/backend/option-ajout-article.php');
        require('view/frontend/modules/liste-articles.php');
        require('view/frontend/modules/pagination.php');
        ?> 
    </body>

</html> 
