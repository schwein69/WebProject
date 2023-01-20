<?php
require_once 'bootstrap.php';


//check params and session
redirectNotLoggedUser();
if(!isset($_GET["chatId"])){
    header('Location: all_chats.php');
}

$templateParams["currentUser"] = $_SESSION["idUtente"];

if(!$dbh->isUserInChat($_GET["chatId"],$templateParams["currentUser"])){
    header('Location: index.php');
}

$templateParams["messages"] = $dbh->getRecentMessagesFromChat($_GET["chatId"]);
$templateParams["user2"] = $dbh->getChatUser($_GET["chatId"], $_SESSION["idUtente"]);
$dbh->readAllMessages($_GET["chatId"], $_SESSION["idUtente"]);
$templateParams["content"] = 'chat_content.php';
$templateParams["title"] = 'Lynkzone - '.$templateParams["user2"]["username"]; 
$templateParams["js"] = array('../js/chat.js');
require '../template/base.php';
?>