<?php
if (!isset($DOM["SECURITY_ID"])) {
    echo "<h1>MOON2 Message:<br />Can not call view, requires the view controller</h1>";
    exit();
}

$formulario = new Moon2_Forms_Form();
$categoriasFachada = new Modules_Tienda_Model_CategoriasFacade();
$arrCategorias = $categoriasFachada->obtenerCategorias();
$arrCategoriasFinal = array("" => "Seleccione la categoria") + $arrCategorias;

$objProducto = new Modules_Tienda_Model_Productos();
$objProducto->set_codproducto($codProducto);

$productosFachada = new Modules_Tienda_Model_ProductosFacade();
$productosFachada->loadOne($objProducto);

$arrImagenes = $productosFachada->obtenerImagenes($codProducto);

$objParams = new Moon2_Params_Parameters();
$objParams->add("codproducto", $codProducto);
$objParams->add("p", "3");
$urlImagenes = $objParams->keyGen();

$objParamsPrecios = new Moon2_Params_Parameters();
$objParamsPrecios->add("codproducto", $codProducto);
$objParamsPrecios->add("p", "2");
$urlPrecios = $objParamsPrecios->keyGen();

$arrPrecios = $productosFachada->obtenerNombrePrecios($codProducto);
?>
<form id="frmDatosBasicos" method="post" action="moon2.php" onSubmit="javascript:return managedProccess(this);">
    <input type="hidden" id="codproducto" name="codproducto" value="<?php echo $codProducto; ?>" />
    <input type="hidden" id="action" name="action" value="actualizar" />
    <input type="hidden" id="controller" name="controller" value="tienda/productoscontroller" />
    <div class="row">
        <div class="col-sm-6 b-r">
            <div class="form-group">
                <label>Categoría</label>
                <?php echo $formulario->addObject("MenuList", "codcategoria", $arrCategoriasFinal, $objProducto->get_codcategoria(), "class='form-control input-sm' tabindex='1' style='cursor: pointer; width: 100%;'"); ?>
            </div>

            <div class="form-group">
                <label>Nombre producto</label>
                <input type="text" class="form-control input-sm" id="nombreproducto" name="nombreproducto" tabindex="2" value="<?php echo $objProducto->get_nombreproducto(); ?>"/>
            </div>

            <div class="form-group">
                <label>Referencia</label>
                <input type="text" class="form-control input-sm" id="referencia" name="referencia" tabindex="3" value="<?php echo $objProducto->get_referencia(); ?>"/>
            </div>

            <div class="form-group">
                <label>Iva</label>
                <input type="number" class="form-control input-sm" id="iva" name="iva" tabindex="4" value="<?php echo $objProducto->get_iva(); ?>"/>
            </div>

            <div class="form-group">
                <label>Descripción</label>
                <textarea class="form-control input-sm" id="descripcion" name="descripcion" tabindex="5" rows="5"><?php echo $objProducto->get_descripcion(); ?></textarea>
            </div>
        </div>

        <div class="col-sm-6">
            <?php
            $cantidadPrecios = count($arrPrecios);
            if ($cantidadPrecios == 0) {
                ?>
                <div class="alert alert-warning">
                    Advertencia: El producto no tiene precios asociados.<br /><a class="alert-link" href="productos_editar.php?<?php echo $urlPrecios; ?>">Clic aquí para agregar precios</a>.
                </div>
                <?php
            } else {
                echo "<div class=\"alert alert-info\">\n";
                echo "El producto tiene <strong>{$cantidadPrecios}</strong> precios asociados.<br /><a class=\"alert-link\" href=\"productos_editar.php?{$urlPrecios}\">Clic aquí para ver los precios</a>\n";
                echo "</div>\n";
            }
            ?>
            <?php
            $cantidadImagenes = count($arrImagenes);
            if ($cantidadImagenes == 0) {
                ?>
                <div class="alert alert-warning">
                    Advertencia: El producto no tiene imágenes asociadas.<br /><a class="alert-link" href="productos_editar.php?<?php echo $urlImagenes; ?>">Clic aquí para agregar imágenes</a>.
                </div>
                <?php
            } else {
                echo "<div class=\"alert alert-info\">\n";
                echo "El producto tiene <strong>{$cantidadImagenes}</strong> imagenes cargadas.<br /><a class=\"alert-link\" href=\"productos_editar.php?{$urlPrecios}\">Clic aquí para ver las imagenes</a>\n";
                echo "</div>\n";
            }
            ?>
        </div>
    </div>
    <div class="modal-footer">
        <button class="btn btn-success" type="submit" tabindex="50">Guardar</button>
    </div>
</form>

<script type="text/javascript">
    $("#codcategoria").focus();
    $(function () {
        $("#frmDatosBasicos").validate({
            rules: {
                codcategoria: "required",
                nombreproducto: "required",
                referencia: "required",
                descripcion: "required",
                iva: "required"
            },
            messages: {
                codcategoria: "Seleccione la categoría del producto",
                nombreproducto: "Nombre del producto es requerido",
                referencia: "Referencia es requerida",
                descripcion: "Breve descripción",
                iva: "El valor del iva es requerido"
            }
        });
    });
</script>