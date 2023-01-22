<?php

require_once 'bootstrap.php';
if(isset($_GET["code"])){
    if($dbh->getUserFunctionHandler()->checkRecoveryCode($_GET["code"])){//verifico il codice, se esiste prendo i dati dell'utente
        $data = $dbh->getUserFunctionHandler()->getUserDataByRecoveryCode($_GET["code"]);
        if(isset($_POST["pwd"]) && isset($_POST["pwdrepeat"])){
            $pwd = password_hash($_POST["pwd"], PASSWORD_DEFAULT);
            $dbh->getUserFunctionHandler()->updatePassword($pwd,$data["idUtente"]);
            $templateParams["errormsg"] = "Cambiamento password avvenuto con successo!";
            header("Refresh: 3; url=login.php");
        }
    } else {
        $templateParams["errormsg"] = "Codice scaduto!";
        header("Refresh: 3; url=login.php");
    }
   
} else {
    $templateParams["errormsg"] = "link invalido!";
    header("Refresh: 3; url=login.php");
}

$templateParams["content"] = "recovery-password-template.php";
$templateParams["title"] = 'Lynkzone - Recovery Password';
$templateParams["loginTopNav"]=true;
$templateParams["loginBottomNav"]=true;;
$templateParams["js"] = array("../js/newPassword-checker.js");

require '../template/base.php';


?>