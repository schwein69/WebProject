<?php
require_once 'bootstrap.php';
//check login
redirectNotLoggedUser();

$templateParams["content"] = "settings-template.php";
$templateParams["profileTopNav"]=true;

require '../template/base.php';

?>