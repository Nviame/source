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
        <title>Nviame - Envíos</title>
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
                                        $mainTitle = "Todos los envíos";
                                        switch($currentPHPScriptParam) {
                                            case "delivered":
                                                $mainTitle = "Entregados";
                                            break;
                                            case "refunded":
                                                $mainTitle = "Devueltos";
                                            break;
                                            case "on-travel":
                                                $mainTitle = "En viaje";
                                            break;
                                        }
                                        echo $mainTitle;
                                    ?>
                                </h2>
                                <a href="javascript: CRUD.loadShipments();" class="ml-auto flex text-theme-1"> <i data-feather="refresh-ccw" class="w-4 h-4 mr-3"></i> Refrescar datos </a>
                            </div>
                        </div>
                    </div>
                    <div class="intro-y col-span-12 flex flex-wrap sm:flex-no-wrap items-center mt-2">
                        <div class="dropdown relative">
                            <button class="dropdown-toggle button px-2 box text-gray-700">
                                <span class="w-5 h-5 flex items-center justify-center"> <i class="w-4 h-4" data-feather="more-vertical"></i> </span>
                            </button>
                            <div class="dropdown-box mt-10 absolute top-0 left-0 z-20" style="width: 236px;">
                                <div class="dropdown-box__content box p-2">
                                    <a href="javascript:;" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white hover:bg-gray-200 rounded-md"> <i data-feather="printer" class="w-4 h-4 mr-2"></i> Imprimir </a>
                                    <a href="javascript:;" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white hover:bg-gray-200 rounded-md"> <i data-feather="file-text" class="w-4 h-4 mr-2"></i> Exportar a Excel </a>
                                    <a href="javascript:;" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white hover:bg-gray-200 rounded-md"> <i data-feather="file-text" class="w-4 h-4 mr-2"></i> Exportar a PDF </a>
                                </div>
                            </div>
                        </div>
                        <div class="hidden md:block mx-auto text-gray-600" id="table-shipments-header-info">Cargando envíos...</div>
                    </div>
                    <!-- BEGIN: Data List -->
                    <div class="intro-y datatable-wrapper box p-5 col-span-12">
                        <div id="table-shipments-wrapper">
                            <table id="table-shipments" class="table table-report table-report--bordered display w-full -mt-2">
                                <thead>
                                    <tr>
                                        <th class="whitespace-no-wrap">USUARIO</th>
                                        <th class="text-center whitespace-no-wrap">ORIGEN</th>
                                        <th class="text-center whitespace-no-wrap">DESTINO</th>
                                        <th class="text-center whitespace-no-wrap">CREADO</th>
                                        <th class="text-center whitespace-no-wrap">OFERTAS</th>
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

        <div class="modal" id="md-details-shipment">
            <div class="modal__content modal__content--xl">
                <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200">
                    <h2 class="font-medium text-base mr-auto" id="md-details-shipment-title"></h2>
                </div>
                <div id="md-details-shipment-content" class="p-5 grid"></div>
                <div class="px-5 py-3 text-right border-t border-gray-200">
                    <button type="button" class="button w-20 border text-gray-700 mr-1" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>

        <script src="dist/js/api-a.js"></script>
        <script src="dist/js/app.js"></script>
        <script>
            const CRUD = {
                detailsShipment: (i) => {
                    
                },
                loadShipments: () => {
                    $('#table-shipments-header-info').html('Cargando envíos...');
                    API.get('shipments', {
                        filter: '<?php echo $currentPHPScriptParam ? $currentPHPScriptParam : 'all' ?>'
                    }, (json) => {
                        if(!json.error) {
                            $('#table-shipments_filter input[type="search"]').val("");
                            $('#table-shipments-wrapper').html(`
                                <table id="table-shipments" class="table table-report table-report--bordered display w-full -mt-2">
                                    <thead>
                                        <tr>
                                            <th class="whitespace-no-wrap">USUARIO</th>
                                            <th class="text-center whitespace-no-wrap">ORIGEN</th>
                                            <th class="text-center whitespace-no-wrap">DESTINO</th>
                                            <th class="text-center whitespace-no-wrap">CREADO</th>
                                            <th class="text-center whitespace-no-wrap">OFERTAS</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            `);
                            json.data.forEach((info) => {
                                $('#table-shipments tbody').append(`
                                    <tr class="intro-x" data-uid="${info.id}">
                                        <td class="">${info.owner.fullname}</td>
                                        <td class="">${info.start_address.replace(', Argentina', '')}</td>
                                        <td class="">${info.end_address.replace(', Argentina', '')}</td>
                                        <td class="">${new Date(info.registered_at).toLocaleString()}</td>
                                        <td class="">${info.offers.length}</td>
                                    </tr>
                                `);
                            });
                            feather.replace();
                            $('#table-shipments-header-info').html(json.data.length > 10 ? `${json.data.length} envíos en total.` : `${json.data.length} envíos en total.`);
                            
                            $('#table-shipments').addClass('datatable').DataTable();
                        }
                    });
                }
            };

            CRUD.loadShipments();
        </script>
        <?php require_once('inc/footer.php'); ?>
    </body>
</html>