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

        //on définit le nombre de billets par page
        $billets_par_page = 1;
        echo '<p style="text-align: center;">le nombre de billets par page est défini à : ' . $billets_par_page .'<p>';
                

        //on vérifie la récupération du numéro de page avec les liens de pagination
        if(isset($_GET['num_page']))
        {
            echo '<p style="text-align: center;">le numéro de page en cours est : ' . $_GET['num_page'] . '<p>';
            $num_page = $_GET['num_page'];
            echo '<p style="text-align: center;">la variable $num_page contient : ' . $num_page . '<p>';
        }
        else
        {
            echo '<p style="text-align: center;">Il n\'y a pas de numéro de page défini<p>';
            $num_page = 1;
            echo '<p style="text-align: center;">la variable $num_page contient : ' . $num_page . '<p>';
        }

        $num_prem_post = ($num_page -1)*$billets_par_page;
        echo '<p style="text-align: center;">le premier post de la liste qui doit être affiché est le n° : ' . $num_prem_post . '<p>';

        //On récupère tous les billets de blog
        $sql = 'SELECT id, titre, contenu, DATE_FORMAT(date_creation,  \'%d/%m/%Y\') AS date_creation_fr FROM billets ORDER BY date_creation DESC LIMIT ' . $num_prem_post . ',' . $billets_par_page . '';

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
        echo '<p style="text-align: center;">Le nombre total de billets est de : ' . $nbr_billets . '<p>';

        //calcul du nombre de pages nécessaires
        $nbr_pages = ceil(($nbr_billets/$billets_par_page));
        echo '<p style="text-align: center;">Le nombre de pages nécessaires est de : ' . $nbr_pages . '<p>';

        //On crée les liens vers les pages
        $num = 1;

        echo '<p style="text-align: center;">';
        for ($pagination = 1; $pagination <= $nbr_pages; $pagination++)
        {
            echo '<a href="?num_page=' . $num . '">| Page ' . $pagination . ' |</a> ';
            $num = $num + 1;
        }
        echo '</p>';
    ?>
</body>
</html>