<?php 
require_once 'bootstrap.php';

redirectNotLoggedUser();
if(isset($_GET["type"])){
    switch ($_GET["type"]) {
        case 'g':
            $result["counter"] = $dbh->getNotificationFunctionHandler()->getUnreadNotificationsNumber($_SESSION["idUtente"]);
            break;
        
        case 'c':
            $result["chats"] = $dbh->getNotificationFunctionHandler()->getChatsNotifications($_SESSION['idUtente']);
            break;

        default:
            break;
    }
}
header('Content-Type: application/json;charset=utf-8');
echo json_encode($result);

?>