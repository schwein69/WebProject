<?php 
require_once 'bootstrap.php';

redirectNotLoggedUser();
$result["status"] = false;
if(isset($_POST["chatid"]) && isset($_POST["text"])){
    $msg = trim($_POST["text"]);
    if($msg != ""){
        $result["status"] = true;
        $result["chats"] = $dbh->getRecentChats();
    } else {
        $result["err"] = "Il messaggio non può essere vuoto";
    }
} else {
    $result["err"] = "Errore di comunicazione: parametri non presenti";
}
header('Content-Type: application/json');
echo json_encode($result);
?>