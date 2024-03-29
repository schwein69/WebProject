<?php
function redirectNotLoggedUser()
{
    if (!isset($_SESSION["idUtente"])) {
        header("Location: login.php");
    }
}

function isVideoExtension($extension)
{
    return $extension == "mp4";
}

function isPostNotification($notType)
{
    return $notType != "Follow";
}

function isImageExtension($extension)
{
    $imageExtensions = array("jpg", "jpeg", "png", "gif");
    return in_array($extension, $imageExtensions);
}

function registerLoggedUser($user)
{
    $_SESSION["idUtente"] = $user["idUtente"];
    $_SESSION["username"] = $user["username"];
    $_SESSION["theme"] = $user["tema"];
    $_SESSION["lang"] = $user["lang"];
}

function isUserLoggedIn()
{
    return !empty($_SESSION['idUtente']);
}

function areThereDangerousChars($text)
{
    $dangChars = array('>', '<', ';', ',', ':', '\\', '/');
    foreach ($dangChars as $char) {
        if (strpos($text, $char) !== false) {
            return true;
        }
    }
    return false;
}

function createRandomCode($length)
{
    $firstPrintChar = 33;
    $lastChar = 255;
    $result = "";
    for ($i = 0; $i < $length; $i++) {
        $result .= chr(rand($firstPrintChar, $lastChar));
    }
    $result = mb_convert_encoding($result, 'UTF-8');
    return $result;
}

function setMediaType(&$medias)
{
    $numMedias = count($medias);
    for ($i = 0; $i < $numMedias; $i++) {
        $medias[$i]["isImage"] = isImageExtension($medias[$i]['formato']);
    }
}

function getProfilePicAlt($username)
{
    global $lang;
    return $_SESSION["lang"] == "en" ? 
        $username . $lang["ppalt"]
        : $lang["ppalt"] . $username;
}

function uploadFile($path, $image, $imgName = "")
{
    $baseName = basename($image["name"]);
    $msg = "";
    //Controllo estensione del file
    $fileType = strtolower(pathinfo($baseName, PATHINFO_EXTENSION));
    if (!isVideoExtension($fileType) && !isImageExtension($fileType)) {
        $msg .= "Invalid file extension";
    }

    $imageName = $imgName != "" ? $imgName . "." . $fileType : $baseName; // ... salva la vita
    $fullPath = $path . $imageName;

    $maxKB = 4096;
    $result = 0;

    //Controllo se immagine è veramente un'immagine
    $imageSize = getimagesize($image["tmp_name"]);
    if (isImageExtension($fileType) && $imageSize === false) {
        $msg .= "Uploaded file was not an image";
    }
    //Controllo dimensione dell'immagine < 500KB
    if ($image["size"] > $maxKB * 1024) {
        $msg .= "File too large! Max size is $maxKB KB. ";
    }

    //Controllo se esiste file con stesso nome ed eventualmente lo rinomino
    if (file_exists($fullPath) && $imgName == "") {
        $i = 1;
        do {
            $i++;
            $imageName = pathinfo(basename($image["name"]), PATHINFO_FILENAME) . "_$i." . $fileType;
        }
        while (file_exists($path . $imageName));
        $fullPath = $path . $imageName;
    }

    //Se non ci sono errori, sposto il file dalla posizione temporanea alla cartella di destinazione
    if (strlen($msg) == 0) {
        if (!move_uploaded_file($image["tmp_name"], $fullPath)) {
            $msg .= "Image upload error: " . $image["error"];
        } else {
            $msg = $imageName;
            $result = 1;
        }
    }
    return array($result, $fileType, $msg);
}

function rrmdir($dir)
{
    if (is_dir($dir)) {
        $objects = scandir($dir);
        foreach ($objects as $object) {
            if ($object != "." && $object != "..") {
                if (filetype($dir . "/" . $object) == "dir")
                    rrmdir($dir . "/" . $object);
                else
                    unlink($dir . "/" . $object);
            }
        }
        reset($objects);
        rmdir($dir);
    }
}
?>