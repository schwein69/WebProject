<?php
require_once 'bootstrap.php';


//check params and session
redirectNotLoggedUser();
if(!isset($_GET["chatId"])){
    header('Location: all_chats.php');
}

$templateParams["currentUser"] = $_SESSION["idUtente"];

if(!$dbh->getChatFunctionHandler()->isUserInChat($_GET["chatId"],$templateParams["currentUser"]) || !$dbh->getChatFunctionHandler()->isChatActive($_GET["chatId"])){
    header('Location: index.php');
}

$templateParams["messages"] = $dbh->getChatFunctionHandler()->getRecentMessagesFromChat($_GET["chatId"]);
$templateParams["user2"] = $dbh->getChatFunctionHandler()->getChatUser($_GET["chatId"], $_SESSION["idUtente"]);
$templateParams["user2"]["profilePic"] = UPLOAD_DIR.$templateParams["user2"]["idUtente"]."/profile.".$templateParams["user2"]["formatoFotoProfilo"];
$templateParams["user2"]["profilePicAlt"] = getProfilePicAlt($templateParams["user2"]["username"]);
$dbh->getChatFunctionHandler()->readAllMessages($_GET["chatId"], $_SESSION["idUtente"]);
$templateParams["content"] = 'chat_content.php';
$templateParams["title"] = 'Lynkzone - '.$templateParams["user2"]["username"]; 
$templateParams["js"] = array('../js/chat.js','../js/notifications_receiver.js');
require '../template/base.php';
?>