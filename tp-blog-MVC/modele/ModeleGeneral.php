<?php

namespace Tpblog\Modele;

use \PDO;

class ModeleGeneral {

    protected function connecterBdd()
    {
        $dsn = 'mysql:host=localhost;dbname=tp_blog';
        $username = 'root';
        $password = '';
    
        try
        {
            $bdd = new PDO($dsn, $username, $password,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            return $bdd;
        }
        catch(Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        }
    }
}