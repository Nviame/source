<?php
    ini_set('display_errors', '0');
    ini_set('display_startup_errors', '0');
    error_reporting(E_ALL);

    require_once('inc/globals.php');
    $rates = CommercesRatesQuery::create()->orderByName()->find();
    
    $successMessage = null;
    $errorMessage = null;

    $canScheduleShipments = $GLOBALS["User"]["Capabilities"]["CanScheduleShipments"];

    $productTypes = ProductTypesQuery::create()->find();

    function genUUid() {
        //AAACCC1111111
        $characters1 = 'ABCDEFGHJKMNOPQRSTUX';
        $characters2 = '0123456789';
        $characters1Length = strlen($characters1);
        $characters2Length = strlen($characters2);
        return $characters1[rand(0, 3)] . $characters1[rand(0, $characters1Length - 1)] . $characters1[rand(0, $characters1Length - 1)] . $characters1[rand(0, $characters1Length - 1)] . $characters1[rand(0, $characters1Length - 1)] . $characters1[rand(0, $characters1Length - 1)] . $characters2[rand(0, $characters2Length - 1)] . $characters2[rand(0, $characters2Length - 1)] . $characters2[rand(0, $characters2Length - 1)] . $characters2[rand(0, $characters2Length - 1)] . $characters2[rand(0, $characters2Length - 1)] . $characters2[rand(0, $characters2Length - 1)] . $characters2[rand(0, $characters2Length - 1)];
    }

    if(isset($_POST["submit-alt-form-pshipments"]) || isset($_POST["submit-form-pshipments"])) {
        $data = $_POST;
        
        $distData = null;

        $url = "https://maps.googleapis.com/maps/api/distancematrix/json?&origins=$data[lugar_retiro_latitud],$data[lugar_retiro_longitud]&destinations=$data[domicilio_lat],$data[domicilio_lng]&key=AIzaSyCiWj9PLdW0zCxe3HzK00xS6YawLIZjBXg";
        $distance_data = file_get_contents($url);
        $distance_arr = json_decode($distance_data);
        if(isset($distance_arr->rows[0]->elements[0])) {
            $distData = $distance_arr->rows[0]->elements[0];
        }
        $taxAmmount = null;
        if(isset($data["tarifa"]) && $data["tarifa"]) {
            $data["tarifa"] = explode("|", $data["tarifa"]);
            $data["tarifa"] = $data["tarifa"][0];
            $taxAmmount = $data["tarifa"][1];
        }
        else {
            $data["tarifa"] = null;
        }
        $cs = new CommercesShipments();
        $cs->setIdCommerce($GLOBALS["User"]["Id"]);
        $cs->setIdRate($data["tarifa"]);
        $cs->setUuid(genUUid());
        $cs->setPickupAtName($data["lugar_retiro"]);
        $cs->setPickupAtLat($data["lugar_retiro_latitud"]);
        $cs->setPickupAtLng($data["lugar_retiro_longitud"]);
        $cs->setPickupAtLocality($data["lugar_retiro_localidad"]);
        $cs->setPickupAtRegion($data["lugar_retiro_region"]);
        $cs->setPickupAtCountry($data["lugar_retiro_pais"]);
        $cs->setSize($data["tamano"]);
        $cs->setType($data["tipo"]);
        $cs->setTypeRate($data["tipo_tarifa"]);
        $cs->setPriority($data["prioridad"]);
        $cs->setDescription($data["descripcion_contenido"]);
        $cs->setDeliveryDate(DateTime::createFromFormat('d/m/Y', $data["fecha_entrega"])->format('Y-m-d'));
        $cs->setAddresseeName($data["nombre_destinatario"]);
        $cs->setAddresseePhone($data["telefono_contacto"]);
        $cs->setDeliveryAddress($data["domicilio"]);
        $cs->setDeliveryAddressLat($data["domicilio_lat"]);
        $cs->setDeliveryAddressLng($data["domicilio_lng"]);
        $cs->setDeliveryAddressLocality($data["domicilio_localidad"]);
        $cs->setDeliveryAddressRegion($data["domicilio_region"]);
        $cs->setDeliveryAddressCountry($data["domicilio_pais"]);
        $cs->setRegisteredAt(gmdate("Y-m-d H:i:s"));
        if($cs->save()) {
            switch($cs->getSize()) {
                case 'small':
                    $measurements = array(
                        "width_unit" => "CM",
                        "width" => "33",
                        "height" => "33",
                        "height_unit" => "CM",
                        "depth" => "10",
                        "depth_unit" => "KG",
                        "weight" => "10",
                        "weight_unit" => "KG"
                    );
                break;
                case 'medium':
                    $measurements = array(
                        "width_unit" => "CM",
                        "width" => "80",
                        "height" => "80",
                        "height_unit" => "CM",
                        "depth" => "40",
                        "depth_unit" => "KG",
                        "weight" => "40",
                        "weight_unit" => "KG"
                    );
                break;
                case 'big':
                    $measurements = array(
                        "width_unit" => "M",
                        "width" => "1",
                        "height" => "1",
                        "height_unit" => "M",
                        "depth" => "100",
                        "depth_unit" => "KG",
                        "weight" => "100",
                        "weight_unit" => "KG"
                    );
                break;
                default:
                $measurements = array(
                    "width_unit" => null,
                    "width" => null,
                    "height" => null,
                    "height_unit" => null,
                    "depth" => null,
                    "depth_unit" => null,
                    "weight" => null,
                    "weight_unit" => null
                );
            }
            $s = new Shipments();
            $s->setIdUser($GLOBALS["User"]["IdUser"]);
            $s->setIdProductType($cs->getType());
            $s->setIdShipmentType($cs->getPriority());
            $s->setPin(mt_rand(10000000, 99999999));

            $s->setStartAddress($cs->getPickupAtName());
            $s->setStartAddressPlaceId("-");
            $s->setStartAddressLat($cs->getPickupAtLat());
            $s->setStartAddressLon($cs->getPickupAtLng());
            $s->setStartAddressLocality($cs->getPickupAtLocality());
            $s->setStartAddressRegion($cs->getPickupAtRegion());
            $s->setStartAddressCountry($cs->getPickupAtCountry());
            /*
            $s->setStartAddress($GLOBALS["User"]["Address"]);
            $s->setStartAddressPlaceId("-");
            $s->setStartAddressLat($GLOBALS["User"]["AddressLat"]);
            $s->setStartAddressLon($GLOBALS["User"]["AddressLng"]);
            $s->setStartAddressLocality($GLOBALS["User"]["AddressLocality"]);
            $s->setStartAddressRegion($GLOBALS["User"]["AddressRegion"]);
            $s->setStartAddressCountry($GLOBALS["User"]["AddressCountry"]);
            */
            $s->setEndAddress($cs->getDeliveryAddress());
            $s->setEndAddressPlaceId("-");
            $s->setEndAddressLat($cs->getDeliveryAddressLat());
            $s->setEndAddressLon($cs->getDeliveryAddressLng());
            $s->setEndAddressLocality($cs->getDeliveryAddressLocality());
            $s->setEndAddressRegion($cs->getDeliveryAddressRegion());
            $s->setEndAddressCountry($cs->getDeliveryAddressCountry());
            $s->setReceiverName($cs->getAddresseeName());
            $s->setReceiverPhone($cs->getAddresseePhone());
            $s->setDescription($cs->getDescription());
            $s->setOutNow(1);
            $s->setMaxArrivalDate($cs->getDeliveryDate()->format("Y-m-d H:i:s"));
            $s->setReceiveOffers($cs->getTypeRate() == 1 ? 0 : 1);
            $s->setAmountPayable($cs->getTypeRate() == 1 ? $taxAmmount : null);
            $s->setDeclaredValue($s->getAmountPayable());
            $s->setRegisteredAt($cs->getRegisteredAt());
            $s->setMeasurementsWidthUnit($measurements["width_unit"]);
            $s->setMeasurementsWidth($measurements["width"]);
            $s->setMeasurementsHeightUnit($measurements["height_unit"]);
            $s->setMeasurementsHeight($measurements["height"]);
            $s->setMeasurementsDepthUnit($measurements["depth_unit"]);
            $s->setMeasurementsDepth($measurements["depth"]);
            $s->setMeasurementsWeightUnit($measurements["weight_unit"]);
            $s->setMeasurementsWeight($measurements["weight"]);
            if($distData) {
                $s->setAddressDist1DisValue($distData->distance->value);
                $s->setAddressDist1DisDesc($distData->distance->value > 1000 ? intval($distData->distance->value / 1000) : ($distData->distance->value . " m"));
                $s->setAddressDist1DurValue($distData->duration->value);
                $s->setAddressDist1DurDesc(Utils::segsToReadable($distData->duration->value));
            }
            else {
                $s->setAddressDist1DisValue(0);
                $s->setAddressDist1DisDesc("-");
                $s->setAddressDist1DurValue(0);
                $s->setAddressDist1DurDesc("-");
            }
            if($s->save()) {
                $cs->setIdShipment($s->getId());
                $cs->save();

                $picName = $s->getId() . "_1." . pathinfo($GLOBALS["User"]["Logo"], PATHINFO_EXTENSION);
                copy(BASE_PATH . DIRECTORY_SEPARATOR . "app" . DIRECTORY_SEPARATOR . "uploads" . DIRECTORY_SEPARATOR . $GLOBALS["User"]["Logo"], BASE_PATH . DIRECTORY_SEPARATOR . "api" . DIRECTORY_SEPARATOR . "uploads" . DIRECTORY_SEPARATOR . "shipments" . DIRECTORY_SEPARATOR . $picName);

                $sp = new ShipmentsPictures();
                $sp->setIdShipment($s->getId());
                $sp->setName($picName);
                $sp->save();

                $soh = new ShipmentsOperationsHistory();
                $soh->setIdShipment($s->getId());
                $soh->setUid('register');
                $soh->setDatetime($s->getRegisteredAt());
                $soh->save();

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, str_replace("https", "http", API_BASE_PATH) . "/njs2red");
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(
                    array(
                        'action' => 'new shipment',
                        'data' => array(
                            'user' => array(
                                'id' => $GLOBALS["User"]["IdUser"],
                                'name' => $GLOBALS["User"]["BusinessName"]
                            ),
                            'shipment' => array(
                                'id' => $s->getId(),
                                'start_address' => array(
                                    'address' => $s->getStartAddress(),
                                    'lat' => $s->getStartAddressLat(),
                                    'lon' => $s->getStartAddressLon(),
                                    'locality' => $s->getStartAddressLocality(),
                                    'region' => $s->getStartAddressRegion(),
                                    'country' => $s->getStartAddressCountry()
                                ),
                                'end_address' => array(
                                    'address' => $s->getEndAddress(),
                                    'lat' => $s->getEndAddressLat(),
                                    'lon' => $s->getEndAddressLon(),
                                    'locality' => $s->getEndAddressLocality(),
                                    'region' => $s->getEndAddressRegion(),
                                    'country' => $s->getEndAddressCountry()
                                )
                            ),
                            'receive_offers' => $s->getReceiveOffers(),
                            'out_now' => $s->getOutNow(),
                            'amount_payable' => $s->getAmountPayable(),
                            'nightly' => null,
                            'f_day' => null,
                            'max_arrival_date' => $s->getMaxArrivalDate() ? $s->getMaxArrivalDate()->format('Y-m-d H:i:s') : null,
                            'urgent' => 0
                        )
                    )
                ));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $server_output = curl_exec($ch);
                if ($server_output === false) {
                    //echo curl_error($ch) . " " . curl_errno($ch);
                }
                curl_close ($ch);
                //echo $server_output;

                if(isset($_POST["submit-alt-form-pshipments"])) { // redirect
                    header('Location: envios-programados');
                }
                else {
                    $successMessage = "Envío agregado satisfactoriamente.";
                }
            }
            else {
                $cs->remove();
                $errorMessage = "No se pudo guardar el envío.";
            }
        }
        else {
            $errorMessage = "No se pudo guardar el envío.";
        }
    }

    function getClientsAutocompleteData() {
        $clients = CommercesClientsQuery::create()->filterByIdCommerce($GLOBALS["User"]["Id"]);
        $r = array();
        foreach($clients as $c) {
            $r[] = array(
                "label" => $c->getFullname(),
                "value" => $c->getFullname()
            );
        }
        return $r;
    }
?>
<!doctype html>
<html lang="es" class="h-100">

<head>
    <?php require_once('inc/head.php'); ?>
    <link rel="stylesheet" href="lib/flatpickr/flatpickr.min.css">
    <link rel="stylesheet" href="assets/css/extra.css">
    <?php if($canScheduleShipments): ?>
        <style>
            .cards-pshipments {
                display: flex;
                justify-content: space-between;
            }

            .cards-pshipments .card {
                border: 0;
                width: calc(33% - 8px);
                background: #f5f6fa;
                cursor: pointer;
            }

            .cards-pshipments .card .card-body {
                padding-top: 64px;
                background-color: #E6E7E8;
                color: #808285;
                border-radius: 16px;
                margin-top: 48px;
                padding-left: 16px;
                padding-right: 16px;
                transition: background-color 200ms;
            }

            .cards-pshipments .card.selected .card-body {
                background-color: var(--bs-primary);
                color: white;
            }

            .cards-pshipments .card .card-header {
                border: 0;
                background: transparent;
                display: flex;
                align-items: center;
                justify-content: center;
                position: absolute;
            }

            .cards-pshipments .card .card-header img {
                width: 60%;
            }

            .cards-pshipments .card[data-size="small"] .card-header img {
                margin-top: 12px;
            }

            .cards-pshipments .card [data-el="title"] {
                font-size: 20px;
                font-family: 'GibsonW SemiBold';
            }

            .cards-pshipments .card [data-el="description"] {
                line-height: 18px;
                font-size: 15px;
            }

            .cards-pshipments .card [data-el="info-title"] {
                font-size: 13px;
                margin-top: 12px;
            }

            .cards-pshipments .card [data-el="info-content"] {
                font-size: 18px;
                font-family: 'GibsonW SemiBold';
                line-height: 20px;
            }

            #rplace-container {
                display: flex;
                align-items: center;
                position: relative;
            }

            #rplace-container input {
                margin-left: 8px;
                background: #f5f6fa;
            }

            #rplace-container img {
                height: 15px;
            }

            #rplace-container a {
                position: absolute;
                right: 24px;
            }

            #rplace-container a:last-child {
                right: 0;
            }

            #rplace {
                border-radius: 0;
                border-left: 0;
                border-top: 0;
                border-right: 0;
                height: 32px;
                font-size: 15px;
                padding-right: 48px;
                text-overflow: ellipsis;
            }

            #rplace:focus {
                box-shadow: none;
                border-bottom: 2px solid var(--bs-primary);
            }

            #pinpuntoretiro {
                width: 40px;
                height: 45px;
            }
        </style>
    <?php endif ?>
</head>

<body class="<?php echo BODY_CLASS; ?>">
    <?php require_once('inc/navbar.php'); ?>
    <?php require_once('inc/sidebar.php'); ?>
    <?php if($canScheduleShipments): ?>
        <div class="main-content p-0 no-scroll">
            <div class="row g-0 no-scroll">
                <div id="box-form-pshipments" style="width: 560px;">
                    <div class="p-4 mb-5 pb-5">
                        <form id="form-pshipments" class="mt-0 mb-4" method="post" action="">
                            <div class="row">
                                <div class="col-lg-12 col-sm-12 mb-3">
                                    <div id="rplace-container">
                                        <img src="assets/images/pick-it-place.svg" alt="">
                                        <input type="text" class="form-control" name="lugar_retiro" placeholder="Lugar de retiro" id="rplace" required>
                                        <input type="hidden" name="lugar_retiro_latitud">
                                        <input type="hidden" name="lugar_retiro_longitud">
                                        <input type="hidden" name="lugar_retiro_localidad">
                                        <input type="hidden" name="lugar_retiro_region">
                                        <input type="hidden" name="lugar_retiro_pais">
                                        <a href="#"><img src="assets/images/search.svg" alt=""></a>
                                        <a href="#" data-action="current-location"><img src="assets/images/my-location.svg" alt=""></a>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-sm-12 mb-3">
                                    <div class="cards-pshipments">
                                        <div class="card selected" data-size="small">
                                            <div class="card-header">
                                                <img src="assets/images/package-small.svg" alt="">
                                            </div>
                                            <div class="card-body">
                                                <div data-el="title">Pequeño</div>
                                                <div data-el="description">Entra en una caja de zapatos</div>
                                                <div data-el="info-title">Peso Máximo/Largo:</div>
                                                <div data-el="info-content">10 kg | 33 cm</div>
                                            </div>
                                            <input type="radio" name="tamano" class="d-none" value="small" checked>
                                        </div>
                                        <div class="card" data-size="medium">
                                            <div class="card-header">
                                                <img src="assets/images/package-medium.svg" alt="">
                                            </div>
                                            <div class="card-body">
                                                <div data-el="title">Mediano</div>
                                                <div data-el="description">Entra en una caja de zapatos</div>
                                                <div data-el="info-title">Peso Máximo/Alto:</div>
                                                <div data-el="info-content">40 kg | 80 cm</div>
                                            </div>
                                            <input type="radio" name="tamano" class="d-none" value="medium">
                                        </div>
                                        <div class="card" data-size="big">
                                            <div class="card-header">
                                                <img src="assets/images/package-big.svg" alt="">
                                            </div>
                                            <div class="card-body">
                                                <div data-el="title">Grande</div>
                                                <div data-el="description">Ideal para el maletero</div>
                                                <div data-el="info-title">Peso Máximo/Ancho:</div>
                                                <div data-el="info-content">100 kg | 1mt</div>
                                            </div>
                                            <input type="radio" name="tamano" class="d-none" value="big">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-sm-12 mb-3 form-group">
                                    <label class="form-label">Tipo de envío</label>
                                    <select class="form-control" name="prioridad">
                                        <option value="1" selected>Normal</option>
                                        <option value="2">Urgente</option>
                                    </select>
                                </div>
                                <div class="col-lg-6 col-sm-12 mb-3 form-group">
                                    <label class="form-label">¿Qué estás enviando?</label>
                                    <select class="form-control" name="tipo">
                                        <?php foreach($productTypes as $p): ?>
                                            <option value="<?php echo $p->getId(); ?>"><?php echo $p->getName(); ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                                <div class="col-lg-6 col-sm-12 mb-3 form-group">
                                    <label class="form-label">Fecha de entrega</label>
                                    <img src="assets/images/calendar.svg" alt="" class="input-icon">
                                    <input type="text" class="form-control" name="fecha_entrega" required>
                                </div>
                                <div class="col-lg-12 col-sm-12 mb-3 form-group">
                                    <label class="form-label">Describa el contenido <span class="float-right">0/60</span></label>
                                    <textarea cols="30" rows="10" class="form-control" name="descripcion_contenido" maxlength="60" required></textarea>
                                </div>
                                <div class="col-lg-6 col-sm-12 mb-3 form-group">
                                    <label class="form-label">Nombre del destinatario</label>
                                    <img src="assets/images/search.svg" alt="" class="input-icon">
                                    <input type="text" class="form-control" name="nombre_destinatario" required autocomplete="off">
                                </div>
                                <div class="col-lg-6 col-sm-12 mb-3 form-group">
                                    <label class="form-label">Teléfono de contacto (opcional)</label>
                                    <input type="text" class="form-control" name="telefono_contacto">
                                </div>
                                <div class="col-lg-12 col-sm-12 mb-3 form-group">
                                    <label class="form-label">Domicilio de entrega</label>
                                    <input type="text" class="form-control" name="domicilio" required>
                                    <input type="hidden" class="form-control" name="domicilio_lat">
                                    <input type="hidden" class="form-control" name="domicilio_lng">
                                    <input type="hidden" class="form-control" name="domicilio_localidad">
                                    <input type="hidden" class="form-control" name="domicilio_region">
                                    <input type="hidden" class="form-control" name="domicilio_pais">
                                </div>
                                <div class="col-lg-12 col-sm-12 mb-3 form-group">
                                    <label class="form-label">Tarifa</label>
                                    <select class="form-control" name="tipo_tarifa">
                                        <option value="1" selected>Por zona (pago fijo)</option>
                                        <option value="2">Recibir ofertas</option>
                                    </select>
                                </div>
                                <div class="col-lg-12 col-sm-12 mb-3 form-group">
                                    <?php if(count($rates) == 0): ?>
                                        <div class="card border-danger">
                                            <div class="card-body text-danger">
                                                <p class="card-text mb-0">Aún no ha creado ninguna tarifa.</p>
                                                <a href="tarifas" class="btn btn-primary button-wide mt-3">Ir a Tarifas</a>
                                            </div>
                                        </div>
                                    <?php else: ?>
                                        <label class="form-label">Tarifa a pagar</label>
                                        <select class="form-control" name="tarifa">
                                            <?php foreach($rates as $r): ?>
                                                <option value="<?php echo $r->getId() . "|" . $r->getPrice(); ?>" data-value="<?php echo $r->getId(); ?>"><?php echo $r->getName(); ?></option>
                                            <?php endforeach ?>
                                        </select>
                                        <small class="text-danger">La tarifa se calcula automáticamente desde el punto de partida hasta destino</small>
                                    <?php endif ?>
                                </div>
                            </div>
                            
                            <div class="container-fluid mt-4">
                                <div class="row justify-content-center">
                                    <div class="col-lg-4 col-xs-4">
                                        <button type="submit" class="btn btn-primary w-100" name="submit-alt-form-pshipments">Crear envío</button>
                                    </div>
                                    <div class="col-lg-8 col-xs-8">
                                        <button type="submit" class="btn btn-secondary w-100" name="submit-form-pshipments">Crear y continuar cargando</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div id="map-wrapper" style="max-width: calc(100% - 560px);">
                    <div id="map"></div>
                </div>
            </div>
        </div>
    <?php else: ?>
        <?php if(!$GLOBALS["User"]["MP"]): ?>
            <div class="main-content d-flex align-items-center justify-content-center">
                <div class="card border-danger p-3 col-lg-6 col-sm-12">
                    <div class="card-body text-danger">
                        <h5 class="card-title mb-3">Aún no ha conectado la billetera a su cuenta</h5>
                        <p class="card-text">Debe autorizar a Nviame a gestionar los<br>pagos que realizará mediante la aplicación.</p>
                        <a href="billetera" class="btn btn-primary button-wide mt-3">Ir a Mi Billetera</a>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="main-content d-flex align-items-center justify-content-center">
                <div class="card border-danger p-3 col-lg-6 col-sm-12">
                    <div class="card-body text-danger">
                        <h5 class="card-title mb-3">Aún no ha completado la información de su cuenta</h5>
                        <p class="card-text">Para programar envíos se requiere completar todos los datos de su perfil, incluído el logotipo.</p>
                        <a href="mi-cuenta" class="btn btn-primary button-wide mt-3">Ir a Mi Cuenta</a>
                    </div>
                </div>
            </div>
        <?php endif ?>
    <?php endif ?>
    <?php require_once('inc/scripts.php'); ?>
    <?php if($canScheduleShipments): ?>
        <div id="pinpuntoretiro">
            <?php require_once("pin-punto-retiro.php"); ?>
        </div>

        <script src="lib/html2canvas/html2canvas.min.js" type="text/javascript"></script>
        <script src="lib/flatpickr/flatpickr.min.js" type="text/javascript"></script>
        <script src="lib/flatpickr/es.js" type="text/javascript"></script>
        <script src="lib/gch1p-bootstrap-5-autocomplete/bs5-autocomplete.js" type="text/javascript"></script>
        <script>
            <?php if($successMessage): ?>
                Toasts.success('<?php echo $successMessage; ?>');
            <?php endif ?>
            <?php if($errorMessage): ?>
                Toasts.error('<?php echo $errorMessage; ?>');
            <?php endif ?>
            
            $(function() {
                $('#form-pshipments [name="descripcion_contenido"]').keyup(e => {
                    $('#form-pshipments [name="descripcion_contenido"]').closest('.form-group').find('.form-label .float-right').text(e.target.value.length + '/60');
                });

                $('#form-pshipments').validate({
                    submitHandler: (form) => {
                        var band = true;
                        if($('#form-pshipments [name="tipo_tarifa"]').val() == 1 && !$('#form-pshipments [name="tarifa"]').val()) {
                            band = false;
                            Dialogs.error('Error', 'Ha seleccionado la tarifa por zona,<br>pero ninguna zona ha sido seleccionada.');
                        }
                        if(band) {
                            form.submit();
                        }
                    }
                })

                $('#form-pshipments [name="tarifa"]').select2('destroy');
                $('#form-pshipments [name="tarifa"]').select2({
                    theme: "bootstrap-5",
                    escapeMarkup: function(markup) {
                        return markup;
                    },
                    templateResult: function (data, container) {
                        return data.hasOwnProperty('id') ? `<span>${data.text}<span class="float-end me-2">$ ${data.id.split('|').pop()}</span></span>` : '';
                    },
                    templateSelection: function(data) {
                        return data.hasOwnProperty('id') ? `<span>${data.text}<span class="float-end me-2">$ ${data.id.split('|').pop()}</span></span>` : '';
                    }
                });

                flatpickr.localize(flatpickr.l10ns.es);
                flatpickr('#form-pshipments [name="fecha_entrega"]', {
                    dateFormat: 'd/m/Y',
                    //minDate: new Date(new Date().setDate(new Date().getDate() + 1)),
                    minDate: new Date(),
                    monthSelectorType: 'static'
                });

                $('#rplace-container [data-action="current-location"]').click(function() {
                    navigator.geolocation.getCurrentPosition(function (pos) {
                        var crd = pos.coords;
                        $('#rplace').val(`${crd.latitude},${crd.longitude}`).trigger('change');
                        $('#rplace-container [name="lugar_retiro_latitud"]').val(crd.latitude).trigger('change');
                        $('#rplace-container [name="lugar_retiro_longitud"]').val(crd.longitude).trigger('change');
                        $.getJSON("https://nominatim.openstreetmap.org/reverse", {
                            lat: crd.latitude,
                            lon: crd.longitude,
                            format: "json",
                        }, function (result) {
                            if(typeof result.display_name != "undefined") {
                                $('#rplace').val(result.display_name).trigger('change');
                                $('#rplace').removeClass('error').attr('aria-invalid', null);
                                $('#rplace-error').hide();
                            }
                        });
                    }, function (err) {
                        console.warn('ERROR(' + err.code + '): ' + err.message);
                    }, {
                        enableHighAccuracy: true,
                        timeout: 5000,
                        maximumAge: 0
                    });
                });
            });
        </script>
        <script>
            let map = null, autocomplete = null, autocompleteDeliveryAddress = null;
            var markerOrigin = null, markerDestination = null;
            var directionsService = null;
            var directionsRenderer = null;

            function drawRoute() {
                if(!markerOrigin || !markerDestination) return;
                if(!markerOrigin.getPosition() || !markerDestination.getPosition()) return;
                var start = markerOrigin.getPosition();
                var end = markerDestination.getPosition();
                var request = {
                    origin: new google.maps.LatLng(start.lat(), start.lng()),
                    destination: new google.maps.LatLng(end.lat(), end.lng()),
                    travelMode: 'DRIVING'
                };
                directionsService.route(request, function(result, status) {
                    console.log(result, status);
                    if (status == 'OK') {
                        directionsRenderer.setMap(map);
                        directionsRenderer.setDirections(result);
                    }
                });
            }
            function initMap() {
                document.querySelector('#map-wrapper').style.height = (document.querySelector('.main-content').offsetHeight + 56) + 'px';
                document.querySelector('#box-form-pshipments').style.maxHeight = (document.querySelector('.main-content').offsetHeight - 64) + 'px';
                document.querySelector('#box-form-pshipments').style.overflowY = 'auto';

                directionsService = new google.maps.DirectionsService();
                directionsRenderer = new google.maps.DirectionsRenderer({
                    suppressMarkers: true,
                    suppressInfoWindows: true,
                    polylineOptions: {
                        strokeColor: '#4C00FF',
                        strokeOpacity: 1.0,
                        strokeWeight: 4
                    }
                });
                
                map = new google.maps.Map(document.getElementById("map"), {
                    center: { lat: -38.71959, lng: -62.27243 },
                    zoom: 8
                });

               markerOrigin = new google.maps.Marker({
                    map: map
                });
                var markerOriginIW = new google.maps.InfoWindow({
                    content: `<div id="markerOriginIW" style="padding: 10px;width: 264px;">Detectando ubicación...</div>`
                });
                markerOriginIW.open({
                    anchor: markerOrigin,
                    map,
                    shouldFocus: false
                });

                html2canvas(document.querySelector("#pinpuntoretiro"), {
                    backgroundColor: null,
                    width: 40,
                    height: 45
                }).then(canvas => {
                    markerOrigin.setIcon({
                        url: canvas.toDataURL(),
                        scaledSize: new google.maps.Size(40, 45),
                        origin: new google.maps.Point(0, 0)
                    });
                });

                markerDestination = new google.maps.Marker({
                    map: map,
                    icon: {
                        url: 'assets/images/racing-flag.svg',
                        scaledSize: new google.maps.Size(48, 48),
                        origin: new google.maps.Point(0, 0)
                    }
                });
                var markerDestinationIW = new google.maps.InfoWindow({
                    content: `<div id="markerDestinationIW" style="padding: 10px;width: 264px;">Detectando ubicación...</div>`
                });
                markerDestinationIW.open({
                    anchor: markerDestination,
                    map,
                    shouldFocus: false
                });

                autocomplete = new google.maps.places.Autocomplete(document.getElementById('rplace'), {
                    componentRestrictions: { country: "ar" }
                });

                autocomplete.addListener("place_changed", () => {
                    markerOrigin.setVisible(false);
                    const place = autocomplete.getPlace();

                    if (!place.geometry || !place.geometry.location) {
                        // User entered the name of a Place that was not suggested and
                        // pressed the Enter key, or the Place Details request failed.
                        window.alert("No details available for input: '" + place.name + "'");
                        return;
                    }

                    // If the place has a geometry, then present it on a map.
                    if (place.geometry.viewport) {
                        map.fitBounds(place.geometry.viewport);
                    } else {
                        map.setCenter(place.geometry.location);
                        map.setZoom(17);
                    }
                    markerOrigin.setPosition(place.geometry.location);
                    markerOrigin.setVisible(true);

                    drawRoute();

                    $('#markerOriginIW').html($('#rplace-container [name="lugar_retiro"]').val());

                    $.getJSON("https://nominatim.openstreetmap.org/reverse", {
                        lat: place.geometry.location.lat(),
                        lon: place.geometry.location.lng(),
                        format: "json",
                    }, function (result) {
                        if(typeof result.address === 'object') {
                            var components = {
                                "locality": result.address.city,
                                "region": result.address.state,
                                "country": result.address.country
                            };
                        }
                        else {
                            var el = document.createElement('DIV');
                            el.innerHTML = place.adr_address;
                            var components = {
                                "locality": $(el).find('.locality').text() || "",
                                "region": $(el).find('.region').text() || "",
                                "country": $(el).find('.country-name').text() || ""
                            }; 
                        }
                        $('#rplace-container [name="lugar_retiro_latitud"]').val(place.geometry.location.lat()).trigger('change');
                        $('#rplace-container [name="lugar_retiro_longitud"]').val(place.geometry.location.lng()).trigger('change'); 
                        $('#rplace-container [name="lugar_retiro_localidad"]').val(components.locality).trigger('change'); 
                        $('#rplace-container [name="lugar_retiro_region"]').val(components.region).trigger('change'); 
                        $('#rplace-container [name="lugar_retiro_pais"]').val(components.country).trigger('change');
                    });
                });

                autocompleteDeliveryAddress = new google.maps.places.Autocomplete(document.querySelector('#form-pshipments [name="domicilio"]'), {
                    componentRestrictions: { country: "ar" }
                });

                autocompleteDeliveryAddress.addListener("place_changed", () => {
                    const place = autocompleteDeliveryAddress.getPlace();

                    if (!place.geometry || !place.geometry.location) {
                        // User entered the name of a Place that was not suggested and
                        // pressed the Enter key, or the Place Details request failed.
                        window.alert("No details available for input: '" + place.name + "'");
                        return;
                    }

                    markerDestination.setPosition(place.geometry.location);
                    markerDestination.setVisible(true);

                    drawRoute();

                    $('#markerDestinationIW').html($('#form-pshipments [name="domicilio"]').val());

                    $.getJSON("https://nominatim.openstreetmap.org/reverse", {
                        lat: place.geometry.location.lat(),
                        lon: place.geometry.location.lng(),
                        format: "json",
                    }, function (result) {
                        if(typeof result.address === 'object') {
                            var components = {
                                "locality": result.address.city,
                                "region": result.address.state,
                                "country": result.address.country
                            };
                        }
                        else {
                            var el = document.createElement('DIV');
                            el.innerHTML = place.adr_address;
                            var components = {
                                "locality": $(el).find('.locality').text() || "",
                                "region": $(el).find('.region').text() || "",
                                "country": $(el).find('.country-name').text() || ""
                            };
                        }
                        $('#form-pshipments [name="domicilio_lat"]').val(place.geometry.location.lat()).trigger('change'); 
                        $('#form-pshipments [name="domicilio_lng"]').val(place.geometry.location.lng()).trigger('change'); 
                        $('#form-pshipments [name="domicilio_localidad"]').val(components.locality).trigger('change'); 
                        $('#form-pshipments [name="domicilio_region"]').val(components.region).trigger('change'); 
                        $('#form-pshipments [name="domicilio_pais"]').val(components.country).trigger('change');
                    });
                });
            }
        </script>
        <script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCiWj9PLdW0zCxe3HzK00xS6YawLIZjBXg&libraries=places&callback=initMap"></script>
        <script>
            window.onload = function() {
                $('.cards-pshipments .card').click(function() {
                    $('.cards-pshipments .card').removeClass('selected');
                    $(this).addClass('selected');
                    $(this).find('input[type="radio"]').prop('checked', true);
                });

                $('#form-pshipments [name="tipo_tarifa"]').change(function() {
                    const v = this.value;
                    if(v == 1) {
                        $('#form-pshipments [name="tarifa"]').closest('.form-group').slideDown();
                        $('#form-pshipments [href="tarifas"]').closest('.form-group').slideDown();
                    }
                    else {
                        $('#form-pshipments [name="tarifa"]').closest('.form-group').slideUp();
                        $('#form-pshipments [href="tarifas"]').closest('.form-group').slideUp();
                    }
                });

                $('#form-pshipments [name="domicilio"]').focus(function() {
                    $('#form-pshipments [name="domicilio"]').val('').trigger('change');
                    $('#form-pshipments [name="domicilio_lat"]').val('').trigger('change');
                    $('#form-pshipments [name="domicilio_lng"]').val('').trigger('change');
                });
                $('#form-pshipments [name="domicilio"]').blur(function() {
                    setTimeout(() => {
                        const place = autocompleteDeliveryAddress.getPlace();
                        if ($('#form-pshipments [name="domicilio"]').val() && place && place.geometry && place.geometry.location) {
                            $('#form-pshipments [name="domicilio"]').val(place.formatted_address).trigger('change');
                        }
                        else {
                            $('#form-pshipments [name="domicilio"]').val('').trigger('change');
                        }
                    }, 1000);
                });

                const ac = new Autocomplete(document.querySelector('#form-pshipments [name="nombre_destinatario"]'), {
                    data: <?php echo json_encode(getClientsAutocompleteData()); ?>
                });
            }
        </script>
    <?php else: ?>

    <?php endif ?>
</body>

</html>