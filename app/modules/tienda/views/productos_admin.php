<?php

require("../../../config/config.inc.php");
$DOM["SECURITY_ID"] = array("MNTO_PRO");
require("viewmanager/security.inc.php");


$Params = new Moon2_Params_Parameters();
$Params->verify("GET", false);


$msg = $Params->get_parameter("msg", "");
$order = $Params->get_parameter("order", 1);
$num_page = $Params->get_parameter("npage", 0);
$searchWords = $Params->get_parameter("Sw", "");
$searchOption = $Params->get_parameter("So", "");
$valorBuscar = $Params->get_parameter("buscar", "");
$limit_numrows = $Params->get_parameter("nrows", 10);
$columnaBusqueda = $Params->get_parameter("nomcampos", "0");


$Face = new Moon2_ViewManager_Controller();
$componente = $userFunc->getComponent("Productos");
$Face->set_name("Productos - Administrar");
$Face->set_component($componente);
$Face->set_type("INSIDE");
$Face->add_navigation("Tienda en línea", "#");
$Face->add_navigation("Administrar productos", "#");


$productosFachada = new Modules_Tienda_Model_ProductosFacade();
$rsNumRows = 0;
$Data = array();
$Data["order"] = "p.codproducto";
$Data["search"][$columnaBusqueda] = $valorBuscar;
$productosFachada->add_searchField($columnaBusqueda, $valorBuscar);
$filas = $productosFachada->load_all($rsNumRows, $limit_numrows, $num_page, $Data);


$Face->floating_message($msg, 122, "Operación Exitosa:", "El <strong>producto</strong> fue eliminado con éxito");
$Face->floating_message($msg, 322, "Error:", "No se puede eliminar el <strong>producto</strong> si tiene precios, imágenes o ha sido vendido");


echo $Face->open();
require($Face->getView());
echo $Face->close();
?>