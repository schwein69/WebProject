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
//array_push($templateParams["js"],"../js/scrolldown-search.js");
require '../template/base.php';

?>