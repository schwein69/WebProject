<?php
require_once 'bootstrap.php';

//TODO automatically refresh chat preview (AJAX)
redirectNotLoggedUser();
$templateParams["chats"] = $dbh->getRecentChats($_SESSION['idUtente']);
//var_dump($templateParams["chats"]);
$templateParams["content"] = 'chat_list.php';
$templateParams["js"] = array('../js/chat_list.js');
$templateParams["title"] = 'Lynkzone - DMs'; 
require '../template/base.php';
?>