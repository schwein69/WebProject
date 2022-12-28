<?php 
require_once 'bootstrap.php';


$userId=$_POST["userId"];
$result["follower"]=$dbh->isFollowedByMe($_SESSION["idUtente"],$userId);
if($result["follower"]){
    $dbh->unfollowUser($_SESSION["idUtente"],$userId);
} else {
    $dbh->followUser($_SESSION["idUtente"],$userId);
    $dbh->notifUserFollow($_SESSION["idUtente"],$userId);
}
$result["follower"]=!$result["follower"];

header('Content-Type: application/json');
echo json_encode($result);
?>