<section class="bloc center padding">
    <h1>Commentaires</h1>

    <?php
        while ($commentaire = $commentaires->fetch())
        {?>
            <p>
                <b>
                    <?=htmlspecialchars($commentaire['auteur']);?>
                </b>
                - Le <?=$commentaire['date_commentaire_fr'];?> 
                <br />
                <i>
                    <?=nl2br(htmlspecialchars($commentaire['commentaire']));?>
                </i>
            </p>
        <?php
        }
        $commentaires->closeCursor();
    ?>

</section>