<?php
if (!isset($DOM["SECURITY_ID"])) {
    echo "<h1>MOON2 Message:<br />Can not call view, requires the view controller</h1>";
    exit();
}

$Formulario = new Moon2_Forms_Form();
$objListaPrecio = new Modules_Tienda_Model_ListasPrecios();
$listaPrecioFachada = new Modules_Tienda_Model_ListasPreciosFacade();

$objListaPrecio->set_codlistaprecio($codListaPrecio);
$listaPrecioFachada->loadOne($objListaPrecio);
?>
<form id="frmListaPrecio" name="frmListaPrecio" method="post" action="moon2.php" onSubmit="javascript:return managedProccess(this);" class="form-horizontal">       
    <input type="hidden" id="codlistaprecio" name="codlistaprecio" value="<?php echo $codListaPrecio;?>"/>
    <input type="hidden" id="action" name="action" value="actualizar"/>
    <input type="hidden" id="controller" name="controller" value="tienda/ListasPrecioscontroller" />

    <div class="col-lg-12">
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Nombre lista precio</label>
                    <input type="text" class="form-control form-control-sm" id="nombrelistaprecio" name="nombrelistaprecio" tabindex="1" value="<?php echo $objListaPrecio->get_nombrelistaprecio()?>"/>
                </div>
                <div class="form-group">
                    <label>Estado</label>
                    <?php echo $Formulario->addObject("MenuList", "estado", $DOM["ESTADOLISTASPRECIOS"],  $objListaPrecio->get_estado(), "tabindex=\"2\" class='form-control input-sm' style='cursor:pointer;'") ?>
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
        $("#nombrelistaprecio").focus();
        
        $("#frmListaPrecio").validate({
            rules: {
                nombrelistaprecio: "required"
            },
            messages: {
                nombrelistaprecio: "Este campo es requerido."
            }
        });
    });
</script>