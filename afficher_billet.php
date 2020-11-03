<section class="bloc center padding">

<?php var_dump($billet['titre']); ?>

<h3>
<?php echo htmlspecialchars($billet['titre']); ?>
     - Le 
     <?php echo $billet['date_creation_fr'] ?>
</h3>
<p>
    <?php echo($billet['contenu']);?>
    <br />
    <a href="commentaires.php?id_billet=<?php echo($billet['id']);?>">Commentaires >></a>
</p>
</section>
