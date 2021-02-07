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
                        <div class="col-sm-12 m-b-xs">
                            <button class="btn btn-success dim" type="button" title="Agregar" data-toggle="modal" data-target="#VentanaFlotanteCrear"><i class="fa fa-plus-square"></i></button>
                            <?php echo $Paginador->showDetails(); ?>
                        </div>
                    </div>
                    <div class="alert alert-info">
                        En esta sección puede agregar promociones y definir la fecha limite de la misma.
                    </div>
                    <?php
                    if ($cantidad_filas > 0) {
                        ?>
                        <div class="table-responsive">
                            <table id="melleva" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th width="15%" class="text-center">Titulo</th>
                                        <th width="15%" class="text-center">Producto</th>
                                        <th width="10%" class="text-center">Fecha Fin</th>
                                        <th width="50%" class="text-center">Descripción</th>
                                        <th width="10%" class="text-center">&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $xhtml = "";
                                    $Url = clone $Params;
                                    $controller = "Modules_Webpage_Controllers_PromocionesController";
                                    foreach ($filas as $indice => $campo) {
                                        $id_fila = $campo["codpromocion"];
                                        $titulo = $campo["titulo"];
                                        $producto = $campo["nombreproducto"];
                                        $descripcion = $campo["descripcion"];
                                        $imagenCodificada = $campo["imagencodificada"];
                                        $mime = $campo["mime"];
                                        $fechaFin = Moon2_DateTime_Date::format($campo["fechafin"], 2);

                                        $Url->add("action", "eliminar");
                                        $Url->add("controller", $controller);
                                        $Url->add("codpromocion", $id_fila);
                                        $params_eliminar = $Url->keyGen();

                                        $Url->add("action", "actualizar");
                                        $Url->add("codpromocion", $id_fila);
                                        $params_actualizar = $Url->keyGen();

                                        //*******************************************************
                                        //parametros para ver la imagen
                                        //*******************************************************
                                        $Url->add("codificado", $imagenCodificada);
                                        $Url->add("opt", 5);
                                        $Url->add("mime", $mime);
                                        $params_imagen = $Url->keyGen();
                                        $ruta_imagen = "../../main/views/getimage.php?" . $params_imagen;
                                        //********************************************************

                                        $xhtml .= "<tr id=\"" . $id_fila . "\">\n";
                                        $xhtml .= "<td class=\"text-left\">{$titulo}</td>";
                                        $xhtml .= "<td class=\"text-left\">{$producto}</td>";
                                        $xhtml .= "<td class=\"text-center\">{$fechaFin}</td>";
                                        $xhtml .= "<td class=\"text-justify\">{$descripcion}</td>";
                                        $xhtml .= "<td>";
                                        $xhtml .= "   <a title=\"Ver Imagen\" href=\"{$ruta_imagen}\" target=\"_blank\"><i class=\"fa fa-eye\" style=\"font-size: 24px;\"></i></a>&nbsp;";
                                        $xhtml .= "   <a title=\"Editar\" data-toggle='modal' name=\"{$params_actualizar}\" data-target='#VentanaFlotanteEditar'><i class=\"fa fa-edit\" style=\"font-size: 24px;\"></i></a>&nbsp;";
                                        $xhtml .= "   <a href=\"#\" data-toggle=\"modal\" name=\"{$params_eliminar}\" data-target=\"#myModalDelete\" title=\" {$titulo}\"><i class=\"fa fa-trash-o text-success\" style=\"font-size: 24px;\"></i></a>&nbsp;";
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
                <h4 class="modal-title text-center">Agregar Promoción</h4>
            </div>
            <div class="modal-body">
                <iframe id="contenedorIframe" width="100%" height="500" src="" data-iframe-src="promociones_crear.php" frameborder="0"></iframe>
            </div>
        </div>
    </div>
</div>
<!--************************************************************************************************-->
<!--************************************************************************************************-->
<!--VENTANA FLOTANTE PARA EDITAR-->
<!--************************************************************************************************-->
<div role="dialog" tabindex="-1" id="VentanaFlotanteEditar" class="modal fade" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span>
                    <span class="sr-only">Cerrar</span></button>
                <h4 class="modal-title text-center">Editar Promoción</h4>
            </div>
            <div class="modal-body">
                <iframe id="contenedorIframeeditar" width="100%" height="500" src="" data-iframe-src="promociones_editar.php" frameborder="0"></iframe>
            </div>
        </div>
    </div>
</div>
<!--************************************************************************************************-->