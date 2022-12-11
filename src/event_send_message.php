<?php 
require_once 'bootstrap.php';

//TODO check session
//TODO manage like/dislike
//TODO use $_SESSION["idUtente"]
$postid=$_POST["postid"];
$user=1;
$result["liked"]=$dbh->isPostLiked($user, $postid);
if($result["liked"]){
    $dbh->dislikePost($user, $postid);
} else {
    $dbh->likePost($user, $postid);
}
$result["liked"]=!$result["liked"];

header('Content-Type: application/json');
echo json_encode($result);
?>