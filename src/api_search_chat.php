<?php 
require_once 'bootstrap.php';

redirectNotLoggedUser();
$result["status"] = false;

$userString = isset($_POST["text"]) ? trim($_POST["text"]) : "";
$result["status"] = true;

if(isset($_POST["start"]) && isset($_POST["end"])){
    $result["chats"] = $dbh->getRecentChats($_SESSION["idUtente"],$userString, $_POST["start"], $_POST["end"]);
} else {
    $result["chats"] = $dbh->getRecentChats($_SESSION["idUtente"],$userString);
}


for ($i=0; $i < count($result["chats"]); $i++) { 
    $result["chats"][$i]["fotoProfilo"] = UPLOAD_DIR.$result["chats"][$i]["idUtente"]."/profile.".$result["chats"][$i]["formatoFotoProfilo"];
    if($result["chats"][$i]["anteprimaChat"] == "") {
        $result["chats"][$i]["anteprimaChat"] = "Inizia la conversazione";
    }
}
header('Content-Type: application/json');
echo json_encode($result);
?>