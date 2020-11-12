<?php

//Si la session accès est "admin" on passe admin_access à true et on propose la déconnexion
if (isset($_SESSION['access']) AND $_SESSION['access'] = 'admin') {
    ?>
    <strong>ADMINISTRATEUR</strong><br><a href="deconnecter-admin.php">>> se déconnecter <<</a>
    <?php

$admin_access = true;

//Sinon on passe passe admin_access à false et on propose la connexion à l'espace admin
} else {
    ?>
    <strong>UTILISATEUR</strong><br><a href="connecter-admin.php">>> Connecter Admin <<</a>
    <?php
    
$admin_access = false;
}

?>
