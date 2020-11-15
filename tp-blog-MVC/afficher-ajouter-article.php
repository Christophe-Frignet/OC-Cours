<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Commentaires</title>
</head>

<body>

<p style="text-align: center;"><a href="index.php"><< Retour à l'accueil</a></p>

<h1>Ajouter article</h1>

<section class="bloc center padding">
    <form action="ajouter-article-traitement.php" method="post">

        <label for="titre">Titre de l'article</label><br>
        <input type="text" id="titre" name="titre" value="Titre de l'article"><br><br>

        <label for="contenu">Contenu de l'article</label><br>
        <textarea id="contenu" name="contenu" rows="10" cols="100">Contenu de l'article</textarea><br><br>

        <input type="submit" value="Valider article">
    </form>
</section>

</body>