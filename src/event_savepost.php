<?php 
require_once 'bootstrap.php';

redirectNotLoggedUser();

$postid=$_POST["postid"];
$user=$_SESSION["idUtente"];
$result["saved"]=$dbh->isPostSaved($user, $postid);
if($result["saved"]){
    $dbh->unsavePost($user, $postid);
} else {
    $dbh->savePost($user, $postid);
}
$result["saved"]=!$result["saved"];

header('Content-Type: application/json');
echo json_encode($result);
?>