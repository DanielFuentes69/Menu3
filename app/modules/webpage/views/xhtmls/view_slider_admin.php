<?php
if (!isset($DOM["SECURITY_ID"])) {
    echo "<h1>MOON2 Message:<br />Can not call view, requires the view controller</h1>";
    exit();
}
$Paginador = new Moon2_Pagination_Pager($rsNumRows, $limit_numrows, $num_page, $Params);
?>
<div class="wrapper wrapper-content animated fadeInRight g-hidden-xs-down">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <div class="row">
                        <?php
                        if ($cantidad_filas < 10) {
                            ?>
                            <div class="col-sm-12 m-b-xs">
                                <button class="btn btn-success dim" type="button" title="Agregar Imagen" data-toggle="modal" data-target="#VentanaFlotanteCrear"><i class="fa fa-plus-square"></i></button>
                                <?php echo $Paginador->showDetails(); ?>
                            </div>
                            <?php
                        } else {
                            ?>
                            <div class="col-sm-12 m-b-xs">
                                <?php echo $Paginador->showDetails(); ?>
                            </div>
                            <div class="col-sm-12 m-b-xs">
                                &nbsp;
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    <div class="alert alert-info">
                        Máximo 10 imágenes.
                    </div>
                    <?php
                    if ($cantidad_filas > 0) {
                        ?>
                        <div class="table-responsive">
                            <table id="melleva" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th width="20%" class="text-center">Imagen</th>
                                        <th width="8%" class="text-center">Fecha</th>
                                        <th width="8%" class="text-center">Hora</th>
                                        <th width="25%" class="text-center">Titulo 1</th>
                                        <th width="25%" class="text-center">Titulo 2</th>
                                        <th width="10%" class="text-center">&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $xhtml = "";
                                    $Url = clone $Params;
                                    $controller = "Modules_Webpage_Controllers_SliderController";
                                    foreach ($filas as $indice => $campo) {
                                        $id_fila = $campo["codslider"];
                                        $nombreImagen = $campo["nombreimagen"];
                                        $fecha = Moon2_DateTime_Date::format($campo["fecha"], 2);
                                        $hora = Moon2_DateTime_Time::format($campo["hora"], 12);
                                        $imagenCodificada = $campo["imagencodificada"];
                                        $mime = $campo["mime"];
                                        $titulo1 = $campo["titulo1"];
                                        $titulo2 = $campo["titulo2"];

                                        $Url->add("action", "eliminarImagen");
                                        $Url->add("controller", $controller);
                                        $Url->add("codslider", $id_fila);
                                        $params_eliminar = $Url->keyGen();

                                        //*******************************************************
                                        //parametros para ver la imagen
                                        //*******************************************************
                                        $Url->add("codificado", $imagenCodificada);
                                        $Url->add("opt", 2);
                                        $Url->add("mime", $mime);
                                        $params_imagen = $Url->keyGen();
                                        $ruta_imagen = "../../main/views/getimage.php?" . $params_imagen;
                                        //********************************************************

                                        $xhtml .= "<tr id=\"" . $id_fila . "\">\n";
                                        $xhtml .= "<td class=\"text-capitalize text-left\">{$nombreImagen}</td>";
                                        $xhtml .= "<td class=\"text-center\">{$fecha}</td>";
                                        $xhtml .= "<td class=\"text-center\">{$hora}</td>";
                                        $xhtml .= "<td class=\"text-left text-success\">{$titulo1}</td>";
                                        $xhtml .= "<td class=\"text-left text-success\">{$titulo2}</td>";
                                        $xhtml .= "<td>";
                                        $xhtml .= "   <a title=\"Ver Imagen\" href=\"{$ruta_imagen}\" target=\"_blank\"><i class=\"fa fa-eye\" style=\"font-size: 24px;\"></i></a>&nbsp;";
                                        $xhtml .= "   <a href=\"#\" data-toggle=\"modal\" name=\"{$params_eliminar}\" data-target=\"#myModalDelete\" title=\" {$nombreImagen}\"><i class=\"fa fa-trash-o text-success\" style=\"font-size: 24px;\"></i></a>&nbsp;";
                                        $xhtml .= "</td>";
                                        $xhtml .= "</tr>\n";
                                    }
                                    echo $xhtml;
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <?php echo $Paginador->showNavigation(); ?>
                        <?php
                    } else {
                        ?>
                        <div class="alert alert-warning alert-dismissable">
                            <button data-dismiss="alert" class="close" type="button">×</button>
                            <strong>ADVERTENCIA: </strong> No se encontraron Registros.
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!--************************************************************************************************-->
<!--VENTANA FLOTANTE PARA CREAR-->
<!--************************************************************************************************-->
<div role="dialog" tabindex="-1" id="VentanaFlotanteCrear" class="modal fade" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span>
                    <span class="sr-only">Cerrar</span></button>
                <h4 class="modal-title text-center">Agregar Imagen</h4>
            </div>
            <div class="modal-body">
                <iframe id="contenedorIframe" width="100%" height="470" src="" data-iframe-src="slider_crear.php" frameborder="0"></iframe>
            </div>
        </div>
    </div>
</div>
<!--************************************************************************************************-->