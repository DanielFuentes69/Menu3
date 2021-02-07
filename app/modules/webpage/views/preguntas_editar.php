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
$codPregunta = $Params->get_parameter("codpregunta", 0);
$Formulario = new Moon2_Forms_Form();
//******************************************************************************
//******************************************************************************
//creacion de objetos
//******************************************************************************
$Preguntas = new Modules_Webpage_Model_Preguntas();
$PreguntasFacade = new Modules_Webpage_Model_PreguntasFacade();
//******************************************************************************
//******************************************************************************
//muestra todo el registro de la pregunta deacuerdo a su codigo
//******************************************************************************
$Preguntas->set_codpregunta($codPregunta);
$PreguntasFacade->loadOne($Preguntas);
//******************************************************************************
//******************************************************************************
//Gestor de la página
//******************************************************************************
$Face = new Moon2_ViewManager_Controller();
$componente = $userFunc->getComponent("Gestionar Preguntas");
$Face->set_name("Editar - Preguntas");
$Face->set_component($componente);
$Face->set_type("INSIDE");
$Face->add_navigation("Página Web", "#");
$Face->add_navigation("Listado Preguntas Frecuentes", "preguntas_admin.php");
$Face->add_navigation("Editar Preguntas", "#");
//******************************************************************************
//******************************************************************************
//Despliegue de la página en xhtml
//******************************************************************************
echo $Face->open();
require($Face->getView());
echo $Face->close();
//******************************************************************************
?>