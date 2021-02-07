<?php
if (!isset($DOM["SECURITY_ID"])) {
    echo "<h1>MOON2 Message:<br />Can not call view, requires the view controller</h1>";
    exit();
}
?>
<form enctype="multipart/form-data" name="frm_team" id="frm_team" method="POST" action="moon24.php" onsubmit="javascript:return managedProccess(this);" role="form">       
    <input type="hidden" id="action" name="action" value="editar"/>
    <input type="hidden" id="codteam" name="codteam" value="<?php echo $codTeam; ?>"/>
    <input type="hidden" id="controller" name="controller" value="webpage/teamcontroller" />
    <div class="col-lg-12">
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label>Seleccione una imagen  <span class="text-success">(Tamaño 170px * 170px .jpg)</span></label>
                    <div class="fileinput fileinput-new input-group col-sm-12" data-provides="fileinput">
                        <div class="form-control input-sm" data-trigger="fileinput">
                            <i class="glyphicon glyphicon-file fileinput-exists"></i>
                            <span class="fileinput-filename"></span>
                        </div>
                        <span class="input-group-addon btn btn-success btn-file">
                            <span class="fileinput-new">Examinar</span>
                            <span class="fileinput-exists">Cambiar</span>
                            <input type="file" accept="image/*" capture="camera" id="imagenteam" name="imagenteam" required="">
                        </span>
                        <a href="#" class="input-group-addon btn btn-warning fileinput-exists" data-dismiss="fileinput">Eliminar</a>
                    </div>
                </div>

                <div class="form-group">
                    <label>Nombre</label>
                    <input type="text" class="form-control input-sm" id="nombre" name="nombre" tabindex="2" value="<?php echo $Team->get_nombre(); ?>"/>
                </div>

                <div class="form-group">
                    <label>Cargo</label>
                    <input type="text" class="form-control input-sm" id="cargo" name="cargo" tabindex="3" value="<?php echo $Team->get_cargo(); ?>"/>
                </div>

                <div class="form-group">
                    <label>Url facebook</label>
                    <input type="text" class="form-control input-sm" id="facebook" name="facebook" tabindex="4" value="<?php echo $Team->get_facebook(); ?>"/>
                </div>

                <div class="form-group">
                    <label>Url twitter</label>
                    <input type="text" class="form-control input-sm" id="twitter" name="twitter" tabindex="5" value="<?php echo $Team->get_twitter(); ?>"/>
                </div>

                <div class="form-group">
                    <label>Url instagram</label>
                    <input type="text" class="form-control input-sm" id="instagram" name="instagram" tabindex="6" value="<?php echo $Team->get_instagram(); ?>"/>
                </div>

                <div class="form-group">
                    <label>Descripción</label>
                    <input type="text" class="form-control input-sm" id="youtube" name="youtube" tabindex="7" value="<?php echo $Team->get_youtube(); ?>"/>
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
            $("#frm_team").validate({
                    rules: {
                nombre: "required",
                cargo: "required"
                    },
                    messages: {
                nombre: "Este campo es requerido.",
                cargo: "Este campo es requerido."
                    }
            });
    });
</script>