<?php
require_once 'bootstrap.php';

//check params and session
//TODO check session
//TODO manage images and videos
//TODO usernames must be links to profile?userid=xyz
//TODO user must be $_SESSION
if(!isset($_GET['postid'])){
    header("Location: index.php");
}


//fetch post from db
$post_data = $dbh->getPostData($_GET['postid']);

//check if post exists
if(is_null($post_data)){
    header("Location: index.php");
}
$user=1;
$post_data["liked"]=$dbh->isPostLiked($user,$_GET['postid']);
$user = $dbh->getAuthorName($post_data['idUser']);
$comments = $dbh->getPostComments($_GET['postid']);

$templateParams["content"] = 'full_post.php'; 
$templateParams["title"] = 'Lynkzone - post'; 
require '../template/base.php';
?>