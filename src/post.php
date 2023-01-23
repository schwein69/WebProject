<?php
require_once 'bootstrap.php';
//check params and session
redirectNotLoggedUser();
if(!isset($_GET['postid'])){
    header("Location: index.php");
}


//fetch post from db
$post = $dbh->getPostFunctionHandler()->getPostData($_GET['postid']);

//check if post exists
if(is_null($post)){
    header("Location: index.php");
}

$user = $dbh->getUserFunctionHandler()->getUserData($post['idUser']);
$templateParams["comments"] = $dbh->getPostFunctionHandler()->getPostComments($_GET['postid']);
$post["fotoProfilo"] = UPLOAD_DIR.$user["idUtente"].'/profile.'.$user["formatoFotoProfilo"];
$post["fotoProfiloAlt"] = getProfilePicAlt($user["username"]);
$post["username"] = $user["username"];
$post["followedByMe"] = $dbh->getUserFunctionHandler()->isFollowedByMe($_SESSION["idUtente"],$user["idUtente"]);
$post["liked"] = $dbh->getPostFunctionHandler()->isPostLiked($_SESSION["idUtente"],$_GET['postid']);
$post["saved"] = $dbh->getPostFunctionHandler()->isPostSaved($_SESSION["idUtente"],$_GET['postid']);
$post["media"] = $dbh->getPostFunctionHandler()->getPostContents($_GET['postid']);
$post["mediaPath"] = UPLOAD_DIR.$user['idUtente'].'/'.$_GET['postid'].'/';
$post["isFull"] = true;
$post["isLoggedUserPost"] = $user['idUtente'] == $_SESSION['idUtente'];
$post["tags"] = $dbh->getPostFunctionHandler()->getPostTags($_GET['postid']);
setMediaType($post["media"]);
$templateParams["posts"] = array($post);

$templateParams["js"] = array('../js/notifications_receiver.js','../js/video_handler.js');
$templateParams["content"] = 'full_post.php'; 
$templateParams["user"] = $dbh->getUserFunctionHandler()->getUserData($_SESSION["idUtente"]);
$templateParams["title"] = 'Lynkzone - post'; 
require '../template/base.php';
?>