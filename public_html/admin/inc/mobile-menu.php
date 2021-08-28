<?php
    $currentPHPScript = basename($_SERVER["PHP_SELF"], ".php");
    $currentPHPScriptParam = array_pop(array_keys($_GET));
?>
<div class="mobile-menu md:hidden">
    <div class="mobile-menu-bar">
        <a href="" class="flex mr-auto">
            <img alt="Midone Tailwind HTML Admin Template" class="w-6" src="dist/images/logo.svg">
        </a>
        <a href="javascript:;" id="mobile-menu-toggler"> <i data-feather="bar-chart-2" class="w-8 h-8 text-white transform -rotate-90"></i> </a>
    </div>
    <ul class="border-t border-theme-24 py-5 hidden">
        <li>
            <a href="./" class="menu <?php echo $currentPHPScript == "index" ? "menu--active menu--open" : ""; ?>">
                <div class="menu__icon"> <i data-feather="home"></i> </div>
                <div class="menu__title"> Tablero </div>
            </a>
        </li>
        <li>
            <a href="javascript:;" class="menu <?php echo $currentPHPScript == "users" ? "menu--active menu--open" : ""; ?>">
                <div class="menu__icon"> <i data-feather="users"></i> </div>
                <div class="menu__title"> Usuarios <i data-feather="chevron-down" class="menu__sub-icon"></i> </div>
            </a>
            <ul class="">
                <li>
                    <a href="users.php" class="menu <?php echo $currentPHPScriptParam == null ? "menu--active" : ""; ?>">
                        <div class="menu__icon"> <i data-feather="user"></i> </div>
                        <div class="menu__title"> Todos</div>
                    </a>
                </li>
                <li>
                    <a href="users.php?new" class="menu <?php echo $currentPHPScriptParam == "new" ? "menu--active" : ""; ?>">
                        <div class="menu__icon"> <i data-feather="user-plus"></i> </div>
                        <div class="menu__title"> Nuevos</div>
                    </a>`
                </li>
                <li>
                    <a href="users.php?verified" class="menu <?php echo $currentPHPScriptParam == "verified" ? "menu--active" : ""; ?>">
                        <div class="menu__icon"> <i data-feather="user-check"></i> </div>
                        <div class="menu__title"> Verificados </div>
                    </a>
                </li>
                <li>
                    <a href="users.php?unverified" class="menu <?php echo $currentPHPScriptParam == "unverified" ? "menu--active" : ""; ?>">
                        <div class="menu__icon"> <i data-feather="user-x"></i> </div>
                        <div class="menu__title"> No verificados</div>
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;" class="menu <?php echo $currentPHPScript == "commerces" ? "menu--active menu--open" : ""; ?>">
                <div class="menu__icon"> <i data-feather="shopping-cart"></i> </div>
                <div class="menu__title"> Comercios <i data-feather="chevron-down" class="menu__sub-icon"></i> </div>
            </a>
            <ul class="">
                <li>
                    <a href="commerces.php" class="menu <?php echo $currentPHPScriptParam == null ? "menu--active" : ""; ?>">
                        <div class="menu__icon"> <i data-feather="user"></i> </div>
                        <div class="menu__title"> Todos</div>
                    </a>
                </li>
                <li>
                    <a href="commerces.php?new" class="menu <?php echo $currentPHPScriptParam == "new" ? "menu--active" : ""; ?>">
                        <div class="menu__icon"> <i data-feather="user-plus"></i> </div>
                        <div class="menu__title"> Nuevos</div>
                    </a>`
                </li>
                <li>
                    <a href="commerces.php?verified" class="menu <?php echo $currentPHPScriptParam == "verified" ? "menu--active" : ""; ?>">
                        <div class="menu__icon"> <i data-feather="user-check"></i> </div>
                        <div class="menu__title"> Verificados </div>
                    </a>
                </li>
                <li>
                    <a href="commerces.php?unverified" class="menu <?php echo $currentPHPScriptParam == "unverified" ? "menu--active" : ""; ?>">
                        <div class="menu__icon"> <i data-feather="user-x"></i> </div>
                        <div class="menu__title"> No verificados</div>
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;" class="menu <?php echo $currentPHPScript == "shipments" ? "menu--active menu--open" : ""; ?>">
                <div class="menu__icon"> <i data-feather="package"></i> </div>
                <div class="menu__title"> Envíos <i data-feather="chevron-down" class="menu__sub-icon"></i> </div>
            </a>
            <ul class="">
                <li>
                    <a href="javascript: void(0);" class="menu">
                        <div class="menu__icon"> <i data-feather="list"></i> </div>
                        <div class="menu__title"> Todos</div>
                    </a>
                </li>
                <li>
                    <a href="javascript: void(0);" class="menu">
                        <div class="menu__icon"> <i data-feather="truck"></i> </div>
                        <div class="menu__title"> Entregados</div>
                    </a>
                </li>
                <li>
                    <a href="javascript: void(0);" class="menu">
                        <div class="menu__icon"> <i data-feather="minus-circle"></i> </div>
                        <div class="menu__title"> Devueltos </div>
                    </a>
                </li>
                <li>
                    <a href="javascript: void(0);" class="menu">
                        <div class="menu__icon"> <i data-feather="navigation"></i> </div>
                        <div class="menu__title"> En viaje </div>
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript: void(0);" class="menu">
                <div class="menu__icon"> <i data-feather="dollar-sign"></i> </div>
                <div class="menu__title"> Transacciones </div>
            </a>
        </li>
        <li>
            <a href="companies.php" class="menu">
                <div class="menu__icon"> <i data-feather="list"></i> </div>
                <div class="menu__title"> Empresas </div>
            </a>
        </li>
        <li class="nav__devider my-6"></li>
        <li>
            <a href="javascript: void(0);" class="menu">
                <div class="menu__icon"> <i data-feather="tool"></i> </div>
                <div class="menu__title"> Herramientas </div>
            </a>
        </li>
        <li>
            <a href="javascript: void(0);" class="menu">
                <div class="menu__icon"> <i data-feather="sliders"></i> </div>
                <div class="menu__title"> Configuraciones </div>
            </a>
        </li>
        <li class="nav__devider my-6"></li>
        <li>
            <a href="javascript: void(0);" class="menu">
                <div class="menu__icon"> <i data-feather="cpu"></i> </div>
                <div class="menu__title"> Monitoreo </div>
            </a>
        </li>
        <li>
            <a href="javascript: void(0);" class="menu">
                <div class="menu__icon"> <i data-feather="power"></i> </div>
                <div class="menu__title"> Salir del sistema </div>
            </a>
        </li>
    </ul>
</div>