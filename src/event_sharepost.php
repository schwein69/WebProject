<?php
require_once 'bootstrap.php';

$friendList = explode(',', $_POST["friendList"]);

$msg = "http://localhost/WebProject/src/post.php?postid=" . $_POST["postIdToShare"];
foreach ($friendList as $friendId) {
    $friendName = $dbh->getUserFunctionHandler()->getUserData($friendId)["username"];
    $data = $dbh->getChatFunctionHandler()->getRecentChats($_SESSION["idUtente"], $friendName);
    $dbh->getChatFunctionHandler()->insertMessage($data[0]["idChat"], $_SESSION["idUtente"], $msg);
    $dbh->getChatFunctionHandler()->updateChatPreview($data[0]["idChat"],$msg);
}

header('Content-Type: application/json');
echo json_encode(null);
?>