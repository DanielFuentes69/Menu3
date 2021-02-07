<?php
if (!isset($DOM["SECURITY_ID"])) {
    echo "<h1>MOON2 Message:<br />Can not call view, requires the view controller</h1>";
    exit();
}

$formulario = new Moon2_Forms_Form();
$categoriasFachada = new Modules_Tienda_Model_CategoriasFacade();
$arrCategorias = $categoriasFachada->obtenerCategorias();
$arrCategoriasFinal = array("" => "Seleccione la categoria") + $arrCategorias;
?>
<form id="frmDatosBasicos" method="post" action="moon2.php" onSubmit="javascript:return managedProccess(this);">
    <input type="hidden" id="action" name="action" value="crear" />
    <input type="hidden" id="controller" name="controller" value="tienda/productoscontroller" />
    <div class="row">
        <div class="col-sm-6 b-r">
            <div class="form-group">
                <label>Categoría</label>
                <?php echo $formulario->addObject("MenuList", "codcategoria", $arrCategoriasFinal, "", "class='form-control input-sm' tabindex='1' style='cursor: pointer; width: 100%;'"); ?>
            </div>

            <div class="form-group">
                <label>Nombre producto</label>
                <input type="text" class="form-control input-sm" id="nombreproducto" name="nombreproducto" tabindex="2"/>
            </div>

            <div class="form-group">
                <label>Referencia</label>
                <input type="text" class="form-control input-sm" id="referencia" name="referencia" tabindex="3"/>
            </div>

            <div class="form-group">
                <label>Iva</label>
                <input type="number" class="form-control input-sm" id="iva" name="iva" tabindex="4"/>
            </div>

            <div class="form-group">
                <label>Descripción</label>
                <textarea class="form-control input-sm" id="descripcion" name="descripcion" tabindex="5" rows="5"></textarea>
            </div>
        </div>

        <div class="col-sm-6"><h4 class="text-success">paso 1 de 3</h4>
            <p>Información básica del producto</p>
            <p class="text-center">
                <i class="fa fa-arrow-circle-left big-icon" style="color: #96ca49"></i>
            </p>
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