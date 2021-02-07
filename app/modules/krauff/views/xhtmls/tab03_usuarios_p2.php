<?php
if (!isset($DOM["SECURITY_ID"])) {
    echo "<h1>MOON2 Message:<br />Can not call view, requires the view controller</h1>";
    exit();
}
?>
<form id="frm_clave" method="post" action="moon2.php" onSubmit="javascript:return managedProccess(this);">
    <input type="hidden" id="action" name="action" value="asignar_clave" />
    <input type="hidden" id="codusuario" name="codusuario" value="<?php echo $cod_usuario; ?>" />
    <input type="hidden" id="controller" name="controller" value="krauff/usuarioscontroller" />

    <div class="col-sm-12">
        <div class="bg-muted p-xs b-r-sm text-uppercase"><span class="label label-success pull-left" style="font-size: 13px;">Usuario: </span>&nbsp;&nbsp;<?php echo $Usuario->get_nombres() . " " . $Usuario->get_primerapellido() . " " . $Usuario->get_segundoapellido(); ?></div>
    </div>
    <div class="col-sm-12">
        &nbsp;
    </div>

    <div class="col-sm-6 b-r">
        <div class="form-group">
            <label>Usuario</label>
            <input type="email" class="form-control input-sm" id="nombreusuario" name="nombreusuario" tabindex="1" value="<?php echo $Usuario->get_nombreusuario(); ?>"/>
        </div>

        <div class="form-group">
            <label>Contraseña</label>
            <input type="password" class="form-control input-sm" id="clave" name="clave" tabindex="2" value="<?php echo $Usuario->get_clave(); ?>"/>
        </div>

        <div class="form-group">
            <label>Confirmar Contraseña</label>
            <input type="password" class="form-control input-sm" id="confirmacion" name="confirmacion" tabindex="3" value="<?php echo $Usuario->get_clave(); ?>"/>
        </div>

        <div class="modal-footer">
            <button type="submit" class="btn btn-success">Guardar</button>
        </div>
    </div>
</form>
<script type="text/javascript">
    $("#nombreusuario").focus();
    $(document).ready(function () {
        $("#frm_clave").validate({
            rules: {
                nombreusuario: "email",
                clave: {
                    required: true,
                    minlength: 4
                },
                confirmacion: {
                    equalTo: "#clave"
                }
            },
            messages: {
                nombreusuario: "No es una dirección de correo valida.",
                clave: "Este campo requiere minimo 4 caracteres.",
                confirmacion: "La contraseña debe ser la misma."
            }
        });
    });
</script>