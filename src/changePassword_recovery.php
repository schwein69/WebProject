<?php

require_once 'bootstrap.php';

if(isset($_POST["email"]) && isset($_POST["pass"]) && isset($_POST["repas"])){

}
$templateParams["content"] = "recovery-password-template.php";
$templateParams["title"] = 'Lynkzone - Recovery Password';
$templateParams["loginTopNav"]=true;
$templateParams["loginBottomNav"]=true;;
$templateParams["js"] = array("../js/registrationchecker.js");

require '../template/base.php';


?>