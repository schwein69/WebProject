<?php 
require_once 'bootstrap.php';

redirectNotLoggedUser();

//TODO insert notification
$postid=$_POST["userId"];
$user=$_SESSION["idUtente"];
$result["follower"]=$dbh->isPostLiked($user, $postid);
if($result["liked"]){
    $dbh->dislikePost($user, $postid);
} else {
    $dbh->likePost($user, $postid);
}
$result["liked"]=!$result["liked"];

header('Content-Type: application/json');
echo json_encode($result);
?>