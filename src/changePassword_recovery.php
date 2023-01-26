<?php

require_once 'bootstrap.php';
if(isset($_GET["code"])){
    if($dbh->getUserFunctionHandler()->checkRecoveryCode($_GET["code"])){//verifico il codice, se esiste prendo i dati dell'utente
        $data = $dbh->getUserFunctionHandler()->getUserDataByRecoveryCode($_GET["code"]);
        if(isset($_POST["pwd"]) && isset($_POST["pwdrepeat"])){
            $pwd = password_hash($_POST["pwd"], PASSWORD_DEFAULT);
            $dbh->getUserFunctionHandler()->updatePassword($pwd,$data["idUtente"]);
            $templateParams["errormsg"] = $lang["recoveryMsg_success"];
            header("Refresh: 2; url=login.php");
        }
    } else {
        $templateParams["errormsg"] = $lang["recoveryMsg_expired"];
        header("Refresh: 2; url=login.php");
    }
   
} else {
    $templateParams["errormsg"] = $lang["recoveryMsg_wrong"];
    header("Refresh: 2; url=login.php");
}

$templateParams["content"] = "recovery-password-template.php";
$templateParams["title"] = 'Lynkzone - Change Password';
$templateParams["loginTopNav"]=true;
$templateParams["loginBottomNav"]=true;;
$templateParams["js"] = array("../js/newPassword-checker.js","../js/languageOnChange.js");
require '../template/base.php';


?>