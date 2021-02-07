<?php

require("../../../config/config.inc.php");

$Parameters = new Moon2_Params_Parameters();
$Parameters->verify("GET", true);
$option = $Parameters->get_parameter("opt", "");
$fileName = $Parameters->get_parameter("codificado", "");
$mime = $Parameters->get_parameter("mime", "");

switch ($option) {
    case "1":
        $img = $PATH_CONFIG["IMAGES_PERFIL"] . "/" . $fileName;
        if (!is_file($img)) {
            $img = $PATH_CONFIG["IMAGES_DEFAULT"] . "/user.jpg";
        }
        break;
    case "2":
        $img = $PATH_CONFIG["IMAGES_SLIDERMAIN"] . "/" . $fileName;
        if (!is_file($img)) {
            $img = $PATH_CONFIG["IMAGES_DEFAULT"] . "/user.jpg";
        }
        break;

    case "3":
        $img = $PATH_CONFIG["IMAGES_TEAM"] . "/" . $fileName;
        if (!is_file($img)) {
            $img = $PATH_CONFIG["IMAGES_DEFAULT"] . "/user.jpg";
        }
        break;

    case "4":
        $img = $PATH_CONFIG["IMAGES_NOTICIAS"] . "/" . $fileName;
        if (!is_file($img)) {
            $img = $PATH_CONFIG["IMAGES_DEFAULT"] . "/user.jpg";
        }
        break;

    case "5":
        $img = $PATH_CONFIG["IMAGES_PROMOCIONES"] . "/" . $fileName;
        if (!is_file($img)) {
            $img = $PATH_CONFIG["IMAGES_DEFAULT"] . "/user.jpg";
        }
        break;
    case "6":
        $img = $PATH_CONFIG["SOPORTES_PAGO"] . "/" . $fileName;
        if (!is_file($img)) {
            $img = $PATH_CONFIG["IMAGES_DEFAULT"] . "/user.jpg";
        }
        break;
    case "7":
        $img = $PATH_CONFIG["IMAGES_CLIENTES"] . "/" . $fileName;
        if (!is_file($img)) {
            $img = $PATH_CONFIG["IMAGES_DEFAULT"] . "/user.jpg";
        }
        break;
    case "8":
        $img = $PATH_CONFIG["IMAGES_PRODUCTOS"] . "/" . $fileName;
        if (!is_file($img)) {
            $img = $PATH_CONFIG["IMAGES_DEFAULT"] . "/agregarImagen.png";
        }
        break;
    default:
        throw new Exception("Option {$option}, no Found.");
}

header("Content-type: " . $mime);
echo file_get_contents($img);
?>