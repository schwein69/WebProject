<?php 
require_once 'bootstrap.php';

redirectNotLoggedUser();
$result["status"] = false;


if(isset($_POST["start"]) && isset($_POST["end"])){
    $result["notifications"] = $dbh->getNotifications($_SESSION["idUtente"], $_POST["start"], $_POST["end"]); 
    $result["numNotifications"] = count($result["notifications"]);
    for ($i=0; $i < $result["numNotifications"]; $i++) { 
        $notifUser = $dbh->getUserData($result["notifications"][$i]["idUtenteNotificante"]);
        $result["notifications"][$i]["username"] = $notifUser["username"];
        $result["notifications"][$i]["fotoProfilo"] = UPLOAD_DIR.$notifUser['idUtente'].'/'.$notifUser["fotoProfilo"];
        $result["notifications"][$i]["isPostNotification"] = isPostNotification($result["notifications"][$i]["nomeTipo"]);
    }
    $result["status"] = true;
}

//var_dump($result);

header('Content-Type: application/json;charset=utf-8');
echo json_encode($result, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

?>