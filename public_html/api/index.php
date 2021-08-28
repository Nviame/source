<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    define('APP_NAME', 'Nviame');
    define('HOST', 'https://nviame.com');
    define('SOCKET_PORT', '3355');

    date_default_timezone_set('America/Argentina/Buenos_Aires');

    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');

    include_once 'include/Password.php';
    include_once 'include/Config.php';
    require_once 'include/DbHandler.php'; 

    use Psr\Http\Message\ResponseInterface as Response;
    use Psr\Http\Message\ServerRequestInterface as Request;
    use Slim\Factory\AppFactory;
    use Slim\Exception\NotFoundException;

    require __DIR__ . '/vendor/autoload.php';

    $app = AppFactory::create();

    $app->addBodyParsingMiddleware();

    $dbHandler = new DbHandler();
    
    $app->setBasePath((function () {
        $scriptDir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
        $uri = (string) parse_url('http://a' . $_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH);
        if (stripos($uri, $_SERVER['SCRIPT_NAME']) === 0) {
            
            return $_SERVER['SCRIPT_NAME'];
        }
        if ($scriptDir !== '/' && stripos($uri, $scriptDir) === 0) {
            return $scriptDir;
        }
        return '';
    })());

    $app->get('/', function (Request $request, Response $response, $args) {
        $response->getBody()->write(APP_NAME . " API");
        return $response;
    });

    $app->get('/test', function (Request $request, Response $response, $args) {
        $dataResponse = array(
            "status" => "OK"
        );
        $dbHandler = new DbHandler();
        $conn = $dbHandler->getConn();
        
        $list = $conn->getAll("SELECT * FROM users WHERE fullname IS NULL") ?: array();
        foreach($list as $r) {
            $fn = explode("@", $r["email"])[0];
            $conn->query("UPDATE users SET fullname = ? WHERE id = ?", array(
                $fn,
                $r["id"]
            ));
        }

        $response->getBody()->write(
            json_encode($dataResponse)
        );
        return $response->withHeader('Content-Type', 'application/json');
    });

    $app->post('/njs2red', function (Request $request, Response $response, $args) {
        $dataResponse = array(
            "status" => "OK"
        );
        $params = $request->getParsedBody();
        $dbHandler = new DbHandler();
        $dbHandler->_Send_Data_NJS(array(
            'action' => $params["action"],
            'data' => $params["data"]
        ));
        $response->getBody()->write(
            json_encode($dataResponse)
        );
        return $response->withHeader('Content-Type', 'application/json');
    });

    $app->get('/gmak', function (Request $request, Response $response, $args) {
        $dataResponse = array(
            "status" => "OK",
            "data" => array(
                "api_key" => "AIzaSyCiWj9PLdW0zCxe3HzK00xS6YawLIZjBXg"
            )
        );
        $response->getBody()->write(
            json_encode($dataResponse)
        );
        return $response->withHeader('Content-Type', 'application/json');
    });

    $app->get('/a/shipments', function (Request $request, Response $response, $args) {
        require_once 'include/DbHandlerAdm.php';
        $dbHandler = new DbHandlerAdm();
        $params = $request->getQueryParams();
        $dataResponse = array(
            "status" => "OK",
            "data" => $dbHandler->Shipments_Get_List($params)
        );
        $response->getBody()->write(
            json_encode($dataResponse)
        );
        return $response->withHeader('Content-Type', 'application/json');
    });

    $app->get('/a/users', function (Request $request, Response $response, $args) {
        require_once 'include/DbHandlerAdm.php';
        $dbHandler = new DbHandlerAdm();
        $params = $request->getQueryParams();
        $dataResponse = array(
            "status" => "OK",
            "data" => $dbHandler->Users_Get_List($params)
        );
        $response->getBody()->write(
            json_encode($dataResponse)
        );
        return $response->withHeader('Content-Type', 'application/json');
    });

    $app->get('/a/users/{id}', function (Request $request, Response $response, $args) {
        require_once 'include/DbHandlerAdm.php';
        $id = $args['id'];
        $dbHandler = new DbHandlerAdm();
        $params = $request->getQueryParams();
        $dataResponse = array(
            "status" => "OK",
            "data" => $dbHandler->Users_Get_Details($id)
        );
        $response->getBody()->write(
            json_encode($dataResponse)
        );
        return $response->withHeader('Content-Type', 'application/json');
    });

    $app->post('/a/users/add', function (Request $request, Response $response, $args) {
        require_once 'include/DbHandlerAdm.php';
        $dbHandler = new DbHandlerAdm();
        $params = $request->getParsedBody();
        $dataResponse = array(
            "status" => "OK",
            "data" => $dbHandler->Users_Add($params)
        );
        $response->getBody()->write(
            json_encode($dataResponse)
        );
        return $response->withHeader('Content-Type', 'application/json');
    });

    $app->post('/a/users/edit', function (Request $request, Response $response, $args) {
        require_once 'include/DbHandlerAdm.php';
        $dbHandler = new DbHandlerAdm();
        $params = $request->getParsedBody();
        $dataResponse = array(
            "status" => "OK",
            "data" => $dbHandler->Users_Update($params)
        );
        $response->getBody()->write(
            json_encode($dataResponse)
        );
        return $response->withHeader('Content-Type', 'application/json');
    });

    $app->post('/a/users/{id}/toggle_verification', function (Request $request, Response $response, $args) {
        require_once 'include/DbHandlerAdm.php';
        $dbHandler = new DbHandlerAdm();
        $id = $args['id'];
        $params = $request->getParsedBody();
        $dataResponse = array(
            "status" => $dbHandler->Users_Toggle_Verification($id)
        );
        $response->getBody()->write(
            json_encode($dataResponse)
        );
        return $response->withHeader('Content-Type', 'application/json');
    });

    $app->post('/a/users/{id}/toggle_disabled', function (Request $request, Response $response, $args) {
        require_once 'include/DbHandlerAdm.php';
        $dbHandler = new DbHandlerAdm();
        $id = $args['id'];
        $params = $request->getParsedBody();
        $dataResponse = array(
            "status" => $dbHandler->Users_Toggle_Disabled($id)
        );
        $response->getBody()->write(
            json_encode($dataResponse)
        );
        return $response->withHeader('Content-Type', 'application/json');
    });

    $app->post('/a/users/push_notification', function (Request $request, Response $response, $args) {
        require_once 'include/DbHandlerAdm.php';
        $dbHandler = new DbHandlerAdm();
        $params = $request->getParsedBody();
        
        $dataResponse = array(
            "status" => "OK"
        );

        $success = $dbHandler->Users_Send_Push($params);

        if(!$success) {
            $dataResponse["status"] = "ERROR";
            $dataResponse["message"] = "Hubo un problema al enviar las notificaciones.";
        }

        $response->getBody()->write(
            json_encode($dataResponse)
        );
        return $response->withHeader('Content-Type', 'application/json');
    });

    $app->get('/a/companies', function (Request $request, Response $response, $args) {
        require_once 'include/DbHandlerAdm.php';
        $dbHandler = new DbHandlerAdm();
        $params = $request->getQueryParams();
        $dataResponse = array(
            "status" => "OK",
            "data" => $dbHandler->Companies_Get_List($params)
        );
        $response->getBody()->write(
            json_encode($dataResponse)
        );
        return $response->withHeader('Content-Type', 'application/json');
    });

    $app->post('/a/companies/add', function (Request $request, Response $response, $args) {
        require_once 'include/DbHandlerAdm.php';
        $dbHandler = new DbHandlerAdm();
        $params = $request->getParsedBody();
        
        $dataResponse = array(
            "status" => "OK"
        );

        $success = $dbHandler->Companies_Add($params);

        if(!$success) {
            $dataResponse["status"] = "ERROR";
            $dataResponse["message"] = "Hubo un problema al registrar la empresa";
        }

        $response->getBody()->write(
            json_encode($dataResponse)
        );
        return $response->withHeader('Content-Type', 'application/json');
    });

    $app->post('/a/companies/edit', function (Request $request, Response $response, $args) {
        require_once 'include/DbHandlerAdm.php';
        $dbHandler = new DbHandlerAdm();
        $params = $request->getParsedBody();
        
        $dataResponse = array(
            "status" => "OK"
        );

        $success = $dbHandler->Companies_Update($params);

        if(!$success) {
            $dataResponse["status"] = "ERROR";
            $dataResponse["message"] = "Hubo un problema al actualizar la empresa";
        }

        $response->getBody()->write(
            json_encode($dataResponse)
        );
        return $response->withHeader('Content-Type', 'application/json');
    });

    $app->post('/a/companies/remove', function (Request $request, Response $response, $args) {
        require_once 'include/DbHandlerAdm.php';
        $dbHandler = new DbHandlerAdm();
        $params = $request->getParsedBody();
        
        $dataResponse = array(
            "status" => "OK"
        );

        $success = $dbHandler->Companies_Remove($params);

        if(!$success) {
            $dataResponse["status"] = "ERROR";
            $dataResponse["message"] = "Hubo un problema al eliminar la empresa";
        }

        $response->getBody()->write(
            json_encode($dataResponse)
        );
        return $response->withHeader('Content-Type', 'application/json');
    });

    $app->get('/users/slogin', function (Request $request, Response $response, $args) use ($app, $dbHandler) {
        $params = $request->getQueryParams();
        $dataResponse = array(
            "status" => "OK"
        );
        $userData = $dbHandler->Users_Social_Login($params);
        if(is_array($userData)) {
            $userData["favorites"] = $dbHandler->Users_Get_Favorites($userData["id"]);
            $userData["conveyances"] = $dbHandler->Users_Get_Conveyances(array(
                "id" => $userData["id"]
            ));
            $userData["notifications"] = $dbHandler->Notifications_Get_List($userData["id"]);
            $userData["social"] = $params["info"];
            $userData["social"]["provider"] = $params["provider"];
            $dataResponse["user_info"] = $userData;
            if(isset($params["_push"]["registration_id"])) {
                $dbHandler->Users_Update_Push_Reg_ID($userData["email"], $params["_push"]["registration_id"], $params["_device"]);
            }
            $dbHandler->Users_Update_Timezone($userData["id"], $params["_tz"]);
        }
        else {
            $dataResponse["status"] = "ERROR";
            $dataResponse["message"] = "No se pudo crear o acceder a la cuenta";
        }
        $response->getBody()->write(
            json_encode($dataResponse)
        );
        return $response->withHeader('Content-Type', 'application/json');
    });

    $app->get('/users/login', function (Request $request, Response $response, $args) use ($app, $dbHandler) {
        $params = $request->getQueryParams();
        $dataResponse = array(
            "status" => "OK"
        );
        $userData = $dbHandler->Users_Get_Info(isset($params["email"]) ? $params["email"] : "", "email");
        if(is_array($userData)) {
            if(isset($params["social"])) {
                $sData = $dbHandler->getConn()->getRow("SELECT * FROM users_social_connect WHERE `provider` = ? AND email = ?", array(
                    $params["social"],                    
                    $params["email"]               
                ));
                if($sData) {
                    $pwd = "$sData[provider]_$sData[uid]_" . explode("@", $sData["email"])[0];
                    if($params["password"] == $pwd) {
                        $params["password"] = "nv1"; // Social ByPass
                    }
                }
            }
            if(isset($params["password_raw"]) && $params["password_raw"] == $userData["password"]) {
                $params["password"] = "nv1";
            }
            if($params["password"] == "nv1" || $userData["password"] == createPassword($params["password"])) {
                if($userData["disabled"] == 1) {
                    $dataResponse["status"] = "ERROR";
                    $dataResponse["message"] = "Su cuenta ha sido deshabilitada por un administrador.";
                }
                else {
                    $userData["passwordRaw"] = $params["password"];
                    $userData["favorites"] = $dbHandler->Users_Get_Favorites($userData["id"]);
                    $userData["conveyances"] = $dbHandler->Users_Get_Conveyances(array(
                        "id" => $userData["id"]
                    ));
                    $userData["notifications"] = $dbHandler->Notifications_Get_List($userData["id"]);
                    $dataResponse["user_info"] = $userData;
                    if(isset($params["_push"]["registration_id"])) {
                        $dbHandler->Users_Update_Push_Reg_ID($userData["email"], $params["_push"]["registration_id"], $params["_device"]);
                    }
                    if(isset($params["_tz"])) {
                        $dbHandler->Users_Update_Timezone($userData["id"], $params["_tz"]);
                    }
                }
            }
            else {
                $dataResponse["status"] = "ERROR";
                $dataResponse["message"] = "Datos de acceso incorrectos";
            }
        }
        else {
            $dataResponse["status"] = "ERROR";
            $dataResponse["message"] = "Cuenta no existe";
        }
        $response->getBody()->write(
            json_encode($dataResponse)
        );
        return $response->withHeader('Content-Type', 'application/json');
    });

    $app->post('/users/signup', function (Request $request, Response $response, $args) use ($app, $dbHandler) {
        $params = $request->getParsedBody();
        $dataResponse = array(
            "status" => "OK"
        );
        $userData = $dbHandler->User_Register($params);
        if(is_array($userData)) {
            $userData["passwordRaw"] = $params["password"];
            $userData["favorites"] = $dbHandler->Users_Get_Favorites($userData["id"]);
            $userData["conveyances"] = $dbHandler->Users_Get_Conveyances(array(
                "id" => $userData["id"]
            ));
            $userData["notifications"] = $dbHandler->Notifications_Get_List($userData["id"]);
            $dataResponse["user_info"] = $userData;
            if(isset($params["_push"]["registration_id"])) {
                $dbHandler->Users_Update_Push_Reg_ID($userData["email"], $params["_push"]["registration_id"], $params["_device"]);
            }
            $dbHandler->Users_Update_Timezone($userData["id"], $params["_tz"]);
        }
        else {
            $dataResponse["status"] = "ERROR";
            $dataResponse["message"] = $userData;
        }
        $response->getBody()->write(
            json_encode($dataResponse)
        );
        return $response->withHeader('Content-Type', 'application/json');
    });

    $app->put('/users/settings', function (Request $request, Response $response, $args) use ($app, $dbHandler) {
        $params = $request->getParsedBody();

        $dataResponse = array(
            "status" => "OK"
        );
        $data = $dbHandler->User_Settings_Update($params);
        if(is_array($data)) {
            $dataResponse["user_settings"] = $data;
        }
        else {
            $dataResponse["status"] = "ERROR";
            $dataResponse["message"] = $data;
        }
        $response->getBody()->write(
            json_encode($dataResponse)
        );
        return $response->withHeader('Content-Type', 'application/json');
    });

    $app->post('/users/update', function (Request $request, Response $response, $args) use ($app, $dbHandler) {
        $params = $request->getParsedBody();

        $dataResponse = array(
            "status" => "OK"
        );
        $userData = $dbHandler->Users_Update_Info($params);
        if(is_array($userData)) {
            $userData["favorites"] = $dbHandler->Users_Get_Favorites($userData["id"]);
            $userData["conveyances"] = $dbHandler->Users_Get_Conveyances(array(
                "id" => $userData["id"]
            ));
            $userData["notifications"] = $dbHandler->Notifications_Get_List($userData["id"]);
            $dataResponse["user_info"] = $userData;
        }
        else {
            $dataResponse["status"] = "ERROR";
            $dataResponse["message"] = $userData;
        }
        $response->getBody()->write(
            json_encode($dataResponse)
        );
        return $response->withHeader('Content-Type', 'application/json');
    });

    $app->post('/users/update_settings_rates', function (Request $request, Response $response, $args) use ($app, $dbHandler) {
        $params = $request->getParsedBody();

        $dataResponse = array(
            "status" => "OK"
        );
        $data = $dbHandler->Users_Update_Settings_Rates($params);
        if(is_array($data)) {
            $dataResponse["data"] = $data;
        }
        else {
            $dataResponse["status"] = "ERROR";
            $dataResponse["message"] = "Hubo un problema al actualizar los ajustes.";
        }
        $response->getBody()->write(
            json_encode($dataResponse)
        );
        return $response->withHeader('Content-Type', 'application/json');
    });

    $app->get('/users/info', function (Request $request, Response $response, $args) use ($app, $dbHandler) {
        $params = $request->getQueryParams();

        $dataResponse = array(
            "status" => "OK"
        );
        $userData = $dbHandler->Users_Get_Profile_Info($params["id"], "id");
        if(is_array($userData)) {
            $userData["favorites"] = $dbHandler->Users_Get_Favorites($userData["id"]);
            $userData["conveyances"] = $dbHandler->Users_Get_Conveyances(array(
                "id" => $userData["id"]
            ));
            $userData["notifications"] = $dbHandler->Notifications_Get_List($userData["id"]);
            $dataResponse["user_info"] = $userData;
        }
        else {
            $dataResponse["status"] = "ERROR";
            $dataResponse["message"] = $userData;
        }
        $response->getBody()->write(
            json_encode($dataResponse)
        );
        return $response->withHeader('Content-Type', 'application/json');
    });

    $app->post('/users/favorite', function (Request $request, Response $response, $args) use ($app, $dbHandler) {
        $params = $request->getParsedBody();

        $dataResponse = array(
            "status" => "OK"
        );
        $favorites = $dbHandler->Users_Set_Favorite($params);
        if(is_array($favorites)) {
            $dataResponse["favorites"] = $favorites;
        }
        else {
            $dataResponse["status"] = "ERROR";
            $dataResponse["message"] = $favorites;
        }
        $response->getBody()->write(
            json_encode($dataResponse)
        );
        return $response->withHeader('Content-Type', 'application/json');
    });

    $app->post('/users/save_driver_license', function (Request $request, Response $response, $args) use ($app, $dbHandler) {
        $params = $request->getParsedBody();

        $dataResponse = array(
            "status" => "OK"
        );
        $success = $dbHandler->Users_Save_Driver_License($params);
        if(!$success) {
            $dataResponse["status"] = "ERROR";
            $dataResponse["message"] = "No se pudo guardar la licencia de conducir.";
        }
        else {
            $dataResponse["data"] = $success;
        }
        $response->getBody()->write(
            json_encode($dataResponse)
        );
        return $response->withHeader('Content-Type', 'application/json');
    });

    $app->post('/users/remove_driver_license', function (Request $request, Response $response, $args) use ($app, $dbHandler) {
        $params = $request->getParsedBody();

        $dataResponse = array(
            "status" => "OK"
        );
        $success = $dbHandler->Users_Remove_Driver_License($params);
        if(!$success) {
            $dataResponse["status"] = "ERROR";
            $dataResponse["message"] = "No se pudo remover la licencia de conducir.";
        }
        $response->getBody()->write(
            json_encode($dataResponse)
        );
        return $response->withHeader('Content-Type', 'application/json');
    });

    $app->post('/users/save_conveyance', function (Request $request, Response $response, $args) use ($app, $dbHandler) {
        $params = $request->getParsedBody();

        $dataResponse = array(
            "status" => "OK"
        );
        $data = $dbHandler->Users_Save_Conveyance($params);
        if(!$data) {
            $dataResponse["status"] = "ERROR";
            $dataResponse["message"] = "No se pudo guardar el medio de transporte.";
        }
        else {
            $dataResponse["data"] = $data;
        }
        $response->getBody()->write(
            json_encode($dataResponse)
        );
        return $response->withHeader('Content-Type', 'application/json');
    });

    $app->post('/users/remove_conveyance_picture', function (Request $request, Response $response, $args) use ($app, $dbHandler) {
        $params = $request->getParsedBody();

        $dataResponse = array(
            "status" => "OK"
        );
        $data = $dbHandler->Users_Remove_Picture_Conveyance($params);
        if(!$data) {
            $dataResponse["status"] = "ERROR";
            $dataResponse["message"] = "No se pudo remover la foto.";
        }
        else {
            $dataResponse["data"] = $data;
        }
        $response->getBody()->write(
            json_encode($dataResponse)
        );
        return $response->withHeader('Content-Type', 'application/json');
    });

    $app->post('/users/remove_conveyance', function (Request $request, Response $response, $args) use ($app, $dbHandler) {
        $params = $request->getParsedBody();

        $dataResponse = array(
            "status" => "OK"
        );
        $data = $dbHandler->Users_Remove_Conveyance($params);
        if(!$data) {
            $dataResponse["status"] = "ERROR";
            $dataResponse["message"] = "No se pudo remover el vehículo.";
        }
        else {
            $dataResponse["data"] = $data;
        }
        $response->getBody()->write(
            json_encode($dataResponse)
        );
        return $response->withHeader('Content-Type', 'application/json');
    });

    $app->post('/users/update_conveyance_picture', function (Request $request, Response $response, $args) use ($app, $dbHandler) {
        $params = $request->getParsedBody();

        $dataResponse = array(
            "status" => "OK"
        );
        $data = $dbHandler->Users_Update_Picture_Conveyance($params);
        if(!$data) {
            $dataResponse["status"] = "ERROR";
            $dataResponse["message"] = "No se pudo guardar la foto.";
        }
        else {
            $dataResponse["data"] = $data;
        }
        $response->getBody()->write(
            json_encode($dataResponse)
        );
        return $response->withHeader('Content-Type', 'application/json');
    });

    $app->get('/users/notifications', function (Request $request, Response $response, $args) use ($app, $dbHandler) {
        $params = $request->getQueryParams();

        $dataResponse = array(
            "status" => "OK"
        );
        $data = $dbHandler->Notifications_Get_List($params["id"]);
        
        if(!is_array($data)) {
            $dataResponse["status"] = "ERROR";
            $dataResponse["message"] = "No se pudo carga la lista de notificaciones.";
        }
        else {
            $dataResponse["data"] = $data;
        }
        $response->getBody()->write(
            json_encode($dataResponse)
        );
        return $response->withHeader('Content-Type', 'application/json');
    });

    $app->post('/users/remove_notification', function (Request $request, Response $response, $args) use ($app, $dbHandler) {
        $params = $request->getParsedBody();

        $dataResponse = array(
            "status" => "OK"
        );

        $success = $dbHandler->Notifications_Delete($params);
        if(!$success) {
            $dataResponse["status"] = "ERROR";
            $dataResponse["message"] = "Hubo un problema al eliminar la notificación.";
        }
        
        $response->getBody()->write(
            json_encode($dataResponse)
        );
        return $response->withHeader('Content-Type', 'application/json');
    });

    $app->get('/users/ratings', function (Request $request, Response $response, $args) use ($app, $dbHandler) {
        $params = $request->getQueryParams();
        $dataResponse = array(
            "status" => "OK"
        );
        $data = $dbHandler->Users_Ratings($params);
        if(is_array($data)) {
            $dataResponse["ratings"] = $data;
        }
        else {
            $dataResponse["status"] = "ERROR";
            $dataResponse["message"] = $data;
        }
        $response->getBody()->write(
            json_encode($dataResponse)
        );
        return $response->withHeader('Content-Type', 'application/json');
    });

    $app->post('/users/reset_password/send_code', function (Request $request, Response $response, $args) use ($app, $dbHandler) {
        $params = $request->getParsedBody();
        $dataResponse = array(
            "status" => "OK"
        );
        $success = $dbHandler->Users_Send_Reset_Password_Code($params);
        if(!$success) {
            $dataResponse["status"] = "ERROR";
            $dataResponse["message"] = "Hubo un problema al enviar código a la dirección de correo electrónico proporcionada.";
        }
        $response->getBody()->write(
            json_encode($dataResponse)
        );
        return $response->withHeader('Content-Type', 'application/json');
    });

    $app->post('/users/reset_password/check_code', function (Request $request, Response $response, $args) use ($app, $dbHandler) {
        $params = $request->getParsedBody();
        $dataResponse = array(
            "status" => "OK"
        );
        $success = $dbHandler->Users_Check_Code_Reset_Password($params);
        if(!$success) {
            $dataResponse["status"] = "ERROR";
            $dataResponse["message"] = "El código de reestablecimiento proporcionado es incorrecto.";
        }
        $response->getBody()->write(
            json_encode($dataResponse)
        );
        return $response->withHeader('Content-Type', 'application/json');
    });

    $app->post('/users/verify_email/send_code', function (Request $request, Response $response, $args) use ($app, $dbHandler) {
        $params = $request->getParsedBody();
        $dataResponse = array(
            "status" => "OK"
        );
        $success = $dbHandler->Users_Send_Email_Verification_Code($params);
        if(!$success) {
            $dataResponse["status"] = "ERROR";
            $dataResponse["message"] = "Hubo un problema al enviar código a la dirección de correo electrónico proporcionada.";
        }
        $response->getBody()->write(
            json_encode($dataResponse)
        );
        return $response->withHeader('Content-Type', 'application/json');
    });

    $app->post('/users/verify_email/check_code', function (Request $request, Response $response, $args) use ($app, $dbHandler) {
        $params = $request->getParsedBody();
        $dataResponse = array(
            "status" => "OK"
        );
        $success = $dbHandler->Users_Check_Email_Verification_Code($params);
        if(!$success) {
            $dataResponse["status"] = "ERROR";
            $dataResponse["message"] = "El código proporcionado es incorrecto.";
        }
        $response->getBody()->write(
            json_encode($dataResponse)
        );
        return $response->withHeader('Content-Type', 'application/json');
    });

    $app->post('/users/reset_password', function (Request $request, Response $response, $args) use ($app, $dbHandler) {
        $params = $request->getParsedBody();
        $dataResponse = array(
            "status" => "OK"
        );
        $success = $dbHandler->Users_Reset_Password($params);
        if(!$success) {
            $dataResponse["status"] = "ERROR";
            $dataResponse["message"] = "Hubo un problema al guardar los cambios.";
        }
        $response->getBody()->write(
            json_encode($dataResponse)
        );
        return $response->withHeader('Content-Type', 'application/json');
    });

    $app->get('/users/offers', function (Request $request, Response $response, $args) use ($app, $dbHandler) {
        $params = $request->getQueryParams();

        $dataResponse = array(
            "status" => "OK"
        );
        $data = $dbHandler->Users_Shipments_Offers($params);
        if(is_array($data)) {
            $dataResponse["shipments_offers"] = $data;
        }
        else {
            $dataResponse["status"] = "ERROR";
            $dataResponse["message"] = $data;
        }
        $response->getBody()->write(
            json_encode($dataResponse)
        );
        return $response->withHeader('Content-Type', 'application/json');
    });

    $app->post('/users/offers/remove', function (Request $request, Response $response, $args) use ($app, $dbHandler) {
        $params = $request->getParsedBody();
        $dataResponse = array(
            "status" => "OK"
        );
        $success = $dbHandler->Users_Shipments_Offers_Delete($params);
        if(!$success) {
            $dataResponse["status"] = "ERROR";
            $dataResponse["message"] = "Hubo un problema al ocultar o revertir la oferta.";
        }
        $response->getBody()->write(
            json_encode($dataResponse)
        );
        return $response->withHeader('Content-Type', 'application/json');
    });

    $app->post('/shipments/new/standard', function (Request $request, Response $response, $args) use ($app, $dbHandler) {
        $params = $request->getParsedBody();
        $dataResponse = array(
            "status" => "OK"
        );
        $data = $dbHandler->Shipments_New_Standard($params);
        if(is_array($data)) {
            $dataResponse["shipment_info"] = $data;
        }
        else {
            $dataResponse["status"] = "ERROR";
            $dataResponse["message"] = $data;
        }
        $response->getBody()->write(
            json_encode($dataResponse)
        );
        return $response->withHeader('Content-Type', 'application/json');
    });

    $app->post('/shipments/update', function (Request $request, Response $response, $args) use ($app, $dbHandler) {
        $params = $request->getParsedBody();
        $dataResponse = array(
            "status" => "OK"
        );
        $data = $dbHandler->Shipments_Update($params);
        if(is_array($data)) {
            $dataResponse["shipment_info"] = $data;
        }
        else {
            $dataResponse["status"] = "ERROR";
            $dataResponse["message"] = $data;
        }
        $response->getBody()->write(
            json_encode($dataResponse)
        );
        return $response->withHeader('Content-Type', 'application/json');
    });

    $app->get("/shipments", function (Request $request, Response $response, $args) use ($app, $dbHandler) {
        $params = $request->getQueryParams();
        $dataResponse = array(
            "status" => "OK",
            "shipments" => $dbHandler->Shipments_List_Shipments($params),
            "deliveries" => $dbHandler->Shipments_List_Deliveries($params)
        );
        /*$data = $dbHandler->Shipments_List_Active($params);
        if(is_array($data)) {
            $dataResponse["active_shipments"] = $data;
        }
        else {
            $dataResponse["status"] = "ERROR";
            $dataResponse["message"] = $data;
        }*/
        $response->getBody()->write(
            json_encode($dataResponse)
        );
        return $response->withHeader('Content-Type', 'application/json');
    });

    $app->get("/shipments/details", function (Request $request, Response $response, $args) use ($app, $dbHandler) {
        $params = $request->getQueryParams();
        $dataResponse = array(
            "status" => "OK",
            "data" => $dbHandler->Shipments_Get_Standard($params["id"])
        );
        $response->getBody()->write(
            json_encode($dataResponse)
        );
        return $response->withHeader('Content-Type', 'application/json');
    });

    $app->get('/shipments/active', function (Request $request, Response $response, $args) use ($app, $dbHandler) {
        $params = $request->getQueryParams();
        $dataResponse = array(
            "status" => "OK"
        );
        $data = $dbHandler->Shipments_List_Active($params);
        if(is_array($data)) {
            $dataResponse["active_shipments"] = $data;
        }
        else {
            $dataResponse["status"] = "ERROR";
            $dataResponse["message"] = $data;
        }
        $response->getBody()->write(
            json_encode($dataResponse)
        );
        return $response->withHeader('Content-Type', 'application/json');
    });

    $app->get('/shipments/pending', function (Request $request, Response $response, $args) use ($app, $dbHandler) {
        $params = $request->getQueryParams();
        $dataResponse = array(
            "status" => "OK"
        );
        $data = $dbHandler->Shipments_List_Pending($params);
        if(is_array($data)) {
            $dataResponse["pending_shipments"] = $data;
        }
        else {
            $dataResponse["status"] = "ERROR";
            $dataResponse["message"] = $data;
        }
        $response->getBody()->write(
            json_encode($dataResponse)
        );
        return $response->withHeader('Content-Type', 'application/json');
    });

    $app->get('/shipments/available', function (Request $request, Response $response, $args) use ($app, $dbHandler) {
        $params = $request->getQueryParams();
        $dataResponse = array(
            "status" => "OK"
        );
        $data = $dbHandler->Shipments_List_Available($params);
        if(is_array($data)) {
            $dataResponse["available_shipments"] = $data;
        }
        else {
            $dataResponse["status"] = "ERROR";
            $dataResponse["message"] = $data;
        }
        $response->getBody()->write(
            json_encode($dataResponse)
        );
        return $response->withHeader('Content-Type', 'application/json');
    });

    $app->post('/shipments/offer', function (Request $request, Response $response, $args) use ($app, $dbHandler) {
        $params = $request->getParsedBody();
        $dataResponse = array(
            "status" => "OK"
        );
        $offerId = $dbHandler->Shipments_Save_Offer($params);
        if(!$offerId) {
            $dataResponse["status"] = "ERROR";
            $dataResponse["message"] = "Hubo un problema al guardar la oferta.";
        }
        else {
            $dataResponse["data"] = array(
                "offer_id" => $offerId
            );
        }
        $response->getBody()->write(
            json_encode($dataResponse)
        );
        return $response->withHeader('Content-Type', 'application/json');
    });

    $app->post('/shipments/offer/accept', function (Request $request, Response $response, $args) use ($app, $dbHandler) {
        $params = $request->getParsedBody();
        $dataResponse = array(
            "status" => "OK"
        );
        $offerId = $dbHandler->Shipments_Accept_Offer($params);
        if(!$offerId) {
            $dataResponse["status"] = "ERROR";
            $dataResponse["message"] = "Hubo un problema al aceptar la oferta.";
        }
        else {
            $dataResponse["data"] = array(
                "offer_id" => $offerId
            );
        }
        $response->getBody()->write(
            json_encode($dataResponse)
        );
        return $response->withHeader('Content-Type', 'application/json');
    });

    $app->post('/shipments/offer/refuse', function (Request $request, Response $response, $args) use ($app, $dbHandler) {
        $params = $request->getParsedBody();
        $dataResponse = array(
            "status" => "OK"
        );
        $success = $dbHandler->Shipments_Refuse_Offer($params);
        if(!$success) {
            $dataResponse["status"] = "ERROR";
            $dataResponse["message"] = "Hubo un problema al rechazar la oferta.";
        }
        $response->getBody()->write(
            json_encode($dataResponse)
        );
        return $response->withHeader('Content-Type', 'application/json');
    });

    $app->post('/shipments/return_dispatch_expenses', function (Request $request, Response $response, $args) use ($app, $dbHandler) {
        $params = $request->getParsedBody();
        $dataResponse = array(
            "status" => "OK"
        );
        $success = $dbHandler->Shipments_Save_Return_Dispatch_Expenses($params);
        if(!$success) {
            $dataResponse["status"] = "ERROR";
            $dataResponse["message"] = "Hubo un problema al procesar la solicitud.";
        }
        $response->getBody()->write(
            json_encode($dataResponse)
        );
        return $response->withHeader('Content-Type', 'application/json');
    });

    $app->get('/shipments/wallet_history', function (Request $request, Response $response, $args) use ($app, $dbHandler) {
        $params = $request->getQueryParams();
        $dataResponse = array(
            "status" => "OK"
        );
        $data = $dbHandler->Shipments_Wallet_History($params);
        if(is_array($data)) {
            $dataResponse["history"] = $data;
        }
        else {
            $dataResponse["status"] = "ERROR";
            $dataResponse["message"] = "No se pudo cargar el historial de envíos y entregas.";
        }
        $response->getBody()->write(
            json_encode($dataResponse)
        );
        return $response->withHeader('Content-Type', 'application/json');
    });

    $app->post('/shipments/delete', function (Request $request, Response $response, $args) use ($app, $dbHandler) {
        $params = $request->getParsedBody();
        $dataResponse = array(
            "status" => "OK"
        );
        $success = $dbHandler->Shipments_Delete($params);
        if(!$success) {
            $dataResponse["status"] = "ERROR";
            $dataResponse["message"] = "Hubo un problema al eliminar el envío.";
        }
        $response->getBody()->write(
            json_encode($dataResponse)
        );
        return $response->withHeader('Content-Type', 'application/json');
    });

    $app->get('/shipments/{id}/confirm', function (Request $request, Response $response, $args) use ($app, $dbHandler) {
        $id = $args['id'];
        $params = $request->getQueryParams();
        $shipmentInfo = $dbHandler->Shipments_Get_Standard($id);
        if($shipmentInfo) {
            if(isset($params["pin"]) && $params["pin"] != "" && $shipmentInfo["pin"] == $params["pin"]) {
                $deliverer = array_filter($shipmentInfo["offers"], function($o) {
                    return $o["accepted_at"] != null;
                });
                $deliverer = array_values($deliverer);
                $deliverer = $deliverer[0];
                $html = '';

                //$shipmentInfo["id_status"] = 5; // tmp

                if($shipmentInfo["id_status"] == 4) {
                    $html = '
                        <head>
                            <meta name="viewport" content="initial-scale=1, maximum-scale=1">
                            <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
                        </head>
                        <body style="overflow: hidden;margin: 0;font-family: \'Roboto\', sans-serif;background: #4c00ff;">
                            <div style="height: calc(100% - 32px);width: auto;overflow: auto;padding: 16px;background: #4C00FF;color: white;position: relative;max-width: 400px;margin: 0 auto;">
                                <p style=" text-align: center; margin: 24px 0; min-height: 47px;">
									' . NV_LOGO_WHITE . '
                                </p>
                                <p style=" text-align: center; font-family: \'Roboto Light\'; font-weight: bold; font-size: 18px; ">Confirmar recepción del paquete.</p>
                                <div style=" background-color: rgba(0, 0, 0, 0.05); border-radius: 24px; padding: 16px; margin-top: 30px; ">
                                    <table style="width: 100%;color: #cdcdcd;">
                                        <tbody>
                                            <tr style=" height: 24px; ">
                                                <td style=" font-weight: bold;" colspan="2">Creador del envío</td>
                                            </tr>
                                            <tr>
                                                <td style="padding-top: 8px;" colspan="2">' . ($shipmentInfo["owner"]["fullname"] ?: explode("@", $shipmentInfo["owner"]["email"])[0]) . '</td>
                                            </tr>
                                            <tr style=" height: 24px; ">
                                                <td style=" font-weight: bold;padding-top: 12px;" colspan="2">Entregador</td>
                                            </tr>
                                            <tr>
                                                <td style="padding-top: 8px;" colspan="2">' . ($deliverer["user_fullname"] ?: explode("@", $deliverer["user_email"])[0]) . '</td>
                                            </tr>
                                            <tr style=" height: 8px; ">
                                                <td style=" font-weight: bold; "></td>
                                                <td style="text-align: right;"></td>
                                            </tr>
                                            <tr style=" height: 24px; ">
                                                <td style=" font-weight: bold;padding-top: 12px;" colspan="2">Desde</td>
                                            </tr>
                                            <tr>
                                                <td style="padding-top: 8px;" colspan="2">' . $shipmentInfo["start_address"] . '</td>
                                            </tr>
                                            <tr style=" height: 24px; ">
                                                <td style="font-weight: bold;padding-top: 12px;" colspan="2">Hasta</td>
                                            </tr>
                                            <tr>
                                                <td style="padding-top: 8px;" colspan="2">' . $shipmentInfo["end_address"] . '</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div style="width: 100%; display: flex; align-items: center; justify-content: center; margin-top: 24px;">
                                    <a href="javascript: void(0);" id="confirm-delivered" style=" height: 50px; width: 80%; background: white; border-radius: 100px; display: flex; align-items: center; justify-content: center; font-family: \'Roboto Medium\'; text-decoration: none; color: #4c00ff;">He recibido el paquete</a>
                                </div>
                            </div>
                            <script src="../../../njs/node_modules/socket.io-client/dist/socket.io.js"></script>
                            <script>
                                window.onload = function() {
                                    ' . (
                                        isset($_REQUEST["localhost"]) ? 
                                        'socket = io(\'http://127.0.0.1:3344\');' : 
                                        'socket = io(\''. HOST .':' . SOCKET_PORT . '\');'
                                    ) . '
                                    socket.on(\'connect\', function () {
                                        //console.log(`Connected to socket`);
                                    });
                                    socket.on(\'shipment delivered\', function () {
                                        location.reload();
                                    });
                                    socket.on(\'disconnect\', function () {
                                        //console.log(`Disconnect from socket`);
                                    });
                                    document.getElementById(\'confirm-delivered\').addEventListener(\'click\', function() {
                                        var so = JSON.parse(\'' . json_encode($shipmentInfo) . '\');
                                        //console.log(so);
                                        if(socket.connected) {
                                            socket.emit(\'shipment delivered\', {
                                                id: so.id
                                            });
                                        }
                                    });
                                };
                            </script>
                        </body>
                    ';
                }
                else if($shipmentInfo["id_status"] == 5) {
                    $html = '
                        <head>
                            <meta name="viewport" content="initial-scale=1, maximum-scale=1">
                            <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
                        </head>
                        <body style="overflow: hidden;margin: 0;font-family: \'Roboto\', sans-serif;background: #4c00ff;">
                            <div style="height: calc(100% - 32px);width: auto;overflow: auto;padding: 16px;background: #4C00FF;color: white;position: relative;max-width: 400px;margin: 0 auto;">
                                <p style=" text-align: center; margin: 24px 0; min-height: 47px;">
                                ' . NV_LOGO_WHITE . '
                                </p>
                                <p style=" text-align: center; font-family: \'Roboto Light\'; font-weight: bold; font-size: 18px; ">El paquete ha sido entregado.</p>
                                <div style=" background-color: rgba(0, 0, 0, 0.05); border-radius: 24px; padding: 16px; margin-top: 30px; ">
                                    <table style="width: 100%;color: #cdcdcd;">
                                        <tbody>
                                            <tr style=" height: 24px; ">
                                                <td style=" font-weight: bold;" colspan="2">Creador del envío</td>
                                            </tr>
                                            <tr>
                                                <td style="padding-top: 8px;" colspan="2">' . ($shipmentInfo["owner"]["fullname"] ?: explode("@", $shipmentInfo["owner"]["email"])[0]) . '</td>
                                            </tr>
                                            <tr style=" height: 24px; ">
                                                <td style=" font-weight: bold;padding-top: 12px;" colspan="2">Entregador</td>
                                            </tr>
                                            <tr>
                                                <td style="padding-top: 8px;" colspan="2">' . ($deliverer["user_fullname"] ?: explode("@", $deliverer["user_email"])[0]) . '</td>
                                            </tr>
                                            <tr style=" height: 8px; ">
                                                <td style=" font-weight: bold; "></td>
                                                <td style="text-align: right;"></td>
                                            </tr>
                                            <tr style=" height: 24px; ">
                                                <td style=" font-weight: bold;padding-top: 12px;" colspan="2">Desde</td>
                                            </tr>
                                            <tr>
                                                <td style="padding-top: 8px;" colspan="2">' . $shipmentInfo["start_address"] . '</td>
                                            </tr>
                                            <tr style=" height: 24px; ">
                                                <td style="font-weight: bold;padding-top: 12px;" colspan="2">Hasta</td>
                                            </tr>
                                            <tr>
                                                <td style="padding-top: 8px;" colspan="2">' . $shipmentInfo["end_address"] . '</td>
                                            </tr>
                                            <tr style=" height: 24px; ">
                                                <td style="font-weight: bold;padding-top: 12px;" colspan="2">Entregado</td>
                                            </tr>
                                            <tr>
                                                <td style="padding-top: 8px;" colspan="2">' . date("D d M H:i", strtotime($shipmentInfo["delivered_at"])) . ' h.</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <script>console.log(JSON.parse(\'' . json_encode($shipmentInfo) . '\'));</script>
                        </body>
                    ';
                }
                $response->getBody()->write($html);
                return $response->withHeader('Content-Type', 'text/html; charset=utf-8');
            }
            else {
                $response->getBody()->write('
                    <head>
                        <meta name="viewport" content="initial-scale=1, maximum-scale=1">
                        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
                    </head>
                    <body style="overflow: hidden;margin: 0;font-family: \'Roboto\', sans-serif;display: flex;align-items: center;justify-content: center;background: #4c00ff;">
                        <div style="width: calc(100% - 32px);overflow: auto;padding: 16px;background: #4C00FF;color: white;position: relative;">
                            <p style=" text-align: center; margin: 36px 0; min-height: 47px;">
								' . NV_LOGO_WHITE . '
							</p>
                            <p style="text-align: center;font-family: \'Roboto Light\';font-weight: bold;font-size: 20px;margin-top: 36px;">PIN INCORRECTO</p>
                        </div>
                    </body>
                ');
                return $response->withHeader('Content-Type', 'text/html; charset=utf-8');
            }
        }
        else {
            $response->getBody()->write("");
            return $response->withHeader('Content-Type', 'text/html; charset=utf-8');
        }
    });

    $app->post('/shipments/rate', function (Request $request, Response $response, $args) use ($app, $dbHandler) {
        $params = $request->getParsedBody();
        $dataResponse = array(
            "status" => "OK"
        );
        $success = $dbHandler->Shipments_Rate($params);
        if(!$success) {
            $dataResponse["status"] = "ERROR";
            $dataResponse["message"] = "Hubo un problema al calificar.";
        }
        $response->getBody()->write(
            json_encode($dataResponse)
        );
        return $response->withHeader('Content-Type', 'application/json');
    });

    $app->get('/shipments/tracking/history', function (Request $request, Response $response, $args) use ($app, $dbHandler) {
        $params = $request->getQueryParams();
        $dataResponse = array(
            "status" => "OK"
        );
        $data = $dbHandler->Shipments_Tracking_History($params);
        if(is_array($data)) {
            $dataResponse["data"] = $data;
        }
        else {
            $dataResponse["status"] = "ERROR";
            $dataResponse["message"] = "Hubo un problema al obtener los datos.";
        }
        $response->getBody()->write(
            json_encode($dataResponse)
        );
        return $response->withHeader('Content-Type', 'application/json');
    });

    $app->post('/shipments/return', function (Request $request, Response $response, $args) use ($app, $dbHandler) {
        $params = $request->getParsedBody();
        $dataResponse = array(
            "status" => "OK"
        );
        $success = $dbHandler->Shipments_Return($params);
        if(!$success) {
            $dataResponse["status"] = "ERROR";
            $dataResponse["message"] = "Hubo un problema al devolver el envío.";
        }
        $response->getBody()->write(
            json_encode($dataResponse)
        );
        return $response->withHeader('Content-Type', 'application/json');
    });

    $app->get('/shipments/offers', function (Request $request, Response $response, $args) use ($app, $dbHandler) {
        $params = $request->getQueryParams();
        $dataResponse = array(
            "status" => "OK"
        );
        $data = $dbHandler->Shipments_Get_Offers($params);
        if(is_array($data)) {
            $dataResponse["offers"] = $data;
        }
        else {
            $dataResponse["status"] = "ERROR";
            $dataResponse["message"] = $data;
        }
        $response->getBody()->write(
            json_encode($dataResponse)
        );
        return $response->withHeader('Content-Type', 'application/json');
    });

    $app->post('/shipments/discard', function (Request $request, Response $response, $args) use ($app, $dbHandler) {
        $params = $request->getParsedBody();
        $dataResponse = array(
            "status" => "OK"
        );
        $success = $dbHandler->Shipments_Discard($params);
        if(!$success) {
            $dataResponse["status"] = "ERROR";
            $dataResponse["message"] = "Hubo un problema al descartar el envío.";
        }
        $response->getBody()->write(
            json_encode($dataResponse)
        );
        return $response->withHeader('Content-Type', 'application/json');
    });

    $app->get('/chats', function (Request $request, Response $response, $args) use ($app, $dbHandler) {
        $dataResponse = array();
        $dbHandler = new DbHandler();
        
        $list = $dbHandler->Chats_Conversations_List($request->getQueryParams());
        
        if($list === null) {
            $dataResponse["error"] = true;
            $dataResponse["message"] = "Hubo un problema al obtener los mensajes.";
        }
        else {
            $dataResponse["error"] = false;
            $dataResponse["chats"] = $list;
        }

        $response->getBody()->write(
            json_encode($dataResponse)
        );
        return $response->withHeader('Content-Type', 'application/json');
    });

    $app->get('/chats/details', function (Request $request, Response $response, $args) use ($app, $dbHandler) {
        $dataResponse = array();
        $dbHandler = new DbHandler();
        
        $list = $dbHandler->Chats_Get_Conversation($request->getQueryParams());
        
        if($list === null) {
            $dataResponse["error"] = true;
            $dataResponse["message"] = "Hubo un problema al obtener los mensajes.";
        }
        else {
            $dataResponse["error"] = false;
            $dataResponse["messages"] = $list;
        }
        $response->getBody()->write(
            json_encode($dataResponse)
        );
        return $response->withHeader('Content-Type', 'application/json');
    });

    $app->post('/chats/archive', function (Request $request, Response $response, $args) use ($app, $dbHandler) {
        $dataResponse = array();
        $dbHandler = new DbHandler();
        
        $list = $dbHandler->Chats_Archivate($request->getParsedBody());
        
        if($list === null) {
            $dataResponse["error"] = true;
            $dataResponse["message"] = "Hubo un problema al archivar el chat.";
        }
        else {
            $dataResponse["error"] = false;
        }
        $response->getBody()->write(
            json_encode($dataResponse)
        );
        return $response->withHeader('Content-Type', 'application/json');
    });

    $app->post('/chats/send_attachment', function (Request $request, Response $response, $args) use ($app, $dbHandler) {
        $dataResponse = array();
        $dbHandler = new DbHandler();
        
        $list = $dbHandler->Chats_Send_Attachment($request->getParsedBody());
        
        if($list === null) {
            $dataResponse["error"] = true;
            $dataResponse["message"] = "Hubo un problema al enviar el adjunto.";
        }
        else {
            $dataResponse["error"] = false;
            $dataResponse["data"] = $list;
        }
        $response->getBody()->write(
            json_encode($dataResponse)
        );
        return $response->withHeader('Content-Type', 'application/json');
    });

    //$app->post('/misc/send_push_notification', function (Request $request, Response $response, $args) use ($app, $dbHandler) {
    $app->get('/misc/send_push_notification', function (Request $request, Response $response, $args) use ($app, $dbHandler) {
        $dataResponse = array();
        $dbHandler = new DbHandler();

        //$params = $request->getParsedBody();
        $params = $request->getQueryParams();
        
        $result = $dbHandler->Send_Push_Notification($params);
        
        if($result === null) {
            $dataResponse["error"] = true;
            $dataResponse["message"] = "Hubo un problema al procesar la notificación push.";
        }
        else if(is_string($result)) {
            $dataResponse["error"] = true;
            $dataResponse["message"] = $result;
        }
        else {
            $dataResponse["error"] = false;
            $dataResponse["data"] = $result;
        }
        $response->getBody()->write(
            json_encode($dataResponse)
        );
        return $response->withHeader('Content-Type', 'application/json');
    });

    $app->get('/ml/{u_id}', function (Request $request, Response $response, $args) use ($app, $dbHandler) {
        $name = $args['u_id'];
        $params = $request->getQueryParams();
        if(isset($params["code"])) {
            $success = $dbHandler->Users_MP_Auth(array(
                "user_id" => $args["u_id"],
                "code" => $params["code"]
            ));
            if($success) {
                $response->getBody()->write('
                    <head>
                        <meta name="viewport" content="initial-scale=1, maximum-scale=1">
                        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
                    </head>
                    <body style="overflow: hidden;margin: 0;font-family: \'Roboto\', sans-serif;background: #4c00ff;">
                        <div style="height: calc(100% - 32px);width: auto;overflow: auto;padding: 16px;background: #4C00FF;color: white;position: relative;max-width: 400px;margin: 0 auto;">
                            <p style=" text-align: center; margin: 24px 0; min-height: 47px;">
                                ' . NV_LOGO_WHITE . '
                            </p>
                            <p style=" text-align: center; font-family: \'Roboto Light\'; font-weight: bold; font-size: 18px; ">La billetera se ha vinculado satisfactoriamente.</p>
                            <div style="width: 100%; display: flex; align-items: center; justify-content: center; margin-top: 24px;">
                                <a href="javascript: void(0);" id="close" style=" height: 50px; width: 80%; background: white; border-radius: 100px; display: flex; align-items: center; justify-content: center; font-family: \'Roboto Medium\'; text-decoration: none; color: #4c00ff;">Volver a la app</a>
                            </div>
                        </div>
                        <script>
                            document.getElementById(\'close\').addEventListener(\'click\', function() {
                                window.close();
                            });
                        </script>
                    </body>
                    <script>
                        setTimeout(function() {
                            window.close();
                        }, 1500);
                    </script>
                ');
            }
            else {
                $response->getBody()->write('
                    <script>alert("ERROR");window.close();</script>
                ');
            }
            return $response;
        }
        else {
            $dataResponse = array(
                "status" => "OK"
            );
            $data = $dbHandler->Users_MP_Auth(array(
                "user_id" => $args["u_id"]
            ));
            if($data) {
                $dataResponse["data"] = $data;
            }
            else {
                $dataResponse["status"] = "ERROR";
            }
            $response->getBody()->write(
                json_encode($dataResponse)
            );
            return $response->withHeader('Content-Type', 'application/json');
        }
    });

    $app->post('/ml/{u_id}/card', function (Request $request, Response $response, $args) use ($app, $dbHandler) {
        $dataResponse = array(
            "status" => "OK"
        );

        $params = $request->getParsedBody();

        $data = $dbHandler->Users_MP_Add_Card(array(
            "user_id" => $args["u_id"],
            "token" => $params["token"]
        ));

        if(is_array($data)) {
            $dataResponse["data"] = $data;
        }
        else {
            $dataResponse["status"] = "ERROR";
            $dataResponse["message"] = $data ? $data : "No se pudo agregar la tarjeta, por favor intente mas tarde.";
        }
        $response->getBody()->write(
            json_encode($dataResponse)
        );
        return $response->withHeader('Content-Type', 'application/json');
    });

    $app->post('/ml/{u_id}/logout', function (Request $request, Response $response, $args) use ($app, $dbHandler) {
        $dataResponse = array(
            "status" => "OK"
        );

        $params = $request->getParsedBody();

        $success = $dbHandler->Users_MP_Logout($args["u_id"]);

        if(!$success) {
            $dataResponse["status"] = "ERROR";
        }
        $response->getBody()->write(
            json_encode($dataResponse)
        );
        return $response->withHeader('Content-Type', 'application/json');
    });

    $app->post('/mp/ipn', function (Request $request, Response $response, $args) use ($app, $dbHandler) {
        $dataResponse = array(
            "status" => "OK"
        );

        $params = $request->getParsedBody();

        MercadoPago\SDK::setAccessToken(MP_ACCESS_TOKEN);

        $merchant_order = null;

        switch($params["topic"]) {
            case "payment":
                $payment = MercadoPago\Payment::find_by_id($params["id"]);
                // Get the payment and the corresponding merchant_order reported by the IPN.
                $merchant_order = MercadoPago\MerchantOrder::find_by_id($payment->order->id);
                break;
            case "merchant_order":
                $merchant_order = MercadoPago\MerchantOrder::find_by_id($params["id"]);
                break;
            case "chargebacks":
                $merchant_order = null;
                break;
        }

        if($merchant_order) {
            $paid_amount = 0;
            foreach ($merchant_order->payments as $payment) {
                if ($payment['status'] == 'approved'){
                    $paid_amount += $payment['transaction_amount'];
                }
            }
    
            // If the payment's transaction amount is equal (or bigger) than the merchant_order's amount you can release your items
            if($paid_amount >= $merchant_order->total_amount) {
                if (count($merchant_order->shipments)>0) { // The merchant_order has shipments
                    if($merchant_order->shipments[0]->status == "ready_to_ship") {
                        //print_r("Totally paid. Print the label and release your item.");
                        $dbHandler->Shipments_Update_Payment($_REQUEST["collection_id"], array(
                            "collection_status" => $_REQUEST["collection_status"],
                            "transaction_details" => json_decode(json_encode($payment->transaction_details), true),
                            "fee_details" => json_decode(json_encode($payment->fee_details), true)
                        ));
                    }
                } else { // The merchant_order don't has any shipments
                    //print_r("Totally paid. Release your item.");
                    $dbHandler->Shipments_Update_Payment($_REQUEST["collection_id"], array(
                        "collection_status" => $_REQUEST["collection_status"],
                        "transaction_details" => json_decode(json_encode($payment->transaction_details), true),
                        "fee_details" => json_decode(json_encode($payment->fee_details), true)
                    ));
                }
            } else {
                //print_r("Not paid yet. Do not release your item.");
            }
        }
        else if($params["topic"] == "chargebacks") {
            
        }

        return $response->withHeader('Content-Type', 'application/json');
    });

    $app->run();
?>