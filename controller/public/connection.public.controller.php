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
                $_SESSION['permission'] = $userQueryInArray['permission_portfolio_user'];

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

$signUpNickname = isset($_POST['pseudo-signup']) ? entryCleaning($_POST['pseudo-signup']) : "";
$signUpMail = isset($_POST['mail-signup']) ? entryCleaning($_POST['mail-signup']) : "";
$signUpPwd = isset($_POST['mdp-signup']) ? entryCleaning($_POST['mdp-signup']) : "";
$signUpCheckPwd = isset($_POST['mdpcheck-signup']) ? entryCleaning($_POST['mdpcheck-signup']) : "";

// SOMEONE TRY TO SIGN UP :
if (isset($_POST['signup'])){

    // IF ONE OF THE FIELDS ARE EMPTY
    if (empty($_POST['pseudo-signup']) || empty($_POST['mail-signup']) || empty($_POST['mdp-signup']) || empty($_POST['mdpcheck-signup'])) {

        // WARNING
        $warning2 = "Remplissez tout les champs !";

        // IF THE PASSWORDS DO NOT MATCH
    } else if ($_POST['mdp-signup'] !== $_POST['mdpcheck-signup']){

        // WARNING
        $warning2 = "Les mots de passe doivent être identique !";
        $signUpPwd = "";
        $signUpCheckPwd = "";

        // IF ALL THE FIELDS ARE FILLED
    } else {

        $signupCheckUp = signUpSelect($signUpNickname,$signUpMail, $db);
        $signUpCheckUpArray = $signupCheckUp->fetch(PDO::FETCH_ASSOC);

        // IF THE NICKNAME AND THE EMAIL ARE ALREADY USED (SEPARATELY)
        if ($signupCheckUp->rowCount() > 1 ){

            // WARNING
            $warning2 = "Cette adresse email et ce pseudo sont déjà utilisés";

            // IF IT'S ONLY THE NICKNAME OR ONLY THE EMAIL OR BOTH (BY ONE USER)
        } else if ($signupCheckUp->rowCount() === 1 ) {

            // NICKNAME AND EMAIL
            if ($signUpCheckUpArray['nickname_portfolio_user'] === $signUpNickname && $signUpCheckUpArray['mail_portfolio_user'] === $signUpMail){

                // WARNING
                $warning2 = "Ces informations appartiennent déjà à un utilisateur";
                $signUpNickname = "";
                $signUpMail = "";
            }

            // NICKNAME
            if ($signUpCheckUpArray['nickname_portfolio_user'] === $signUpNickname ){

                // WARNING
                $warning2 = "Ce pseudo appartient déjà à quelqu'un !";
                $signUpNickname = "";
            }

            // EMAIL
            if ($signUpCheckUpArray['mail_portfolio_user'] === $signUpMail ) {

                // WARNING
                $warning2 = "Cette adresse mail est déjà utilisée";
                $signUpMail = "";
            }

        } else if ($signupCheckUp->rowCount() === 0 ){

            // PASSWORD_HASH
            $signUpRealPwd = password_hash($signUpPwd, PASSWORD_DEFAULT);

            // INSERT QUERY TO INITIALISE USER
            $au_queryInsertResult = signUpUserInsertInto($signUpNickname, $signUpRealPwd, $signUpMail, $db);

            // IF THE INSERT INTO WORKED
            if($au_queryInsertResult){

                // WARNING
                $warning2 = "Bonjour ". $signUpNickname. " ! Confirmez votre adresse e-mail avant de vous connecter";
                $signUpNickname = " ";
                $signUpMail = " ";
                $signUpPwd = "";
                $signUpCheckPwd = "";

                // IF THE INSERT INTO FAILED
            } else {

                // WARNING
                $warning2 = "Il y a eu une erreur, ré-essayer s'il vous plaît";
                $signUpNickname = "";
                $signUpMail = "";
                $signUpPwd = "";
                $signUpCheckPwd = "";

            }
        }
    }
}

// VIEW
include dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'view' . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'connection.public.view.php';