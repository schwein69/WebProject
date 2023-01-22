<?php
require_once 'bootstrap.php';

redirectNotLoggedUser();

$templateParams["notifications"] = $dbh->getNotificationFunctionHandler()->getNotifications($_SESSION["idUtente"]); 
$dbh->getNotificationFunctionHandler()->readAllNotifications($_SESSION["idUtente"]);
$templateParams["numNotifications"] = count($templateParams["notifications"]);
for ($i=0; $i < $templateParams["numNotifications"]; $i++) { 
    $notifUser = $dbh->getUserFunctionHandler()->getUserData($templateParams["notifications"][$i]["idUtenteNotificante"]);
    $templateParams["notifications"][$i]["username"] = $notifUser["username"];
    $templateParams["notifications"][$i]["fotoProfilo"] = UPLOAD_DIR.$notifUser['idUtente'].'/profile.'.$notifUser["formatoFotoProfilo"];
}
$templateParams["js"] = array('../js/infinite_notificationsList.js');
$templateParams["content"] = 'notification_list.php';
$templateParams["title"] = 'Lynkzone - Notifiche'; 
require '../template/base.php';
?>