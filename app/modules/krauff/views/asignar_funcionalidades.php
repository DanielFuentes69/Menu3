<?php
//******************************************************************************
//Inclusiones obligatorias, primero el FrameWork y segundo el identificador de seguridad
//******************************************************************************
require("../../../config/config.inc.php");
$DOM["SECURITY_ID"] = array("MNTO_USU");
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
$Params->verify("GET",false);
$msg = $Params->get_parameter("msg", "");
$cod_usuario = $Params->get_parameter("codusuario", "");
$Formulario = new Moon2_Forms_Form();
//******************************************************************************

//******************************************************************************
//Gestor de la página
//******************************************************************************
$Face = new Moon2_ViewManager_Controller();
$componente = $userFunc->getComponent("Usuarios");
$Face->set_name("Asignar Funcionalidades");
$Face->set_component($componente);
$Face->add_javascript("../js/funcionalidades.js");
$Face->set_type("INSIDE");
$Face->set_sysmenu(true);
$Face->add_navigation("Configuración", "#");
$Face->add_navigation("Listado de Usuarios", "usuarios_admin.php");
$Face->add_navigation("Asignar Funcionalidades", "#");
//******************************************************************************

//******************************************************************************
//creacion de objetos
//******************************************************************************
$Funcionalidades = new Modules_Krauff_Model_Funcionalidades();
$FuncionalidadesFacade = new Modules_Krauff_Model_FuncionalidadesFacade();
$FacadeUsuarios = new Modules_Krauff_Model_UsuariosFacade();
$Usuario = new Modules_Krauff_Model_Usuarios();
//******************************************************************************

//******************************************************************************
//muestra todas las funcionalidades del sistema
//******************************************************************************
$array_funcionalidades = $FuncionalidadesFacade->obtener_nodo_simple($DOM["FUNCIONALIDADESSISTEMA"]["MENU_SYSTEM_MOON"]);
//******************************************************************************

//******************************************************************************
//muestra todo el registro deacuerdo al codigo del usuario
//******************************************************************************
$Usuario->set_codusuario($cod_usuario);
$FacadeUsuarios->loadOne($Usuario);
$nombres_completousuario = $Usuario->get_nombres() . " " . $Usuario->get_primerapellido() . " " . $Usuario->get_segundoapellido();
//******************************************************************************

//******************************************************************************
//mensajes flotantes
//******************************************************************************
$Face->floating_message($msg, 366, "Error:", "La Cuenta No Tiene Fondos Suficientes");
//******************************************************************************

//******************************************************************************
//Despliegue de la página en xhtml
//******************************************************************************
echo $Face->open();
require($Face->getView());
echo $Face->close();
//******************************************************************************
?>