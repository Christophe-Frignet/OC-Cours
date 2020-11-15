<section class="bloc center padding">
    <h1>Commentaires</h1>

    <?php
        while ($commentaire = $commentaires->fetch())
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
        $commentaires->closeCursor();
    ?>

</section>
