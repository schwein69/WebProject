<?php 
require_once 'bootstrap.php';

redirectNotLoggedUser();

$postid=$_POST["postid"];
$user=$_SESSION["idUtente"];
$result["status"]=false;
if(isset($_POST["testo"]) && $_POST["testo"]!=""){
    $testo = htmlspecialchars($_POST["testo"]);
    $dbh->addCommentToPost($user, $postid, $testo);
    $authId = $dbh->getPostData($postid)["idUser"];
    $result["text"] = $testo;
    if($authId != $user){
        $dbh->notifUserComment($user, $postid, $authId);
    }
    $result["status"]=true;
}
header('Content-Type: application/json');
echo json_encode($result);
?>