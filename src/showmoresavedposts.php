<?php
require_once 'bootstrap.php';
$result["status"] = false;

if(isset($_POST["start"]) && isset($_POST["end"])){
        $rows = $dbh->getSavedPosts($_SESSION["idUtente"], $_POST["start"],$_POST["end"]);
        if (count($rows) > 0) {
            $result["post"] = $rows[0];
            $result["followedByMe"] = $dbh->isFollowedByMe($result["post"]["idUtente"],$_SESSION["idUtente"]);
            $result["liked"] = $dbh->isPostLiked($_SESSION["idUtente"],$result["post"]["idPost"]);  
            $result["saved"] = $dbh->isPostSaved($_SESSION["idUtente"],$result["post"]["idPost"]);      
            $result["content"] = $dbh->getPostContents($result["post"]["idPost"]);
            $result["status"] = true;
        }
    }

header('Content-Type: application/json');
echo json_encode($result);


?>
 