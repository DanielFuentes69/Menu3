<?php

//******************************************************************************
//Inclusiones obligatorias, primero el FrameWork y segundo el identificador de seguridad
//******************************************************************************
require("../../../config/config.inc.php");
$DOM["SECURITY_ID"] = array("MNTO_SLIDER");
//******************************************************************************
//******************************************************************************
//Carga el sistema de seguridad
//******************************************************************************
require("viewmanager/security.inc.php");
//******************************************************************************
//******************************************************************************
//Gestor de parámetros
//******************************************************************************
$Params = new Moon2_Params_Parameters();
$Params->verify("GET", false);
$msg = $Params->get_parameter("msg", "");
$Formulario = new Moon2_Forms_Form();
//******************************************************************************
//******************************************************************************
//Gestor de la página
//******************************************************************************
$Face = new Moon2_ViewManager_Controller();
$Face->set_bodyClass(" class=\"white-bg\"");
$Face->set_name("Agregar Imagen");
$Face->set_type("FLOAT");
$Face->set_sysmenu(false);
$Face->set_theme("inspinia");
//******************************************************************************
//******************************************************************************
//Despliegue de la página en xhtml
//******************************************************************************
echo $Face->open();
require($Face->getView());
echo $Face->close();
//******************************************************************************
?>