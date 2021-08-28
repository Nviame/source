<?php
    $sName = basename($_SERVER["PHP_SELF"], ".php");
    $pageTitle = "";
    switch($sName) {
        case 'dashboard':
            $pageTitle = "Dashboard";
        break;
        case 'envios-programados':
            $pageTitle = "Envíos programados";
        break;
        case 'ofertas-recibidas':
        case 'pago-aceptado':
            $pageTitle = "Ofertas recibidas";
        break;
        case 'billetera':
            $pageTitle = "Billetera";
        break;
        case 'preferencias':
            $pageTitle = "Preferencias";
        break;
        case 'sucursales':
            $pageTitle = "Sucursales";
        break;
        case 'agregar-cliente':
            $pageTitle = "Alta de Clientes";
        break;
        case 'listado-general':
            $pageTitle = "Clientes";
        break;
        case 'programar-envios':
            $pageTitle = "Programar envíos";
        break;
        case 'tarifas':
            $pageTitle = "Tarifas";
        break;
        case 'mi-cuenta':
            $pageTitle = "Mi Cuenta";
        break;
    }
?>
<meta charset="utf-8">
<title>Nviame<?php echo $pageTitle ? " - $pageTitle" : ""; ?></title>
<meta name="description" content="">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="lib/bootstrap/css/bootstrap.min.css">
<link href="lib/select2/select2.min.css" rel="stylesheet" type="text/css" >
<link href="lib/select2/select2-bootstrap-5-theme.min.css" rel="stylesheet" type="text/css" >
<link rel="stylesheet" href="assets/css/styles.css">
<link rel="icon" type="image/x-icon" href="../img/favicon.ico" />
<link rel="shortcut icon" type="image/x-icon" href="../img/favicon.ico" />
<meta name="theme-color" content="#4C00FF">