<?php
require_once 'bootstrap.php';
//check login
redirectNotLoggedUser();

$userId = null;
if (isset($_GET["idUtente"])) {
    $templateParams["followed"] = $dbh->getFollowed($_GET["idUtente"]);
    $userId = $_GET["idUtente"];
} else {
    $templateParams["followed"] = $dbh->getFollowed($_SESSION["idUtente"]);
    $userId = $_SESSION["idUtente"];
}
for ($i=0; $i < count($templateParams["followed"]); $i++) { 
    $templateParams["followed"][$i]["followedByMe"] = $dbh->isFollowedByMe($userId,$templateParams["followed"][$i]["idUtente"]);
}

$templateParams["title"] = 'Lynkzone - followed'; 
$templateParams["content"] = "followedListTMP.php";
$templateParams["js"] = array("../js/functions.js","../js/follow-event.js");
require '../template/base.php';

?>