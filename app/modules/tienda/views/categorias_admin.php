<?php

require("../../../config/config.inc.php");
$DOM["SECURITY_ID"] = array("MNTO_CAT");
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
$componente = $userFunc->getComponent("Categorias");
$Face->set_name("Categorías - Administrar");
$Face->set_component($componente);
$Face->set_type("INSIDE");
$Face->add_navigation("Tienda en línea", "#");
$Face->add_navigation("Administrar categorías", "#");


$categoriasFachada = new Modules_Tienda_Model_CategoriasFacade();
$rsNumRows = 0;
$Data = array();
$Data["order"] = "c.codcategoria";
$Data["search"][$columnaBusqueda] = $valorBuscar;
$categoriasFachada->add_searchField($columnaBusqueda, $valorBuscar);
$filas = $categoriasFachada->load_all($rsNumRows, $limit_numrows, $num_page, $Data);


$Face->floating_message($msg, 122, "Operación Exitosa:", "La categoría fue eliminada con éxito");
$Face->floating_message($msg, 144, "Operación Exitosa:", "La categoría fue creada con éxito");
$Face->floating_message($msg, 164, "Operación Exitosa:", "La categoría fue actualizada con éxito");
$Face->floating_message($msg, 322, "Error:", "No se puede eliminar la categoría si tiene productos asociados");
$Face->floating_message($msg, 344, "Error:", "No se puede crear la categoría");
$Face->floating_message($msg, 364, "Error:", "No se puede actualizar la categoría");


echo $Face->open();
require($Face->getView());
echo $Face->close();
?>