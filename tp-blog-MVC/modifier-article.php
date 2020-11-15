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
//---------------------------------------Récupération de l'article à modifier------------------

//si on récupère un id article dans le $_GET
if(isset($_GET['id_article'])) 
{
    //on réduit la faille XSS sur l'id de l'article
    $id_article = htmlspecialchars($_GET['id_article']);

    //on s'assure du bon typage de l'id
    $id_article = (int)$id_article;

    //on se connecte à la bdd
    include('connecter-bdd.php');

    //on prépare la requête pour récupérer l'article demandé
    $sql = 'SELECT id, titre, contenu, DATE_FORMAT(date_creation,  \'%d/%m/%Y\') AS date_creation_fr FROM articles WHERE id = ?';
    $req = $bdd->prepare($sql);

    //on exécute la requête
    $req->execute(array($id_article));

    //on récupère l'article
    $article = $req->fetch();

    //On récupère le titre et le contenu de l'article
    $titre_article = $article['titre'];
    $contenu_article = $article['contenu'];

    //on libère le curseur pour la prochaine requête
    $req->closeCursor();
    ?>
    <!---------------------------------------Navigation------------------------------->
    
    <p style="text-align: center;"><a href="index.php"><< Retour à l'accueil'</a></p>
    <p style="text-align: center;"><a href="article.php?id_article=<?=$id_article;?>"><< Voir l'article</a></p>

    <!---------------------------------------Formulaire de modification--------------->
   
    <h1>Modifier article</h1>

    <section class="bloc center padding">

        <form action="modifier-article-traitement.php" method="post">

            <label for="titre">Titre de l'article</label><br>
            <input type="text" id="titre" name="titre" value="<?=$titre_article;?>"><br><br>

            <label for="contenu">Contenu de l'article</label><br>
            <textarea id="contenu" name="contenu" rows="10" cols="100">

                <?=$contenu_article;?>
                
            </textarea><br><br>

            <input type="hidden" name="id" value="<?=$id_article;?>">

            <input type="submit" value="Valider modifications">

        </form>

    </section>

<?php
}
else
{
    header('Location: index.php');
}
?>
</body>