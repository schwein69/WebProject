<?php
require_once 'bootstrap.php';

//check params and session
redirectNotLoggedUser();
if(!isset($_GET["chatId"])){
    header('Location: all_chats.php');
}


$templateParams["currentUser"] = $_SESSION["idUtente"];
$templateParams["messages"] = $dbh->getRecentMessagesFromChat($_GET["chatId"]);
$templateParams["content"] = 'chat_content.php';
$templateParams["title"] = 'Lynkzone - '; 
$templateParams["js"] = array();
array_push($templateParams["js"],'../js/chat.js');
require '../template/base.php';
?>