<?php
    require_once 'Config.php';
    require_once 'Password.php';
    require_once 'DbHandler.php';

    class DbHandlerAdm {
        private $conn;
        function __construct() {
            require_once dirname(__FILE__) . '/DbConnect.php';
            $db = new DbConnect();
            $this->conn = $db->connect();
        }

        function _Send_Data_NJS($info) {
            require_once './vendor/autoload.php';
            require_once './vendor/predis/predis/autoload.php';
            Predis\Autoloader::register();
            $client = new Predis\Client('tcp://127.0.0.1:6379');
            $client->publish("nviame", json_encode($info));
        }

        function Shipments_Get_List($filters) {
            $dbHApp = new DbHandler();
            $sqlW = "";
            if(isset($filters["filter"])) {
                switch($filters["filter"]) {
                    case 'delivered':
                        if($sqlW) {
                            $sqlW .= " AND s.id_status = 5";
                        }
                        else {
                            $sqlW .= "WHERE s.id_status = 5";
                        }
                    break;
                    case 'refunded':
                        if($sqlW) {
                            $sqlW .= " AND s.id_status = 7";
                        }
                        else {
                            $sqlW .= "WHERE s.id_status = 7";
                        }
                    break;
                    case 'on-travel':
                        $sqlW2 = "";
                        if($sqlW) {
                            $sqlW .= " AND s.id_status = 4";
                        }
                        else {
                            $sqlW .= "WHERE s.id_status = 4";
                        }
                    break;
                }
            }
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
                GROUP BY
                    s.id
                ORDER BY
                    s.id DESC
            ") ?: array();
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
                            /*if($ratings[0]["id_user"] != $info["user_id"]) {
                                $band = false;
                            }
                            else {
                                $pendingRate = true;
                            }*/
                        break;
                        case 2:
                            $band = false;
                        break;
                    }
                }
                if($band) {
                    $shipments[$k] = $dbHApp->Shipments_Get_Standard_Additional_Info($s);
                    $shipments[$k]["ratings"] = $ratings;
                    $shipments[$k]["pending_rate"] = $pendingRate;
                }
            }
            return $shipments;
            /*$shipments = array();
            $sqlW = "";
            $sqlW2 = " AND u.disabled != 1";
            if(isset($filters["company"])) {
                $sqlW .= "WHERE u.id_company = $filters[company]";
            }
            if(isset($filters["filter"])) {
                switch($filters["filter"]) {
                    case 'unverified':
                        if($sqlW) {
                            $sqlW .= " AND u.verified != 1";
                        }
                        else {
                            $sqlW .= "WHERE u.verified != 1";
                        }
                    break;
                    case 'verified':
                        if($sqlW) {
                            $sqlW .= " AND u.verified = 1";
                        }
                        else {
                            $sqlW .= "WHERE u.verified = 1";
                        }
                    break;
                    case 'disabled':
                        $sqlW2 = "";
                        if($sqlW) {
                            $sqlW .= " AND u.disabled = 1";
                        }
                        else {
                            $sqlW .= "WHERE u.disabled = 1";
                        }
                    break;
                }
            }
            if($sqlW == "") {
                $sqlW = "WHERE u.disabled != 1";
                $sqlW2 = "";
            }
            $data = $this->conn->getAll("
                
            ") ?: array();
            foreach($data as $row) {
                $shipments[] = array(
                    "id" => $row["id"],
                    "avatar" => $row["avatar"],
                    "dni_front" => $row["dni_front"],
                    "dni_back" => $row["dni_back"],
                    "verified" => $row["verified"],
                    "display_name" => $row["display_name"],
                    "email" => $row["email"],
                    "rating" => $row["overall_rating"],
                    "locality" => $row["last_location_locality"],
                    "region" => $row["last_location_region"],
                    "country" => $row["last_location_country"],
                    "count_push_devices" => $row["count_push_devices"],
                    "summary" => array(
                        "shipments" => $row["count_shipments"],
                        "deliveries" => $row["count_shipments_deliveries"],
                        "returns" => $row["count_shipments_returns"]
                    )
                );
            }
            return $users;*/
        }

        function Users_Add($info) {
            $dbHApp = new DbHandler();
            return $dbHApp->User_Register($info);
        }

        function Users_Update($info) {
            $dbHApp = new DbHandler();
            $info["__adm"] = 1;
            $info["id"] = $info["i"];
            return $dbHApp->Users_Update_Info($info);
        }

        function Users_Get_List($filters) {
            $users = array();
            $sqlW = "";
            $sqlW2 = " AND u.disabled != 1";
            if(isset($filters["company"])) {
                $sqlW .= "WHERE u.id_company = $filters[company]";
            }
            if(isset($filters["filter"])) {
                switch($filters["filter"]) {
                    case 'unverified':
                        if($sqlW) {
                            $sqlW .= " AND u.verified != 1";
                        }
                        else {
                            $sqlW .= "WHERE u.verified != 1";
                        }
                    break;
                    case 'verified':
                        if($sqlW) {
                            $sqlW .= " AND u.verified = 1";
                        }
                        else {
                            $sqlW .= "WHERE u.verified = 1";
                        }
                    break;
                    case 'disabled':
                        $sqlW2 = "";
                        if($sqlW) {
                            $sqlW .= " AND u.disabled = 1";
                        }
                        else {
                            $sqlW .= "WHERE u.disabled = 1";
                        }
                    break;
                }
            }
            if($sqlW == "") {
                $sqlW = "WHERE u.disabled != 1";
                $sqlW2 = "";
            }
            $cond = "$sqlW $sqlW2";
            if(isset($filters["type"])) {
                if($filters["type"] == "user") {
                    if(strstr($cond, "WHERE")) {
                        $cond = "$cond AND c.id IS NULL";
                    }
                    else {
                        $cond = "$cond WHERE c.id IS NULL";
                    }
                }
                elseif($filters["type"] == "commerce") {
                    if(strstr($cond, "WHERE")) {
                        $cond = "$cond AND c.id IS NOT NULL";
                    }
                    else {
                        $cond = "$cond WHERE c.id IS NOT NULL";
                    }
                }
            }
            $data = $this->conn->getAll("
                SELECT
                    u.id,
                    u.avatar,
                    c.logo,
                    c.name AS pcommerce,
                    u.dni_front,
                    u.dni_back,
                    u.avatar,
                    IFNULL( u.fullname, SUBSTRING_INDEX( u.email, '@', 1 )) AS display_name,
                    u.email,
                    u.overall_rating,
                    u.last_location_locality,
                    u.last_location_region,
                    u.last_location_country,
                    u.verified,
                    u.commission,
                    (
                        SELECT
                            COUNT(*) 
                        FROM
                            shipments AS s 
                        WHERE
                            s.id_user = u.id
                    ) AS count_shipments,
                    (
                        SELECT
                            COUNT(*) 
                        FROM
                            shipments AS s
                        INNER JOIN 
                            shipments_offers AS o ON ( s.id = o.id_shipment AND o.accepted_at IS NOT NULL ) 
                        WHERE
                            o.id_user = u.id AND s.id_status = 5
                    ) AS count_shipments_deliveries,
                    (
                        SELECT
                            COUNT(*) 
                        FROM
                            shipments AS s
                        INNER JOIN 
                            shipments_offers AS o ON ( s.id = o.id_shipment AND o.accepted_at IS NOT NULL ) 
                        WHERE
                            o.id_user = u.id AND s.id_status = 6
                    ) AS count_shipments_returns,
                    (
                        SELECT
                            COUNT(*) 
                        FROM
                            users_push_reg_ids AS p
                        WHERE
                            p.email = u.email
                    ) AS count_push_devices 
                FROM
                    users AS u 
                LEFT JOIN 
                    commerces AS c ON u.id = c.id_user $cond
                ORDER BY
                    u.id DESC
            ") ?: array();
            foreach($data as $row) {
                $users[] = array(
                    "id" => $row["id"],
                    "avatar" => $row["avatar"],
                    "logo" => $row["logo"],
                    "pcommerce" => $row["pcommerce"],
                    "dni_front" => $row["dni_front"],
                    "dni_back" => $row["dni_back"],
                    "verified" => $row["verified"],
                    "display_name" => $row["display_name"],
                    "email" => $row["email"],
                    "rating" => $row["overall_rating"],
                    "locality" => $row["last_location_locality"],
                    "region" => $row["last_location_region"],
                    "country" => $row["last_location_country"],
                    "count_push_devices" => $row["count_push_devices"],
                    "summary" => array(
                        "shipments" => $row["count_shipments"],
                        "deliveries" => $row["count_shipments_deliveries"],
                        "returns" => $row["count_shipments_returns"]
                    )
                );
            }
            usort($users, function ($a, $b) {
                return $b['id'] - $a['id'];
            });
            return array_values($users);
        }

        function Users_Toggle_Verification($userId) {
            $this->conn->query("UPDATE users SET verified = 1 - verified WHERE id = ?", array(
                $userId
            ));
            $this->_Send_Data_NJS(array(
                'action' => 'user verification',
                'data' => array(
                    'id_user' => $userId,
                    'verified' => $this->conn->getOne("SELECT verified FROM users WHERE id = ?", array(
                        $userId
                    )) == 1
                )
            ));
            return "OK";
        }

        function Users_Toggle_Disabled($userId) {
            $this->conn->query("UPDATE users SET `disabled` = 1 - `disabled` WHERE id = ?", array(
                $userId
            ));
            $this->_Send_Data_NJS(array(
                'action' => 'user disabled',
                'data' => array(
                    'id_user' => $userId,
                    'disabled' => $this->conn->getOne("SELECT `disabled` FROM users WHERE id = ?", array(
                        $userId
                    )) == 1
                )
            ));
            return "OK";
        }

        function Users_Send_Push($params) {
            if(count($params["u"]) == 1 && !$params["u"][0] > 0) {
                $params["u"] = "*";
            }
            $this->_Send_Data_NJS(array(
                'action' => 'push notification',
                'data' => array(
                    'to' => $params["u"],
                    'title' => $params["t"],
                    'content' => $params["c"],
                    'debug' => isset($params["debug"]) && $params["debug"] == 1
                )
            ));
            return true;
        }

        function Users_Get_Details($idUser) {
            $dbHApp = new DbHandler();
            $userInfo = $this->conn->getRow("
                SELECT *, IFNULL(fullname, SUBSTRING_INDEX(email, '@', 1)) AS display_name FROM users WHERE id = ?
            ", array($idUser)) ?: null;
            if($userInfo) {
                $userInfo["profile_completed"] = $dbHApp->Users_Check_Completed_Profile($userInfo);
                $userInfo["settings"] = $dbHApp->Users_Get_Settings($userInfo["id"]);
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
                        users.postal_code AS info_postal_code,
                        users.home_address AS info_home_address
                    FROM
                        users_mp INNER JOIN users ON users_mp.id_user = users.id 
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
                    $userInfo["settings"]["percent_commission"] = $userInfo["company"]["percent_commission"];
                }
                $userInfo["wallet"] = $dbHApp->Shipments_Wallet_History(array(
                    "start_date" => $userInfo["mp"]["registered_at"],
                    "end_date" => gmdate("Y-m-d H:i:s")
                ));
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
                $userInfo["conveyances"] = $dbHApp->Users_Get_Conveyances(array(
                    "id" => $userInfo["id"]
                ));
                $userInfo["shipments"] = array(
                    "pending" => $dbHApp->Shipments_List_Pending(array(
                        "user_id" => $userInfo["id"],
                        "filters" => array(
                            "type" => 3,
                            "group" => 0
                        )
                    )),
                    "delivered" => $dbHApp->Shipments_List_Pending(array(
                        "user_id" => $userInfo["id"],
                        "filters" => array(
                            "type" => 3,
                            "group" => 1
                        )
                    )),
                    "returns" => $dbHApp->Shipments_List_Pending(array(
                        "user_id" => $userInfo["id"],
                        "filters" => array(
                            "type" => 3,
                            "group" => 2
                        )
                    ))
                );
                $userInfo["deliveries"] = array(
                    "pending" => $dbHApp->Shipments_List_Pending(array(
                        "user_id" => $userInfo["id"],
                        "filters" => array(
                            "type" => 3,
                            "group" => 0,
                            "deliveries_mode" => 1
                        )
                    )),
                    "delivered" => $dbHApp->Shipments_List_Pending(array(
                        "user_id" => $userInfo["id"],
                        "filters" => array(
                            "type" => 3,
                            "group" => 1,
                            "deliveries_mode" => 1
                        )
                    )),
                    "returns" => $dbHApp->Shipments_List_Pending(array(
                        "user_id" => $userInfo["id"],
                        "filters" => array(
                            "type" => 3,
                            "group" => 2,
                            "deliveries_mode" => 1
                        )
                    ))
                );
                $userInfo["offers"] = array(
                    "active" => $dbHApp->Users_Shipments_Offers(array(
                        "id" => $userInfo["id"],
                        "filters" => array(
                            "group" => 1
                        )
                    )),
                    "expired" => $dbHApp->Users_Shipments_Offers(array(
                        "id" => $userInfo["id"],
                        "filters" => array(
                            "group" => 2
                        )
                    )),
                    "confirmed" => $dbHApp->Users_Shipments_Offers(array(
                        "id" => $userInfo["id"],
                        "filters" => array(
                            "group" => 3
                        )
                    )),
                    "rejected" => $dbHApp->Users_Shipments_Offers(array(
                        "id" => $userInfo["id"],
                        "filters" => array(
                            "group" => 4
                        )
                    ))
                );
            }
            return $userInfo;
        }

        function Companies_Get_List($filters) {
            $companies = array();
            $data = $this->conn->getAll("
                SELECT 
                    * 
                FROM 
                    companies 
                ORDER BY
                    registered_at ASC
            ") ?: array();
            foreach($data as $row) {
                $c = "";
                switch(intval($row["id_company_contract_duration"])) {
                    case 1:
                        $c = "Sin contrato";
                    break;
                    case 2:
                        $c = "3 meses";
                    break;
                    case 3:
                        $c = "6 meses";
                    break;
                    case 4:
                        $c = "12 meses";
                    break;
                }
                $companies[] = array(
                    "id" => $row["id"],
                    "name" => $row["name"],
                    "cuit" => $row["cuit"] ?: "",
                    "phone" => $row["phone"] ?: "",
                    "email" => $row["email"] ?: "",
                    "contract" => $c,
                    "contract_id" => $row["id_company_contract_duration"] ?: "",
                    "rate_base_price" => $row["rate_base_price"] ?: "",
                    "rate_price_km" => $row["rate_price_km"] ?: "",
                    "rate_percent_night_schedule" => $row["rate_percent_night_schedule"] ?: "",
                    "rate_percent_non_business_day" => $row["rate_percent_non_business_day"] ?: "",
                    "percent_commission" => $row["percent_commission"] ?: "",
                    "registered_at" => date("d/m/Y, H:i", strtotime($row["registered_at"])) . " h"
                );
            }
            return $companies;
        }

        function Companies_Add($info) {
            $this->conn->query("INSERT INTO companies (id_company_contract_duration, name, cuit, phone, email, rate_base_price, rate_price_km, rate_percent_night_schedule, rate_percent_non_business_day, percent_commission, registered_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", array(
                $info["contract"],
                $info["name"],
                $info["cuit"],
                $info["phone"],
                $info["email"],
                $info["pb"],
                $info["ppkm"],
                $info["pns"],
                $info["pnbd"],
                $info["pcom"],
                gmdate("Y-m-d H:i:s")
            ));
            return $this->conn->getInsertID() > 0;
        }

        function Companies_Update($info) {
            $this->conn->query("UPDATE companies SET id_company_contract_duration = ?, name = ?, cuit = ?, phone = ?, email = ?, rate_base_price = ?, rate_price_km = ?, rate_percent_night_schedule = ?, rate_percent_non_business_day = ?, percent_commission = ? WHERE id = ?", array(
                $info["contract"],
                $info["name"],
                $info["cuit"],
                $info["phone"],
                $info["email"],
                $info["pb"],
                $info["ppkm"],
                $info["pns"],
                $info["pnbd"],
                $info["pcom"],
                $info["i"]
            ));
            return true;
        }

        function Companies_Remove($info) {
            $this->conn->query("DELETE FROM companies WHERE id = ?", array(
                $info["i"]
            ));
            return true;
        }
    }
?>