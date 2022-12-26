<?php
require_once 'bootstrap.php';
//check login
redirectNotLoggedUser();
if(isset($_GET["idUtente"])){
    $userid=$_GET["idUtente"];
} else {
    $userid = $_SESSION["idUtente"];
}
$templateParams["user"] = $dbh->getUserData($userid);
$posts = $dbh->getProfilePosts(-1,$userid);
$templateParams["user"]["numPosts"] = count($dbh->getProfilePosts(-1,$userid));
$templateParams["user"]["numFollower"] = count($dbh->getNumFollower($userid));
$templateParams["user"]["numFollowed"] = count($dbh->getNumFollowed($userid));
$templateParams["user"]["followedByMe"] = $dbh->isFollowedByMe($templateParams["user"]["idUtente"], $_SESSION["idUtente"]);
$templateParams["user"]["profilePic"] = UPLOAD_DIR.$templateParams["user"]["idUtente"]."/profile.".$templateParams["user"]["formatoFotoProfilo"];
$templateParams["content"] = "profilepage.php";
$templateParams["profileTopNav"] = true;
$templateParams["title"] = 'Lynkzone - profile'; 

$templateParams["js"] = array("../js/functions.js","../js/like.js","../js/follow-event.js");
require '../template/base.php';
?>