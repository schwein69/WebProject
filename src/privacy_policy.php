<?php
require_once 'bootstrap.php';

if(isset($_SESSION["idUtente"])){
    header('Location: settings.php');
}
$templateParams["content"] = "privacy_".$_SESSION["lang"].".php";
$templateParams["loginTopNav"] = "";
$templateParams["loginBottomNav"] = "";
$templateParams["js"] = array("../js/languageOnChange.js");
$templateParams["title"] = 'Lynkzone - Privacy & policy'; 
require '../template/base.php';
?>