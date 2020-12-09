<?php

// WHEN THE USER IS NAVIGATING THE USER PART OF THE WEBSITE
if (isset($_GET['page'])) {

    // HEADER
    $header;

    switch ($_GET['page']) {
        // HOME PAGE
        case 'home':
            include dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'controller' . DIRECTORY_SEPARATOR . 'user' . DIRECTORY_SEPARATOR . 'home.user.controller.php';
            break;
        // GALLERY PAGE
        case "gallery":
            include dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'controller' . DIRECTORY_SEPARATOR . 'user' . DIRECTORY_SEPARATOR . 'gallery.user.controller.php';
            break;
        // LINKS PAGE
        case "links":
            include dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'controller' . DIRECTORY_SEPARATOR . 'user' . DIRECTORY_SEPARATOR . 'links.user.controller.php';
            break;
        // CV PAGE
        case "cv":
            include dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'controller' . DIRECTORY_SEPARATOR . 'user' . DIRECTORY_SEPARATOR . 'cv.user.controller.php';
            break;
        // CONTACT PAGE
        case "contact":
            include dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'controller' . DIRECTORY_SEPARATOR . 'user' . DIRECTORY_SEPARATOR . 'contact.user.controller.php';
            break;
        // CONNECTION PAGE
        case "connection":
            include dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'controller' . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'connection.public.controller.php';
            break;
        // REGISTRATION PAGE
        case "registration":
            include dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'controller' . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'registration.public.controller.php';
            break;
        // DEFAULT PAGE -> 404
        default :
            include dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'view' . DIRECTORY_SEPARATOR . 'error' . DIRECTORY_SEPARATOR . 'page.error.view.php';
    }

    // FOOTER
    $footer;

// FIRST DISPLAY OF THE USER PAGE
}


if (!isset($_GET['page']) && !isset($_GET['admin'])){

    // DISPLAY OF THE HOME PAGE
    $header;

    include dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'controller' . DIRECTORY_SEPARATOR . 'user' . DIRECTORY_SEPARATOR . 'home.user.controller.php';

    $footer;

}