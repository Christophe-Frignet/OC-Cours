<?php

namespace Modele\Frontend;

use Modele\ModeleGeneral;

require_once('modele/ModeleGeneral.php');

class FrontEnd extends ModeleGeneral {

    public function numeroPage($get)
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

    public function nombrePages($articles_par_page)
    {
        //on se connecte à la bdd
        $bdd = $this->connecterBdd();

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

    public function recupererListeArticles($num_page,$articles_par_page) 
    {
        //On calcul le n° de l'article qui doit s'afficher en premier
        $num_article = ($num_page-1)*$articles_par_page;

        //on se connecte à la bdd
        $bdd = $this->connecterBdd();

        //on prépare la requête de récupération des articles
        $sql = 'SELECT id, titre, contenu, DATE_FORMAT(date_creation,  \'%d/%m/%Y %H:%i:%s\') AS date_creation_fr FROM articles ORDER BY date_creation DESC LIMIT ' . $num_article . ',' . $articles_par_page . '';

        $liste_articles = $bdd->prepare($sql);

        //on place la requête exécutée dans une variable
        $liste_articles->execute();

        //on retourne la requête exécutée
        return $liste_articles; 
    }

    public function idArticle($id_article)
    {
        //on réduit la faille XSS de l'id reçu
        $id_article = htmlspecialchars($id_article);

        //on s'assure du typage de l'id
        $id_article = (int)$id_article;

        return $id_article;
    }

    public function recupererUnArticle($id_article)
    {
        //on réduit la faille XSS sur l'id de l'article
        $id_article = htmlspecialchars($_GET['id_article']);

        //on s'assure du bon typage de l'id
        $id_article = (int)$id_article;
        
        //on se connecte à la bdd
        $bdd = $this->connecterBdd();

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

    public function recupererCommentaires($id_article)
    {
        //on se connecte à la bdd
        $bdd = $this->connecterBdd();

        //On prépare la requête pour récupérer les commentaires de l'article
        $sql = 'SELECT id_article, auteur, commentaire, DATE_FORMAT(date_commentaire, \'%d/%m/%Y %H:%i:%s\') AS date_commentaire_fr FROM commentaires WHERE id_article = ?';
        $commentaires = $bdd->prepare($sql);

        //on exécute la requête
        $commentaires->execute(array($id_article));

        return $commentaires;
    }

    public function ajouterCommentaire($id_article,$date_commentaire,$auteur,$commentaire)
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
        $bdd = $this->connecterBdd();

        //On ajoute le nouveau commentaire dans la BDD
        $sql = 'INSERT INTO commentaires (id_article, auteur, commentaire, date_commentaire) VALUES ( :id_article, :auteur, :commentaire, :date_commentaire)';

        $req = $bdd->prepare($sql);

        $commentaire_ajout = $req->execute(array(
            'id_article' => $id_article,
            'auteur' => $auteur,
            'commentaire' => $commentaire,
            'date_commentaire' => $date_commentaire
            ));

        //on libère le curseur pour la prochaine requête
        $req->closeCursor();
        return $commentaire_ajout;
    }
}