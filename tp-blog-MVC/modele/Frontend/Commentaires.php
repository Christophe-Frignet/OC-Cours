<?php
namespace Modele\Frontend;

require_once('vendor/autoload.php');

use Modele\ModeleGeneral;

class Commentaires extends ModeleGeneral {

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