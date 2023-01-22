<?php
require_once 'bootstrap.php';

redirectNotLoggedUser();

$postid = $_POST["postid"];

$post = $dbh->getPostFunctionHandler()->getPostData($postid);
if ($post["idUser"] == $_SESSION["idUtente"]) {
    $media = $dbh->getPostFunctionHandler()->getPostContents($postid);
    foreach ($media as $m) {
        unlink(UPLOAD_DIR.$_SESSION["idUtente"]."/".$postid."/".$m["nomeImmagine"]);
    }
    rmdir(UPLOAD_DIR.$_SESSION["idUtente"]."/".$postid); 
    $dbh->getPostFunctionHandler()->removePost($postid);
}
header('Content-Type: application/json');
echo json_encode(null);
?>