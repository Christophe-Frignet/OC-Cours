<?php

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
    $bdd = connecterBdd();

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

function modifierArticle($id_article, $titre_article, $contenu_article)
{
    //on réduit la faille XSS sur la récupération des données
    $id_article = htmlspecialchars($_POST['id']);
    $titre_article = htmlspecialchars($_POST['titre']);
    $contenu_article = htmlspecialchars($_POST['contenu']);

    //on s'assure du bon typage des données
    $id_article = (int)$id_article;
    $titre_article = (string)$titre_article;
    $contenu_article = (string)$contenu_article;

    //on se connecte à la base de données
    $bdd = connecterBdd();

    //on prépare la requête de mise à jour des données dans la table
    $sql = 'UPDATE articles SET titre = :titre , contenu = :contenu WHERE id = :id'; 
    $req = $bdd->prepare($sql);

    //on exécute la requête
    $req->execute(array(
        'titre' => $titre_article,
        'contenu' => $contenu_article,
        'id' => $id_article
        ));

    //on libère le curseur pour la prochaine requête
    $req->closeCursor(); 
}

function supprimerArticle($id_article)
{
    //on réduit la faille XSS de l'id récupéré
    $id_article = htmlspecialchars($id_article);

    //on s'assure du bon typage de l'id
    $id_article = (int)$id_article;

    //on se connecte à la base de données
    $bdd = connecterBdd();

    //on prépare la requête de suppresion de l'article
    $sql ='DELETE FROM articles WHERE id = :id';
    $req = $bdd->prepare($sql);

    //on exécute la requête
    $req->execute(array(
        'id' => $id_article
        ));

    //on libère le curseur pour la prochaine requête
    $req->closeCursor(); 
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