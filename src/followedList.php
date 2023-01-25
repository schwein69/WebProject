<?php
require_once 'bootstrap.php';
//check login
redirectNotLoggedUser();

$userId = null;
if (isset($_GET["idUtente"])) {
    $templateParams["followed"] = $dbh->getUserFunctionHandler()->getFollowed($_GET["idUtente"]);
    $userId = $_GET["idUtente"];
} else {
    $templateParams["followed"] = $dbh->getUserFunctionHandler()->getFollowed($_SESSION["idUtente"]);
    $userId = $_SESSION["idUtente"];
}
for ($i=0; $i < count($templateParams["followed"]); $i++) { 
    $templateParams["followed"][$i]["followedByMe"] = $dbh->getUserFunctionHandler()->isFollowedByMe($userId,$templateParams["followed"][$i]["idUtente"]);
}

$templateParams["title"] = 'Lynkzone - '.$lang["Followed"]; 
$templateParams["content"] = "followedListTMP.php";
$templateParams["js"] = array("../js/functions.js","../js/follow-event.js",'../js/notifications_receiver.js');
require '../template/base.php';

?>