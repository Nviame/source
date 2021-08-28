<?php
    require_once('validate_session.php');
    
    $loggedUserInfo = $_SESSION["nviame"]["user_info"];
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <!--
        <link href="dist/images/logo.svg" rel="shortcut icon">
        -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Nviame">
        <meta name="keywords" content="Nviame">
        <meta name="author" content="carlos.schmidt@live.com.ar">
        <title>Nviame - Usuarios</title>
        <link rel="stylesheet" href="dist/css/app.css" />
        <link rel="icon" type="image/x-icon" href="../img/favicon.ico" />
        <link rel="shortcut icon" type="image/x-icon" href="../img/favicon.ico" />
        <style>
            .image-fit > img {
                object-fit: contain;
            }
            /*
            .select2-container.select2-container--default .select2-selection--multiple {
                min-height: 39px;
                height: auto;
            }

            .select2-container .select2-selection .select2-selection__rendered {
                display: block;
            }

            .select2-container.select2-container--default .select2-selection--multiple {
                padding-bottom: 8px;
            }

            .select2-container.select2-container--default .select2-selection--multiple .select2-selection__choice {
                margin-top: 8px;
            }

            .select2-container.select2-container--default .select2-selection--multiple .select2-selection__choice:first-child {
                margin-left: 0;
            }*/
        </style>
    </head>
    <body class="app">
        <?php require_once 'inc/mobile-menu.php'; ?>
        <div class="flex">
            <?php require_once 'inc/side-nav.php'; ?>
            <div class="content">
                <?php require_once 'inc/top-bar.php'; ?>
                <div class="grid grid-cols-12 gap-6">
                    <div class="col-span-12 xxl:col-span-9 grid grid-cols-12 gap-6">
                        <div class="col-span-12 mt-8">
                            <div class="intro-y flex items-center h-10">
                                <h2 class="text-lg font-medium truncate mr-5">
                                    <?php
                                        $mainTitle = "Todos los usuarios";
                                        switch($currentPHPScriptParam) {
                                            case "new":
                                                $mainTitle = "Usuarios registrados recientemente";
                                            break;
                                            case "verified":
                                                $mainTitle = "Usuarios verificados";
                                            break;
                                            case "disabled":
                                                $mainTitle = "Usuarios inhabilitados";
                                            break;
                                        }
                                        echo $mainTitle;
                                    ?>
                                </h2>
                                <a href="javascript: CRUD.loadUsers();" class="ml-auto flex text-theme-1"> <i data-feather="refresh-ccw" class="w-4 h-4 mr-3"></i> Refrescar datos </a>
                            </div>
                        </div>
                    </div>
                    <div class="intro-y col-span-12 flex flex-wrap sm:flex-no-wrap items-center mt-2">
                        <a data-toggle="modal" data-target="#md-user" class="button text-white bg-theme-1 shadow-md mr-2">Agregar usuario</a>
                        <div class="dropdown relative">
                            <button class="dropdown-toggle button px-2 box text-gray-700">
                                <span class="w-5 h-5 flex items-center justify-center"> <i class="w-4 h-4" data-feather="more-vertical"></i> </span>
                            </button>
                            <div class="dropdown-box mt-10 absolute top-0 left-0 z-20" style="width: 236px;">
                                <div class="dropdown-box__content box p-2">
                                    <a href="javascript:sendPush();" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white hover:bg-gray-200 rounded-md"> <i data-feather="message-square" class="w-4 h-4 mr-2"></i> Enviar notificación masiva </a>
                                    <hr>
                                    <a href="javascript:;" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white hover:bg-gray-200 rounded-md"> <i data-feather="printer" class="w-4 h-4 mr-2"></i> Imprimir </a>
                                    <a href="javascript:;" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white hover:bg-gray-200 rounded-md"> <i data-feather="file-text" class="w-4 h-4 mr-2"></i> Exportar a Excel </a>
                                    <a href="javascript:;" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white hover:bg-gray-200 rounded-md"> <i data-feather="file-text" class="w-4 h-4 mr-2"></i> Exportar a PDF </a>
                                </div>
                            </div>
                        </div>
                        <div class="hidden md:block mx-auto text-gray-600" id="table-users-header-info">Cargando usuarios...</div>
                    </div>
                    <!-- BEGIN: Data List -->
                    <div class="intro-y datatable-wrapper box p-5 col-span-12">
                        <div id="table-users-wrapper">
                            <table id="table-users" class="table table-report table-report--bordered display w-full -mt-2">
                                <thead>
                                    <tr>
                                        <th class="whitespace-no-wrap"></th>
                                        <th class="whitespace-no-wrap">USUARIO</th>
                                        <th class="text-center whitespace-no-wrap">ENVIOS</th>
                                        <th class="text-center whitespace-no-wrap">ENTREGAS</th>
                                        <th class="text-center whitespace-no-wrap">DEVOLUCIONES</th>
                                        <th class="text-center whitespace-no-wrap">ESTADO</th>
                                        <th class="text-center whitespace-no-wrap">ACCIONES</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                    <!-- END: Data List -->
                </div>
            </div>
        </div>

        <div class="modal flex items-center justify-center" id="slick-modal-preview">
            <div class="modal__content relative"></div>
        </div>

        <div class="modal" id="question-modal">
            <div class="modal__content">
                <div class="p-5 text-center"> <i data-feather="help-circle" class="w-16 h-16 text-theme-11 mx-auto mt-3"></i>
                    <div class="text-3xl mt-5" id="question-modal-title"></div>
                    <div class="text-gray-600 mt-2" id="question-modal-content"></div>
                </div>
                <div class="px-5 pb-8 text-center"> 
                    <button type="button" data-dismiss="modal" class="button w-24 bg-theme-1 text-white mr-3">Cancelar</button>
                    <button type="button" class="button w-24 bg-theme-6 text-white" id="question-modal-action">Ok</button>
                </div>
            </div>
        </div>

        <div class="modal" id="success-modal">
            <div class="modal__content">
                <div class="p-5 text-center"> <i data-feather="check-circle" class="w-16 h-16 text-theme-9 mx-auto mt-3"></i>
                    <div class="text-3xl mt-5" id="success-modal-title"></div>
                    <div class="text-gray-600 mt-2" id="success-modal-content"></div>
                </div>
                <div class="px-5 pb-8 text-center"> <button type="button" data-dismiss="modal" class="button w-24 bg-theme-1 text-white">Ok</button> </div>
            </div>
        </div>

        <div class="modal" id="error-modal">
            <div class="modal__content">
                <div class="p-5 text-center"> <i data-feather="x-circle" class="w-16 h-16 text-theme-6 mx-auto mt-3"></i>
                    <div class="text-3xl mt-5" id="error-modal-title"></div>
                    <div class="text-gray-600 mt-2" id="error-modal-content"></div>
                </div>
                <div class="px-5 pb-8 text-center"> <button type="button" data-dismiss="modal" class="button w-24 bg-theme-1 text-white">Ok</button> </div>
            </div>
        </div>

        <div class="modal" id="disable-user-confirmation-modal">
            <div class="modal__content">
                <div class="p-5 text-center"> <i data-feather="x-circle" class="w-16 h-16 text-theme-6 mx-auto mt-3"></i>
                    <div class="text-3xl mt-5">¿Está seguro?</div>
                    <div class="text-gray-600 mt-2" id="disable-user-confirmation-modal-text"></div>
                </div>
                <div class="px-5 pb-8 text-center"> 
                    <button type="button" data-dismiss="modal" class="button w-24 border text-gray-700 mr-1">Cancelar</button> 
                    <button type="button" id="confirm-disable-user-confirmation" class="button w-24 bg-theme-1 text-white">Confirmar</button> 
                </div>
            </div>
        </div>

        <div class="modal" id="md-push">
            <div class="modal__content">
                <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200">
                    <h2 class="font-medium text-base mr-auto">Enviar notificación push</h2>
                </div>
                <div id="md-push-content" class="p-5 grid grid-cols-12 gap-4 row-gap-3"></div>
                <div class="px-5 py-3 text-right border-t border-gray-200">
                    <button type="button" class="button w-20 border text-gray-700 mr-1" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="button w-20 bg-theme-1 text-white" id="send-push">Enviar</button>
                </div>
            </div>
        </div>

        <div class="modal" id="md-details-user">
            <div class="modal__content modal__content--xl">
                <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200">
                    <h2 class="font-medium text-base mr-auto" id="md-details-user-title"></h2>
                </div>
                <div id="md-details-user-content" class="p-5 grid"></div>
                <div class="px-5 py-3 text-right border-t border-gray-200">
                    <button type="button" class="button w-20 border text-gray-700 mr-1" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>

        <div class="modal" id="md-user">
            <form id="form-user" class="modal__content" style="width: 100%; max-width: 720px;">
                <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200">
                    <h2 class="font-medium text-base mr-auto">Agregar usuario</h2>
                </div>
                <div class="validate-form p-5 grid grid-cols-12 gap-4 row-gap-3">
                    <div class="col-span-12 sm:col-span-8"> 
                        <label>Nombre y Apellido</label> 
                        <input name="name" type="text" class="input w-full border mt-2 flex-1" placeholder="" required> 
                    </div>
                    <div class="col-span-12 sm:col-span-4"> 
                        <label>DNI</label> 
                        <input name="dni" type="text" class="input w-full border mt-2 flex-1" placeholder="" required> 
                    </div>
                    <div class="col-span-12 sm:col-span-4"> 
                        <label>Teléfono</label> 
                        <input name="phone" type="tel" class="input w-full border mt-2 flex-1" placeholder="" required> 
                    </div>
                    <div class="col-span-12 sm:col-span-4"> 
                        <label>Email</label> 
                        <input name="email" type="email" class="input w-full border mt-2 flex-1" placeholder="" required> 
                    </div>
                    <div class="col-span-12 sm:col-span-4"> 
                        <label>Contraseña</label> 
                        <input name="password" type="password" class="input w-full border mt-2 flex-1" placeholder="" required> 
                    </div>
                    <div class="col-span-12 sm:col-span-4"> 
                        <label>Empresa</label> 
                        <select name="company" class="input w-full border mt-2 flex-1">
                            <option value="0" selected>Sin empresa</option>
                            <option value="1">1</option>
                        </select> 
                    </div>
                    <div class="col-span-12 sm:col-span-4"> 
                        <label>% comisión</label> 
                        <input name="commission" type="number" class="input w-full border mt-2 flex-1" placeholder="" min="0" max="100" required>
                    </div>
                </div>
                <div class="px-5 py-3 text-right border-t border-gray-200">
                    <button type="button" class="button w-20 border text-gray-700 mr-1" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="button w-20 bg-theme-1 text-white">Guardar</button>
                </div>
            </form>
        </div>

        <script src="dist/js/api-a.js"></script>
        <script src="dist/js/app.js"></script>
        <script>
            function isv(i) {
                CRUD.toggleVerification(i);
            }
            function sendPush(i) {
                $('#md-push-content').html(`
                    <div class="col-span-12 sm:col-span-12">
                        <label class="mb-2" style="display: inline-flex;">Usuarios</label>
                        <select class="select2 w-full" multiple></select>
                    </div>
                    <div class="col-span-12 sm:col-span-12">
                        <label>Título</label>
                        <input id="push-title" type="text" class="input w-full border mt-2 flex-1" placeholder="">
                    </div>
                    <div class="col-span-12 sm:col-span-12">
                        <label>Contenido</label>
                        <textarea id="push-content" class="input w-full border mt-2 flex-1" rows="3"></textarea>
                    </div>
                `);
                var data = [{
                    id: "0",
                    text: "Todos"
                }];
                $('#table-users').DataTable().rows().every( function ( rowIdx, tableLoop, rowLoop ) {
                    var d = this.data();
                    var el = document.createElement('DIV');
                    el.innerHTML = d[0];
                    var i = $(el).find('.user-images').data('uid');
                    var u = $(el).find('.user-images').data('u');
                    data.push({
                        id: i,
                        text: u
                    });
                });
                $('#md-push-content .select2').select2({
                    //allowClear: true,
                    closeOnSelect: false,
                    placeholder: 'Selecciona los usuarios',
                    data: data
                }).on('select2:select', function(e) {
                    var el = this;
                    var data = e.params.data;
                    if(data.id > 0) {
                        var v = $('#md-push-content .select2').val().filter(r => r > 0);
                        $('#md-push-content .select2').val(v).trigger('change.select2');
                        if(v.length == 1) {
                            $(el).select2('close');
                        }
                    }
                    else {
                        $('#md-push-content .select2').val(["0"]).trigger('change.select2');
                        $(el).select2('close');
                    }
                });
                $('#md-push-content .select2').val([
                    typeof i != 'undefined' ? i : "0"
                ]).trigger('change.select2');
                $('#md-push').modal('show');
            }
            function loadCompanies(selectedValue) {
                $('#form-user [name="company"]').html('<option value="0" selected>Cargando listado de empresas...</option>');
                API.get('companies', {}, (json) => {
                    if(!json.error) {
                        console.log(json.data);
                        $('#form-user [name="company"]').html('<option value="0" selected>Ninguna</option>');
                        json.data.forEach(e => {
                            $('#form-user [name="company"]').append(`<option value="${e.id}" data-commission="${e.percent_commission}">${e.name}</option>`);
                        });
                        if(typeof selectedValue != 'undefined') {
                            $('#form-user [name="company"]').val(selectedValue);
                        }
                    }
                });
            }
            function disU(i, a) {
                $('#confirm-disable-user-confirmation').attr('data-target', i);
                $('#disable-user-confirmation-modal-text').html(a == 1 ? 'Se bloqueará por completo el acceso de este usuario.' : 'Se desbloqueará por completo el acceso de este usuario.');
                if(!$('#confirm-disable-user-confirmation').hasClass('with-event')) {
                    $('#confirm-disable-user-confirmation').addClass('with-event');
                    $('#confirm-disable-user-confirmation').click(function() {
                        $('#confirm-disable-user-confirmation').css({
                            opacity: 0.25,
                            pointerEvents: 'none'
                        });
                        API.post(`users/${$('#confirm-disable-user-confirmation').attr('data-target')}/toggle_disabled`, {}, (json) => {
                            $('#disable-user-confirmation-modal').modal('hide');
                            $('#confirm-disable-user-confirmation').css({
                                opacity: 1,
                                pointerEvents: 'auto'
                            });
                            CRUD.loadUsers();
                            $('#success-modal-title').html('Operación exitosa');
                            $('#success-modal-content').html('Se ha procesado la solicitud.');
                            $('#success-modal').modal('show');
                        });
                    });
                }
            }
            function delU(i) {

            }
            function editU(i) {
                $('#form-user .validate-form,#md-user [type="submit"]').css({
                    opacity: 0.25,
                    pointerEvents: 'none'
                });
                $('#md-user [type="submit"]').addClass('disabled');
                $('#form-user').attr('data-mode', 'edit');
                $('#form-user').attr('data-target', i);
                $('#form-user .text-base').html('Modificar usuario');
                $('#md-user').modal('show');

                API.get(`users/${i}`, {}, (json) => {
                    var u = json.data;
                    loadCompanies(u.id_company || "0");
                    $('#form-user [name="name"]').val(u.display_name);
                    $('#form-user [name="dni"]').val(u.dni || "");
                    $('#form-user [name="phone"]').val(u.phone || "");
                    $('#form-user [name="email"]').val(u.email);
                    $('#form-user [name="company"]').val(u.id_company || "0");
                    $('#form-user [name="commission"]').val(u.commission || "");
                    $('#form-user [name="password"]').removeAttr("required");
                    $('#form-user .validate-form,#md-user [type="submit"]').css({
                        opacity: 1,
                        pointerEvents: 'auto'
                    });
                });
            }
            $('#form-user [name="company"]').change(function() {
                var value = this.value;
                var el = $(this).find(`option[value="${value}"]`);
                $('#form-user [name="commission"]').val(el.data('commission') || "");
            });
            const CRUD = {
                toggleVerification: (i) => {
                    function f() {
                        API.post(`users/${i}/toggle_verification`, {}, (json) => {
                            CRUD.loadUsers();
                            $('#success-modal-title').html('Operación exitosa');
                            $('#success-modal-content').html('Se ha guardado el ajuste de verificación en el usuario.');
                            $('#success-modal').modal('show');
                        });
                    }
                    if($(`#table-users tr[data-uid="${i}"] .input--switch`).prop('checked')) {
                        f();
                    }
                    else {
                        $('#question-modal-action').attr('data-target', i);
                        $('#question-modal-title').html('Advertencia');
                        $('#question-modal-content').html(`¿Está seguro que desea quitar la verificación de este perfil?`);
                        $('#question-modal-action').off('click').on('click', function() {
                            $('#question-modal').modal('hide');
                            f();
                        });
                        $('#question-modal [data-dismiss="modal"]').off('click').on('click', function() {
                            $(`#table-users tr[data-uid="${i}"] .input--switch`).prop('checked', true);
                        });
                        $('#question-modal').modal('show');
                    }
                },
                detailsUser: (i) => {
                    $('#md-details-user-title').html('Cargando información del usuario...');
                    $('#md-details-user-content').html('');
                    API.get(`users/${i}`, {}, (json) => {
                        var u = json.data;
                        $('#md-details-user-title').html(u.fullname);
                        $('#md-details-user-content').html(`
                            <div class="intro-y box px-5 pt-5">
                                <div class="flex flex-col lg:flex-row border-b border-gray-200 pb-5 -mx-5">
                                    <div class="flex flex-1 px-5 items-center justify-center lg:justify-start">
                                        <div class="w-20 h-20 sm:w-24 sm:h-24 flex-none lg:w-32 lg:h-32 image-fit relative">
                                            <img alt="" class="rounded-full shadow-lg border-gray-300 border" src="${API.getUserPicture(u.avatar)}" style="background-color: black;">
                                        </div>
                                        <div class="ml-5">
                                            <div class="w-24 sm:w-40 truncate sm:whitespace-normal font-medium text-lg">${u.fullname}</div>
                                            <div class="text-gray-600 flex items-center">
                                                <i data-feather="star" class="w-4 h-4 mr-2"></i> ${u.overall_rating}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex mt-6 lg:mt-0 items-center lg:items-start flex-1 flex-col justify-center text-gray-600 px-5 border-l border-r border-gray-200 border-t lg:border-t-0 pt-5 lg:pt-0">
                                        <div class="truncate sm:whitespace-normal flex items-center"> <i data-feather="mail" class="w-4 h-4 mr-2"></i> ${u.email} </div>
                                        <div class="truncate sm:whitespace-normal flex items-center mt-3"> <i data-feather="phone" class="w-4 h-4 mr-2"></i> ${u.phone || "-"} </div>
                                        <div class="truncate sm:whitespace-normal flex items-center mt-3"> <i data-feather="map-pin" class="w-4 h-4 mr-2"></i> ${u.home_address || "-"} </div>
                                    </div>
                                </div>
                                <div class="nav-tabs flex flex-col sm:flex-row justify-center lg:justify-start">
                                    <a data-toggle="tab" data-target="#profile" href="javascript:;" class="py-4 sm:mr-8 flex items-center active"> <i class="w-4 h-4 mr-2" data-feather="user"></i> Perfil </a>
                                    <a data-toggle="tab" data-target="#conveyances" href="javascript:;" class="py-4 sm:mr-8 flex items-center"> <i class="w-4 h-4 mr-2" data-feather="navigation"></i> Vehículos </a>
                                    <!--
                                    <a data-toggle="tab" data-target="#shipments" href="javascript:;" class="py-4 sm:mr-8 flex items-center"> <i class="w-4 h-4 mr-2" data-feather="package"></i> Envíos </a>
                                    <a data-toggle="tab" data-target="#returns" href="javascript:;" class="py-4 sm:mr-8 flex items-center"> <i class="w-4 h-4 mr-2" data-feather="truck"></i> Entregas </a>
                                    -->
                                </div>
                                <div class="intro-y tab-content mt-5">
                                    <div class="tab-content__pane active" id="profile">
                                        <div>
                                            <div class="flex flex-col sm:flex-row items-center justify-between">
                                                <div style="width: 20%;">
                                                    <a href="" class="font-medium">Nombre y Apellido</a>
                                                    <div class="text-gray-600 mt-1">${u.fullname}</div>
                                                </div>
                                                <div style="width: 20%;">
                                                    <a href="" class="font-medium">DNI</a>
                                                    <div class="text-gray-600 mt-1">${u.dni}</div>
                                                </div>
                                                <div style="width: 25%;">
                                                    <a href="" class="font-medium">Correo electrónico</a>
                                                    <div class="text-gray-600 mt-1">${u.email}</div>
                                                </div>
                                                <div style="width: 25%;">
                                                    <a href="" class="font-medium">Teléfono Móvil</a>
                                                    <div class="text-gray-600 mt-1">${u.phone || "-"}</div>
                                                </div>
                                            </div>
                                            <div class="flex flex-col sm:flex-row items-center justify-between mt-5">
                                                <div style="width: 20%;">
                                                    <a href="" class="font-medium">País</a>
                                                    <div class="text-gray-600 mt-1">${u.country || "-"}</div>
                                                </div>
                                                <div style="width: 20%;">
                                                    <a href="" class="font-medium">Provincia</a>
                                                    <div class="text-gray-600 mt-1">${u.providence || "-"}</div>
                                                </div>
                                                <div style="width: 25%;">
                                                    <a href="" class="font-medium">Ciudad</a>
                                                    <div class="text-gray-600 mt-1">${u.locality || "-"}</div>
                                                </div>
                                                <div style="width: 25%;">
                                                    <a href="" class="font-medium">Domicilio</a>
                                                    <div class="text-gray-600 mt-1">${u.home_address || "-"}</div>
                                                </div>
                                            </div>
                                            <div class="flex flex-col sm:flex-row items-center justify-between mt-5">
                                                <div style="width: 20%;">
                                                    <a href="" class="font-medium">Empresa</a>
                                                    <div class="text-gray-600 mt-1">${u.company ? u.company.name : '-'}</div>
                                                </div>
                                                <div style="width: 20%;">
                                                    <a href="" class="font-medium">Email</a>
                                                    <div class="text-gray-600 mt-1">${u.company ? u.company.email : '-'}</div>
                                                </div>
                                                <div style="width: 25%;">
                                                    <a href="" class="font-medium">Teléfono</a>
                                                    <div class="text-gray-600 mt-1">${u.company ? u.company.phone : '-'}</div>
                                                </div>
                                                <div style="width: 25%;">
                                                    <a href="" class="font-medium">Tarifas</a>
                                                    <div class="text-gray-600 mt-1">${u.company ? `TM $${u.company.rate_price_km} — N ${u.company.rate_percent_night_schedule}% — DNH ${u.company.rate_percent_non_business_day}%` : '-'}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-content__pane" id="conveyances">
                                        <table class="table" style="margin-top: -12px; margin-left: -20px;">
                                            <thead>
                                                <tr>
                                                    <th class="border-b-2 whitespace-no-wrap" style="padding-left: 120px;">DOMINIO</th>
                                                    <th class="border-b-2 text-right whitespace-no-wrap">MARCA</th>
                                                    <th class="border-b-2 text-right whitespace-no-wrap">MODELO</th>
                                                    <th class="border-b-2 text-right whitespace-no-wrap">AÑO</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                ${u.conveyances.length > 0 ? u.conveyances.map(c => `
                                                    <tr>
                                                        <td class="border-b flex">
                                                            <div class="intro-x flex mr-3">
                                                                <div class="intro-x w-8 h-8 sm:w-10 sm:h-10 image-fit">
                                                                    <img alt="Póliza de Seguro" class="rounded-full border border-white zoom-in tooltip tooltipstered" src="${c.insurance_policy ? API.getConveyancePicture(c.insurance_policy) : ''}" style="object-fit: cover;">
                                                                </div>
                                                                <div class="intro-x w-8 h-8 sm:w-10 sm:h-10 image-fit -ml-4">
                                                                    <img alt="Cédula de Identificación" class="rounded-full border border-white zoom-in tooltip tooltipstered" src="${c.identification_card ? API.getConveyancePicture(c.identification_card) : ''}" style="object-fit: cover;">
                                                                </div>
                                                                <div class="intro-x w-8 h-8 sm:w-10 sm:h-10 image-fit -ml-4">
                                                                    <img alt="Foto Principal" class="rounded-full border border-white zoom-in tooltip tooltipstered" src="${c.main_photo ? API.getConveyancePicture(c.main_photo) : ''}" style="object-fit: cover;">
                                                                </div>
                                                            </div>
                                                            <div>
                                                                <div class="font-medium whitespace-no-wrap">${c.domain} ${c.model}</div>
                                                                <div class="text-gray-600 text-xs whitespace-no-wrap">${c.type_desc}</div>
                                                            </div>
                                                        </td>
                                                        <td class="text-right border-b w-32">${c.brand}</td>
                                                        <td class="text-right border-b w-32">${c.model}</td>
                                                        <td class="text-right border-b w-32">${c.year}</td>
                                                    </tr>
                                                `).join('') : `
                                                    <tr>
                                                        <td class="border-b text-center" colspan="4">No hay registros</td>
                                                    </tr>
                                                `}
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="tab-content__pane" id="shipments">
                                        <table class="table" style="margin-top: -12px; margin-left: -20px;">
                                            <thead>
                                                <tr>
                                                    <th class="border-b-2 whitespace-no-wrap" style="padding-left: 120px;">DOMINIO</th>
                                                    <th class="border-b-2 text-right whitespace-no-wrap">MARCA</th>
                                                    <th class="border-b-2 text-right whitespace-no-wrap">MODELO</th>
                                                    <th class="border-b-2 text-right whitespace-no-wrap">AÑO</th>
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        `);
                        feather.replace();
                    });
                    $('#md-details-user').modal('show');
                },
                loadUsers: () => {
                    $('#table-users-header-info').html('Cargando usuarios...');
                    API.get('users', {
                        filter: '<?php echo $currentPHPScriptParam ? $currentPHPScriptParam : 'all' ?>',
                        type: 'user'
                    }, (json) => {
                        if(!json.error) {
                            $('#table-users_filter input[type="search"]').val("");
                            $('#table-users-wrapper').html(`
                                <table id="table-users" class="table table-report table-report--bordered display w-full -mt-2">
                                    <thead>
                                        <tr>
                                            <th class="whitespace-no-wrap"></th>
                                            <th class="whitespace-no-wrap">USUARIO</th>
                                            <th class="text-center whitespace-no-wrap">ENVIOS</th>
                                            <th class="text-center whitespace-no-wrap">ENTREGAS</th>
                                            <th class="text-center whitespace-no-wrap">DEVOLUCIONES</th>
                                            <th class="text-center whitespace-no-wrap">ESTADO</th>
                                            <th class="text-center whitespace-no-wrap">ACCIONES</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            `);
                            
                            json.data.forEach((info) => {
                                const dir = [info.locality, info.region, info.country || "-"].filter(r => r != null).join(' / ');
                                $('#table-users tbody').append(`
                                    <tr class="intro-x" data-uid="${info.id}">
                                        <td class="w-20">
                                            <div class="flex user-images" data-uid="${info.id}" data-u="${info.display_name}">
                                                <div class="w-10 h-10 image-fit zoom-in" style="min-width: 40px;">
                                                    ${info.dni_back ? `
                                                        <img alt="DNI Reverso" class="tooltip rounded-full" src="${API.getUserPicture(info.dni_back)}" title="DNI Reverso">    
                                                    ` : ''}
                                                </div>
                                                <div class="w-10 h-10 image-fit zoom-in -ml-5" style="min-width: 40px;">
                                                    ${info.dni_back ? `
                                                        <img alt="DNI Frontal" class="tooltip rounded-full" src="${API.getUserPicture(info.dni_front)}" title="DNI Frontal">    
                                                    ` : ''}
                                                </div>
                                                <div class="w-10 h-10 image-fit zoom-in -ml-5">
                                                    <img alt="Foto" class="tooltip rounded-full" src="${API.getUserPicture(info.avatar)}" 
                                                    title="Foto de perfil">
                                                </div>
                                            </div>
                                        </td>
                                        <td style="padding-left: 8px;padding-right: 0;">
                                            <a href="javascript: CRUD.detailsUser(${info.id});" title="Ver información completa de ${info.display_name}" class="font-medium whitespace-no-wrap">${info.display_name}</a> 
                                            <div class="text-gray-600 text-xs tooltip" title="${dir}" style=" max-width: 120px; margin: 0; text-overflow: ellipsis; overflow: hidden; white-space: nowrap; ">${dir}</div>
                                        </td>
                                        <td class="text-center">${info.summary.shipments}</td>
                                        <td class="text-center">${info.summary.deliveries}</td>
                                        <td class="text-center">${info.summary.returns}</td>
                                        <td>
                                            <div class="flex items-center justify-center"> 
                                                ${info.verified == 1 ? 
                                                    `<div class="text-green-600" style=" width: 164px; display: flex; align-items: center; justify-content: center; ">
                                                        <i data-feather="user-check" class="w-4 h-4 mr-2"></i> <div style="width: 96px;">Verificado</div>
                                                        <input type="checkbox" class="input input--switch input--switch--verification border" checked onchange="javascript: isv(${info.id});">
                                                    </div>` : 
                                                    `<div class="text-red-600" style=" width: 164px; display: flex; align-items: center; justify-content: center; ">
                                                        <i data-feather="user-x" class="w-4 h-4 mr-2"></i> <div style="width: 96px;">No verificado</div>
                                                        <input type="checkbox" class="input input--switch input--switch--verification border" onchange="javascript: isv(${info.id});">
                                                    </div>`
                                                }
                                            </div>
                                        </td>
                                        <td class="table-report__action w-36">
                                            <div class="flex justify-center items-center">
                                                ${info.count_push_devices > 0 ? `
                                                    <a class="tooltip flex items-center mr-3" href="javascript:sendPush(${info.id});" title="Enviar notificación push"> 
                                                        <i data-feather="message-square" class="w-4 h-4 mr-1"></i>
                                                    </a>
                                                ` : `
                                                    <a class="tooltip flex items-center mr-3" href="javascript:;" title="No se ha registrado ningún dispositivo para notificar."> 
                                                        <i data-feather="message-square" class="w-4 h-4 mr-1" style="opacity: 0.25;"></i>
                                                    </a>
                                                `}
                                                <a class="tooltip flex items-center mr-3" href="javascript:editU(${info.id});" title="Modificar datos"> 
                                                    <i data-feather="edit" class="w-4 h-4 mr-1"></i>
                                                </a>
                                                <a class="tooltip flex items-center text-theme-<?php echo $currentPHPScriptParam == "disabled" ? "1" : "6"; ?>" href="javascript:disU(${info.id}, <?php echo $currentPHPScriptParam == "disabled" ? 0 : 1; ?>);" data-toggle="modal" data-target="#disable-user-confirmation-modal" title="<?php echo $currentPHPScriptParam == "disabled" ? "Habilitar" : "Deshabilitar"; ?> usuario"> 
                                                    <i data-feather="<?php echo $currentPHPScriptParam == "disabled" ? "check-circle" : "slash"; ?>" class="w-4 h-4 mr-1"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                `);

                                $(`#table-users tbody tr[data-uid="${info.id}"] .user-images`).click(function() {
                                    $('#slick-modal-preview .modal__content').html(`
                                        <a data-dismiss="modal" href="javascript:;" class="absolute right-0 top-0 mt-3 mr-3">
                                            <i data-feather="x" class="w-5 h-5 text-gray-500"></i>
                                        </a>
                                        <div class="p-5">
                                            <div class="slider mx-6 center-mode">
                                                <div class="h-64 px-2">
                                                    <div class="font-semibold text-center mb-4">DNI Reverso</div>
                                                    <div class="h-full image-fit rounded-md overflow-hidden">
                                                        <img alt="DNI Reverso" src="${API.getUserPicture(info.dni_back || "no-image.png")}" />
                                                    </div>
                                                </div>
                                                <div class="h-64 px-2">
                                                    <div class="font-semibold text-center mb-4">DNI FRONTAL</div>
                                                    <div class="h-full image-fit rounded-md overflow-hidden">
                                                        <img alt="DNI Reverso" src="${API.getUserPicture(info.dni_front || "no-image.png")}" />
                                                    </div>
                                                </div>
                                                <div class="h-64 px-2">
                                                    <div class="font-semibold text-center mb-4">Foto de perfil</div>
                                                    <div class="h-full image-fit rounded-md overflow-hidden">
                                                        <img alt="Foto" src="${API.getUserPicture(info.avatar || "no-image.png")}" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    `);
                                    feather.replace();
                                    $('#slick-modal-preview .modal__content .slider').slick({
                                        infinite: false,
                                        initialSlide: 2
                                    });
                                    $('#slick-modal-preview').modal('show');
                                });
                            });
                            feather.replace();
                            $('#table-users-header-info').html(json.data.length > 10 ? `${json.data.length} usuarios en total.` : `${json.data.length} usuarios en total.`);
                            
                            $('#table-users').addClass('datatable').DataTable();
                        }
                    });
                }
            };

            $('#send-push').click(() => {
                const el = this;
                var u = $('#md-push-content .select2').val();
                var error = null;
                if(u.length > 0) {
                    var t = $('#push-title').val();
                    var c = $('#push-content').val();
                    if(t && c) {
                        $(el).css({
                            pointerEvents: 'none'
                        }).animate({
                            opacity: 0.7
                        }, 400);
                        var params = {
                            u: u,
                            t: t,
                            c: c
                        };
                        <?php if(isset($_REQUEST["debug"])): ?>
                            params.debug = 1;
                        <?php endif ?>
                        API.post(`users/push_notification`, params, (json) => {
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

            CRUD.loadUsers();

            

            $(document).on('click', '[data-toggle="modal"]', (el) => {
                $('' + el.target.dataset.target).find('[name]').val("");
                if(el.target.dataset.target == '#md-user') {
                    $('#form-user .validate-form,#md-user [type="submit"]').css({
                        opacity: 1,
                        pointerEvents: 'auto'
                    });
                    $('#form-user [name]').val("");
                    $('#form-user [name="password"]').attr("required", "required");
                    $('#form-user').attr('data-mode', 'add');
                    $('#form-user .text-base').html('Agregar usuario');

                    loadCompanies();
                }
            });

            $("#form-user").on('submit', (ev) => {
                var fd = new FormData(document.getElementById("form-user"));
                var mode = $('#form-user').attr('data-mode');
                if(mode == 'edit') {
                    fd.append('i', $('#form-user').attr('data-target'));
                }
                $('#form-user [type="submit"]').css({
                    pointerEvents: 'none'
                }).animate({
                    opacity: 0.7
                }, 400);
                $.ajax({
                    url: `${API_Config.host}/${API_Config.path}/a/users/${mode}`,
                    type: 'POST',
                    data: fd,
                    processData: false,
                    contentType: false
                }).done(data => {
                    if(typeof data === 'object') {
                        if(data.status == "OK") {
                            $('.modal').modal('hide');
                            CRUD.loadUsers();
                            setTimeout(() => {
                                $('#success-modal-title').html('Operación exitosa');
                                $('#success-modal-content').html(`Se ha ${mode == 'add' ? 'guardado' : 'actualizado'} el usuario.`);
                                $('#success-modal').modal('show');
                                $('#form-user [type="submit"]').css({
                                    pointerEvents: 'auto'
                                }).animate({
                                    opacity: 1
                                }, 400);
                            }, 500);
                        }
                    }
                    else {

                    }
                });
                ev.preventDefault();
                return false;
            });
        </script>
        <?php require_once('inc/footer.php'); ?>
    </body>
</html>