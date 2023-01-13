<?php
require_once 'bootstrap.php';
//check params and session
redirectNotLoggedUser();
if(!isset($_GET['postid'])){
    header("Location: index.php");
}
//TODO usernames must be links to profile?userid=xyz




//fetch post from db
$post = $dbh->getPostData($_GET['postid']);

//check if post exists
if(is_null($post)){
    header("Location: index.php");
}

$user = $dbh->getUserData($post['idUser']);
$comments = $dbh->getPostComments($_GET['postid']);
$post["fotoProfilo"] = UPLOAD_DIR.$user["idUtente"].'/profile.'.$user["formatoFotoProfilo"];
$post["fotoProfiloAlt"] = "foto profilo di ".$user["username"];
$post["username"] = $user["username"];
$post["followedByMe"] = $dbh->isFollowedByMe($_SESSION["idUtente"],$user["idUtente"]);
$post["liked"] = $dbh->isPostLiked($_SESSION["idUtente"],$_GET['postid']);
$post["saved"] = $dbh->isPostSaved($_SESSION["idUtente"],$_GET['postid']);
$post["media"] = $dbh->getPostContents($_GET['postid']);
$post["mediaPath"] = UPLOAD_DIR.$user['idUtente'].'/'.$_GET['postid'].'/';
$post["isFull"] = true;
$post["isLoggedUserPost"] = $user['idUtente'] == $_SESSION['idUtente'];
$post["tags"] = $dbh->getPostTags($_GET['postid']);
setMediaType($post["media"]);
$templateParams["posts"] = array($post);

$templateParams["content"] = 'full_post.php'; 
$templateParams["user"] = $dbh->getUserData($_SESSION["idUtente"]);
$templateParams["title"] = 'Lynkzone - post'; 
require '../template/base.php';
?>