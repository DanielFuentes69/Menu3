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
                        En esta sección puedes crear cada  uno de los miembros del equipo de trabajo con la información mas importante.
                    </div>
                    <?php
                    if ($cantidad_filas > 0) {
                        ?>
                        <div class="table-responsive">
                            <table id="melleva" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th width="45%" class="text-center">Nombre</th>
                                        <th width="25%" class="text-center">Cargo</th>
                                        <th width="10%" class="text-center">Fecha</th>
                                        <th width="10%" class="text-center">Hora</th>
                                        <th width="10%" class="text-center">&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $xhtml = "";
                                    $Url = clone $Params;
                                    $controller = "Modules_Webpage_Controllers_TeamController";
                                    foreach ($filas as $indice => $campo) {
                                        $id_fila = $campo["codteam"];
                                        $nombre = $campo["nombre"];
                                        $cargo = $campo["cargo"];
                                        $facebook = $campo["facebook"];
                                        $twitter = $campo["twitter"];
                                        $instagram = $campo["instagram"];
                                        $youtube = $campo["youtube"];
                                        $linkedin = $campo["linkedin"];
                                        $imagenCodificada = $campo["imagencodificada"];
                                        $mime = $campo["mime"];
                                        $fecha = Moon2_DateTime_Date::format($campo["fecha"], 2);
                                        $hora = Moon2_DateTime_Time::format($campo["hora"], 12);

                                        $Url->add("action", "eliminar");
                                        $Url->add("controller", $controller);
                                        $Url->add("codteam", $id_fila);
                                        $params_eliminar = $Url->keyGen();

                                        $Url->add("action", "actualizar");
                                        $Url->add("codteam", $id_fila);
                                        $params_actualizar = $Url->keyGen();

                                        //*******************************************************
                                        //parametros para ver la imagen
                                        //*******************************************************
                                        $Url->add("codificado", $imagenCodificada);
                                        $Url->add("opt", 3);
                                        $Url->add("mime", $mime);
                                        $params_imagen = $Url->keyGen();
                                        $ruta_imagen = "../../main/views/getimage.php?" . $params_imagen;
                                        //********************************************************

                                        $xhtml .= "<tr id=\"" . $id_fila . "\">\n";
                                        $xhtml .= "<td class=\"text-capitalize text-left\">{$nombre}</td>";
                                        $xhtml .= "<td class=\"text-capitalize text-left\">{$cargo}</td>";
                                        $xhtml .= "<td class=\"text-center\">{$fecha}</td>";
                                        $xhtml .= "<td class=\"text-center\">{$hora}</td>";
                                        $xhtml .= "<td>";
                                        $xhtml .= "   <a title=\"Ver Imagen\" href=\"{$ruta_imagen}\" target=\"_blank\"><i class=\"fa fa-eye\" style=\"font-size: 24px;\"></i></a>&nbsp;";
                                        $xhtml .= "   <a title=\"Editar\" data-toggle='modal' name=\"{$params_actualizar}\" data-target='#VentanaFlotanteEditar'><i class=\"fa fa-edit\" style=\"font-size: 24px;\"></i></a>&nbsp;";
                                        $xhtml .= "   <a href=\"#\" data-toggle=\"modal\" name=\"{$params_eliminar}\" data-target=\"#myModalDelete\" title=\" {$nombre}\"><i class=\"fa fa-trash-o text-success\" style=\"font-size: 24px;\"></i></a>&nbsp;";
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
                <h4 class="modal-title text-center">Agregar Team</h4>
            </div>
            <div class="modal-body">
                <iframe id="contenedorIframe" width="100%" height="550" src="" data-iframe-src="equipotrabajo_crear.php" frameborder="0"></iframe>
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
                <h4 class="modal-title text-center">Editar Team</h4>
            </div>
            <div class="modal-body">
                <iframe id="contenedorIframeeditar" width="100%" height="550" src="" data-iframe-src="equipotrabajo_editar.php" frameborder="0"></iframe>
            </div>
        </div>
    </div>
</div>
<!--************************************************************************************************-->