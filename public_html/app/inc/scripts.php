<script src="lib/jquery.min.js"></script>
<script src="lib/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="lib/select2/select2.full.min.js" type="text/javascript"></script>
<script src="lib/select2/i18n/es.js" type="text/javascript"></script>
<script>
    $.fn.select2.defaults.set('language', 'es');
</script>
<script src="lib/jquery.validate/jquery.validate.min.js" type="text/javascript"></script>
<script src="lib/jquery.remember-state/jquery.remember-state.min.js" type="text/javascript"></script>
<script src="lib/sweetalert2/sweetalert2@11.js" type="text/javascript"></script>
<script src="lib/socket.io/socket.io.min.js" type="text/javascript"></script>
<script src="lib/underscore.js/underscore-umd-min.js" type="text/javascript"></script>
<script>
    JSON.clone = function(jsonObj) {
        return JSON.parse(JSON.stringify(jsonObj));
    }

    var MAP_STYLES = [ { "featureType": "administrative", "elementType": "labels.text.fill", "stylers": [ { "color": "#444444" } ] }, { "featureType": "landscape", "elementType": "all", "stylers": [ { "color": "#f2f2f2" } ] }, { "featureType": "landscape.natural.terrain", "elementType": "geometry.fill", "stylers": [ { "color": "#898989" } ] }, { "featureType": "poi", "elementType": "all", "stylers": [ { "visibility": "off" } ] }, { "featureType": "road", "elementType": "all", "stylers": [ { "saturation": -100 }, { "lightness": 45 } ] }, { "featureType": "road.highway", "elementType": "all", "stylers": [ { "visibility": "simplified" } ] }, { "featureType": "road.arterial", "elementType": "labels.text.fill", "stylers": [ { "saturation": "-7" }, { "color": "#4c00ff" } ] }, { "featureType": "road.arterial", "elementType": "labels.icon", "stylers": [ { "visibility": "off" } ] }, { "featureType": "road.local", "elementType": "geometry.fill", "stylers": [ { "color": "#e6e6e6" }, { "visibility": "on" } ] }, { "featureType": "road.local", "elementType": "labels.text.fill", "stylers": [ { "color": "#2905a1" } ] }, { "featureType": "road.local", "elementType": "labels.text.stroke", "stylers": [ { "color": "#ffffff" } ] }, { "featureType": "transit", "elementType": "all", "stylers": [ { "visibility": "off" } ] }, { "featureType": "transit", "elementType": "geometry.fill", "stylers": [ { "color": "#4c00ff" } ] }, { "featureType": "transit", "elementType": "geometry.stroke", "stylers": [ { "hue": "#ff0000" } ] }, { "featureType": "transit.line", "elementType": "geometry.stroke", "stylers": [ { "color": "#dd0000" }, { "visibility": "on" } ] }, { "featureType": "transit.line", "elementType": "labels.text.fill", "stylers": [ { "color": "#4c00ff" } ] }, { "featureType": "transit.station.bus", "elementType": "geometry.fill", "stylers": [ { "color": "#666666" } ] }, { "featureType": "water", "elementType": "all", "stylers": [ { "color": "#b7b7b7" }, { "visibility": "on" } ] } ];

    Utils = {
        shipments: {
            statusDescription: (id_status) => {
                const list = ['Esperando pago', 'Pago realizado', 'Paquete retirado', 'En viaje', 'Paquete entregado', 'Pendiente por devolución', 'Devuelto'];
                return id_status ? list[id_status - 1] : 'Disponible';
            }
        }
    }

    Toasts = {
        toast: function(type, title, timer) {
            if(typeof timer === 'undefined') {
                timer = 5000;
            }
            const Toast = Swal.mixin({
                toast: true,
                position: 'bottom-end',
                showConfirmButton: false,
                timer: timer,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer);
                    toast.addEventListener('mouseleave', Swal.resumeTimer);
                }
            });

            Toast.fire({
                icon: type,
                title: title
            });
        },
        success: function(title, timer) {
            Toasts.toast("success", title, timer);
        },
        error: function(title, timer) {
            Toasts.toast("error", title, timer);
        },
        info: function(title, timer) {
            Toasts.toast("info", title, timer);
        }
    }

    Dialogs = {
        default_options: {
            customClass: {
                confirmButton: 'btn btn-primary btn-lg mt-3 mb-2',
                denyButton: 'btn btn-primary btn-lg mt-3 mb-2',
                cancelButton: 'btn btn-primary btn-lg mt-3 mb-2 ml-2',
            },
            showCloseButton: true,
            buttonsStyling: false,
            focusConfirm: false
        },
        dialog: function(type, title, content) {
            Swal.fire(JSON.clone(Object.assign({}, Dialogs.default_options, {
                title: title,
                html: content,
                icon: type,
                confirmButtonText: 'Aceptar',
            })));
        },
        question: function(title, content, cb) {
            var opts = JSON.clone(Object.assign({}, Dialogs.default_options, {
                title: title,
                html: content,
                icon: 'warning',
                confirmButtonText: 'Confirmar',
                showCancelButton: true,
                cancelButtonText: 'Cancelar'
            }));
            opts.customClass.confirmButton = opts.customClass.confirmButton.replace('btn-primary', 'btn-danger');
            Swal.fire(opts).then((result) => {
                if (result.isConfirmed) {
                    cb();
                }
            })
        },
        success: function(title, content) {
            Dialogs.dialog("success", title, content);
        },
        error: function(title, content) {
            Dialogs.dialog("error", title, content);
        },
        info: function(title, content) {
            Dialogs.dialog("info", title, content);
        }
    }
</script>
<script>
    jQuery.validator.defaults.ignore = '.no-validate';

    jQuery.extend(jQuery.validator.messages, {
        required: "Este campo es requerido.",
        remote: "Corrija este campo.",
        email: "Ingrese una dirección de correo electrónico válida.",
        url: "Ingrese una URL válida.",
        date: "Ingrese una fecha válida.",
        dateISO: "Ingrese una fecha válida (ISO).",
        number: "Ingrese un número válido.",
        digits: "Ingrese solo dígitos.",
        creditcard: "Por favor, introduzca un número de tarjeta de crédito válida.",
        equalTo: "Ingrese el mismo valor nuevamente.",
        accept: "Ingrese un valor con una extensión válida.",
        maxlength: jQuery.validator.format("No ingrese más de {0} caracteres."),
        minlength: jQuery.validator.format("Ingrese al menos {0} caracteres."),
        rangelength: jQuery.validator.format("Introduzca un valor de entre {0} y {1} caracteres."),
        range: jQuery.validator.format("Ingrese un valor entre {0} y {1}."),
        max: jQuery.validator.format("Ingrese un valor menor o igual que {0}."),
        min: jQuery.validator.format("Ingrese un valor mayor o igual que {0}.")
    });

    $(function() {
        $('.sidebar-toggle').click(function() {
            $(this).toggleClass('toggled');
            $('.sidebar').toggleClass('sidebar-hidden');
        });

        $('.panel-right-toggle').click(() => {
            $('.panel-right').toggleClass('hidden');
        });

        $('select.form-control').select2({
            theme: "bootstrap-5"
        });

        $(document).on('select2:open', () => {
            setTimeout(() => {
                document.querySelector('.select2-search__field').focus();
            }, 0);
        });

        $(document).on('keyup', '.card-box .table-search', (e) => {
            var input = e.target;
            var value = $(input).val().toLowerCase();
            $(input).closest('.card-box').find('table tbody tr').filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });

        $(document).on('click', '.label-radio', (e) => {
            var $parent = $(e.target).parent();
            $parent.find('.label-radio').removeClass('selected');
            $(e.target).addClass('selected');
        });
    });
</script>
<script>
    function parseAddressComponents(address_components) {
        var findResult = function(ac, name){
            var result =  _.find(ac, function(obj){
                return obj.types[0] == name && obj.types[1] == "political";
            });
            return result ? (name == 'country' ? result.short_name : result.long_name) : null;
        }        
        return {
            city: findResult(address_components, "locality"),
            state: findResult(address_components, "administrative_area_level_1"),
            country: findResult(address_components, "country")
        }
    }

    <?php if(defined('SOCKET_ROOT')): ?>
        var socket = {
            _s: null,
            subscriptions: [],
            isConnected: function () {
                return socket._s && socket._s.connected;
            },
            destroy: function () {
                if (socket._s != null) {
                    socket._s.disconnect();
                    socket._s.destroy();
                    socket._s = null;
                    socket.initialized = false;
                }
            },
            suscribe: function (name, params, cb) {
                if (socket._s) {
                    var rowInfo = {
                        name: name,
                        data: params
                    };
                    if (socket.subscriptions.filter(function (r) {
                            return r.name != rowInfo.name;
                        }).length == 0) {
                        socket.subscriptions.push(Object.assign(rowInfo, {
                            cb: typeof cb === 'function' ? cb : function () {}
                        }));
                    }
                    socket._s.emit('[suscribe]', rowInfo);
                }
            },
            unsuscribe: function (name) {
                if (socket._s) {
                    socket.subscriptions = socket.subscriptions.filter(function (r) {
                        return r.name != name;
                    });
                    socket._s.emit('[unsuscribe]', name);
                }
            },
            emit: function (m, p) {
                if (socket._s) {
                    socket._s.emit(m, p);
                }
            },
            init: function () {
                const socketURL = '<?php echo SOCKET_ROOT; ?>' + ':' + '<?php echo SOCKET_PORT; ?>';
                socket._s = io(socketURL);
                socket._s.timesConnected = 0;

                var logged_user_info = <?php echo json_encode($GLOBALS["User"]["RawUserData"]); ?>;

                socket._s.on('connect', function () {
                    socket._s.timesConnected++;

                    console.log('socket connected > ', logged_user_info);

                    if (logged_user_info) {
                        socket._s.emit('user connect', {
                            user: logged_user_info,
                            device: {"available":"","cordova":"","model":"","platform":"","uuid":"","version":"","manufacturer":"","isVirtual":"","serial":""},
                            push: {
                                registration_id: ''
                            }
                        });

                        socket.emit('check count available shipments', {});

                        socket.emit('check count offers shipments', {});

                        socket.emit('chat unread messages count', {});

                        $('.user-online-offline-status-indicator').each(function (ind, el) {
                            socket.emit('check user status', {
                                id: el.dataset.uid
                            });
                        });

                        /*
                        socket.emit('mp user info', {
                            id: logged_user_info.id,
                            email: logged_user_info.email
                        });*/

                        socket.subscriptions.forEach(function (r) {
                            var rInfo = {};
                            Object.keys(r).forEach(function (k) {
                                if (k != 'cb') {
                                    rInfo[k] = r[k];
                                }
                            });
                            socket._s.emit('[suscribe]', rInfo);
                        });
                    }
                });

                socket._s.on('[suscription]', function (data) {
                    console.log('[suscription]: ', data);

                    //alert(`[suscription] ${JSON.stringify(data)}`);

                    var susc = socket.subscriptions.filter(function (su) {
                        return su.name == data.name;
                    }).shift();
                    console.log(susc);
                    if (susc) {
                        susc.data_received = data.data;
                        susc.cb(data.data);
                    }
                });

                socket._s.on('user verification', function (data) {
                    console.log('user verification', data);
                });

                socket._s.on('user tracking position', function (data) {
                    console.log('user tracking position', data);
                });

                socket._s.on('system message', function (data) {
                    console.log('system message: ', data);
                });

                socket._s.on('force logout', function (data) {
                    console.log('force logout: ', data);
                });

                socket._s.on('user online', function (data) {
                    console.log('user online: ', data);
                });

                socket._s.on('user connected', function (data) {
                    console.log('user connected: ', data);
                });

                socket._s.on('user offline', function (data) {
                    console.log('user offline: ', data);
                });

                socket._s.on('user position address components', function (data) {
                    console.log('user position address components: ', data);
                });

                socket._s.on('new shipment', function (data) {
                    console.log('new shipment: ', data);

                    socket.emit('check count available shipments');
                    socket.emit('unread notifications', {
                        id: logged_user_info.id
                    });
                });

                socket._s.on('offer accepted', function (data) {
                    console.log('offer accepted: ', data);
                });

                socket._s.on('new offer', function (data) {
                    console.log('new offer: ', data);
                    if(typeof window._s_no === 'function') {
                        window._s_no(data);
                    }
                });

                socket._s.on('count available shipments', function (count) {
                    console.log('count available shipments: ', count);
                });

                socket._s.on('count offers shipments', function (count) {
                    console.log('count offers shipments: ', count);
                    if(count > 0) {
                        $('.navbar a[href="ofertas-recibidas"]').addClass('with-new-offers');
                    }
                    else {
                        $('.navbar a[href="ofertas-recibidas"]').removeClass('with-new-offers');
                    }
                });

                socket._s.on('user status', function (data) {
                    console.log('user status', data);
                });

                socket._s.on('general user status', function (data) {
                    console.log('general user status', data);
                });

                socket._s.on('mp payment methods', function (paymentMethods) {
                    console.log('mp payment methods', paymentMethods);
                });

                socket._s.on('mp user cards', function (cards) {
                    console.log('mp user cards', data);
                });

                socket._s.on('mp user info', function (data) {
                    console.log('mp user info', data);
                });

                socket._s.on('shipment timeline updated', function (data) {
                    console.log('shipment timeline updated', data);
                    if(typeof window._s_stu === 'function') {
                        window._s_stu(data);
                    }
                });

                socket._s.on('status payment', function (payment) {
                    console.log('status payment', payment);
                    if(typeof window._s_sp === 'function') {
                        window._s_sp(payment);
                    }
                });

                socket._s.on('status payment extra', function (payment) {
                    console.log('status payment extra', payment);
                });

                socket._s.on('shipment paid', function (payment) {
                    console.log('shipment paid', payment);
                });

                socket._s.on('shipment retired', function (data) {
                    console.log('shipment retired', data);

                    if(typeof window._s_sr === 'function') {
                        window._s_sr(data);
                    }
                });

                socket._s.on('shipment travel on', function (data) {
                    console.log('shipment travel on', data);
                    if(typeof window._s_sto === 'function') {
                        window._s_sto(data);
                    }
                });

                socket._s.on('shipment delivered', function (data) {
                    console.log('shipment delivered', data);
                    if(typeof window._s_sd === 'function') {
                        window._s_sd(data);
                    }
                });

                socket._s.on('shipment delivered notified', function (payment) {
                    console.log('shipment delivered notified', payment);
                });

                socket._s.on('shipment operation aborted', function (data) {
                    console.log('shipment operation aborted', data);
                });

                socket._s.on('shipment returned', function (data) {
                    console.log('shipment returned', data);
                });

                socket._s.on('shipment rate', function (payment) {
                    console.log('shipment rate', payment);
                });

                socket._s.on('shipment user location changed', function (data) {
                    console.log('shipment user location changed', data);
                });

                socket._s.on('notification', function (n) {
                    console.log('notification', n);
                    if(typeof window._s_n === 'function') {
                        window._s_n(n);
                    }
                });

                socket._s.on('unread notifications', function (data) {
                    console.log('unread notifications', data);
                });

                socket._s.on('chat new message sent', function (data) {
                    console.log('chat new message sent', data);
                });

                socket._s.on('chat new message', function (data) {
                    console.log('chat new message', data);
                });

                socket._s.on('chat user typing', function (data) {
                    console.log('chat user typing', data);
                });

                socket._s.on('chat user stop typing', function (data) {
                    console.log('chat user stop typing', data);
                });

                socket._s.on('chat unread messages count', function (data) {
                    console.log('chat unread messages count', data);
                });

                socket._s.on('shipment offers', function (data) {
                    if(typeof window._s_so === 'function') {
                        window._s_so(data);
                    }
                });

                socket.initialized = true;
            }
        }

        $(function () {
            socket.init();
        });
    <?php endif ?>
</script>