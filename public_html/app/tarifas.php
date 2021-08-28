<?php
    require_once('inc/globals.php');

    $successMessage = null;
    $errorMessage = null;

    if(isset($_POST["submit-ftaxpz"])) {
        $data = $_POST;
        $r = new CommercesRates();
        $r->setIdCommerce($GLOBALS["User"]["Id"]);
        $r->setName($data["nombre"]);
        $r->setKm($data["km"]);
        $r->setPrice($data["costo"]);
        $r->setRegisteredAt(date("Y-m-d H:i:s"));
        if($r->save()) {
            $successMessage = "Tarifa agregada con éxito.";
        }
        else {
            $errorMessage = "No se pudo guardar la tarifa.";
        }
    }
    else if(isset($_POST["del-rate-zone"]) && isset($_POST["i"])) {
        $data = $_POST;
        $r = CommercesRatesQuery::create()->findPK($_POST["i"]);
        if($r) {
            if($r->delete()) {
                echo "OK";
            }
            else{
                echo "ERROR";
            }
        }
        else {
            echo "ERROR";
        }
        exit(0);
    }

    $rates = CommercesRatesQuery::create()->orderByRegisteredAt('desc')->find();
?>
<!doctype html>
<html lang="es" class="h-100">

<head>
    <?php require_once('inc/head.php'); ?>
    <link rel="stylesheet" href="assets/css/extra.css">
    <style>
        .list-rates-zones ::marker {
            color: var(--bs-primary);
        }

        .list-rates-zones li + li {
            margin-top: 8px;
        }

        .list-rates-zones [data-rel="content"] {
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 15px;
            color: #373435;
        }

        .list-rates-zones [data-rel="content"] span {
            width: 100%;
        }

        .list-rates-zones [data-rel="content"] span:first-child {
            font-weight: bold;
        }

        .list-rates-zones [data-rel="content"] span:nth-child(2) {
            width: 180px;
        }

        .list-rates-zones [data-rel="content"] span:nth-child(3) {
            width: 180px;
        }

        .list-rates-zones [data-rel="content"] span:nth-child(4) {
            width: 40px;
        }

        .list-rates-zones [data-rel="content"] span:nth-child(4) img {
            width: 10px;
        }

        .list-rates-zones [data-rel="content"] [data-rel="actions"] a img {
            pointer-events: none;
        }

        .list-rates-zones:empty::before {
            content: 'No hay registros';
            position: absolute;
            opacity: 0.65;
            left: 36px;
        }
    </style>
</head>

<body class="<?php echo BODY_CLASS; ?>">
    <?php require_once('inc/navbar.php'); ?>
    <?php require_once('inc/sidebar.php'); ?>
    <div class="main-content p-2">
        <div class="row g-0 h-100">
            <div style="width: 520px;">
                <div class="card card-box">
                    <div class="card-body">
                        <div class="p-4 pt-3">
                            <h2>Tarifas de envíos por zona</h2>
                            <div class="w-100">
                                <form id="ftaxpz" class="mt-4" method="post" action="">
                                    <div class="row">
                                        <div class="form-group col-lg-12 col-sm-12 mb-3">
                                            <label class="form-label">Nombre de la zona</label>
                                            <input type="text" class="form-control" name="nombre" required>
                                        </div>
                                        <div class="form-group col-lg-6 col-sm-12 mb-3">
                                            <label class="form-label">Km aproximados</label>
                                            <input type="number" class="form-control" name="km" required>
                                        </div>
                                        <div class="form-group col-lg-6 col-sm-12 mb-3">
                                            <label class="form-label">Costo del envío</label>
                                            <span class="form-control-prefix">$</span>
                                            <input type="number" class="form-control" name="costo" required>
                                        </div>
                                    </div>
                                    
                                    <div class="container-fluid mt-4">
                                        <div class="row justify-content-center">
                                            <div class="col">
                                                <button type="submit" class="btn btn-primary w-100" name="submit-ftaxpz">Agregar zona</button>
                                            </div>
                                            <div class="col">
                                                <button type="reset" class="btn btn-cancel w-100">Cancelar</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div style=" position: absolute; width: 350px; height: 100%; right: 0; top: 0; ">
                <div class="w-100 h-100 bg-white p-3 ms-2" style="padding-right: 28px !important;">
                    <p class="text-primary ms-2">Tarifario vigente</p>
                    <ul class="list-rates-zones">
                        <?php foreach($rates as $r): ?>
                            <li>
                                <div data-rel="content">
                                    <span><?php echo $r->getName() ?></span>
                                    <span><?php echo $r->getKm() ?>km</span>
                                    <span>$ <?php echo $r->getPrice() ?></span>
                                    <span data-rel="actions">
                                        <a href="javascript: void(0);" data-action="delete" data-target="<?php echo $r->getId() ?>"><img src="assets/images/close.svg" alt=""></a>
                                    </span>
                                </div>
                            </li>
                        <?php endforeach ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <?php require_once('inc/scripts.php'); ?>
    <script>
        <?php if($successMessage): ?>
            Toasts.success('<?php echo $successMessage; ?>');
        <?php endif ?>
        <?php if($errorMessage): ?>
            Toasts.error('<?php echo $errorMessage; ?>');
        <?php endif ?>

        window.onload = () => {
            $('#ftaxpz').validate({
                onfocusout: false,
                submitHandler: (form) => {
                    form.submit();
                }
            });

            $('.list-rates-zones [data-rel="actions"] a[data-action="delete"]').click((e) => {
                const el = e.target;
                $.post(location.href, {
                    'del-rate-zone': 1,
                    'i': el.dataset.target
                }, function(resp) {
                    $(el).closest('li').addClass('deleted').animate({ height: 'toggle', opacity: 'toggle', marginBottom: '-8px', padding: 0 }, 400, () => {
                        $(el).closest('li').remove();
                        if($('.list-rates-zones li').length == 0) {
                            $('.list-rates-zones').html('');
                        }
                    });
                });
            });
        }
    </script>
</body>

</html>