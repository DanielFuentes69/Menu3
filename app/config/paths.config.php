<?php

//******************************************************************************
// Base path system = $PATH_CONFIG["APP"]
//******************************************************************************
//******************************************************************************
// Root folder for attachments
//******************************************************************************
//$rootFolder = "/home/agrocent/web_files";
$rootFolder = "/web_files";
$PATH_CONFIG["WEBFILES"] = $rootFolder;
$PATH_CONFIG["NAMESITE"] = $_SERVER['PHP_SELF'];
//******************************************************************************
//******************************************************************************
// Examples of folders to attach
//******************************************************************************
$PATH_CONFIG["MOON_GEN"] = $PATH_CONFIG["WEBFILES"] . "/moongen2";
$PATH_CONFIG["RECURSOS"] = $PATH_CONFIG["WEBFILES"] . "/recursos";
//******************************************************************************
//******************************************************************************
//plataforma intranet fdc 
//******************************************************************************
$PATH_CONFIG["IMAGES_PERFIL"] = $PATH_CONFIG["WEBFILES"] . "/webpage/perfil/images";
$PATH_CONFIG["IMAGES_PRODUCTOS"] = $PATH_CONFIG["WEBFILES"] . "/webpage/productos/images";
$PATH_CONFIG["IMAGES_SLIDERMAIN"] = $PATH_CONFIG["WEBFILES"] . "/webpage/slidermain/img";
$PATH_CONFIG["IMAGES_TEAM"] = $PATH_CONFIG["WEBFILES"] . "/webpage/team/img";
$PATH_CONFIG["IMAGES_NOTICIAS"] = $PATH_CONFIG["WEBFILES"] . "/webpage/noticias/img";
$PATH_CONFIG["IMAGES_PROMOCIONES"] = $PATH_CONFIG["WEBFILES"] . "/webpage/promociones/img";
$PATH_CONFIG["IMAGES_CLIENTES"] = $PATH_CONFIG["WEBFILES"] . "/webpage/clientes/img";
$PATH_CONFIG["SOPORTES_PAGO"] = $PATH_CONFIG["WEBFILES"] . "/webpage/soportespago";
$PATH_CONFIG["IMAGES_DEFAULT"] = "../../../images";
//******************************************************************************
//******************************************************************************
// Basic paths for the framework
//******************************************************************************
$PATH_CONFIG["ROOT"]["moon"] = $bug . $PATH_CONFIG["APP"] . "moon2";
$PATH_CONFIG["ROOT"]["search"] = $bug . $PATH_CONFIG["APP"] . "moon2/search";
$PATH_CONFIG["ROOT"]["modules"] = $bug . $PATH_CONFIG["APP"] . "modules";
$PATH_CONFIG["ROOT"]["javascripts"] = $bug . $PATH_CONFIG["APP"] . "moon2/javas";
$PATH_CONFIG["MAINPAGE"] = $PATH_CONFIG["ROOT"]["modules"] . "/main";
$PATH_CONFIG["QUIT"] = $PATH_CONFIG["ROOT"]["modules"] . "/krauff/views";
//******************************************************************************
//******************************************************************************
//$PATH_CONFIG["ROOT"]["processform"] = $PATH_CONFIG["ROOT"]["moon"]."/viewmanager";
////******************************************************************************
//en revision 1
$PATH_CONFIG["ROOT"]["treeview"] = "moon2/treeview";
$PATH_CONFIG["ROOT"]["hidelayer"] = "moon2/hidelayer";
$PATH_CONFIG["ROOT"]["messagebox"] = "moon2/messagebox";
$PATH_CONFIG["ROOT"]["calendar"] = "moon2/calendar/src";
$PATH_CONFIG["ROOT"]["timer"] = "moon2/datetime/timepicker";
//en revision 1
//******************************************************************************
?>