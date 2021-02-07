<?php

session_start();
session_unset();
session_destroy();
require("../../../config/config.inc.php");
$id_security = array("*");


$Params = new Moon2_Params_Parameters();
$Face = new Moon2_ViewManager_Controller();
$fachadaCategorias = new Modules_Tienda_Model_CategoriasFacade();
$productosFachada = new Modules_Tienda_Model_ProductosFacade();


$Params->verify("GET", false);
$msg = $Params->get_parameter("msg", "");


$Face->set_sysmenu(true);
$Face->set_type("FRONTEND");
$Face->set_name("Agrocenter Company SAS, Maquinaria Agrícola, Repuestos Estacionarias, Repuestos Fumigadoras, Repuestos Motores, Repuestos Guadañadoras, Repuestos Motosierras, Repuestos Cortasetos, Respuestos Motor Diesel, Accesorios Cultivador");
$Face->set_theme("frontend");
$Face->add_javascript("../js/addClient.js");


$Face->floating_message($msg, '155', "Operación Exitosa:", "Los datos se enviaron correctamente.");


echo $Face->openFrontend();
require($Face->getView());
echo $Face->close();
?>