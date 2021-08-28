<div class="modal" id="md-send-push">
    <div class="modal__content">
        <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200">
            <h2 class="font-medium text-base mr-auto">Enviar notificación push</h2>
        </div>
        <div id="md-send-push-content" class="p-5 grid grid-cols-12 gap-4 row-gap-3"></div>
        <div class="px-5 py-3 text-right border-t border-gray-200">
            <button type="button" class="button w-20 border text-gray-700 mr-1" data-dismiss="modal">Cancelar</button>
            <button type="button" class="button w-20 bg-theme-1 text-white" id="send-push-a">Enviar</button>
        </div>
    </div>
</div>

<script>
    $('.side-menu.side-menu--active').eq(0).click();

    function sPush() {
        $('#md-send-push').modal('show');
        $('#md-send-push-content').html(`
            <div style="width: 200px;height: 200px;margin-left: calc(50% + 100px);"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="margin: auto; display: block;" width="200px" height="200px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid"> <circle cx="75" cy="50" fill="#9d73ff" r="5"> <animate attributeName="r" values="3;3;5;3;3" times="0;0.1;0.2;0.3;1" dur="1s" repeatCount="indefinite" begin="-0.9166666666666666s"></animate> <animate attributeName="fill" values="#9d73ff;#9d73ff;#4c00ff;#9d73ff;#9d73ff" repeatCount="indefinite" times="0;0.1;0.2;0.3;1" dur="1s" begin="-0.9166666666666666s"></animate> </circle><circle cx="71.65063509461098" cy="62.5" fill="#9d73ff" r="5"> <animate attributeName="r" values="3;3;5;3;3" times="0;0.1;0.2;0.3;1" dur="1s" repeatCount="indefinite" begin="-0.8333333333333334s"></animate> <animate attributeName="fill" values="#9d73ff;#9d73ff;#4c00ff;#9d73ff;#9d73ff" repeatCount="indefinite" times="0;0.1;0.2;0.3;1" dur="1s" begin="-0.8333333333333334s"></animate> </circle><circle cx="62.5" cy="71.65063509461096" fill="#9d73ff" r="5"> <animate attributeName="r" values="3;3;5;3;3" times="0;0.1;0.2;0.3;1" dur="1s" repeatCount="indefinite" begin="-0.75s"></animate> <animate attributeName="fill" values="#9d73ff;#9d73ff;#4c00ff;#9d73ff;#9d73ff" repeatCount="indefinite" times="0;0.1;0.2;0.3;1" dur="1s" begin="-0.75s"></animate> </circle><circle cx="50" cy="75" fill="#9d73ff" r="5"> <animate attributeName="r" values="3;3;5;3;3" times="0;0.1;0.2;0.3;1" dur="1s" repeatCount="indefinite" begin="-0.6666666666666666s"></animate> <animate attributeName="fill" values="#9d73ff;#9d73ff;#4c00ff;#9d73ff;#9d73ff" repeatCount="indefinite" times="0;0.1;0.2;0.3;1" dur="1s" begin="-0.6666666666666666s"></animate> </circle><circle cx="37.50000000000001" cy="71.65063509461098" fill="#9d73ff" r="5"> <animate attributeName="r" values="3;3;5;3;3" times="0;0.1;0.2;0.3;1" dur="1s" repeatCount="indefinite" begin="-0.5833333333333334s"></animate> <animate attributeName="fill" values="#9d73ff;#9d73ff;#4c00ff;#9d73ff;#9d73ff" repeatCount="indefinite" times="0;0.1;0.2;0.3;1" dur="1s" begin="-0.5833333333333334s"></animate> </circle><circle cx="28.34936490538903" cy="62.5" fill="#9d73ff" r="5"> <animate attributeName="r" values="3;3;5;3;3" times="0;0.1;0.2;0.3;1" dur="1s" repeatCount="indefinite" begin="-0.5s"></animate> <animate attributeName="fill" values="#9d73ff;#9d73ff;#4c00ff;#9d73ff;#9d73ff" repeatCount="indefinite" times="0;0.1;0.2;0.3;1" dur="1s" begin="-0.5s"></animate> </circle><circle cx="25" cy="50" fill="#9d73ff" r="5"> <animate attributeName="r" values="3;3;5;3;3" times="0;0.1;0.2;0.3;1" dur="1s" repeatCount="indefinite" begin="-0.4166666666666667s"></animate> <animate attributeName="fill" values="#9d73ff;#9d73ff;#4c00ff;#9d73ff;#9d73ff" repeatCount="indefinite" times="0;0.1;0.2;0.3;1" dur="1s" begin="-0.4166666666666667s"></animate> </circle><circle cx="28.34936490538903" cy="37.50000000000001" fill="#9d73ff" r="5"> <animate attributeName="r" values="3;3;5;3;3" times="0;0.1;0.2;0.3;1" dur="1s" repeatCount="indefinite" begin="-0.3333333333333333s"></animate> <animate attributeName="fill" values="#9d73ff;#9d73ff;#4c00ff;#9d73ff;#9d73ff" repeatCount="indefinite" times="0;0.1;0.2;0.3;1" dur="1s" begin="-0.3333333333333333s"></animate> </circle><circle cx="37.499999999999986" cy="28.349364905389038" fill="#9d73ff" r="5"> <animate attributeName="r" values="3;3;5;3;3" times="0;0.1;0.2;0.3;1" dur="1s" repeatCount="indefinite" begin="-0.25s"></animate> <animate attributeName="fill" values="#9d73ff;#9d73ff;#4c00ff;#9d73ff;#9d73ff" repeatCount="indefinite" times="0;0.1;0.2;0.3;1" dur="1s" begin="-0.25s"></animate> </circle><circle cx="49.99999999999999" cy="25" fill="#9d73ff" r="5"> <animate attributeName="r" values="3;3;5;3;3" times="0;0.1;0.2;0.3;1" dur="1s" repeatCount="indefinite" begin="-0.16666666666666666s"></animate> <animate attributeName="fill" values="#9d73ff;#9d73ff;#4c00ff;#9d73ff;#9d73ff" repeatCount="indefinite" times="0;0.1;0.2;0.3;1" dur="1s" begin="-0.16666666666666666s"></animate> </circle><circle cx="62.5" cy="28.349364905389034" fill="#9d73ff" r="5"> <animate attributeName="r" values="3;3;5;3;3" times="0;0.1;0.2;0.3;1" dur="1s" repeatCount="indefinite" begin="-0.08333333333333333s"></animate> <animate attributeName="fill" values="#9d73ff;#9d73ff;#4c00ff;#9d73ff;#9d73ff" repeatCount="indefinite" times="0;0.1;0.2;0.3;1" dur="1s" begin="-0.08333333333333333s"></animate> </circle><circle cx="71.65063509461096" cy="37.499999999999986" fill="#9d73ff" r="5"> <animate attributeName="r" values="3;3;5;3;3" times="0;0.1;0.2;0.3;1" dur="1s" repeatCount="indefinite" begin="0s"></animate> <animate attributeName="fill" values="#9d73ff;#9d73ff;#4c00ff;#9d73ff;#9d73ff" repeatCount="indefinite" times="0;0.1;0.2;0.3;1" dur="1s" begin="0s"></animate> </circle> </svg></div>
        `);
        API.get('users', {}, (json) => {
            $('#md-send-push-content').html(`
                <div class="col-span-12 sm:col-span-12">
                    <label class="mb-2" style="display: inline-flex;">Usuarios</label>
                    <select class="select2 w-full" multiple></select>
                </div>
                <div class="col-span-12 sm:col-span-12">
                    <label>Título</label>
                    <input id="s-push-title" type="text" class="input w-full border mt-2 flex-1" placeholder="">
                </div>
                <div class="col-span-12 sm:col-span-12">
                    <label>Contenido</label>
                    <textarea id="s-push-content" class="input w-full border mt-2 flex-1" rows="3"></textarea>
                </div>
            `);
            var data = [{
                id: "0",
                text: "Todos"
            }];
            json.data.forEach(function(u) {
                data.push({
                    id: u.id,
                    text: u.display_name
                });
            });
            $('#md-send-push-content .select2').select2({
                //allowClear: true,
                closeOnSelect: false,
                placeholder: 'Selecciona los usuarios',
                data: data
            }).on('select2:select', function(e) {
                var el = this;
                var data = e.params.data;
                if(data.id > 0) {
                    var v = $('#md-send-push-content .select2').val().filter(r => r > 0);
                    $('#md-send-push-content .select2').val(v).trigger('change.select2');
                    if(v.length == 1) {
                        $(el).select2('close');
                    }
                }
                else {
                    $('#md-send-push-content .select2').val(["0"]).trigger('change.select2');
                    $(el).select2('close');
                }
            });
            $('#md-send-push-content .select2').val(["0"]).trigger('change.select2');
        });
    }

    $('#send-push-a').click(() => {
        const el = this;
        var u = $('#md-send-push-content .select2').val();
        var error = null;
        if(u.length > 0) {
            var t = $('#s-push-title').val();
            var c = $('#s-push-content').val();
            if(t && c) {
                $(el).css({
                    pointerEvents: 'none'
                }).animate({
                    opacity: 0.7
                }, 400);
                API.post(`users/push_notification`, {
                    u: u,
                    t: t,
                    c: c
                }, (json) => {
                    if(json.status == "OK") {
                        $('.modal').modal('hide');
                        setTimeout(() => {
                            $('#success-modal-title').html('Operación exitosa');
                            $('#success-modal-content').html('Se envió el mensaje a los destinatarios seleccionados.');
                            $('#success-modal').modal('show');
                            $(el).css({
                                pointerEvents: 'auto'
                            }).animate({
                                opacity: 1
                            }, 400);
                        }, 500);
                    }
                });
            }
            else {
                error = "Faltan campos por llenar.";
            }
        }
        else {
            error = "Selecciona al menos 1 usuario.";
        }
        if(error) {
            $('#error-modal-title').html('Error');
            $('#error-modal-content').html(error);
            $('#error-modal').modal('show');
        }
    });
</script>