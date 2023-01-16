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
$templateParams["posts"] = $dbh->getProfilePosts(-1,$userid);
$templateParams["followed"] = $dbh->getFollowed($_SESSION["idUtente"]);//getFollowed = lista amici dell'utente loggato
$templateParams["user"]["numPosts"] = count($templateParams["posts"]);
$templateParams["user"]["numFollower"] = $dbh->getNumFollower($userid);
$templateParams["user"]["numFollowed"] = $dbh->getNumFollowed($userid);
$templateParams["user"]["followedByMe"] = $dbh->isFollowedByMe( $_SESSION["idUtente"],$templateParams["user"]["idUtente"]);
$templateParams["user"]["profilePic"] = UPLOAD_DIR.$templateParams["user"]["idUtente"]."/profile.".$templateParams["user"]["formatoFotoProfilo"];
$templateParams["content"] = "profilepage.php";
$templateParams["profileTopNav"] = true;
$templateParams["title"] = 'Lynkzone - profile'; 

/*
Preparing posts
*/
$numPosts = count($templateParams["posts"]);
for ($i=0; $i < $numPosts; $i++) {
    $templateParams["posts"][$i]["fotoProfilo"] = $templateParams["user"]["profilePic"];
    $templateParams["posts"][$i]["fotoProfiloAlt"] = getProfilePicAlt($templateParams["user"]["username"]);
    $templateParams["posts"][$i]["username"] = $templateParams["user"]["username"];
    $templateParams["posts"][$i]["isLoggedUserPost"] = $userid == $_SESSION["idUtente"];
    $templateParams["posts"][$i]["followedByMe"] = $templateParams["user"]["followedByMe"];
    $templateParams["posts"][$i]["isFull"] = false;
    $templateParams["posts"][$i]["liked"] = $dbh->isPostLiked($_SESSION["idUtente"],$templateParams["posts"][$i]["idPost"]);
    $templateParams["posts"][$i]["saved"] = $dbh->isPostSaved($_SESSION["idUtente"],$templateParams["posts"][$i]["idPost"]);
    $templateParams["posts"][$i]["tags"] = $dbh->getPostTags($templateParams["posts"][$i]["idPost"]);

    //adding medias to post
    $templateParams["posts"][$i]["mediaPath"] = UPLOAD_DIR.$userid.'/'.$templateParams["posts"][$i]["idPost"].'/';
    $media = $dbh->getPostContents($templateParams["posts"][$i]["idPost"]);
    
    for ($m=0; $m < count($media) ; $m++) { 
        $media[$m]["isImage"] = isImageExtension($media[$m]["formato"]);
    }
    $templateParams["posts"][$i]["media"] = $media;
}

$templateParams["js"] = array("../js/functions.js","../js/like.js","../js/follow-event.js","../js/savePost.js","../js/removePost.js","../js/sharePost.js");
require '../template/base.php';
?>