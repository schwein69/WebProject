<?php
require_once 'bootstrap.php';

$result = $dbh->getChatFunctionHandler()->getRecentChats($_SESSION["idUtente"], null, $_POST["actualCountOfFriendList"]);
for ($i=0; $i < count($result); $i++) { 
    $result[$i]["profilePicAlt"] = getProfilePicAlt($result[$i]["username"]);
}
header('Content-Type: application/json');
echo json_encode($result);
?>