<?php
require_once 'bootstrap.php';
require_once 'post_template.php';
//check params and session
redirectNotLoggedUser();
if(!isset($_GET['postid'])){
    header("Location: index.php");
}
//TODO manage images and videos
//TODO usernames must be links to profile?userid=xyz




//fetch post from db
$templateParams["post"] = $dbh->getPostData($_GET['postid']);

//check if post exists
if(is_null($templateParams["post"])){
    header("Location: index.php");
}

$user = $dbh->getUserData($templateParams["post"]['idUser']);
$comments = $dbh->getPostComments($_GET['postid']);
$templateParams["post"]["fotoProfilo"] = UPLOAD_DIR.$user["idUtente"].'/profile.'.$user["formatoFotoProfilo"];
$templateParams["post"]["fotoProfiloAlt"] = "foto profilo di ".$user["username"];
$templateParams["post"]["username"] = $user["username"];
$templateParams["post"]["followedByMe"] = $dbh->isFollowedByMe($user["idUtente"],$_SESSION["idUtente"]);
$templateParams["post"]["liked"] = $dbh->isPostLiked($_SESSION["idUtente"],$_GET['postid']);
$templateParams["post"]["media"] = $dbh->getPostContents($_GET['postid']);
$templateParams["post"]["mediaPath"] = UPLOAD_DIR.$user['idUtente'].'/'.$_GET['postid'].'/';
$templateParams["post"]["isFull"] = true;
$templateParams["post"]["isLoggedUserPost"] = $user['idUtente'] == $_SESSION['idUtente'];

$templateParams["content"] = 'full_post.php'; 
$templateParams["user"] = $dbh->getUserData($_SESSION["idUtente"]);
$templateParams["title"] = 'Lynkzone - post'; 
require '../template/base.php';
?>