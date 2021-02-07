<?php
if (!isset($DOM["SECURITY_ID"])) {
    echo "<h1>MOON2 Message:<br />Can not call view, requires the view controller</h1>";
    exit();
}
?>
<form enctype="multipart/form-data" name="frm_clientes" id="frm_clientes" method="POST" action="moon24.php" onsubmit="javascript:return managedProccess(this);" role="form">       
    <input type="hidden" id="action" name="action" value="crear"/>
    <input type="hidden" id="controller" name="controller" value="webpage/clientescontroller" />
    <div class="col-lg-12">
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label>Seleccione una imagen  <span class="text-success">(Tamaño 370px * 270px .jpg .git .png)</span></label>
                    <div class="fileinput fileinput-new input-group col-sm-12" data-provides="fileinput">
                        <div class="form-control input-sm" data-trigger="fileinput">
                            <i class="glyphicon glyphicon-file fileinput-exists"></i>
                            <span class="fileinput-filename"></span>
                        </div>
                        <span class="input-group-addon btn btn-success btn-file">
                            <span class="fileinput-new">Examinar</span>
                            <span class="fileinput-exists">Cambiar</span>
                            <input type="file" accept="image/*" capture="camera" id="imagencliente" name="imagencliente" required="">
                        </span>
                        <a href="#" class="input-group-addon btn btn-warning fileinput-exists" data-dismiss="fileinput">Eliminar</a>
                    </div>
                </div>

                <div class="form-group">
                    <label>Nombre</label>
                    <input type="text" class="form-control input-sm" id="nombre" name="nombre" tabindex="2"/>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-success" tabindex="50">Guardar</button>
    </div>
</form>
<script type="text/javascript">
    $("#nombre").focus();
    $(document).ready(function () {
            $("#frm_clientes").validate({
                    rules: {
                nombre: "required",
                imagencliente: "required"
                    },
                    messages: {
                nombre: "Este campo es requerido.",
                imagencliente: "Este campo es requerido."
                    }
            });
    });
</script>