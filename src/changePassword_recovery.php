<?php

require_once 'bootstrap.php';
if(isset($_GET["code"])){
    $templateParams["content"] = "recovery-password-template.php";
    if($dbh->checkCode($_GET["code"])){
        $data = $dbh->checkCode($_GET["code"]);
    }
    if(isset($_POST["email"]) && isset($_POST["pass"]) && isset($_POST["repas"])){

    }
}


$templateParams["title"] = 'Lynkzone - Recovery Password';
$templateParams["loginTopNav"]=true;
$templateParams["loginBottomNav"]=true;;
$templateParams["js"] = array("../js/registrationchecker.js");

require '../template/base.php';


?>