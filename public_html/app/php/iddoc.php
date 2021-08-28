<?php
    require_once('../validasesion.php');
    $loggedInfo = $_SESSION["nvapp"];
    if($_FILES["doc"]["error"] === UPLOAD_ERR_OK) {
        $fileInfo = pathinfo($_FILES["doc"]["name"]);
        $logoFileName = "logo$loggedInfo[Id].$fileInfo[extension]";
        if(move_uploaded_file($_FILES["doc"]["tmp_name"], "../uploads/tmp/$logoFileName")) {
            echo base64_encode($logoFileName);
        }
        else {
            echo "ERROR";
        }
    }
    else {
        echo "ERROR";
    }