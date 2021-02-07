<?php
if (!isset($DOM["SECURITY_ID"])) {
    echo "<h1>MOON2 Message:<br />Can not call view, requires the view controller</h1>";
    exit();
}
?>
<form enctype="multipart/form-data" name="frm_promociones" id="frm_promociones" method="POST" action="moon24.php" onsubmit="javascript:return managedProccess(this);" role="form">       
    <input type="hidden" id="action" name="action" value="editar"/>
    <input type="hidden" id="codpromocion" name="codpromocion" value="<?php echo $codPromocion; ?>"/>
    <input type="hidden" id="controller" name="controller" value="webpage/promocionescontroller" />
    <div class="col-lg-12">
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label>Seleccione una imagen  <span class="text-success">(Tamaño 1170px * 500px .jpg .git .png)</span></label>
                    <div class="fileinput fileinput-new input-group col-sm-12" data-provides="fileinput">
                        <div class="form-control input-sm" data-trigger="fileinput">
                            <i class="glyphicon glyphicon-file fileinput-exists"></i>
                            <span class="fileinput-filename"></span>
                        </div>
                        <span class="input-group-addon btn btn-success btn-file">
                            <span class="fileinput-new">Examinar</span>
                            <span class="fileinput-exists">Cambiar</span>
                            <input type="file" accept="image/*" capture="camera" id="imgpromo" name="imgpromo">
                        </span>
                        <a href="#" class="input-group-addon btn btn-warning fileinput-exists" data-dismiss="fileinput">Eliminar</a>
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="form-group">
                    <label>Titulo</label>
                    <input type="text" class="form-control input-sm" id="titulo" name="titulo" tabindex="2" value="<?php echo $Promociones->get_titulo(); ?>"/>
                </div>

                <div class="form-group">
                    <label>Nombre producto</label>
                    <input type="text" class="form-control input-sm" id="nombreproducto" name="nombreproducto" tabindex="3" value="<?php echo $Promociones->get_nombreproducto(); ?>"/>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="form-group">
                    <label>Porcentaje descuento</label>
                    <input type="text" class="form-control input-sm" id="porcentaje" name="porcentaje" tabindex="4" value="<?php echo $Promociones->get_porcentaje(); ?>"/>
                </div>

                <div class="form-group" id="fechafinprom">
                    <label>Fecha fin promoción</label>
                    <div class="input-group date">
                        <span class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </span>
                        <input type="text" class="form-control" id="fechafin" name="fechafin" tabindex="5" value="<?php echo Moon2_DateTime_Date::format($Promociones->get_fechafin(), 10); ?>">
                    </div>
                </div>
            </div>

            <div class="col-sm-12">
                <div class="form-group">
                    <label>Descripción</label>
                    <textarea class="form-control" id="descripcion" name="descripcion" tabindex="6" rows="6"><?php echo $Promociones->get_descripcion(); ?></textarea>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-success" tabindex="50">Guardar</button>
    </div>
</form>
<script type="text/javascript">
//******************************************************************************
//inicializa el calendario
//******************************************************************************
    $('#fechafinprom .input-group.date').datepicker({
        todayBtn: "linked",
        keyboardNavigation: true,
        forceParse: true,
        calendarWeeks: true,
        autoclose: true
    });
//******************************************************************************
    $("#titulo").focus();
    $(document).ready(function () {
            $("#frm_promociones").validate({
                    rules: {
                titulo: "required",
                nombreproducto: "required",
                porcentaje: "required",
                fechafin: "required",
                descripcion: "required"
                    },
                    messages: {
                titulo: "Este campo es requerido.",
                nombreproducto: "Este campo es requerido.",
                porcentaje: "Este campo es requerido.",
                fechafin: "Este campo es requerido.",
                descripcion: "Este campo es requerido."
                    }
            });
    });
</script>