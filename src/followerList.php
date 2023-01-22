<?php
require_once 'bootstrap.php';
//check login
redirectNotLoggedUser();

if (isset($_GET["idUtente"])) {
    $templateParams["follower"] = $dbh->getFollower($_GET["idUtente"]);
} else {
    $templateParams["follower"] = $dbh->getFollower($_SESSION["idUtente"]);
}


$templateParams["title"] = 'Lynkzone - follower'; 
$templateParams["content"] = "followerListTMP.php";
$templateParams["js"] = array("../js/functions.js","../js/follow-event.js",'../js/notifications_receiver.js');
require '../template/base.php';

?>