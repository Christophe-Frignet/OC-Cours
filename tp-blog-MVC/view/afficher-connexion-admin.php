<!DOCTYPE html>

<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Billets de blog</title>
</head>

<body>

<p style="text-align:center;"><a href="index.php"><< Accueil</a></p>
<p style="text-align:center;"><a href="index.php?action=afficherCreationAdmin">Création accès administrateur >></a></p>

<section class="bloc center padding">
    <h2>Connexion administrateur</h2>
        <form  method="POST" action="index.php?action=connecterAdmin">
                    
            <label for="id_admin">Identifiant</label><br>
            <input type="text" id="id_admin" name="id_admin"><br>
    
            <label for="mdp_formulaire">Mot de passe</label><br>
            <input type="password" id="mdp_formulaire" name="mdp_formulaire"><br>

            <input type="submit" value="Envoyer">
        </form>
</section>

</body>
