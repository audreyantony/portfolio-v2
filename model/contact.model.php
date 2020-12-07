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
        $mailSubject = "You've got a mail || Portfolio Audrey Antony";
        $mailHeader = "MIME-Version: 1.0\n";
        $mailHeader .= "Content-type: text/html; charset=UTF-8\n";
        $mailHeader .= "From : mail@portfolio.audreyantony.be\n";
        $mailHeader .= "X-Mailer: PHP/' . phpversion()\n";

        $mailMessage = '
                    <html lang="fr">
                        <body>
                        <style type="text/css"></style>
                        <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&display=swap" rel=\"stylesheet"> 
                        
                    </body>
                </html>';
    } else {
        return "L'envoi du mail ne s'est pas fait, ré-essayez s'il vous plaît";
    }
}