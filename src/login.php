<?php
require_once 'bootstrap.php';
 
if(isset($_POST["username"]) && isset($_POST["password"]) && $_POST["username"] !== "" && $_POST["password"] !== ""){
    $user = $dbh->getUserDataLogin($_POST["username"]);
    if(count($user) < 1){
        $templateParams["errormsg"] = "Username inesistente!";
    } else {
        if(password_verify($_POST["password"], $user[0]["pwd"])){
            registerLoggedUser($user[0]);
        }else{
            $templateParams["errormsg"] = "Credenziali errate!";
        }
    }
}
if(isUserLoggedIn()){
    header("Location: index.php");
}else{
    $templateParams["content"] = "login-template.php";
    $templateParams["loginTopNav"]=true;
    $templateParams["loginBottomNav"]=true;
   
}
$templateParams["title"] = 'Lynkzone - login'; 
require '../template/base.php';

?>