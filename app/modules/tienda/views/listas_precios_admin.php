<?php

require("../../../config/config.inc.php");
$DOM["SECURITY_ID"] = array("MNTO_LPRE");
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
$componente = $userFunc->getComponent("Listas Precios");
$Face->set_name("Listas de precios - Administrar");
$Face->set_component($componente);
$Face->set_type("INSIDE");
$Face->add_navigation("Tienda en línea", "#");
$Face->add_navigation("Listas de precios", "#");


$listaPrecioFachada = new Modules_Tienda_Model_ListasPreciosFacade();
$rsNumRows = 0;
$Data = array();
$Data["order"] = "lp.codlistaprecio";
$Data["search"][$columnaBusqueda] = $valorBuscar;
$listaPrecioFachada->add_searchField($columnaBusqueda, $valorBuscar);
$filas = $listaPrecioFachada->load_all($rsNumRows, $limit_numrows, $num_page, $Data);


$Face->floating_message($msg, 122, "Operación Exitosa:", "La lista de precios fue eliminada con éxito");
$Face->floating_message($msg, 144, "Operación Exitosa:", "La lista de precios fue creada con éxito");
$Face->floating_message($msg, 164, "Operación Exitosa:", "La lista de precios fue actualizada con éxito");
$Face->floating_message($msg, 322, "Error:", "No se puede eliminar la lista de precio si ha sido utilizada");
$Face->floating_message($msg, 344, "Error:", "No se puede crear la lista de precios");
$Face->floating_message($msg, 364, "Error:", "No se puede actualizar la lista de precios");


echo $Face->open();
require($Face->getView());
echo $Face->close();
?>