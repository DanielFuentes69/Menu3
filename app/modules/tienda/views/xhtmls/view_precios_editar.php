<?php
if (!isset($DOM["SECURITY_ID"])) {
    echo "<h1>MOON2 Message:<br />Can not call view, requires the view controller</h1>";
    exit();
}

$formulario = new Moon2_Forms_Form();
$objListaPrecio = new Modules_Tienda_Model_ListasPrecios();
$objListaPrecio->set_codlistaprecio($codListaPrecio);

$listasPreciosFachada = new Modules_Tienda_Model_ListasPreciosFacade();
$listasPreciosFachada->loadOne($objListaPrecio);

$productosFachada = new Modules_Tienda_Model_ProductosFacade();
$precio = $productosFachada->obtenerPrecioProducto($codProducto, $codListaPrecio);
?>
<form id="frmCategoria" name="frmCategoria" method="post" action="moon2.php" onSubmit="javascript:return managedProccess(this);" class="form-horizontal">       
    <input type="hidden" id="action" name="action" value="actualizarPrecio"/>
    <input type="hidden" id="codproducto" name="codproducto" value="<?php echo $codProducto; ?>"/>
    <input type="hidden" id="codlistaprecio" name="codlistaprecio" value="<?php echo $codListaPrecio; ?>"/>
    <input type="hidden" id="controller" name="controller" value="tienda/productoscontroller" />

    <div class="col-lg-12">
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Lista actual</label>
                    <div class="bg-primary p-xs b-r-sm"><strong><?php echo $objListaPrecio->get_nombrelistaprecio();?></strong></div>
                    
                </div>
                <div class="form-group">
                    <label>Precio del producto</label>
                    <input type="text" class="form-control input-sm" id="valor" name="valor" tabindex="2" value="<?php echo number_format($precio, 2);?>" onkeypress="mascara(this, cpf)"/>
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