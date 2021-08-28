<?php
    $currentPHPScript = basename($_SERVER["PHP_SELF"], ".php");
    $currentPHPScriptParam = array_pop(array_keys($_GET));
?>
<nav class="side-nav">
    <a href="" class="intro-x flex items-center pl-5 pt-4" style=" height: 48px; text-align: center; ">
        <img alt="logo_n" src="dist/images/logo.svg" style=" width: 256px; position: absolute; left: 72px; ">
    </a>
    <div class="side-nav__devider my-6"></div>
    <ul>
        <li>
            <a href="./" class="side-menu <?php echo $currentPHPScript == "index" ? "side-menu--active side-menu--open" : ""; ?>">
                <div class="side-menu__icon"> <i data-feather="home"></i> </div>
                <div class="side-menu__title"> Tablero </div>
            </a>
        </li>
        <li>
            <a href="javascript:;" class="side-menu <?php echo $currentPHPScript == "users" ? "side-menu--active side-menu--open" : ""; ?>">
                <div class="side-menu__icon"> <i data-feather="users"></i> </div>
                <div class="side-menu__title"> Usuarios <i data-feather="chevron-down" class="side-menu__sub-icon"></i> </div>
            </a>
            <ul class="">
                <li>
                    <a href="users.php" class="side-menu <?php echo $currentPHPScriptParam == null ? "side-menu--active" : ""; ?>">
                        <div class="side-menu__icon"> <i data-feather="user"></i> </div>
                        <div class="side-menu__title"> Todos</div>
                    </a>
                </li>
                <li>
                    <a href="users.php?verified" class="side-menu <?php echo $currentPHPScriptParam == "verified" ? "side-menu--active" : ""; ?>">
                        <div class="side-menu__icon"> <i data-feather="user-check"></i> </div>
                        <div class="side-menu__title"> Verificados </div>
                    </a>
                </li>
                <li>
                    <a href="users.php?unverified" class="side-menu <?php echo $currentPHPScriptParam == "unverified" ? "side-menu--active" : ""; ?>">
                        <div class="side-menu__icon"> <i data-feather="user-x"></i> </div>
                        <div class="side-menu__title"> No verificados</div>
                    </a>
                </li>
                <li>
                    <a href="users.php?disabled" class="side-menu <?php echo $currentPHPScriptParam == "disabled" ? "side-menu--active" : ""; ?>">
                        <div class="side-menu__icon"> <i data-feather="minus-circle"></i> </div>
                        <div class="side-menu__title"> Inhabilitados</div>
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;" class="side-menu <?php echo $currentPHPScript == "commerces" ? "side-menu--active side-menu--open" : ""; ?>">
                <div class="side-menu__icon"> <i data-feather="shopping-cart"></i> </div>
                <div class="side-menu__title"> Comercios <i data-feather="chevron-down" class="side-menu__sub-icon"></i> </div>
            </a>
            <ul class="">
                <li>
                    <a href="commerces.php" class="side-menu <?php echo $currentPHPScriptParam == null ? "side-menu--active" : ""; ?>">
                        <div class="side-menu__icon"> <i data-feather="user"></i> </div>
                        <div class="side-menu__title"> Todos</div>
                    </a>
                </li>
                <li>
                    <a href="commerces.php?verified" class="side-menu <?php echo $currentPHPScriptParam == "verified" ? "side-menu--active" : ""; ?>">
                        <div class="side-menu__icon"> <i data-feather="user-check"></i> </div>
                        <div class="side-menu__title"> Verificados </div>
                    </a>
                </li>
                <li>
                    <a href="commerces.php?unverified" class="side-menu <?php echo $currentPHPScriptParam == "unverified" ? "side-menu--active" : ""; ?>">
                        <div class="side-menu__icon"> <i data-feather="user-x"></i> </div>
                        <div class="side-menu__title"> No verificados</div>
                    </a>
                </li>
                <li>
                    <a href="commerces.php?disabled" class="side-menu <?php echo $currentPHPScriptParam == "disabled" ? "side-menu--active" : ""; ?>">
                        <div class="side-menu__icon"> <i data-feather="minus-circle"></i> </div>
                        <div class="side-menu__title"> Inhabilitados</div>
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;" class="side-menu <?php echo $currentPHPScript == "shipments" ? "side-menu--active side-menu--open" : ""; ?>">
                <div class="side-menu__icon"> <i data-feather="package"></i> </div>
                <div class="side-menu__title"> Envíos <i data-feather="chevron-down" class="side-menu__sub-icon"></i> </div>
            </a>
            <ul class="">
                <li>
                    <a href="shipments.php" class="side-menu <?php echo $currentPHPScriptParam == null ? "side-menu--active" : ""; ?>">
                        <div class="side-menu__icon"> <i data-feather="list"></i> </div>
                        <div class="side-menu__title"> Todos</div>
                    </a>
                </li>
                <li>
                    <a href="shipments.php?delivered" class="side-menu<?php echo $currentPHPScriptParam == "delivered" ? "side-menu--active" : ""; ?>">
                        <div class="side-menu__icon"> <i data-feather="truck"></i> </div>
                        <div class="side-menu__title"> Entregados</div>
                    </a>
                </li>
                <li>
                    <a href="shipments.php?refunded" class="side-menu<?php echo $currentPHPScriptParam == "refunded" ? "side-menu--active" : ""; ?>">
                        <div class="side-menu__icon"> <i data-feather="minus-circle"></i> </div>
                        <div class="side-menu__title"> Devueltos </div>
                    </a>
                </li>
                <li>
                    <a href="shipments.php?on-travel" class="side-menu<?php echo $currentPHPScriptParam == "on-travel" ? "side-menu--active" : ""; ?>">
                        <div class="side-menu__icon"> <i data-feather="navigation"></i> </div>
                        <div class="side-menu__title"> En viaje </div>
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript: void(0);" class="side-menu">
                <div class="side-menu__icon"> <i data-feather="dollar-sign"></i> </div>
                <div class="side-menu__title"> Transacciones </div>
            </a>
        </li>
        <li>
            <a href="companies.php" class="side-menu <?php echo $currentPHPScript == "companies" ? "side-menu--active side-menu--open" : ""; ?>">
                <div class="side-menu__icon"> <i data-feather="list"></i> </div>
                <div class="side-menu__title"> Empresas </div>
            </a>
        </li>
        <li class="side-nav__devider my-6"></li>
        <li>
            <a href="javascript: sPush();" class="side-menu">
                <div class="side-menu__icon"> <i data-feather="message-square"></i> </div>
                <div class="side-menu__title"> Enviar notificación </div>
            </a>
        </li>
        <li class="side-nav__devider my-6"></li>
        <li>
            <a href="javascript: void(0);" class="side-menu">
                <div class="side-menu__icon"> <i data-feather="tool"></i> </div>
                <div class="side-menu__title"> Herramientas </div>
            </a>
        </li>
        <li>
            <a href="javascript: void(0);" class="side-menu">
                <div class="side-menu__icon"> <i data-feather="sliders"></i> </div>
                <div class="side-menu__title"> Configuraciones </div>
            </a>
        </li>
        <li class="side-nav__devider my-6"></li>
        <li>
            <a href="javascript: void(0);" class="side-menu">
                <div class="side-menu__icon"> <i data-feather="cpu"></i> </div>
                <div class="side-menu__title"> Monitoreo </div>
            </a>
        </li>
        <li>
            <a href="javascript: void(0);" class="side-menu">
                <div class="side-menu__icon"> <i data-feather="power"></i> </div>
                <div class="side-menu__title"> Salir del sistema </div>
            </a>
        </li>
    </ul>
</nav>