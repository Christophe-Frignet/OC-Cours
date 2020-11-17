<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Commentaires</title>
</head>

<body>

    <p style="text-align: center;"><a href="index.php"><< Retour à l'accueil'</a></p>
    <p style="text-align: center;"><a href="index.php?action=afficherArticle&id_article=<?=$id_article;?>"><< Voir l'article</a></p>

    <h1>Modifier article</h1>

    <section class="bloc center padding">
        <form action="index.php?action=modifierArticle" method="post">

            <input type="hidden" name="id" value="<?=$id_article;?>">

            <label for="titre">Titre de l'article</label><br>
            <input type="text" id="titre" name="titre" value="<?=$titre_article;?>"><br><br>

            <label for="contenu">Contenu de l'article</label><br>
            <textarea id="contenu" name="contenu" rows="10" cols="100"><?=$contenu_article;?></textarea><br><br>

            <input type="submit" value="Valider modifications">

        </form>
    </section>

</body>