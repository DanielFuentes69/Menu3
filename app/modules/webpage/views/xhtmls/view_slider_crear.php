<?php
if (!isset($DOM["SECURITY_ID"])) {
    echo "<h1>MOON2 Message:<br />Can not call view, requires the view controller</h1>";
    exit();
}
?>
<form enctype="multipart/form-data" name="frm_imagenes" id="frm_imagenes" method="POST" action="moon24.php" onsubmit="javascript:return managedProccess(this);" role="form">       
    <input type="hidden" id="action" name="action" value="subirImagen"/>
    <input type="hidden" id="controller" name="controller" value="webpage/slidercontroller" />
    <div class="col-lg-12">
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label>Seleccione una imagen  <span class="text-success">(Tamaño 1920px * 582px .jpg)</span></label>
                    <div class="fileinput fileinput-new input-group col-sm-12" data-provides="fileinput">
                        <div class="form-control input-sm" data-trigger="fileinput">
                            <i class="glyphicon glyphicon-file fileinput-exists"></i>
                            <span class="fileinput-filename"></span>
                        </div>
                        <span class="input-group-addon btn btn-success btn-file">
                            <span class="fileinput-new">Examinar</span>
                            <span class="fileinput-exists">Cambiar</span>
                            <input type="file" accept="image/*" capture="camera" id="imagenslider" name="imagenslider" required="">
                        </span>
                        <a href="#" class="input-group-addon btn btn-warning fileinput-exists" data-dismiss="fileinput">Eliminar</a>
                    </div>
                </div>
            </div>

            <div class="col-sm-12">
                <div class="form-group">
                    <label>Titulo 1</label>
                    <input type="text" class="form-control input-sm" id="titulo1" name="titulo1" tabindex="2"/>
                </div>

                <div class="form-group">
                    <label>Titulo 2</label>
                    <input type="text" class="form-control input-sm" id="titulo2" name="titulo2" tabindex="3"/>
                </div>

                <div class="form-group">
                    <label>Texto boton</label>
                    <input type="text" class="form-control input-sm" id="textoboton" name="textoboton" tabindex="4"/>
                </div>

                <div class="form-group">
                    <label>Url boton</label>
                    <input type="text" class="form-control input-sm" id="urlboton" name="urlboton" tabindex="5"/>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-success" tabindex="50">Subir</button>
        </div>
    </div>
</form>