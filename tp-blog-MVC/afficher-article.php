<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Article</title>
</head>

<body>

<section class="bloc center">
    <p style="text-align:center;">
        <?php include('afficher-acces.php'); ?>
    </p>
</section>

<p style="text-align: center;"><a href="index.php"><< Retour à l'accueil</a></p>

<section class="bloc center padding">

    <h3>
        <?php echo htmlspecialchars($article['titre']); ?>
            - Le 
            <?php echo $article['date_creation_fr'] ?>
    </h3>
    <p>
        <?php echo($article['contenu']);?><br /><br />

        <?php
        //Si l'accès admin est autorisé on affiche les options de l'administrateur
            if (isset($admin_access) AND $admin_access == true)
            {
            ?>
            <ul>
                <li><a href="modifier-article.php?id_billet=<?php echo($article['id']);?>">Modifier l'article</a></li>
                <li><a href="supprimer-article.php?id=<?php echo($article['id']);?>">Supprimer l'article</a></li>
            </ul>    
            <?php
            }
        ?>
    </p>

</section>

<?php

//on affiche les commentaires de l'article
include('afficher-commentaires.php');

//on affiche le module d'ajout de commentaires
include('ajouter-commentaire.php');

?>

</body>
</html>