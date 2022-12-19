<?php
require_once 'bootstrap.php';

//check params and session
redirectNotLoggedUser();
if(!isset($_GET['postid'])){
    header("Location: index.php");
}
//TODO manage images and videos
//TODO usernames must be links to profile?userid=xyz




//fetch post from db
$post_data = $dbh->getPostData($_GET['postid']);

//check if post exists
if(is_null($post_data)){
    header("Location: index.php");
}

$post_data["liked"]=$dbh->isPostLiked($_SESSION["idUtente"],$_GET['postid']);
$user = $dbh->getUserData($post_data['idUser']);
$comments = $dbh->getPostComments($_GET['postid']);

$templateParams["content"] = 'full_post.php'; 
$templateParams["user"] = $dbh->getUserData($_SESSION["idUtente"]);
$templateParams["title"] = 'Lynkzone - post'; 
require '../template/base.php';
?>