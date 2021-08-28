<?php
    if(in_array($_SERVER['REMOTE_ADDR'], array(
        '127.0.0.1',
        '::1'
    ))){
        define('BASE_PATH', '../');
        define('BASE_PATH_WA', '../webapp');
        define('BASE_URL', 'http://localhost/Nviame/webapp');
        define('API_BASE_PATH', 'http://localhost/Nviame/api');
    }
    else {
        if(strstr($_SERVER["DOCUMENT_ROOT"], "nviame")) {
            define('BASE_PATH', $_SERVER["DOCUMENT_ROOT"] . DIRECTORY_SEPARATOR);
            define('BASE_PATH_WA', BASE_PATH . DIRECTORY_SEPARATOR . "app");
            define('BASE_URL', 'https://' . $_SERVER["HTTP_HOST"] . "/app");
            define('API_BASE_PATH', 'https://' . $_SERVER["HTTP_HOST"] . "/api");
        }
        else {
            define('BASE_PATH', $_SERVER["DOCUMENT_ROOT"] . DIRECTORY_SEPARATOR . "sbxnv");
            define('BASE_PATH_WA', BASE_PATH . DIRECTORY_SEPARATOR . "app");
            define('BASE_URL', 'https://' . $_SERVER["HTTP_HOST"] . "/sbxnv/app");
            define('API_BASE_PATH', 'https://' . $_SERVER["HTTP_HOST"] . "/sbxnv/api");
        }
    }

    if(strstr($_SERVER["DOCUMENT_ROOT"], "nviame")) {
        define('SOCKET_ROOT', "https://nviame.com");
        define('SOCKET_PORT', 5533);
    }
    else {
        define('SOCKET_ROOT', "http://driftpadel.com.ar");
        define('SOCKET_PORT', 3344);
    }
    
    /*echo BASE_PATH;
    echo "<br>";
    echo BASE_URL;
    echo "<br>";
    echo BASE_PATH_WA;
    echo "<br>";
    echo API_BASE_PATH;
    die();*/

    require_once(BASE_PATH_WA . '/validasesion.php');

    require_once(BASE_PATH . '/ormnv/include.php');
    
    $GLOBALS["User"] = Commerces_Map($_SESSION["nvapp"]["Id"]);

    define("BODY_CLASS", "h-100 no-scroll");

    function svgIcon($name, $height = "100%", $width = "100%") {
        $content = file_get_contents("assets/images/$name");
        if(strstr($content, "width")) {
            $content = str_replace('width=', 'width="' . $width . '" owidth=', $content);
        }
        else {
            $content = str_replace('<svg', '<svg width="' . $width . '"', $content);
        }
        if(strstr($content, "height")) {
            $content = str_replace('height=', 'height="' . $height . '" oheight=', $content);
        }
        else {
            $content = str_replace('<svg', '<svg height="' . $height . '"', $content);
        }
        return $content;
    }

    function provincesData($provinces, $localities) {
        $data = array();
        foreach($provinces as $p) {
            if(!array_key_exists($p->getId(), $data)) {
                $loc = array();
                foreach($localities as $l) {
                    if($l->getProvinces()->getId() == $p->getId()) {
                        $loc[] = array(
                            "id" => $l->getId(),
                            "name" => $l->getName()
                        );
                    }
                }
                $data[$p->getId()] = array(
                    "id" => $p->getId(),
                    "name" => $p->getName(),
                    "localities" => $loc
                );
            }
        }
        return array_values($data);
    }

    function _group_by($array, $key) {
        $return = array();
        foreach($array as $val) {
            $return[$val[$key]][] = $val;
        }
        return $return;
    }
?>