<?php

require("../../../config/config.inc.php");
$DOM["SECURITY_ID"] = array("MNTO_CAT");
require("viewmanager/security.inc.php");


$Params = new Moon2_Params_Parameters();
$Params->verify("GET", true);
$msg = $Params->get_parameter("msg", "");
$codPedido = $Params->get_parameter("codpedido", 1);


$Face = new Moon2_ViewManager_Controller();
$componente = $userFunc->getComponent("Pedidos");
$Face->set_name("Pedidos - Administrar");
$Face->set_component($componente);
$Face->set_type("INSIDE");
$Face->add_navigation("Tienda en línea", "#");
$Face->add_navigation("Pedidos", "pedidos_admin.php");
$Face->add_navigation("Detalle", "#");


$objPedido = new Modules_Tienda_Model_Pedidos();
$objPedido->set_codpedido($codPedido);


$pedidoFachada = new Modules_Tienda_Model_PedidosFacade();
$pedidoFachada->loadOne($objPedido);

$detallePedidoFachada = new Modules_Tienda_Model_DetallePedidosFacade();

$registros = $detallePedidoFachada->obtenerDetallePedido($codPedido);

echo $Face->open();
require($Face->getView());
echo $Face->close();
?>