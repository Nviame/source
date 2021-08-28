<?php
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);

    require_once '../api/include/DbHandler.php';
    require_once '../api/vendor/autoload.php';

    $dbHandler = new DbHandler();

    MercadoPago\SDK::setAccessToken(MP_ACCESS_TOKEN);

    $payment = MercadoPago\Payment::find_by_id("15053674543");

    $customerInfo = MercadoPago\Customer::find_by_id("165625716-23dULLfAaHJXyZ");

    print_r($customerInfo);
?>