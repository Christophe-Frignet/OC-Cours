<?php
//On prépare la requête pour récupérer les commentaires de l'article
$sql = 'SELECT id_billet, auteur, commentaire, DATE_FORMAT(date_commentaire, \'%d/%m/%Y %H:%i:%s\') AS date_commentaire_fr FROM commentaires WHERE id_billet = ?';
$req = $bdd->prepare($sql);

//on exécute la requête
$req->execute(array($id_article));

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
