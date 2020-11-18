<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/style.css">
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
        <?=htmlspecialchars($article['titre']);?>
            - Le 
            <?=$article['date_creation_fr']?>
    </h3>
    <p>
        <?=$article['contenu'];?><br /><br />

        <?php
        //Si l'accès admin est autorisé on affiche les options de l'administrateur
            if (isset($admin_access) AND $admin_access == true)
            {
            ?>
            <ul>
                <li><a href="index.php?action=afficherModificationArticle&id_article=<?=$article['id'];?>">Modifier l'article</a></li>
                <li><a href="index.php?action=supprimerArticle&id=<?=($article['id']);?>">Supprimer l'article</a></li>
            </ul>    
            <?php
            }
        ?>
    </p>

</section>