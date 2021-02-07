<?php

//*******************************************************************************
//Inclusiones obligatorias, primero el FrameWork y segundo el identificador de seguridad
//*******************************************************************************
require("../../../config/config.inc.php");
$DOM["SECURITY_ID"] = array("MNTO_PROM");
//*******************************************************************************
//*******************************************************************************
//Carga el sistema de seguridad
//*******************************************************************************
require("viewmanager/security.inc.php");
//*******************************************************************************
//*******************************************************************************
//Gestor de parámetros
//*******************************************************************************
$Params = new Moon2_Params_Parameters();
$Params->verify("GET", false);
$combo_campos = $Params->get_parameter("nomcampos", "0");
$caja_busqueda = $Params->get_parameter("buscar", "");
$msg = $Params->get_parameter("msg", "");
$order = $Params->get_parameter("order", 1);
$num_page = $Params->get_parameter("npage", 0);
$searchWords = $Params->get_parameter("Sw", "");
$searchOption = $Params->get_parameter("So", "");
$limit_numrows = $Params->get_parameter("nrows", 25);
$Formulario = new Moon2_Forms_Form();
$cod_perfil = $DOM["PROFILE_ID"];
//*******************************************************************************
//*******************************************************************************
//Gestor de la página
//*******************************************************************************
$Face = new Moon2_ViewManager_Controller();
$componente = $userFunc->getComponent("Gestionar Promociones");
$Face->set_name("Gestionar - Promociones");
$Face->set_component($componente);
$Face->add_javascript("../js/promociones.js");
$Face->set_type("INSIDE");
$Face->add_navigation("Promociones", "promociones_admin.php");
$Face->add_navigation("Listado Promociones", "#");
//*******************************************************************************
//*******************************************************************************
//creacion de objetos
//*******************************************************************************
$PromocionesFacade = new Modules_Webpage_Model_PromocionesFacade();
//*******************************************************************************
//*******************************************************************************
//Lógica del negocio
//*******************************************************************************
$rsNumRows = 0;
$Data = array();
$Data["order"] = "p.codpromocion";
$Data["search"][$combo_campos] = $caja_busqueda;
$PromocionesFacade->add_searchField($combo_campos, $caja_busqueda);
$filas = $PromocionesFacade->load_all($rsNumRows, $limit_numrows, $num_page, $Data);
$cantidad_filas = count($filas);
//*******************************************************************************
//*******************************************************************************
//Ejemplo para mensajes flotantes
//*******************************************************************************
$Face->floating_message($msg, $DOM["FMESSAGE"]["success"], "Operación Exitosa:", "El registro fue agregado con éxito");
$Face->floating_message($msg, $DOM["FMESSAGE"]["error"], "Error:", "El registro NO se pudo agregar");
$Face->floating_message($msg, 13, "Operación Exitosa:", "La imagen se agrego con exito.");
$Face->floating_message($msg, 11, "Operación Exitosa:", "El registro fue eliminado con éxito");
$Face->floating_message($msg, 33, "Error:", "El registro NO pudo ser eliminado");
$Face->floating_message($msg, 111, "Operación Exitosa:", "El registro fue Editado con éxito");
$Face->floating_message($msg, 333, "Error:", "El registro NO pudo ser Editado");
$Face->floating_message($msg, 35, "Error:", "La imagen no se pudo agregar.");
$Face->floating_message($msg, 31, "Error:", "Tipo de archivo no permitido.");
$Face->floating_message($msg, 21, "Operación Incompleta:", "Uy el archivo se cargo pero no se guardo en la base de datos.");
$Face->floating_message($msg, 345, "Error:", "El tamaño del archivo supera el limite permitido.");
$Face->floating_message($msg, 338, "Error:", "El archivo no pudo ser cargado.");
$Face->floating_message($msg, 396, "Error:", "La resolución de la imagen no es 900px * 400px.");
//*******************************************************************************
//*******************************************************************************
//Despliegue de la página en xhtml
//*******************************************************************************
echo $Face->open();
require($Face->getView());
echo $Face->close();
//*******************************************************************************
?>