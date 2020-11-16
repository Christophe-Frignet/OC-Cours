<section class="">
    <?php
        if (isset($admin_access) AND $admin_access == true)
        {
        ?>
            <p style="text-align:center;">
                <a href="index.php?action=afficherAjoutArticle">+ Ajouter un article</a>
            </p> 
        <?php
        }
    ?>
</section>