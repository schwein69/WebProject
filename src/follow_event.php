<?php 
require_once 'bootstrap.php';

redirectNotLoggedUser();

$userIdToUse=$_POST["userId"];
$result["follower"]=$dbh->isFollowedByMe($_SESSION["idUtente"],$userIdToUse);

if($result["follower"]){
    $dbh->unfollowUser($_SESSION["idUtente"],$userIdToUse);
} else {
    if(!$dbh->chatCreated($_SESSION["idUtente"],$userIdToUse)){
        $dbh->createChat($_SESSION["idUtente"],$userIdToUse);
    }
    $dbh->followUser($_SESSION["idUtente"],$userIdToUse);
    $dbh->notifUserFollow($_SESSION["idUtente"],$userIdToUse);
}
$result["follower"]=!$result["follower"];

header('Content-Type: application/json');
echo json_encode($result);
?>