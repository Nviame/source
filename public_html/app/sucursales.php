<?php
    require_once('inc/globals.php');

    $successMessage = null;
    $errorMessage = null;

    if(isset($_POST["submit-fbranchoffice"])) {
        $data = $_POST;
        $bo = new CommercesBranchOffices();
        $bo->setIdCommerce($GLOBALS["User"]["Id"]);
        $bo->setName($data["nombre"]);
        $bo->setAddress($data["direccion"]);
        $bo->setRegisteredAt(date("Y-m-d H:i:s"));
        if($bo->save()) {
            $successMessage = "Sucursal agregada con éxito.";
        }
        else {
            $errorMessage = "No se pudo guardar la sucursal.";
        }
    }
    else if(isset($_POST["submit-form-brach-office-info"])) {
        $data = $_POST;
        $bo = CommercesBranchOfficesQuery::create()->findPK($data["i"]);
        if($bo) {
            $bo->setIdCommerce($GLOBALS["User"]["Id"]);
            $bo->setName($data["nombre"]);
            $bo->setAddress($data["direccion"]);
            $bo->setUpdatedAt(date("Y-m-d H:i:s"));
            if($bo->save()) {
                $successMessage = "Sucursal modificada con éxito.";
            }
            else {
                $errorMessage = "No se pudo modificar la sucursal.";
            }
        }
        else {
            $errorMessage = "No se pudo modificar la sucursal.";
        }        
    }
    else if(isset($_POST["del-item"]) && isset($_POST["i"])) {
        $data = $_POST;
        $r = CommercesBranchOfficesQuery::create()->findPK($data["i"]);
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

    $branchOffices = CommercesBranchOfficesQuery::create()->orderByRegisteredAt('desc')->find();
?>
<!doctype html>
<html lang="es" class="h-100">

<head>
    <?php require_once('inc/head.php'); ?>
    <link rel="stylesheet" href="assets/css/extra.css">
    <style>
        .list-items ::marker {
            color: var(--bs-primary);
        }

        .list-items li + li {
            margin-top: 8px;
        }

        .list-items [data-rel="content"] {
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 15px;
            color: #373435;
        }

        .list-items [data-rel="content"] span {
            width: 100%;
        }

        .list-items [data-rel="content"] span:first-child {
            font-weight: bold;
        }

        .list-items [data-rel="content"] span:nth-child(3),
        .list-items [data-rel="content"] span:nth-child(4) {
            width: 72px;
        }

        .list-items [data-rel="content"] span:nth-child(3) img {
            width: 15px;
        }

        .list-items [data-rel="content"] span:nth-child(4) img {
            width: 10px;
        }

        .list-items [data-rel="content"] [data-rel="actions"] a img {
            pointer-events: none;
        }

        .list-items:empty::before {
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
    <div class="modal fade" id="mdEditBrachOffice">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <form id="form-brach-office-info" class="modal-content" action="" method="post">
                <div class="modal-header">
                    <h5 class="modal-title">Modificar sucursal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body py-2 px-4 mx-1">
                    <input type="hidden" class="form-control" name="i" required>
                    <div class="row mb-2">
                        <div class="col-lg-12 form-group mb-3">
                            <label class="form-label">Nombre / Razón socia</label>
                            <input type="text" class="form-control" name="nombre" required>
                        </div>
                        <div class="col-lg-12 form-group mb-3">
                            <label class="form-label">Dirección</label>
                            <input type="text" class="form-control" name="direccion" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="buttom" class="btn btn-cancel button-wide" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" name="submit-form-brach-office-info" class="btn btn-primary button-wide">Guardar</button>
                </div>
            </form>
        </div>
    </div>
    <div class="main-content p-2">
        <div class="row g-0 h-100">
            <div style="width: 520px;">
                <div class="card card-box">
                    <div class="card-body">
                        <div class="p-4 pt-3">
                            <h2>Nueva sucursal</h2>
                            <div class="w-100">
                                <form id="fbranchoffice" class="mt-4" method="post" action="">
                                    <div class="row">
                                        <div class="form-group col-lg-12 col-sm-12 mb-3">
                                            <label class="form-label">Nombre / Razón social</label>
                                            <input type="text" class="form-control" name="nombre" required>
                                        </div>
                                        <div class="form-group col-lg-12 col-sm-12 mb-3">
                                            <label class="form-label">Dirección</label>
                                            <input type="text" class="form-control" name="direccion" required>
                                        </div>
                                    </div>
                                    
                                    <div class="container-fluid mt-4">
                                        <div class="row justify-content-center">
                                            <div class="col">
                                                <button type="submit" class="btn btn-primary w-100" name="submit-fbranchoffice">Agregar</button>
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
            <div  style=" position: absolute; width: 450px; height: 100%; right: 0; top: 0; ">
                <div class="w-100 h-100 bg-white p-3 ms-2" style="padding-right: 28px !important;">
                    <p class="text-primary ms-2">Listado sucursales</p>
                    <ul class="list-items"><?php foreach($branchOffices as $bo): ?>
                        <li>
                            <div data-rel="content">
                                <span><?php echo $bo->getName() ?></span>
                                <span><?php echo $bo->getAddress() ?></span>
                                <span data-rel="actions">
                                    <a href="javascript: void(0);" data-action="edit" data-target="<?php echo $bo->getId() ?>" data-name="<?php echo $bo->getName() ?>" data-address="<?php echo $bo->getAddress() ?>"><img src="assets/images/edit.svg" alt=""></a>
                                </span>
                                <span data-rel="actions">
                                    <a href="javascript: void(0);" data-action="delete" data-target="<?php echo $bo->getId() ?>"><img src="assets/images/close.svg" alt=""></a>
                                </span>
                            </div>
                        </li>
                    <?php endforeach ?></ul>
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

        $(() => {
            $('#fbranchoffice').validate({
                onfocusout: false,
                submitHandler: (form) => {
                    form.submit();
                }
            });

            $(document).on('click', '.list-items [data-rel="actions"] a[data-action="delete"]', (e) => {
                const el = e.target;
                $.post(location.href, {
                    'del-item': 1,
                    'i': el.dataset.target
                }, function(resp) {
                    $(el).closest('li').addClass('deleted').animate({ height: 'toggle', opacity: 'toggle', marginBottom: '-8px', padding: 0 }, 400, () => {
                        $(el).closest('li').remove();
                        if($('.list-items li').length == 0) {
                            $('.list-items').html('');
                        }
                    });
                });
            });

            $(document).on('click', '.list-items [data-rel="actions"] a[data-action="edit"]', (e) => {
                const el = e.target;
                console.log(el.dataset);
                $('#form-brach-office-info [name="i"]').val(el.dataset.target);
                $('#form-brach-office-info [name="nombre"]').val(el.dataset.name);
                $('#form-brach-office-info [name="direccion"]').val(el.dataset.address);
                $('#mdEditBrachOffice').modal('show');
            });

            $('#form-brach-office-info').validate({
                submitHandler: (form) => {
                    form.submit();
                }
            });
        });
    </script>
</body>

</html>