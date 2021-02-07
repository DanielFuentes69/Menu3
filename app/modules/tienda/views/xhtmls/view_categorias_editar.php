<?php
if (!isset($DOM["SECURITY_ID"])) {
    echo "<h1>MOON2 Message:<br />Can not call view, requires the view controller</h1>";
    exit();
}

$Formulario = new Moon2_Forms_Form();
$objCategoria = new Modules_Tienda_Model_Categorias();
$categoriasFachada = new Modules_Tienda_Model_CategoriasFacade();

$objCategoria->set_codcategoria($codCategoria);
$categoriasFachada->loadOne($objCategoria);
?>
<form id="frmCategoria" name="frmCategoria" method="post" action="moon2.php" onSubmit="javascript:return managedProccess(this);" class="form-horizontal">       
    <input type="hidden" id="codcategoria" name="codcategoria" value="<?php echo $codCategoria; ?>"/>
    <input type="hidden" id="action" name="action" value="actualizar"/>
    <input type="hidden" id="controller" name="controller" value="tienda/categoriascontroller" />

    <div class="col-lg-12">
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Nombre categoría</label>
                    <input type="text" class="form-control form-control-sm" id="nombrecategoria" name="nombrecategoria" tabindex="1" value="<?php echo $objCategoria->get_nombrecategoria() ?>"/>
                </div>
                <div class="form-group">
                    <label>Estado</label>
                    <?php echo $Formulario->addObject("MenuList", "estado", $DOM["ESTADOCATEGORIA"], $objCategoria->get_estado(), "tabindex=\"2\" class='form-control input-sm' style='cursor:pointer;'") ?>
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
                nombrecategoria: "required"
            },
            messages: {
                nombrecategoria: "Este campo es requerido."
            }
        });
    });
</script>