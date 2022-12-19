<?php
require_once 'bootstrap.php';
//check login
redirectNotLoggedUser();

if (isset($_GET["idUtente"])) {
    $userData = $dbh->getNumFollower($_GET["idUtente"]);
} else {
    $userData = $dbh->getNumFollower($_SESSION["idUtente"]);
}

$templateParams["title"] = 'Lynkzone - followers'; 
$templateParams["content"] = "followerListTMP.php";
$templateParams["js"] = array("../js/functions.js","../js/follow-event.js");
require '../template/base.php';

?>