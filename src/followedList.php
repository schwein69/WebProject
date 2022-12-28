<?php
require_once 'bootstrap.php';
//check login
redirectNotLoggedUser();

if (isset($_GET["idUtente"])) {
    $templateParams["followed"] = $dbh->getFollowed($_GET["idUtente"]);
} else {
    $templateParams["followed"] = $dbh->getFollowed($_SESSION["idUtente"]);
}



$templateParams["title"] = 'Lynkzone - followed'; 
$templateParams["content"] = "followedListTMP.php";
$templateParams["js"] = array("../js/functions.js","../js/follow-event.js");
require '../template/base.php';

?>