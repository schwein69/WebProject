<?php
function redirectNotLoggedUser(){
    if(!isset($_SESSION["idUtente"])){
        header("Location: login.php");
    }
}

function isVideoExtension($extension){
    return $extension == "mp4";
}

function isPostNotification($notType){
    return $notType != "Follow";
}

function isImageExtension($extension){
    $imageExtensions = array("jpg", "jpeg", "png", "gif");
    return in_array($extension, $imageExtensions);
}
function registerLoggedUser($user){
    $_SESSION["idUtente"] = $user["idUtente"];
    $_SESSION["username"] = $user["username"];
    $_SESSION["theme"] = $user["tema"];
}

function isUserLoggedIn(){
    return !empty($_SESSION['idUtente']);
}

function setMediaType(&$medias) {
    $numMedias = count($medias);
    for ($i=0; $i < $numMedias; $i++) { 
        $medias[$i]["isImage"] = isImageExtension($medias[$i]['formato']);
    }
}

function uploadFile($path, $image, $imgName=""){
    $baseName = basename($image["name"]);
    $msg = "";
     //Controllo estensione del file
     $fileType = strtolower(pathinfo($baseName,PATHINFO_EXTENSION));
     if(!isVideoExtension($fileType) && !isImageExtension($fileType)){
         $msg .= "Formato file non valido";
     }
     
    $imageName = $imgName != "" ? $imgName.".".$fileType : $baseName;// ... salva la vita
    $fullPath = $path.$imageName;
    
    $maxKB = 4096;
    $result = 0;
   
    //Controllo se immagine è veramente un'immagine
    $imageSize = getimagesize($image["tmp_name"]);
    if(isImageExtension($fileType) && $imageSize === false) {
        $msg .= "File caricato non è un'immagine! ";
    }
    //Controllo dimensione dell'immagine < 500KB
    if ($image["size"] > $maxKB * 1024) {
        $msg .= "File caricato pesa troppo! Dimensione massima è $maxKB KB. ";
    }
    
    //Controllo se esiste file con stesso nome ed eventualmente lo rinomino
    if (file_exists($fullPath) && $imgName == "") {
        $i = 1;
        do{
            $i++;
            $imageName = pathinfo(basename($image["name"]), PATHINFO_FILENAME)."_$i.".$fileType;
        }
        while(file_exists($path.$imageName));
        $fullPath = $path.$imageName;
    } else {
        unlink($fullPath);
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