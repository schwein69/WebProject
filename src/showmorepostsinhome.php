<?php
require_once 'bootstrap.php';
$result["status"] = false;

if(isset($_POST["start"]) && isset($_POST["end"])){
        $rows = $dbh->getPostFunctionHandler()->getFollowedPosts($_SESSION["idUtente"], $_POST["start"],$_POST["end"]);
        if (count($rows) > 0) {
            $result["post"] = $rows[0];
            $user=$dbh->getUserFunctionHandler()->getUserData($result["post"]["idUser"]);
            $result["post"]["username"] = $user["username"];
            $result["post"]["formatoFotoProfilo"] = $user["formatoFotoProfilo"];
            $result["followedByMe"] = $dbh->getUserFunctionHandler()->isFollowedByMe($_SESSION["idUtente"],$result["post"]["idUser"]);
            $result["liked"] = $dbh->getPostFunctionHandler()->isPostLiked($_SESSION["idUtente"],$result["post"]["idPost"]);    
            $result["saved"] = $dbh->getPostFunctionHandler()->isPostSaved($_SESSION["idUtente"],$result["post"]["idPost"]);    
            $result["imagealt"] = getProfilePicAlt($user["username"]);
            $result["isLoggedUserPost"] = $_SESSION["idUtente"] == $result["post"]["idUser"];
            $result["status"] = true;
            $result["followbtntext"] = $result["followedByMe"] ? $lang["userFollowed"] : $lang["userNotFollowed"];
            $result["post"]["tags"] = $dbh->getPostFunctionHandler()->getPostTags($result["post"]["idPost"]);
            $result["post"]["username"] = $user["username"];
            $result["post"]["formatoFotoProfilo"] = $user["formatoFotoProfilo"];
            //adding medias to post
            $result["post"]["mediaPath"] = UPLOAD_DIR.$result["post"]['idUser'].'/'.$result["post"]["idPost"].'/';
            $media = $dbh->getPostFunctionHandler()->getPostContents($result["post"]["idPost"]);
            
            for ($m=0; $m < count($media) ; $m++) { 
                $media[$m]["isImage"] = isImageExtension($media[$m]["formato"]);
            }
            $result["post"]["media"] = $media;
            $result["readMore"] = $lang["post_readMore"];
            $result["comment"] = $lang["post_comment"];
            $result["savedText"] = $result["saved"] ? $lang["post_saved"] : $lang["post_notSaved"];
            $result["shareText"] = $lang["post_share"];
            $result["removeText"] = $lang["post_remove"];
            $result["postEditText"] = $lang["post_editPost"];    
        }
}

header('Content-Type: application/json');
echo json_encode($result);


?>