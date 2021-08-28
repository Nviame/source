<?php
    session_start();
    unset($_SESSION["nviame"]);
    header('Location: index.php');
    exit();
?>