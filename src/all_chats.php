<?php
require_once 'bootstrap.php';

//TODO automatically refresh chat preview (AJAX)
redirectNotLoggedUser();
$templateParams["chats"] = $dbh->getRecentChats($_SESSION['idUtente']);
$templateParams["content"] = 'chat_list.php';
$templateParams["title"] = 'Lynkzone - DMs'; 
require '../template/base.php';
?>