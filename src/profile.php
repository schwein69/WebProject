<?php
require_once 'bootstrap.php';
//check login
redirectNotLoggedUser();
    if(isset($_GET["idUtente"])){
        $userid=$_GET["idUtente"];
    } else {
        $userid = $_SESSION["idUtente"];
    }
    $userData = $dbh->getUserData($userid);
    $posts = $dbh->getProfilePosts(-1,$userid);
    $numPosts = count($dbh->getProfilePosts(-1,$userid));
    $numFollower = count($dbh->getNumFollower($userid));
    $numFollowed = count($dbh->getNumFollowed($userid));
    $templateParams["content"] = "profilepage.php";
    $templateParams["profileTopNav"]=true;
    $templateParams["title"] = 'Lynkzone - profile'; 

    $templateParams["js"] = array("../js/like.js");
require '../template/base.php';
?>