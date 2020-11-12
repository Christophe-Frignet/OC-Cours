<?php session_start(); ?>

<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Commentaires</title>
</head>

<body>

<section class="bloc center">
    <p style="text-align:center;">
        <?php include('afficher-acces.php'); ?>
    </p>
</section>

<p style="text-align: center;"><a href="index.php"><< Retour à l'accueil</a></p>

<?php
//si on récupère bien une variable id en GET
if(isset($_GET['id_billet']))
{
    //------------------On essaie de récupérer l'article correspondant à cet id
    
    //on réduit la faille XSS de l'id reçu
    $id_article = htmlspecialchars($_GET['id_billet']);

    //on se connecte à la bdd
    include('connecter-bdd.php');

    //on prépare la requête de récupération de l'article demandé
    $sql ='SELECT id, titre, contenu, DATE_FORMAT(date_creation,  \'%d/%m/%Y\') AS date_creation_fr FROM billets WHERE id = ?';
    $req = $bdd->prepare($sql);

    //on exécute la requête
    $req->execute(array($id_article));

    //on récupère l'article 
    $article = $req->fetch();

    //on ferme le curseur pour une prochaine requête
    $req->closeCursor();

    //---------------------Si un article existe avec l'id envoyé

    if (!empty($article))
    {
        //on affiche l'article récupéré
        ?>
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
    }
}

//Sinon, le numéro d'article n'existe pas et on affiche un message d'erreur
else {
?>
    <section class="bloc center padding"  style="text-align:center;">
        <h2>Numéro d'article invalide</h2>
    </section>
<?php
}
?>

</body>
</html>