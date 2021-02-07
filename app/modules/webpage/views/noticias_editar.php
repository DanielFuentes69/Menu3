<?php

//******************************************************************************
//Inclusiones obligatorias, primero el FrameWork y segundo el identificador de seguridad
//******************************************************************************
require("../../../config/config.inc.php");
$DOM["SECURITY_ID"] = array("MNTO_BLOG");
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
$codNoticia = $Params->get_parameter("codnoticia", 0);
$Formulario = new Moon2_Forms_Form();
//******************************************************************************
//******************************************************************************
//creacion de objetos
//******************************************************************************
$Noticias = new Modules_Webpage_Model_Noticias();
$NoticiasFacade = new Modules_Webpage_Model_NoticiasFacade();
//******************************************************************************
//******************************************************************************
//muestra todo el registro de la noticia
//******************************************************************************
$Noticias->set_codnoticia($codNoticia);
$NoticiasFacade->loadOne($Noticias);
//******************************************************************************
//******************************************************************************
//Gestor de la página
//******************************************************************************
$Face = new Moon2_ViewManager_Controller();
$componente = $userFunc->getComponent("Gestionar Blog");
$Face->set_name("Editar - Blog");
$Face->set_component($componente);
$Face->set_type("INSIDE");
$Face->add_navigation("Página Web", "#");
$Face->add_navigation("Listado Blog", "noticias_admin.php");
$Face->add_navigation("Editar Blog", "#");
//******************************************************************************
//******************************************************************************
//Despliegue de la página en xhtml
//******************************************************************************
echo $Face->open();
require($Face->getView());
echo $Face->close();
//******************************************************************************
?>