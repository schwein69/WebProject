<?php
//TODO check session
include_once 'bootstrap.php';

//taking info about files to upload 
var_dump($_POST);
$files_to_upload = array();
for($i=1;$i<10;$i++){
    if(isset($_FILES["f".$i])){
        $elem["file"]=$_FILES["f".$i];
        $elem["desc"]=$_POST["alt".$i];
        array_push($files_to_upload,$elem);
    }
}

if(!isset($_POST["testo"]) && count($files_to_upload) == 0){
   header('Location: new_post.php'); 
}

//TODO remove this, is just for testing
$user["idUtente"] = 1;

$testo = isset($_POST["testo"]) ? $_POST["testo"] : "";
$now = date('Y-m-d');
$postId=$dbh->insertPost($user["idUtente"], $testo, $now);

//get tags
$tags = array();
for($i=1;$i<10;$i++){
    if(isset($_POST["tag".$i])){
        array_push($tags,$_POST["tag".$i]);
    }
}

$dbh->addTagsToPost($postId, $tags);

$errMsgs=array();

$postPath=UPLOAD_DIR.'/'.$user["idUtente"].'/'.$postId.'/';
if(!mkdir($postPath, 0777, true)){
    array_push($errMsgs, "Errore nella creazione dello spazio per il post: ".error_get_last()['message']);
}
foreach($files_to_upload as $file){
    list($result, $fileType, $msg) = uploadFile($postPath,$file["file"]);
    if($result){
        $dbh->addMediaToPost($postId, $msg, $fileType,$file["desc"]);
    } else {
        array_push($errMsgs, $msg);
    }
}

$templateParams["content"]="post_creation_result.php"; 
$templateParams["title"]=count($errMsgs) == 0? "Lynkzone - post creato" : "Lynkzone - problema creazione post";
require '../template/base.php';
?>