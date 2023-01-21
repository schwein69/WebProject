<?php 
require_once 'bootstrap.php';

redirectNotLoggedUser();

$userIdToUse=$_POST["userId"];
//check if the logged user is following the given user
$result["follower"]=$dbh->isFollowedByMe($_SESSION["idUtente"],$userIdToUse);

//check if chat between users exists
$idChat = 0;
if(!$dbh->chatCreated($_SESSION["idUtente"],$userIdToUse)){
    $idChat = $dbh->createChat($_SESSION["idUtente"],$userIdToUse);
} else {
    $idChat = $dbh->getChatWithUsers($_SESSION["idUtente"],$userIdToUse);
}

if($result["follower"]){
    $dbh->unfollowUser($_SESSION["idUtente"],$userIdToUse);
    //check if the other user follows the logged user
    if(!$dbh->isFollowedByMe($userIdToUse,$_SESSION["idUtente"])){
        $dbh->deactivateChat($idChat);
    }
} else {
    $dbh->activateChat($idChat);
    $dbh->followUser($_SESSION["idUtente"],$userIdToUse);
    $dbh->notifUserFollow($_SESSION["idUtente"],$userIdToUse);
}
$result["follower"]=!$result["follower"];

header('Content-Type: application/json');
echo json_encode($result);
?>