<?php

require("../../../config/config.inc.php");
$DOM["SECURITY_ID"] = array("MNTO_PRO");
require("viewmanager/security.inc.php");


$Params = new Moon2_Params_Parameters();
$Params->verify("GET", true);
$msg = $Params->get_parameter("msg", "");
$codProducto = $Params->get_parameter("codproducto", "");
$codListaPrecio = $Params->get_parameter("codlistaprecio", "");


$Face = new Moon2_ViewManager_Controller();
$Face->set_bodyClass(" class=\"white-bg\"");
$Face->set_name("Crear precio");
$Face->set_type("FLOAT");
$Face->set_sysmenu(false);
$Face->set_theme("inspinia");


echo $Face->open();
require($Face->getView());
echo $Face->close();
?>