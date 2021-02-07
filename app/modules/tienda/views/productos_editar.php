<?php

require("../../../config/config.inc.php");
$DOM["SECURITY_ID"] = array("MNTO_PRO");
require("viewmanager/security.inc.php");


$Params = new Moon2_Params_Parameters();
$Params->verify("GET", true);
$msg = $Params->get_parameter("msg", "");
$paso = $Params->get_parameter("p", "1");
$codProducto = $Params->get_parameter("codproducto", "");

$paso1 = new Moon2_Params_Parameters();
$paso1->add("codproducto", $codProducto);
$paso1->add("p", "1");
$urlPaso1 = $paso1->keyGen();

$paso2 = new Moon2_Params_Parameters();
$paso2->add("codproducto", $codProducto);
$paso2->add("p", "2");
$urlPaso2 = $paso2->keyGen();

$paso3 = new Moon2_Params_Parameters();
$paso3->add("codproducto", $codProducto);
$paso3->add("p", "3");
$urlPaso3 = $paso3->keyGen();


$Tabulador = new Moon2_Tabulator_Tab();
$inactivo = false;
$Tabulador->set_selectedIndex($paso);
$Tabulador->add_item("Datos Básicos", "productos_editar.php?{$urlPaso1}");
$Tabulador->add_item("Precios", "productos_editar.php?{$urlPaso2}");
$Tabulador->add_item("Imágenes", "productos_editar.php?{$urlPaso3}");


$Face = new Moon2_ViewManager_Controller();
$componente = $userFunc->getComponent("Productos");
$Face->set_name("Crear producto");
$Face->set_component($componente);
$Face->set_type("INSIDE");
$Face->set_sysmenu(true);
$Face->add_navigation("Tienda en línea", "#");
$Face->add_navigation("Administrar productos", "productos_admin.php");
$Face->add_navigation("Editar producto", "#");

$Face->floating_message($msg, 131, "Operación Exitosa:", "El <strong>PRECIO</strong> fue creado con éxito");
$Face->floating_message($msg, 137, "Operación Exitosa:", "El <strong>precio</strong> fue ACTUALIZADO con éxito");
$Face->floating_message($msg, 144, "Operación Exitosa:", "El <strong>producto</strong> fue creado con éxito");
$Face->floating_message($msg, 164, "Operación Exitosa:", "El <strong>producto</strong> fue actualizado con éxito");
$Face->floating_message($msg, 135, "Operación Exitosa:", "La imagen del producto fue ELIMINADA correctamente");
$Face->floating_message($msg, 183, "Operación Exitosa:", "La imagen del producto fue cargada correctamente");
$Face->floating_message($msg, 139, "Operación Exitosa:", "El precio fue eliminado correctamente");
$Face->floating_message($msg, 364, "Error:", "No se puede actualizar el <strong>producto</strong>");
$Face->floating_message($msg, 383, "Error:", "No se puede crear la imagen en Web Files");
$Face->floating_message($msg, 393, "Error:", "No se puede crear el registro");
$Face->floating_message($msg, 335, "Error:", "No se puede eliminar la imagen del producto");
$Face->floating_message($msg, 339, "Error:", "No se puede eliminar el precio del producto");
$Face->floating_message($msg, 331, "Error:", "No se puede crear el precio del producto");
$Face->floating_message($msg, 337, "Error:", "No se puede ACTUALIZAR el precio del producto");

echo $Face->open();
require($Face->getView());
echo $Face->close();
?>