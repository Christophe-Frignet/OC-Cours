<?php
require_once('ModelManager.php');

class ArticleBackendManager extends ModelManager {

    public function ajouterArticle($post_titre_article, $post_contenu_article)
    {
        //on réduit la faille XSS sur la récupération des données
        $titre_article = htmlspecialchars($post_titre_article);
        $contenu_article = htmlspecialchars($post_contenu_article);

        //on s'assure du typage des données transmises
        $titre_article = (string)$titre_article;
        $contenu_article = (string)$contenu_article;

        //on se connecte à la base de données
        $bdd = $this->connecterBdd();

        //On enregistre les nouvelles données dans la table
        $sql = 'INSERT INTO articles (titre, contenu) VALUES ( :titre, :contenu)';
        $req = $bdd->prepare($sql);

        $req->execute(array(
            'titre' => $titre_article,
            'contenu' => $contenu_article
            ));

        //on libère le curseur pour la prochaine requête
        //$req->closeCursor();

        return $req;
    }

    public function modifierArticle($id_article, $titre_article, $contenu_article)
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
        $bdd = $this->connecterBdd();
    
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
    
    public function supprimerArticle($id_article)
    {
        //on réduit la faille XSS de l'id récupéré
        $id_article = htmlspecialchars($id_article);
    
        //on s'assure du bon typage de l'id
        $id_article = (int)$id_article;
    
        //on se connecte à la base de données
        $bdd = $this->connecterBdd();
    
        //on prépare la requête de suppresion de l'article
        $sql ='DELETE FROM articles WHERE id = :id';
        $req = $bdd->prepare($sql);
    
        //on exécute la requête
        $req->execute(array(
            'id' => $id_article
            ));
    
        //on libère le curseur pour la prochaine requête
        $req->closeCursor();

        return $req;
    }
}