<?php 
require_once 'bootstrap.php';

redirectNotLoggedUser();

$postid=$_POST["postid"];
$user=$_SESSION["idUtente"];
$result["saved"]=$dbh->getPostFunctionHandler()->isPostSaved($user, $postid);
if($result["saved"]){
    $dbh->getPostFunctionHandler()->unsavePost($user, $postid);
} else {
    $dbh->getPostFunctionHandler()->savePost($user, $postid);
}
$result["saved"]=!$result["saved"];

header('Content-Type: application/json');
echo json_encode($result);
?>