<?php

// MODEL
include dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'model' . DIRECTORY_SEPARATOR . 'signup.model.php';

// IF THE VALIDATION IS 'OK'
if (isset($_GET['validation']) && $_GET['validation'] === "yes") {

    // VAR NEEDED
    $registrationFor = $_GET['for'];
    $registrationKey = $_GET['key'];

    // USER INFORMATION
    $userArray = signUpSelectArray($registrationFor, $db);

    // IF THIS USER IS ALREADY CONFIRMED
    if ($userArray['validation_status_portfolio_user'] == 1) {

        // WARNING
        $warning = "Bonjour " . $registrationFor . " ! L'email est déjà confirmé, vous pouvez vous connecter";
        header('Location : ?page=connection');

    } else if (($userArray['validation_status_portfolio_user'] == 0) && ($registrationKey == $userArray['validation_key_portfolio_user'])) {

        // USER VALIDATION STATUS UPDATE
        $registrationUpdate = registrationUpdateUser($registrationFor, $registrationKey, $db);

        // IF THE UPDATE DID GO THROUGH
        if ($registrationUpdate) {

            // WARNING
            $warning = "Hello " . $registrationFor . " ! Your email is validated, you can sign in !";
            $au_signInNickname = $registrationFor;

            // IF THE UPDATE DIDN'T GO THROUGH
        } else {

            // WARNING
            $warning = "Your account hasn't been activated, please retry";

        }
    } else {

        // WARNING
        $warning = "Your account cannot be activated, please contact us.";

    }

}

// VIEW
include dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'view' . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'connection.public.view.php';