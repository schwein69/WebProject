<?php
//TODO check session
include_once 'bootstrap.php';

//taking info about files to upload 
$files_to_upload = array();
for($i=1;$i<10;$i++){
    if(isset($_POST["f".$i])){
        array_push($files_to_upload,$_POST["f".$i]);
    }
}

if(!isset($_POST["testo"]) && count($files_to_upload) == 0){
   header('Location: new_post.php'); 
}

echo "inserting<br>";

//TODO remove this, is just for testing
$user["idUtente"] = 1;
$testo = isset($_POST["testo"]) ? $_POST["testo"] : "";
$now = date('Y-m-d');
$postId=$dbh->insertPost($user["idUtente"], $testo, $now);

echo "IdPost ".$postId."<br>";
//get tags
$tags = array();
for($i=1;$i<10;$i++){
    if(isset($_POST["tag".$i])){
        array_push($tags,$_POST["tag".$i]);
    }
}

$dbh->addTagsToPost($postId, $tags);
?>