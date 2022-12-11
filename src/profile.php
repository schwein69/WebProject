<?php
require_once 'bootstrap.php';
//check login
if(!isUserLoggedIn()){
    echo '<script>
    alert("Devi essere loggato!");
    window.location.href="login.php";
    </script>';
} else {
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
}

require '../template/base.php';
?>