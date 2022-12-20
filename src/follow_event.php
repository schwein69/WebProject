<?php 
require_once 'bootstrap.php';


$userId=$_POST["userId"];
$result["follower"]=$dbh->isFollowedByMe($userId,$_SESSION["idUtente"]);
if($result["follower"]){
    $dbh->unfollowUser($userId,$_SESSION["idUtente"]);
} else {
    $dbh->followUser($userId,$_SESSION["idUtente"]);
    $dbh->notifUserFollow($userId,$_SESSION["idUtente"]);
}
$result["follower"]=!$result["follower"];

header('Content-Type: application/json');
echo json_encode($result);
?>