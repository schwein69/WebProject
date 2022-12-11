<?php
function redirectNotLoggedUser(){
    if(!isset($_SESSION["idUtente"])){
        header("Location: login.php");
    }
}

function isVideoExtension($extension){
    return $extension == "mp4";
}
function isImageExtension($extension){
    $imageExtensions = array("jpg", "jpeg", "png", "gif");
    return in_array($extension, $imageExtensions);
}
function registerLoggedUser($user){
    $_SESSION["idUtente"] = $user["idUtente"];
    $_SESSION["username"] = $user["username"];
}

function isUserLoggedIn(){
    return !empty($_SESSION['idUtente']);
}

function uploadFile($path, $image){
    $imageName = basename($image["name"]);
    $fullPath = $path.$imageName;
    
    $maxKB = 500;
    $result = 0;
    $msg = "";
    //Controllo se immagine è veramente un'immagine
    $imageSize = getimagesize($image["tmp_name"]);
    if($imageSize === false) {
        $msg .= "File caricato non è un'immagine! ";
    }
    //Controllo dimensione dell'immagine < 500KB
    if ($image["size"] > $maxKB * 1024) {
        $msg .= "File caricato pesa troppo! Dimensione massima è $maxKB KB. ";
    }
    
    //Controllo estensione del file
    $fileType = strtolower(pathinfo($fullPath,PATHINFO_EXTENSION));
    if(!isVideoExtension($fileType) && !isImageExtension($fileType)){
        $msg .= "Formato file non valido";
    }
    
    //Controllo se esiste file con stesso nome ed eventualmente lo rinomino
    if (file_exists($fullPath)) {
        $i = 1;
        do{
            $i++;
            $imageName = pathinfo(basename($image["name"]), PATHINFO_FILENAME)."_$i.".$imageFileType;
        }
        while(file_exists($path.$imageName));
        $fullPath = $path.$imageName;
    }
  
    //Se non ci sono errori, sposto il file dalla posizione temporanea alla cartella di destinazione
    if(strlen($msg)==0){
        if(!move_uploaded_file($image["tmp_name"], $fullPath)){
            $msg.= "Errore nel caricamento dell'immagine: ".$image["error"];
        }
        else{
            $msg=$imageName;
            $result = 1;
        }
    }
    return array($result, $fileType, $msg);
}
?>