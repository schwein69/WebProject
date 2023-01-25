<?php
include_once 'bootstrap.php';

//taking info about files to upload 
redirectNotLoggedUser();

$errMsgs=array();
$files_to_upload = array();
for($i=1;$i<10;$i++){
    if(isset($_FILES["f".$i]) && $_FILES["f".$i]['size']!=0){
        $elem["file"] = $_FILES["f".$i];
        $elem["desc"] = areThereDangerousChars($_POST["alt".$i]) ? "" : $_POST["alt".$i];
        array_push($files_to_upload,$elem);
    }
}
if(!isset($_POST["testo"]) && count($files_to_upload) == 0){
   header('Location: new_post.php'); 
}

$testo = isset($_POST["testo"]) ? $_POST["testo"] : "";
$now = date('Y-m-d');
$postId=$dbh->getPostFunctionHandler()->insertPost($_SESSION["idUtente"], htmlspecialchars($testo), $now);

//get tags
$tags = array();
for($i=1;$i<10;$i++){
    if(isset($_POST["tag".$i]) && $_POST["tag".$i] != ""){
        if(!areThereDangerousChars($_POST["tag".$i])){
            array_push($tags,$_POST["tag".$i]);
        } else{
            $err = $lang["err_unableAddTag"].$_POST["tag".$i];
            array_push($errMsgs, $err);
        }
    }
}
$dbh->getPostFunctionHandler()->addTagsToPost($postId, $tags);


$postPath=UPLOAD_DIR.'/'.$_SESSION["idUtente"].'/'.$postId.'/';
if(!mkdir($postPath, 0777, true)){
    array_push($errMsgs, "Generic error: ".error_get_last()['message']);
}
foreach($files_to_upload as $file){
    list($result, $fileType, $msg) = uploadFile($postPath,$file["file"]);
    if($result){
        $dbh->getPostFunctionHandler()->addMediaToPost($postId, $msg, $fileType,$file["desc"]);
    } else {
        array_push($errMsgs, $msg);
    }
}
if(count($errMsgs) == 0){
    $templateParams["pageHeader"] = $lang["createPost_success"];
    $templateParams["title"]= "Lynkzone - ".$lang["createPost_success_title"];
}else{
    $templateParams["pageHeader"] = $lang["createPost_error"];
    $templateParams["title"]= "Lynkzone - ".$lang["createPost_error_title"];
}
$templateParams["js"] = array('../js/notifications_receiver.js');   
$templateParams["content"] = "post_creation_result.php"; 
require '../template/base.php';
?>