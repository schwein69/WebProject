<?php
require_once 'bootstrap.php';
//per sql
$result["status"] = false;

//dati post nuovi
if(isset($_POST["stringList"])){
    $data = explode(",",$_POST["stringList"]);//split in java
    if($_POST["isTag"]){
        $rows = $dbh->getTaggedPostsWithArray( $_SESSION["idUtente"],$_POST["tagName"], $data);
        if (count($rows) > 0) {
            $result["post"] = $rows[0];
            $result["liked"] = $dbh->isPostLiked($_SESSION["idUtente"],$result["post"]["idPost"]);    
            $result["content"] = $dbh->getPostContents($result["post"]["idPost"]);
            $result["status"] = true;
        }
    } else {
        $rows = $dbh->getRandomPostsWithArray(1, $_SESSION["idUtente"], $data);
        if (count($rows) > 0) {
            $result["post"] = $rows[0];
            $result["liked"] = $dbh->isPostLiked($_SESSION["idUtente"],$result["post"]["idPost"]);    
            $result["content"] = $dbh->getPostContents($result["post"]["idPost"]);
            $result["status"] = true;
        }
    }
   
}

header('Content-Type: application/json');
echo json_encode($result);


?>
 