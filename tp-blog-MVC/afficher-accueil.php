<!DOCTYPE html>

<html lang="fr">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
        <title>TP Blog</title>
    </head>

    <body>

        <?php require('afficher-acces.php'); ?>

        <h1>Accueil</h1>

        <?php require('afficher-option-ajout-article.php'); ?>

        <?php require('afficher-liste-articles.php'); ?>

        <?php require('afficher-pagination.php'); ?>

    </body>

</html> 