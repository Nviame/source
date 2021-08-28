<?php
    /*ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);*/

    if(isset($_REQUEST["localhost"])) {
        header('Location: ' . "http://127.0.0.1/Nviame" . $_SERVER["REQUEST_URI"]);
    }
    
    require_once __DIR__ . '/api/include/DbHandler.php';
    require_once __DIR__ . '/api/vendor/autoload.php';

    $dbHandler = new DbHandler();

    MercadoPago\SDK::setAccessToken(MP_ACCESS_TOKEN);
    
    $currInfoPayment = $dbHandler->Shipments_Check_Payment_Extra($_REQUEST["s"]);

    if($currInfoPayment) {
        echo '<script>window.close();</script>';
        die();
    }

    if(isset($_REQUEST["success"]) || isset($_REQUEST["failure"]) || isset($_REQUEST["pending"])) {
        $response = $_REQUEST;
        $payment = MercadoPago\Payment::find_by_id($response["collection_id"]);
        if(isset($payment->id)) {
            $dbHandler->Shipments_Save_Payment_Extra(
                array(
                    "id_shipment" => $_REQUEST["s"],
                    "collection_id" => $_REQUEST["collection_id"],
                    "collection_status" => $_REQUEST["collection_status"],
                    "merchant_order_id" => $_REQUEST["merchant_order_id"],
                    "preference_id" => $_REQUEST["preference_id"],
                    "payment_type_id" => $payment->payment_type_id,
                    "payment_method_id" => $payment->payment_method_id,
                    "transaction_details" => json_decode(json_encode($payment->transaction_details), true),
                    "fee_details" => json_decode(json_encode($payment->fee_details), true),
                    "card" => array(
                        "type_id" => $payment->payment_type_id,
                        "method_id" => $payment->payment_method_id,
                        "expiration_month" => $payment->card->expiration_month,
                        "expiration_year" => $payment->card->expiration_year,
                        "first_six_digits" => $payment->card->first_six_digits,
                        "last_four_digits" => $payment->card->last_four_digits,
                        "cardholder" => json_decode(json_encode($payment->card->cardholder), true),
                        "date_created" => $payment->card->date_created,
                        "date_last_updated" => $payment->card->date_last_updated
                    )
                )
            );
        }
        echo '<script>window.close();</script>';
        die();
    }

    $pageRedirect = "http://nviame.com" . $_SERVER["REQUEST_URI"];

    $shipmentID = isset($_REQUEST["s"]) ? $_REQUEST["s"] : 0;
    
    $shipmentInfo = $dbHandler->Shipments_Get_Standard($shipmentID);

    if(!$shipmentInfo) {
        die();
    }

    $customerInfo = null;

    $customerId = isset($_REQUEST["cu_id"]) ? $_REQUEST["cu_id"] : null;

    if($customerId) {
        $customerInfo = MercadoPago\Customer::find_by_id($customerId);
        
        $preference = new MercadoPago\Preference();

        $preference->notification_url = "https://nviame.com/api/mp/ipn_pe";
        //$preference->marketplace_fee = 0;

        $preference->back_urls = array(
            "success" => "$pageRedirect&success",
            "failure" => "$pageRedirect&failure",
            "pending" => "$pageRedirect&pending"
        );

        $preference->payment_methods = array(
            /*"excluded_payment_types" => array(
            array("id" => "ticket"),
            array("id" => "debit_card"),
            array("id" => "atm")
            ),*/
            "installments" => 1
        );

        $preference->auto_return = "all";
        
        $item = new MercadoPago\Item();
        $item->title = 'Pago por gasto extra';
        $item->description = "Pago por gasto extra del envío desde $shipmentInfo[start_address] hasta $shipmentInfo[end_address]";
        $item->category_id = "others";
        $item->quantity = 1;
        $item->unit_price = floatval($shipmentInfo["operations_history"]["return_dispatch_expenses"]["valor"]);

        if($customerInfo) {
            $payer = new MercadoPago\Payer();
            $payer->name = $customerInfo->first_name;
            $payer->surname = $customerInfo->last_name;
            $payer->email = $customerInfo->email;        
            $payer->phone = $customerInfo->phone;
            $payer->identification = $customerInfo->identification;
            $payer->address = $customerInfo->address;
            $preference->payer = $payer;
        }

        $preference->items = array($item);

        if ($preference->save()) { 
            echo $preference->status; 
        } else {
            echo $preference->error; // You can get just a brief error description 
            // or explore each cause
            foreach($preference->error->causes as $cause) {
                // You may show a custom error message according to our cause error codes.
                echo $cause->code . ' ' . $cause->description; 
            }
        }

        //print_r($preference); die();
        
        header('Location: ' . $preference->init_point);
    }
?>