<?php
    require_once __DIR__ . '/api/include/DbHandler.php';
    require_once __DIR__ . '/api/vendor/autoload.php';

    $dbHandler = new DbHandler();

    MercadoPago\SDK::setAccessToken(MP_ACCESS_TOKEN);

    $shipmentID = $_REQUEST["s"];

    $currInfoPayment = $dbHandler->Shipments_Check_Payment($shipmentID);

    print_r($currInfoPayment); die();

    $payment = MercadoPago\Payment::find_by_id($currInfoPayment["collection_id"]);

    if($currInfoPayment["collection_status"] == "approved") {
        if(isset($payment->id)) {
            if($payment->status === "approved") {
                $refunds = $payment->refund();
            }
            else {
                //print_r($payment);
            }
            $currInfoPayment = $dbHandler->Shipments_Refund_Payment($shipmentID);
        }
    }
    else if($currInfoPayment["collection_status"] == "refunded_pending") {
        if(isset($payment->status) && $payment->status == "refunded") {
            $currInfoPayment = $dbHandler->Shipments_Refund_Payment($shipmentID, true);
        }
    }
    
    if(isset($payment->id)) {
        $dbHandler->Shipments_Update_Payment($payment->id, 
            array(
                "collection_status" => $payment->status,
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
        echo json_encode(array(
            "status" => "OK",
            "data" => array(
                "id" => $payment->id,
                "status" => $payment->status,
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
        ));
    }
    else {
        echo json_encode(array(
            "status" => "ERROR",
            "message" => "Hubo un problema al realizar la cancelación."
        ));
    }
?>