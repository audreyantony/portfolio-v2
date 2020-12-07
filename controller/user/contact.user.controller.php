<?php

// MODEL
include dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'model' . DIRECTORY_SEPARATOR . 'cleaning.model.php';
include dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'model' . DIRECTORY_SEPARATOR . 'contact.model.php';

// CONTROLLER

// VALUES FOR THE CONTACT FORM
$name = isset($_POST['name']) ? entryCleaning($_POST['name']) : "";
$mail = isset($_POST['mail']) ? entryCleaning($_POST['mail']) : "";
$phone = isset($_POST['phone']) ? entryCleaning($_POST['phone']) : "";
$message = isset($_POST['message']) ? entryCleaning($_POST['message']) : "";

if (isset($_POST['envoyer'])){

    if (empty($_POST['name']) && !empty($_POST['mail']) && !empty($_POST['message'])){

        $warning = "Pourriez vous m'indiquer votre nom ?";

    } else if (!empty($_POST['name']) && empty($_POST['mail']) && !empty($_POST['message'])){

        $warning = "Pourriez vous indiquer votre adresse email ?";

    } else if (!empty($_POST['name']) && !empty($_POST['mail']) && empty($_POST['message'])){

        $warning = "Votre message est vide !";

    } else if (empty($_POST['name']) || empty($_POST['mail']) || empty($_POST['message'])){

        $warning = "Veillez à renseigner au minimum les champs pour le nom, l'adresse e-mail et le message !";

    } if (!empty($_POST['name']) && !empty($_POST['mail']) && !empty($_POST['message'])){

        $email= "mariejacynthe@delamotte.com";

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $warning = "L'adresse mail entrée est incorrecte";
        } else {
            $mail = sendMail($name, $phone, $mail, $message, $db);
        }
    }
}

// VIEW
include dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'view' . DIRECTORY_SEPARATOR . 'user' . DIRECTORY_SEPARATOR . 'contact.user.view.php';