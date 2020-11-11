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

//on se connecte à la bdd
include('connecter-bdd.php');

//On récupère l'article demandé
$id_billet = htmlspecialchars($_GET['id_billet']);

$req = $bdd->prepare('SELECT id, titre, contenu, DATE_FORMAT(date_creation,  \'%d/%m/%Y\') AS date_creation_fr FROM billets WHERE id = ?');

$req->execute(array($id_billet));

$article = $req->fetch();

$req->closeCursor();

//Si le numéro d'article existe bien en bdd (la bdd ne renvoit rien dans $article si le numéro n'existe pas)
if (!empty($article)) {
    
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
//On récupère les commentaires de l'article
$sql = 'SELECT id_billet, auteur, commentaire, DATE_FORMAT(date_commentaire,\'%d/%m/%y\') AS date_commentaire_fr FROM commentaires WHERE id_billet = ?';

$req = $bdd->prepare($sql);

$req->execute(array($id_billet));

//On affiche les commentaires récupérés
?>
<section class="bloc center padding">

    <h1>Commentaires</h1>

    <?php
    while ($commentaire = $req->fetch())
    {
    ?>
        <p>
            <b><?php echo htmlspecialchars($commentaire['auteur']);?></b>
            - Le 
            <?php echo $commentaire['date_commentaire_fr'];?> 
            <br />
            <i><?php echo nl2br(htmlspecialchars($commentaire['commentaire'])); ?></i>
        </p>
    <?php
    }
    $req->closeCursor();
    ?>

</section>
            
<?php
//on intègre l'ajout de commentaires
include('ajouter-commentaire.php');

}
//Sinon, si le numéro d'article n'existe pas on affiche un message d'erreur
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