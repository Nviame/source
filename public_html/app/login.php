<?php
    session_start();

    if(isset($_SESSION["nvapp"])) header('Location: dashboard');

    require_once('../ormnv/include.php');

    require_once 'vendor/autoload.php';
    use \Firebase\JWT\JWT;

    $loginError = "";

    $data = $_POST;

    if(!empty($data)) {
        $c = CommercesQuery::create()->joinPositionsCommerce()->joinHeadingsCommerce()->findOneByEmail($data["email"]);
        if($c) {
            if(Crypt::cHashPwd($data["clave"], $c->getPassword())) {
                // Redirect to main page
                $data = json_decode($c->toJSON(), true);
                $pc = $c->getPositionsCommerce();
                $hc = $c->getHeadingsCommerce();
                $pr = $c->getProvinces();
                $lo = $c->getProvincesLocalities();
                $_SESSION["nvapp"] = Commerces_Map($c);
                header('Location: dashboard');
            }
            else {
                $loginError = "Datos de acceso incorrectos.";
            }
        }
        else {
            $loginError = "La dirección de correo electrónico no está asociada a ninguna cuenta.";
        }
    }
?>
<!doctype html>
<html lang="es" class="h-100">

<head>
    <?php require_once('inc/head.php'); ?>
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
            <div class="col">
                <div class="mt-3 pt-4 h-100 w-100 d-flex align-items-center justify-content-center">
                    <div class="w-50">
                        <h2>Inicio se sesión.</h2>
                        <?php if($loginError): ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <?php echo $loginError; ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif ?>
                        <form id="flogin" class="mt-4" action="" method="POST">
                            <div class="mb-3 form-group">
                                <label class="form-label">Correo electrónico</label>
                                <input type="email" class="form-control" name="email" required>
                            </div>
                            <div class="mb-3 form-group">
                                <label class="form-label">Contraseña</label>
                                <input type="password" class="form-control" name="clave" required>
                            </div>
                            <div class="container-fluid mt-5">
                                <div class="row justify-content-center">
                                    <button type="submit" class="btn btn-primary button-wide">Iniciar sesión</button>
                                </div>
                            </div>
                        </form>
                        <div class="mt-4 mb-5 text-center">
                            <div>Olvidé la contraseña, <a href="recuperarclave" class="color-black"><strong>quiero recuperarla</strong></a></div>
                            <div class="mt-2">No tengo cuenta, <a href="registro" class="color-black"><strong>quiero registrar mi comercio</strong></a></div>
                        </div>
                    </div>
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
    <script>
        $(function() {
            $("#flogin").validate({
                onfocusout: false
            });
        });
    </script>
</body>

</html>