<?php

require_once 'bootstrap.php';


$templateParams["content"] = "registration-template.php";
$templateParams["loginTopNav"]=true;
$templateParams["loginBottomNav"]=true;;
   

require '../template/base.php';
echo '<script src="../javascript/registrationchecker.js" type="text/javascript"></script>'

?>