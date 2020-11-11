<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Billets de blog</title>
</head>

<body>

<p style="text-align:center;"><a href="index.php"><< Liste articles</a></p>
<p style="text-align:center;"><a href="creer-acces-admin.php">Création accès administrateur >></a></p>

<section class="bloc center padding">
    <h2>Connexion administrateur</h2>
        <form  method="POST" action="connecter-admin-traitement.php">
                    
            <label for="id_admin_access">Identifiant</label><br>
            <input type="text" id="id_admin_access" name="id_admin_access"><br>
    
            <label for="pwd_admin_access">Mot de passe</label><br>
            <input type="text" id="pwd_admin_access" name="pwd_admin_access"><br>

            <input type="submit" value="Envoyer">
        </form>
</section>

</body>
