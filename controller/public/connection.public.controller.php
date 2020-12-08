<?php

// MODEL
include dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'model' . DIRECTORY_SEPARATOR . 'cleaning.model.php';
include dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'model' . DIRECTORY_SEPARATOR . 'signin.model.php';
include dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'model' . DIRECTORY_SEPARATOR . 'signup.model.php';

// CONTROLLER
if(isset($_SESSION['session_id'])&&$_SESSION['session_id'] === session_id()){
    header("Location: ?page=home");
}

$nickname = isset($_POST['pseudo']) ? entryCleaning($_POST['pseudo']) : "";
$pwd = isset($_POST['mdp']) ? entryCleaning($_POST['mdp']) : "";

// SOMEONE TRY TO SIGN IN :
if (isset($_POST['signin'])){

    // IF ONE OR BOTH THE FIELD ARE EMPTY
    if (empty($_POST['pseudo']) || empty($_POST['mdp'])) {

        // WARNING / SOMETHING WENT WRONG
        $warning = "Remplissez les deux champs pour vous connecter";

        // IF BOTH FIELD ARE FILLED
    } else {

        $userQuery = selectUser($nickname, $db);
        $userQueryInArray = $userQuery->fetch(PDO::FETCH_ASSOC);
        $checkedPwd = ($userQuery->rowCount() > 0 && $userQuery->rowCount() < 2) ? password_verify($pwd, $userQueryInArray['pwd_portfolio_user']) : false ;

        // IF THE NICKNAME DOESN'T MATCH ONE IN THE DB
        if ($userQuery->rowCount() === 0){

            // WARNING
            $warning = "Ce pseudo n'existe pas !";
            $nickname = "";

            // IF THE NICKNAME AND PASSWORD ARE RIGHT
        } else if ($userQuery->rowCount() === 1 && $checkedPwd){

            // IF THE VALIDATION STATUS IS VALIDATED
            if ($userQueryInArray['validation_status_portfolio_user'] == 1){

                // FILL THE SESSION WITH USER INFORMATION
                $_SESSION['session_id'] = session_id();
                $_SESSION['user'] = $userQueryInArray;
                $_SESSION['permission'] = $userQueryInArray['permission_status_portfolio_user'];

                // IF THE USER IS AN ADMIN
                if($_SESSION['permission'] == 1){

                    // REDIRECTION
                    header('Location: ?admin=home');
                    exit();

                    // IF THE USER IS ONLY A USER
                } else {

                    // REDIRECTION
                    header('Location: ?admin=home&comment=user');
                    exit();

                }

                // IF THE VALIDATION STATUS IS NOT VALIDATED
            } else {

                // WARNING
                $warning = "Veuillez confirmer votre email avant de vous connecter";
                $nickname = "";
                $pwd = "";
            }

            // IF THE PASSWORD ENTRY IS WRONG
        } else if ($userQuery->rowCount() === 1 && !$checkedPwd){

            // WARNING
            $warning = "Le mot de passe est incorrect";
            $pwd = "";

        } else {

            // WARNING
            $warning = "Oups, ré-essayez s'il vous plaît";
            $nickname = "";
            $pwd = "";
        }
    }
}

// VIEW
include dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'view' . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'connection.public.view.php';