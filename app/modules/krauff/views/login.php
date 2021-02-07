<?php

session_start();
session_unset();
session_destroy();
require("../../../config/config.inc.php");
$id_security = array("EVADOC_EVA_REA");

//***********************************************
$Face = new Moon2_ViewManager_Controller();
$Face->set_sysmenu(false);
$Face->set_name("Intranet Agrocenter SAS");
$Face->set_type("LOGUEO");
$Face->set_theme("login");
$Face->add_javascript("../js/login.js");
$Face->add_javascript("../js/md5-min.js");

echo $Face->openLogin();
require($Face->getView());
echo $Face->close();
?>