<?php
require_once 'bootstrap.php';
//per sql
$result["status"] = false;

//dati post nuovi
if(isset($_POST["stringList"])){
    $data = explode(",",$_POST["stringList"]);//split in java
    if($_POST["isTag"]){
        $rows = $dbh->getSearchTagPosts( $_POST["tagName"],$_SESSION["idUtente"], $_POST["start"],$_POST["end"]);
        if (count($rows) > 0) {
            $result["post"] = $rows[0];
            $result["followedByMe"] = $dbh->isFollowedByMe($result["post"]["idUtente"],$_SESSION["idUtente"]);
            $result["liked"] = $dbh->isPostLiked($_SESSION["idUtente"],$result["post"]["idPost"]);   
            $result["saved"] = $dbh->isPostSaved($_SESSION["idUtente"],$result["post"]["idPost"]);     
            $result["content"] = $dbh->getPostContents($result["post"]["idPost"]);
            $result["status"] = true;
        }
    } else {
        $rows = $dbh->getRandomPostsWithArray(1, $_SESSION["idUtente"], $data);
        if (count($rows) > 0) {
            $result["post"] = $rows[0];
            $result["followedByMe"] = $dbh->isFollowedByMe($result["post"]["idUtente"],$_SESSION["idUtente"]);
          //  var_dump($result["followedByMe"]);
            $result["liked"] = $dbh->isPostLiked($_SESSION["idUtente"],$result["post"]["idPost"]);  
            $result["saved"] = $dbh->isPostSaved($_SESSION["idUtente"],$result["post"]["idPost"]);      
            $result["content"] = $dbh->getPostContents($result["post"]["idPost"]);
            $result["status"] = true;
        }
    }
   
}

header('Content-Type: application/json');
echo json_encode($result);


?>
 