<?php 
require_once 'bootstrap.php';

redirectNotLoggedUser();

$postid=$_POST["postid"];
$user=$_SESSION["idUtente"];
$result["status"]=false;
if(isset($_POST["testo"]) && $_POST["testo"]!=""){
    $dbh->addCommentToPost($user, $postid, $_POST["testo"]);
    $result["status"]=true;
}
header('Content-Type: application/json');
echo json_encode($result);
?>