<section class="">
    <?php
        while ($article = $requete->fetch())
        {
        ?>
            <section class="bloc center padding">

            <h3>
                <?php echo $article['titre']; ?>
                    - Le 
                    <?php echo $article['date_creation_fr']; ?>
            </h3>

            <p>
                <?php echo $article['contenu']; ?><br /><br />

                <a href="article.php?id_billet=<?php echo $article['id']; ?>">Afficher l'article et ses commentaires >></a>

                <?php
                //Si l'accès admin est autorisé on affiche les options de l'administrateur
                    if (isset($admin_access) AND $admin_access == true)
                    {
                    ?>
                    <ul>
                        <li><a href="modifier-article.php?id_billet=<?php echo $article['id']; ?>">Modifier l'article</a></li>
                        <li><a href="supprimer-article.php?id=<?php echo $article['id']; ?>">Supprimer l'article</a></li>
                    </ul>    
                    <?php
                    }
                ?>
            </p>

            </section>
        <?php
        }
        $requete->closeCursor();
    ?> 
</section>