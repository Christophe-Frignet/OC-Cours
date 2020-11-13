<?php
session_start();

//on supprime l'accès
session_destroy();

//on récupère la page qui a demandé la déconnexion
$page = $_SERVER['HTTP_REFERER'];

//on retourne sur la page qui a demandé la déconnexion
header('Location: ' . $page);

?>
