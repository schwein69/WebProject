<?php 
require_once 'bootstrap.php';

redirectNotLoggedUser();
$result["status"] = false;
if(isset($_POST["chatid"]) && isset($_POST["msg"])){
    $msg = trim($_POST["msg"]);
    if($msg != ""){
        $dbh->insertMessage($_POST["chatid"],$_SESSION["idUtente"], $msg);
        $dbh->updateChatPreview($_POST["chatid"], $msg);
        $result["status"] = true;
    } else {
        $result["err"] = "Il messaggio non può essere vuoto";
    }
} else {
    $result["err"] = "Errore di comunicazione: parametri non presenti";
}
header('Content-Type: application/json');
echo json_encode($result);
?>