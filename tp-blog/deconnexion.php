<?php
session_start();
unset($_SESSION['access']);
header('Location: index.php');
?>
