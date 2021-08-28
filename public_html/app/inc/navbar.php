<?php
    $counters = array(
        "scheduled" => ShipmentsQuery::create()->withColumn('COUNT(id)', 'countShipments')->filterByIdUser($GLOBALS["User"]["IdUser"])->filterByIdStatus(null)->groupById()->count(),
        
        "pending_for_payment"   => ShipmentsQuery::create()->withColumn('COUNT(id)', 'countShipments')->filterByIdUser($GLOBALS["User"]["IdUser"])->filterByIdStatus(1)->groupById()->count(),
        
        "traveling" => ShipmentsQuery::create()->withColumn('COUNT(id)', 'countShipments')->filterByIdUser($GLOBALS["User"]["IdUser"])->filterByIdStatus(4)->groupById()->count(),
        
        "delivered" => ShipmentsQuery::create()->withColumn('COUNT(id)', 'countShipments')->filterByIdUser($GLOBALS["User"]["IdUser"])->filterByIdStatus(5)->groupById()->count(),
        
        "received_offers" => ShipmentsOffersQuery::create()->withColumn('COUNT(id)', 'countShipments')->filterByIdUser($GLOBALS["User"]["IdUser"])->groupById()->count()
    );
?>
<nav class="navbar navbar-dark">
    <div class="container-fluid">
        <div class="isologo">
            <?php echo svgIcon("nv.svg", "100%", "28px"); ?>
        </div>
        <div class="sidebar-toggle-wrapper d-flex align-items-center">
            <a href="javascript: void(0);" class="sidebar-toggle me-3">
                <img src="assets/images/menu.svg" alt="" height="12">
                <img src="assets/images/menu-close.svg" alt="" height="12">
            </a>
            <h3><?php echo $pageTitle; ?></h3>
        </div>
        <div>
            <div class="shipments-count-summary" <?php if(!$GLOBALS["User"]["Capabilities"]["CanScheduleShipments"]) { echo 'style="right: 248px;"'; } ?>>
                <div data-el="item">
                    <div data-el="value"><?php echo $counters["scheduled"]; ?></div>
                    <div data-el="name">Envíos programados</div>
                </div>
                <div data-el="item">
                    <div data-el="value"><?php echo $counters["pending_for_payment"]; ?></div>
                    <div data-el="name">Pendientes de pago</div>
                </div>
                <div data-el="item">
                    <div data-el="value"><?php echo $counters["traveling"]; ?></div>
                    <div data-el="name">En viaje</div>
                </div>
                <div data-el="item">
                    <div data-el="value"><?php echo $counters["delivered"]; ?></div>
                    <div data-el="name">Entregados</div>
                </div>
            </div>
            <?php if($GLOBALS["User"]["Capabilities"]["CanScheduleShipments"]): ?>
                <a href="ofertas-recibidas" class="btn no-box-shadow">
                    <img src="assets/images/notifications.svg" alt="" height="20">
                    Ofertas
                </a>
            <?php endif ?>
            <a href="programar-envios" class="btn btn-primary ms-3 d-inline-flex">
                <img src="assets/images/agregar.svg" alt="" width="16px" class="ms-2">
                Programar envíos
            </a>
        </div>
    </div>
</nav>