<?php 
require_once 'bootstrap.php';

redirectNotLoggedUser();
$result["status"] = false;


if(isset($_POST["chatid"]) && isset($_POST["start"]) && isset($_POST["end"])){
    $result["messages"] = $dbh->getRecentMessagesFromChat($_POST["chatid"], $_POST["start"], $_POST["end"]);
    for ($i=0; $i < count($result["messages"]); $i++) { 
        $result["messages"][$i]["isSecondUser"] = $result["messages"][$i]["idMittente"] != $_SESSION["idUtente"];
        $result["messages"][$i]["msgTime"] = date('d-m-Y H:i',strtotime($result["messages"][$i]["msgTimestamp"]));
        $result["messages"][$i]["testoMsg"] = utf8_encode($result["messages"][$i]["testoMsg"]);
    }
    $result["status"] = true;
}

//var_dump($result);

header('Content-Type: application/json;charset=utf-8');
echo json_encode($result, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

?>