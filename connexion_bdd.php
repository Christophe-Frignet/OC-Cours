<?php
//Connexion à la BDD

$dsn = 'mysql:host=localhost;dbname=test';
$username = 'root';
$password = '';
try
{
	$bdd = new PDO($dsn, $username, $password,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch(Exception $e)
{
	die('Erreur : '.$e->getMessage());
}