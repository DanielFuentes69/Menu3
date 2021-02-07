<?php
if (!isset($DOM["SECURITY_ID"])) {
    echo "<h1>MOON2 Message:<br />Can not call view, requires the view controller</h1>";
    exit();
}
$Url = new Moon2_Params_Parameters();
$imagen_codificada = $Usuario->get_imagencodificada();
$mime = $Usuario->get_mime();
$Url->add("codificado", $imagen_codificada);
$Url->add("opt", 1);
$Url->add("mime", $mime);
$params_imagen = $Url->keyGen();
$ruta_imagen_actualizada = "../../main/views/getimage.php?" . $params_imagen;
$imagen_actualizada = "<img src='{$ruta_imagen_actualizada}'/>";
?>
<style>
    .container {
        max-width: 960px;
        margin: 20px auto;
    }
    .img-container {
        width: 100%;
        max-height: 450px;
    }
    .img-container img {
        max-width: 100%;
    }
    .img-preview {
        overflow: hidden;
    }
    .col {
        float: left;
    }
    .col-6 {
        width: 60%;
    }
    .col-3 {
        width: 35%;
        max-height: 180px;
    }
    .col-2 {
        width: 16.7%;
    }
    .col-1 {
        width: 8.3%;
    }
</style>
<form enctype="multipart/form-data" name="frm_imagenproveedor" id="frm_imagenusuario" method="post" action="moon24.php" onsubmit="javascript:return procesar_imagen(this);">
    <input type="hidden" id="action" name="action" value="adjuntarImagenUsuario" />
    <input type="hidden" id="imagenAdjunta" name="imagenAdjunta" value="lucas" />
    <input type="hidden" id="controller" name="controller" value="krauff/usuarioscontroller" />
    <input type="hidden" id="codusuario" name="codusuario" value="<?php echo $cod_usuario; ?>" />
    <div class="row">
        <div class="col-sm-12">
            <div class="bg-muted p-xs b-r-sm text-uppercase"><span class="label label-success pull-left" style="font-size: 13px;">Usuario: </span>&nbsp;&nbsp;<?php echo $Usuario->get_nombres() . " " . $Usuario->get_primerapellido() . " " . $Usuario->get_segundoapellido(); ?></div>
        </div>
        <div class="col-sm-12">
            &nbsp;
        </div>
        <div class="col-md-6 b-r">
            <div class="image-crop col col-6 img-container">
                <?php
                echo $imagen_actualizada;
                ?>
            </div>
        </div>
        <div class="col-md-6">
            <h4>Vista Previa</h4>
            <div class="col col-3 img-preview"></div>
            <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
            <div class="btn-group">
                <label title="Adjuntar Imagen" for="FileInput" class="btn btn-success">
                    <input type="file" accept="image/*" name="file" id="FileInput" class="hide">
                    Examinar
                </label>
            </div>

            <div class="btn-group">
                <button class="btn btn-white" id="zoomIn" type="button">Zoom +</button>
                <button class="btn btn-white" id="zoomOut" type="button">Zoom -</button>
                <button class="btn btn-white" id="rotateLeft" type="button">Rotar Izquierda</button>
                <button class="btn btn-white" id="rotateRight" type="button">Rotar Derecha</button>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button class="btn btn-success" type="submit" tabindex="50">Guardar</button>
    </div>
</form>
<script type="text/javascript">
    $(document).ready(function () {

        var $image = $(".image-crop > img");
        $($image).cropper({
            aspectRatio: 'Free',
            preview: ".img-preview",
            done: function (data) {
                // Output the result data for cropping image.
            }
        });

        var $inputImage = $("#FileInput");
        if (window.FileReader) {
            $inputImage.change(function () {
                var fileReader = new FileReader(),
                        files = this.files,
                        file;

                if (!files.length) {
                    return;
                }

                file = files[0];

                if (/^image\/\w+$/.test(file.type)) {
                    fileReader.readAsDataURL(file);
                    fileReader.onload = function () {
                        $inputImage.val("");
                        $image.cropper("reset", true).cropper("replace", this.result);
                    };
                } else {
                    showMessage("Please choose an image file.");
                }
            });
        } else {
            $inputImage.addClass("hide");
        }

        $("#zoomIn").click(function () {
            $image.cropper("zoom", 0.1);
        });

        $("#zoomOut").click(function () {
            $image.cropper("zoom", -0.1);
        });

        $("#rotateLeft").click(function () {
            $image.cropper("rotate", 45);
        });

        $("#rotateRight").click(function () {
            $image.cropper("rotate", -45);
        });

        $("#setDrag").click(function () {
            $image.cropper("setDragMode", "crop");
        });
    });
</script>