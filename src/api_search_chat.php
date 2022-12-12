<?php 
require_once 'bootstrap.php';

redirectNotLoggedUser();
$result["status"] = false;
if(isset($_POST["text"])){
    $msg = trim($_POST["text"]);
    $result["status"] = true;
    $result["chats"] = $dbh->getRecentChats($_SESSION["idUtente"],$msg);
    
} else {
    $result["err"] = "Errore di comunicazione: parametri non presenti";
}
header('Content-Type: application/json');
echo json_encode($result);
?>