<?php 
require_once 'bootstrap.php';

$rs = array();
$textValue=$_POST["textValue"];
$radioValue =$_POST["radioValue"];
if ($radioValue === "User") {
    $result = $dbh->getSearchUser($textValue, $_SESSION["idUtente"]);
    foreach ($result as $value) {
        array_push($rs, $value["username"]);
    }
}
if($radioValue === "Tag"){
    $result = $dbh->getTags($textValue);
    foreach ($result as $value) {
        array_push($rs, $value["nomeTag"]);
    }
}
header('Content-Type: application/json');
echo json_encode($rs);
?>