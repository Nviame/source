<?php
    require_once('inc/globals.php');

    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);

    $ids = $_REQUEST["s"];
    $shipment = CommercesShipmentsQuery::create()->findOneByIdShipment($ids);
    $payment = ShipmentsPaymentsQuery::create()->findOneByIdShipment($ids);
    $paymentH = ShipmentsOperationsHistoryQuery::create()->filterByIdShipment($ids)->filterByUid('offer_accepted')->findOne();
    $user = UsersQuery::create()->findPK($paymentH->getIdUser());

    if(!$payment || !$paymentH) {
        header('Location: envios-programados');
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
    <div class="main-content p-0">
        <div class="row g-0 h-100">
            <div class="col-lg-5 col-sm-12" style="width: 640px;">
                <div class="card card-box">
                    <div class="card-body">
                        <h2 class="p-4 pb-0 pt-2 mb-0">Pago aceptado</h2>
                        <div class="scheduled-shipments">
                            <div class="card scheduled-shipment selected">
                                <div class="card-body">
                                    <div data-el="content">
                                        <div data-el="description"><?php echo $shipment->getDescription(); ?></div>
                                        <div data-el="destination">
                                            <span>Destino</span>
                                            <p>
                                                <?php echo Utils::shortAddress($shipment->getPickupAtName()); ?>
                                                <img src="assets/images/see-route.svg" alt="" style="width: 16px;">
                                                <img src="assets/images/see-route-white.svg" alt="" style="width: 16px;">
                                            </p>
                                        </div>
                                        <div data-el="addressee">
                                            <span>Destinatario</span>
                                            <p><?php echo $shipment->getAddresseeName(); ?></p>
                                        </div>
                                        <div data-el="distance"></div>
                                    </div>
                                    <div data-el="picture"></div>
                                </div>
                            </div>
                        </div>
                        <div class="offers-received">
                            <div class="card offer-received mt-1">
                                <div class="card-body">
                                    <div data-el="picture"></div>
                                    <div data-el="content">
                                        <div data-el="offerer" class="w-100">
                                            <span>Nombre del oferente</span>
                                            <p><?php echo $user->getFullname(); ?> <i> <img src="assets/images/star.svg" alt="" style="height: 12px;"> <?php echo $user->getOverallRating(); ?></i></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div style=" padding: 16px 24px; " class="mt-4">
                            <div style=" display: flex; justify-content: space-between; align-items: center; position: relative; height: 36px; ">
                                <div style=" position: absolute; background-color: white; padding-right: 8px; bottom: 10px; ">Identificador de pago</div>
                                <div style=" width: 100%; height: 1px; background: #E6E7E8; "></div>
                                <div style=" position: absolute; background-color: white; padding-left: 8px; bottom: 10px; right: 0; "><?php echo $payment->getMerchantOrderId(); ?>
                                </div>
                            </div>
                            <div
                                style=" display: flex; justify-content: space-between; align-items: center; position: relative; height: 36px; ">
                                <div style=" position: absolute; background-color: white; padding-right: 8px; bottom: 10px; ">Total</div>
                                <div style="width: 100%;height: 1px;background: #E6E7E8;"></div>
                                <div style=" font-size: 28px; font-family: 'GibsonW SemiBold'; position: absolute; background-color: white; padding-left: 8px; bottom: 10px; right: 0; ">$ <?php echo $paymentH->getValor(); ?></div>
                            </div>
                        </div>
                        <p class="text-center mt-4">
                            <a href="envios-programados" class="btn btn-primary ps-3 pe-3">Volver a envíos programados</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php require_once('inc/scripts.php'); ?>
</body>

</html>