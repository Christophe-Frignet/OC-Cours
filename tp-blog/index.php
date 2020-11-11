<?php session_start(); ?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Billets de blog</title>
</head>

<body>

    <section class="bloc center">
        <p style="text-align:center;">
            <?php include('afficher-acces.php'); ?>
        </p>
    </section>

    <h1>Accueil</h1>

<?php
//Si l'accès admin est autorisé on affiche l'option "ajouter un article"
    if (isset($admin_access) AND $admin_access == true)
    {
    ?>
        <p style="text-align:center;">
            <a href="ajouter-article.php">+ Ajouter un article</a>
        </p> 
    <?php
    }
?>

<?php

//-------------------------------Calcul des articles à afficher (pagination) -----------------

//si on connait le numéro de page on s'en sert
if(isset($_GET['num_page']))
{
    $num_page = $_GET['num_page'];
}
//sinon on considère être sur la page n°1
else
{
    $num_page = 1;
}

//on définit le nombre d'articles par page 
$billets_par_page = 2;

//Puis on calcul le n° de l'article qui doit s'afficher en premier
$num_billet = ($num_page-1)*$billets_par_page;

//---------------------------------Récupération des articles à afficher----------------------------
include('connecter-bdd.php');

$sql = 'SELECT id, titre, contenu, DATE_FORMAT(date_creation,  \'%d/%m/%Y %H:%i:%s\') AS date_creation_fr FROM billets ORDER BY date_creation DESC LIMIT ' . $num_billet . ',' . $billets_par_page . '';

$requete = $bdd->prepare($sql);
$requete->execute();

while ($billet = $requete->fetch())
{
    include('afficher-article.php');
}

$requete->closeCursor();

//--------------------------------------------Création de la pagination----------------

//On récupère le nombre de billets du blog
$sql = 'SELECT COUNT(*) AS nb_billets FROM billets';

$requete = $bdd->prepare($sql);
$requete->execute();

$req = $requete->fetch();
$nbr_billets = $req['nb_billets'];

//on calcule le nombre de pages nécessaires par rapport au nombre d'articles voulus par page
$nbr_pages = ceil(($nbr_billets/$billets_par_page));

//On crée les liens de la pagination
?>
<p style="text-align: center;">
    <?php 
    $num = 1;
    for ($pag = 1; $pag <= $nbr_pages; $pag++)
    {
    ?>
    <a href="?num_page=<?php echo $num;?>">| Page <?php echo $num;?> |</a>

    <?php $num = $num + 1;
    }
    ?>
</p>

</body>
</html>