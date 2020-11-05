<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Billets de blog</title>
</head>

<body>
    <h1>Articles du blog</h1>

    <?php
        include('connexion_bdd.php');

        $numcom = 0;
            
        //Récupération des billets de blog
        $sql = 'SELECT id, titre, contenu, DATE_FORMAT(date_creation,  \'%d/%m/%Y\') AS date_creation_fr FROM billets ORDER BY date_creation DESC LIMIT ' . $numcom . ',2';

        $requete = $bdd->prepare($sql);
        $requete->execute();

        //Affichage des billets du blog
        while ($billet = $requete->fetch())
        {
            include('afficher_billet.php');
        }
        
        $requete->closeCursor();

        //Récupération du nombre de billets du blog
        $sql = 'SELECT COUNT(*) AS nb_billets FROM billets';

        $requete = $bdd->prepare($sql);
        $requete->execute();

        $req = $requete->fetch();
        $nbr_billets = $req['nb_billets'];
        echo 'Nombre de billets : ' . $nbr_billets;

        //on définit le nombre de billets par page
        $billets_par_page = 2;
        echo '<br>le nombre de billets par page est défini à : ' . $billets_par_page;

        //calcul du nombre de pages nécessaires
        $nbr_pages = ceil(($nbr_billets/$billets_par_page));
        echo '<br>Le nombre de pages nécessaires est de : ' . $nbr_pages . '<br>';

        //On crée les liens vers les pages
        $page_num = 1;

        for ($pagination = 1; $pagination <= $nbr_pages; $pagination++)
        {
            echo '<a href="?page=' . $page_num . '">| Page ' . $pagination . ' |</a> ';
            $page_num = $page_num + 1;
        }
        
    ?>
</body>
</html>