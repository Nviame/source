<?php
    require_once('inc/globals.php');

    $data = $_POST;

    $successMessage = null;
    $errorMessage = null;

    if(!empty($data)) {
        $c = new CommercesClients();
        $c->setIdCommerce($GLOBALS["User"]["Id"]);
        $c->setFullname($data["nombre_completo"]);
        $c->setAddress($data["domicilio"]);
        $c->setEmail($data["email"]);
        $c->setPhone($data["telefono"]);
        $c->setIdProvince($data["provincia"]);
        $c->setIdLocality($data["localidad"]);
        $c->setRegisteredAt(date("Y-m-d H:i:s"));
        if($c->save()) {
            $successMessage = "Cliente registrado con éxito.";
        }
        else {
            $errorMessage = "Hubo un problema al registrar el cliente.";
        }
    }

    $provinces = ProvincesQuery::create()->orderByName()->find();
    $localities = ProvincesLocalitiesQuery::create()->orderByName()->find();
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
        <div class="row g-0 h-100">
            <div class="col-lg-8 col-sm-12">
                <div class="card card-box">
                    <div class="card-body">
                        <div class="p-4 pt-3">
                            <h2>Nuevo cliente</h2>
                            <form id="fregister" class="mt-4 px-2" method="post" action="">
                                <div class="row">
                                    <div class="col-lg-6 col-sm-12 mb-3 form-group">
                                        <label class="form-label">Nombre y Apellido</label>
                                        <input type="text" class="form-control" name="nombre_completo" required>
                                    </div>
                                    <div class="col-lg-6 col-sm-12 mb-3 form-group">
                                        <label class="form-label">Correo electrónico</label>
                                        <input type="email" class="form-control" name="email" required>
                                    </div>
                                    <div class="col-lg-6 col-sm-12 mb-3 form-group">
                                        <label class="form-label">Teléfono</label>
                                        <input type="number" class="form-control" name="telefono" minlength="11" maxlength="11" required>
                                    </div>
                                    <div class="col-lg-6 col-sm-12 mb-3 form-group">
                                        <label class="form-label">Domicilio</label>
                                        <input type="text" class="form-control" name="domicilio" required>
                                    </div>
                                    <div class="col-lg-6 col-sm-12 mb-3 form-group">
                                        <label class="form-label">Provincia</label>
                                        <select class="form-control" name="provincia" required>
                                            <?php foreach($provinces as $p): ?>
                                                <option value="<?php echo $p->getId(); ?>" <?php echo $p->getId() == $loggedInfo["Province"]["Id"] ? "selected" : ""; ?>><?php echo $p->getName(); ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                    <div class="col-lg-6 col-sm-12 mb-3 form-group">
                                        <label class="form-label">Localidad</label>
                                        <select class="form-control" name="localidad" required></select>
                                    </div>
                                </div>
                                <div class="container-fluid mt-4 mb-2 px-auto">
                                    <div class="row justify-content-center w-100">
                                        <div class="col form-group text-center">
                                            <button type="submit" class="btn btn-primary button-wide">Agregar</button>
                                            <button type="reset" class="btn btn-cancel button-wide">Cancelar</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
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

        $('#fregister [name="provincia"]').change(function () {
            var v = this.value;
            const data = <?php echo json_encode(provincesData($provinces, $localities)); ?>;
            const info = data.filter(r => r.id == v).pop();
            if(info) {
                var html = '';
                info.localities.forEach(l => {
                    html += `<option value="${l.id}">${l.name}</option>`;
                });
                $('#fregister [name="localidad"]').html(html).select2('destroy').select2({
                    theme: "bootstrap-5",
                });
            }
        });

        $("#fregister").validate({
            onfocusout: false
        });
        $("#fregister").on('reset', function() {
            $('#fregister [name="provincia"]').select2("val", "1");
        });

        $(function() {
            $('#fregister [name="provincia"]').select2("val", "1");
        });
    </script>
</body>

</html>