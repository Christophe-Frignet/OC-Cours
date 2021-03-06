<section class="">
    <?php
        while ($article = $liste_articles->fetch()) 
        {
        ?>
            <section class="bloc center padding">

            <h3>
                <?=$article['titre'];?> - Le <?=$article['date_creation_fr'];?>
            </h3>

            <p>
                <?=$article['contenu'];?><br /><br />

                <a href="index.php?action=afficherArticle&id_article=<?=$article['id'];?>">Afficher l'article et ses commentaires >></a>

                <?php
                //Si l'accès admin est autorisé on affiche les options de l'administrateur
                    if (isset($admin_access) AND $admin_access == true)
                    {
                    ?>
                    <ul>
                        <li><a href="index.php?action=afficherModificationArticle&id_article=<?=$article['id'];?>">Modifier l'article</a></li>
                        <li><a href="index.php?action=supprimerArticle&id=<?=$article['id'];?>">Supprimer l'article</a></li>
                    </ul>    
                    <?php
                    }
                ?>
            </p>

            </section>
        <?php
        }
        $liste_articles->closeCursor();
    ?> 
</section>