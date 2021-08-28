<?php
    session_start();
    if(!isset($_SESSION["nviame"])) header('Location: login.php');