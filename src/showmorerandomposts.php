<?php
require_once 'bootstrap.php';
//per sql
$result["status"] = false;

//dati post nuovi
if(isset($_POST["stringList"])){
    $data = explode(",",$_POST["stringList"]);//split in java
    if($_POST["isTag"]){
        $rows = $dbh->getSearchTagPosts( $_POST["tagName"],$_SESSION["idUtente"], $_POST["start"],$_POST["end"]);      
    } else {
        $rows = $dbh->getRandomPosts($_SESSION["idUtente"], $data, 1);   
    }
    if (count($rows) > 0) {
        $result["post"] = $rows[0];
        $user=$dbh->getUserData($result["post"]["idUser"]);
        $result["post"]["username"] = $user["username"];
        $result["post"]["formatoFotoProfilo"] = $user["formatoFotoProfilo"];
        $result["followedByMe"] = $dbh->isFollowedByMe($_SESSION["idUtente"],$result["post"]["idUser"]);
        $result["liked"] = $dbh->isPostLiked($_SESSION["idUtente"],$result["post"]["idPost"]);   
        $result["saved"] = $dbh->isPostSaved($_SESSION["idUtente"],$result["post"]["idPost"]);     
        $result["imagealt"] = getProfilePicAlt($user["username"]);
        $result["isLoggedUserPost"] = $_SESSION["idUtente"] == $result["post"]["idUser"];
        $result["status"] = true;
        $result["followbtntext"] = $result["followedByMe"] ? $lang["userFollowed"] : $lang["userNotFollowed"];
        $result["post"]["tags"] = $dbh->getPostTags($result["post"]["idPost"]);
       
        //adding medias to post
        $result["post"]["mediaPath"] = UPLOAD_DIR.$result["post"]['idUser'].'/'.$result["post"]["idPost"].'/';
        $media = $dbh->getPostContents($result["post"]["idPost"]);
        
        for ($m=0; $m < count($media) ; $m++) { 
            $media[$m]["isImage"] = isImageExtension($media[$m]["formato"]);
        }
        $result["post"]["media"] = $media;
        $result["readMore"] = $lang["post_readMore"];
        $result["comment"] = $lang["post_comment"];
        $result["shareText"] = $lang["post_share"];
        $result["removeText"] = $lang["post_remove"];
        $result["postEditText"] = $lang["post_editPost"];
        $result["savedText"] = $result["saved"] ? $lang["post_saved"] : $lang["post_notSaved"];
    }
}

header('Content-Type: application/json');
echo json_encode($result);


?>
 