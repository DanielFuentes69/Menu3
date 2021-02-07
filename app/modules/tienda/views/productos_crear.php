<?php

require("../../../config/config.inc.php");
$DOM["SECURITY_ID"] = array("MNTO_PRO");
require("viewmanager/security.inc.php");


$Params = new Moon2_Params_Parameters();
$Params->verify("GET", false);
$msg = $Params->get_parameter("msg", "");


$Tabulador = new Moon2_Tabulator_Tab();
$inactivo = true;
$Tabulador->set_externalData(true);
$Tabulador->set_selectedIndex(1);
$Tabulador->add_item("Datos Básicos");
$Tabulador->add_item("Precios", "", $inactivo);
$Tabulador->add_item("Imágenes", "", $inactivo);


$Face = new Moon2_ViewManager_Controller();
$componente = $userFunc->getComponent("Productos");
$Face->set_name("Crear producto");
$Face->set_component($componente);
$Face->set_type("INSIDE");
$Face->set_sysmenu(true);
$Face->add_navigation("Tienda en línea", "#");
$Face->add_navigation("Administrar productos", "productos_admin.php");
$Face->add_navigation("crear producto", "#");

$Face->floating_message($msg, 344, "Error:", "No se puede crear el <strong>producto</strong>");

echo $Face->open();
require($Face->getView());
echo $Face->close();
?>