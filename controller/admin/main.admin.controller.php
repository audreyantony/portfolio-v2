<?php

// WHEN THE USER IS NAVIGATING THE USER PART OF THE WEBSITE
if (isset($_GET['admin'])) {

    // HEADER
    $header;

    switch ($_GET['admin']) {
        // HOME ADMIN PAGE
        case 'home':
            include dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'controller' . DIRECTORY_SEPARATOR . 'admin' . DIRECTORY_SEPARATOR . 'home.admin.controller.php';
            break;
        // GALLERY ADMIN PAGE
        case "gallery":
            include dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'controller' . DIRECTORY_SEPARATOR . 'admin' . DIRECTORY_SEPARATOR . 'gallery.admin.controller.php';
            break;
        // LINKS ADMIN PAGE
        case "links":
            include dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'controller' . DIRECTORY_SEPARATOR . 'admin' . DIRECTORY_SEPARATOR . 'links.admin.controller.php';
            break;
        // CONTACT ADMIN PAGE
        case "contact":
            include dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'controller' . DIRECTORY_SEPARATOR . 'admin' . DIRECTORY_SEPARATOR . 'contact.admin.controller.php';
            break;
        // CONTACT ADMIN PAGE
        case "deco":
            header("Location: ../controller/public/disconnection.php");
            break;
        // DEFAULT ADMIN PAGE -> 404
        default :
            include dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'view' . DIRECTORY_SEPARATOR . 'error' . DIRECTORY_SEPARATOR . 'page.error.view.php';
    }

    // FOOTER
    $footer;

}
