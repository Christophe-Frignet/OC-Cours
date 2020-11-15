<section class="bloc center padding">
    <p style="text-align:center;">
        Droits accès :<br>
        <?php

        //Si l'accès admin est bon, on propose la déconnexion
        if (isset($_SESSION['access']) AND $_SESSION['access'] == 'admin') {
            ?>
            <strong>ADMINISTRATEUR</strong><br><a href="deconnecter-admin.php">>> se déconnecter <<</a>
            <?php

        $admin_access = true;

        //Sinon, on propose la connexion
        } else {
            ?>
            <strong>UTILISATEUR</strong><br><a href="connecter-admin.php">>> Connecter Admin <<</a>
            <?php
            
        $admin_access = false;
        }

        ?>
    </p> 
</section>
