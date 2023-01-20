<?php
require_once 'bootstrap.php';

$friendList = explode(',', $_POST["friendList"]);

$msg = "http://localhost/WebProject/src/post.php?postid=" . $_POST["postIdToShare"];
foreach ($friendList as $friendId) {
    $friendName = $dbh->getUserData($friendId)["username"];
    $data = $dbh->getRecentChats($_SESSION["idUtente"], $friendName);
    $dbh->insertMessage($data[0]["idChat"], $_SESSION["idUtente"], $msg);
}

header('Content-Type: application/json');
echo json_encode(null);
?>