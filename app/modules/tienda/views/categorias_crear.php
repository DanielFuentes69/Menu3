<?php

require("../../../config/config.inc.php");
$DOM["SECURITY_ID"] = array("MNTO_CAT");
require("viewmanager/security.inc.php");


$Params = new Moon2_Params_Parameters();
$Params->verify("GET", false);
$msg = $Params->get_parameter("msg", "");


$Face = new Moon2_ViewManager_Controller();
$Face->set_bodyClass(" class=\"white-bg\"");
$Face->set_name("Crear Categoría");
$Face->set_type("FLOAT");
$Face->set_sysmenu(false);
$Face->set_theme("inspinia");


echo $Face->open();
require($Face->getView());
echo $Face->close();
?>