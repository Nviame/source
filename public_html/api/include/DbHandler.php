<?php
    /*ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);*/

    if(!defined('APP_ID')) {
        define('APP_ID', 'nviame');
    }
    if(!defined('APP_NAME')) {
        define('APP_NAME', 'Nviame');
    }
    if(!defined('HOST')) {
        define('HOST', 'https://nviame.com');
    }
    if(!defined('SOCKET_PORT')) {
        define('SOCKET_PORT', '3355');
    }

    require_once 'Config.php';
    require_once 'Password.php';

    function base64_to_img($dataImg, $fileDestination) {
        $dataImg = substr($dataImg, strpos($dataImg, ',') + 1);
        $dataImg = base64_decode($dataImg);
        if ($dataImg === false) {
            throw new \Exception('base64_decode failed');
        }
        return file_put_contents($fileDestination, $dataImg);
    }

    class DbHandler {
        private $conn;
        function __construct() {
            require_once dirname(__FILE__) . '/DbConnect.php';
            $db = new DbConnect();
            $this->conn = $db->connect();
        }

        function getConn() {
            return $this->conn;
        }

        function _Send_Data_NJS($info) {
            if(file_exists(getcwd() . '/api/vendor/autoload.php')) {
                require_once getcwd() . '/api/vendor/autoload.php';
                require_once getcwd() . '/api/vendor/predis/predis/autoload.php';
            }
            else {
                require_once getcwd() . '/vendor/autoload.php';
                require_once getcwd() . '/vendor/predis/predis/autoload.php';
            }
            Predis\Autoloader::register();
            $client = new Predis\Client('tcp://127.0.0.1:6379');
            $client->publish(APP_ID, json_encode($info));
        }

        function fDay($str) {
            $d = gmdate("D", strtotime($str));
            return ($d == "Sun" || $d == "Sat") ? 1 : 0;
        }

        function Notifications_Get_List($userId) {
            //return $this->conn->getAll("SELECT * FROM notifications WHERE id_user = ? ORDER BY `datetime` DESC", array(
            return $this->conn->getAll("SELECT n.* FROM notifications AS n LEFT JOIN notifications_deleted AS nd ON (n.id = nd.id_notification AND nd.id_user = n.id_user) WHERE n.id_user = ? AND nd.id IS NULL ORDER BY n.datetime DESC", array(
                $userId
            )) ?: array();
        }

        function Notifications_Delete($params) {
            $this->conn->query("INSERT INTO notifications_deleted(id_user, id_notification, deleted_at) VALUES (?, ?, ?)", array(
                $params["id_user"],
                $params["id"],
                gmdate("Y-m-d H:i:s")
            ));
            return $this->conn->getInsertID() > 0;
        }

        function Users_Update_Timezone($userId, $tz) {
            $this->conn->query("UPDATE users SET timezone = ? WHERE id = ?", array(
                $tz,
                $userId
            ));
            return true;
        }

        function Users_Get_Settings($userId) {
            return $this->conn->getRow("SELECT * FROM users_settings WHERE `user_id` = ?", array(
                $userId
            )) ?: null;
        }

        function Users_Check_Completed_Profile($userInfo) {
            return !empty($userInfo["fullname"]) && !empty($userInfo["home_address"]) && !empty($userInfo["providence"]) && !empty($userInfo["locality"]) && !empty($userInfo["postal_code"]) && !empty($userInfo["country"]) && !empty($userInfo["dni"]) && !empty($userInfo["dni_front"]) && !empty($userInfo["dni_back"]) && !empty($userInfo["avatar"]);
        }
        
        function Users_Get_Info($k, $field) {
            $userInfo = $this->conn->getRow("
                SELECT *, IFNULL(fullname, SUBSTRING_INDEX(email, '@', 1)) AS display_name FROM users WHERE $field = ?
            ", array($k)) ?: null;
            if($userInfo) {
                $userInfo["profile_completed"] = $this->Users_Check_Completed_Profile($userInfo);
                $userInfo["settings"] = $this->Users_Get_Settings($userInfo["id"]);
                $userInfo["cards_history"] = $this->conn->getAll("
                    SELECT
                        p.card_type_id,
                        p.card_method_id,
                        p.card_expiration_month,
                        p.card_expiration_year,
                        p.card_cardholder_identification_type,
                        p.card_cardholder_identification_number,
                        p.card_cardholder_name,
                        p.card_date_created,
                        p.card_date_last_updated 
                    FROM
                        shipments_payments AS p
                        INNER JOIN shipments AS s ON p.id_shipment = s.id
                        INNER JOIN shipments_offers AS o ON s.id = o.id_shipment
                        INNER JOIN users AS u ON o.id_user = u.id 
                    WHERE
                        u.id = ? 
                    ORDER BY
                        p.registered_at DESC
                ", array(
                    $userInfo["id"]
                )) ?: array();
                $userInfo["mp"] = $this->conn->getRow("
                    SELECT
                        users_mp.*,
                        users.email AS info_email,
                        users.first_name AS info_first_name,
                        users.last_name AS info_last_name,
                        users.phone AS info_phone,
                        users.dni AS info_dni,
                        users.commission AS info_commission,
                        companies.percent_commission AS info_commission_company,
                        users.postal_code AS info_postal_code,
                        users.home_address AS info_home_address 
                    FROM
                        users
                        LEFT JOIN companies ON users.id_company = companies.id
                        LEFT JOIN users_mp ON users.id = users_mp.id_user 
                    WHERE
                        users.id = ?
                ", array(
                    $userInfo["id"]
                )) ?: null;
                $userInfo["company"] = $this->conn->getRow("
                    SELECT
                        *
                    FROM
                        companies
                    WHERE
                        id = ?
                ", array(
                    $userInfo["id_company"]
                )) ?: null;
                if($userInfo["company"]) {
                    $userInfo["settings"]["rate_base_price_enabled"] = 1;
                    $userInfo["settings"]["rate_base_price"] = $userInfo["company"]["rate_price_km"];
                    $userInfo["settings"]["rate_price_km_enabled"] = 1;
                    $userInfo["settings"]["rate_price_km"] = $userInfo["company"]["rate_price_km"];
                    $userInfo["settings"]["rate_percent_night_schedule_enabled"] = 1;
                    $userInfo["settings"]["rate_percent_night_schedule"] = $userInfo["company"]["rate_percent_night_schedule"];
                    $userInfo["settings"]["rate_percent_non_business_day_enabled"] = 1;
                    $userInfo["settings"]["rate_percent_non_business_day"] = $userInfo["company"]["rate_percent_non_business_day"];
                }
                $userInfo["mp_info"] = array();
                $userInfo["traveling_data"] = $userInfo["traveling"] ? ($this->conn->getAll("
                    SELECT
                        s.id
                    FROM
                        shipments AS s
                    INNER JOIN 
                        shipments_offers AS o ON s.id = o.id_shipment 
                    WHERE
                        o.id_user = ? AND o.accepted_at IS NOT NULL AND s.id_status = 4
                    ORDER BY
                        s.id DESC
                ", array(
                    $userInfo["id"]
                )) ?: array()) : null;
            }
            return $userInfo;
        }

        function Users_Social_Login($params) {
            $idUser = $params["provider"] == "apple" ? $params["info"]["user"] : $params["info"]["id"];
            $mail = $this->conn->getOne("SELECT email FROM users_social_connect WHERE `provider` = ? AND `uid` = ?", array(
                $params["provider"],
                $idUser
            ));
            if($mail !== false) { // Exist
                return $this->Users_Get_Info($mail, "email");
            }
            else {
                $mail = $params["info"]["email"];
                $this->conn->query("INSERT INTO users_social_connect(`uid`, `provider`, email, `authentication`, info) VALUES (?, ?, ?, ?, ?)", array(
                    $idUser,
                    $params["provider"],
                    $mail,
                    isset($params["login"]) ? json_encode($params["login"]) : null,
                    json_encode($params["info"])
                ));

                $curU = $this->Users_Get_Info($mail, "email");

                if(is_array($curU)) {
                    return $curU;
                }
                else {
                    $newData = $this->User_Register(array(
                        "email" => $mail,
                        "password" => createPassword($idUser)
                    ));
                    return is_array($newData) ? $newData : null;
                }
            }
            return null;
        }
        
        function Users_Get_Profile_Info($k, $field) {
            $userInfo = $this->conn->getRow("
                SELECT id, fullname, IFNULL(avatar, 'default.png') AS avatar, dni_back, dni_front, overall_rating, email, verified FROM users WHERE $field = ?
            ", array($k)) ?: null;
            if($userInfo) {
                $userInfo["deliveries_count"] = intval($this->conn->getOne("
                    SELECT
                        COUNT(*) 
                    FROM
                        users AS u
                    INNER JOIN 
                        shipments_offers AS o ON u.id = o.id_user 
                    INNER JOIN shipments AS s ON o.id_shipment = s.id
                    WHERE 
                        u.id = $userInfo[id] AND o.accepted_at IS NOT NULL AND s.id_status = 5
                "));
                $userInfo["returns_count"] = intval($this->conn->getOne("
                    SELECT
                        COUNT(*) 
                    FROM
                        users AS u
                    INNER JOIN 
                        shipments_offers AS o ON u.id = o.id_user 
                    INNER JOIN shipments AS s ON o.id_shipment = s.id
                    WHERE 
                        u.id = $userInfo[id] AND o.accepted_at IS NOT NULL AND s.id_status = 7
                "));
                $userInfo["shipping_count"] = intval($this->conn->getOne("
                    SELECT
                        COUNT(*) 
                    FROM
                        users AS u 
                    INNER JOIN shipments AS s ON u.id = s.id_user
                    WHERE 
                        u.id = $userInfo[id]
                "));
                $userInfo["age"] = "{N}";
            }
            return $userInfo;
        }

        function Users_Update_Info($info) {
            if(isset($info["__adm"])) {
                $this->conn->query("UPDATE users SET fullname = ?, dni = ?, phone = ? WHERE id = ?", array(
                    $info["name"],
                    $info["dni"],
                    $info["phone"],
                    $info["id"]
                ));
                if($info["password"]) {
                    $this->conn->query("UPDATE users SET `password` = ? WHERE id = ?", array(
                        createPassword($info["password"]),
                        $info["id"]
                    ));
                }
                if(isset($info["commission"])) {
                    $this->conn->query("UPDATE users SET commission = ? WHERE id = ?", array(
                        $info["commission"],
                        $info["id"]
                    ));
                }
            }
            else {
                $this->conn->query("UPDATE users SET fullname = ?, country_code = ?, country = ?, dni = ?, home_address = ?, locality_code = ?, locality = ?, phone = ?, postal_code = ?, providence_code = ?, providence = ? WHERE id = ?", array(
                    $info["fullname"],
                    $info["country_code"],
                    $info["country"],
                    $info["dni"],
                    $info["home_address"],
                    $info["locality_code"],
                    $info["locality"],
                    $info["phone"],
                    $info["postal_code"],
                    $info["providence_code"],
                    $info["providence"],
                    $info["id"]
                ));
            }
            if(isset($_FILES["picture_1"])) {
                //$ext = pathinfo($_FILES["picture_1"]["name"], PATHINFO_EXTENSION);
                $ext = @explode("/", $_FILES["picture_1"]["type"])[1];
                $pic = "$info[id].$ext";
                if(move_uploaded_file($_FILES["picture_1"]["tmp_name"], "uploads/users/$pic")) {
                    $this->conn->query("
                        UPDATE users SET avatar = ? WHERE id = ?
                    ", array(
                        $pic,
                        $info["id"]
                    ));
                }
            }
            else if(isset($_REQUEST["delete_picture_1"])) {
                @unlink("uploads/users/" . $this->conn->getOne("SELECT avatar FROM users WHERE id = ?", array(
                    $info["id"]
                )) ?: "$info[id].png");
                $this->conn->query("
                    UPDATE users SET avatar = NULL WHERE id = ?
                ", array(
                    $info["id"]
                ));
            }
            if(isset($_FILES["picture_2"])) {
                //$ext = pathinfo($_FILES["picture_2"]["name"], PATHINFO_EXTENSION);
                $ext = @explode("/", $_FILES["picture_2"]["type"])[1];
                $pic = $info["id"] . "_dni_front" . ".$ext";
                if(move_uploaded_file($_FILES["picture_2"]["tmp_name"], "uploads/users/$pic")) {
                    $this->conn->query("
                        UPDATE users SET dni_front = ? WHERE id = ?
                    ", array(
                        $pic,
                        $info["id"]
                    ));
                }
            }
            else if(isset($_REQUEST["delete_picture_2"])) {
                @unlink("uploads/users/" . $this->conn->getOne("SELECT dni_front FROM users WHERE id = ?", array(
                    $info["id"]
                )) ?: "$info[id]_dni_front.png");
                $this->conn->query("
                    UPDATE users SET dni_front = NULL WHERE id = ?
                ", array(
                    $info["id"]
                ));
            }
            if(isset($_FILES["picture_3"])) {
                //$ext = pathinfo($_FILES["picture_3"]["name"], PATHINFO_EXTENSION);
                $ext = @explode("/", $_FILES["picture_3"]["type"])[1];
                $pic = $info["id"] . "_dni_back" . ".$ext";
                if(move_uploaded_file($_FILES["picture_3"]["tmp_name"], "uploads/users/$pic")) {
                    $this->conn->query("
                        UPDATE users SET dni_back = ? WHERE id = ?
                    ", array(
                        $pic,
                        $info["id"]
                    ));
                }
            }
            else if(isset($_REQUEST["delete_picture_3"])) {
                @unlink("uploads/users/" . $this->conn->getOne("SELECT dni_back FROM users WHERE id = ?", array(
                    $info["id"]
                )) ?: "$info[id]_dni_back.png");
                $this->conn->query("
                    UPDATE users SET dni_back = NULL WHERE id = ?
                ", array(
                    $info["id"]
                ));
            }
            return $this->Users_Get_Info($info["id"], "id");
        }

        function Users_Get_Favorites($idUser) {
            return $this->conn->getAll("
                SELECT * FROM users_favorites WHERE id_user = ?
            ", array(
                $idUser
            )) ?: array();
        }

        function Users_Set_Favorite($info) {
            $idFav = $this->conn->getOne("SELECT id FROM users_favorites WHERE id_user = ? AND id_favorite = ?", array(
                $info["id"],
                $info["user"]
            ));
            if($idFav) {
                $this->conn->query("UPDATE users_favorites SET favorite = ? WHERE id_user = ? AND id_favorite = ?", array(
                    $info["favorite"],
                    $info["id"],
                    $info["user"]
                ));
            }
            else {
                $this->conn->query("INSERT INTO users_favorites (id_user, id_favorite, favorite) VALUES (?, ?, ?)", array(
                    $info["id"],
                    $info["user"],
                    $info["favorite"]
                ));
            }
            return $this->Users_Get_Favorites($info["id"]);
        }

        function User_Register($info) {
            if($this->Users_Get_Info($info["email"], "email")) {
                return "La dirección de correo electrónico proporcionada no está disponible.";
            }
            $this->conn->query("INSERT INTO users (fullname, email, `password`) VALUES (?, ?, ?)", array(
                explode("@", $info["email"])[0],
                $info["email"],
                createPassword($info["password"])
            ));
            $lastId = $this->conn->getInsertID();
            if($lastId > 0) {
                if(isset($info["company"])) { // desde ADMIN
                    $this->conn->query("UPDATE users SET id_company = ?, fullname = ?, dni = ?, phone = ? WHERE id = ?", array(
                        $info["company"] > 0 ? $info["company"] : null,
                        $info["name"],
                        $info["dni"],
                        $info["phone"],
                        $lastId
                    ));
                }
                $this->conn->query("INSERT INTO users_settings (`user_id`, push_new_shipments, push_offers, `online`) VALUES (?, 1, 1, 1)", array(
                    $lastId
                ));
                $this->conn->query("
                    INSERT INTO notifications ( 
                        id_user, 
                        id_shipment, 
                        id_offer, 
                        title, 
                        content, 
                        datetime, 
                        readed, 
                        group
                    )
                    VALUES (
                        ?, 
                        ?, 
                        ?, 
                        ?, 
                        ?, 
                        ?, 
                        ?, 
                        ?
                    )
                ", array(
                    $lastId,
                    null,
                    null,
                    'Perfil',
                    'Para hacer entregas, necesitamos que completes tus datos personales.',
                    gmdate("Y-m-d H:i:s"),
                    0,
                    'initial_notification'
                ));
                $this->conn->query("
                    INSERT INTO notifications ( 
                        id_user, 
                        id_shipment, 
                        id_offer, 
                        title, 
                        content, 
                        datetime, 
                        readed, 
                        group
                    )
                    VALUES (
                        ?, 
                        ?, 
                        ?, 
                        ?, 
                        ?, 
                        ?, 
                        ?, 
                        ?
                    )
                ", array(
                    $lastId,
                    null,
                    null,
                    'Billetera',
                    'Para recibir pagos, necesitamos que conectes tu cuenta de Mercado Pago.',
                    gmdate("Y-m-d H:i:s"),
                    0,
                    'initial_notification'
                ));
                $this->conn->query("
                    INSERT INTO notifications ( 
                        id_user, 
                        id_shipment, 
                        id_offer, 
                        title, 
                        content, 
                        datetime, 
                        readed, 
                        group
                    )
                    VALUES (
                        ?, 
                        ?, 
                        ?, 
                        ?, 
                        ?, 
                        ?, 
                        ?, 
                        ?
                    )
                ", array(
                    $lastId,
                    null,
                    null,
                    'Vehículos',
                    'Si vas a entregar con movilidad propia, necesitamos que cargues los datos en tu perfil.',
                    gmdate("Y-m-d H:i:s"),
                    0,
                    'initial_notification'
                ));
                if(isset($info["_push"]["registration_id"])) {
                    $this->Users_Update_Push_Reg_ID($info["email"], $info["_push"]["registration_id"], $info["_device"]);
                }
            }
            return $lastId > 0 ? $this->Users_Get_Info($lastId, "id") : "Hubo un problema al registrar la cuenta";
        }

        function User_Settings_Update($info) {
            $sql = "UPDATE users_settings SET ";
            $parts = array();
            foreach($info["fields"] as $r) {
                $parts[] = "$r[field] = '$r[value]'";
            }
            $sql .= implode(", ", $parts) . " WHERE user_id = $info[user_id]";
            $this->conn->query($sql);
            return $this->Users_Get_Settings($info["user_id"]);
        }

        function Users_MP_Auth($info, $withCustomerMP = false) {
            $band = false;
            $currentInfo = $this->conn->getRow("
                SELECT
                    users_mp.*,
                    users.email AS info_email,
                    users.first_name AS info_first_name,
                    users.last_name AS info_last_name,
                    users.phone AS info_phone,
                    users.dni AS info_dni,
                    users.commission AS info_commission,
                    companies.percent_commission AS info_commission_company,
                    users.postal_code AS info_postal_code,
                    users.home_address AS info_home_address 
                FROM
                    users
                    LEFT JOIN companies ON users.id_company = companies.id
                    LEFT JOIN users_mp ON users.id = users_mp.id_user 
                WHERE
                    users.id = ?
            ", array(
                $info["user_id"]
            ));
            if(!isset($info["code"])) {
                if($currentInfo) {
                    MercadoPago\SDK::setAccessToken(MP_ACCESS_TOKEN);
                    $filters = array(
                        "email" => $currentInfo["info_email"]
                    );
                    $customers = MercadoPago\Customer::search($filters);
                    if($customers->total > 0) {
                        $customer = null;
                        foreach($customers as $c) {
                            $customer = $c;
                            break;
                        }
                        $currentInfo["mp"] = array(
                            "address" => $customer->address,
                            "addresses" => $customer->addresses,
                            "cards" => $customer->cards,
                            "date_created" => $customer->date_created,
                            "date_last_updated" => $customer->date_last_updated,
                            "date_registered" => $customer->date_registered,
                            "default_address" => $customer->default_address,
                            "default_card" => $customer->default_card,
                            "description" => $customer->description,
                            "email" => $customer->email,
                            "first_name" => $customer->first_name,
                            "id" => $customer->id,
                            "identification" => $customer->identification,
                            "last_name" => $customer->last_name,
                            "live_mode" => $customer->live_mode,
                            "metadata" => $customer->metadata,
                            "phone" => $customer->phone
                        );
                        $this->conn->query("UPDATE users_mp SET customer_id = ? WHERE id_user = ?", array(
                            $customer->id,
                            $info["user_id"]
                        ));
                        return $currentInfo;
                    }
                    else {
                        $customer = new MercadoPago\Customer();
                        $customer->email = $currentInfo["info_email"];
                        if($currentInfo["info_first_name"]) {
                            $customer->first_name = $currentInfo["info_first_name"];
                        }
                        if($currentInfo["info_last_name"]) {
                            $customer->last_name = $currentInfo["info_last_name"];
                        }
                        if($currentInfo["info_phone"]) {
                            /*$customer->phone = array(
                                "area_code" => "",
                                "number" => ""
                            );*/
                        }
                        if($currentInfo["info_dni"]) {
                            /*$customer->identification = array(
                                "type" => "",
                                "number" => ""
                            );*/
                        }
                        if($currentInfo["info_home_address"]) {
                            $customer->default_address = $currentInfo["info_home_address"];
                        }
                        $customer->save();
                        /*
                        echo "CREATED!\n\n";
                        print_r($customer); die();
                        */
                        $currentInfo["mp"] = array(
                            "address" => $customer->address,
                            "addresses" => $customer->addresses,
                            "cards" => $customer->cards,
                            "date_created" => $customer->date_created,
                            "date_last_updated" => $customer->date_last_updated,
                            "date_registered" => $customer->date_registered,
                            "default_address" => $customer->default_address,
                            "default_card" => $customer->default_card,
                            "description" => $customer->description,
                            "email" => $customer->email,
                            "first_name" => $customer->first_name,
                            "id" => $customer->id,
                            "identification" => $customer->identification,
                            "last_name" => $customer->last_name,
                            "live_mode" => $customer->live_mode,
                            "metadata" => $customer->metadata,
                            "phone" => $customer->phone
                        );
                        $this->conn->query("UPDATE users_mp SET customer_id = ? WHERE id_user = ?", array(
                            $customer->id,
                            $info["user_id"]
                        ));
                        if($withCustomerMP) {
                            $currentInfo["MPC"] = $withCustomerMP;
                        }
                        return $currentInfo;
                    }
                }
                else {
                    return null;
                }
            }

            function f($conn, $idUser, $code, $cInfo) {
                MercadoPago\SDK::setAccessToken(MP_ACCESS_TOKEN);
                $oauth = new MercadoPago\OAuth();
                $oauth->client_secret = MP_ACCESS_TOKEN;
                $oauth->grant_type = 'authorization_code';
                $oauth->code = $code;
                $oauth->redirect_uri = HOST . "/api/ml/$idUser";
                $oauth->save();
                //var_dump($oauth); die();
                if($oauth->user_id) {
                    $data = array(
                        "access_token" => $oauth->access_token,
                        "public_key" => $oauth->public_key,
                        "live_mode" => $oauth->live_mode,
                        "user_id" => $oauth->user_id,
                        "token_type" => $oauth->token_type,
                        "expires_in" => $oauth->expires_in,
                        "scope" => $oauth->scope
                    );
                    if($cInfo && $cInfo["access_token"] != "") {
                        $conn->query("
                            UPDATE 
                                users_mp 
                            SET 
                                access_token = ?, 
                                public_key = ?, 
                                live_mode = ?, 
                                user_id = ?, 
                                token_type = ?, 
                                expires_in = ?, 
                                scope = ?, 
                                updated_at = ? 
                            WHERE 
                                id_user = ?
                            ", array(
                                $data["access_token"],
                                $data["public_key"],
                                $data["live_mode"] ? 1 : 0,
                                $data["user_id"],
                                $data["token_type"],
                                $data["expires_in"],
                                $data["scope"],
                                gmdate("Y-m-d H:i:s"),
                                $idUser
                            )
                        );
                        return true;
                    }
                    else {
                        $conn->query("
                            INSERT INTO users_mp (
                                id_user, 
                                code,
                                registered_at,
                                access_token, 
                                public_key, 
                                live_mode, 
                                user_id, 
                                token_type, 
                                expires_in, 
                                scope
                            ) VALUES (
                                ?, 
                                ?,
                                ?,
                                ?, 
                                ?, 
                                ?, 
                                ?, 
                                ?, 
                                ?, 
                                ?
                            )", array(
                                $idUser,
                                $code,
                                gmdate("Y-m-d H:i:s"),
                                $data["access_token"],
                                $data["public_key"],
                                $data["live_mode"] ? 1 : 0,
                                $data["user_id"],
                                $data["token_type"],
                                $data["expires_in"],
                                $data["scope"]
                            )
                        );
                        return $conn->getInsertID() > 0;
                    }
                }
                else {
                    return false;
                }
            }
            if($currentInfo) {
                if($currentInfo["user_id"] == null) {
                    return f($this->conn, $info["user_id"], $info["code"], $currentInfo);
                }
                else {
                    return true;
                }
                /*
                $this->conn->query("UPDATE users_mp SET code = ?, updated_at = ? WHERE id_user = ?", array(
                    $info["code"],
                    gmdate("Y-m-d H:i:s"),
                    $info["user_id"]
                ));
                $band = true;
                */
            }
            else {
                return f($this->conn, $info["user_id"], $info["code"], null);
                /*
                $this->conn->query("INSERT INTO users_mp (id_user, code, registered_at) VALUES (?, ?, ?)", array(
                    $info["user_id"],
                    $info["code"],
                    gmdate("Y-m-d H:i:s")
                ));
                $band = $this->conn->getInsertID() > 0;
                */
            }
        }

        function Users_MP_Add_Card($info) {
            MercadoPago\SDK::setAccessToken(MP_ACCESS_TOKEN);

            $userInfo = $this->Users_MP_Auth(array(
                "user_id" => $info["user_id"]
            ));

            if(!$userInfo || !$userInfo["mp"]) {
                return null;
            }

            $customer = MercadoPago\Customer::find_by_id($userInfo["mp"]["id"]);

            //print_r($customer); die();

            $card = new MercadoPago\Card();
            $card->token = $info["token"];
            $card->customer_id = $customer->id;
            //$card->issuer_id = 3;
            $card->save();
            
            if(isset($card->error)) {
                $err = $card->error->message . " (";
                foreach($card->error->causes as $c) {
                    $err .= $c->description;
                }
                $err .= ")";
                return "Hubo un problema al<br>registrar la tarjeta.<br><br>MercadoPago:<br>$err.";
            }
            else {
                $allCards = array();

                if(isset($card->id) && $card->id) {
                    $allCards[] = array(
                        "cardholder" => $card->cardholder,
                        "date_created" => $card->date_created,
                        "date_last_updated" => $card->date_last_updated,
                        "expiration_month" => $card->expiration_month,
                        "expiration_year" => $card->expiration_year,
                        "first_six_digits" => $card->first_six_digits,
                        "id" => $card->id,
                        "issuer" => $card->issuer,
                        "last_four_digits" => $card->last_four_digits,
                        "payment_method" => $card->payment_method,
                        "security_code" => $card->security_code,
                        "user_id" => $card->user_id
                    );
                }
    
                foreach($customer->cards as $c) {
                    $allCards[] = $c;
                }
                return $allCards;
            }
        }

        function Users_MP_Logout($userId) {
            MercadoPago\SDK::setAccessToken(MP_ACCESS_TOKEN);
            $filters = array(
                "email" => $this->conn->getOne("SELECT email FROM users WHERE id = ?", array(
                    $userId
                ))
            );
            $customers = MercadoPago\Customer::search($filters);
            if($customers->total > 0) {
                $customer = null;
                foreach($customers as $c) {
                    $customer = $c;
                    break;
                }
                if($customer) {
                    $customer->delete();
                }
            }
            $this->conn->query("DELETE FROM users_mp WHERE id_user = ?", array(
                $userId
            ));
            return true;
        }

        function Shipments_Check_Payment($shipmentId) {
            return $this->conn->getRow("SELECT * FROM shipments_payments WHERE id_shipment = ?", array(
                $shipmentId
            )) ?: null;
        }

        function Shipments_Check_Payment_Extra($shipmentId) {
            return $this->conn->getRow("SELECT * FROM shipments_payments_extra WHERE id_shipment = ?", array(
                $shipmentId
            )) ?: null;
        }

        function Shipments_Refund_Payment($shipmentId, $refunded = false) {
            $this->conn->query("UPDATE shipments_payments SET collection_status = ? WHERE id_shipment = ?", array(
                $refunded ? 'refunded' : 'refunded_pending',
                $shipmentId
            ));
            return $this->conn->getRow("SELECT * FROM shipments_payments WHERE id_shipment = ?", array(
                $shipmentId
            )) ?: null;
        }
        
        function Shipments_Save_Payment($info) {
            /*echo json_encode($info);
            die();*/

            $band = false;
            $sStatus = null;
            switch($info["collection_status"]) {
                case "approved":
                case "in_process":
                    $sStatus = 2;
                break;
            }
            $this->conn->query("UPDATE shipments SET id_status = ? WHERE id = ?", array(
                $sStatus,
                $info["id_shipment"]
            ));
            $dt = gmdate("Y-m-d H:i:s");
            $this->conn->query("
                INSERT INTO shipments_payments (
                    id_shipment,
                    preference_id,
                    collection_id,
                    collection_status,
                    merchant_order_id,
                    total_paid_amount,
                    net_received_amount,
                    registered_at,
                    fee_mp,
                    fee_nv,
                    card_type_id,
                    card_method_id,
                    card_expiration_month,
                    card_expiration_year,
                    card_cardholder_identification_type,
                    card_cardholder_identification_number,
                    card_cardholder_name,
                    card_date_created,
                    card_date_last_updated 
                )
                VALUES (
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ? 
                )
            ", array(
                $info["id_shipment"],
                $info["preference_id"],
                $info["collection_id"],
                $info["collection_status"],
                $info["merchant_order_id"],
                $info["transaction_details"]["total_paid_amount"],
                $info["transaction_details"]["net_received_amount"],
                $dt,
                isset($info["fee_details"][0]["amount"]) ? $info["fee_details"][0]["amount"] : null,
                isset($info["fee_details"][1]["amount"]) ? $info["fee_details"][1]["amount"] : null,
                $info["card"]["type_id"],
                $info["card"]["method_id"],
                $info["card"]["expiration_month"],
                $info["card"]["expiration_year"],
                $info["card"]["cardholder"]["identification"]["type"],
                $info["card"]["cardholder"]["identification"]["number"],
                $info["card"]["cardholder"]["name"],
                gmdate("Y-m-d H:i:s", strtotime($info["card"]["date_created"])),
                gmdate("Y-m-d H:i:s", strtotime($info["card"]["date_last_updated"]))
            ));
            $lastId = $this->conn->getInsertID();
            if($lastId > 0) {
                $infoOffer = $this->conn->getRow("SELECT * FROM shipments_offers WHERE id_shipment = ? AND accepted_at IS NOT NULL", array(
                    $info["id_shipment"]
                )) ?: null;
                $this->conn->query("
                    INSERT INTO shipments_operations_history (
                        id_shipment,
                        id_user,
                        uid,
                        datetime,
                        valor
                    ) VALUES (
                        ?,
                        ?,
                        ?,
                        ?,
                        ?
                    )
                ", array(
                    $infoOffer["id_shipment"],
                    $infoOffer["id_user"],
                    "payment",
                    $dt,
                    $info["transaction_details"]["total_paid_amount"]
                ));
                $this->_Send_Data_NJS(array(
                    'action' => 'shipment timeline updated',
                    'data' => array(
                        'id_shipment' => $infoOffer["id_shipment"],
                        'id_user' => $infoOffer["id_user"],
                        'uid' => "payment"
                    )
                ));
                $band = true;
            }
            return $band;
        }
        
        function Shipments_Save_Payment_Extra($info) {
            /*echo json_encode($info);
            die();*/
            $dt = gmdate("Y-m-d H:i:s");
            $this->conn->query("
                INSERT INTO shipments_payments_extra (
                    id_shipment,
                    preference_id,
                    collection_id,
                    collection_status,
                    merchant_order_id,
                    total_paid_amount,
                    net_received_amount,
                    registered_at,
                    fee_mp,
                    fee_nv,
                    card_type_id,
                    card_method_id,
                    card_expiration_month,
                    card_expiration_year,
                    card_cardholder_identification_type,
                    card_cardholder_identification_number,
                    card_cardholder_name,
                    card_date_created,
                    card_date_last_updated 
                )
                VALUES (
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ? 
                )
            ", array(
                $info["id_shipment"],
                $info["preference_id"],
                $info["collection_id"],
                $info["collection_status"],
                $info["merchant_order_id"],
                $info["transaction_details"]["total_paid_amount"],
                $info["transaction_details"]["net_received_amount"],
                $dt,
                isset($info["fee_details"][0]["amount"]) ? $info["fee_details"][0]["amount"] : null,
                isset($info["fee_details"][1]["amount"]) ? $info["fee_details"][1]["amount"] : null,
                $info["card"]["type_id"],
                $info["card"]["method_id"],
                $info["card"]["expiration_month"],
                $info["card"]["expiration_year"],
                $info["card"]["cardholder"]["identification"]["type"],
                $info["card"]["cardholder"]["identification"]["number"],
                $info["card"]["cardholder"]["name"],
                gmdate("Y-m-d H:i:s", strtotime($info["card"]["date_created"])),
                gmdate("Y-m-d H:i:s", strtotime($info["card"]["date_last_updated"]))
            ));
            $lastId = $this->conn->getInsertID();
            if($lastId > 0) {
                $infoOffer = $this->conn->getRow("SELECT * FROM shipments_offers WHERE id_shipment = ? AND accepted_at IS NOT NULL", array(
                    $info["id_shipment"]
                )) ?: null;
                $this->conn->query("
                    INSERT INTO shipments_operations_history (
                        id_shipment,
                        id_user,
                        uid,
                        datetime,
                        valor
                    ) VALUES (
                        ?,
                        ?,
                        ?,
                        ?,
                        ?
                    )
                ", array(
                    $infoOffer["id_shipment"],
                    $infoOffer["id_user"],
                    "return_dispatch_expenses_payment",
                    $dt,
                    $info["transaction_details"]["total_paid_amount"]
                ));
                $this->_Send_Data_NJS(array(
                    'action' => 'shipment timeline updated',
                    'data' => array(
                        'id_shipment' => $infoOffer["id_shipment"],
                        'id_user' => $infoOffer["id_user"],
                        'uid' => "return_dispatch_expenses_payment"
                    )
                ));
                $band = true;
            }
            return $band;
        }
        
        function Shipments_Update_Payment($collectionId, $info) {
            $currentInfo = $this->conn->getRow("SELECT p.*, s.id_user AS id_shipment_user FROM shipments_payments AS p INNER JOIN shipments AS s ON s.id = p.id_shipment WHERE p.collection_id = ?", array(
                $collectionId
            ));
            $this->conn->query("UPDATE shipments_payments SET collection_status = ?, net_received_amount = ?, fee_mp = ?, fee_nv = ? WHERE collection_id = ?", array(
                $info["collection_status"],
                $info["transaction_details"]["net_received_amount"],
                $info["fee_details"][0]["amount"],
                $info["fee_details"][1]["amount"],
                $collectionId
            ));
            $dt = gmdate("Y-m-d H:i:s");
            $infoOffer = $this->conn->getRow("SELECT * FROM shipments_offers WHERE id_shipment = ? AND accepted_at IS NOT NULL", array(
                $currentInfo["id_shipment"]
            )) ?: null;
            $this->conn->query("
                INSERT INTO shipments_operations_history (
                    id_shipment,
                    id_user,
                    uid,
                    datetime,
                    valor
                ) VALUES (
                    ?,
                    ?,
                    ?,
                    ?,
                    ?
                )
            ", array(
                $infoOffer["id_shipment"],
                $infoOffer["id_user"],
                "payment_status_changed",
                $dt,
                $info["collection_status"]
            ));
            $this->_Send_Data_NJS(array(
                'action' => 'shipment timeline updated',
                'data' => array(
                    'id_shipment' => $infoOffer["id_shipment"],
                    'id_user' => $infoOffer["id_user"],
                    'uid' => "payment_status_changed"
                )
            ));
            if($currentInfo["collection_status"] != $info["collection_status"]) {
                $title = null;
                $content = null;
                switch($info["collection_status"]) {
                    case 'approved':
                        $title = "Transacción aprobada";
                        $content = "El pago por $" . $currentInfo["total_paid_amount"] . " ha aprobado satisfactoriamente.";
                    break;
                    case 'refunded':
                        $title = "Transacción reembolsada";
                        $content = "El pago por $" . $currentInfo["total_paid_amount"] . " ha sido reembolsado satisfactoriamente.";
                    break;
                }
                if($title && $content) {
                    $this->_Send_Data_NJS(array(
                        'action' => 'push notification',
                        'data' => array(
                            'to' => array($infoOffer["id_user"], $currentInfo["id_shipment_user"]),
                            'title' => $title,
                            'content' => $content
                        )
                    ));
                    $this->_Send_Data_NJS(array(
                        'action' => 'push notification',
                        'data' => array(
                            'to' => $infoOffer["id_user"],
                            'title' => $title,
                            'content' => $content
                        )
                    ));
                }
            }
            return true;
        }

        function Shipments_Get_Standard_Additional_Info($info) {
            $info["pictures"] = $this->conn->getAll("SELECT id, `name` FROM shipments_pictures WHERE id_shipment = ?", array(
                $info["id"]
            )) ?: array();
            if($info["address_dist_2_dis_value"] > 0) {
                $info["address_dist_dis_value"] = intval($info["address_dist_1_dis_value"]) + intval($info["address_dist_2_dis_value"]);
                $info["address_dist_dis_desc"] = intval($info["address_dist_dis_value"] / 1000) . " km";
                
                $info["address_dist_dur_desc"] = intval($info["address_dist_1_dur_value"]) + intval($info["address_dist_2_dur_value"]);
                $info["address_dist_dur_value"] = $this->addressDurDesc($info["address_dist_dur_desc"]);
            }
            else {
                $info["address_dist_dis_desc"] = $info["address_dist_1_dis_desc"];
                $info["address_dist_dis_value"] = $info["address_dist_1_dis_value"];
                $info["address_dist_dur_desc"] = $info["address_dist_1_dur_desc"];
                $info["address_dist_dur_value"] = $info["address_dist_1_dur_value"];
            }
            if($info["max_arrival_date"]) {
                $time = gmdate("H:i:s", strtotime($info["max_arrival_date"]));
                $time2 = "20:00:00";
                $info["nightly"] = strtotime($time) >= strtotime($time2) ? 1 : 0;
                $info["f_day"] = $this->fDay($info["max_arrival_date"]);
            }
            else {
                $info["nightly"] = 0;
                $info["f_day"] = 0;
            }
            $info["offers"] = $this->conn->getAll("
                SELECT
                    o.id,
                    o.offer,
                    o.registered_at,
                    o.accepted_at,
                    o.estimated_arrival_date,
                    o.approximate_arrival_value,
                    o.approximate_arrival_desc,
                    o.approximate_distance_value,
                    o.approximate_distance_desc,
                    o.transport_id,
                    o.transport_type,
                    u.id AS user_id,
                    IFNULL(u.avatar, 'default.png') AS user_avatar,
                    IFNULL(u.fullname, SUBSTRING_INDEX(u.email, '@', 1)) AS user_fullname,
                    u.verified AS user_verified,
                    u.email AS user_email,
                    u.overall_rating AS user_overall_rating,
                    u.last_location_locality AS user_locality,
                    u.last_location_country AS user_country,
                    c.name AS user_company
                FROM
                    shipments_offers AS o
                INNER JOIN 
                    users AS u ON u.id = o.id_user 
                LEFT JOIN 
                    companies AS c ON u.id_company = c.id
                WHERE
                    o.id_shipment = ?
            ", array(
                $info["id"]
            )) ?: array();
            foreach($info["offers"] as $k => $o) {
                switch(intval($o["transport_type"])) {
                    case 1:
                        $dataCov = $this->conn->getRow("SELECT CONCAT(brand, ' ', model, ' - ', domain) AS c_desc, main_photo FROM users_conveyances WHERE id = ?", array(
                            $o["transport_id"]
                        ));
                        $info["offers"][$k]["transport_desc"] = $dataCov["c_desc"];
                        $info["offers"][$k]["transport_img"] = $dataCov["main_photo"];
                    break;
                    case 2:
                        $desc = "-";
                        if($o["transport_id"] == 6) {
                            $desc = "Transporte público";
                        }
                        else if($o["transport_id"] == 7) {
                            $desc = "Transporte Larga Distancia";
                        }
                        $info["offers"][$k]["transport_desc"] = $desc;
                        $info["offers"][$k]["transport_img"] = null;
                    break;
                }
            }
            $info["owner"] = $this->conn->getRow("SELECT id, IFNULL(avatar, 'default.png') AS avatar, fullname, email, overall_rating, last_location_locality AS locality, last_location_country AS country FROM users WHERE id = ?", array(
                $info["id_user"]
            ));
            $info["payment"] = $this->conn->getRow("SELECT * FROM shipments_payments WHERE id_shipment = ?", array(
                $info["id"]
            ));
            $dataHistoryOperations = $this->conn->getAll("SELECT * FROM shipments_operations_history WHERE id_shipment = ?", array(
                $info["id"]
            ));
            //echo json_encode($dataHistoryOperations); die();
            $historyOperations = array();
            foreach($dataHistoryOperations as $r) {
                if($r["uid"] == "return_pending") {
                    $r["data"] = $this->conn->getRow("
                        SELECT
                            r.id,
                            r.comments_reason,
                            r.dispatch_expenses,
                            r.receiver_fullname,
                            r.receiver_contact,
                            r.datetime,
                            rr.id AS reason_id,
                            rr.`name` AS reason_desc,
                            ro.id AS option_id,
                            ro.`name` AS option_desc
                        FROM
                            shipments_returns AS r INNER JOIN shipments_returns_reasons AS rr ON r.id_reason = rr.id INNER JOIN shipments_returns_options AS ro ON r.id_option = ro.id
                        WHERE
                            r.id_shipment = ?
                    ", array(
                        $info["id"]
                    )) ?: null;
                    if($r["data"]) {
                        $r["data"]["files"] = $this->conn->getAll("SELECT id, `name` FROM shipments_returns_files WHERE id_shipment = ?", array(
                            $info["id"]
                        )) ?: null;
                    }
                }
                else if($r["uid"] == "payment") {
                    $r["data"] = $info["payment"];
                }
                $historyOperations[$r["uid"]] = $r;
            }
            $info["operations_history"] = $historyOperations;
            $info["estimated_cost_per_km"] = 0;
            return $info;
        }

        function Shipments_Get_Standard($id) {
            $info = $this->conn->getRow("SELECT s.*, pt.`name` AS name_product_type FROM shipments AS s INNER JOIN product_types AS pt ON s.id_product_type = pt.id WHERE s.id = $id");
            if($info) {
                $info = $this->Shipments_Get_Standard_Additional_Info($info);
            }
            return $info;
        }

        function Shipments_List_Shipments($params) {
            $dataInfo = $this->conn->getAll("
                SELECT
                    s.*,
                    o.offer AS offer_value,
                    o.accepted_at AS offer_accepted_at,
                    o.registered_at AS offer_registered_at
                FROM
                    shipments AS s
                LEFT JOIN 
                    shipments_offers AS o ON s.id = o.id_shipment 
                LEFT JOIN 
                    users_ratings AS r ON s.id = r.id_shipment
                WHERE
                    s.id_user = ?# AND o.id IS NOT NULL 
                GROUP BY 
                    s.id
                ORDER BY
                    s.id DESC
            ", array(
                $params["user_id"]
            )) ?: array();
            $shipments = array();
            foreach($dataInfo as $k => $s) {
                $ratings = $this->conn->getAll("
                    SELECT * FROM users_ratings WHERE id_shipment = ?
                ", array(
                    $s["id"]
                )) ?: array();
                $pendingRate = false;
                $band = $s["id_status"] != 7;
                if($s["id_status"] == 5) {
                    switch(count($ratings)) {
                        case 0:
                            $band = true;
                            $pendingRate = true;
                        break;
                        case 1:
                            if($ratings[0]["id_user"] != $params["user_id"]) {
                                $band = false;
                            }
                            else {
                                $pendingRate = true;
                            }
                        break;
                        case 2:
                            $band = false;
                        break;
                    }
                }
                if($band) {
                    $shipments[$k] = $this->Shipments_Get_Standard_Additional_Info($s);
                    $shipments[$k]["ratings"] = $ratings;
                    $shipments[$k]["pending_rate"] = $pendingRate;
                }
            }
            return $shipments;
        }

        function Shipments_List_Deliveries($params) {
            $shipments = $this->conn->getAll("SELECT s.* FROM shipments AS s INNER JOIN shipments_offers AS o ON (s.id = o.id_shipment AND o.id_user = ?) WHERE (s.id_status != 5 AND s.id_status IS NOT NULL) ORDER BY o.registered_at DESC", array(
                $params["user_id"]
            )) ?: array();
            foreach($shipments as $k => $r) {
                $shipments[$k] = $this->Shipments_Get_Standard_Additional_Info($r);
                $shipments[$k]["owner"] = $this->conn->getRow("SELECT id, IFNULL(avatar, 'default.png') AS avatar, fullname, email, overall_rating, last_location_locality AS locality, last_location_country AS country FROM users WHERE id = ?", array(
                    $r["id_user"]
                ));
            }
            return $shipments;
            /*
            $strQuery = "";
            $uInfo = $this->conn->getRow("
                SELECT
                    last_location_lat AS lat,
                    last_location_lng AS lng,
                    last_location_datetime AS dt,
                    last_location_locality AS locality,
                    last_location_region AS region,
                    last_location_country AS country
                FROM
                    users 
                WHERE
                    id = $params[user_id]
            ");
            $strQuery .= " AND (s.start_address_locality = '$uInfo[locality]')";
            $sql = "
                SELECT
                    s.*,
                    o.offer AS offer_value,
                    o.accepted_at AS offer_accepted_at,
                    o.registered_at AS offer_registered_at
                FROM
                    shipments AS s
                LEFT JOIN 
                    shipments_offers AS o ON s.id = o.id_shipment 
                LEFT JOIN 
                    users_ratings AS r ON s.id = r.id_shipment
                WHERE
                    s.id_user != ? AND (s.status IS NULL OR s.status < 5) AND o.accepted_at IS NULL $strQuery
                GROUP BY 
                    s.id
                ORDER BY
                    s.registered_at DESC
            ";
            $dataInfo = $this->conn->getAll($sql, array(
                $params["user_id"]
            )) ?: array();
            $shipments = array();
            foreach($dataInfo as $k => $s) {
                $ratings = $this->conn->getAll("
                    SELECT * FROM users_ratings WHERE id_shipment = ?
                ", array(
                    $s["id"]
                )) ?: array();
                $pendingRate = false;
                $band = $s["id_status"] != 7;
                if($s["id_status"] == 5) {
                    switch(count($ratings)) {
                        case 0:
                            $band = true;
                            $pendingRate = true;
                        break;
                        case 1:
                            if($ratings[0]["id_user"] != $params["user_id"]) {
                                $band = false;
                            }
                            else {
                                $pendingRate = true;
                            }
                        break;
                        case 2:
                            $band = false;
                        break;
                    }
                }
                if($band) {
                    $shipments[$k] = $this->Shipments_Get_Standard_Additional_Info($s);
                    $shipments[$k]["ratings"] = $ratings;
                    $shipments[$k]["pending_rate"] = $pendingRate;
                }
            }
            return $shipments;
            */
        }

        function Shipments_List_Active($info) {
            $dataInfo = $this->conn->getAll("
                SELECT
                    s.*,
                    o.offer AS offer_value,
                    o.accepted_at AS offer_accepted_at,
                    o.registered_at AS offer_registered_at
                FROM
                    shipments AS s
                INNER JOIN 
                    shipments_offers AS o ON s.id = o.id_shipment 
                LEFT JOIN 
                    users_ratings AS r ON s.id = r.id_shipment
                WHERE
                    (o.id_user = ? OR s.id_user = ?) AND o.accepted_at IS NOT NULL
                GROUP BY 
                    s.id
                ORDER BY
                    s.id DESC
            ", array(
                $info["user_id"],
                $info["user_id"]
            )) ?: array();
            $shipments = array();

            foreach($dataInfo as $k => $s) {
                $ratings = $this->conn->getAll("
                    SELECT * FROM users_ratings WHERE id_shipment = ?
                ", array(
                    $s["id"]
                )) ?: array();
                $pendingRate = false;
                $band = $s["id_status"] != 7;
                if($s["id_status"] == 5) {
                    switch(count($ratings)) {
                        case 0:
                            $band = true;
                            $pendingRate = true;
                        break;
                        case 1:
                            if($ratings[0]["id_user"] != $info["user_id"]) {
                                $band = false;
                            }
                            else {
                                $pendingRate = true;
                            }
                        break;
                        case 2:
                            $band = false;
                        break;
                    }
                }
                if($band) {
                    $shipments[$k] = $this->Shipments_Get_Standard_Additional_Info($s);
                    $shipments[$k]["ratings"] = $ratings;
                    $shipments[$k]["pending_rate"] = $pendingRate;
                }
            }
            //return $shipments;
            return array_values($shipments);
        }

        function Shipments_List_Pending($info) {
            $orderStr = "";
            switch($info["filters"]["type"]) {
                case 1:
                    $orderStr = "ORDER BY s.id_shipment_type ASC";
                break;
                case 2:
                    $orderStr = "ORDER BY s.id_shipment_type DESC";
                break;
                case 3:
                    $orderStr = "ORDER BY s.registered_at DESC";
                break;
                case 4:
                    $orderStr = "ORDER BY s.id_status DESC";
                break;
            }
            if($info["filters"]["group"] == 1) {
                if(isset($info["deliveries_mode"])) {
                    $data = $this->conn->getAll("SELECT s.* FROM shipments AS s INNER JOIN shipments_offers AS o ON (s.id = o.id_shipment AND o.accepted_at IS NOT NULL) WHERE o.id_user = ? AND s.id_status = 5 ORDER BY s.delivered_at DESC", array(
                        $info["user_id"]
                    )) ?: array();
                }
                else {
                    $data = $this->conn->getAll("SELECT s.* FROM shipments AS s INNER JOIN shipments_offers AS o ON (s.id = o.id_shipment AND o.accepted_at IS NOT NULL) WHERE s.id_user = ? AND s.id_status = 5 ORDER BY s.delivered_at DESC", array(
                        $info["user_id"]
                    )) ?: array();
                }
            }
            else if($info["filters"]["group"] == 2) {
                if(isset($info["deliveries_mode"])) {
                    $data = $this->conn->getAll("SELECT s.* FROM shipments AS s INNER JOIN shipments_offers AS o ON (s.id = o.id_shipment AND o.accepted_at IS NOT NULL) WHERE o.id_user = ? AND (s.id_status = 6 || s.id_status = 7) ORDER BY s.delivered_at DESC", array(
                        $info["user_id"]
                    )) ?: array();
                }
                else {
                    $data = $this->conn->getAll("SELECT s.* FROM shipments AS s INNER JOIN shipments_offers AS o ON (s.id = o.id_shipment AND o.accepted_at IS NOT NULL) WHERE s.id_user = ? AND (s.id_status = 6 || s.id_status = 7) ORDER BY s.delivered_at DESC", array(
                        $info["user_id"]
                    )) ?: array();
                }
            }
            else {
                if(isset($info["deliveries_mode"])) {
                    $data = $this->conn->getAll("SELECT s.* FROM shipments AS s INNER JOIN shipments_offers AS o ON (s.id = o.id_shipment AND o.id_user = ?) WHERE (s.id_status != 5 AND s.id_status IS NOT NULL) $orderStr", array(
                        $info["user_id"]
                    )) ?: array();
                }
                else {
                    $data = $this->conn->getAll("SELECT * FROM shipments AS s WHERE s.id_user = ? AND (s.id_status != 5 OR s.id_status IS NULL) $orderStr", array(
                        $info["user_id"]
                    )) ?: array();
                }
            }
            foreach($data as $k => $s) {
                $data[$k] = $this->Shipments_Get_Standard_Additional_Info($s);
            }
            return $data;
        }

        function Shipments_List_Available($info) {
            $dtToday = gmdate("Y-m-d");
            $dtYesterday = gmdate("Y-m-d", strtotime("-1 days"));
            $data = array(
                "today" => array(),
                "yesterday" => array(),
                "others" => array()
            );
            $strQuery = "";
            if(isset($info["filters"]["filters_extended"]) && $info["filters"]["filters_extended"] == 1) {
                if(isset($info["filters"]["departure"])) {
                    if(is_array($info["filters"]["departure"])) { // dias de la semana
                        $d = implode(",", $info["filters"]["departure"]);
                        $strQuery .= " AND WEEKDAY(s.max_arrival_date) IN ($d)";
                    }
                    else { // fecha especifica
                        $d = $info["filters"]["departure"];
                        $strQuery .= " AND s.max_arrival_date = '$d'";
                    }
                }
                if($info["filters"]["category"]) {
                    $c = $info["filters"]["category"];
                    $strQuery .= " AND s.id_product_type = '$c'";
                }
                /*
                echo json_encode($info);
                die();
                */
            }
            if($info["filters"]["cur_city"] == 1) {
                $uInfo = $this->conn->getRow("
                    SELECT
                        last_location_lat AS lat,
                        last_location_lng AS lng,
                        last_location_datetime AS dt,
                        last_location_locality AS locality,
                        last_location_region AS region,
                        last_location_country AS country
                    FROM
                        users 
                    WHERE
                        id = $info[user_id]
                ");
                $strQuery .= " AND (s.start_address_locality = '$uInfo[locality]')";
            }
            if($info["filters"]["locality"] || $info["filters"]["locality"] || $info["filters"]["province"] || $info["filters"]["country"] || $info["filters"]["category"]) {
                $strQuery .= " AND (";
                if($info["filters"]["locality"]) {
                    $strQuery .= "s.start_address_locality LIKE '%" . $info["filters"]["locality"] . "%' AND ";
                }
                if($info["filters"]["province"]) {
                    $strQuery .= "s.start_address_region LIKE '%" . $info["filters"]["province"] . "%' AND ";
                }
                if($info["filters"]["country"]) {
                    $strQuery .= "s.start_address_country LIKE '%" . $info["filters"]["country"] . "%' AND ";
                }
                if($info["filters"]["category"]) {
                    $strQuery .= "s.id_product_type = '" . $info["filters"]["category"] . "' AND ";
                }
                $strQuery = substr($strQuery, 0, strlen($strQuery) - 5);
                $strQuery .= ")";
            }
            else {
                if(isset($info["filters"]["search_origin"]) && $info["filters"]["search_origin"]) {
                    $s = $info["filters"]["search_origin"]["locality"];
                    $s2 = $info["filters"]["search_origin"]["region"];
                    if($s2) {
                        $strQuery .= " AND (s.start_address_locality = '$s' AND s.start_address_region = '$s2')";
                    }
                    else {
                        $strQuery .= " AND (s.start_address_locality = '$s')";
                    }
                }
                if(
                    isset($info["filters"]["search_destination"]) && $info["filters"]["search_destination"] && 
                    isset($info["filters"]["search_destination"]) && $info["filters"]["search_destination"]
                ) {
                    $s = $info["filters"]["search_destination"]["locality"];
                    $s2 = $info["filters"]["search_destination"]["region"];
                    if($s2) {
                        $strQuery .= " AND (s.end_address_locality = '$s' AND s.end_address_region = '$s2')";
                    }
                    else {
                        $strQuery .= " AND (s.end_address_locality = '$s')";
                    }
                }
            }
            if($info["filters"]["urgent_shipments"] == 1) {
                $strQuery .= " AND s.id_shipment_type = 2";
            }
            $strQuery .= " AND s.id_status IS NULL";
            $strQuery .= " AND shipments_is_available(s.id, $info[user_id]) = 1";
            $strQuery .= " AND (shipments_available_shipments(s.id) IS NULL OR shipments_available_shipments(s.id) > 0)";
            
            
            $strQuery .= " ORDER BY s.registered_at DESC";
            /*switch($info["filters"]["order"]) {
                case 'nearest':
                    $strQuery .= "";
                break;
                case 'newest':
                    $strQuery .= " ORDER BY s.registered_at DESC";
                break;
                case 'urgent':
                    $strQuery .= " ORDER BY s.id_shipment_type DESC";
                break;
                case 'normal':
                    $strQuery .= " ORDER BY s.id_shipment_type ASC";
                break;
                case 'best_rated':
                    $strQuery .= " ORDER BY user_overall_rating(s.id_user) DESC";
                break;
                case 'fixed_value':
                    $strQuery .= " ORDER BY s.receive_offers ASC";
                break;
                case 'waiting_offers':
                    $strQuery .= " ORDER BY s.id_status ASC";
                break;
            }*/


            //echo "SELECT * FROM shipments WHERE id_user != ? $strQuery"; die();
            if(isset($info["filters"]["discarded_shipments"]) == 1 && $info["filters"]["discarded_shipments"] == 1) {
                $condDiscarded = "";
            }
            else {
                $condDiscarded = "AND si.id IS NULL";
            }
            $dataS = $this->conn->getAll("SELECT s.* FROM shipments AS s LEFT JOIN shipments_ignored AS si ON (s.id = si.id_shipment AND si.id_user = ?) WHERE shipment_is_expired(s.id) != 1 AND s.id_user != ? $condDiscarded $strQuery", array(
                $info["user_id"],
                $info["user_id"]
            )) ?: array();
            foreach($dataS as $k => $s) {
                $dataS[$k] = $this->Shipments_Get_Standard_Additional_Info($s);
            }
            foreach($dataS as $row) {
                $dt = gmdate("Y-m-d", strtotime($row["registered_at"]));
                if($dt == $dtToday) {
                    $data["today"][] = $row;
                }
                else if($dt == $dtYesterday) {
                    $data["yesterday"][] = $row;
                }
                else {
                    $data["others"][] = $row;
                }
            }
            return $data;
        }

        function addressDurDesc($seconds) {
            $hours = floor($seconds / 3600);
            $minutes = floor(($seconds / 60) % 60);
            $seconds = $seconds % 60;
            return $hours > 0 ? "$hours:$minutes h" : "$minutes m";
        }

        function Shipments_New_Standard($info) {
            $info["address_dist_1_dis_value"] = $info["address_dist_1_dis"];
            $info["address_dist_1_dis_desc"] = intval($info["address_dist_1_dis"] / 1000) . " km";
            $info["address_dist_1_dur_value"] = $info["address_dist_1_dur"];
            $info["address_dist_1_dur_desc"] = $this->addressDurDesc($info["address_dist_1_dur"]);

            if(isset($info["address_dist_2_dis"])) {
                $info["address_dist_2_dis_value"] = $info["address_dist_2_dis"];
                $info["address_dist_2_dis_desc"] = intval($info["address_dist_2_dis"] / 1000) . " km";
                $info["address_dist_2_dur_value"] = $info["address_dist_2_dur"];
                $info["address_dist_2_dur_desc"] = $this->addressDurDesc($info["address_dist_2_dur"]);
            }
            else {
                $info["address_dist_2_dis_value"] = null;
                $info["address_dist_2_dis_desc"] = null;
                $info["address_dist_2_dur_value"] = null;
                $info["address_dist_2_dur_desc"] = null;
            }

            $info["pin"] = rand(10000000, 99999999);

            $dt = gmdate("Y-m-d H:i:s");

            $info["must_arrive"] = null;
            
            $this->conn->query("
                INSERT INTO shipments (
                    id_user,
                    id_product_type,
                    id_shipment_type,
                    pin,
                    registered_at,
                    start_address,
                    start_address_place_id,
                    start_address_lat,
                    start_address_lon,
                    start_address_locality,
                    start_address_region,
                    start_address_country,
                    waypoint_address,
                    waypoint_address_place_id,
                    waypoint_address_lat,
                    waypoint_address_lon,
                    waypoint_address_locality,
                    waypoint_address_region,
                    waypoint_address_country,
                    end_address,
                    end_address_place_id,
                    end_address_lat,
                    end_address_lon,
                    end_address_locality,
                    end_address_region,
                    end_address_country,
                    receiver_name,
                    receiver_phone,
                    description,
                    measurements_width,
                    measurements_width_unit,
                    measurements_height,
                    measurements_height_unit,
                    measurements_depth,
                    measurements_depth_unit,
                    measurements_weight,
                    measurements_weight_unit,
                    out_now,
                    max_arrival_date,
                    receive_offers,
                    amount_payable,
                    declared_value,
                    address_dist_1_dis_value,
                    address_dist_1_dis_desc,
                    address_dist_1_dur_value,
                    address_dist_1_dur_desc,
                    address_dist_2_dis_value,
                    address_dist_2_dis_desc,
                    address_dist_2_dur_value,
                    address_dist_2_dur_desc,
                    additional_address_information,
                    must_arrive
                )
                VALUES
                (
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?
                )
            ", array(
                $info["user_id"],
                $info["product_type"],
                $info["shipments_type"],
                $info["pin"],
                $dt,
                $info["address_start_display_name"],
                $info["address_start_place_id"],
                $info["address_start_location_lat"],
                $info["address_start_location_lng"],
                $info["address_start_locality"],
                $info["address_start_region"],
                $info["address_start_country"],
                isset($info["address_waypoint_display_name"])   ? $info["address_waypoint_display_name"]    : null,
                isset($info["address_waypoint_place_id"])       ? $info["address_waypoint_place_id"]        : null,
                isset($info["address_waypoint_location_lat"])   ? $info["address_waypoint_location_lat"]    : null,
                isset($info["address_waypoint_location_lng"])   ? $info["address_waypoint_location_lng"]    : null,
                isset($info["address_waypoint_locality"]) ? $info["address_waypoint_locality"] : null,
                isset($info["address_waypoint_region"]) ? $info["address_waypoint_region"] : null,
                isset($info["address_waypoint_country"]) ? $info["address_waypoint_country"] : null,
                $info["address_end_display_name"],
                $info["address_end_place_id"],
                $info["address_end_location_lat"],
                $info["address_end_location_lng"],
                $info["address_end_locality"],
                $info["address_end_region"],
                $info["address_end_country"],
                $info["receiver_name"],
                $info["receiver_phone"],
                $info["description"],
                $info["measurements_width"] ?: null,
                $info["measurements_width_unit"] ?: null,
                $info["measurements_height"] ?: null,
                $info["measurements_height_unit"] ?: null,
                $info["measurements_depth"] ?: null,
                $info["measurements_depth_unit"] ?: null,
                $info["measurements_weight"] ?: null,
                $info["measurements_weight_unit"] ?: null,
                $info["departure_out_now"] ?: 0,
                $info["departure_max_arrival_date"] ?: null,
                $info["payment_receive_offers"] ?: 0,
                $info["payment_amount_payable"] ?: null,
                $info["declared_value"] ?: null,
                $info["address_dist_1_dis_value"],
                $info["address_dist_1_dis_desc"],
                $info["address_dist_1_dur_value"],
                $info["address_dist_1_dur_desc"],
                $info["address_dist_2_dis_value"],
                $info["address_dist_2_dis_desc"],
                $info["address_dist_2_dur_value"],
                $info["address_dist_2_dur_desc"],
                $info["additional_address_information"] ?: null,
                $info["must_arrive"] ?: null
            ));
            $lastId = $this->conn->getInsertID();
            if($lastId > 0) {
                $this->conn->query("
                    INSERT INTO shipments_operations_history (
                        id_shipment,
                        id_user,
                        uid,
                        datetime,
                        valor
                    ) VALUES (
                        ?,
                        ?,
                        ?,
                        ?,
                        ?
                    )
                ", array(
                    $lastId,
                    null,
                    "register",
                    $dt,
                    null
                ));
                for($i = 1; $i <= $info["pictures_count"]; $i++) {
                    //$ext = pathinfo($_FILES["picture_$i"]["name"], PATHINFO_EXTENSION);
                    $ext = @explode("/", $_FILES["picture_$i"]["type"])[1];
                    $pic = $lastId . "_" . "$i.$ext";
                    if(move_uploaded_file($_FILES["picture_$i"]["tmp_name"], "uploads/shipments/$pic")) {
                        $this->conn->query("
                            INSERT INTO shipments_pictures 
                                (id_shipment, `name`)
                            VALUES 
                                (?, ?)
                        ", array(
                            $lastId,
                            $pic
                        ));
                    }
                }
            }
            return $lastId > 0 ? $this->Shipments_Get_Standard($lastId) : "Hubo un problema al crear el envío.";
        }

        function Shipments_Update($info) {
            $info["address_dist_1_dis_value"] = $info["address_dist_1_dis"];
            $info["address_dist_1_dis_desc"] = intval($info["address_dist_1_dis"] / 1000) . " km";
            $info["address_dist_1_dur_value"] = $info["address_dist_1_dur"];
            $info["address_dist_1_dur_desc"] = $this->addressDurDesc($info["address_dist_1_dur"]);

            if(isset($info["address_dist_2_dis"])) {
                $info["address_dist_2_dis_value"] = $info["address_dist_2_dis"];
                $info["address_dist_2_dis_desc"] = intval($info["address_dist_2_dis"] / 1000) . " km";
                $info["address_dist_2_dur_value"] = $info["address_dist_2_dur"];
                $info["address_dist_2_dur_desc"] = $this->addressDurDesc($info["address_dist_2_dur"]);
            }
            else {
                $info["address_dist_2_dis_value"] = null;
                $info["address_dist_2_dis_desc"] = null;
                $info["address_dist_2_dur_value"] = null;
                $info["address_dist_2_dur_desc"] = null;
            }

            $info["must_arrive"] = null;
            
            $this->conn->query("
                UPDATE 
                    shipments 
                SET 
                    id_product_type = ?,
                    id_shipment_type = ?,
                    updated_at = ?,
                    start_address = ?,
                    start_address_place_id = ?,
                    start_address_lat = ?,
                    start_address_lon = ?,
                    start_address_locality = ?,
                    start_address_region = ?,
                    start_address_country = ?,
                    waypoint_address = ?,
                    waypoint_address_place_id = ?,
                    waypoint_address_lat = ?,
                    waypoint_address_lon = ?,
                    waypoint_address_locality = ?,
                    waypoint_address_region = ?,
                    waypoint_address_country = ?,
                    end_address = ?,
                    end_address_place_id = ?,
                    end_address_lat = ?,
                    end_address_lon = ?,
                    end_address_locality = ?,
                    end_address_region = ?,
                    end_address_country = ?,
                    receiver_name = ?,
                    receiver_phone = ?,
                    description = ?,
                    measurements_width = ?,
                    measurements_width_unit = ?,
                    measurements_height = ?,
                    measurements_height_unit = ?,
                    measurements_depth = ?,
                    measurements_depth_unit = ?,
                    measurements_weight = ?,
                    measurements_weight_unit = ?,
                    out_now = ?,
                    max_arrival_date = ?,
                    receive_offers = ?,
                    amount_payable = ?,
                    declared_value = ?,
                    address_dist_1_dis_value = ?,
                    address_dist_1_dis_desc = ?,
                    address_dist_1_dur_value = ?,
                    address_dist_1_dur_desc = ?,
                    address_dist_2_dis_value = ?,
                    address_dist_2_dis_desc = ?,
                    address_dist_2_dur_value = ?,
                    address_dist_2_dur_desc = ? ,
                    must_arrive = ? 
                WHERE 
                    id = ?
            ", array(
                $info["product_type"],
                $info["shipments_type"],
                gmdate("Y-m-d H:i:s"),
                $info["address_start_display_name"],
                $info["address_start_place_id"],
                $info["address_start_location_lat"],
                $info["address_start_location_lng"],
                $info["address_start_locality"],
                $info["address_start_region"],
                $info["address_start_country"],
                isset($info["address_waypoint_display_name"])   ? $info["address_waypoint_display_name"]    : null,
                isset($info["address_waypoint_place_id"])       ? $info["address_waypoint_place_id"]        : null,
                isset($info["address_waypoint_location_lat"])   ? $info["address_waypoint_location_lat"]    : null,
                isset($info["address_waypoint_location_lng"])   ? $info["address_waypoint_location_lng"]    : null,
                isset($info["address_waypoint_locality"]) ? $info["address_waypoint_locality"] : null,
                isset($info["address_waypoint_region"]) ? $info["address_waypoint_region"] : null,
                isset($info["address_waypoint_country"]) ? $info["address_waypoint_country"] : null,
                $info["address_end_display_name"],
                $info["address_end_place_id"],
                $info["address_end_location_lat"],
                $info["address_end_location_lng"],
                $info["address_end_locality"],
                $info["address_end_region"],
                $info["address_end_country"],
                $info["receiver_name"],
                $info["receiver_phone"],
                $info["description"],
                $info["measurements_width"] ?: null,
                $info["measurements_width_unit"] ?: null,
                $info["measurements_height"] ?: null,
                $info["measurements_height_unit"] ?: null,
                $info["measurements_depth"] ?: null,
                $info["measurements_depth_unit"] ?: null,
                $info["measurements_weight"] ?: null,
                $info["measurements_weight_unit"] ?: null,
                $info["departure_out_now"] ?: 0,
                $info["departure_max_arrival_date"] ?: null,
                $info["payment_receive_offers"] ?: 0,
                $info["payment_amount_payable"] ?: null,
                $info["declared_value"] ?: null,
                $info["address_dist_1_dis_value"],
                $info["address_dist_1_dis_desc"],
                $info["address_dist_1_dur_value"],
                $info["address_dist_1_dur_desc"],
                $info["address_dist_2_dis_value"],
                $info["address_dist_2_dis_desc"],
                $info["address_dist_2_dur_value"],
                $info["address_dist_2_dur_desc"],
                $info["must_arrive"],
                $info["id"]
            ));

            if(isset($info["pictures_delete"])) {
                foreach($info["pictures_delete"] as $pic) {
                    @unlink("uploads/shipments/$pic");
                    $this->conn->query("DELETE FROM shipments_pictures WHERE `name` = ?", array(
                        $pic
                    ));
                }
            }
            
            for($i = 1; $i <= $info["pictures_count"]; $i++) {
                if(isset($_FILES["picture_$i"])) {
                    $ext = @explode("/", $_FILES["picture_$i"]["type"])[1];
                    $pic = $info["id"] . "_" . "$i.$ext";
                    if(move_uploaded_file($_FILES["picture_$i"]["tmp_name"], "uploads/shipments/$pic")) {
                        $this->conn->query("
                            INSERT INTO shipments_pictures 
                                (id_shipment, `name`)
                            VALUES 
                                (?, ?)
                        ", array(
                            $info["id"],
                            $pic
                        ));
                    }
                }
            }
            
            return $this->Shipments_Get_Standard($info["id"]);
        }

        function Shipments_Save_Offer($info) {            
            $this->conn->query("
                INSERT INTO shipments_offers (
                    id_user,
                    id_shipment,
                    offer,
                    transport_type,
                    transport_id,
                    estimated_arrival_date,
                    registered_at,
                    approximate_arrival_value,
                    approximate_arrival_desc,
                    approximate_distance_value,
                    approximate_distance_desc
                )
                VALUES
                (
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?
                )
            ", array(
                $info["user_id"],
                $info["shipment_id"],
                $info["offer"],
                $info["transport_details"]["type"],
                $info["transport_details"]["id"],
                $info["arrival_date"],
                gmdate("Y-m-d H:i:s"),
                $info["arrival_distance"] ? $info["arrival_distance"]["duration"]["value"] : null,
                $info["arrival_distance"] ? $info["arrival_distance"]["duration"]["text"] : null,
                $info["arrival_distance"] ? $info["arrival_distance"]["distance"]["value"] : null,
                $info["arrival_distance"] ? $info["arrival_distance"]["distance"]["text"] : null
            ));
            $lastId = $this->conn->getInsertID();
            return $lastId > 0 ? $lastId : false;
        }

        function Shipments_Accept_Offer($info) {
            $infoOffer = $this->conn->getRow("SELECT * FROM shipments_offers WHERE id = ?", array(
                $info["offer"]
            )) ?: null;
            if($infoOffer) {
                $infoOffer["accepted_at"] = gmdate("Y-m-d H:i:s");
                $this->conn->query("
                    UPDATE shipments_offers SET accepted_at = ? WHERE id = ?
                ", array(
                    $infoOffer["accepted_at"],
                    $infoOffer["id"]
                ));
                $this->conn->query("
                    UPDATE shipments SET id_status = 1 WHERE id = ?
                ", array(
                    $infoOffer["id_shipment"]
                ));
                $this->conn->query("
                    INSERT INTO shipments_operations_history (
                        id_shipment,
                        id_user,
                        uid,
                        datetime,
                        valor
                    ) VALUES (
                        ?,
                        ?,
                        ?,
                        ?,
                        ?
                    )
                ", array(
                    $infoOffer["id_shipment"],
                    $infoOffer["id_user"],
                    "offer_accepted",
                    $infoOffer["accepted_at"],
                    $infoOffer["offer"]
                ));
                $this->_Send_Data_NJS(array(
                    'action' => 'shipment timeline updated',
                    'data' => array(
                        'id_shipment' => $infoOffer["id_shipment"],
                        'id_user' => $infoOffer["id_user"],
                        'uid' => "offer_accepted"
                    )
                ));
                return $this->conn->getOne("SELECT id FROM shipments_offers WHERE id = ? AND accepted_at IS NOT NULL", array(
                    $infoOffer["id"]
                ));
            }
            return null;
        }

        function Shipments_Save_Return_Dispatch_Expenses($info) {
            $infoOffer = $this->conn->getRow("SELECT shipments_offers.*, users.id AS owner_id FROM shipments_offers INNER JOIN shipments ON shipments_offers.id_shipment = shipments.id INNER JOIN users ON shipments.id_user = users.id WHERE shipments_offers.id = ?", array(
                $info["id"]
            )) ?: null;
            if($infoOffer) {
                $this->conn->query("
                    INSERT INTO shipments_operations_history (
                        id_shipment,
                        id_user,
                        uid,
                        datetime,
                        valor
                    ) VALUES (
                        ?,
                        ?,
                        ?,
                        ?,
                        ?
                    )
                ", array(
                    $infoOffer["id_shipment"],
                    $infoOffer["id_user"],
                    "return_dispatch_expenses",
                    gmdate("Y-m-d H:i:s"),
                    $info["value"]
                ));
                $arr = array(
                    'action' => 'push notification',
                    'data' => array(
                        'to' => $infoOffer["owner_id"],
                        'title' => "Gastos de despacho",
                        'content' => "Se ha solicitado un monto por $$info[value] por concepto de gastos de despacho."
                    )
                );
                $this->_Send_Data_NJS($arr);
                $arr['action'] = 'save notification';
                $arr['data']['id_s'] = $infoOffer["id_shipment"];
                $this->_Send_Data_NJS($arr);
                $this->_Send_Data_NJS(array(
                    'action' => 'shipment timeline updated',
                    'data' => array(
                        'id_shipment' => $infoOffer["id_shipment"],
                        'id_user' => $infoOffer["id_user"],
                        'uid' => "return_dispatch_expenses"
                    )
                ));
                
                return $this->conn->getInsertID() > 0;
            }
            return null;
        }

        function Shipments_Refuse_Offer($info) {            
            $this->conn->query("
                DELETE FROM shipments_offers WHERE id = ?", array(
                $info["offer"]
            ));
            return $this->conn->getOne("SELECT id FROM shipments_offers WHERE id = ?", array(
                $info["offer"]
            )) === false;
        }

        function Shipments_Delete($info) {            
            $this->conn->query("DELETE FROM shipments WHERE id = ?", array(
                $info["id"]
            ));     
            $this->conn->query("DELETE FROM shipments_pictures WHERE id_shipment = ?", array(
                $info["id"]
            ));
            @unlink("../uploads/shipments/" . $info["id"] . "_1.jpg");
            @unlink("../uploads/shipments/" . $info["id"] . "_2.jpg");
            @unlink("../uploads/shipments/" . $info["id"] . "_3.jpg");
            return $this->conn->getOne("SELECT id FROM shipments WHERE id = ?", array(
                $info["id"]
            )) === false;
        }

        function Shipments_Discard($info) {     
            $this->conn->query("
                INSERT INTO shipments_ignored (
                    id_user, 
                    id_shipment,
                    registered_at 
                ) VALUES (
                    ?, 
                    ?, 
                    ?
                )
            ", array(
                $info["id_user"],
                $info["id"],
                gmdate("Y-m-d H:i:s")
            ));
            $lastId = $this->conn->getInsertID();
            return $lastId > 0;
        }

        function Shipments_Wallet_History($params) {
            $results = array(
                "sent" => array(
                    "amount" => 0,
                    "records" => array()
                ),
                "delivered" => array(
                    "amount" => 0,
                    "records" => array()
                ),
                "refunds" => array(
                    "amount" => 0,
                    "records" => array()
                )
            );
            $payments = $this->conn->getAll("
                SELECT
                    p.* 
                FROM
                    shipments_payments AS p
                WHERE
                    p.collection_status = 'approved' AND DATE(p.registered_at) BETWEEN ? AND ? 
                ORDER BY 
                    p.registered_at ASC
            ", array(
                $params["start_date"],
                $params["end_date"]
            )) ?: array();
            $paymentsRefunds = $this->conn->getAll("
                SELECT
                    p.* 
                FROM
                    shipments_payments AS p
                WHERE
                    (p.collection_status = 'refund' OR p.collection_status = 'refund_pending') AND DATE(p.registered_at) BETWEEN ? AND ? 
                ORDER BY 
                    p.registered_at ASC
            ", array(
                $params["start_date"],
                $params["end_date"]
            )) ?: array();
            $balance = 0;
            $pBalance = 0;
            foreach($payments as $k => $p) {
                $payments[$k]["info_shipment"] = $this->Shipments_Get_Standard($p["id_shipment"]);
                $payments[$k]["info_shipment"]["accepted_offer"] = $this->conn->getRow("
                    SELECT
                        o.id,
                        o.offer,
                        o.registered_at,
                        o.accepted_at,
                        o.estimated_arrival_date,
                        o.approximate_arrival_value,
                        o.approximate_arrival_desc,
                        o.approximate_distance_value,
                        o.approximate_distance_desc,
                        o.transport_id,
                        o.transport_type,
                        u.id AS user_id,
                        IFNULL(u.avatar, 'default.png') AS user_avatar,
                        IFNULL(u.fullname, SUBSTRING_INDEX(u.email, '@', 1)) AS user_fullname,
                        u.email AS user_email,
                        u.verified AS user_verified,
                        u.overall_rating AS user_overall_rating,
                        u.last_location_locality AS user_locality,
                        u.last_location_country AS user_country,
                        c.name AS user_company
                    FROM
                        shipments_offers AS o
                    INNER JOIN 
                        users AS u ON u.id = o.id_user 
                    LEFT JOIN 
                        companies AS c ON u.id_company = c.id
                    WHERE
                        o.id_shipment = ? AND o.accepted_at IS NOT NULL
                ", array(
                    $p["id_shipment"]
                )) ?: array();

                switch(intval($payments[$k]["info_shipment"]["accepted_offer"]["transport_type"])) {
                    case 1:
                        $dataCov = $this->conn->getRow("SELECT CONCAT(brand, ' ', model, ' - ', domain) AS c_desc, main_photo FROM users_conveyances WHERE id = ?", array(
                            $payments[$k]["info_shipment"]["accepted_offer"]["transport_id"]
                        ));
                        $payments[$k]["info_shipment"]["accepted_offer"]["transport_desc"] = $dataCov["c_desc"];
                        $payments[$k]["info_shipment"]["accepted_offer"]["transport_img"] = $dataCov["main_photo"];
                    break;
                    case 2:
                        $desc = "-";
                        if($payments[$k]["info_shipment"]["accepted_offer"]["transport_id"] == 6) {
                            $desc = "Transporte público";
                        }
                        else if($payments[$k]["info_shipment"]["accepted_offer"]["transport_id"] == 7) {
                            $desc = "Transporte Larga Distancia";
                        }
                        $payments[$k]["info_shipment"]["accepted_offer"]["transport_desc"] = $desc;
                        $payments[$k]["info_shipment"]["accepted_offer"]["transport_img"] = null;
                    break;
                }

                $rowInfo = $payments[$k];

                if($rowInfo["info_shipment"]["owner"]["id"] == $params["id_user"]) {
                    $results["sent"]["amount"] += floatval($p["total_paid_amount"]);
                    $pBalance = $balance;
                    $balance -= $results["sent"]["amount"];
                    $results["sent"]["records"][] = array( // $rowInfo
                        "shipment" => array(
                            "id" => $rowInfo["info_shipment"]["id"],
                            "product_type" => $rowInfo["info_shipment"]["name_product_type"],
                            "picture" => $rowInfo["info_shipment"]["pictures"][0]["name"]
                        ),
                        "payment" => array(
                            "amount" => floatval($rowInfo["total_paid_amount"]),
                            "registered_at" => $rowInfo["registered_at"]
                        ),
                        "balance" => array(
                            "new" => floatval(number_format(floatval($balance), 2)),
                            "old" => floatval(number_format(floatval($pBalance), 2))
                        )
                    );
                }
                else {
                    $results["delivered"]["amount"] += floatval($p["net_received_amount"]);
                    $pBalance = $balance;
                    $balance += $results["delivered"]["amount"];
                    $results["delivered"]["records"][] = array( // $rowInfo
                        "shipment" => array(
                            "id" => $rowInfo["info_shipment"]["id"],
                            "product_type" => $rowInfo["info_shipment"]["name_product_type"],
                            "picture" => $rowInfo["info_shipment"]["pictures"][0]["name"]
                        ),
                        "payment" => array(
                            "amount" => floatval($rowInfo["net_received_amount"]),
                            "registered_at" => $rowInfo["registered_at"]
                        ),
                        "balance" => array(
                            "new" => floatval(number_format(floatval($balance), 2)),
                            "old" => floatval(number_format(floatval($pBalance), 2))
                        )
                    );
                }
            }
            foreach($paymentsRefunds as $k => $p) {
                $paymentsRefunds[$k]["info_shipment"] = $this->Shipments_Get_Standard($p["id_shipment"]);
                $paymentsRefunds[$k]["info_shipment"]["accepted_offer"] = $this->conn->getRow("
                    SELECT
                        o.id,
                        o.offer,
                        o.registered_at,
                        o.estimated_arrival_date,
                        o.approximate_arrival_value,
                        o.approximate_arrival_desc,
                        o.approximate_distance_value,
                        o.approximate_distance_desc,
                        o.transport_id,
                        o.transport_type,
                        o.accepted_at,
                        u.id AS user_id,
                        IFNULL(u.avatar, 'default.png') AS user_avatar,
                        IFNULL(u.fullname, SUBSTRING_INDEX(u.email, '@', 1)) AS user_fullname,
                        u.email AS user_email,
                        u.verified AS user_verified,
                        u.overall_rating AS user_overall_rating,
                        u.last_location_locality AS user_locality,
                        u.last_location_country AS user_country,
                        c.name AS user_company
                    FROM
                        shipments_offers AS o
                    INNER JOIN 
                        users AS u ON u.id = o.id_user 
                    LEFT JOIN 
                        companies AS c ON u.id_company = c.id
                    WHERE
                        o.id_shipment = ? AND o.accepted_at IS NOT NULL
                ", array(
                    $p["id_shipment"]
                )) ?: array();

                switch(intval($paymentsRefunds[$k]["info_shipment"]["accepted_offer"]["transport_type"])) {
                    case 1:
                        $dataCov = $this->conn->getRow("SELECT CONCAT(brand, ' ', model, ' - ', domain) AS c_desc, main_photo FROM users_conveyances WHERE id = ?", array(
                            $o["transport_id"]
                        ));
                        $paymentsRefunds[$k]["info_shipment"]["accepted_offer"]["transport_desc"] = $dataCov["c_desc"];
                        $paymentsRefunds[$k]["info_shipment"]["accepted_offer"]["transport_img"] = $dataCov["main_photo"];
                    break;
                    case 2:
                        $desc = "-";
                        if($o["transport_id"] == 6) {
                            $desc = "Transporte público";
                        }
                        else if($o["transport_id"] == 7) {
                            $desc = "Transporte Larga Distancia";
                        }
                        $paymentsRefunds[$k]["info_shipment"]["accepted_offer"]["transport_desc"] = $desc;
                        $paymentsRefunds[$k]["info_shipment"]["accepted_offer"]["transport_img"] = null;
                    break;
                }

                $rowInfo = $paymentsRefunds[$k];

                $ammount = $paymentsRefunds[$k]["info_shipment"]["accepted_offer"]["offer"];
                
                $results["refunds"]["amount"] += floatval($ammount);
                $pBalance = $balance;
                $balance += $results["refunds"]["amount"];
                $results["refunds"]["records"][] = array( // $rowInfo
                    "shipment" => array(
                        "id" => $rowInfo["info_shipment"]["id"],
                        "product_type" => $rowInfo["info_shipment"]["name_product_type"],
                        "picture" => $rowInfo["info_shipment"]["pictures"][0]["name"]
                    ),
                    "payment" => array(
                        "amount" => floatval($ammount),
                        "registered_at" => $rowInfo["info_shipment"]["registered_at"]
                    ),
                    "balance" => array(
                        "new" => floatval(number_format(floatval($balance), 2)),
                        "old" => floatval(number_format(floatval($pBalance), 2))
                    )
                );
            }
            return $results;
        }

        function Shipments_Rate($info) {
            $shipmentInfo = $this->Shipments_Get_Standard($info["id"]);
            $userId = 0;
            if($info["qualifier"] == $shipmentInfo["owner"]["id"]) {
                $userId = 0;
                foreach($shipmentInfo["offers"] as $o) {
                    if($o["accepted_at"] != null) {
                        $userId = $o["user_id"];
                    }
                }
            }
            else {
                $userId = $shipmentInfo["owner"]["id"];
            }
            $this->conn->query("
                INSERT INTO  users_ratings (
                    id_user, 
                    id_shipment, 
                    rating, 
                    comments, 
                    register_at 
                ) VALUES (
                    ?, 
                    ?, 
                    ?, 
                    ?, 
                    ? 
                )
            ", array(
                $userId,
                $info["id"],
                $info["rating"],
                $info["comments"],
                gmdate("Y-m-d H:i:s")
            ));
            $lastId = $this->conn->getInsertID();
            if($lastId > 0) {
                $overallRating = $this->conn->getOne("
                    SELECT
                        SUM(rating) / COUNT(*)
                    FROM
                        users_ratings 
                    WHERE
                        id_user = ?
                ", array(
                    $userId
                ));
                $this->conn->query("UPDATE users SET overall_rating = ? WHERE id = ?", array(
                    $overallRating,
                    $userId
                ));
            }
            return $lastId > 0;
        }

        function Shipments_Tracking_History($params) {
            return $this->conn->getAll("
                SELECT * FROM shipments_users_locations WHERE id_user = ? AND id_shipment = ?
            ", array(
                $params["user_id"],
                $params["shipment_id"]
            ));
        }

        function Shipments_Return($info) {
            $this->conn->query("UPDATE shipments SET id_status = 6 WHERE id = ?", array(
                $info["id"]
            ));
            $dt = gmdate("Y-m-d H:i:s");
            $this->conn->query("
                INSERT INTO shipments_returns (
                    id_shipment, 
                    id_user, 
                    id_reason, 
                    id_option, 
                    comments_reason, 
                    dispatch_expenses, 
                    receiver_fullname, 
                    receiver_contact, 
                    datetime
                )
                VALUES
                ( 
                    ?, 
                    ?, 
                    ?, 
                    ?, 
                    ?, 
                    ?, 
                    ?, 
                    ?, 
                    ?
                )
            ", array(
                $info["id"],
                $info["id_user"],
                $info["reason"],
                $info["option"],
                $info["comments"] ?: null,
                null,
                isset($info["receiver_fullname"]) ? $info["receiver_fullname"] : null,
                isset($info["receiver_contact"]) ? $info["receiver_contact"] : null,
                $dt
            ));
            $lastId = $this->conn->getInsertID();
            if($lastId > 0) {
                if(isset($info["receiver_files_count"]) && $info["receiver_files_count"] > 0) {
                    for($i = 0; $i < $info["receiver_files_count"]; $i++) {
                        $ext = @explode("/", $_FILES["receiver_file_$i"]["type"])[1];
                        $pic = $info["id"] . "_" . "$i.$ext";
                        @move_uploaded_file($_FILES["receiver_file_$i"]["tmp_name"], "uploads/return_files/$pic");
                        $this->conn->query("
                            INSERT INTO shipments_returns_files 
                                (id_shipment, `name`)
                            VALUES 
                                (?, ?)
                        ", array(
                            $info["id"],
                            $pic
                        ));
                    }
                }
                $this->conn->query("
                    INSERT INTO shipments_operations_history (
                        id_shipment,
                        id_user,
                        uid,
                        datetime,
                        valor
                    ) VALUES (
                        ?,
                        ?,
                        ?,
                        ?,
                        ?
                    )
                ", array(
                    $info["id"],
                    $info["id_user"],
                    "return_pending",
                    $dt,
                    null
                ));
                $this->_Send_Data_NJS(array(
                    'action' => 'shipment timeline updated',
                    'data' => array(
                        'id_shipment' => $info["id"],
                        'id_user' => $info["id_user"],
                        'uid' => "return_pending"
                    )
                ));
            }
            
            return $lastId > 0;
        }

        function Shipments_Get_Offers($params) {
            $queryS = "";
            switch(intval($params["filters"]["order"])) {
                case 1: // Oferta más baja primero
                    $queryS = "ORDER BY o.offer ASC";
                break;
                case 2: // Usuarios verificados únicamente
                    $queryS = "AND u.verified = 1";
                break;
                case 3: // Usuarios mejor calificados
                    $queryS = "ORDER BY u.overall_rating DESC";
                break;
            }

            $offers = $this->conn->getAll("
                SELECT
                    o.id,
                    o.offer,
                    o.registered_at,
                    o.estimated_arrival_date,
                    o.approximate_arrival_value,
                    o.approximate_arrival_desc,
                    o.approximate_distance_value,
                    o.approximate_distance_desc,
                    o.accepted_at,
                    o.transport_id,
                    o.transport_type,
                    u.id AS user_id,
                    IFNULL(u.avatar, 'default.png') AS user_avatar,
                    IFNULL(u.fullname, SUBSTRING_INDEX(u.email, '@', 1)) AS user_fullname,
                    u.email AS user_email,
                    u.verified AS user_verified,
                    u.overall_rating AS user_overall_rating,
                    u.last_location_locality AS user_locality,
                    u.last_location_country AS user_country,
                    c.name AS user_company
                FROM
                    shipments_offers AS o
                INNER JOIN 
                    users AS u ON u.id = o.id_user 
                INNER JOIN 
                    shipments AS s ON o.id_shipment = s.id 
                LEFT JOIN 
                    companies AS c ON u.id_company = c.id
                WHERE
                    o.id_shipment = $params[id] $queryS
            ") ?: array();

            foreach($offers as $k => $o) {
                switch(intval($o["transport_type"])) {
                    case 1:
                        $dataCov = $this->conn->getRow("SELECT CONCAT(brand, ' ', model, ' - ', domain) AS c_desc, main_photo FROM users_conveyances WHERE id = ?", array(
                            $o["transport_id"]
                        ));
                        $offers[$k]["transport_desc"] = $dataCov["c_desc"];
                        $offers[$k]["transport_img"] = $dataCov["main_photo"];
                    break;
                    case 2:
                        $desc = "-";
                        if($o["transport_id"] == 6) {
                            $desc = "Transporte público";
                        }
                        else if($o["transport_id"] == 7) {
                            $desc = "Transporte Larga Distancia";
                        }
                        $offers[$k]["transport_desc"] = $desc;
                        $offers[$k]["transport_img"] = null;
                    break;
                }
            }

            return $offers;
        }

        function Users_Update_Push_Reg_ID($email, $regId, $devInfo = null) {
            if($regId) {
                $idUPRID = $this->conn->getOne("SELECT id FROM users_push_reg_ids WHERE email = ? AND (dev_platform = '$devInfo[platform]' OR dev_platform IS NULL) AND (dev_model = '$devInfo[model]' OR dev_model IS NULL) AND (dev_version = '$devInfo[version]' OR dev_version IS NULL)", array(
                    $email
                )) ?: 0;
                if($idUPRID > 0) {
                    $this->conn->query("
                        UPDATE 
                            users_push_reg_ids 
                        SET 
                            email = ?,
                            reg_id =  ?,
                            updated_at = ?,
                            dev_platform = ?,
                            dev_model = ?,
                            dev_version = ?,
                            dev_manufacturer = ?,
                            dev_virtual = ?,
                            enabled = 1 
                        WHERE
                            id = ?
                    ", array(
                        $email,
                        $regId,
                        gmdate("Y-m-d H:i:s"),
                        $devInfo ? ($devInfo["platform"] ?: null) : null,
                        $devInfo ? ($devInfo["model"] ?: null) : null,
                        $devInfo ? ($devInfo["version"] ?: null) : null,
                        $devInfo ? ($devInfo["manufacturer"] ?: null) : null,
                        $devInfo ? ($devInfo["isVirtual"] ?: null) : null,
                        $idUPRID
                    ));
                }
                else {
                    $this->conn->query("
                        INSERT INTO users_push_reg_ids (
                            email,
                            reg_id,
                            updated_at,
                            dev_platform,
                            dev_model,
                            dev_version,
                            dev_manufacturer,
                            dev_virtual,
                            enabled
                        )
                        VALUES (
                            ?,
                            ?,
                            ?,
                            ?,
                            ?,
                            ?,
                            ?,
                            ?,
                            ?
                        )
                    ", array(
                        $email,
                        $regId,
                        gmdate("Y-m-d H:i:s"),
                        $devInfo ? ($devInfo["platform"] ?: null) : null,
                        $devInfo ? ($devInfo["model"] ?: null) : null,
                        $devInfo ? ($devInfo["version"] ?: null) : null,
                        $devInfo ? ($devInfo["manufacturer"] ?: null) : null,
                        $devInfo ? ($devInfo["isVirtual"] ?: null) : null,
                        1
                    ));
                }
            }
        }

        function Users_Clear_Login_Info($info) {
            $this->conn->query("UPDATE users_push_reg_ids SET `enabled` = 0, updated_at = NOW() WHERE email = '$info[email]' AND reg_id = '$info[reg_id]'");
            return true;
        }

        function Users_Save_Driver_License($info) {
            if(isset($_FILES["license"])) {
                $ext = @explode("/", $_FILES["license"]["type"])[1];
                $pic = "$info[id]_dlic.$ext";
                @unlink("uploads/users/" . $this->conn->getOne("SELECT drivers_license FROM users WHERE id = ?", array(
                    $info["id"]
                )) ?: $pic);
                @move_uploaded_file($_FILES["license"]["tmp_name"], "uploads/users/$pic");
                $this->conn->query("
                    UPDATE users SET drivers_license = ? WHERE id = ?
                ", array(
                    $pic,
                    $info["id"]
                ));
                return array(
                    "drivers_license" => $pic
                );
            }
            return null;
        }

        function Users_Remove_Driver_License($info) {
            @unlink("uploads/users/" . $this->conn->getOne("SELECT drivers_license FROM users WHERE id = ?", array(
                $info["id"]
            )) ?: "dummy");
            $this->conn->query("
                UPDATE users SET drivers_license = NULL WHERE id = ?
            ", array(
                $info["id"]
            ));
            return $this->conn->getOne("SELECT drivers_license FROM users WHERE id = ?", array(
                $info["id"]
            )) === null;
        }

        function Users_Save_Conveyance($info) {
            $this->conn->query("
                INSERT INTO users_conveyances (
                    id_user, 
                    type, 
                    brand, 
                    model, 
                    year, 
                    domain
                )
                VALUES (
                    ?, 
                    ?, 
                    ?, 
                    ?, 
                    ?, 
                    ?
                )
            ", array(
                $info["id"],
                $info["type"],
                $info["brand"],
                $info["model"],
                $info["year"],
                $info["domain"]
            ));
            $lastId = $this->conn->getInsertID();
            if($lastId > 0) {
                if(isset($_FILES["main_photo"])) {
                    $ext = @explode("/", $_FILES["main_photo"]["type"])[1];
                    $pic = $lastId . "_mpic.$ext";
                    @move_uploaded_file($_FILES["main_photo"]["tmp_name"], "uploads/conveyances/$pic");
                    $this->conn->query("
                        UPDATE users_conveyances SET main_photo = ? WHERE id = ?
                    ", array(
                        $pic,
                        $lastId
                    ));
                }
                if(isset($_FILES["identification_card"])) {
                    $ext = @explode("/", $_FILES["identification_card"]["type"])[1];
                    $pic = $lastId . "_cid.$ext";
                    @move_uploaded_file($_FILES["identification_card"]["tmp_name"], "uploads/conveyances/$pic");
                    $this->conn->query("
                        UPDATE users_conveyances SET identification_card = ? WHERE id = ?
                    ", array(
                        $pic,
                        $lastId
                    ));
                }
                if(isset($_FILES["insurance_policy"])) {
                    $ext = @explode("/", $_FILES["insurance_policy"]["type"])[1];
                    $pic = $lastId . "_secp.$ext";
                    @move_uploaded_file($_FILES["insurance_policy"]["tmp_name"], "uploads/conveyances/$pic");
                    $this->conn->query("
                        UPDATE users_conveyances SET insurance_policy = ? WHERE id = ?
                    ", array(
                        $pic,
                        $lastId
                    ));
                }
                return $this->Users_Get_Conveyances(array(
                    "idc" => $lastId
                ));
            }
            return null;
        }

        function Users_Get_Conveyances($info) {
            $conv = isset($info["idc"]) ? ($this->conn->getRow("SELECT * FROM users_conveyances WHERE id = ?", array(
                $info["idc"]
            )) ?: array()) : ($this->conn->getAll("SELECT * FROM users_conveyances WHERE id_user = ? ORDER BY id DESC", array(
                $info["id"]
            )) ?: array());
            if(isset($conv[0])) {
                foreach($conv as $i => $c) {
                    $conv[$i]["type_desc"] = "-";
                    switch(intval($c["type"])) {
                        case 1:
                            $conv[$i]["type_desc"] = "Auto";
                        break;
                        case 2:
                            $conv[$i]["type_desc"] = "Moto";
                        break;
                        case 3:
                            $conv[$i]["type_desc"] = "Bicicleta";
                        break;
                        case 4:
                            $conv[$i]["type_desc"] = "Camioneta";
                        break;
                        case 5:
                            $conv[$i]["type_desc"] = "Camión";
                        break;
                        case 8:
                            $conv[$i]["type_desc"] = "Avión";
                        break;
                    }
                }
            }
            else if(isset($conv["type"])) {
                $conv["type_desc"] = "-";
                if(isset($conv["type"])) {
                    switch(intval($conv["type"])) {
                        case 1:
                            $conv["type_desc"] = "Auto";
                        break;
                        case 2:
                            $conv["type_desc"] = "Moto";
                        break;
                        case 3:
                            $conv["type_desc"] = "Bicicleta";
                        break;
                        case 4:
                            $conv["type_desc"] = "Camioneta";
                        break;
                        case 5:
                            $conv["type_desc"] = "Camión";
                        break;
                        case 8:
                            $conv["type_desc"] = "Avión";
                        break;
                    }
                }
            }
            else {
                $conv = array();
            }
            return $conv;
        }

        function Users_Remove_Picture_Conveyance($info) {
            @unlink("uploads/conveyances/" . $this->conn->getOne("SELECT $info[target] FROM users_conveyances WHERE id = ?", array(
                $info["id"]
            )) ?: "dummy");
            $this->conn->query("
                UPDATE users_conveyances SET $info[target] = NULL WHERE id = ?
            ", array(
                $info["id"]
            ));
            return $this->Users_Get_Conveyances(array(
                "id" => $info["id_user"]
            ));
        }

        function Users_Remove_Conveyance($info) {
            $pics = $this->conn->getRow("SELECT main_photo, identification_card, insurance_policy FROM users_conveyances WHERE id = ?", array(
                $info["id"]
            )) ?: null;
            if($pics) {
                @unlink("uploads/conveyances/$pics[main_photo]");
                @unlink("uploads/conveyances/$pics[identification_card]");
                @unlink("uploads/conveyances/$pics[insurance_policy]");
            }
            $this->conn->query("DELETE FROM users_conveyances WHERE id = ?", array(
                $info["id"]
            ));
            return $this->conn->getOne("SELECT id FROM users_conveyances WHERE id = ?", array(
                $info["id"]
            )) === false;
        }

        function Users_Update_Picture_Conveyance($info) {
            @unlink("uploads/conveyances/" . $this->conn->getOne("SELECT $info[target] FROM users_conveyances WHERE id = ?", array(
                $info["id"]
            )) ?: "dummy");
            $ext = @explode("/", $_FILES[$info["target"]]["type"])[1];
            $pic = $info["id"] . "_" . $info["target_id"] . ".$ext";
            @move_uploaded_file($_FILES[$info["target"]]["tmp_name"], "uploads/conveyances/$pic");
            $this->conn->query("
                UPDATE users_conveyances SET $info[target] = ? WHERE id = ?
            ", array(
                $pic,
                $info["id"]
            ));
            return $this->Users_Get_Conveyances(array(
                "idc" => $info["id"]
            ));
        }

        function Users_Ratings($params) {
            if(isset($params["type"])) {
                switch($params["type"]) {
                    /*
                    $userInfo["returns_count"] = intval($this->conn->getOne("
                        SELECT
                            COUNT(*) 
                        FROM
                            users AS u
                        INNER JOIN 
                            shipments_offers AS o ON u.id = o.id_user 
                        INNER JOIN shipments AS s ON o.id_shipment = s.id
                        WHERE 
                            u.id = $userInfo[id] AND o.accepted_at IS NOT NULL AND s.id_status = 7
                    "));
                    $userInfo["shipping_count"] = intval($this->conn->getOne("
                        SELECT
                            COUNT(*) 
                        FROM
                            users AS u 
                        INNER JOIN shipments AS s ON u.id = s.id_user
                        WHERE 
                            u.id = $userInfo[id]
                    "));
                    */
                    case 'deliveries': // Envios que he entregado
                        return $this->conn->getAll("
                            SELECT
                                s.id,
                                u.avatar AS user_avatar,
                                r.rating,
                                r.comments,
                                r.register_at,
                                pt.`name` AS name_product_type 
                            FROM
                                shipments_offers AS o
                            INNER JOIN 
                                shipments AS s ON o.id_shipment = s.id 
                            INNER JOIN 
                                product_types AS pt ON s.id_product_type = pt.id 
                            INNER JOIN 
                                users_ratings AS r ON (s.id = r.id_shipment AND r.id_user = ?) 
                            INNER JOIN 
                                users AS u ON s.id_user = u.id
                            WHERE
                                o.id_user = ? AND o.accepted_at IS NOT NULL AND s.id_status = 5 ORDER BY r.id DESC
                        ", array(
                            $params["id"],
                            $params["id"]
                        )) ?: array();
                    break;
                    case 'shipping': // Envios que he creado y han sido entregados
                        return $this->conn->getAll("
                        SELECT
                            s.id,
                            u.avatar AS user_avatar,
                            r.rating,
                            r.comments,
                            r.register_at,
                            pt.`name` AS name_product_type 
                        FROM
                            shipments_offers AS o
                        INNER JOIN 
                            shipments AS s ON o.id_shipment = s.id 
                        INNER JOIN 
                            product_types AS pt ON s.id_product_type = pt.id 
                        INNER JOIN 
                            users_ratings AS r ON (s.id = r.id_shipment AND r.id_user = ?) 
                        INNER JOIN 
                            users AS u ON o.id_user = u.id
                        WHERE
                            s.id_user = ? AND s.id_status = 5 ORDER BY r.id DESC
                    ", array(
                        $params["id"],
                        $params["id"]
                    )) ?: array();
                    break;
                    case 'returns': // Envios donde ha habido devolución
                        return array();
                    break;
                }
            }
            else {
                return $this->conn->getAll("
                    SELECT
                        u.avatar AS user_avatar,
                        r.rating,
                        r.comments,
                        r.register_at,
                        pt.`name` AS name_product_type 
                    FROM
                        users_ratings AS r
                        INNER JOIN users AS u ON r.id_user = u.id
                        INNER JOIN shipments AS s ON r.id_shipment = s.id
                        INNER JOIN product_types AS pt ON s.id_product_type = pt.id 
                    WHERE
                        r.id_user = ? ORDER BY r.id DESC
                ", array(
                    $params["id"]
                )) ?: array();
            }
        }

        function Users_Update_Settings_Rates($params) {
            if(!isset($params["offers"]["max"])) {
                $params["offers"] = array(
                    "max" => null
                );
            }
            $this->conn->query("
                UPDATE users_settings SET rate_base_price_enabled = ?, rate_base_price = ?, rate_price_km_enabled = ?, rate_price_km = ?, rate_percent_night_schedule_enabled = ?, rate_percent_night_schedule = ?, rate_percent_non_business_day_enabled = ?, rate_percent_non_business_day = ?, shipments_max_offers = ? WHERE user_id = ?
            ", array(
                $params["pb"]["enabled"] ? 1 : 0,
                $params["pb"]["value"],
                $params["ppkm"]["enabled"] ? 1 : 0,
                $params["ppkm"]["value"],
                $params["pns"]["enabled"] ? 1 : 0,
                $params["pns"]["value"],
                $params["pnbd"]["enabled"] ? 1 : 0,
                $params["pnbd"]["value"],
                $params["offers"]["max"],
                $params["id_user"]
            ));
            return $this->Users_Get_Settings($params["id_user"]);
        }

        function Users_Send_Reset_Password_Code($params) {
            $idUser = $this->conn->getOne("SELECT id FROM users WHERE email = ?", array(
                $params["email"]
            )) ?: null;
            if($idUser != null) {
                require_once 'Utils.php';
                $code = rand(1000, 9999);
                $this->conn->query("UPDATE users SET pwd_reset_code = ? WHERE id = ?", array(
                    $code,
                    $idUser
                ));
                return Send_Mail($params["email"], "Reestablecer contraseña", "Código de reestablecimiento: $code");
            }
            return false;
        }

        function Users_Check_Code_Reset_Password($params) {
            return $this->conn->getOne("SELECT pwd_reset_code FROM users WHERE email = ?", array(
                $params["email"]
            )) == $params["code"];
        }

        function Users_Send_Email_Verification_Code($params) {
            require_once 'Utils.php';
            $code = rand(1000, 9999);
            $this->conn->query("DELETE FROM users_email_verification WHERE email = ?", array(
                $params["email"]
            ));
            $this->conn->query("INSERT INTO users_email_verification (email, code) VALUES(?, ?)", array(
                $params["email"],
                $code
            ));
            return Send_Mail($params["email"], "Verificar email", "Código de verificación: $code");
        }
    
        function Users_Check_Email_Verification_Code($params) {
            return $this->conn->getOne("SELECT code FROM users_email_verification WHERE email = ?", array(
                $params["email"]
            )) == $params["code"];
        }

        function Users_Reset_Password($params) {
            $this->conn->query("UPDATE users SET `password` = ? WHERE email = ?", array(
                createPassword($params["password"]),
                $params["email"]
            ));
            return true;
        }

        function Users_Shipments_Offers($params) {
            $sqlCond = "";
            switch(intval($params["filters"]["group"])) {
                case 1:
                    $sqlCond = "AND o.accepted_at IS NULL AND s.id_status IS NULL AND shipment_is_expired(s.id) != 1";
                break;
                case 2:
                    $sqlCond = "AND (s.id_status IS NULL AND s.max_arrival_date IS NOT NULL AND shipment_is_expired(s.id) = 1)";
                break;
                case 3:
                    $sqlCond = "AND o.accepted_at IS NOT NULL";
                break;
                case 4:
                    $sqlCond = "AND (s.id_status IS NOT NULL AND o.accepted_at IS NULL)";
                break;
            }
            //echo $sqlCond; die();
            $offers = $this->conn->getAll("
                SELECT
                    s.*,
                    o.id AS offer_id,
                    o.offer,
                    o.registered_at AS offer_registered_at,
                    o.accepted_at AS offer_accepted_at,
                    o.estimated_arrival_date AS offer_estimated_arrival_date,
                    o.approximate_arrival_value AS offer_approximate_arrival_value,
                    o.approximate_arrival_desc AS offer_approximate_arrival_desc,
                    o.approximate_distance_value AS offer_approximate_distance_value,
                    o.approximate_distance_desc AS offer_approximate_distance_desc,
                    o.transport_id AS offer_transport_id,
                    o.transport_type AS offer_transport_type
                FROM
                    shipments_offers AS o INNER JOIN shipments AS s ON o.id_shipment = s.id
                INNER JOIN 
                    users AS u ON u.id = o.id_user LEFT JOIN shipments_offers_deleted AS od ON o.id = od.id_offer
                WHERE
                    o.id_user = ? AND od.id IS NULL $sqlCond
            ", array(
                $params["id"]
            )) ?: array();
            $shipments = array();
            $k = 0;
            foreach($offers as $s) {
                $ratings = $this->conn->getAll("
                    SELECT * FROM users_ratings WHERE id_shipment = ?
                ", array(
                    $s["id"]
                )) ?: array();
                $pendingRate = false;
                $band = $s["id_status"] != 7;
                if($s["id_status"] == 5) {
                    switch(count($ratings)) {
                        case 0:
                            $pendingRate = true;
                        break;
                        case 1:
                            if($ratings[0]["id_user"] == $params["id"]) {
                                $pendingRate = true;
                            }
                        break;
                        case 2:
                            $band = false;
                        break;
                    }
                }
                $shipments[$k] = $this->Shipments_Get_Standard_Additional_Info($s);
                $shipments[$k]["ratings"] = $ratings;
                $shipments[$k]["pending_rate"] = $pendingRate;
                $k++;
            }
            return $shipments;
        }

        function Users_Shipments_Offers_Delete($params) {
            switch($params["type"]) {
                case 'active':
                    $this->conn->query("DELETE FROM shipments_offers WHERE id = ?", array(
                        $params["id"]
                    ));
                    $this->_Send_Data_NJS(array(
                        'action' => 'reversed offer',
                        'data' => array(
                            'id' => $params["id"]
                        )
                    ));
                    return true;
                break;
                case 'expired':
                case 'confirmed':
                case 'rejected':
                    $this->conn->query("INSERT INTO shipments_offers_deleted (id_offer, deleted_at) VALUES (?, ?)", array(
                        $params["id"],
                        gmdate("Y-m-d H:i:s")
                    ));
                    return $this->conn->getInsertID() > 0;
                break;
            }
        }

        function Chats_Conversations_List($info) {
            $chatDetailsMode = array_key_exists("otherId", $info);
            $query = "";
            if($chatDetailsMode) {
                $query = "
                    SELECT
                        *
                    FROM
                        chats
                    WHERE
                        (id_transmitter = $info[id] AND id_receiver = $info[otherId]) OR (id_transmitter = $info[otherId] AND id_receiver = $info[id])
                    ORDER BY IFNULL(transmitter_date_sent, receiver_date_sent) ASC
                ";
            }
            else {
                $query = "
                    SELECT
                        *
                    FROM
                        chats
                    WHERE
                        id_transmitter = $info[id] OR id_receiver = $info[id]
                    ORDER BY IFNULL(transmitter_date_sent, receiver_date_sent) ASC
                ";
            }
            $chat = $this->conn->getAll($query) ?: array();
            $listReceipts = array();
            $conversations = array();
            foreach($chat as $r) {
                if($info["id"] == $r["id_transmitter"]) {
                    if(!in_array($r["id_receiver"], $listReceipts)) {
                        $listReceipts[] = $r["id_receiver"];
                    }
                }
                if($info["id"] == $r["id_receiver"]) {
                    if(!in_array($r["id_transmitter"], $listReceipts)) {
                        $listReceipts[] = $r["id_transmitter"];
                    }
                }
            }
            if(array_key_exists("onlyFirstMessage", $info)) {
                foreach($listReceipts as $r) {
                    if(!isset($conversations[$r])) {
                        $uInfo = $this->Users_Get_Info($r, "id");
                        $conversations[$r] = array(
                            "user_info" => array(
                                "id" => $uInfo["id"],
                                "avatar" => $uInfo["avatar"],
                                "display_name" => $uInfo["display_name"],
                                "email" => $uInfo["email"]
                            ),
                            "messages" => array()
                        );
                    }
                    foreach($chat as $m) {
                        if($m["id_transmitter"] == $r || $m["id_receiver"] == $r) {
                            $field = null;
                            if($m["transmitter_date_sent"] != null) {
                                if($m["id_transmitter"] == $info["id"]) {
                                    $field = "archived_transmitter";
                                }
                                else {
                                    $field = "archived_receiver";
                                }
                            }
                            else if($m["receiver_date_sent"] != null) {
                                if($m["id_receiver"] == $info["id"]) {
                                    $field = "archived_transmitter";
                                }
                                else {
                                    $field = "archived_receiver";
                                }
                            }
                            $m["archived"] = $field && $m[$field] == 1;
                            unset($m["archived_transmitter"]);
                            unset($m["archived_receiver"]);
                            $conversations[$r]["messages"] = array($m);
                        }
                    }
                }
            }
            else {
                foreach($listReceipts as $r) {
                    if(!isset($conversations[$r])) {
                        $uInfo = $this->Users_Get_Info($r, "id");
                        $conversations[$r] = array(
                            "user_info" => array(
                                "id" => $uInfo["id"],
                                "avatar" => $uInfo["avatar"],
                                "display_name" => $uInfo["display_name"],
                                "email" => $uInfo["email"]
                            ),
                            "messages" => array()
                        );
                    }
                    foreach($chat as $m) {
                        if($m["id_transmitter"] == $r || $m["id_receiver"] == $r) {
                            $conversations[$r]["messages"][] = $m;
                        }
                    }
                }
            }
            return empty($conversations) ? array() : ($chatDetailsMode ? $conversations[$info["otherId"]]["messages"] : $conversations);
        }
    
        function Chats_Get_Conversation($info) {
            $sql = "
                SELECT
                    t.*, 
                    u.id AS receiver_id,
                    IFNULL(u.fullname, SUBSTRING_INDEX(u.email, '@', 1)) AS receiver_display_name,
                    u.avatar AS receiver_avatar
                FROM
                    (
                        SELECT
                            c.id,
                            c.id_transmitter,
                            c.id_receiver,
                            IFNULL(u.fullname, SUBSTRING_INDEX(u.email, '@', 1)) AS transmitter_display_name,
                            u.avatar AS transmitter_avatar,
                            c.transmitter_date_sent,
                            c.transmitter_date_reading,
                            c.receiver_date_sent,
                            c.receiver_date_reading,
                            c.message,
                            c.attachment_file,
                            c.attachment_group
                        FROM
                            chats AS c
                        INNER JOIN users AS u ON c.id_transmitter = u.id
                        WHERE
                            (
                                c.id_transmitter = $info[u1]
                                AND c.id_receiver = $info[u2]
                            )
                        OR (
                            c.id_transmitter = $info[u2]
                            AND c.id_receiver = $info[u1]
                        )
                    ) AS t
                INNER JOIN users AS u ON t.id_receiver = u.id
            ";
            return $this->conn->getAll($sql) ?: array();
        }
    
        function Chats_Archivate($info) {
            $infoMessage = $this->conn->getRow("SELECT * FROM chats WHERE id = ?", array(
                $info["id"]
            ));
            $infoMessageF = $this->conn->getRow("SELECT * FROM chats WHERE (id_transmitter = ? AND id_receiver = ?) OR (id_transmitter = ? AND id_receiver = ?) LIMIT 1", array(
                $infoMessage["id_transmitter"],
                $infoMessage["id_receiver"],
                $infoMessage["id_receiver"],
                $infoMessage["id_transmitter"]
            ));

            $field = "";
            if($infoMessageF["transmitter_date_sent"] != null) {
                if($infoMessageF["id_transmitter"] == $info["id_user"]) {
                    $field = "archived_transmitter";
                }
                else {
                    $field = "archived_receiver";
                }
            }
            else if($infoMessageF["receiver_date_sent"] != null) {
                if($infoMessageF["id_receiver"] == $info["id_user"]) {
                    $field = "archived_receiver";
                }
                else {
                    $field = "archived_transmitter";
                }
            }
            /*var_dump($field);
            die();*/
            $this->conn->query("
                UPDATE chats SET $field = ? WHERE id = ?
            ", array(
                $info["archive"],
                $info["id"]
            ));
            return true;
        }

        function Chats_Send_Attachment($info) {
            $rowInfo = $this->conn->getRow("SELECT * FROM chats WHERE id_transmitter = ? OR id_receiver = ? LIMIT 1", array(
                $info["id_transmitter"],
                $info["id_transmitter"]
            ));
            $senderDisplayName = $this->conn->getOne("SELECT IFNULL(fullname, SUBSTRING_INDEX(email, '@', 1)) AS display_name FROM users WHERE id = ?", array(
                $info["id_transmitter"]
            )) ?: '';
            $dt = gmdate("Y-m-d H:i:s");
            $idsSent = array();
            for($i = 0; $i < count($_FILES); $i++) {
                $ext = @explode("/", $_FILES["attachment"]["type"][$i])[1];
                $filename = $info["uid"] . "_1.$ext";
                move_uploaded_file($_FILES["attachment"]["tmp_name"][$i], "uploads/chats/$filename");
                $queryData = array(
                    $info["id_transmitter"], 
                    $info["id_receiver"],
                    null, 
                    null, 
                    null, 
                    null,
                    null,
                    $filename,
                    $info["uid"]
                );
                if($rowInfo) {
                    if($rowInfo["id_transmitter"] == $info["id_receiver"]) {
                        $queryData[5] = $dt;
                    }
                    else {
                        $queryData[3] = $dt;
                    }
                }
                else {
                    $queryData[3] = $dt;
                }
                $this->conn->query("
                    INSERT INTO chats (
                        id_transmitter, 
                        id_receiver, 
                        message,
                        transmitter_date_sent, 
                        transmitter_date_reading, 
                        receiver_date_sent, 
                        receiver_date_reading, 
                        attachment_file, 
                        attachment_group
                    ) VALUES (
                        ?, 
                        ?, 
                        ?, 
                        ?, 
                        ?, 
                        ?, 
                        ?, 
                        ?, 
                        ?
                    )
                ", $queryData);
                $lastId = $this->conn->getInsertID();
                if($lastId > 0) {
                    $idsSent[] = $lastId;
                }
            }
            $messagesSent = $this->conn->getAll("SELECT * FROM chats WHERE id IN (" . implode(",", $idsSent) . ") ORDER BY id DESC") ?: null;
            if($messagesSent) {
                foreach($messagesSent as $m) {
                    $this->_Send_Data_NJS(array(
                        'action' => 'chat new message',
                        'data' => array(
                            'to' => array(
                                'id' => $info["id_receiver"]
                            ),
                            'from' => array(
                                'display_name' => $senderDisplayName
                            ),
                            'message' => $m
                        )
                    ));
                }
            }
            return $messagesSent;
        }

        function Send_Push_Notification($params) {
            if(!is_array($params["to"])) {
                $params["to"] = array($params["to"]);
            }
            $usersRegIds = $this->conn->getALL("SELECT users_push_reg_ids.reg_id FROM users INNER JOIN users_push_reg_ids ON users.email = users_push_reg_ids.email WHERE users.id IN (?) AND users_push_reg_ids.enabled = 1", array(
                implode(",", $params["to"])
            )) ?: array();
            if(!empty($usersRegIds)) {
                require_once 'Utils.php';
                $usersRegIds = array_map(function($row) {
                    return $row["reg_id"];
                }, $usersRegIds);
                return json_decode(Send_Push($params["title"], $params["message"], $usersRegIds), true);
            }
            return array();
        }
    }
?>