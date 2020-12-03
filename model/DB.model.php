<?php

function connectionToDB(){
    try {
        $connexion = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET.";port=".DB_PORT, DB_LOGIN, DB_PWD);

    }catch(PDOException $e){
        $erreur = $e->getCode();
        $erreur .= " : ";
        $erreur .= $e->getMessage();
    }
    if(isset($erreur)) echo $erreur; else var_dump($connexion);
}