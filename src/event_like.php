<?php 
require_once 'bootstrap.php';

redirectNotLoggedUser();

$postid=$_POST["postid"];
$user=$_SESSION["idUtente"];
$result["liked"]=$dbh->getPostFunctionHandler()->isPostLiked($user, $postid);
if($result["liked"]){
    $dbh->getPostFunctionHandler()->dislikePost($user, $postid);
} else {
    $dbh->getPostFunctionHandler()->likePost($user, $postid);
    $authId = $dbh->getPostFunctionHandler()->getPostData($postid)['idUser'];
    if($user != $authId){
        $dbh->getNotificationFunctionHandler()->notifUserLike($user, $postid, $authId);
    }
}
$result["liked"]=!$result["liked"];

header('Content-Type: application/json');
echo json_encode($result);
?>