<?php
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);

    require_once('inc/globals.php');
    $shipments = ShipmentsQuery::create()->where('id_status IS NOT NULL')->findByIdUser($GLOBALS["User"]["IdUser"]) ?: array();
    $shipmentsC = array();
    $shipmentsO = array();
    $shipmentsOU = array();
    $shipmentsOH = array();
    $shipmentsAll = array();
    foreach($shipments as $s) {
        $cs = CommercesShipmentsQuery::create()->findOneByIdShipment($s->getId());
        $offer = ShipmentsOffersQuery::create()->findOneByIdShipment($s->getId());
        $shipmentsC[$s->getId()] = $cs;
        $shipmentsO[$s->getId()] = $offer;
        $shipmentsOU[$s->getId()] = UsersQuery::create()->findPK($offer->getIdUser());
        $shipmentsOH[$s->getId()] = array();
        $oh = ShipmentsOperationsHistoryQuery::create()->findByIdShipment($s->getId());
        foreach($oh as $k => $hr) {
            $shipmentsOH[$s->getId()][$k] = json_decode($hr->toJSON(), true);
        }
        $shipmentsOH[$s->getId()] = array_map(function($r) {
            return $r[0];
        }, _group_by($shipmentsOH[$s->getId()], "Uid"));
        $shipmentsAll[] = json_decode($s->toJSON(), true);
    }
    //echo count($shipments); die();
    //echo $shipments[0]->toJSON();
    //echo $shipmentsO[42]->toJSON();
    //echo $shipmentsOU[42]->toJSON();
    //echo json_encode($shipmentsOH[42]);
    //die();
    function shipmentsStatusName($id) {
        switch($id) {
            case 1:
                return "Esperando pago";
            break;
            case 2:
                return "Esperando retiro";
            break;
            case 3:
                return "Retirado";
            break;
            case 4:
                return "En viaje";
            break;
            case 5:
                return "Entregado";
            break;
            case 6:
                return "Por devolver";
            break;
            case 7:
                return "Devuelto";
            break;
        }
        return "";
    }
?>
<!doctype html>
<html lang="es" class="h-100">

<head>
    <?php require_once('inc/head.php'); ?>
    <link rel="stylesheet" href="assets/css/extra.css">
</head>

<body class="<?php echo BODY_CLASS; ?>">
    <?php require_once('inc/navbar.php'); ?>
    <?php require_once('inc/sidebar.php'); ?>
    <div class="main-content p-2">
        <div class="card card-box h-80">
            <div class="card-body">
                <h2 class="card-title">Actividad <input type="text" placeholder="Buscar" class="form-control table-search"/></h2>
                <table id="tshipments" class="table table-borderless">
                    <thead>
                        <tr>
                            <th scope="col">ID Envío</th>
                            <th scope="col">Destino</th>
                            <th scope="col">Fecha de entrega</th>
                            <th scope="col">Nombre del cliente</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Valor del envío</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                        <!--
                        <tr>
                            <td>0001122</td>
                            <td><span class="text-highlight">Salinas Chicas 918</span></td>
                            <td>21/05/2021</td>
                            <td>Carlos Schmidt</td>
                            <td><span data-shipment-status="2">ESPERANDO RETIRO</span></td>
                            <td><strong>$ 150.00</strong></td>
                        </tr>
                        <tr>
                            <td>0001121</td>
                            <td><span class="text-highlight">Salinas Chicas 918</span></td>
                            <td>21/05/2021</td>
                            <td>Carlos Schmidt</td>
                            <td><span data-shipment-status="4">EN VIAJE</span></td>
                            <td><strong>$ 150.00</strong></td>
                        </tr>
                        <tr>
                            <td>0001120</td>
                            <td><span class="text-highlight">Salinas Chicas 918</span></td>
                            <td>21/05/2021</td>
                            <td>Carlos Schmidt</td>
                            <td><span data-shipment-status="5">ENTREGADO</span></td>
                            <td><strong>$ 150.00</strong></td>
                        </tr>
                    -->
                    <tbody><?php foreach($shipments as $s): $oh = $shipmentsOH[$s->getId()]; ?>
                        <tr data-tmp="<?php echo json_encode($oh); ?>">
                            <td><?php echo $shipmentsC[$s->getId()]->getUuid(); ?></td>
                            <td><span class="text-highlight"><?php echo Utils::shortAddress($s->getEndAddress()); ?></span></td>
                            <td><?php echo $s->getMaxArrivalDate()->format('d/m/Y'); ?></td>
                            <td><?php echo $shipmentsOU[$s->getId()]->getFullname(); ?></td>
                            <td>
                                <?php if(array_key_exists("delivery_notification", $oh) && $s->getIdStatus() == 4): ?>
                                    <a href="javascript: void(0);" class="btn btn-primary btn-sm w-100" data-action="confirm-received" data-target="<?php echo $s->getId(); ?>">Confirmar recibido</a>
                                <?php else: ?>
                                    <span data-shipment-status="<?php echo $s->getIdStatus(); ?>" class="text-uppercase"><?php echo shipmentsStatusName($s->getIdStatus()); ?></span>
                                <?php endif ?>
                            </td>
                            <td><strong><?php echo array_key_exists("offer_accepted", $oh) ? Utils::moneyFormat($oh["offer_accepted"]["Valor"]) : ($s->getAmountPayable() ? Utils::moneyFormat($s->getAmountPayable()) : 'Recibe ofertas'); ?></strong></td>
                            <td>
                                <div class="w-100 d-flex align-items-center">
                                    <?php if($s->getIdStatus() == 3 || $s->getIdStatus() == 4): ?>
                                        <a href="javascript: void(0);" data-action="see-route" data-target="<?php echo $s->getId(); ?>" data-u="<?php echo $oh["offer_accepted"]["IdUser"]; ?>">Ver recorrido <i class="ms-1"><img src="assets/images/see-route.svg" alt="" height="10"></i></a>
                                    <?php elseif($s->getIdStatus() == 5): ?>
                                        <a href="javascript: void(0);" data-action="rate-user" data-target="<?php echo $s->getId(); ?>"><i class="me-1"><img src="assets/images/rate.svg" alt="" height="10"></i> Calificar</a>
                                    <?php endif ?>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach ?></tbody>
                </table>
            </div>
        </div>
    </div>
    <?php require_once('inc/scripts.php'); ?>
    <?php require_once('inc/api.php'); ?>
    <script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCiWj9PLdW0zCxe3HzK00xS6YawLIZjBXg&libraries=places"></script>
    <script>
        $(() => {
            /*
            window._s_no = (data) => {
                socket.emit('check count offers shipments', {});
                socket.emit('shipment offers', {
                    id: data.shipment.id
                });
            }
            */
            window._s_sd = (data) => {
                location.reload();
            }
            window._s_n = (n) => {
                location.reload();
            }
            window._s_sto = (data) => {
                location.reload();
            }
            window._s_sr = (data) => {
                location.reload();
            }
            window._s_stu = (data) => {
                location.reload();
            }
            window._s_no = (data) => {
                location.reload();
            }
            window._s_so = (o) => {
                location.reload();
            }

            $('#tshipments tr td [data-action="confirm-received"]').click(function() {
                var ds = this.dataset;
                Dialogs.question('Confirmar recibido', `¿Ha verificado que el recorrido fue correcto? Una vez confirmado, la entrega se dará por finalizada.`, () => {
                    $('#tshipments').closest('.card').addClass('card-loading-overlay');
                    socket.emit('shipment delivered', {
                        id: ds.target
                    });
                });
            });

            $('#tshipments tr td [data-action="see-route"]').click(function() {
                var ds = this.dataset;
                const _dataS = <?php echo json_encode($shipmentsAll); ?>;
                const info = _dataS.filter(r => r.Id == ds.target).pop();
                if($('#mdSeeRoute').length == 0) {
                    $('body').prepend(`
                        <div class="modal fade" id="mdSeeRoute" style="display: none;" aria-hidden="true">
                            <div class="modal-dialog modal-fullscreen modal-dialog-centered">
                                <form class="modal-content" action="" method="post" novalidate="novalidate">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Ruta</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body p-0 map-loading-overlay"></div>
                                </form>
                            </div>
                        </div>
                    `);
                }
                $('#mdSeeRoute .modal-body').html(`
                    <div id="map-wrapper">
                        <div id="map" style="height: ${window.innerHeight - 56}px;width: ${window.innerWidth}px;"></div>
                    </div>
                `);
                mapLiveTracking = new google.maps.Map(document.getElementById("map"), {
                    center: { lat: -38.71959, lng: -62.27243 },
                    zoom: 8
                });
                /*var */originPosition = new google.maps.LatLng(parseFloat(info.StartAddressLat), parseFloat(info.StartAddressLon));

                function f(mpplPath) {
                    /*var */directionsService = new google.maps.DirectionsService();
                    /*var */directionsRenderer = new google.maps.DirectionsRenderer({
                        suppressMarkers: true,
                        suppressInfoWindows: true,
                        polylineOptions: {
                            strokeOpacity: 0
                        }
                    });
                
                    /*var */markerOrigin = new google.maps.Marker({
                        position: originPosition,
                        map: mapLiveTracking,
                        icon: {
                            url: 'assets/images/TRACKING-PIN-ubicacion-inicial.svg',
                            scaledSize: new google.maps.Size(48, 48),
                            origin: new google.maps.Point(0, 0)
                        }
                    });
                    /*var */markerOriginIW = new google.maps.InfoWindow({
                        content: `<div style="padding: 10px;width: 264px;">${info.StartAddress}</div>`
                    });
                    markerOriginIW.open({
                        anchor: markerOrigin,
                        mapLiveTracking,
                        shouldFocus: false
                    });
                    /*var */markerPosition = new google.maps.Marker({
                        position: new google.maps.LatLng(mpplPath[0].lat, mpplPath[0].lng),
                        map: mapLiveTracking,
                        icon: {
                            url: 'assets/images/TRACKING-PIN-ubicacion-actual.svg',
                            scaledSize: new google.maps.Size(48, 48),
                            origin: new google.maps.Point(0, 0)
                        }
                    });
                    /*var */markerDestination = new google.maps.Marker({
                        position: new google.maps.LatLng(parseFloat(info.EndAddressLat), parseFloat(info.EndAddressLon)),
                        map: mapLiveTracking,
                        icon: {
                            url: 'assets/images/TRACKING-PIN-ubicacion-final.svg',
                            scaledSize: new google.maps.Size(48, 48),
                            origin: new google.maps.Point(0, 0)
                        }
                    });
                    /*var */markerDestinationIW = new google.maps.InfoWindow({
                        content: `<div style="padding: 10px;width: 264px;">${info.EndAddress}</div>`
                    });
                    markerDestinationIW.open({
                        anchor: markerDestination,
                        mapLiveTracking,
                        shouldFocus: false
                    });
                    
                    markerPosition.setVisible(false);

                    markerPosition.parentRoutePath = [];

                    markerPosition.pl = {
                        polyline: null,
                        path: mpplPath,
                        addToPath: function(data) {
                            if(markerPosition.pl.polyline) {
                                var path = markerPosition.pl.polyline.getPath();
                                var latLng = new google.maps.LatLng(data.lat, data.lng);
                                path.push(latLng);
                                markerPosition.pl.polyline.setPath(path);
                                markerPosition.setPosition(latLng);
                            }
                        }
                    };
                
                    directionsRenderer.setMap(mapLiveTracking);
                
                    (function () {
                        var rad = function (x) {
                            return x * Math.PI / 180;
                        };

                        var getDistance = function (p1, p2) {
                            var R = 6378137; // Earth’s mean radius in meter
                            var dLat = rad(p2.lat() - p1.lat());
                            var dLong = rad(p2.lng() - p1.lng());
                            var a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
                                Math.cos(rad(p1.lat())) * Math.cos(rad(p2.lat())) *
                                Math.sin(dLong / 2) * Math.sin(dLong / 2);
                            var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
                            var d = R * c;
                            return d; // returns the distance in meter
                        };

                        var start = markerOrigin.getPosition();
                        var end = markerDestination.getPosition();
                        /*var waypts = [{
                            location: markerPosition.getPosition(),
                            stopover: false
                        }];*/
                        directionsService.route({
                            origin: start,
                            destination: end,
                            travelMode: 'DRIVING'/*,
                            waypoints: waypts*/
                        }, function (response, status) {
                            if (status === 'OK') {
                                markerPosition.parentRoutePath = response.routes[0].overview_path;

                                console.log('$$$$$ directionsService.route ~ ', response);

                                directionsRenderer.setDirections(response);

                                var path = [],
                                    path2 = [];

                                var dist = 0;
                                var band = true,
                                    band2 = false;

                                response.routes[0].overview_path.forEach(function(r) {
                                    dist = getDistance(r, markerPosition.getPosition());
                                    if(band) {
                                        path.push(r);
                                    }
                                    if((dist | 0) == 0) {
                                        band = false;
                                        band2 = true;
                                    }
                                    if(band2) {
                                        path2.push(r);
                                    }
                                });
                                pll = new google.maps.Polyline({
                                    path: path,
                                    strokeOpacity: 0,
                                    icons: [{
                                        icon: {
                                            path: 'M 0,-1 0,1',
                                            strokeOpacity: 1,
                                            scale: 2
                                        },
                                        offset: '0',
                                        repeat: '12px'
                                    }]
                                });
                                pll.setMap(mapLiveTracking);
                                markerPosition.pl.polyline = new google.maps.Polyline({
                                    path: markerPosition.pl.path,
                                    geodesic: true,
                                    strokeColor: "#4C00FF",
                                    strokeOpacity: 0.1,
                                    strokeOpacity: 1,
                                    strokeWeight: 6
                                });
                                markerPosition.pl.polyline.setMap(mapLiveTracking);
                            } else {
                                window.alert('Directions request failed due to ' + status);
                            }
                        });
                    })();
                }

                API.get('shipments/tracking/history', {
                    user_id: ds.u,
                    shipment_id: /*ds.target*/8
                }).then(response => {
                    if(response.status == "ERROR") {
                        app.showDialogError(response.message);
                        f();
                    }
                    else {
                        f(response.data.map(function(r) {
                            return {
                                lat: parseFloat(r.lat),
                                lng: parseFloat(r.lng)
                            }
                        }));
                    }
                    $('#mdSeeRoute .modal-body').removeClass('map-loading-overlay');
                }).catch(e => {
                    console.log(e);
                    $('#mdSeeRoute .modal-body').removeClass('map-loading-overlay');
                });
                $('#mdSeeRoute').modal('show');
            });

            $('#tshipments tr td [data-action="rate-user"]').click(function() {
                var ds = this.dataset;
                console.log(ds);
            });
        });
    </script>
</body>

</html>