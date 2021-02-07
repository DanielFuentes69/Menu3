<?php

//Inclusiones obligatorias, primero el FrameWork y segundo el identificador de seguridad
require("../../../config/config.inc.php");
$DOM["SECURITY_ID"] = array("MNTO_USU");

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
$paso = $Params->get_parameter("p", "1");
$Formulario = new Moon2_Forms_Form();
$Tabulador = new Moon2_Tabulator_Tab();
$ParamTab = new Moon2_Params_Parameters();
$order = $Params->get_parameter("order", 1);
$num_page = $Params->get_parameter("npage", 0);
$searchWords = $Params->get_parameter("Sw", "");
$searchOption = $Params->get_parameter("So", "");
$limit_numrows = $Params->get_parameter("nrows", 8);
$cod_usuario = $Params->get_parameter("codusuario", "0");
$UbicacionFacade = new Modules_Krauff_Model_UbicacionesFacade();
$perfil_usuario = $DOM["PROFILE_ID"];
//******************************************************************************
//*******************************************************************************
//Tabulador
//******************************************************************************
$pagina = "usuarios_editar.php?";
$ParamTab->add("p", "1");
$ParamTab->add("codusuario", $cod_usuario);
$urlKey1 = $ParamTab->keyGen();
$enlace1 = $pagina . $urlKey1;

$ParamTab->add("p", "2");
$ParamTab->add("codusuario", $cod_usuario);
$urlKey2 = $ParamTab->keyGen();
$enlace2 = $pagina . $urlKey2;

$ParamTab->add("p", "3");
$ParamTab->add("codusuario", $cod_usuario);
$urlKey3 = $ParamTab->keyGen();
$enlace3 = $pagina . $urlKey3;

$ParamTab->add("p", "4");
$ParamTab->add("codusuario", $cod_usuario);
$urlKey4 = $ParamTab->keyGen();
$enlace4 = $pagina . $urlKey4;

$Tabulador->set_selectedIndex($paso);
$Tabulador->add_item("Datos Basicos", $enlace1);
$Tabulador->add_item("Ubicación", $enlace2);
$Tabulador->add_item("Usuario - Contraseña", $enlace3);
$Tabulador->add_item("Foto", $enlace4);
//******************************************************************************
//******************************************************************************
//Obtencion de llave primaria
//******************************************************************************
$Usuario = new Modules_Krauff_Model_Usuarios();
$Usuario->set_codusuario($cod_usuario);
$FacadeUsuarios = new Modules_Krauff_Model_UsuariosFacade();
$FacadeUsuarios->loadOne($Usuario);
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
//Gestor de la página
//******************************************************************************
$Face = new Moon2_ViewManager_Controller();
$componente = $userFunc->getComponent("Usuarios");
$Face->set_name("Editar Usuario");
$Face->set_component($componente);
$Face->add_javascript("../js/usuarios_flotantes.js");
$Face->set_type("INSIDE");
$Face->set_sysmenu(true);
$Face->add_navigation("Configuración", "#");
$Face->add_navigation("Listado Usuarios", "usuarios_admin.php");
$Face->add_navigation("Edición", "#");
//******************************************************************************
//******************************************************************************
//combos utilizados en la logica de negocio
//******************************************************************************
$array_perfiles = array("" => "Seleccione perfil") + $arr_perfiles;
$array_tipodocumento = array("" => "Seleccione tipo documento") + $DOM["TIPODOC"];
$array_genero = array("" => "Seleccione genero") + $DOM["GENERO"];
//******************************************************************************
//******************************************************************************
//muestra la tupla de las ubicaciones
//******************************************************************************
$nombre_ubicacionhija = Moon2_Ubicacion_Ubicacionnombre::nombreUbicacion($Usuario->get_codubicacion());
$ubicacion_usuario = Moon2_Ubicacion_Ubicacionnombre::formatoUbicacion($Usuario->get_codubicacion(), $nombre_ubicacionhija, 1);
//******************************************************************************
//*******************************************************************************
//Ejemplo para mensajes flotantes
//*******************************************************************************
$Face->floating_message($msg, $DOM["FMESSAGE"]["success"], "Operación Exitosa:", "El registro fue agregado con éxito");
$Face->floating_message($msg, $DOM["FMESSAGE"]["error"], "Error:", "El registro NO se pudo agregar");
$Face->floating_message($msg, 11, "Operación Exitosa:", "El registro fue Eliminado con éxito");
$Face->floating_message($msg, 33, "Error:", "El registro NO pudo ser Eliminado");
$Face->floating_message($msg, 15, "Operación Exitosa:", "El registro fue Editado con éxito");
$Face->floating_message($msg, 37, "Error:", "El registro NO pudo ser Editado");
$Face->floating_message($msg, 12, "Operación Exitosa:", "El Usuario y la Contraseña se Asignaron con éxito");
$Face->floating_message($msg, 34, "Error:", "El Usuario y la Contraseña no pudo ser Asignada");
$Face->floating_message($msg, 13, "Operación Exitosa:", "La Imagen Fue Agregada Con Exito");
$Face->floating_message($msg, 35, "Error:", "La Imagen No Fue Agregada Con Exito");
$Face->floating_message($msg, 31, "Error:", "Tipo De Archivo No Permitido");
$Face->floating_message($msg, 21, "Operación Incompleta:", "El archivo fue cargado pero no fue grabado en la Base de Datos");
$Face->floating_message($msg, 14, "Operación Exitosa:", "La Ubicación Fue Agregada Con Exito");
$Face->floating_message($msg, 36, "Error:", "La Ubicación No Fue Agregada Con Exito");
$Face->floating_message($msg, 147, "Operación Exitosa:", "El parqueadero Se Asigno Correctamente al Usuario");
$Face->floating_message($msg, 335, "Error:", "El parqueadero No Se Asigno Correctamente al Usuario");
//*******************************************************************************
//*******************************************************************************
//Despliegue de la página en xhtml
//******************************************************************************
echo $Face->open();
require($Face->getView());
echo $Face->close();
//******************************************************************************
?>