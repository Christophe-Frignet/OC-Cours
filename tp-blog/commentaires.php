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

    <?php include('bloc-acces.php'); ?>

    <p style="text-align: center;"><a href="index.php"><< Retour à la liste des articles</a></p>

    <h1>Page article avec commentaires</h1>

        <?php
        include('connexion_bdd.php');

        //Récupération du billet de blog
        $id_billet = htmlspecialchars($_GET['id_billet']);
        $req = $bdd->prepare('SELECT id, titre, contenu, DATE_FORMAT(date_creation,  \'%d/%m/%Y\') AS date_creation_fr FROM billets WHERE id = ?');

        $req->execute(array($id_billet));
        
        $billet = $req->fetch();

        if (!empty($billet)) {
            
            //affichage du billet
            include('afficher_billet.php');
    
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
    
            <section class="bloc center padding">
                <h2>Ajouter un commentaire</h2>
                <form  method="POST" action="ajout_commentaire.php">
                    <input type="hidden" name="id_billet" value="<?php echo $id_billet ?>">
                    <input type="hidden" name="date_commentaire" value="<?php echo date('Y-m-d') ?>">
                    
                    <label for="auteur">Auteur</label><br>
                    <input type="text" id="auteur" name="auteur"><br>
    
                    <label for="commentaire">Commentaire</label><br>
                    <textarea name="commentaire" id="commentaire" style="width:300px; height:100px;"></textarea><br>
    
                    <input type="submit" value="Envoyer">
                </form>
            </section>
    
        <?php
        } else {
        ?>
            <section class="bloc center padding"  style="text-align:center;">
                <h2>Numéro de billet invalide</h2>
            </section>
        <?php
        }
        ?>

</body>
</html>