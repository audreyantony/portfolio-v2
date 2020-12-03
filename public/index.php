<?php

// SESSION START
session_start();


// CONNECTION DEPENDENCIES
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'bin' . DIRECTORY_SEPARATOR . 'config.php';
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'model' . DIRECTORY_SEPARATOR . 'DB.model.php';
// AND CONNECTION
$db = connectionToDB();

// CONNECTION ERROR MANAGEMENT
if(!$db){
    include dirname(__DIR__) . DIRECTORY_SEPARATOR . 'view' . DIRECTORY_SEPARATOR . 'error' . DIRECTORY_SEPARATOR . 'connection.error.view.php';
    die();
}

// ADMIN CONTROLLER IF SOMEONE IS CONNECTED AND IF THIS PERSON HAS A PERMISSION
if(isset($_SESSION['session_id'])&&$_SESSION['session_id']==session_id()){

    if($_SESSION['permission']== 1){
        require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'controller' . DIRECTORY_SEPARATOR . 'admin' . DIRECTORY_SEPARATOR . 'main.admin.controller.php';
    }

}

// PUBLIC CONTROLLER (ALWAYS AVAILABLE)
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'controller' . DIRECTORY_SEPARATOR . 'user' . DIRECTORY_SEPARATOR . 'main.user.controller.php';