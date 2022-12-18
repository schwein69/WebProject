<?php 
require_once 'bootstrap.php';

redirectNotLoggedUser();
$result["counter"] = $dbh->getUnreadNotificationsNumber($_SESSION["idUtente"]);

header('Content-Type: application/json;charset=utf-8');
echo json_encode($result);

?>