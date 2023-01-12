<?php
include_once 'bootstrap.php';

//taking info about files to upload 
redirectNotLoggedUser();

$files_to_upload = array();
for($i=1;$i<10;$i++){
    if(isset($_FILES["f".$i]) && $_FILES["f".$i]['size']!=0){
        $elem["file"]=$_FILES["f".$i];
        $elem["desc"]=$_POST["alt".$i];
        array_push($files_to_upload,$elem);
    }
}

if(!isset($_POST["testo"]) && count($files_to_upload) == 0){
   header('Location: new_post.php'); 
}

$testo = isset($_POST["testo"]) ? $_POST["testo"] : "";
$now = date('Y-m-d');
$postId=$dbh->insertPost($_SESSION["idUtente"], $testo, $now);

//get tags
$tags = array();
for($i=1;$i<10;$i++){
    if(isset($_POST["tag".$i])){
        array_push($tags,$_POST["tag".$i]);
    }
}

$dbh->addTagsToPost($postId, $tags);

$errMsgs=array();

$postPath=UPLOAD_DIR.'/'.$_SESSION["idUtente"].'/'.$postId.'/';
if(!mkdir($postPath, 0777, true)){
    array_push($errMsgs, "Errore nella creazione dello spazio per il post: ".error_get_last()['message']);
}
foreach($files_to_upload as $file){
    list($result, $fileType, $msg) = uploadFile($postPath,$file["file"]);
    if($result){
        //var_dump($postId, $msg, $fileType,$file["desc"]);
        $dbh->addMediaToPost($postId, $msg, $fileType,$file["desc"]);
        //echo "OK";
    } else {
        array_push($errMsgs, $msg);
    }
}
$templateParams["content"]="post_creation_result.php"; 
$templateParams["title"]=count($errMsgs) == 0? "Lynkzone - post creato" : "Lynkzone - problema creazione post";
require '../template/base.php';
?>