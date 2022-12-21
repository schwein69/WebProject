<?php
require_once 'bootstrap.php';
//check login
redirectNotLoggedUser();

$templateParams["content"] = "settings-template.php";
$templateParams["profileSetting"] = "profileSetting.php";
/*$templateParams["likedposts"] = "";
$templateParams["accountSetting"] = "";
$templateParams["privacy"] = "";*/
$templateParams["profileTopNav"]=true;
$templateParams["js"] = array("../js/settings.js","../js/theme.js");
require '../template/base.php';

?>