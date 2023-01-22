<?php
require_once 'bootstrap.php';

//check params and session
redirectNotLoggedUser();
if(!isset($_GET["postid"]) && !isset($_POST["postid"])){
    header("Location: index.php");
}

//retrieving post data and checking post ownership
$postId = isset($_GET["postid"]) ? $_GET["postid"] : $_POST["postid"];
$post = $dbh->getPostFunctionHandler()->getPostData($postId);
if($post["idUser"] != $_SESSION["idUtente"]){
    header("Location: index.php");
}


if(isset($_GET["postid"])){
    //EDIT PAGE
    $templateParams["post"] = $post;
    $templateParams["post"]["tags"] = $dbh->getPostFunctionHandler()->getPostTags($postId);
    $templateParams["post"]["media"] = $dbh->getPostFunctionHandler()->getPostContents($postId);
    for ($i=0; $i < count($templateParams["post"]["media"]); $i++) { 
        $templateParams["post"]["media"][$i]["percorsoImmagine"] = UPLOAD_DIR.$templateParams["post"]["idUser"]."/".$postId."/".$templateParams["post"]["media"][$i]["nomeImmagine"]; 
    }
    $templateParams["submitButtonText"] = "Piplup";
    $templateParams["formTarget"] = "edit_post.php";
    $templateParams["content"] = 'create_post.php'; 
    $templateParams["title"] = 'Lynkzone - modifica post'; 
    $templateParams["js"] = array("../js/post_creation_buttons.js", "../js/functions.js",'../js/notifications_receiver.js');
} else if(isset($_POST["postid"])) {
    //EDITING COMPUTATION
    $errMsgs=array();

    //deleting media
    $medias = $dbh->getPostFunctionHandler()->getPostContents($postId);

    $numDelMedia = 0;
    foreach ($medias as $media) {      
        if(isset($_POST["delMedia".$media["idContenuto"]])){
            $dbh->getPostFunctionHandler()->deletePostMedia($media["idContenuto"]);
            unlink(UPLOAD_DIR.$_SESSION["idUtente"]."/".$postId."/".$media["nomeImmagine"]);
            $numDelMedia++;
        }
    } 
    
    //adding new media
    $files_to_upload = array();
    $maxFileUploads = 10 - count($medias) + $numDelMedia;//ignoring ulterior medias
    for($i=1;$i<$maxFileUploads;$i++){
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
    $dbh->getPostFunctionHandler()->updatePost($postId, htmlspecialchars($testo), $now);

    //get tags
    $tags = array();
    for($i=1;$i<10;$i++){
        if(isset($_POST["tag".$i]) && $_POST["tag".$i] != ""){
            if(!areThereDangerousChars($_POST["tag".$i])){
                array_push($tags,$_POST["tag".$i]);
            } else{
                $err = "Impossibile aggiungere tag: ".$_POST["tag".$i];
                array_push($errMsgs, $err);
            }
        }
    }

    //remove tag post
    $dbh->getPostFunctionHandler()->removeTagsFromPost($postId);

    //add tag post
    $dbh->getPostFunctionHandler()->addTagsToPost($postId, $tags);

    $postPath=UPLOAD_DIR.'/'.$_SESSION["idUtente"].'/'.$postId.'/';
    foreach($files_to_upload as $file){
        list($result, $fileType, $msg) = uploadFile($postPath,$file["file"]);
        if($result){
            $dbh->getPostFunctionHandler()->addMediaToPost($postId, $msg, $fileType,$file["desc"]);
        } else {
            array_push($errMsgs, $msg);
        }
    }
    if(count($errMsgs) == 0){
        $templateParams["pageHeader"] = "Post aggiornato con successo";
        $templateParams["title"]= "Lynkzone - post aggiornato";
    } else {
        $templateParams["pageHeader"] = "Post aggiornato, ma sono stati riscontrati dei problemi";
        $templateParams["title"]= "Lynkzone - problema aggiornamento post";
    }
    $templateParams["content"] = "post_creation_result.php"; 
} 

require '../template/base.php';

?>