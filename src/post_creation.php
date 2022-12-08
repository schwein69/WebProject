<?php
//TODO check session


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


//TODO remove this, is just for testing
$user["idUtente"] = 1;
$postId = $dbh->insertPost($user["idUtente"], $_POST["testo"], getdate('Y-m-d'), $tags);


//get tags
$tags = array();
for($i=1;$i<10;$i++){
    if(isset($_POST["tag".$i])){
        array_push($tags,$_POST["tag".$i]);
    }
}

$dbh->addTagsToPost($postId, $tags);
?>