<?php 
require_once 'bootstrap.php';

redirectNotLoggedUser();

$postid=$_POST["postid"];
$user=$_SESSION["idUtente"];
$result["liked"]=$dbh->isPostLiked($user, $postid);
if($result["liked"]){
    $dbh->dislikePost($user, $postid);
} else {
    $dbh->likePost($user, $postid);
    $authId = $dbh->getPostData($postId)["idUser"];
    $dbh->notifUserLike($user, $postId, $authId);
}
$result["liked"]=!$result["liked"];

header('Content-Type: application/json');
echo json_encode($result);
?>