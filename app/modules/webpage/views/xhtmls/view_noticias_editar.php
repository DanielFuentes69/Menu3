<?php
if (!isset($DOM["SECURITY_ID"])) {
    echo "<h1>MOON2 Message:<br />Can not call view, requires the view controller</h1>";
    exit();
}
?>
<div class="wrapper wrapper-content animated fadeInRight g-hidden-xs-down">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <form enctype="multipart/form-data" name="frm_noticias" id="frm_noticias" method="POST" action="moon24.php" onsubmit="javascript:return managedProccess(this);" role="form">       
                        <input type="hidden" id="action" name="action" value="editar"/>
                        <input type="hidden" id="codnoticia" name="codnoticia" value="<?php echo $codNoticia; ?>"/>
                        <input type="hidden" id="controller" name="controller" value="webpage/noticiascontroller" />
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>Seleccione una imagen  <span class="text-success">(Tamaño 740px * 380px .jpg .git .png)</span></label>
                                            <div class="fileinput fileinput-new input-group col-sm-12" data-provides="fileinput">
                                                <div class="form-control input-sm" data-trigger="fileinput">
                                                    <i class="glyphicon glyphicon-file fileinput-exists"></i>
                                                    <span class="fileinput-filename"></span>
                                                </div>
                                                <span class="input-group-addon btn btn-success btn-file">
                                                    <span class="fileinput-new">Examinar</span>
                                                    <span class="fileinput-exists">Cambiar</span>
                                                    <input type="file" accept="image/*" capture="camera" id="imgnoticias" name="imgnoticias" required="">
                                                </span>
                                                <a href="#" class="input-group-addon btn btn-warning fileinput-exists" data-dismiss="fileinput">Eliminar</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Titulo</label>
                                            <input type="text" class="form-control input-sm" id="titulo" name="titulo" tabindex="2" value="<?php echo $Noticias->get_titulo(); ?>"/>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Tipo</label>
                                            <?php echo $Formulario->addObject("MenuList", "tipo", $DOM["TIPOBLOG"], $Noticias->get_tipo(), "class='form-control input-sm'  tabindex='3' style='cursor: pointer; width: 100%;'"); ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>Descripción</label>
                                            <textarea class="summernote" id="descripcion" name="descripcion"><?php echo $Noticias->get_descripcion(); ?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success" tabindex="50">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $("#titulo").focus();
    $(document).ready(function () {
        $('.summernote').summernote();
            $("#frm_noticias").validate({
                    rules: {
                titulo: "required",
                descripcion: "required",
                imgnoticias: "required"
                    },
                    messages: {
                titulo: "Este campo es requerido.",
                descripcion: "Este campo es requerido.",
                imgnoticias: "Este campo es requerido."
                    }
            });
    });
</script>