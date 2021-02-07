<?php
if (!isset($DOM["SECURITY_ID"])) {
    echo "<h1>MOON2 Message:<br />Can not call view, requires the view controller</h1>";
    exit();
}
?>
<form id="frm_perfil" name="frm_perfil" method="post" action="moon2.php" onSubmit="javascript:return managedProccess(this);" class="form-horizontal">       
    <input type="hidden" id="action" name="action" value="crear"/>
    <input type="hidden" id="controller" name="controller" value="krauff/perfilescontroller" />
    
    <div class="col-lg-12">
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Nombre</label>
                    <input type="text" class="form-control" id="nombreperfil" name="nombreperfil" tabindex="1"/>
                </div>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-success" tabindex="2">Guardar</button>
            </div>
        </div>
    </div>
</form>
<script type="text/javascript">
    $(document).ready(function () {
            $("#frm_perfil").validate({
                    rules: {
                nombreperfil: "required"
                    },
                    messages: {
                nombreperfil: "Este campo es requerido."
                    }
            });
    });
</script>