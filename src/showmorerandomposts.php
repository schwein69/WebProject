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
        $rows = $dbh->getRandomPostsWithArray(1, $_SESSION["idUtente"], $data);   
    }
    if (count($rows) > 0) {
        $result["post"] = $rows[0];
        $result["followedByMe"] = $dbh->isFollowedByMe($result["post"]["idUtente"],$_SESSION["idUtente"]);
        $result["liked"] = $dbh->isPostLiked($_SESSION["idUtente"],$result["post"]["idPost"]);   
        $result["saved"] = $dbh->isPostSaved($_SESSION["idUtente"],$result["post"]["idPost"]);     
        $result["content"] = $dbh->getPostContents($result["post"]["idPost"]);
        $result["status"] = true;

        //TODO da chiedere/ aggiungere al function.js
        $result["mediaPath"] = UPLOAD_DIR . $result["post"]["idUtente"] . '/' . $result["post"]["idPost"] . '/';
        $media = $dbh->getPostContents($result["post"]["idPost"]);

        for ($m = 0; $m < count($media); $m++) {
            $media[$m]["isImage"] = isImageExtension($media[$m]["formato"]);
        }
        $result["media"] = $media;
        $result["fotoProfiloAlt"] = "foto profilo di ".$result["post"]['username'];
        $result["isFull"] = false;
        $result["isLoggedUserPost"] = $result["post"]["idUtente"] == $_SESSION["idUtente"];
    }
}

header('Content-Type: application/json');
echo json_encode($result);


?>
 