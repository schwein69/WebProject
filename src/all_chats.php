<?php
require_once 'bootstrap.php';

redirectNotLoggedUser();
$templateParams["chats"] = $dbh->getRecentChats($_SESSION['idUtente']);
$numChats = count($templateParams["chats"]);

//getting num notifications
for ($i=0; $i < $numChats ; $i++) {
    $chatNotif = $dbh->getUnreadChatMessages($_SESSION["idUtente"], $templateParams["chats"][$i]["idChat"]);
    if($chatNotif > 0){
        $templateParams["chats"][$i]['numNotif'] = $chatNotif;
    }
}

//getting profile picture name
for ($i=0; $i < $numChats ; $i++) { 
    $templateParams["chats"][$i]['fotoProfilo'] = UPLOAD_DIR
    .$templateParams["chats"][$i]['idUtente']
    .'/profile.'
    .$templateParams["chats"][$i]['formatoFotoProfilo'];
}



$templateParams["content"] = 'chat_list.php';
$templateParams["js"] = array('../js/chat_list.js', '../js/notifications_receiver.js');
$templateParams["title"] = 'Lynkzone - DMs'; 
require '../template/base.php';
?>