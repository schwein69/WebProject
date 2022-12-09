<?php
require_once 'bootstrap.php';

//check params and session
//TODO check session
//TODO usernames must be links to profile?userid=xyz
$templateParams["chats"] = $dbh->getRecentChats(1);
var_dump($templateParams["chats"]);
$templateParams["content"] = 'chat_list.php';
$templateParams["title"] = 'Lynkzone - DMs'; 
require '../template/base.php';
?>