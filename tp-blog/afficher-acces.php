<?php

//Si la session accès est "admin" on passe admin_access à true et on propose la déconnexion
if (isset($_SESSION['access']) AND $_SESSION['access'] = 'admin') {
    ?>
    <p style="text-align: center;">DROIT ACCES : ADMINISTRATEUR<br><a href="deconnecter-admin.php">>> se déconnecter <<</a></p>
    <?php

$admin_access = true;

//Sinon on passe passe admin_access à false et on propose la connexion à l'espace admin
} else {
    ?>
    <p style="text-align: center;">DROIT ACCES : Utilisateur<br><a href="connecter-admin.php">>> Connecter Admin <<</a></p>
    <?php
    
$admin_access = false;
}

?>
