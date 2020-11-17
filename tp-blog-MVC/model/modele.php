<?php

function recupererListeArticles($num_page,$articles_par_page) 
{
    //On calcul le n° de l'article qui doit s'afficher en premier
    $num_article = ($num_page-1)*$articles_par_page;

    //on se connecte à la bdd
    $bdd = connecterBdd();

    //on prépare la requête de récupération des articles
    $sql = 'SELECT id, titre, contenu, DATE_FORMAT(date_creation,  \'%d/%m/%Y %H:%i:%s\') AS date_creation_fr FROM articles ORDER BY date_creation DESC LIMIT ' . $num_article . ',' . $articles_par_page . '';

    $liste_articles = $bdd->prepare($sql);

    //on place la requête exécutée dans une variable
    $liste_articles->execute();

    //on retourne la requête exécutée
    return $liste_articles;
}

function nombrePages($articles_par_page)
{
    //on se connecte à la bdd
    $bdd = connecterBdd();

    $sql = 'SELECT COUNT(*) AS nb_articles FROM articles';
    $req = $bdd->prepare($sql);

    //on exécute la requête préparée
    $req->execute();

    //on récupère le nombre d'articles
    $res = $req->fetch();
    $nbr_articles = $res['nb_articles'];

    //on déduit le nombre de pages nécessaires
    $nbr_pages = ceil(($nbr_articles/$articles_par_page));

    return $nbr_pages;
}

function numeroPage($get)
{
    //on réduit la faille XSS du $_GET reçu
    $get = htmlspecialchars($get);

    //on s'assure du typage de la donnée
    $num_page = (int)$get;
    
    //on définit le numéro de la page
    if ($num_page < 100)
    {
        return $num_page;
    }
    else
    {
        $num_page = 1;
        return $num_page;
    } 
}

function idArticle($id_article)
{
    //on réduit la faille XSS de l'id reçu
    $id_article = htmlspecialchars($id_article);

    //on s'assure du typage de l'id
    $id_article = (int)$id_article;

    return $id_article;
}

function recupererUnArticle($id_article)
{
    //on se connecte à la bdd
    $bdd = connecterBdd();

    //on prépare la requête de récupération de l'article demandé
    $sql ='SELECT id, titre, contenu, DATE_FORMAT(date_creation,  \'%d/%m/%Y\') AS date_creation_fr FROM articles WHERE id = ?';
    $req = $bdd->prepare($sql);

    //on exécute la requête
    $req->execute(array($id_article));

    //on récupère l'article 
    $article = $req->fetch();

    //on ferme le curseur pour une prochaine requête
    $req->closeCursor();

    return $article;
}

function recupererCommentaires($id_article)
{
    //on se connecte à la bdd
    $bdd = connecterBdd();

    //On prépare la requête pour récupérer les commentaires de l'article
    $sql = 'SELECT id_article, auteur, commentaire, DATE_FORMAT(date_commentaire, \'%d/%m/%Y %H:%i:%s\') AS date_commentaire_fr FROM commentaires WHERE id_article = ?';
    $commentaires = $bdd->prepare($sql);

    //on exécute la requête
    $commentaires->execute(array($id_article));

    return $commentaires;
}

function ajouterArticle($post_titre_article, $post_contenu_article)
{
    //on réduit la faille XSS sur la récupération des données
    $titre_article = htmlspecialchars($post_titre_article);
    $contenu_article = htmlspecialchars($post_contenu_article);

    //on s'assure du typage des données transmises
    $titre_article = (string)$titre_article;
    $contenu_article = (string)$contenu_article;

    //on se connecte à la base de données
    $bdd = connecterBdd();

    //On enregistre les nouvelles données dans la table
    $sql = 'INSERT INTO articles (titre, contenu) VALUES ( :titre, :contenu)';
    $req = $bdd->prepare($sql);

    $req->execute(array(
        'titre' => $titre_article,
        'contenu' => $contenu_article
        ));

    //on libère le curseur pour la prochaine requête
    $req->closeCursor(); 
}

function ajouterCommentaire($id_article,$date_commentaire,$auteur,$commentaire)
{
    //on réduit la faille XSS des données récupérées
	$id_article = htmlspecialchars($_POST['id_article']);
	$auteur = htmlspecialchars($_POST['auteur']);
	$commentaire = htmlspecialchars($_POST['commentaire']);
	$date_commentaire = htmlspecialchars($_POST['date_commentaire']);

	//on s'assure du typage des données transmises
	$id_article = (int)$id_article;
	$auteur = (string)$auteur;
	$commentaire = (string)$commentaire;
	$date_commentaire = (string)$date_commentaire;

	//On se connecte à la bdd
    $bdd = connecterBdd();

	//On ajoute le nouveau commentaire dans la BDD
	$req = $bdd->prepare('INSERT INTO commentaires (id_article, auteur, commentaire, date_commentaire) VALUES ( :id_article, :auteur, :commentaire, :date_commentaire)');

	$req->execute(array(
		'id_article' => $id_article,
		'auteur' => $auteur,
		'commentaire' => $commentaire,
		'date_commentaire' => $date_commentaire
		));

	//on libère le curseur pour la prochaine requête
	$req->closeCursor(); 
}

function connecterAdmin($id_admin,$mdp_formulaire)
{
    //on limite les risques de faille XSS
    $id_admin = htmlspecialchars($_POST['id_admin']);
    $mdp_formulaire = htmlspecialchars($_POST['mdp_formulaire']);

    //on s'assure du typage des données
    $id_admin = (string)$id_admin;
    $mdp_formulaire = (string)$mdp_formulaire;

    //On se connecte à la BDD
    $bdd = connecterBdd();

    //on prépare la requête qui trouvera le mot de passe correspondant à l'id
    $sql = 'SELECT id, id_admin, mdp_admin FROM acces_admin WHERE id_admin = :id_admin;';

    //on exécute la requête
    $req = $bdd->prepare($sql);
    $req->execute(array(
        'id_admin' => $id_admin
        ));

    //on recupère le mot de passe
    $res = $req->fetch();
    $mdp_bdd = $res['mdp_admin'];

    //si le mot de passe envoyé par le formulaire correspond au mot de passe récupéré
    if (password_verify($mdp_formulaire, $mdp_bdd)) {
        
        //on enregistre l'accès "admin" dans la session
        $_SESSION['access'] = 'admin';
    }
    else
    {
        header('Location: index.php?action=afficherConnexionAdmin');
    }
}

function creerAdmin($id_admin,$mdp_admin)
{
    //on réduit la faille XSS
    $id_admin = htmlspecialchars($_POST['id_admin']);
    $mdp_admin = htmlspecialchars($_POST['mdp_admin']);

    //on s'assure du typage des données
    $id_admin = (string)$id_admin;
    $mdp_admin = (string)$mdp_admin;

    //on crypte le mot de passe avant de le mettre dans la bdd
    $mdp_admin_crypte = password_hash($mdp_admin, PASSWORD_DEFAULT);

    //On se connecte à la BDD
    include('connecter-bdd.php');

    //On prépare la requête d'enregistrement des accès
    $sql = 'INSERT INTO acces_admin (id_admin, mdp_admin) VALUES (:id, :pwd);';
    $req = $bdd->prepare($sql);

    //on exécute la requête
    $req->execute(array(
        'id' => $id_admin,
        'pwd' => $mdp_admin_crypte
        ));
}

function deconnecterAdmin()
{
    //on supprime l'accès
    session_destroy();

    //on récupère la page qui a demandé la déconnexion
    $page_deconnexion = $_SERVER['HTTP_REFERER'];

    return $page_deconnexion;
}

function connecterBdd()
{
    $dsn = 'mysql:host=localhost;dbname=tp_blog';
    $username = 'root';
    $password = '';

    try
    {
        $bdd = new PDO($dsn, $username, $password,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        return $bdd;
    }
    catch(Exception $e)
    {
        die('Erreur : '.$e->getMessage());
    }
}