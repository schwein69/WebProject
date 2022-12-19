<?php
require_once 'bootstrap.php';
//check login
redirectNotLoggedUser();

$templateParams["content"] = "settings-template.php";
$templateParams["profileTopNav"]=true;
$templateParams["js"] = array("../js/settings.js");
require '../template/base.php';

?>