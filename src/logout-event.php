<?php
require_once "bootstrap.php";
if(isset($_COOKIE["Lynkzone_keepLogin"])){
    setcookie("Lynkzone_keepLogin", "", time()-3600,'/');
    if($dbh->getUserFunctionHandler()->checkUserExist($_SESSION["idUtente"])){//se non è stato rimosso dal db
        $dbh->getUserFunctionHandler()->updateKeepLogin($_SESSION["idUtente"],null);
    }
}
session_destroy(); //destroy the session
header("Refresh: 1; url=login.php");
?>
<script>
    localStorage.clear();
</script>