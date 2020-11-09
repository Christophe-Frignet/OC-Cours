<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Commentaires</title>
</head>

<body>

<?php
include('connexion_bdd.php');

//Récupération de l'article
$id = htmlspecialchars($_GET['id_billet']);
$req = $bdd->prepare('SELECT id, titre, contenu, DATE_FORMAT(date_creation,  \'%d/%m/%Y\') AS date_creation_fr FROM billets WHERE id = ?');

$req->execute(array($id));
        
$article = $req->fetch();

//On récupère l'id, le titre et le contenu de l'article
$id_article = $article['id'];
$titre_article = $article['titre'];
$contenu_article = $article['contenu'];

$req->closeCursor(); // Important : on libère le curseur pour la prochaine requête

//On affiche les liens de retour
?>
<p style="text-align: center;"><a href="index.php"><< Retour à la liste des articles</a></p>
<p style="text-align: center;"><a href="commentaires.php?id_billet=<?php echo $id_article;?>"><< Voir l'article</a></p>

<! -- On propose un formulaire pré-rempli avec le contenu de l'article existant
 -->
<h1>Modifier article</h1>
<section class="bloc center padding">
    <form action="modifier-article-traitement.php" method="post">
        <label for="titre">Titre de l'article</label><br>
        <input type="text" id="titre" name="titre" value="<?php echo $titre_article;?>">
        <br>
        <br>
        <label for="contenu">Contenu de l'article</label><br>
        <textarea id="contenu" name="contenu" rows="10" cols="100">
            <?php echo $contenu_article;?>
        </textarea>
        <br>
        <br>
        <input type="hidden" name="id" value="<?php echo $id_article;?>">
        <input type="submit" value="Valider modifications">
    </form>
</section>

</body>