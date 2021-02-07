<?php
if (!isset($DOM["SECURITY_ID"])) {
    echo "<h1>MOON2 Message:<br />Can not call view, requires the view controller</h1>";
    exit();
}
$objProducto = new Modules_Tienda_Model_Productos();
$objProducto->set_codproducto($codProducto);

$productosFachada = new Modules_Tienda_Model_ProductosFacade();
$productosFachada->loadOne($objProducto);

$arrPrecios = $productosFachada->obtenerNombrePrecios($codProducto);

$objParams = new Moon2_Params_Parameters();
$objParams->add("codproducto", $codProducto);
$objParams->add("p", "2");
$urlPrecios = $objParams->keyGen();

$arrImagenes = $productosFachada->obtenerImagenes($codProducto);
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
<ul class="sortable-list agile-list">
    <li class="info-element">
        <div class="row">
            <div class="col-sm-4">
                <h3>Producto: <?php echo $objProducto->get_nombreproducto(); ?></h3>
                <small><span class="label label-success pull-left">Ref:</span>&nbsp;&nbsp;<?php echo $objProducto->get_referencia(); ?></small>
            </div>
            <div class="col-sm-8">
                <?php
                if (count($arrPrecios) > 0) {
                    foreach ($arrPrecios as $indice => $campo) {
                        $nombreLista = $campo["nombrelistaprecio"];
                        $valor = $campo["valor"];
                        $valorTxt = number_format($campo["valor"], 0);
                        if ($campo["estado"] != $DOM["ESTADOLISTASPRECIOS_TXT"]["INACTIVO"]) {
                            ?>
                            <div class="btn btn-sm btn-info pull-right" style="margin-bottom: 5px;padding-bottom: 0px;padding-top: 0px;margin-right: 10px;">
                                <div class="text-left">
                                    <?php echo $nombreLista; ?>:
                                    <h4>$ <?php echo $valorTxt; ?></h4>
                                </div>
                            </div>
                            <?php
                        }
                    }
                } else {
                    ?>
                    <div class="alert alert-warning" style="margin-bottom: 0px;">
                        Advertencia: El producto no tiene precios asociados.<br /><a class="alert-link" href="productos_editar.php?<?php echo $urlPrecios; ?>">Clic aquí para agregar precios</a>.
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </li>
</ul>


<div class="col-lg-12" style="padding-left: 0px;padding-right: 0px;">
    <div class="ibox collapsed">
        <div class="ibox-title">
            <h5 class="text-success">Agregar imágen</h5>
            <div class="ibox-tools">
                <a class="collapse-link">
                    <i class="fa fa-chevron-up"></i>
                </a>

            </div>
        </div>
        <div class="ibox-content">
            <form enctype="multipart/form-data" name="frm_imagenproveedor" id="frm_imagenusuario" method="post" action="moon24.php" onsubmit="javascript:return procesarImagen(this);">
                <input type="hidden" id="action" name="action" value="cargarImagen" />
                <input type="hidden" id="imagenAdjunta" name="imagenAdjunta" value="imagen" />
                <input type="hidden" id="controller" name="controller" value="tienda/productoscontroller" />
                <input type="hidden" id="codproducto" name="codproducto" value="<?php echo $codProducto; ?>" />
                <div class="row">
                    <div class="col-sm-12">
                        &nbsp;
                    </div>
                    <div class="col-md-6 b-r">
                        <div class="image-crop col col-6">
                            <img src="../../../images/agregarImagen.png"/>
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
        </div>
    </div>
</div>

<style>
    .img {
        position: relative;
    }

    .img i {
        top: 85%;
        left: 88%;
        position: absolute;
        transform: translate(-50%, -50%);
    }
</style>

<div class="row">
    <?php
    $contador = 1;
    $controller = "Modules_Tienda_Controllers_ProductosController";
    foreach ($arrImagenes as $indice => $campo) {
        $Url = new Moon2_Params_Parameters();
        $imagen_codificada = $campo["nombrecodificado"];
        $mime = $campo["mime"];
        $Url->add("codificado", $imagen_codificada);
        $Url->add("opt", 8);
        $Url->add("mime", $mime);
        $urlImagen = $Url->keyGen();
        $ruta_imagen_actualizada = "../../main/views/getimage.php?" . $urlImagen;
        $imagen_actualizada = "<img style=\"height: 180px; display: block;\" src='{$ruta_imagen_actualizada}' />";

        $Url = new Moon2_Params_Parameters();
        $Url->add("action", "eliminarImagen");
        $Url->add("controller", $controller);
        $Url->add("codproducto", $codProducto);
        $Url->add("codimagen", $campo["codimagen"]);
        $paramsEliminar = $Url->keyGen();
        ?>
        <div class="col-xs-6 col-md-3 img">
            <a href="#" data-toggle="modal" name="<?php echo $paramsEliminar ?>" data-target="#myModalDelete"
               title="imagen (<?php echo $contador; ?>)">
                <i class="fa fa-trash-o text-success" style="color: #ff6666; font-size: 20px;"></i>
            </a>
            <a href="<?php echo $ruta_imagen_actualizada; ?>" class="thumbnail" target="_blank">
                <?php echo $imagen_actualizada; ?>
            </a>
        </div>
        <?php
        $contador++;
    }
    ?>

</div>


<script type="text/javascript">
    function procesarImagen(frm) {
        var $image = $(".image-crop > img");
        var obj = $("#" + frm.id);
        $("#imagenAdjunta").val($image.cropper("getDataURL"));
        if (moon2_process(obj)) {
            return true;
        }
        return false;
    }

    $(function () {
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