            <?php
            if (isset($_SESSION['access']) AND $_SESSION['access'] = 'admin') {
                //Si la session accès est "admin" on passe admin_access à true et on propose la déconnexion
                echo 'DROIT ACCES : ADMINISTRATEUR<br><a href="deconnecter-admin.php">>> se déconnecter <<</a>';
                $admin_access = true;
            } else {
                //Sinon on passe passe admin_access à false et on propose la connexion à l'espace admin
                echo 'DROIT ACCES : Utilisateur<br>';
                echo '<a href="connecter-admin.php">Connecter Admin</a>';
                $admin_access = false;
            }
            ?>
