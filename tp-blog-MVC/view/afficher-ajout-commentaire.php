<section class="bloc center padding"> 
    <h2>Ajouter un commentaire</h2>
    <form  method="POST" action="index.php?action=ajouterCommentaire">

        <input type="hidden" name="id_article" value="<?=$id_article?>">

        <input type="hidden" name="date_commentaire" value="<?=date('Y-m-d H:i:s')?>">
        
        <label for="auteur">Auteur</label><br>
        <input type="text" id="auteur" name="auteur"><br>

        <label for="commentaire">Commentaire</label><br>
        <textarea name="commentaire" id="commentaire" style="width:300px; height:100px;"></textarea><br>

        <input type="submit" value="Envoyer">
    </form>
</section>