<?php
if (!isset($DOM["SECURITY_ID"])) {
    echo "<h1>MOON2 Message:<br />Can not call view, requires the view controller</h1>";
    exit();
}
?>
<form id="frm_datosbasicos" method="post" action="moon2.php" onSubmit="javascript:return managedProccess(this);">
    <input type="hidden" id="action" name="action" value="crear" />
    <input type="hidden" id="controller" name="controller" value="krauff/usuarioscontroller" />
    <div class="row">
        <div class="col-sm-6 b-r">
            <div class="form-group">
                <label>Perfil</label>
                <?php echo $Formulario->addObject("MenuList", "codperfil", $array_perfiles, "", "class='form-control input-sm' onchange=\"focoCajanombres()\" tabindex='1' style='cursor: pointer; width: 100%;'"); ?>
            </div>

            <div class="form-group">
                <label>Nombres</label>
                <input type="text" class="form-control input-sm" id="nombres" name="nombres" tabindex="2"/>
            </div>

            <div class="form-group">
                <label>Primer Apellido</label>
                <input type="text" class="form-control input-sm" id="primerapellido" name="primerapellido" tabindex="3"/>
            </div>

            <div class="form-group">
                <label>Segundo Apellido</label>
                <input type="text" class="form-control input-sm" id="segundoapellido" name="segundoapellido" tabindex="4"/>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="form-group">
                <label>Tipo Documento</label>
                <?php echo $Formulario->addObject("MenuList", "tipodoc", $array_tipodocumento, "", "class='form-control input-sm' onchange=\"focoCajadocumento()\" style='cursor:pointer; width: 250px;' tabindex='5'"); ?>
            </div>

            <div class="form-group">
                <label>Número</label>
                <input type="text" class="form-control input-sm" id="documento" name="documento" tabindex="6"/>
            </div>

            <div class="form-group">
                <label>Genero</label>
                <?php echo $Formulario->addObject("MenuList", "genero", $array_genero, "", "class='form-control input-sm' style='cursor:pointer; width: 250px;' tabindex='7'"); ?>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button class="btn btn-success" type="submit" tabindex="50">Guardar</button>
    </div>
</form>
<script type="text/javascript">
    //**********************************************************************
    //inicializa la busqueda de la ubicacion
    //**********************************************************************
    $(".laboratorios_sel").select2({
        theme: "classic",
        width: "resolve"
    });
    //**********************************************************************
    $(document).ready(function () {
            $("#frm_datosbasicos").validate({
                    rules: {
                codperfil: "required",
                            nombres: "required",
                primerapellido: "required",
                tipodoc: "required",
                documento: "required",
                genero: "required"
                    },
                    messages: {
                codperfil: "Seleccione perfil.",
                            nombres: "Este campo es requerido.",
                primerapellido: "Este campo es requerido.",
                tipodoc: "Seleccione tipo de documento.",
                documento: "Este campo es requerido.",
                genero: "Seleccione genero"
                    }
            });
    });
</script>