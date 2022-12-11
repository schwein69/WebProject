<?php
require_once 'bootstrap.php';

//check params and session
//TODO check session

if(!isset($_GET["chatId"])){
    header('Location: all_chats.php');
}
//TODO use $_SESSION
$templateParams["currentUser"] = 1;
$templateParams["messages"] = $dbh->getRecentMessagesFromChat($_GET["chatId"]);
$templateParams["content"] = 'chat_content.php';
$templateParams["title"] = 'Lynkzone - '; 
require '../template/base.php';
?>