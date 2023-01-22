<?php 
require_once 'bootstrap.php';

redirectNotLoggedUser();

$userIdToUse=$_POST["userId"];
//check if the logged user is following the given user
$result["follower"]=$dbh->getUserFunctionHandler()->isFollowedByMe($_SESSION["idUtente"],$userIdToUse);

//check if chat between users exists
$idChat = 0;
if(!$dbh->getChatFunctionHandler()->isChatCreated($_SESSION["idUtente"],$userIdToUse)){
    $idChat = $dbh->getChatFunctionHandler()->createChat($_SESSION["idUtente"],$userIdToUse);
} else {
    $idChat = $dbh->getChatFunctionHandler()->getChatWithUsers($_SESSION["idUtente"],$userIdToUse);
}

if($result["follower"]){
    $dbh->getUserFunctionHandler()->unfollowUser($_SESSION["idUtente"],$userIdToUse);
    //check if the other user follows the logged user
    if(!$dbh->getUserFunctionHandler()->isFollowedByMe($userIdToUse,$_SESSION["idUtente"])){
        $dbh->getChatFunctionHandler()->deactivateChat($idChat);
    }
} else {
    $dbh->getChatFunctionHandler()->activateChat($idChat);
    $dbh->getUserFunctionHandler()->followUser($_SESSION["idUtente"],$userIdToUse);
    $dbh->getNotificationFunctionHandler()->notifUserFollow($_SESSION["idUtente"],$userIdToUse);
}
$result["follower"]=!$result["follower"];

header('Content-Type: application/json');
echo json_encode($result);
?>