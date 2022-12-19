<?php
require_once 'bootstrap.php';
//check login
redirectNotLoggedUser();

if (isset($_GET["idUtente"])) {
    $userData = $dbh->getNumFollowed($_GET["idUtente"]);
} else {
    $userData = $dbh->getNumFollowed($_SESSION["idUtente"]);
}

$templateParams["title"] = 'Lynkzone - followers'; 
$templateParams["content"] = "followedListTMP.php";
$templateParams["js"] = array("../js/functions.js","../js/follow-event.js");
require '../template/base.php';

?>