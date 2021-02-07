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
$NoticiasFacade = new Modules_Webpage_Model_NoticiasFacade();
//******************************************************************************
//******************************************************************************
//Gestor de parámetros
//******************************************************************************
$Params->verify("GET", false);
$msg = $Params->get_parameter("msg", "");
$order = $Params->get_parameter("order", 1);
$num_page = $Params->get_parameter("npage", 0);
$searchWords = $Params->get_parameter("Sw", "");
$searchOption = $Params->get_parameter("So", "");
$limit_numrows = $Params->get_parameter("nrows", 15);
$tipoNoticia = $Params->get_parameter("tipo", -1);
//*****************************************************************************************
//Gestor de la página
//*****************************************************************************************
$Face->set_sysmenu(true);
$Face->set_type("FRONTEND");
$Face->set_name("Agrocenter Company SAS, Maquinaria Agrícola, Repuestos Estacionarias, Repuestos Fumigadoras, Repuestos Motores, Repuestos Guadañadoras, Repuestos Motosierras, Repuestos Cortasetos, Respuestos Motor Diesel, Accesorios Cultivador");
$Face->set_theme("frontend");
//*****************************************************************************************
//*******************************************************************************
//Lógica del negocio
//*******************************************************************************
$rsNumRows = 0;
$Data = array();
$Data["order"] = "n.codnoticia";
if ($tipoNoticia != -1) {
    $NoticiasFacade->add_searchField("n.tipo", $tipoNoticia, "EQUAL");
}
$filas = $NoticiasFacade->load_all($rsNumRows, $limit_numrows, $num_page, $Data);
$cantidad_filas = count($filas);
//*******************************************************************************
//*******************************************************************************
//Ejemplo para mensajes flotantes
//*******************************************************************************
$Face->floating_message($msg, $DOM["FMESSAGE"]["success"], "Operación Exitosa:", "Los datos se enviaron correctamente.");
//*******************************************************************************
//*****************************************************************************************  
//Despliegue de la página en xhtml
//*****************************************************************************************
echo $Face->openFrontend();
require($Face->getView());
echo $Face->close();
//*****************************************************************************************
?>