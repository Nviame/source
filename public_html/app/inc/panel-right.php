<?php
    $rSuccessMessage = null;
    $rErrorMessage = null;
    if(isset($_POST["submit-form-reminder-info"])) {
        $data = $_POST;
        $r = new CommercesReminders();
        $r->setIdCommerce($GLOBALS["User"]["Id"]);
        $r->setIcon($data["icono"]);
        $r->setTitle($data["titulo"]);
        $r->setContent($data["contenido"]);
        $r->setRegisteredAt(date('Y-m-d H:i:s'));
        if($r->save()) {
            $rSuccessMessage = "Recordatorio agregado con éxito.";
        }
        else {
            $rErrorMessage = "Hubo un problema al agregar el recordatorio.";
        }
    }
    else if(isset($_POST["del-reminder"]) && isset($_POST["i"])) {
        $data = $_POST;
        $r = CommercesRemindersQuery::create()->findPK($_POST["i"]);
        if($r) {
            if($r->getIdCommerce() === $GLOBALS["User"]["Id"]) {
                if($r->delete()) {
                    //$rSuccessMessage = "Recordatorio eliminado con éxito.";
                    echo "OK";
                }
            }
            else{
                //$rErrorMessage = "No existe el recordatorio.";
                echo "ERROR";
            }
        }
        else {
            //$rErrorMessage = "No existe el recordatorio.";
            echo "ERROR";
        }
        exit(0);
    }
    $reminders = CommercesRemindersQuery::create()->filterByIdCommerce($GLOBALS["User"]["Id"])->orderByRegisteredAt('desc')->find();
?>
<div class="modal fade" id="mdAddReminder">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <form id="form-reminder-info" class="modal-content" action="" method="post">
            <div class="modal-header">
                <h5 class="modal-title">Agregar recordatorio</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body py-2 px-4 mx-1">
                <div class="row mb-2">
                    <div class="col-lg-12 form-group mb-3">
                        <label class="form-label">Icono</label>
                        <div class="d-flex">
                            <?php foreach(array_diff(scandir(dirname( dirname(__FILE__) ) . DIRECTORY_SEPARATOR .  "assets" . DIRECTORY_SEPARATOR . "images" . DIRECTORY_SEPARATOR . "reminders-icons"), array('..', '.')) as $icon): ?>
                                <label class="label-radio <?php if($icon === "1 notifications.svg") { echo 'selected'; } ?>">
                                    <input type="radio" name="icono" value="<?php echo $icon; ?>" <?php if($icon === "1 notifications.svg") { echo 'checked'; } ?>>
                                    <?php echo svgIcon("reminders-icons" . DIRECTORY_SEPARATOR . "$icon"); ?> 
                                </label>
                            <?php endforeach ?>
                        </div>
                    </div>
                    <div class="col-lg-12 form-group mb-3">
                        <label class="form-label">Título</label>
                        <input type="text" class="form-control" name="titulo" required>
                    </div>
                    <div class="col-lg-12 form-group mb-3">
                        <label class="form-label">Contenido</label>
                        <input type="text" class="form-control" name="contenido" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="buttom" class="btn btn-cancel button-wide" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" name="submit-form-reminder-info" class="btn btn-primary button-wide">Guardar</button>
            </div>
        </form>
    </div>
</div>
<script>
    window.onload = function() {
        <?php if($rSuccessMessage): ?>
            Toasts.success('<?php echo $rSuccessMessage; ?>');
        <?php endif ?>
        <?php if($rErrorMessage): ?>
            Toasts.error('<?php echo $rErrorMessage; ?>');
        <?php endif ?>

        $(document).on('click', '.reminders-list [data-rel="actions"] a[data-action="delete"]', (e) => {
            const el = e.target;
            $.post(location.href, {
                'del-reminder': 1,
                'i': el.dataset.target
            }, function(resp) {
                $(el).closest('li').addClass('deleted').animate({ height: 'toggle', opacity: 'toggle', marginBottom: '-12px', padding: 0 }, 400);
                $('.count-reminders').text($('.reminders-list ul li:not(.deleted)').length || "Sin");
            });
        });

        $('#mdAddReminder').on('hidden.bs.modal', () => {
            $('#form-reminder-info input').val("").trigger("change");
            $('#form-reminder-info input').removeClass("error");
            $('#form-reminder-info input ~ label.error').hide();
            $('#form-reminder-info .label-radio').eq(0).trigger("click");
        });

        $('#form-reminder-info').validate({
            submitHandler: (form) => {
                form.submit();
            }
        });
    };
</script>
<div class="panel-right hidden">
    <a href="javascript: void(0);" class="panel-right-toggle"></a>
    <div class="panel-right-content">
        <p><span class="count-reminders"><?php echo count($reminders) ?: "Sin"; ?></span> recordatorios <a href="#" class="add-reminder" data-bs-toggle="modal" data-bs-target="#mdAddReminder"></a></p>
        <div class="reminders-list">
            <ul><?php foreach($reminders as $r): ?>
                <li>
                    <div data-rel="actions">
                        <a href="#" data-action="delete" data-target="<?php echo $r->getId(); ?>"><img src="assets/images/close.svg" alt=""></a>
                    </div>
                    <div data-rel="media">
                        <div data-rel="icon">
                            <img src="assets/images/reminders-icons/<?php echo $r->getIcon(); ?>" alt="">
                        </div>
                    </div>
                    <div data-rel="content">
                        <div data-rel="title"><?php echo $r->getTitle(); ?></div>
                        <div data-rel="text"><?php echo $r->getContent(); ?></div>
                    </div>
                </li>
            <?php endforeach ?></ul>
        </div>
    </div>
</div>