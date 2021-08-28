<?php
    /*if(isset($GLOBALS["User"])) {
        $canScheduleShipments = $GLOBALS["User"]["Capabilities"]["CanScheduleShipments"];
    }
    else {
        $canScheduleShipments = false;
    }*/

    require_once('inc/globals.php');

    require_once('../ormnv/include.php');

    require_once 'vendor/autoload.php';
    use \Firebase\JWT\JWT;

    //$successMessageAlert = null;

    if(isset($_REQUEST["logout"]) && isset($GLOBALS["User"]["MP"]["Id"])) {
        $mpu = UsersMpQuery::create()->findPK($GLOBALS["User"]["MP"]["Id"]);
        $mpu->delete();
        $GLOBALS["User"] = Commerces_Map($_SESSION["nvapp"]["Id"]);
        $canScheduleShipments = false;
    }

    /*if(!$canScheduleShipments && $GLOBALS["User"]["Capabilities"]["CanScheduleShipments"]) {
        $successMessageAlert = array('¡Enhorabuena!', 'La billetera ha sido conectada<br>y ahora podrá programar envíos.');
    }*/
?>
<!doctype html>
<html lang="es" class="h-100">

<head>
    <?php require_once('inc/head.php'); ?>
</head>

<body class="<?php echo BODY_CLASS; ?>">
    <?php require_once('inc/navbar.php'); ?>
    <?php require_once('inc/sidebar.php'); ?>
    <div class="main-content p-2">
        <div class="row g-0 h-100">
            <?php if($GLOBALS["User"]["MP"]): ?>
                <div class="col-lg-4 col-sm-12">
                    <div class="card card-box p-4">
                        <div class="text-center mt-3 mb-4">
                            <img src="assets/images/mercado-pago-logo.svg" class="card-img-top" alt="mp-logo" height="64">
                        </div>
                        <div class="card-body">
                            <p class="card-text px-2 d-flex align-items-center justify-content-center"><img src="assets/images/check-verde.svg" height="11" class="me-2"> Billetera vinculada correctamente.</p>
                            <p class="mt-4 mb-2 text-center">
                                <a id="disconnect-mp" href="javascript: void(0);" class="btn btn-primary button-wide">Desconectar</a>
                            </p>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <div class="col-lg-4 col-sm-12">
                    <div class="card card-box p-4">
                        <div class="text-center mt-3 mb-4">
                            <img src="assets/images/mercado-pago-logo.svg" class="card-img-top" alt="mp-logo" height="64">
                        </div>
                        <div class="card-body">
                            <p class="card-text px-2 text-center">Debe autorizar a Nviame a gestionar los<br>pagos que realizará mediante la aplicación.</p>
                            <p class="mt-4 mb-2 text-center">
                                <a id="connect-mp" href="javascript: void(0);" class="btn btn-primary button-wide">Asociar a MercadoPago</a>
                            </p>
                        </div>
                    </div>
                </div>
            <?php endif ?>
        </div>
    </div>
    <?php require_once('inc/scripts.php'); ?>
    <script>
        <?php if($successMessageAlert): ?>
            Dialogs.success('<?php echo $successMessageAlert[0]; ?>', '<?php echo $successMessageAlert[1]; ?>');
        <?php endif ?>

        window.onload = () => {
            <?php if($GLOBALS["User"]["MP"]): ?>
                $('#disconnect-mp').click(function() {
                    location.assign('billetera?logout');
                });
            <?php else: ?>
                $('#connect-mp').click(function() {
                    var authURL = `http://www.mercadolibre.com/jms/mla/lgz/logout?go=` + encodeURIComponent(`https://auth.mercadopago.com.ar/authorization?client_id=8456003364969642&response_type=code&platform_id=mp&redirect_uri=https://nviame.com/api/ml/<?php echo $GLOBALS["User"]["IdUser"] ?>`);
                    var ref = window.open(authURL, '_blank', `location=yes,closebuttoncolor=#ffffff,hideurlbar=true,lefttoright=true,hidenavigationbuttons=true,toolbarcolor=#00b1ea,width=${screen.availWidth},height=${screen.availHeight}`);
                    var intervalCheckStatus = setInterval(function() {
                        if(ref.closed) {
                            location.reload();
                        }
                    }, 500);
                });
            <?php endif ?>
        };
    </script>
</body>

</html>