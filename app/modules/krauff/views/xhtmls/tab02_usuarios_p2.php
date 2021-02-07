<?php
if (!isset($DOM["SECURITY_ID"])) {
    echo "<h1>MOON2 Message:<br />Can not call view, requires the view controller</h1>";
    exit();
}
//******************************************************************************
//armamos el combo de las ciudades
//******************************************************************************
$FacadeUbicaciones = new Modules_Krauff_Model_UbicacionesFacade();
$array_ubicaciones = $FacadeUbicaciones->allUbicaciones($DOM["UBICACIONTIPO_TXT"]["MUNICIPIO"]);
$combo_ubicaciones = array("-8" => "Ciudades") + $array_ubicaciones;
//******************************************************************************
//******************************************************************************
//ubicacion por defecto si esta vacio
//******************************************************************************
if (empty($Usuario->get_codubicacion())) {
    $ubicacionDefecto = $DOM["UBICACION"]["BUCARAMANGA"];
} else {
    $ubicacionDefecto = $Usuario->get_codubicacion();
}
//******************************************************************************
?>
<form id="frm_ubicacion" method="post" action="moon2.php" onSubmit="javascript:return managedProccess(this);">
    <input type="hidden" id="action" name="action" value="asignar_ubicacion" />
    <input type="hidden" id="codusuario" name="codusuario" value="<?php echo $cod_usuario; ?>" />
    <input type="hidden" id="controller" name="controller" value="krauff/usuarioscontroller" />

    <div class="row">
        <div class="col-sm-12">
            <div class="bg-muted p-xs b-r-sm text-uppercase"><span class="label label-success pull-left" style="font-size: 13px;">Usuario: </span>&nbsp;&nbsp;<?php echo $Usuario->get_nombres() . " " . $Usuario->get_primerapellido() . " " . $Usuario->get_segundoapellido(); ?></div>
        </div>
        <div class="col-sm-12">
            &nbsp;
        </div> 
        <div class="col-sm-6 b-r">
            <div class="form-group">
                <label>Buscador de ciudades</label>
                <?php echo $Formulario->addObject("MenuList", "codubicacion", $combo_ubicaciones, $ubicacionDefecto, "class=\"form-control ubicacion_sel\" tabindex=\"1\" style=\"cursor: pointer; width: 100%;\""); ?>                                 
            </div>

            <div class="form-group">
                <label>Dirección</label>
                <input type="text" class="form-control input-sm" id="direccion" name="direccion" tabindex="2" value="<?php echo $Usuario->get_direccion(); ?>"/>
            </div>

            <div class="form-group">
                <label>Teléfono</label>
                <input type="text" class="form-control input-sm" id="telefono" name="telefono" tabindex="3" value="<?php echo $Usuario->get_telefono(); ?>"/>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="form-group">
                <label>Celular</label>
                <input type="text" class="form-control input-sm" id="celular" name="celular" tabindex="4" value="<?php echo $Usuario->get_celular(); ?>"/>
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control input-sm" id="correo" name="correo" tabindex="5" value="<?php echo $Usuario->get_correo(); ?>"/>
            </div>
        </div>
    </div>

    <div class="modal-footer">
        <button type="submit" class="btn btn-success" tabindex="50">Guardar</button>
    </div>
</form>         
<script type="text/javascript">
    //**********************************************************************
    //inicializa la busqueda de la ubicacion
    //**********************************************************************
    $(".ubicacion_sel").select2({
        theme: "classic",
        width: "resolve"
    });
    //**********************************************************************
    $("#direccion").focus();
    $(document).ready(function () {
            $("#frm_ubicacion").validate({
                    rules: {
                ubicacion: "required",
                            direccion: "required",
                celular: "required",
                correo: "email"
                    },
                    messages: {
                ubicacion: "Seleccione la ubicación.",
                direccion: "Este campo es requerido.",
                celular: "Este campo es requerido.",
                correo: "Ingrese una dirección de correo valida."
                    }
            });
    });
</script>