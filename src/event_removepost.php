<?php 
require_once 'bootstrap.php';

redirectNotLoggedUser();

$postid=$_POST["postid"];
$dbh->removePost($postid);
header('Content-Type: application/json');
echo json_encode(null);
?>