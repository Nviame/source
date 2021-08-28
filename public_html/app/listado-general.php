<?php
    require_once('inc/globals.php');

    $successMessage = null;
    $errorMessage = null;

    if(isset($_POST["submit-form-client-info"])) {
        $data = $_POST;
        $c = CommercesClientsQuery::create()->findPK($data["i"]);
        if($c) {
            $c->setFullname($data["nombre_completo"]);
            $c->setAddress($data["domicilio"]);
            $c->setEmail($data["email"]);
            $c->setPhone($data["telefono"]);
            $c->setIdProvince($data["provincia"]);
            $c->setIdLocality($data["localidad"]);
            $c->setUpdatedAt(date("Y-m-d H:i:s"));
            if($c->save()) {
                $successMessage = "Cliente modificado con éxito.";
            }
            else {
                $errorMessage = "Hubo un problema al modificar el cliente.";
            }
        }
        else {
            $errorMessage = "Hubo un problema al modificar el cliente.";
        }
    }
    else if(isset($_POST["del-client"]) && isset($_POST["i"])) {
        $data = $_POST;
        $r = CommercesClientsQuery::create()->findPK($data["i"]);
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

    $clients = CommercesClientsQuery::create()->orderByRegisteredAt('desc')->find() ?: array();

    function clientsData() {
        global $clients;
        $arr = array();
        foreach($clients as $c) {
            $data = json_decode($c->toJSON(), true);
            $arr[] = $data;
        }
        return $arr;
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
    <div class="modal fade" id="mdEditClient">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <form id="form-client-info" class="modal-content" action="" method="post">
                <div class="modal-header">
                    <h5 class="modal-title">Modificar sucursal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body py-2 px-4 mx-1">
                    <input type="hidden" class="form-control" name="i" required>
                    <div class="row mb-2">
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
                </div>
                <div class="modal-footer justify-content-start">
                    <button type="buttom" class="btn btn-cancel button-wide" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" name="submit-form-client-info" class="btn btn-primary button-wide">Guardar</button>
                </div>
            </form>
        </div>
    </div>
    <div class="main-content p-2">
        <div class="row g-0 h-100">
            <div class="col-lg-12 col-sm-12">
                <div class="card card-box h-80">
                    <div class="card-body">
                        <h2 class="card-title">Lista de Clientes <input type="text" placeholder="Buscar" class="form-control table-search"/></h2>
                        <table id="table-clients" class="table table-borderless">
                            <thead>
                                <tr>
                                    <th scope="col">Nombre y Apellido</th>
                                    <th scope="col">Correo electrónico</th>
                                    <th scope="col">Domicilio</th>
                                    <th scope="col">Teléfono</th>
                                    <th scope="col">Ciudad</th>
                                    <th scope="col">Provincia</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody><?php foreach($clients as $c): ?>
                                    <tr>
                                        <td><?php echo $c->getFullname(); ?></td>
                                        <td><a href="mailto:<?php echo $c->getEmail(); ?>"><?php echo $c->getEmail(); ?></a></td>
                                        <td><?php echo $c->getAddress(); ?></td>
                                        <td><a href="tel:<?php echo $c->getPhone(); ?>"><?php echo $c->getPhone(); ?></a></td>
                                        <td><?php echo $c->getProvincesLocalities()->getName(); ?></td>
                                        <td><?php echo $c->getProvinces()->getName(); ?></td>
                                        <td>
                                            <div class="actions">
                                                <a href="javascript: void(0);" data-action="edit" data-target="<?php echo $c->getId(); ?>">
                                                    <img src="assets/images/edit.svg" alt="" height="16">
                                                </a>
                                                <a href="javascript: void(0);" data-action="delete" data-target="<?php echo $c->getId(); ?>">
                                                    <img src="assets/images/close.svg" alt="" height="10">
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach ?></tbody>
                        </table>
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

        window.onload = function() {
            $('#form-client-info [name="provincia"]').change(function () {
                var v = this.value;
                const data = <?php echo json_encode(provincesData($provinces, $localities)); ?>;
                const info = data.filter(r => r.id == v).pop();
                if(info) {
                    var html = '';
                    info.localities.forEach(l => {
                        html += `<option value="${l.id}">${l.name}</option>`;
                    });
                    $('#form-client-info [name="localidad"]').html(html).select2('destroy').select2({
                        theme: "bootstrap-5",
                    });
                }
            });

            $(document).on('click', '#table-clients tbody tr td .actions a[data-action="delete"]', (e) => {
                const el = e.target;
                $.post(location.href, {
                    'del-client': 1,
                    'i': el.dataset.target
                }, function(resp) {
                    $(el).closest('tr').addClass('deleted').animate({ height: 'toggle', opacity: 'toggle', marginBottom: '-8px', padding: 0 }, 400, () => {
                        $(el).closest('tr').remove();
                        if($('#table-clients tbody tr').length == 0) {
                            $('#table-clients tbody').html('');
                        }
                    });
                });
            });

            $(document).on('click', '#table-clients tbody tr td .actions a[data-action="edit"]', (e) => {
                const el = e.target;
                var data = <?php echo json_encode(clientsData()) ?>;
                data = data.filter(r => {
                    return r.Id == el.dataset.target;
                }).pop();
                if(data) {
                    $('#form-client-info [name="i"]').val(data.Id);
                    $('#form-client-info [name="nombre_completo"]').val(data.Fullname);
                    $('#form-client-info [name="email"]').val(data.Email);
                    $('#form-client-info [name="telefono"]').val(data.Phone);
                    $('#form-client-info [name="domicilio"]').val(data.Address);
                    $('#form-client-info [name="provincia"]').val(data.IdProvince).trigger('change');
                    setTimeout(() => {
                        $('#form-client-info [name="localidad"]').val(data.IdLocality).trigger('change');
                    }, 1000);
                }
                $('#mdEditClient').modal('show');
            });
        }
    </script>
</body>

</html>