<?php
    require_once("Config.php");

    require_once("PHPMailer/class.phpmailer.php");
    require_once("PHPMailer/class.smtp.php");
    
    function Send_Mail($email, $subject, $message) {    
        $mail = new PHPMailer();
        $mail->CharSet = 'UTF-8';
        $mail->isSMTP();
        $mail->Host = "vps-1773266-x.dattaweb.com";
        $mail->Port = 465;
        $mail->SMTPSecure = 'ssl';
        $mail->SMTPAuth = true;
        //$mail->SMTPDebug = 2;
        $mail->Username = "no-reply@nviame.com";
        $mail->Password = "WlzO2mbGOA";
        $mail->setFrom("no-reply@nviame.com", "Soporte de Nviame");
        if(is_array($email)) {
            foreach($email as $em) {
                $mail->addAddress($em);
            }
        }
        else {
            $mail->addAddress($email);
        }
        $mail->Subject = $subject;
        $mail->msgHTML($message);
        return $mail->send();
    }

    function Send_Push($title, $message, $regIdArr) {
        $data = array(
			'message' 	=> $message,
			'body' 	=> $message,
			'title'		=> $title,
			'vibrate'	=> 1,
			'sound' => "default",
            'style' => 'inbox',
            "actions" => array(
                array(
                  "title" => "OFERTAR",
                  "callback" => "shipment_offer",
                  "foreground" => true
                )
            )
		);
		$fields = array(
			'registration_ids' 	=> $regIdArr,
			'data'			=> $data,
			'notification'			=> $data
		);
		$headers = array(
			'Authorization: key=' . FCM_SERVER_KEY,
			'Content-Type: application/json'
		);
		$curlObj = curl_init();
		curl_setopt($curlObj, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
		curl_setopt($curlObj, CURLOPT_POST, true);
		curl_setopt($curlObj, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($curlObj, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curlObj, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curlObj, CURLOPT_POSTFIELDS, json_encode($fields));
		$result = curl_exec($curlObj);
		curl_close($curlObj);
		return $result;
    }
?>