<?php

namespace Modele;

use \PDO;

class ModeleGeneral {

    protected function connecterBdd()
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
}