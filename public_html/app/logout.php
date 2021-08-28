<?php
    if(!isset($_SESSION)) session_start();
    unset($_SESSION["nvapp"]);
    header('Location: login');