<?php
    /*ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);*/

    session_start();

    require_once('../ormnv/include.php');

    require_once 'vendor/autoload.php';
    use \Firebase\JWT\JWT;

    $positions = PositionsCommerceQuery::create()->find();
    $headings = HeadingsCommerceQuery::create()->find();

    $registrationError = "";

    $data = $_POST;

    function regNotifications($userId, $title, $content) {
        $n = new Notifications();
        $n->setIdUser($userId);
        $n->setTitle($title);
        $n->setContent($content);
        $n->setDatetime(gmdate("Y-m-d H:i:s"));
        $n->setReaded(0);
        $n->setGroup('initial_notification');
        return $n->save();
    }

    if(!empty($data)) {
        $exist = CommercesQuery::create()->findOneByEmail($data["email"]);
        $existU = UsersQuery::create()->findOneByEmail($data["email"]);
        if($exist || $existU) {
            $registrationError = "La dirección de correo electrónico proporcionada ya está en uso.";
        }
        else {
            $pwd = Crypt::gHashPwd($data["clave"]);

            $c = new Commerces();
            $c->setIdPositionCommerce($data["cargo"]);
            $c->setIdHeadingCommerce($data["rubro"]);
            $c->setBusinessName($data["razon_social"]);
            $c->setCuitCuil($data["cuit_cuil"]);
            $c->setName($data["nombre"]);
            $c->setPhone($data["telefono"]);
            $c->setEmail($data["email"]);
            $c->setPassword($pwd);
            if($c->save()) {
                $c->setToken(JWT::encode(array(
                    "id" => $c->getId(),
                    "email" => $c->getEmail()
                ), JWT_SECRET));
                $c->save();

                // ----
                $u = new Users();
                $u->setFullname($data["razon_social"]);
                $u->setFirstName($data["razon_social"]);
                $u->setLastName($data["nombre"]);
                $u->setDni($data["cuit_cuil"]);
                $u->setEmail($data["email"]);
                $u->setPassword($pwd);
                $u->setPhone($data["telefono"]);
                $u->setRegisteredAt(date("Y-m-d H:i:s"));
                if($u->save()) {
                    $c->setIdUser($u->getId());
                    $c->save();

                    $us = new UsersSettings();
                    $us->setUserId($u->getId());
                    $us->setPushNewShipments(1);
                    $us->setPushOffers(1);
                    $us->setOnline(1);
                    $us->save();

                    regNotifications($u->getId(), 'Perfil', 'Para hacer entregas, necesitamos que completes tus datos personales.');
                    regNotifications($u->getId(), 'Billetera', 'Para recibir pagos, necesitamos que conectes tu cuenta de Mercado Pago.');
                    regNotifications($u->getId(), 'Vehículos', 'Si vas a entregar con movilidad propia, necesitamos que cargues los datos en tu perfil.');
                }
                // ----

                // Redirect to main page
                $_SESSION["nvapp"] = Commerces_Map($c);
                header('Location: dashboard');
            }
            else {
                $registrationError = "Hubo un problema al registrar el comercio.";
            }
        }
    }
?>
<!doctype html>
<html lang="es" class="h-100">

<head>
    <?php require_once('inc/head.php'); ?>
    <link href="//cdn.jsdelivr.net/npm/smartwizard@5/dist/css/smart_wizard_all.min.css" rel="stylesheet" type="text/css" />
    <style>
        .sw-theme-dots>.nav .nav-link {
            font-weight: bold;
            font-size: 15px;
            letter-spacing: 0.5px;
        }

        .sw-theme-dots>.nav .nav-link.active::after {
            background-color: var(--bs-primary) !important;
        }

        .sw-theme-dots>.nav .nav-link.active {
            color: var(--bs-primary) !important;
        }

        .sw-theme-dots>.nav .nav-link.done::after {
            background-color: var(--bs-primary) !important;
        }

        .sw-theme-dots>.nav .nav-link.done {
            color: var(--bs-primary) !important;
        }

        .sw-theme-dots>.nav .nav-link.inactive {
            color: #A7A9AC;
        }

        .sw-theme-dots>.nav .nav-link.inactive::after {
            background-color: #A7A9AC;
        }

        .sw-theme-dots>.nav::before {
            background: #E6E7E8;
            border-radius: 8px;
            width: calc(100% - 1em);
            left: 0.5em;
            /*
            width: calc(100% - 10em);
            left: 5em;*/
        }
        .sw-theme-dots>.tab-content>.tab-pane {
            min-width: 100%;
        }
    </style>
</head>

<body class="h-100">
    <div class="container-fluid h-100">
        <div class="row h-100">
            <div class="col bg-primary d-flex align-items-center">
                <div class="ps-5">
                    <p><img src="assets/images/logo_nviame.svg" alt="" height="32"></p>
                    <h1>Comunidad de<br>envíos y entregas<br>on-demand.</h1>
                </div>
            </div>
            <div class="col d-flex align-items-center">
                <div class="mx-5 px-4 w-100 mt-3" style="height: calc(100% - 64px);">
                    <?php if($registrationError): ?>
                        <h2 class="text-danger"><?php echo $registrationError; ?></h2>
                    <?php else: ?>
                        <h2>Vamos a completar<br>algunos datos.</h2>
                    <?php endif ?>
                    <form id="fregister" class="needs-validation mt-4" action="" method="post" novalidate>
                        <div id="wregister">
                            <ul class="nav">
                                <li class="nav-item">
                                    <a class="nav-link" href="#step-1">
                                        Datos Personales
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#step-2">
                                        Datos Profesionales
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#step-3">
                                        Datos de Acceso
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div id="step-1" class="tab-pane" role="tabpanel" aria-labelledby="step-1">
                                    <div class="row mb-3">
                                        <div class="col form-group">
                                            <label class="form-label">Razón social / Nombre</label>
                                            <input type="text" class="form-control" name="razon_social" value="<?php echo $registrationError ? $data["razon_social"] : ""; ?>" required>
                                        </div>
                                        <div class="col form-group d-none">
                                            <label class="form-label">CUIT / CUIL</label>
                                            <input type="text" class="form-control" name="cuit_cuil" value="" value_="<?php echo $registrationError ? $data["cuit_cuil"] : ""; ?>">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col form-group">
                                            <label class="form-label">Nombre y Apellido</label>
                                            <input type="text" class="form-control" name="nombre" value="<?php echo $registrationError ? $data["nombre"] : ""; ?>" required>
                                        </div>
                                        <div class="col form-group">
                                            <label class="form-label">Teléfono de contacto</label>
                                            <input type="number" class="form-control" name="telefono" minlength="11" maxlength="11" value="<?php echo $registrationError ? $data["telefono"] : ""; ?>" required>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-center">
                                        <a href="javascript: void(0);" class="btn btn-primary button-wide mt-4 swn">Continuar</a>
                                    </div>
                                </div>
                                <div id="step-2" class="tab-pane" role="tabpanel" aria-labelledby="step-2">
                                    <div class="row mb-3">
                                        <div class="col form-group">
                                            <label class="form-label">Categoría</label>
                                            <select class="form-select" name="rubro">
                                                <?php foreach($headings as $h): ?>
                                                    <option value="<?php echo $h->getId(); ?>"><?php echo $h->getName(); ?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col form-group">
                                            <label class="form-label">Cargo</label>
                                            <select class="form-select" name="cargo">
                                                <?php foreach($positions as $p): ?>
                                                    <option value="<?php echo $p->getId(); ?>"><?php echo $p->getName(); ?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-center">
                                        <a href="javascript: void(0);" class="btn btn-primary button-wide mt-4 swn">Continuar</a>
                                    </div>
                                </div>
                                <div id="step-3" class="tab-pane" role="tabpanel" aria-labelledby="step-3">
                                    <div class="row mb-3">
                                        <div class="col form-group">
                                            <label class="form-label">Correo electrónico</label>
                                            <input type="email" name="email" class="form-control" value="<?php echo $registrationError ? $data["email"] : ""; ?>" required>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col form-group">
                                            <label class="form-label">Contraseña</label>
                                            <input id="clave" name="clave" type="password" value="<?php echo $registrationError ? $data["clave"] : ""; ?>" class="form-control" required>
                                        </div>
                                        <div class="col form-group">
                                            <label class="form-label">Repita contraseña</label>
                                            <input id="clavec" name="clavec" type="password" class="form-control" value="<?php echo $registrationError ? $data["clave"] : ""; ?>" required>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col form-check ps-5">
                                            <input class="form-check-input" type="checkbox" id="tos">
                                            <label class="form-check-label" for="tos">
                                                Al continuar, está aceptando los <a href="https://www.nviame.com/terminos-y-condiciones.html" target="_blank">términos y condiciones de uso</a>.
                                            </label>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-center">
                                        <a href="javascript: void(0);" class="btn btn-primary button-wide mt-4 swn">Registrarse</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="container-fluid fixed-bottom mb-5 offset-6">
            <div class="row w-50 justify-content-center">
                <div class="col text-center">Comunidad de Envíos S.A.</div>
                <div class="col text-end me-4"><a href="https://www.nviame.com/terminos-y-condiciones.html" target="_blank">Términos y condiciones</a></div>
            </div>
        </div>
    </div>
    <?php require_once('inc/scripts.php'); ?>
    <script src="//cdn.jsdelivr.net/npm/smartwizard@5/dist/js/jquery.smartWizard.min.js" type="text/javascript"></script>
    <script>
        $("#fregister").validate({
            onfocusout: false
        });

        $(function() {
            $('#wregister').smartWizard({
                theme: 'dots',
                enableURLhash: false,
                selected: <?php echo $registrationError ? 2 : 0; ?>,
                transition: {
                    animation: 'slide-horizontal'
                },
                toolbarSettings: {
                    toolbarPosition: 'none'
                }
            });
            $('#wregister .swn').click(function() {
                const cstep = $('#wregister').smartWizard("getStepIndex") + 1;
                $("#fregister").valid();
                if($("#step-" + cstep + " input.error").length == 0) {
                    if(cstep == 3) {
                        if(document.getElementById('clave').value == document.getElementById('clavec').value) {
                            if($('#tos').prop('checked')) {
                                $("#fregister").submit();
                            }
                            else {
                                Dialogs.error('Términos y Condiciones', 'Para proceder al registro de su cuenta debe<br>aceptar los <a href="https://www.nviame.com/terminos-y-condiciones.html" target="_blank">términos y condiciones de uso</a>.');Dialogs.error('Términos y Condiciones', 'Para proceder al registro de su cuenta debe aceptar los <a href="https://www.nviame.com/terminos-y-condiciones.html" target="_blank">términos y condiciones de uso</a>.');
                            }
                        }
                        else {
                            $('#clavec-error').remove();
                            $('#clavec').addClass('error').attr('aria-invalid', 'true').closest('.form-group').append(`
                                <label id="clavec-error" class="error" for="clavec">La contraseña no coincide.</label>
                            `);
                        }
                    }
                    else {
                        $('#wregister').smartWizard("goToStep", cstep);

                        if(cstep == 2) {
                            $('#step-3 input').removeClass('error');
                            $('#step-3 input + .error').remove();
                        }
                    }
                }
            });
        });
    </script>
</body>

</html>