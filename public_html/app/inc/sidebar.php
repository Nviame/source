<?php
    require_once('inc/scripts.php');

    $loggedInfo = $_SESSION["nvapp"];

    function classNL($n) {
        return ($n == basename($_SERVER["PHP_SELF"], ".php")) ? " active" : "";
    }
?>

<div class="d-flex flex-column flex-shrink-0 sidebar sidebar-hidden">
    <ul class="nav nav-pills flex-column mb-auto">
        <li>
            <a href="dashboard" class="nav-link<?php echo classNL('dashboard'); ?>">
                <i><?php echo svgIcon("dashboard-icon.svg", "20px", "100%"); ?></i>
                Dashboard
            </a>
        </li>
        <li>
            <a href="envios-programados" class="nav-link<?php echo classNL('envios-programados'); ?>">
                <i><?php echo svgIcon("envios-programados-icon.svg", "18px", "100%"); ?></i>
                Envíos programados
            </a>
        </li>
        <!--
        <li>
            <a href="ofertas-recibidas" class="nav-link<?php echo classNL('ofertas-recibidas'); ?>">
                <i><?php echo svgIcon("ofertas-recibidas-icon.svg", "20px", "100%"); ?></i>
                Ofertas recibidas
            </a>
        </li>
        <li>
            <a href="entregas-pendientes" class="nav-link<?php echo classNL('entregas-pendientes'); ?>">
                <i><?php echo svgIcon("entregas-pendientes-icon.svg", "20px", "100%"); ?></i>
                Entregas pendientes
            </a>
        </li>
        <li>
            <a href="historial-envios" class="nav-link<?php echo classNL('historial-envios'); ?>">
                <i><?php echo svgIcon("historial-envios-icon.svg", "20px", "100%"); ?></i>
                Historial de envíos
            </a>
        </li>
        -->
        <li>
            <a href="billetera" class="nav-link<?php echo classNL('billetera'); ?>">
                <i><?php echo svgIcon("billetera-icon.svg", "18px", "100%"); ?></i>
                Billetera
            </a>
        </li>
        <li>
            <a href="preferencias" class="nav-link<?php echo classNL('preferencias'); ?>">
                <i><?php echo svgIcon("preferencias-icon.svg", "20px", "100%"); ?></i>
                Preferencias
            </a>
        </li>
        <li>
            <a href="tarifas" class="nav-link<?php echo classNL('tarifas'); ?>">
                <i><?php echo svgIcon("tarifas-icon.svg", "20px", "100%"); ?></i>
                Tarifas
            </a>
        </li>
        <li>
            <a href="sucursales" class="nav-link<?php echo classNL('sucursales'); ?>">
                <i><?php echo svgIcon("sucursales-icon.svg", "20px", "100%"); ?></i>
                Sucursales
            </a>
        </li>
        <li>
            <a href="agregar-cliente" class="nav-link<?php echo classNL('agregar-cliente'); ?>">
                <i><?php echo svgIcon("agregar-cliente-icon.svg", "20px", "100%"); ?></i>
                Agregar cliente
            </a>
        </li>
        <li>
            <a href="listado-general" class="nav-link<?php echo classNL('listado-general'); ?>">
                <i><?php echo svgIcon("listado-clientes-icon.svg", "20px", "100%"); ?></i>
                Listado general
            </a>
        </li>
        <li class="divider"></li>
        <li>
            <a href="mi-cuenta" class="nav-link<?php echo classNL('mi-cuenta'); ?>">
                <span style="<?php echo $loggedInfo["Logo"] ? "background-image: url(uploads/$loggedInfo[Logo]);" : ""; ?>"></span>
                Mi Cuenta
            </a>
        </li>
        <li class="divider"></li>
        <li>
            <a href="logout" class="nav-link">
                <i><?php echo svgIcon("logout-icon.svg", "20px", "100%"); ?></i>
                Cerrar sesión
            </a>
        </li>
    </ul>
</div>
<?php require_once('inc/panel-right.php'); ?>