<?php

function signUpSelect($nickname,$email, $db){
    $query = 'SELECT * FROM portfolio_user WHERE nickname_portfolio_user = "'.$nickname.'" OR mail_portfolio_user = "'.$email.'";';
    return $db->query($query);
}

function signUpSelectArray($nickname, $db){
    $query = 'SELECT * FROM portfolio_user WHERE nickname_portfolio_user = "'.$nickname.'";';
    $result = $db->query($query);
    return  $result->fetchAll(PDO::FETCH_ASSOC);
}

function signUpUserInsertInto($nickname, $pwd, $mail, $db){

    // VALIDATION_KEY GENERATOR
    $validationKey = md5(microtime(TRUE) * 100000);

    // INSERT INTO QUERYS
    $query = "INSERT INTO user (nickname_portfolio_user, pwd_portfolio_user, mail_portfolio_user, permission_portfolio_user, validation_status_portfolio_user, confirmation_key_portfolio_user) VALUES (?,?,?,?,?,?);";

    $prepareQuery = $db->prepare($query);

    $prepareQuery->bindValue(1,$nickname,PDO::PARAM_STR);
    $prepareQuery->bindValue(2,$pwd,PDO::PARAM_STR);
    $prepareQuery->bindValue(3,$mail,PDO::PARAM_STR);
    $prepareQuery->bindValue(4,0,PDO::PARAM_INT);
    $prepareQuery->bindValue(5,0,PDO::PARAM_INT);
    $prepareQuery->bindValue(6,$validationKey,PDO::PARAM_STR);

    $insertUser = $prepareQuery->execute();

    // IF EVERY QUERY PASSED THRU
    if ($insertUser) {

        // CONFIRMATION MAIL PREPARATION
        $registrationArray = signUpSelectArray($nickname, $db);
        $registrationSubject = "Confirm your inscription to the Portfolio of Audrey Antony";
        $registrationHeader = "MIME-Version: 1.0\n";
        $registrationHeader .= "Content-type: text/html; charset=UTF-8\n";
        $registrationHeader .= "From : mail@portfolio.audreyantony.be\n";
        $registrationHeader .= "X-Mailer: PHP/' . phpversion()\n";

        $registrationMessage = '<html lang="fr">
            <body>
            <style type="text/css"></style>
            <link href="https://fonts.googleapis.com/css2?family=Fredericka+the+Great&family=Montserrat:wght@100;200;300;400;500;600&display=swap" rel="stylesheet">
            <div style="width: 80%; background: rgba(243,240,242,0.2); text-align: center; margin: 0 auto; padding: 50px; font-family: \'Montserrat\', sans-serif; font-weight: 200;">
                <h1 style="font-family: \'Fredericka the Great\', sans-serif; font-size: 4rem;  color: #545452;" >{ Confirmez votre e-mail }</h1>
                <h2 style="letter-spacing: 3px;  color: #545452; padding: 10px; font-weight: lighter;">|| VOUS ÊTES : \'.$nickname.\' || VOTRE EMAIL : \'.$mail.\' ||<br> VOTRE MOT DE PASSE : ça, c\'est votre secret </h2 >
                <div style = "text-align: center;" >
                	
                </div >
                <p style = "letter-spacing: 3px;  color: #545452; padding: 10px; text-align: left;" > Pour activer votre compte veuillez cliquer sur le lien suivant : <br><br>
                	<a href = "https://audrey.webdev-cf2m.be/portfolio/?page=registratio&validation=yesn&for=' . urlencode($nickname) . '&key=' . urlencode($registrationArray['validation_key_portfolio_user']) . '" style = "color: #304B42; font-weight: 300; text-decoration: underline;" > https://audrey.webdev-cf2m.be/portfolio/?page=registration&validation=yes&for=' . urlencode($nickname) . '&key=' . urlencode($registrationArray['validation_key_portfolio_user']) . '</a><br><br>
                </p >
            </div >
        </body >
</html >';

        // IF THE MAIL WENT THROUGH
        if (mail($mail, $registrationSubject, $registrationMessage, $registrationHeader)) {
            return true;
            // IF THE MAIL DIDN'T GO THROUGH
        } else {
            return false;
        }
    }
}


// UPDATE QUERY FOR THE REGISTRATION PROCESS
function registrationUpdateUser($nickname, $validationKey, $db){

    // UPDATE QUERY
    $query = "UPDATE portfolio_user SET validation_status_portfolio_user = 1 WHERE nickname_portfolio_user = ? AND confirmation_key_user = ?;";

    $prepareUpdateUser = $db->prepare($query);

    $prepareUpdateUser->bindValue(1,$nickname,PDO::PARAM_STR);
    $prepareUpdateUser->bindValue(2,$validationKey,PDO::PARAM_STR);

    $updateUser = $prepareUpdateUser->execute();

    // RETURN
    if ($updateUser){
        return true;
    } else {
        return false;
    }
}
