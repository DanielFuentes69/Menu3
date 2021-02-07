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
$codCategoria = $Params->get_parameter("codcategoria", "0");

$order = $Params->get_parameter("order", 1);
$num_page = $Params->get_parameter("npage", 0);
$searchWords = $Params->get_parameter("Sw", "");
$searchOption = $Params->get_parameter("So", "");
$valorBuscar = $Params->get_parameter("buscar", "");
$limit_numrows = $Params->get_parameter("nrows", 9);
$columnaBusqueda = $Params->get_parameter("nomcampos", "0");


$arregloCategorias = $fachadaCategorias->obtenerCategorias();
$rsNumRows = 0;
$Data = array();
$Data["order"] = "p.codproducto";
$Data["search"][$columnaBusqueda] = $valorBuscar;
$productosFachada->add_searchField($columnaBusqueda, $valorBuscar);
$estilo = "";
if (!empty($codCategoria) && empty($valorBuscar)) {
    $productosFachada->add_searchField("p.codcategoria", $codCategoria);
}
if (!empty($valorBuscar)){
    $productosFachada->add_searchField("p.nombreproducto", $valorBuscar);
}
$arregloProductos = $productosFachada->load_all($rsNumRows, $limit_numrows, $num_page, $Data);

//echo "<pre>";
//print_r($arregloProductos);
//echo "</pre>";

$Face->set_sysmenu(true);
$Face->add_javascript("../js/addPro.js");
$Face->add_javascript("../js/delPro.js");
$Face->set_type("FRONTEND");
$Face->set_name("Agrocenter Company SAS, Maquinaria Agrícola, Repuestos Estacionarias, Repuestos Fumigadoras, Repuestos Motores, Repuestos Guadañadoras, Repuestos Motosierras, Repuestos Cortasetos, Respuestos Motor Diesel, Accesorios Cultivador");
$Face->set_theme("frontend");



$Face->floating_message($msg, '155', "Operación Exitosa:", "Los datos se enviaron correctamente.");


echo $Face->openFrontend();
require($Face->getView());
echo $Face->close();
?>