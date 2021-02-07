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
                    <form enctype="multipart/form-data" name="frm_preguntas" id="frm_noticias" method="POST" action="moon24.php" onsubmit="javascript:return managedProccess(this);" role="form">       
                        <input type="hidden" id="action" name="action" value="crear"/>
                        <input type="hidden" id="controller" name="controller" value="webpage/preguntascontroller" />
                        <div class="row">

                            <div class="col-lg-12">
                                <div class="row">
<!--                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>Pregunta</label>
                                            <input type="text" class="form-control input-sm" id="pregunta" name="pregunta" tabindex="1"/>
                                        </div>
                                    </div>-->
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>Pregunta</label>
                                            <textarea class="summernote" id="pregunta" name="pregunta"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>Respuesta</label>
                                            <textarea class="summernote" id="respuesta" name="respuesta"></textarea>
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
    $("#pregunta").focus();
    $(document).ready(function () {
        $('.summernote').summernote();
            $("#frm_preguntas").validate({
                    rules: {
                pregunta: "required",
                respuesta: "required"
                    },
                    messages: {
                pregunta: "Este campo es requerido.",
                respuesta: "Este campo es requerido."
                    }
            });
    });
</script>