<?php session_start(); ?>
<?php include('fonctions.php');?>

<?php //--------------------------Récupération des articles à afficher --------------
    //on récupère le numéro de page
    $num_page = numero_page();

    //on définit le nombre d'articles par page 
    $articles_par_page = 2;

    //Puis on calcul le n° de l'article qui doit s'afficher en premier
    $num_article = ($num_page-1)*$articles_par_page;

    //on se connecte à la bdd
    require('connecter-bdd.php');

    //on prépare la requête de récupération des articles
    $sql = 'SELECT id, titre, contenu, DATE_FORMAT(date_creation,  \'%d/%m/%Y %H:%i:%s\') AS date_creation_fr FROM articles ORDER BY date_creation DESC LIMIT ' . $num_article . ',' . $articles_par_page . '';
    $requete = $bdd->prepare($sql);

    //on execute la requête préparée
    $requete->execute();
?>

<?php  //----------------------------------------------------------Création de la pagination-------
    //on prépare la requête de récupération de tous les articles 
    $sql = 'SELECT COUNT(*) AS nb_billets FROM articles';
    $req = $bdd->prepare($sql);

    //on exécute la requête préparée
    $req->execute();

    //on récupère le nombre d'articles
    $res = $req->fetch();
    $nbr_articles = $res['nb_billets'];

    //on déduit le nombre de pages nécessaires
    $nbr_pages = ceil(($nbr_articles/$articles_par_page));
?>

<?php require('afficher-accueil.php'); ?>