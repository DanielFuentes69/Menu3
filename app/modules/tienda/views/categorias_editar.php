<?php

require("../../../config/config.inc.php");
$DOM["SECURITY_ID"] = array("MNTO_CAT");
require("viewmanager/security.inc.php");


$Params = new Moon2_Params_Parameters();
$Params->verify("GET", true);
$msg = $Params->get_parameter("msg", "");
$codCategoria = $Params->get_parameter("codcategoria", "0");


$Face = new Moon2_ViewManager_Controller();
$Face->set_name("Actualizar categoría");
$Face->set_type("FLOAT");
$Face->set_sysmenu(false);
$Face->set_theme("inspinia");


echo $Face->open();
require($Face->getView());
echo $Face->close();
?>