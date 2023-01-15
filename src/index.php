<?php
require_once 'bootstrap.php';

redirectNotLoggedUser();
$templateParams["posts"] = $dbh->getFollowedPosts($_SESSION["idUtente"]);
$templateParams["oldPostIds"] = array();

$numPosts = count($templateParams["posts"]);
for ($i=0; $i < $numPosts; $i++) {
    array_push($templateParams["oldPostIds"], $templateParams["posts"][$i]["idPost"]);
    $user = $dbh->getUserData($templateParams["posts"][$i]['idUser']);
    $templateParams["posts"][$i]["fotoProfilo"] = UPLOAD_DIR.$user['idUtente'].'/profile.'.$user['formatoFotoProfilo'];
    $templateParams["posts"][$i]["fotoProfiloAlt"] = "foto profilo di ".$user['username'];
    $templateParams["posts"][$i]["username"] = $user['username'];
    $templateParams["posts"][$i]["isLoggedUserPost"] = $user['idUtente'] == $_SESSION["idUtente"];
    $templateParams["posts"][$i]["followedByMe"] = $dbh->isFollowedByMe($_SESSION["idUtente"],$user['idUtente']);
    $templateParams["posts"][$i]["isFull"] = false;
    $templateParams["posts"][$i]["liked"] = $dbh->isPostLiked($_SESSION["idUtente"],$templateParams["posts"][$i]["idPost"]);
    $templateParams["posts"][$i]["saved"] = $dbh->isPostSaved($_SESSION["idUtente"],$templateParams["posts"][$i]["idPost"]);
    $templateParams["posts"][$i]["tags"] = $dbh->getPostTags($templateParams["posts"][$i]["idPost"]);
    //adding medias to post
    $templateParams["posts"][$i]["mediaPath"] = UPLOAD_DIR.$user['idUtente'].'/'.$templateParams["posts"][$i]["idPost"].'/';
    $media = $dbh->getPostContents($templateParams["posts"][$i]["idPost"]);
    
    for ($m=0; $m < count($media) ; $m++) { 
        $media[$m]["isImage"] = isImageExtension($media[$m]["formato"]);
    }
    $templateParams["posts"][$i]["media"] = $media;
}

$templateParams["content"] = "post_template.php";

$templateParams["js"] = array("../js/functions.js", "../js/like.js", "../js/follow-event.js", "../js/scrolldown-home.js", "../js/notifications_receiver.js","../js/savePost.js");

$templateParams["title"] = 'Lynkzone - home';
require '../template/base.php';

?>