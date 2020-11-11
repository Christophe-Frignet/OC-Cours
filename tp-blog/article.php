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

    <h1>Page article avec commentaires</h1>

        <?php
        include('connecter-bdd.php');

        //Récupération de l'article voulu
        $id_billet = htmlspecialchars($_GET['id_billet']);
        $req = $bdd->prepare('SELECT id, titre, contenu, DATE_FORMAT(date_creation,  \'%d/%m/%Y\') AS date_creation_fr FROM billets WHERE id = ?');

        $req->execute(array($id_billet));
        
        $article = $req->fetch();

        if (!empty($article)) {
            
            //affichage du billet
            include('afficher-article.php');
    
            $req->closeCursor(); // Important : on libère le curseur pour la prochaine requête
            
            //Récupération des commentaires (du billet choisi)
            $req = $bdd->prepare('SELECT id_billet, auteur, commentaire, DATE_FORMAT(date_commentaire,\'%d/%m/%y\') AS date_commentaire_fr FROM commentaires WHERE id_billet = ?');
            $req->execute(array($id_billet));
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
                </article>
                <?php
                }
                $req->closeCursor();
                ?>
            </section>
            

            <?php
            //on intègre à l'article l'ajout de commentaires
            include('ajouter-commentaire.php');
            ?>
    
        <?php
        } else {
        ?>
            <section class="bloc center padding"  style="text-align:center;">
                <h2>Numéro d'article invalide</h2>
            </section>
        <?php
        }
        ?>

</body>
</html>