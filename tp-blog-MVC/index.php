<?php session_start(); ?>

<?php require('modele.php'); ?>

<?php //on définit le numéro de la page
    if (isset($_GET['num_page']))
    {
        $num_page = numeroPage($_GET['num_page']);
    } else {
        $num_page = 1;
    }
?>
    
<?php //on définit le nombre d'articles par page 
    $articles_par_page = articlesParPage(2);
?>


<?php $nbr_pages = nombrePages($articles_par_page);?>

<?php $requete = recupererArticles($num_page,$articles_par_page); ?>

<?php require('afficher-accueil.php'); ?>