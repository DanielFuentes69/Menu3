<?php

session_start();
session_unset();
session_destroy();
//*****************************************************************************************
//Inclusiones obligatorias, primero el FrameWork y segundo el identificador de seguridad
//*****************************************************************************************
require("../../../config/config.inc.php");
$id_security = array("*");
//*****************************************************************************************
//******************************************************************************
//Creación de Objetos
//******************************************************************************
$Face = new Moon2_ViewManager_Controller();
$Params = new Moon2_Params_Parameters();
//******************************************************************************
//******************************************************************************
//Gestor de parámetros
//******************************************************************************
$Params->verify("GET", false);
$msg = $Params->get_parameter("msg", 0);
//*****************************************************************************************
//Gestor de la página
//*****************************************************************************************
$Face->set_sysmenu(true);
$Face->set_type("FRONTEND");
$Face->set_name("Agrocenter Company SAS, Maquinaria Agrícola, Repuestos Estacionarias, Repuestos Fumigadoras, Repuestos Motores, Repuestos Guadañadoras, Repuestos Motosierras, Repuestos Cortasetos, Respuestos Motor Diesel, Accesorios Cultivador");
$Face->set_theme("frontend");
//*****************************************************************************************
//*****************************************************************************************  
//Despliegue de la página en xhtml
//*****************************************************************************************
echo $Face->openFrontend();
require($Face->getView());
echo $Face->close();
//*****************************************************************************************
?>