<?php
if (!isset($DOM["SECURITY_ID"])) {
    echo "<h1>MOON2 Message:<br />Can not call view, requires the view controller</h1>";
    exit();
}

$formulario = new Moon2_Forms_Form();
$listasPreciosFachada = new Modules_Tienda_Model_ListasPreciosFacade();
$arrListasPrecios = $listasPreciosFachada->obtenerListasPreciosDisponibles($codProducto, $DOM["ESTADOLISTASPRECIOS_TXT"]["ACTIVO"]);
$arrListasPreciosFinal = array("" => "Seleccione la lista") + $arrListasPrecios;
?>
<form id="frmCategoria" name="frmCategoria" method="post" action="moon2.php" onSubmit="javascript:return managedProccess(this);" class="form-horizontal">       
    <input type="hidden" id="action" name="action" value="crearPrecio"/>
    <input type="hidden" id="codproducto" name="codproducto" value="<?php echo $codProducto; ?>"/>
    <input type="hidden" id="controller" name="controller" value="tienda/productoscontroller" />

    <div class="col-lg-12">
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Listas disponibles</label>
                    <?php echo $formulario->addObject("MenuList", "codlistaprecio", $arrListasPreciosFinal, "", "tabindex=\"1\" class='form-control input-sm' style='cursor:pointer;'") ?>
                </div>
                <div class="form-group">
                    <label>Precio del producto</label>
                    <input type="text" class="form-control input-sm" id="valor" name="valor" tabindex="2" onkeypress="mascara(this, cpf)"/>
                </div>
            </div>

            <div class="text-right">
                <button type="submit" class="btn btn-success" tabindex="3">Guardar</button>
            </div>
        </div>
    </div>
</form>
<script type="text/javascript">
    $(function () {
        $("#nombrecategoria").focus();

        $("#frmCategoria").validate({
            rules: {
                codlistaprecio: "required",
                valor: {
                    required: true,
                    number: true
                }
            },
            messages: {
                codlistaprecio: "Seleccione una lista activa",
                valor: {
                    required: "Valor obligatorio",
                    number: "Debe ser valor numérico"
                }
            }
        });
    });
</script>