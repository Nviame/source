<?php
    session_start();

    if(isset($_SESSION["nviame"]["user_info"])) {
        header('Location: index.php');
        exit();
    }
    
    $loginErrorMessage = null;
    $formData = $_POST;
    if(isset($formData["do_login"])) {
        require_once '../api/include/Config.php';
        require_once '../api/include/DbConnect.php';
        require_once '../api/include/Password.php';
        $dbConn = new DbConnect();
        $db = $dbConn->connect();

        $uInfo = $db->getRow("SELECT * FROM administrators WHERE username = ? AND `password` = ?", array(
            $formData["username"],
            createPassword($formData["password"])
        )) ?: null;
        if($uInfo) {
            $db->query("UPDATE administrators SET last_login = UTC_TIMESTAMP() WHERE id = ?", array(
                $uInfo["id"]
            ));
            $_SESSION["nviame"] = array(
                "user_info" => $uInfo
            );
            header('Location: index.php');
            exit();
        }
        else {
            $loginErrorMessage = "El usuario o la contraseña son incorrectos.";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <!--
        <link href="dist/images/logo.svg" rel="shortcut icon">
        -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Nviame">
        <meta name="keywords" content="Nviame">
        <meta name="author" content="carlos.schmidt@live.com.ar">
        <title>Nviame</title>
        <link rel="icon" type="image/x-icon" href="../img/favicon.ico" />
        <link rel="shortcut icon" type="image/x-icon" href="../img/favicon.ico" />
        <link rel="stylesheet" href="dist/css/app.css" />
    </head>
    <body class="login">
        <div class="container sm:px-10">
            <div class="block xl:grid grid-cols-2 gap-4">
                <div class="hidden xl:flex flex-col min-h-screen">
                    <div class="my-auto">
                        <img alt="" class="-intro-x" src="dist/images/logo-full.svg" style=" width: 256px; margin: 0 20%; ">
                        <div class="-intro-x text-white font-medium text-3xl leading-tight mt-10">
                            Comunidad de envíos y
                            <br>
                            entregas on-demand.
                        </div>
                        <div class="-intro-x mt-5 text-lg text-white">Envíos sustentables, aprovechando los espacios vacíos<br>de los vehículos y los viajes frecuentes de nuestros usuarios.</div>
                    </div>
                </div>
                <div class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0">
                    <div class="my-auto mx-auto xl:ml-20 bg-white xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
                        <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">
                            Acceder al sistema
                        </h2>
                        <?php if($loginErrorMessage != null): ?>
                            <div class="intro-y rounded-md flex items-center px-5 py-4 mt-5 bg-theme-6 text-white"> <i data-feather="alert-circle" class="w-6 h-6 mr-2"></i> <?php echo $loginErrorMessage; ?> </div>
                        <?php endif ?>
                        <form action="" method="post">
                            <div class="intro-x mt-8">
                                <input type="text" class="intro-x login__input input input--lg border border-gray-300 block" placeholder="Usuario" name="username" required>
                                <input type="password" class="intro-x login__input input input--lg border border-gray-300 block mt-4" placeholder="Contraseña" name="password" required>
                            </div>
                            <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
                                <button type="submit" class="button button--lg w-full xl:w-32 text-white bg-theme-1 xl:mr-3" name="do_login">Entrar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script src="dist/js/app.js"></script>
    </body>
</html>