<?php

//******************************************************************************
//Inclusiones obligatorias, primero el FrameWork y segundo el identificador de seguridad
//******************************************************************************
require("../../../config/config.inc.php");
$DOM["SECURITY_ID"] = array("MNTO_PRE");
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
$componente = $userFunc->getComponent("Gestionar Preguntas");
$Face->set_name("Crear - Preguntas");
$Face->set_component($componente);
$Face->set_type("INSIDE");
$Face->add_navigation("Página Web", "#");
$Face->add_navigation("Listado Preguntas Frecuentes", "preguntas_admin.php");
$Face->add_navigation("Crear Preguntas", "#");
//******************************************************************************
//******************************************************************************
//Despliegue de la página en xhtml
//******************************************************************************
echo $Face->open();
require($Face->getView());
echo $Face->close();
//******************************************************************************
?>