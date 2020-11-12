<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Créer accès admin</title>
</head>

<body>

<p style="text-align:center;"><a href="index.php">Liste articles</a></p>
<p style="text-align:center;"><a href="connecter-admin.php">Connexion administrateur</a></p>

<section class="bloc center padding">
    <h2>Création accès administrateur</h2>
        <form  method="POST" action="creer-acces-admin-traitement.php">
                    
            <label for="id_admin">Identifiant</label><br>
            <input type="text" id="id_admin" name="id_admin"><br>
    
            <label for="mdp_admin">Mot de passe</label><br>
            <input type="text" id="mdp_admin" name="mdp_admin"><br>

            <input type="submit" value="Envoyer en BDD">
        </form>
</section>

</body>
