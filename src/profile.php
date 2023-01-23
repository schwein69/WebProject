<?php
require_once 'bootstrap.php';
//check login
redirectNotLoggedUser();
if(isset($_GET["idUtente"])){
    $userid=$_GET["idUtente"];
} else {
    $userid = $_SESSION["idUtente"];
}
$templateParams["user"] = $dbh->getUserFunctionHandler()->getUserData($userid);
$templateParams["posts"] = $dbh->getPostFunctionHandler()->getProfilePosts(-1,$userid);
$templateParams["user"]["numPosts"] = count($templateParams["posts"]);
$templateParams["user"]["numFollower"] = $dbh->getUserFunctionHandler()->getNumFollower($userid);
$templateParams["user"]["numFollowed"] = $dbh->getUserFunctionHandler()->getNumFollowed($userid);
$templateParams["user"]["followedByMe"] = $dbh->getUserFunctionHandler()->isFollowedByMe( $_SESSION["idUtente"],$templateParams["user"]["idUtente"]);
$templateParams["user"]["profilePic"] = UPLOAD_DIR.$templateParams["user"]["idUtente"]."/profile.".$templateParams["user"]["formatoFotoProfilo"];
$templateParams["content"] = "profilepage.php";
$templateParams["profileTopNav"] = true;
$templateParams["title"] = 'Lynkzone - profile';
$templateParams["dontShowFollowButton"] = true;//nel profilo degli altri c'è già il pulsante follow in alto, quindi rimuovo quelli ridondanti accanto ad ogni post
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
    $templateParams["posts"][$i]["liked"] = $dbh->getPostFunctionHandler()->isPostLiked($_SESSION["idUtente"],$templateParams["posts"][$i]["idPost"]);
    $templateParams["posts"][$i]["saved"] = $dbh->getPostFunctionHandler()->isPostSaved($_SESSION["idUtente"],$templateParams["posts"][$i]["idPost"]);
    $templateParams["posts"][$i]["tags"] = $dbh->getPostFunctionHandler()->getPostTags($templateParams["posts"][$i]["idPost"]);

    //adding medias to post
    $templateParams["posts"][$i]["mediaPath"] = UPLOAD_DIR.$userid.'/'.$templateParams["posts"][$i]["idPost"].'/';
    $media = $dbh->getPostFunctionHandler()->getPostContents($templateParams["posts"][$i]["idPost"]);
    
    for ($m=0; $m < count($media) ; $m++) { 
        $media[$m]["isImage"] = isImageExtension($media[$m]["formato"]);
    }
    $templateParams["posts"][$i]["media"] = $media;
}

$templateParams["js"] = array("../js/functions.js","../js/like.js","../js/follow-event.js","../js/savePost.js","../js/removePost.js","../js/sharePost.js","../js/video_handler.js");
require '../template/base.php';
?>