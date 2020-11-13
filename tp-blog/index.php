<?php session_start(); ?>
<?php include('fonctions.php');?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>TP Blog</title>
</head>

<body>

    <!--on affiche les droits d'accès-->
    <section class="bloc center">
        <p style="text-align:center;">
            Droits accès :<br>
            <?php include('afficher-acces.php'); ?>
        </p>
    </section>

    <h1>Accueil</h1>

<?php
//si l'accès admin est autorisé on affiche l'option "ajouter un article"
    if (isset($admin_access) AND $admin_access == true)
    {
    ?>
        <p style="text-align:center;">
            <a href="ajouter-article.php">+ Ajouter un article</a>
        </p> 
    <?php
    }

//---------------------------------Calcul du premier article à afficher --------------------------

//on récupère le numéro de page
$num_page = numero_page();

//on définit le nombre d'articles par page 
$articles_par_page = 2;

//Puis on calcul le n° de l'article qui doit s'afficher en premier
$num_article = ($num_page-1)*$articles_par_page;

//---------------------------------Connexion à la BDD---------------------------------------------

//on crée l'objet PDO $bdd
include('connecter-bdd.php');

//---------------------------------Récupération des articles à afficher----------------------------

//on prépare la requête de récupération des articles
$sql = 'SELECT id, titre, contenu, DATE_FORMAT(date_creation,  \'%d/%m/%Y %H:%i:%s\') AS date_creation_fr FROM billets ORDER BY date_creation DESC LIMIT ' . $num_article . ',' . $articles_par_page . '';
$requete = $bdd->prepare($sql);

//on execute la requête préparée
$requete->execute();

//on affiche les articles récupérés
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

//--------------------------------------------Création de la pagination----------------

//on prépare la requête de récupération de tous les articles 
$sql = 'SELECT COUNT(*) AS nb_billets FROM billets';
$requete = $bdd->prepare($sql);

//on exécute la requête préparée
$requete->execute();

//on récupère le nombre d'articles
$req = $requete->fetch();
$nbr_articles = $req['nb_billets'];

//on déduit le nombre de pages nécessaires
$nbr_pages = ceil(($nbr_articles/$articles_par_page));

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