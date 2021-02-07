<?php

//*******************************************************************************
//Inclusiones obligatorias, primero el FrameWork y segundo el identificador de seguridad
//*******************************************************************************
require("../../../config/config.inc.php");
$DOM["SECURITY_ID"] = "*";
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
$msg = $Params->get_parameter("msg", "");
$cod_usuario = $DOM["USER_ID"];
$Formulario = new Moon2_Forms_Form();
$FacadeUsuarios = new Modules_Krauff_Model_UsuariosFacade();
$FacadeAccesos = new Modules_Krauff_Model_AccesosFacade();
//*******************************************************************************
//*******************************************************************************
//TRAE TODA LA FILA CORRESPONDIENTE AL CODIGO DEL USUARIO 
//*******************************************************************************
$Usuario = new Modules_Krauff_Model_Usuarios();
$Usuario->set_codusuario($cod_usuario);
$Usuario = $FacadeUsuarios->loadOne($Usuario);
//*******************************************************************************
//*******************************************************************************
//TRAE TODA LA INFORMAION DE LA TABLA ACCESSOS DEACUERDO AL USUARIO
//*******************************************************************************
$registros_accesos = $FacadeAccesos->consultar_registros_accessos($cod_usuario);
//*******************************************************************************
//*******************************************************************************
//TRAE EL TOTAL DE ACCESOS AL SISTEMA DEPENDIENDO EL USUARIO
//*******************************************************************************
$cantidad_accesos = $FacadeAccesos->contar_registros_accessos($cod_usuario);
//*******************************************************************************
//*******************************************************************************
//TRAE LOS DATOS DEL ULTIMO ACCESO AL SISTEMA DEPENDIENDO DEL USAURIO
//*******************************************************************************
$ultimo_acceso_sistema = $FacadeAccesos->ultimo_acceso_sistema($cod_usuario);
//*******************************************************************************
//*******************************************************************************
//REGISTROS DE LA TABLA ACCESOS
//*******************************************************************************
$Accesos = new Modules_Krauff_Model_Accesos();
$Accesos->set_codacceso($ultimo_acceso_sistema);
$Accesos = $FacadeAccesos->loadOne($Accesos);
//*******************************************************************************
//*******************************************************************************
//Gestor de la página
//*******************************************************************************
$Face = new Moon2_ViewManager_Controller();
$Face->set_name("Perfil del Usuario");
$Face->add_javascript("../js/perfilusuario.js");
$Face->set_type("INSIDE");
$Face->add_navigation("Inicio", "../../main/views/index.php");
$Face->add_navigation("Perfil", "#");
//*******************************************************************************
//*******************************************************************************
//Ejemplo para mensajes flotantes
//*******************************************************************************
$Face->floating_message($msg, $DOM["FMESSAGE"]["success"], "Operación Exitosa:", "El registro fue agregado con éxito");
$Face->floating_message($msg, $DOM["FMESSAGE"]["error"], "Error:", "El registro NO se pudo agregar");
$Face->floating_message($msg, 11, "Operación Exitosa:", "El registro fue eliminado con éxito");
$Face->floating_message($msg, 13, "Operación Exitosa:", "La Imagen Fue Agregada Con Exito");
$Face->floating_message($msg, 34, "Error:", "El tamaño del archivo supera el limite permitido");
$Face->floating_message($msg, 31, "Error:", "Tipo De Archivo No Permitido");
$Face->floating_message($msg, 21, "Operación Incompleta:", "El archivo fue cargado pero no fue grabado en la Base de Datos");
$Face->floating_message($msg, 33, "Error:", "El registro NO pudo ser eliminado");
$Face->floating_message($msg, 1, "Operación Exitosa:", "El registro fue actualizado con éxito");
$Face->floating_message($msg, 3, "Error:", "El registro NO pudo ser actualizado");
//*******************************************************************************
//*******************************************************************************
//Despliegue de la página en xhtml
//*******************************************************************************
echo $Face->open();
require($Face->getView());
echo $Face->close();
//*******************************************************************************
?>