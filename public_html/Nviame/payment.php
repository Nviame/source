<?php
    //header('Location: ' . "http://127.0.0.1/" . $_SERVER["REQUEST_URI"]);

    require_once __DIR__ . '/api/include/DbHandler.php';
    require_once __DIR__ . '/api/vendor/autoload.php';

    $dbHandler = new DbHandler();

    MercadoPago\SDK::setAccessToken(MP_ACCESS_TOKEN);
    
    $currInfoPayment = $dbHandler->Shipments_Check_Payment($_REQUEST["s"]);

    if($currInfoPayment) {
        echo '<script>window.close();</script>';
        die();
    }

    if(isset($_REQUEST["success"]) || isset($_REQUEST["failure"]) || isset($_REQUEST["pending"])) {
        $response = $_REQUEST;
        $payment = MercadoPago\Payment::find_by_id($response["collection_id"]);
        if(isset($payment->id)) {
            $dbHandler->Shipments_Save_Payment(
                array(
                    "id_shipment" => $_REQUEST["s"],
                    "id_offer" => $_REQUEST["o"],
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
    $offerID = isset($_REQUEST["o"]) ? $_REQUEST["o"] : 0;
    
    $shipmentInfo = $dbHandler->Shipments_Get_Standard($shipmentID);

    if($shipmentInfo) {
        $offerInfo = array_filter($shipmentInfo["offers"], function($o) {
            return $o["id"] == $GLOBALS["offerID"];
        });
        $offerInfo = array_values($offerInfo);
        $offerInfo = empty($offerInfo) ? null : $offerInfo[0];
        $userInfo = $dbHandler->Users_MP_Auth(array(
            "user_id" => $offerInfo["user_id"]
        ));
    }
    else {
        $offerInfo = null;
        $userInfo = null;
    }

    if(!$shipmentInfo || !$offerInfo || !$userInfo) {
        die();
    }

    $customerInfo = null;
    $cardInfo = null;

    if(isset($_REQUEST["cu_id"])) {
        $customerId = $_REQUEST["cu_id"];
        $cardId = isset($_REQUEST["ca_id"]) ? $_REQUEST["ca_id"] : null;
        $customerInfo = MercadoPago\Customer::find_by_id($customerId);
        if($cardId) {
            foreach($customerInfo->cards as $c) {
                if($c->id == $cardId) {
                    $cardInfo = $c;
                }
            }
        }
        /*
        echo json_encode(array(
            "customer" => $customerInfo->id,
            "card" => $cardInfo->id
        ));
        die();
        */
    }
    else {
        $customerId = $userInfo["customer_id"];
        $customerInfo = MercadoPago\Customer::find_by_id($customerId);
        $card = null;
    }

    /*echo json_encode($userInfo);
    die();*/

    MercadoPago\SDK::setAccessToken(MP_ACCESS_TOKEN);
    
    $preference = new MercadoPago\Preference();

    $preference->notification_url = "https://nviame.com/api/mp/ipn";
    $preference->marketplace_fee = (20 * $offerInfo["offer"]) / 100;

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
    $item->title = 'Envío estándar';
    $item->description = "Envío desde $shipmentInfo[start_address] hasta $shipmentInfo[end_address]";
    $item->category_id = "others";
    $item->quantity = 1;
    $item->unit_price = $offerInfo["offer"];

    if($customerInfo) {
        $payer = new MercadoPago\Payer();
        //$payer->name = $customerInfo->first_name;
        //$payer->surname = $customerInfo->last_name;
        $payer->email = $customerInfo->email;        
        //$payer->phone = $customerInfo->phone;
        //$payer->identification = $customerInfo->identification;
        //$payer->address = $customerInfo->address;
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
    
    header('Location: ' . $preference->init_point);
?>