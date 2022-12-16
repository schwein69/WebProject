<?php
require_once 'bootstrap.php';
$result["status"] = false;

if(isset($_POST["start"]) && isset($_POST["end"])){
        $rows = $dbh->getFollowedPosts($_SESSION["idUtente"], $_POST["start"],$_POST["end"]);
        if (count($rows) > 0) {
            $result["post"] = $rows[0];
            $result["liked"] = $dbh->isPostLiked($_SESSION["idUtente"],$result["post"]["idPost"]);    
            $result["content"] = $dbh->getPostContents($result["post"]["idPost"]);
            $result["status"] = true;
        }
    }

header('Content-Type: application/json');
echo json_encode($result);


?>
 