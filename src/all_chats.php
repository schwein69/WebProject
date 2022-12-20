<?php
require_once 'bootstrap.php';

//TODO automatically refresh chat preview (AJAX)
/*
TODO (optional):
-register all chats in the page
-remove/add chats based on existing scripts
-get chat ordered by tempo, with notifications (0 included)
-add new chatid to array and sort by time -> ATTENTION: possible bad visual effect due to content replacement, simple test required
*/
redirectNotLoggedUser();
$templateParams["chats"] = $dbh->getRecentChats($_SESSION['idUtente']);
$chatNotifs = $dbh->getChatsNotifications($_SESSION['idUtente']);
foreach ($chatNotifs as $chatNotif) {
    for ($i=0; $i < count($templateParams["chats"]) ; $i++) { 
        if($chatNotif['idChat'] == $templateParams["chats"][$i]['idChat']){
            $templateParams["chats"][$i]['numNotif'] = $chatNotif['numMsgs'];
            break;
        }
    }
}
$templateParams["content"] = 'chat_list.php';
$templateParams["js"] = array('../js/chat_list.js', '../js/notifications_receiver.js');
$templateParams["title"] = 'Lynkzone - DMs'; 
require '../template/base.php';
?>