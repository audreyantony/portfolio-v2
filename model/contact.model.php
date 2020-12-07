<?php

function insertMail($name, $phone, $mail, $message, $db){

    $query = "INSERT INTO portfolio_mail (name_portfolio_mail ,email_portfolio_mail ,phone_portfolio_mail, message_portfolio_mail) VALUES (?,?,?,?);";

    $prepareInsertMail = $db->prepare($query);

    $prepareInsertMail -> bindValue(1,$name,PDO::PARAM_STR);
    $prepareInsertMail -> bindValue(2,$mail,PDO::PARAM_STR);
    $prepareInsertMail -> bindValue(3,$phone,PDO::PARAM_STR);
    $prepareInsertMail -> bindValue(4,$message,PDO::PARAM_STR);

    $insert = $prepareInsertMail->execute();
    if($insert){
        return true;
    } else {
        return false;
    }
}

function sendMail($name, $phone, $mail, $message, $db){
    if (empty($phone)){
        $truePhone = "not specified";
    } else {
        $truePhone = $phone;
    }

    $insert = insertMail($name, $truePhone, $mail, $message, $db);

    if ($insert){

        $mailDestination = "audrey@calzi.fr";
        $mailSubject = "You've got a mail || Portfolio Audrey Antony";
        $mailHeader = "MIME-Version: 1.0\n";
        $mailHeader .= "Content-type: text/html; charset=UTF-8\n";
        $mailHeader .= "From : mail@portfolio.audreyantony.be\n";
        $mailHeader .= "X-Mailer: PHP/' . phpversion()\n";

        $mailMessage = '
                    <html lang="fr">
            <body>
            <style type="text/css"></style>
            <link href="https://fonts.googleapis.com/css2?family=Fredericka+the+Great&family=Montserrat:wght@100;200;300;400;500;600&display=swap" rel="stylesheet">
            <div style="width: 80%; background: rgba(243,240,242,0.2); text-align: center; margin: 0 auto; padding: 50px; font-family: \'Montserrat\', sans-serif; font-weight: 200;">
                <h1 style="font-family: \'Fredericka the Great\', sans-serif; font-size: 4rem;  color: #545452;" >{ New Mail }</h1>
                <h2 style="letter-spacing: 3px;  color: #545452; padding: 10px; background-color: rgba(245, 239, 244,0.4); font-weight: lighter;"> FROM : '.$name.' || TEL : '.$truePhone.' || EMAIL : '.$mail.'</h2>
                <p style="letter-spacing: 3px;  color: #545452; padding: 10px; background-color: rgba(245, 239, 244,0.4);">'.$message.'</p>
            </div>
        </body>
</html>';

        if (mail($mailDestination, $mailSubject, $mailMessage,$mailHeader)){
            return "Le mail est bien envoyé !";
        } else {
            return "Message envoyé, je lirais votre message dès ma prochaine connexion !";
        }

    } else {
        return "L'envoi du mail ne s'est pas fait, ré-essayez s'il vous plaît";
    }
}