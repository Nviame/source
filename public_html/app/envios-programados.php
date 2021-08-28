<?php
    /*ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);*/

    require_once('inc/globals.php');

    $shipments = CommercesShipmentsQuery::create()->filterByIdCommerce($GLOBALS["User"]["Id"])->orderByRegisteredAt('desc')->find();
    $shipmentsOffers = array();
    $shipmentsRawInfo = array();
    foreach($shipments as $k => $s) {
        $sRawInfo = ShipmentsQuery::create()->findPK($s->getIdShipment());
        if($sRawInfo) {
            if(!$sRawInfo->getIdStatus() || $sRawInfo->getIdStatus() < 5) {
                $shipmentsRawInfo[$s->getIdShipment()] = $sRawInfo;
                $count = 0;
                $offers = ShipmentsOffersQuery::create()->filterByIdShipment($s->getIdShipment())->find() ?: array();
                $band = true;
                foreach($offers as $o) {
                    $o->setReaded(1);
                    $o->save();
                    $count++;
                }
                $shipmentsOffers[$s->getIdShipment()] = $count;
            }
            else {
                unset($shipments[$k]);
            }
        }
        else {
            $s->delete();
            unset($shipments[$k]);
        }
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
    <div class="main-content p-0 no-scroll">
        <div class="row g-0 m-2 h-100">
            <div class="col-sm-6">
                <div class="card card-box">
                    <div class="card-body">
                        <h2 class="p-4 pt-3 pb-0 mb-0">Pendientes</h2>
                        <div class="scheduled-shipments"><?php foreach($shipments as $s): $sInfo = $shipmentsRawInfo[$s->getIdShipment()]; ?>
                            <div class="card scheduled-shipment" data-id="<?php echo $s->getUuid(); ?>" data-id-shipment="<?php echo $s->getIdShipment(); ?>">
                                <div class="card-body" data-extra-data="<?php echo $sInfo->getIdStatus() ? Utils::shipmentStatusDescription($sInfo->getIdStatus()) : ($shipmentsOffers[$s->getIdShipment()] > 0 ? ($shipmentsOffers[$s->getIdShipment()] . " oferta" . ($shipmentsOffers[$s->getIdShipment()] > 1 ? "s" : "") . " recibida" . ($shipmentsOffers[$s->getIdShipment()] > 1 ? "s" : "") . "") : "Sin ofertas"); ?>">
                                    <div data-el="content">
                                        <div data-el="description"><?php echo $s->getDescription(); ?></div>
                                        <div data-el="destination">
                                            <span>Destino</span>
                                            <p>
                                                <?php echo Utils::shortAddress($s->getPickupAtName()); ?>
                                                <img src="assets/images/see-route.svg" alt="" style="width: 16px;">
                                                <img src="assets/images/see-route-white.svg" alt="" style="width: 16px;">
                                            </p>
                                        </div>
                                        <div data-el="addressee">
                                            <span>Destinatario</span>
                                            <p><?php echo $s->getAddresseeName(); ?></p>
                                        </div>
                                        <div data-el="distance"></div>
                                    </div>
                                    <div data-el="picture" style="display: none;"></div>
                                    <?php if(!$sInfo->getIdStatus() || $sInfo->getIdStatus() == 1): ?>
                                        <div data-el="actions">
                                            <a href="javascript: void(0);" data-action="delete" data-target="<?php echo $s->getIdShipment(); ?>"></a>
                                        </div>
                                    <?php endif ?>
                                </div>
                            </div>
                            <!--
                                <div class="card scheduled-shipment < ?php if($i == 0) { echo "selected"; } ?>">
                                    <div class="card-body">
                                        <div data-el="content">
                                            <div data-el="description">3 kg. de asado 2 kg. de vacio + 2 pecheras de cerdo</div>
                                            <div data-el="destination">
                                                <span>Destino</span>
                                                <p>
                                                    14 de Julio 237
                                                    <img src="assets/images/see-route.svg" alt="" style="width: 16px;">
                                                    <img src="assets/images/see-route-white.svg" alt="" style="width: 16px;">
                                                </p>
                                            </div>
                                            <div data-el="addressee">
                                                <span>Destinatario</span>
                                                <p>Carlos Rodriguez</p>
                                            </div>
                                            <div data-el="distance">
                                                10 m · 5.1 km
                                            </div>
                                        </div>
                                        <div data-el="picture" style="background-image: url(assets/images/carne.svg);"></div>
                                    </div>
                                </div>
                            -->
                        <?php endforeach ?></div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div id="shipment-offers" class="card card-box fade">
                    <div class="card-body">
                        <h2 class="p-4 pt-3 pb-0 mb-0">
                            Ofertas recibidas: <span class="text-primary" id="shipment-offers-count">0</span> 
                            <span class="right-actions">
                                <a href="javascript: void(0);"><img src="assets/images/filter.svg" alt=""></a>
                                <a href="javascript: void(0);"><img src="assets/images/sort.svg" alt=""></a>
                            </span>
                        </h2>
                        <p class="p-4 pt-3 pb-1">Identificador de envío: #<span id="shipment-id"><?php echo $s->getUuid(); ?></span></p>
                        <div class="offers-received"><!--
                            <div class="card offer-received">
                                <div class="card-body">
                                    <div data-el="picture"></div>
                                    <div data-el="content">
                                        <div data-el="offerer">
                                            <span>Nombre del oferente</span>
                                            <p>Julio Álvarez <i> <img src="assets/images/star.svg" alt="" style="height: 12px;"> 4.3</i></p>
                                        </div>
                                        <div data-el="offer-value">
                                            <div>Valor ofertado</div>
                                            <div data-el="offer-value-ammount">$ 150</div>
                                        </div>
                                        <div data-el="offer-actions">
                                            <a href="javascript: void(0);" class="btn" data-action="refuse"></a>
                                            <a href="javascript: void(0);" class="btn" data-action="accept"></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card offer-received">
                                <div class="card-body">
                                    <div data-el="picture"></div>
                                    <div data-el="content">
                                        <div data-el="offerer">
                                            <span>Nombre del oferente</span>
                                            <p>Julio Álvarez <i> <img src="assets/images/star.svg" alt="" style="height: 12px;"> 4.3</i></p>
                                        </div>
                                        <div data-el="offer-value">
                                            <div>Valor ofertado</div>
                                            <div data-el="offer-value-ammount">$ 150</div>
                                        </div>
                                        <div data-el="offer-actions">
                                            <a href="javascript: void(0);" class="btn" data-action="refuse"></a>
                                            <a href="javascript: void(0);" class="btn" data-action="accept"></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card offer-received">
                                <div class="card-body">
                                    <div data-el="picture"></div>
                                    <div data-el="content">
                                        <div data-el="offerer">
                                            <span>Nombre del oferente</span>
                                            <p>Julio Álvarez <i> <img src="assets/images/star.svg" alt="" style="height: 12px;"> 4.3</i></p>
                                        </div>
                                        <div data-el="offer-value">
                                            <div>Valor ofertado</div>
                                            <div data-el="offer-value-ammount">$ 150</div>
                                        </div>
                                        <div data-el="offer-actions">
                                            <a href="javascript: void(0);" class="btn" data-action="refuse"></a>
                                            <a href="javascript: void(0);" class="btn" data-action="accept"></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        --></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php require_once('inc/api.php'); ?>
    <?php require_once('inc/scripts.php'); ?>
    <script>
        window.onload = function() {
            function refreshSelectedShipment() {
                const curIdS = $('.scheduled-shipment.selected').attr('data-id-shipment') || null;
                if(curIdS) {
                    socket.emit('shipment offers', {
                        id: curIdS
                    });
                }
            }

            window._s_n = (n) => {
                switch(n.group) {
                    case 'shipment_delivered_notify':
                        refreshSelectedShipment();
                    break;
                }
            }
            window._s_sto = (data) => {
                console.log('window._s_sto > ', data);
                refreshSelectedShipment();
            }
            window._s_sr = (data) => {
                console.log('window._s_sr > ', data);
                const curIdS = $('.scheduled-shipment.selected').attr('data-id-shipment') || null;
                if(curIdS) {
                    socket.emit('shipment offers', {
                        id: curIdS
                    });
                }
            }
            window._s_stu = (data) => {
                console.log('window._s_stu > ', data);
                refreshSelectedShipment();
            }
            window._s_no = (data) => {
                const currentOffers = parseInt($(`.scheduled-shipment[data-id-shipment="${data.shipment.id}"] .card-body`).attr('data-extra-data'));
                if(isNaN(currentOffers)) {
                    $(`.scheduled-shipment[data-id-shipment="${data.shipment.id}"] .card-body`).attr('data-extra-data', '1 oferta recibida');
                }
                else {
                    $(`.scheduled-shipment[data-id-shipment="${data.shipment.id}"] .card-body`).attr('data-extra-data', `${currentOffers} ofertas recibidas`);
                }
                socket.emit('shipment offers', {
                    id: data.shipment.id
                });
            }
            window._s_so = (o) => {
                console.log('window._s_so > ', o);
                /*if(o.length == 0) {
                    $(`.scheduled-shipment[data-id-shipment="${data.shipment.id}"] .card-body`).attr('data-extra-data', 'Sin ofertas');
                }*/
                var offerAccepted = o.filter(r => r.accepted_at != null).pop();
                if(offerAccepted) {
                    if($(`.scheduled-shipment[data-id-shipment="${offerAccepted.shipment_id}"]`).hasClass('selected')) {
                        const dss = document.querySelector('.scheduled-shipment.selected').dataset;
                        $('.scheduled-shipment.selected').addClass('offer-accepted');
                        $('.scheduled-shipment.selected .card-body').attr('data-extra-data', Utils.shipments.statusDescription(offerAccepted.shipment_id_status));
                        console.log(offerAccepted);
                        var htmlActions = '';
                        var title = '';
                        switch(parseInt(offerAccepted.shipment_id_status)) {
                            case 1:
                                title = 'Esperando pago';
                                htmlActions = '<a href="javascript: void(0);" class="btn btn-primary w-100" data-action="payment">Pagar envío</a>';
                            break;
                            case 2:
                                title = 'Esperando retiro';
                                //htmlActions = '<a href="javascript: void(0);" class="btn btn-secondary w-100 disabled" data-action="tracking">Tracking <i> <img src="assets/images/see-route-white.svg" alt=""></i></a>';
                                htmlActions = '';
                            break;
                            case 3:
                                title = 'Paquete retirado';
                                //htmlActions = '<a href="javascript: void(0);" class="btn btn-secondary w-100 disabled" data-action="tracking">Tracking <i> <img src="assets/images/see-route-white.svg" alt=""></i></a>';
                                htmlActions = '';
                            break;
                            case 4:
                                title = 'En viaje';
                                //htmlActions = '<a href="javascript: void(0);" class="btn btn-primary w-100" data-action="tracking">Tracking <i> <img src="assets/images/see-route-white.svg" alt=""></i></a>';
                                htmlActions = '';
                            break;
                        }
                        $('#shipment-offers').html(`
                            <div class="card-body">
                                <h2 class="p-4 pt-3 pb-0 mb-0">${title}</h2>
                                <p class="p-4 pt-3 pb-1">Identificador de envío: #<span id="shipment-id">${dss.id}</span></p>
                                <div class="offers-received">
                                    <div class="card offer-received" data-uid="${offerAccepted.id}">
                                        <div class="card-body">
                                            <div data-el="picture"></div>
                                            <div data-el="content">
                                                <div data-el="offerer">
                                                    <span>Nombre del oferente</span>
                                                    <p>${offerAccepted.user_fullname} <i> <img src="assets/images/star.svg" alt="" style="height: 12px;"> 0</i></p>
                                                </div>
                                                <div data-el="offer-value" style="${htmlActions ? '' : 'position: absolute; right: -10px; width: 136px;'}">
                                                    <div>Valor ofertado</div>
                                                    <div data-el="offer-value-ammount">$ ${offerAccepted.offer}</div>
                                                </div>
                                                ${htmlActions ? `
                                                    <div data-el="offer-actions" style=" min-width: 128px; ">${htmlActions}</div>
                                                ` : ''}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `);
                        $('#shipment-offers [data-el="offer-actions"] [data-action="payment"]').click(() => {
                            var url = `${location.href.split('/app/').shift()}/payment.php?s=${offerAccepted.shipment_id}&o=${offerAccepted.id}`;
                            console.log('payment url: ', url);
                            var ref = window.open(url, '_blank', 'location=yes,closebuttoncolor=#ffffff,hideurlbar=true,lefttoright=true,hidenavigationbuttons=true,toolbarcolor=#00b1ea');
                            window._s_sp = (payment) => {
                                console.log('window._s_sp > ', payment);
                                if(payment) {
                                    socket.emit('shipment paid', {
                                        id: payment.id_shipment,
                                        status: payment.collection_status
                                    });
                                    setTimeout(() => {
                                        location.assign('pago-aceptado?s=' + offerAccepted.shipment_id);
                                    }, 2000);
                                }
                                else {
                                    Dialogs.info('No pagado', 'El pago no fue efectuado.');
                                }
                            }
                            var intervalCheckStatus = setInterval(function() {
                                if(ref.closed) {
                                    clearInterval(intervalCheckStatus);
                                    socket.emit('check payment', {
                                        id_shipment: offerAccepted.shipment_id,
                                        id_offer_user_id: offerAccepted.user_id
                                    });
                                }
                            }, 500);
                        });
                    }
                    else {

                    }
                }
                else {
                    $('#shipment-offers-count').text(o.length);
                    $('.offers-received').html('');
                    o.forEach(r => {
                        $('.offers-received').append(`
                            <div class="card offer-received" data-uid="${r.id}">
                                <div class="card-body">
                                    <div data-el="picture"></div>
                                    <div data-el="content">
                                        <div data-el="offerer">
                                            <span>Nombre del oferente</span>
                                            <p>${r.user_fullname} <i> <img src="assets/images/star.svg" alt="" style="height: 12px;"> ${r.user_overall_rating}</i></p>
                                        </div>
                                        <div data-el="offer-value">
                                            <div>Valor ofertado</div>
                                            <div data-el="offer-value-ammount">$ ${r.offer}</div>
                                        </div>
                                        <div data-el="offer-actions">
                                            <a href="javascript: void(0);" class="btn" data-action="refuse"></a>
                                            <a href="javascript: void(0);" class="btn" data-action="accept"></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `);
                        $(`.offers-received [data-uid="${r.id}"] [data-el="offer-actions"] a`).click(function() {
                            const ds = this.dataset;
                            Dialogs.question(`${ds.action == 'accept' ? 'Aceptar' : 'Rechazar'} oferta`, `¿Seguro que deseas ${ds.action == 'accept' ? 'aceptar' : 'rechazar'} la<br>oferta de ${r.user_fullname} por $ ${r.offer}?`, () => {
                                $('#shipment-offers').addClass('card-loading-overlay');
                                API.post('shipments/offer/' + ds.action, {
                                    offer: r.id
                                }).then(response => {
                                    if(response.status == "ERROR") {
                                        Dialogs.error('Error', response.message);
                                    }
                                    else {
                                        if(ds.action == 'accept') {
                                            socket.emit('offer accepted', {
                                                user: {
                                                    id: r.user_id,
                                                    name: r.user_fullname
                                                },
                                                shipment: {
                                                    id: r.shipment_id,
                                                    id_user: r.shipment_id_user,
                                                    offer: r.offer,
                                                    offer_id: response.data.offer_id
                                                }
                                            });
                                            $('.scheduled-shipment.selected').addClass('offer-accepted').trigger('click');
                                        }
                                        else {
                                            console.log({
                                                user: {
                                                    id: r.user_id,
                                                    name: r.user_fullname
                                                },
                                                shipment: {
                                                    id: r.shipment_id,
                                                    id_user: r.shipment_id_user,
                                                    offer: r.offer,
                                                }
                                            });
                                            socket.emit('offer refused', {
                                                user: {
                                                    id: r.user_id,
                                                    name: r.user_fullname
                                                },
                                                shipment: {
                                                    id: r.shipment_id,
                                                    id_user: r.shipment_id_user,
                                                    offer: r.offer,
                                                    offer_id: r.id
                                                }
                                            });
                                            $('.scheduled-shipment.selected').removeClass('offer-accepted').trigger('click');
                                            if(o.length == 1) {
                                                $(`.scheduled-shipment[data-id-shipment="${r.shipment_id}"] .card-body`).attr('data-extra-data', 'Sin ofertas');
                                            }
                                        }
                                    }
                                    $('#shipment-offers').removeClass('card-loading-overlay');
                                }).catch(e => {
                                    $('#shipment-offers').removeClass('card-loading-overlay');
                                    Dialogs.error('Error', 'Hubo un problema al procesar la solicitud.');
                                });
                            });
                        });
                    });
                }
                $('#shipment-offers').removeClass('card-loading');
            }

            $('.scheduled-shipments .scheduled-shipment [data-el="actions"] [data-action="delete"]').click(function(e) {
                e.preventDefault();
                e.stopPropagation();

                const btn = this;

                const ds = btn.dataset;
                
                Dialogs.question('Confirmar eliminación', `¿Seguro que desea eliminar este envío?`, () => {
                    $('body').addClass('loading-overlay');
                    API.post('shipments/delete', {
                        id: ds.target
                    }).then(response => {
                        $('body').removeClass('loading-overlay');
                        if(response.status == "ERROR") {
                            Dialogs.error('Error', response.message);
                        }
                        else {
                            $('#shipment-offers').removeClass('show').html('');
                            $(btn).closest('.scheduled-shipment').slideUp();
                            Dialogs.success('Operación exitosa', 'Se ha eliminado el envío');
                        }
                    }).catch(e => {
                        $('body').removeClass('loading-overlay');
                        console.log(e);
                    });
                });
            });
            $('.scheduled-shipments .scheduled-shipment').click(function() {
                const el = this;
                $('.scheduled-shipments .scheduled-shipment').removeClass('selected');
                $(el).addClass('selected');
                $('#shipment-offers-count').text(0);
                $('#shipment-id').text(el.dataset.id);
                $('#offers-received').html(``);
                $('#shipment-offers').addClass('show');
                $('#shipment-offers').addClass('card-loading');
                socket.emit('shipment offers', {
                    id: el.dataset.idShipment
                });
            });  
        };
    </script>
</body>

</html>