<?php

require_once 'bootstrap.php';
$from = "";//SENDER GMAIL
$mail = new PHPMailer\PHPMailer\PHPMailer(true);      
if(isset($_POST["email"]) && $_POST["email"] != ""){
    if($dbh->getUserFunctionHandler()->checkEmail($_POST["email"])){ 
    try {
        $mail->isSMTP(); // using SMTP protocol                                     
        $mail->Host = 'smtp.gmail.com'; // SMTP host as gmail 
        $mail->SMTPAuth = true;  // enable smtp authentication                             
        $mail->Username = '';  // sender gmail host SENDER GMAIL         
        $mail->Password = ''; // sender gmail host password (TODO: FOR WHO USE GMAIL SEND IN ACCOUNT APP PASSWORD)                         
        $mail->SMTPSecure = 'tls';  // for encrypted connection                           
        $mail->Port = 587;   // port for SMTP     
        $mail->setFrom($from, "Sender"); // sender's email and name
        $mail->addAddress('guojiahao707@gmail.com', "Receiver");  // receiver's email and name (TODO: DA METTERE QUELLA INSERITA, invece è stata usata quella personale per scopo di prova)
        $uniqueCode = uniqid();
        $dbh->getUserFunctionHandler()->addRecoveryCode($_POST["email"],$uniqueCode);
        $mail->Subject = 'Recovery password for LinkZone';
        $mail->Body    = "Here is your link to recovery page\r\n
                          http://localhost/WebProject/src/changePassword_recovery.php?code=".$uniqueCode;
    
        $mail->send();
        $mail->smtpClose();
        header("Location: login.php");
    } catch (Exception $e) { // handle error.
        echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
    }
    } else {
        $templateParams["errormsg"] = $lang["recoveryPage_emailNotExist"];
    }
}

$templateParams["title"]="Lynkzone - Password recovery";
$templateParams["content"] = "recovery-template.php";
$templateParams["loginTopNav"]=true;
$templateParams["loginBottomNav"]=true;
$templateParams["js"] = array("../js/email-checker.js","../js/languageOnChange.js");

require '../template/base.php';


?>