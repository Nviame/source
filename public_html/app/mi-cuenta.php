<?php
    /*ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);*/

    require_once('inc/globals.php');

    require_once('../ormnv/include.php');

    require_once 'vendor/autoload.php';
    use \Firebase\JWT\JWT;

    $loggedInfo = $GLOBALS["User"];

    $allDocs = scandir("../api/uploads/users");
    $haveIDDoc = false;
    foreach($allDocs as $d) {
        if(strstr($d, $loggedInfo["id"] . "_" . $data["cuit_cuil"])) {
            $haveIDDoc = true;
        }
    }

    $positions = PositionsCommerceQuery::create()->find();
    $headings = HeadingsCommerceQuery::create()->find();

    $provinces = ProvincesQuery::create()->orderByName()->find();
    $localities = ProvincesLocalitiesQuery::create()->orderByName()->find();

    $successMessage = null;
    $errorMessage = null;

    $successMessageAlert = null;

    $canScheduleShipments = $GLOBALS["User"]["Capabilities"]["CanScheduleShipments"];

    if(isset($_POST["submit-form-personal-info"])) {
        $data = $_POST;
        $c = CommercesQuery::create()->findPK($loggedInfo["Id"]);
        if(!$c) {
            $errorMessage = "No se encontró información de la cuenta.";
        }
        else {
            $band = true;
            if($data["email"] != $c->getEmail()) {
                $exist = CommercesQuery::create()->findOneByEmail($data["email"]);
                if($exist) {
                    $band = false;
                    $errorMessage = "La dirección de correo electrónico proporcionada ya está siendo usada en otra cuenta.";
                }
            }
            if($band) {
                $c->setName($data["nombre"]);
                $c->setPhonePersonal($data["telefono"]);
                $c->setIdPositionCommerce($data["cargo"]);
                $c->setUpdatedAt(date("Y-m-d H:i:s"));
                if($c->save()) {
                    $_SESSION["nvapp"] = Commerces_Map($c);
                    $GLOBALS["User"] = $_SESSION["nvapp"];
                    if(!$canScheduleShipments && $GLOBALS["User"]["Capabilities"]["CanScheduleShipments"]) {
                        $successMessageAlert = array('¡Enhorabuena!', 'El perfil ha sido completado<br>y ahora podrá programar envíos.');
                    }
                    $successMessage = "Datos actualizados con éxito.";
                }
                else {
                    $errorMessage = "No se pudo actualizar la información.";
                }
            }
        }
    }
    else if(isset($_POST["submit-form-company-info"])) {
        $data = $_POST;
        $c = CommercesQuery::create()->findPK($loggedInfo["Id"]);
        if(!$c) {
            $errorMessage = "No se encontró información de la cuenta.";
        }
        else {
            $c->setBusinessName($data["razon_social"]);
            $c->setCuitCuil($data["cuit_cuil"]);
            $c->setPhone($data["telefono"]);
            $c->setAddress($data["direccion"]);
            $c->setAddressLat($data["direccion_lat"]);
            $c->setAddressLng($data["direccion_lng"]);
            $c->setAddressLocality($data["direccion_localidad"]);
            $c->setAddressRegion($data["direccion_region"]);
            $c->setAddressCountry($data["direccion_pais"]);
            $c->setIdProvince($data["provincia"]);
            $c->setIdLocality($data["localidad"]);
            $c->setIdHeadingCommerce($data["rubro"]);
            $c->setUpdatedAt(date("Y-m-d H:i:s"));
            
            if($data["cuit_cuil_doc"]) {
                $data["cuit_cuil_doc"] = base64_decode($data["cuit_cuil_doc"], true);
                if($data["cuit_cuil_doc"]) {
                    $ccDoc = "uploads/tmp/$data[cuit_cuil_doc]";
                    $fileInfo = pathinfo($ccDoc);
                    $ccDocName = $c->getId() . "_" . $data["cuit_cuil"] . ".$fileInfo[extension]";
                    if(file_exists("uploads/$ccDocName")) {
                        @unlink($ccDocName);
                    }
                    if(@rename($ccDoc, "uploads/$ccDocName")) {
                        $u = UsersQuery::create()->findPK($c->getIdUser());
                        if($u) {
                            if($u->save()) {
                                @copy("uploads/$ccDocName", "../api/uploads/users/$ccDocName");
                            }
                        }
                    }
                }
            }

            if($c->save()) {
                $_SESSION["nvapp"] = Commerces_Map($c);
                $GLOBALS["User"] = $_SESSION["nvapp"];
                if(!$canScheduleShipments && $GLOBALS["User"]["Capabilities"]["CanScheduleShipments"]) {
                    $successMessageAlert = array('¡Enhorabuena!', 'El perfil ha sido completado<br>y ahora podrá programar envíos.');
                }
                $successMessage = "Datos actualizados con éxito.";
            }
            else {
                $errorMessage = "No se pudo actualizar la información.";
            }
        }
    }
    else if(isset($_POST["submit-form-clogo"])) {
        $data = $_POST;
        $c = CommercesQuery::create()->findPK($loggedInfo["Id"]);
        if(!$c) {
            $errorMessage = "No se encontró información de la cuenta.";
        }
        else {
            $logoFile = base64_decode($data["logo"], true);
            if($logoFile) {
                $logoFile = "uploads/tmp/$logoFile";
                $fileInfo = pathinfo($logoFile);
                $logoFileName = uniqid() . ".$fileInfo[extension]";
                if(@rename($logoFile, "uploads/$logoFileName")) {
                    if($c->getLogo()) {
                        @unlink("uploads/" . $c->getLogo());
                    }
                    $c->setLogo($logoFileName);
                    $u = UsersQuery::create()->findPK($c->getIdUser());
                    if($u) {
                        $u->setAvatar($c->getLogo());
                        if($u->save()) {
                            copy("uploads/" . $c->getLogo(), "../api/uploads/users/" . $c->getLogo());
                        }
                    }
                }
            }
            $c->setUpdatedAt(date("Y-m-d H:i:s"));
            if($c->save()) {
                $_SESSION["nvapp"] = Commerces_Map($c);
                $GLOBALS["User"] = $_SESSION["nvapp"];
                if(!$canScheduleShipments && $GLOBALS["User"]["Capabilities"]["CanScheduleShipments"]) {
                    $successMessageAlert = array('¡Enhorabuena!', 'El perfil ha sido completado<br>y ahora podrá programar envíos.');
                }
                $successMessage = "Datos actualizados con éxito.";
            }
            else {
                $errorMessage = "No se pudo actualizar la información.";
            }
        }
    }
?>
<!doctype html>
<html lang="es" class="h-100">

<head>
    <?php require_once('inc/head.php'); ?>
    <link href="lib/dropzone/dropzone.min.css" rel="stylesheet" type="text/css" />
    <style>
        #dzCompanyLogo {
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 36px 0 0 0;
        }

        #dzCompanyLogo .dropzone {
            width: 264px;
            height: 162px;
            color: #B0B6C4;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            border-color: #ced4da;
            border-width: 1px;
            border-style: dashed;
        }

        #dzCompanyLogo .dropzone .dz-message {
            margin: 0;
        }

        #dzCompanyLogo .dropzone .dz-button {
            font-family: 'GibsonW SemiBold';
            margin-bottom: 8px;
            background-image: url(assets/images/attachment.svg);
            background-repeat: no-repeat;
            background-position: center 0;
            padding-top: 36px;
            background-size: 24px;
        }

        #dzCompanyLogo .dropzone .note {
            font-size: 15px;
            padding: 0 4px;
        }

        #dzCompanyLogo .dropzone .dz-preview {
            pointer-events: none;
            margin: 0;
        }
        
        #dzCompanyLogo .dropzone .dz-preview .dz-details,
        #dzCompanyLogo .dropzone .dz-preview .dz-progress,
        #dzCompanyLogo .dropzone .dz-preview .dz-error-message,
        #dzCompanyLogo .dropzone .dz-preview .dz-error-mark, 
        #dzCompanyLogo .dropzone .dz-preview .dz-success-mark {
            display: none !important;
        }

        #dzCompanyLogo .dropzone .dz-preview .dz-image {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        #dzCompanyLogo .dropzone .dz-preview .dz-image img {
            border-radius: 10px;
            height: 100%;
        }

        #form-clogo [name="logo"] {
            display: none;
        }

        #form-clogo [name="logo"].error + label {
            margin-top: -22px;
            left: calc(50% - 10vw);
        }

        #mdLocationPickerMap-lat, 
        #mdLocationPickerMap-lon {
            pointer-events: none;
            background-color: #e9ecf6;
        }

        #mdLocationPickerMap-address {
            border-top-right-radius: 10px !important;
            border-bottom-right-radius: 10px !important;
        }

        .custom-file-upload {
            width: 100%;
            height: 44px;
            border: 1px solid #ced4da;
            font-size: 1rem;
            border-radius: 10px;
            background-image: url(assets/images/attachment.svg);
            background-position: calc(100% - 16px) calc(50% + 2px);
            background-repeat: no-repeat;
            background-size: 16px;
            padding: .375rem .75rem;
            line-height: 2rem;
            color: #212529;
        }

        .custom-file-upload input[type="file"] {
            display: none;
        }

        label#cuit_cuil_archivo-error {
            left: 12px;
            height: 28px;
            line-height: 20px;
        }
    </style>
</head>

<body class="<?php echo BODY_CLASS; ?>">
    <?php require_once('inc/navbar.php'); ?>
    <?php require_once('inc/sidebar.php'); ?>
    <div class="main-content p-2">
        <div class="row g-0">
            <div class="col-lg-9 col-sm-12">
                <div class="card card-box">
                    <div class="card-body p-4 pt-1 m-2 pb-0">
                        <ul class="nav nav-pills nav-fill nav-tabs mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="pills-company-info-tab" data-bs-toggle="pill" data-bs-target="#pills-company-info" type="button" role="tab" aria-controls="pills-company-info" aria-selected="true" data-index="0">Datos de la empresa</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-personal-info-tab" data-bs-toggle="pill"  data-bs-target="#pills-personal-info" type="button" role="tab" aria-controls="pills-personal-info" aria-selected="false" data-index="1">Datos personales</button>
                            </li>
                        </ul>
                        <div class="nav-item-highlight"></div>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-company-info" role="tabpanel" aria-labelledby="pills-company-info-tab">
                                <form id="form-company-info" action="" method="post" class="mt-2">
                                    <div class="row mb-3">
                                        <div class="col form-group">
                                            <label class="form-label">Razón social / Nombre</label>
                                            <input type="text" class="form-control" name="razon_social" value="<?php echo $loggedInfo["BusinessName"]; ?>" required>
                                        </div>
                                        <div class="col form-group">
                                            <label class="form-label">Categoría</label>
                                            <select class="form-control" name="rubro">
                                                <?php foreach($headings as $h): ?>
                                                    <option value="<?php echo $h->getId(); ?>" <?php echo $loggedInfo["Heading"]["Id"] == $h->getId() ? 'selected' : ''; ?>><?php echo $h->getName(); ?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                        <div class="col form-group">
                                            <label class="form-label">Teléfono de contacto</label>
                                            <input type="number" class="form-control" name="telefono" minlength="11" maxlength="11" value="<?php echo $loggedInfo["Phone"]; ?>" required>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col form-group">
                                            <label class="form-label">Tipo de Documento de Identificación</label>
                                            <select class="form-control" name="tipo_documento">
                                                <option value="DNI">DNI</option>
                                                <option value="CUIT">CUIT</option>
                                            </select>
                                        </div>
                                        <div class="col form-group">
                                            <label class="form-label">Documento de Identificación</label>
                                            <input type="text" class="form-control" name="cuit_cuil" value="<?php echo $loggedInfo["CuitCuil"]; ?>" required>
                                        </div>
                                        <div class="col form-group">
                                            <label class="form-label">Adjuntar DNI o CUIT</label>
                                            <?php if($haveIDDoc): ?>
                                                <label class="custom-file-upload">
                                                    <input type="file" name="cuit_cuil_archivo"/>
                                                    <input type="hidden" name="cuit_cuil_doc"/>
                                                    <span style="width: 204px; text-overflow: ellipsis; overflow: hidden; display: block; white-space: nowrap;">Cambiar documento</span>
                                                </label>
                                            <?php else: ?>
                                                <label class="custom-file-upload">
                                                    <input type="file" name="cuit_cuil_archivo" required/>
                                                    <input type="hidden" name="cuit_cuil_doc" required/>
                                                    <span style="width: 204px; text-overflow: ellipsis; overflow: hidden; display: block; white-space: nowrap;">Seleccionar</span>
                                                </label>
                                            <?php endif ?>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col form-group">
                                            <label class="form-label">Dirección / Domicilio</label>
                                            <input type="text" class="form-control" name="direccion" value="<?php echo $loggedInfo["Address"]; ?>" required>
                                            <input type="hidden" class="form-control" name="direccion_lat" value="<?php echo $loggedInfo["AddressLat"]; ?>">
                                            <input type="hidden" class="form-control" name="direccion_lng" value="<?php echo $loggedInfo["AddressLng"]; ?>">
                                            <input type="hidden" class="form-control" name="direccion_localidad" value="<?php echo $loggedInfo["AddressLocality"]; ?>">
                                            <input type="hidden" class="form-control" name="direccion_region" value="<?php echo $loggedInfo["AddressRegion"]; ?>">
                                            <input type="hidden" class="form-control" name="direccion_pais" value="<?php echo $loggedInfo["AddressCountry"]; ?>">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col form-group">
                                            <label class="form-label">Provincia</label>
                                            <select class="form-control" name="provincia" required>
                                                <?php foreach($provinces as $p): ?>
                                                    <option value="<?php echo $p->getId(); ?>" <?php echo $p->getId() == $loggedInfo["Province"]["Id"] ? "selected" : ""; ?>><?php echo $p->getName(); ?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                        <div class="col form-group">
                                            <label class="form-label">Localidad</label>
                                            <select class="form-control" name="localidad" required></select>
                                        </div>
                                        <div class="col form-group"></div>
                                    </div>
                                    <!--
                                    <div class="row mb-3">
                                        <div class="col form-group">
                                            <label class="form-label">País</label>
                                            <input type="text" class="form-control" name="pais" value="" required>
                                        </div>
                                    </div>
                                    -->
                                    <div class="row mt-4 mb-3">
                                        <div class="col form-group d-flex align-items-center justify-content-center">
                                            <button type="submit" class="btn btn-primary btn-lg" name="submit-form-company-info">Guardar cambios</button>
                                            <button type="reset" class="btn btn-cancel btn-lg">Cancelar edición</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="pills-personal-info" role="tabpanel" aria-labelledby="pills-personal-info-tab">
                                <form id="form-personal-info" action="" method="post" class="mt-2 pb-3">
                                    <div class="row mb-3">
                                        <div class="col form-group">
                                            <label class="form-label">Nombre y Apellido</label>
                                            <input type="text" class="form-control" name="nombre" value="<?php echo $loggedInfo["Name"]; ?>" required>
                                        </div>
                                        <div class="col form-group">
                                            <label class="form-label">Correo Electrónico</label>
                                            <input type="email" class="form-control" name="email" value="<?php echo $loggedInfo["Email"]; ?>" required>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col form-group">
                                            <label class="form-label">Teléfono de contacto</label>
                                            <input type="number" class="form-control" name="telefono" minlength="11" maxlength="11" value="<?php echo $loggedInfo["PersonalPhone"]; ?>" required>
                                        </div>
                                        <div class="col form-group">
                                            <label class="form-label">Cargo en la empresa</label>
                                            <select class="form-control" name="cargo">
                                                <?php foreach($positions as $p): ?>
                                                    <option value="<?php echo $p->getId(); ?>" <?php echo $loggedInfo["Position"]["Id"] == $p->getId() ? 'selected' : ''; ?>><?php echo $p->getName(); ?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col form-group d-flex align-items-center justify-content-center mt-4">
                                            <button type="submit" name="submit-form-personal-info" class="btn btn-primary btn-lg">Guardar cambios</button>
                                            <button type="reset" class="btn btn-cancel btn-lg">Cancelar edición</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-12">
                <div class="card card-box">
                    <div class="card-body">
                        <div class="p-4 pt-3">
                            <h2>Logo / avatar</h2>
                            <form id="form-clogo" action="" method="post" class="mt-2">
                                <div class="row mb-3">
                                    <div class="col form-group">
                                        <div id="dzCompanyLogo" class="mb-4">
                                            <div class="dropzone needsclick">
                                                <div class="dz-message needsclick">
                                                    <button type="button" class="dz-button">Arrastre su logo aquí</button><br />
                                                    <span class="note needsclick">Dimensión sugerida 640x340 px ó en proporción.</span>
                                                </div>
                                            </div>
                                        </div>
                                        <input class="form-control" type="text" name="logo" value="<?php echo $loggedInfo["Logo"] ?: ""; ?>" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col form-group d-flex align-items-center justify-content-center">
                                        <button type="submit" class="btn btn-primary btn-lg" name="submit-form-clogo">Guardar cambios</button>
                                        <button type="reset" class="btn btn-cancel btn-lg">Cancelar edición</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="mdLocationPicker">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Mueve el mapa o el marcador hasta ubicar el domicilio del comercio</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-0"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary button-wide" id="chooseLocationPicker">Seleccionar</button>
                </div>
            </div>
        </div>
    </div>

    <?php require_once('inc/scripts.php'); ?>
    <script src="lib/dropzone/dropzone.min.js" type="text/javascript"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCiWj9PLdW0zCxe3HzK00xS6YawLIZjBXg&libraries=places"></script>
    <script src="lib/jquery-locationpicker/locationpicker.jquery.min.js" type="text/javascript"></script>
    <script>
        <?php if(isset($_POST["submit-form-personal-info"])): ?>
            new bootstrap.Tab(document.querySelector('#pills-personal-info-tab')).show();
        <?php endif ?>

        <?php if($successMessage): ?>
            Toasts.success('<?php echo $successMessage; ?>');
        <?php endif ?>
        <?php if($errorMessage): ?>
            Toasts.error('<?php echo $errorMessage; ?>');
        <?php endif ?>

        <?php if($successMessageAlert): ?>
            Dialogs.success('<?php echo $successMessageAlert[0]; ?>', '<?php echo $successMessageAlert[1]; ?>');
        <?php endif ?>

        var currentPosition = null;
        var currentPositionCommerce = {
            latitude: <?php echo $loggedInfo["AddressLat"] ?: 0; ?>,
            longitude: <?php echo $loggedInfo["AddressLng"] ?: 0; ?>
        };

        navigator.geolocation.getCurrentPosition(function (pos) {
            var crd = pos.coords;
            currentPosition = {
                latitude: crd.latitude,
                longitude: crd.longitude,
            };
        }, function (err) {
            console.warn('ERROR(' + err.code + '): ' + err.message);
        }, {
            enableHighAccuracy: true,
            timeout: 5000,
            maximumAge: 0
        });

        Dropzone.autoDiscover = false;

        var dzLogo = null;
        
        $("#dzCompanyLogo .dropzone").dropzone({
            url: "php/clogo.php",
            paramName: "doc", // The name that will be used to transfer the file
            maxFilesize: 5, // MB
            maxFiles: 1,
            acceptedFiles: 'image/*',
            resizeWidth: '640',
            resizeHeight: '340',
            resizeQuality: 1,
            accept: function (file, done) {
                $('#dzCompanyLogo .dropzone .dz-peview-existing-file').remove();

                var itval = setInterval(function() {
                    if(typeof file.xhr != 'undefined') {
                        if(typeof file.xhr.status != "undefined") {
                            if(file.xhr.status == 200) {
                                clearInterval(itval);
                                const fileHash = file.xhr.responseText;
                                if(fileHash == "ERROR") {
                                    Dialogs.error('Error', 'Hubo un problema al procesar el archivo');
                                }
                                else {
                                    $('#form-clogo [name="logo"]').val(fileHash).trigger('blur');
                                }
                            }
                        }
                    }
                }, 500);
                done();
            },
            init: function () {
                dzLogo = this;
                this.on('maxfilesexceeded', function (file) {
                    this.removeAllFiles();
                    this.addFile(file);
                });
            }
        });

        var tabEl = document.querySelector('.nav-tabs')
        tabEl.addEventListener('shown.bs.tab', function (event) {
            $(tabEl).attr('data-current-tab', event.target.dataset.index);
        });
        $(tabEl).attr('data-current-tab', 0);

        $('.nav-tabs ~ .tab-content .tab-pane').css({
            overflowY: 'auto',
            overflowX: 'hidden',
            maxHeight: `${screen.availHeight - 292}px`
        });

        $('#form-company-info [name="provincia"]').change(function() {
            var v = this.value;
            const data = <?php echo json_encode(provincesData($provinces, $localities)); ?>;
            const info = data.filter(r => r.id == v).pop();
            if(info) {
                var html = '';
                info.localities.forEach(l => {
                    html += `<option value="${l.id}">${l.name}</option>`;
                });
                $('#form-company-info [name="localidad"]').html(html).select2('destroy').select2({
                    theme: "bootstrap-5",
                });
                <?php if($loggedInfo["Locality"] && $loggedInfo["Province"]): ?>
                    if(info.id == <?php echo $loggedInfo["Province"]["Id"]; ?>) {
                        $('#form-company-info [name="localidad"]').val(<?php echo $loggedInfo["Locality"]["Id"]; ?>).trigger('change');
                    }
                <?php endif ?>
            }
        });

        function dzLogoDisplayExistingFile() {
            <?php if($loggedInfo["Logo"] && file_exists("uploads/$loggedInfo[Logo]")): ?>
                $('#dzCompanyLogo .dropzone .dz-preview').eq(0).remove();
                dzLogo.displayExistingFile({ name: "<?php echo $loggedInfo["Logo"]; ?>", size: <?php echo filesize("uploads/$loggedInfo[Logo]"); ?> }, 'uploads/<?php echo $loggedInfo["Logo"]; ?>', () => {
                    $(dzLogo.previewsContainer).find('.dz-preview').addClass('dz-peview-existing-file');
                }, false, false);
            <?php endif ?>
        }

        dzLogoDisplayExistingFile();

        $('#form-company-info').validate({
            submitHandler: function(form) {
                form.submit();
            }
        });
        $('#form-company-info').rememberState('save');

        $('#form-personal-info').validate({
            submitHandler: function(form) {
                form.submit();
            }
        });
        $('#form-personal-info').rememberState('save');

        $('#form-clogo').validate({
            submitHandler: function(form) {
                form.submit();
            }
        });
        $('#form-clogo').on('reset', dzLogoDisplayExistingFile);
        $('#form-clogo').rememberState('save');

        $(function() {
            $('#form-company-info [name="provincia"]').trigger('change');
        });

        var lastPosition = null;
        var lastPositionData = null;
        var selectedPosition = null;
        var lp = null;
        var tOutRevGeoc = null;
        var xhrRevGeoc = null;

        $('#mdLocationPicker').on('hidden.bs.modal', () => {
            lp.settings.onchanged = function() {};
            lp = null;
            lastPosition = null;
            lastPositionData = null;
            clearTimeout(tOutRevGeoc);
            if(xhrRevGeoc) {
                xhrRevGeoc.abort();
                xhrRevGeoc = null;
            }
        });
        
        $('#form-company-info [name="direccion"]').focus(function() {
            $(this).blur();
            $('#mdLocationPicker .modal-body').html(`
                <div style="position: absolute;z-index: 1000;left: 10px;top: 10px;width: calc(100% - 16px);">
                    <div class="form-row">
                        <div class="col-12" style="max-width: calc(100% - 56px);">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><img src="assets/images/marker.svg" height="12"/></div>
                                </div>
                                <input id="mdLocationPickerMap-address" type="text" class="form-control" placeholder="Buscar..." autocomplete="off">
                                <input id="mdLocationPickerMap-address-h" type="hidden" class="form-control" placeholder="Buscar..." autocomplete="off">
                            </div>
                        </div>
                    </div>
                </div>
                <div style="position: absolute;z-index: 1000;top: 64px;left: 10px;">
                    <div class="form-row align-items-center d-none">
                        <div class="col-auto">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Lat.</div>
                                </div>
                                <input id="mdLocationPickerMap-lat" type="number" class="form-control" placeholder="Latitud">
                            </div>
                        </div>
                        <div class="col-auto">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Lon.</div>
                                </div>
                                <input id="mdLocationPickerMap-lon" type="number" class="form-control" placeholder="Longitud">
                            </div>
                        </div>
                    </div>
                </div>
                <style>
                    .pac-container {
                        z-index: 5000;
                    }
                </style>
                <div id="mdLocationPickerMap" style="width: auto; height: 400px;"></div>
            `);
            var autocomplete = new google.maps.places.Autocomplete(document.getElementById('mdLocationPickerMap-address'), {
                componentRestrictions: {
                    country: 'ar'
                }
            });
            google.maps.event.addListener(autocomplete, 'place_changed', function() {
                lp.marker.setPosition(autocomplete.getPlace().geometry.location);
            });

            $('#mdLocationPickerMap-address').focus(function() {
                this.value = '';
            });

            $('#mdLocationPickerMap').locationpicker({
                location: currentPositionCommerce.latitude != 0 && currentPositionCommerce.longitude != 0 ? currentPositionCommerce : {
                    latitude: selectedPosition ? selectedPosition.latitude : (currentPosition ? currentPosition.latitude : -38.71959),
                    longitude: selectedPosition ? selectedPosition.longitude : (currentPosition ? currentPosition.longitude : -62.27243)
                },
                radius: 0,
                inputBinding: {
                    latitudeInput: $('#mdLocationPickerMap-lat'),
                    longitudeInput: $('#mdLocationPickerMap-lon'),
                    autocompleteInput: $('#mdLocationPickerMap-address-h')
                },
                markerInCenter: true,
                enableAutocomplete: true,
                onchanged: function(cLocation, radius, isMarkerDropped) {
                    if(!lastPosition) {
                        lastPosition = cLocation;
                    }
                    else if(lastPosition.latitude == cLocation.latitude && lastPosition.longitude == cLocation.longitude) {
                        return;
                    }
                    else {
                        lastPosition = cLocation;
                    }
                    lastPosition = cLocation;

                    console.log('CHANGED: ', cLocation);
                    
                    $('#chooseLocationPicker').addClass('disabled');
                    $('#mdLocationPickerMap-address').val("Computando dirección...");
                    if(xhrRevGeoc) {
                        xhrRevGeoc.abort();
                    }
                    clearTimeout(tOutRevGeoc);
                    tOutRevGeoc = setTimeout(() => {
                        xhrRevGeoc = $.getJSON('https://nominatim.openstreetmap.org/reverse', {
                            lat: cLocation.latitude,
                            lon: cLocation.longitude,
                            format: 'json'
                        }, function(response) {
                            lastPositionData = response.address;
                            lastPositionData.display_name = response.display_name;
                            $('#mdLocationPickerMap-address').val(response.display_name);
                            $('#chooseLocationPicker').removeClass('disabled');
                        });
                    }, 1000);
                },
                onlocationnotfound: function(locationName) {},
                oninitialized: function (component) {
                    lp = component.data().locationpicker;
                },
            });
            $('#mdLocationPicker').modal('show');
        });

        $('#chooseLocationPicker').click(function() {
            selectedPosition = Object.assign(lastPosition, lastPositionData);
            console.log(selectedPosition);
            $('#mdLocationPicker').modal('hide');
            $('#form-company-info [name="direccion"]').val(selectedPosition.display_name);
            $('#form-company-info [name="direccion_lat"]').val(selectedPosition.latitude);
            $('#form-company-info [name="direccion_lng"]').val(selectedPosition.longitude);
            $('#form-company-info [name="direccion_region"]').val(selectedPosition.region);
            $('#form-company-info [name="direccion_localidad"]').val(selectedPosition.city);
            $('#form-company-info [name="direccion_pais"]').val(selectedPosition.country);
        });

        $('#form-company-info [name="cuit_cuil_archivo"]').change(function() {
            const el = this;
            const file = el.files.length > 0 ? el.files[0] : null;
            if(file) {
                $('#form-company-info [name="cuit_cuil_archivo"]').closest('.form-group').find('.custom-file-upload span').text('Preparando archivo...');
                var fd = new FormData();
                fd.append('doc', file);
                $.ajax({
                    url: 'php/iddoc.php',
                    type: 'POST',
                    data: fd,
                    success: function (data) {
                        $('#form-company-info [name="cuit_cuil_archivo"]').closest('.form-group').find('.custom-file-upload span').text(file.name);
                        $('#cuit_cuil_archivo-error').remove();
                        $('#form-company-info [name="cuit_cuil_archivo"]').removeClass('error');
                        $('#form-company-info [name="cuit_cuil_doc"]').val(data);
                    },
                    cache: false,
                    contentType: false,
                    processData: false
                });
            }
        });
    </script>
</body>

</html>