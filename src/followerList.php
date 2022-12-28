<?php
require_once 'bootstrap.php';
//check login
redirectNotLoggedUser();

if (isset($_GET["idUtente"])) {
    $userData = $dbh->getFollower($_GET["idUtente"]);
} else {
    $userData = $dbh->getFollower($_SESSION["idUtente"]);
}

$templateParams["title"] = 'Lynkzone - follower'; 
$templateParams["content"] = "followerListTMP.php";
$templateParams["js"] = array("../js/functions.js","../js/follow-event.js");
require '../template/base.php';

?>