<?php

//***************************************************************************************
//Inclusiones obligatorias, primero el FrameWork y segundo el identificador de seguridad
//***************************************************************************************
require("../../../config/config.inc.php");
$DOM["SECURITY_ID"] = array("MNTO_USU");
//***************************************************************************************
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
$Tabulador = new Moon2_Tabulator_Tab();
$perfil_usuario = $DOM["PROFILE_ID"];
//******************************************************************************
//******************************************************************************
//Tabulador
//******************************************************************************
$inactivo = true;
$Tabulador->set_externalData(true);
$Tabulador->set_selectedIndex(1);
$Tabulador->add_item("Datos Basicos");
$Tabulador->add_item("Ubicación", "", $inactivo);
$Tabulador->add_item("Usuario - Contraseña", "", $inactivo);
$Tabulador->add_item("Foto", "", $inactivo);
//******************************************************************************
//******************************************************************************
//Gestor de la página
//******************************************************************************
$Face = new Moon2_ViewManager_Controller();
$componente = $userFunc->getComponent("Usuarios");
$Face->set_name("Crear Usuario");
$Face->set_component($componente);
$Face->add_javascript("../js/usuarios_flotantes.js");
$Face->set_type("INSIDE");
$Face->set_sysmenu(true);
$Face->add_navigation("General", "#");
$Face->add_navigation("Listado Usuarios", "usuarios_admin.php");
$Face->add_navigation("Creación", "#");
//******************************************************************************
//******************************************************************************
//creacion de objetos
//******************************************************************************
$FacadePerfiles = new Modules_Krauff_Model_PerfilesFacade();
//******************************************************************************
//******************************************************************************
//Combo de perfiles
//******************************************************************************
$FacadePerfil = new Modules_Krauff_Model_PerfilesFacade();
if ($perfil_usuario == $DOM["PERFILES"]["ADMINISTRADOR"]) {
    $arr_perfiles = $FacadePerfil->comboPerfilesadm();
} else {
    $arr_perfiles = $FacadePerfil->comboperfiles();
}
//******************************************************************************
//******************************************************************************
//combos utilizados en la logica de negocio
//******************************************************************************
$array_perfiles = array("" => "Seleccione perfil") + $arr_perfiles;
$array_tipodocumento = array("" => "Seleccione tipo documento") + $DOM["TIPODOC"];
$array_genero = array("" => "Seleccione genero") + $DOM["GENERO"];
//******************************************************************************
//******************************************************************************
//Despliegue de la página en xhtml
//******************************************************************************
echo $Face->open();
require($Face->getView());
echo $Face->close();
//******************************************************************************
?>