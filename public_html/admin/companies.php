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
        <title>Nviame - Empresas</title>
        <link rel="stylesheet" href="dist/css/app.css" />
        <link rel="icon" type="image/x-icon" href="../img/favicon.ico" />
        <link rel="shortcut icon" type="image/x-icon" href="../img/favicon.ico" />
        <style>
            .image-fit > img {
                object-fit: contain;
            }
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
                                    Todas las empresas
                                </h2>
                                <a href="javascript: CRUD.loadCompanies();" class="ml-auto flex text-theme-1"> <i data-feather="refresh-ccw" class="w-4 h-4 mr-3"></i> Refrescar datos </a>
                            </div>
                        </div>
                    </div>
                    <div class="intro-y col-span-12 flex flex-wrap sm:flex-no-wrap items-center mt-2">
                        <a href="javascript: void(0);" data-toggle="modal" data-target="#md-company" class="button text-white bg-theme-1 shadow-md mr-2">Agregar empresa</a>
                        <div class="dropdown relative">
                            <button class="dropdown-toggle button px-2 box text-gray-700">
                                <span class="w-5 h-5 flex items-center justify-center"> <i class="w-4 h-4" data-feather="more-vertical"></i> </span>
                            </button>
                            <div class="dropdown-box mt-10 absolute w-40 top-0 left-0 z-20">
                                <div class="dropdown-box__content box p-2">
                                    <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white hover:bg-gray-200 rounded-md"> <i data-feather="printer" class="w-4 h-4 mr-2"></i> Imprimir </a>
                                    <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white hover:bg-gray-200 rounded-md"> <i data-feather="file-text" class="w-4 h-4 mr-2"></i> Exportar a Excel </a>
                                    <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white hover:bg-gray-200 rounded-md"> <i data-feather="file-text" class="w-4 h-4 mr-2"></i> Exportar a PDF </a>
                                </div>
                            </div>
                        </div>
                        <div class="hidden md:block mx-auto text-gray-600" id="table-companies-header-info">Cargando empresas...</div>
                    </div>
                    <!-- BEGIN: Data List -->
                    <div class="intro-y datatable-wrapper box p-5 col-span-12">
                        <table id="table-companies" class="table table-report table-report--bordered display w-full -mt-2">
                            <thead>
                                <tr>
                                    <th class="whitespace-no-wrap">NOMBRE</th>
                                    <th class="whitespace-no-wrap">CUIT</th>
                                    <th class="whitespace-no-wrap">TEL.</th>
                                    <th class="whitespace-no-wrap">EMAIL</th>
                                    <th class="text-center whitespace-no-wrap">ACCIONES</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                    <!-- END: Data List -->
                </div>
            </div>
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

        <div class="modal" id="md-company">
            <form id="form-company" class="modal__content" style="width: 100%; max-width: 720px;">
                <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200">
                    <h2 class="font-medium text-base mr-auto">Agregar empresa</h2>
                </div>
                <div method="post" action="" class="validate-form p-5 grid grid-cols-12 gap-4 row-gap-3">
                    <div class="col-span-12 sm:col-span-8"> 
                        <label>Nombre o razón social</label> 
                        <input name="name" type="text" class="input w-full border mt-2 flex-1" placeholder="" required> 
                    </div>
                    <div class="col-span-12 sm:col-span-4"> 
                        <label>Duración del contrato</label> 
                        <select name="contract" class="input w-full border mt-2 flex-1">
                            <option value="1" selected>Sin contrato</option>
                            <option value="2">3 meses</option>
                            <option value="3">6 meses</option>
                            <option value="4">12 meses</option>
                        </select> 
                    </div>
                    <div class="col-span-12 sm:col-span-4"> 
                        <label>CUIT</label> 
                        <input name="cuit" type="text" class="input w-full border mt-2 flex-1" placeholder="" required> 
                    </div>
                    <div class="col-span-12 sm:col-span-4"> 
                        <label>Teléfono</label> 
                        <input name="phone" type="tel" class="input w-full border mt-2 flex-1" placeholder="" required> 
                    </div>
                    <div class="col-span-12 sm:col-span-4"> 
                        <label>Email</label> 
                        <input name="email" type="email" class="input w-full border mt-2 flex-1" placeholder="" required> 
                    </div>
                    <div class="col-span-12 sm:col-span-3"> 
                        <label>Precio base</label> 
                        <input name="pb" type="number" class="input w-full border mt-2 flex-1" placeholder="" min="0"> 
                    </div>
                    <div class="col-span-12 sm:col-span-3"> 
                        <label>Precio por KM</label> 
                        <input name="ppkm" type="number" class="input w-full border mt-2 flex-1" placeholder="" min="0"> 
                    </div>
                    <div class="col-span-12 sm:col-span-3"> 
                        <label>% horario nocturno</label> 
                        <input name="pns" type="number" class="input w-full border mt-2 flex-1" placeholder="" min="0" max="100"> 
                    </div>
                    <div class="col-span-12 sm:col-span-3"> 
                        <label>% horario no laborable</label> 
                        <input name="pnbd" type="number" class="input w-full border mt-2 flex-1" placeholder="" min="0" max="100"> 
                    </div>
                    <div class="col-span-12 sm:col-span-3 border-t mt-2 pt-3">
                        <label>% comisión</label> 
                        <input name="pcom" type="number" class="input w-full border mt-2 flex-1" placeholder="" min="0" max="100"> 
                    </div>
                </div>
                <div class="px-5 py-3 text-right border-t border-gray-200">
                    <button type="button" class="button w-20 border text-gray-700 mr-1" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="button w-20 bg-theme-1 text-white">Guardar</button>
                </div>
            </form>
        </div>
        
        <div class="modal" id="md-company-details">
            <div class="modal__content" style="width: 100%; max-width: 800px; margin-top: 16px;">
                <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200">
                    <h2 class="font-medium text-base mr-auto">Datos de la empresa</h2>
                </div>
                <div id="company-details" class="p-5">
                    
                </div>
                <div class="px-5 py-3 text-right border-t border-gray-200">
                    <button type="button" class="button w-20 border text-gray-700" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>

        <script src="dist/js/api-a.js"></script>
        <script src="dist/js/app.js"></script>
        <script>
            const CRUD = {
                _data: null,
                detailsCompany: (i) => {
                    const info = CRUD._data.filter(r => r.id == i).pop();
                    $('#company-details').html(`
                        <div class="flex flex-col sm:flex-row items-center">
                            <div style="width: 50%;">
                                <a href="" class="font-medium">Nombre o razón social</a> 
                                <div class="text-gray-600 mt-1">${info.name}</div>
                            </div>
                            <div style="width: 25%;">
                                <a href="" class="font-medium">CUIT</a> 
                                <div class="text-gray-600 mt-1">${info.cuit}</div>
                            </div>
                            <div style="width:25%;">
                                <a href="" class="font-medium">Fecha de registro</a> 
                                <div class="text-gray-600 mt-1">${info.registered_at}</div>
                            </div>
                        </div>
                        <div class="flex flex-col sm:flex-row items-center mt-5">
                            <div style="width: 25%;">
                                <a href="" class="font-medium">Teléfono</a> 
                                <div class="text-gray-600 mt-1">${info.phone}</div>
                            </div>
                            <div style="width: 25%;">
                                <a href="" class="font-medium">Email</a> 
                                <div class="text-gray-600 mt-1">${info.email}</div>
                            </div>
                            <div style="width: 25%;">
                                <a href="" class="font-medium">Duración del contrato</a> 
                                <div class="text-gray-600 mt-1">${info.contract}</div>
                            </div>
                            <div style="width: 25%;">
                                <a href="" class="font-medium">% de comisión</a> 
                                <div class="text-gray-600 mt-1">${info.percent_commission}%</div>
                            </div>
                        </div>
                        <div class="flex flex-col sm:flex-row items-center border-t border-gray-200 mt-5 pt-5">
                            <div style="width: 25%;">
                                <a href="" class="font-medium">Precio base</a> 
                                <div class="text-gray-600 mt-1">$${info.rate_base_price}</div>
                            </div>
                            <div style="width: 25%;">
                                <a href="" class="font-medium">Precio por KM</a> 
                                <div class="text-gray-600 mt-1">$${info.rate_price_km}</div>
                            </div>
                            <div style="width: 25%;">
                                <a href="" class="font-medium">% horario nocturno</a> 
                                <div class="text-gray-600 mt-1">${info.rate_percent_night_schedule}%</div>
                            </div>
                            <div style="width: 25%;">
                                <a href="" class="font-medium">% horario no laborable</a> 
                                <div class="text-gray-600 mt-1">${info.rate_percent_non_business_day}%</div>
                            </div>
                        </div>
                        <div class="datatable-wrapper border-t border-gray-200 mt-5 pt-5">
                            <table id="table-users" class="table table-report table-report--bordered display w-full -mt-2">
                                <thead>
                                    <tr>
                                        <th class="whitespace-no-wrap">USUARIO</th>
                                        <th class="text-center whitespace-no-wrap">ENVIOS</th>
                                        <th class="text-center whitespace-no-wrap">ENTREGAS</th>
                                        <th class="text-center whitespace-no-wrap">DEVOLUCIONES</th>
                                        <th class="text-center whitespace-no-wrap">ESTADO</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    `);
                    API.get('users', {
                        company: info.id
                    }, (json) => {
                        if(!json.error) {
                            json.data.forEach((info) => {
                                const dir = [info.locality, info.region, info.country || "-"].filter(r => r != null).join(' / ');
                                $('#table-users tbody').append(`
                                    <tr class="intro-x" data-uid="${info.id}">
                                        <td>
                                            <a href="" class="font-medium whitespace-no-wrap">${info.display_name}</a> 
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
                                                    </div>` : 
                                                    `<div class="text-red-600" style=" width: 164px; display: flex; align-items: center; justify-content: center; ">
                                                        <i data-feather="user-x" class="w-4 h-4 mr-2"></i> <div style="width: 96px;">No verificado</div>
                                                    </div>`
                                                }
                                            </div>
                                        </td>
                                    </tr>
                                `);
                            });
                            feather.replace();
                            $('#table-users').addClass('datatable').DataTable();
                        }
                    });
                    $('#md-company-details').modal('show');
                },
                editCompany: (i) => {
                    const info = CRUD._data.filter(r => r.id == i).pop();
                    $('#form-company [name="name"]').val(info.name);
                    $('#form-company [name="cuit"]').val(info.cuit);
                    $('#form-company [name="phone"]').val(info.phone);
                    $('#form-company [name="email"]').val(info.email);
                    $('#form-company [name="contract"]').val(info.contract_id);
                    $('#form-company [name="pb"]').val(info.rate_base_price || "");
                    $('#form-company [name="ppkm"]').val(info.rate_price_km || "");
                    $('#form-company [name="pns"]').val(info.rate_percent_night_schedule || "");
                    $('#form-company [name="pnbd"]').val(info.rate_percent_non_business_day || "");
                    $('#form-company [name="pcom"]').val(info.percent_commission || "");
                    $('#form-company').attr('data-mode', 'edit');
                    $('#form-company').attr('data-target', i);
                    $('#form-company .text-base').html('Modificar empresa');
                    $('#md-company').modal('show');
                },
                removeCompany: (i) => {
                    const info = CRUD._data.filter(r => r.id == i).pop();
                    $('#question-modal-action').attr('data-target', i);
                    $('#question-modal-title').html('Advertencia');
                    $('#question-modal-content').html(`¿Está seguro que desea eliminar la empresa <strong>${info.name}</strong>?`);
                    $('#question-modal').modal('show');
                },
                loadCompanies: () => {
                    if($('#table-companies').hasClass('datatable')) {
                        $('#table-companies').DataTable().search('').draw();
                    }
                    $('#table-companies-header-info').html('Cargando empresas...');
                    API.get('companies', {}, (json) => {
                        if(!json.error) {
                            $('#table-companies tbody').html('');
                            CRUD._data = json.data;
                            json.data.forEach((info) => {
                                $('#table-companies tbody').append(`
                                    <tr class="intro-x" data-uid="${info.id}">
                                        <td class="text-left">${info.name}</td>
                                        <td class="text-left">${info.cuit}</td>
                                        <td class="text-left">${info.phone}</td>
                                        <td class="text-left">${info.email}</td>
                                        <td class="table-report__action w-36">
                                            <div class="flex justify-center items-center">
                                                <a class="tooltip flex items-center mr-3" href="javascript: CRUD.detailsCompany(${info.id});" title="Ver detalle"> 
                                                    <i data-feather="eye" class="w-4 h-4 mr-1"></i>
                                                </a>
                                                <a class="tooltip flex items-center mr-3" href="javascript: CRUD.editCompany(${info.id});" title="Modificar datos"> 
                                                    <i data-feather="edit" class="w-4 h-4 mr-1"></i>
                                                </a>
                                                <a class="tooltip flex items-center text-theme-6" href="javascript: CRUD.removeCompany(${info.id});" data-toggle="modal" data-target="#delete-confirmation-modal" title="Eliminar empresa"> 
                                                    <i data-feather="trash-2" class="w-4 h-4 mr-1"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                `);
                            });
                            feather.replace();
                            $('#table-companies-header-info').html(json.data.length > 10 ? `Mostrando 1 de 10, ${json.data.length} empresa${json.data.length > 1 ? 's' : ''} en total.` : `${json.data.length} empresa${json.data.length > 1 ? 's' : ''} en total.`);

                            $('#table-companies').addClass('datatable').DataTable();
                        }
                    });
                }
            };
            CRUD.loadCompanies();

            $(() => {
                $(document).on('click', '[data-toggle="modal"]', (el) => {
                    $('' + el.target.dataset.target).find('[name]').val("");
                    if(el.target.dataset.target == '#md-company') {
                        $('#form-company').attr('data-mode', 'add');
                        $('#form-company .text-base').html('Agregar empresa');
                    }
                });

                $('#question-modal-action').click(() => {
                    const el = document.getElementById('question-modal-action');
                    const i = el.dataset.target;
                    $(el).css({
                        pointerEvents: 'none'
                    }).animate({
                        opacity: 0.7
                    }, 400);
                    $.ajax({
                        url: `${API_Config.host}/${API_Config.path}/a/companies/remove`,
                        type: 'POST',
                        data: {
                            i: i
                        }
                    }).done(data => {
                        if(typeof data === 'object') {
                            if(data.status == "OK") {
                                $('.modal').modal('hide');
                                CRUD.loadCompanies();
                                setTimeout(() => {
                                    $('#success-modal-title').html('Operación exitosa');
                                    $('#success-modal-content').html('Se ha eliminado la empresa.');
                                    $('#success-modal').modal('show');
                                    $(el).css({
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
                });

                $("#form-company").on('submit', (ev) => {
                    var fd = new FormData(document.getElementById("form-company"));
                    var mode = $('#form-company').attr('data-mode');
                    if(mode == 'edit') {
                        fd.append('i', $('#form-company').attr('data-target'));
                    }
                    $('#form-company [type="submit"]').css({
                        pointerEvents: 'none'
                    }).animate({
                        opacity: 0.7
                    }, 400);
                    $.ajax({
                        url: `${API_Config.host}/${API_Config.path}/a/companies/${mode}`,
                        type: 'POST',
                        data: fd,
                        processData: false,
                        contentType: false
                    }).done(data => {
                        if(typeof data === 'object') {
                            if(data.status == "OK") {
                                $('.modal').modal('hide');
                                CRUD.loadCompanies();
                                setTimeout(() => {
                                    $('#success-modal-title').html('Operación exitosa');
                                    $('#success-modal-content').html(`Se ha ${mode == 'add' ? 'guardado' : 'actualizado'} la empresa.`);
                                    $('#success-modal').modal('show');
                                    $('#form-company [type="submit"]').css({
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
            });
        </script>
        <?php require_once('inc/footer.php'); ?>
    </body>
</html>