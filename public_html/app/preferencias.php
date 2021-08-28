<?php
    require_once('inc/globals.php');
    $pref = CommercesPreferencesQuery::create()->findOneByIdCommerce($GLOBALS["User"]["Id"]);
    if(!$pref) {
        $pref = new CommercesPreferences();
        $pref->setIdCommerce($GLOBALS["User"]["Id"]);
        $pref->save();
    }

    $successMessage = null;
    $errorMessage = null;
    
    if(isset($_POST["submit-fpreferences"])) {
        $data = $_POST;
        $pref->setMaxOffers($data["max_ofertas"] ?: null);
        $pref->setSendMails(isset($data["enviar_mails"]) && $data["enviar_mails"] == "on");
        $pref->setUpdatedAt(date("Y-m-d H:i:s"));
        if($pref->save()) {
            $prefU = UsersSettingsQuery::create()->findOneByUserId($GLOBALS["User"]["IdUser"]);
            $prefU->setShipmentsMaxOffers($data["max_ofertas"] ?: null);

            $successMessage = "Datos actualizados con éxito.";
        }
        else {
            $errorMessage = "No se pudo actualizar la información.";
        }
    }
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
            <div class="col-lg-5">
                <div class="card card-box">
                    <div class="card-body">
                        <div class="p-4 pt-3">
                            <h2>Preferencias</h2>
                            <div class="w-100">
                                <form id="fpreferences" class="mt-3" method="post" action="">
                                    <div class="row">
                                        <legend>Ofertas</legend>
                                        <div class="form-group col-lg-12 col-sm-12 mb-3">
                                            <label class="form-label">Máximo de ofertas</label>
                                            <input type="number" class="form-control" name="max_ofertas" value="<?php echo $pref->getMaxOffers() ?: ""; ?>" required>
                                        </div>
                                        <legend>Notificaciones</legend>
                                        <div class="form-group col-lg-12 col-sm-12 mb-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="enviar_mails" id="nemail" <?php echo $pref->getSendMails() ? ' checked' : ''; ?>>
                                                <label class="form-check-label" for="nemail">
                                                    Enviar correo electrónico al receptor del envío
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="container-fluid mt-3">
                                        <div class="row justify-content-center">
                                            <div class="col">
                                                <button type="submit" class="btn btn-primary w-100" name="submit-fpreferences">Guardar</button>
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
    </script>
</body>

</html>