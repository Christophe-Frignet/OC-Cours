<?php
#On inclut l'autoloader de composer
require "vendor/autoload.php";

#Qui va aller chercher tout seul dans le namespace déclaré la librairie à utiliser
use Michelf\Markdown;

$my_text = 'Salut tout le monde et surtout **toi**';

#On peut ainsi utiliser la classe "Mardown" très facilement
$tranform = Markdown::defaultTransform($my_text);

echo $tranform;
?>