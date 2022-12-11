<?php
require_once 'bootstrap.php';

//check params and session
//TODO check session
//TODO use $_SESSION['idUtente'] instead of 1
$templateParams["chats"] = $dbh->getRecentChats(1);
$templateParams["content"] = 'chat_list.php';
$templateParams["title"] = 'Lynkzone - DMs'; 
require '../template/base.php';
?>