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
                            <a href="noticias_crear.php"><button class="btn btn-success dim" type="button" title="Nueva Noticia"><i class="fa fa-plus-square"></i></button></a>
                            <?php echo $Paginador->showDetails(); ?>
                        </div>
                    </div>
                    <div class="alert alert-info">
                        En esta sección puede agregar noticias acerca de cualquier tema.
                    </div>
                    <?php
                    if ($cantidad_filas > 0) {
                        ?>
                        <div class="table-responsive">
                            <table id="melleva" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th width="10%" class="text-center">Tipo</th>
                                        <th width="20%" class="text-center">Titulo</th>
                                        <th width="37%" class="text-center">Descripción</th>
                                        <th width="8%" class="text-center">Fecha</th>
                                        <th width="8%" class="text-center">Hora</th>
                                        <th width="7%" class="text-center">Me gusta</th>
                                        <th width="10%" class="text-center">&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $xhtml = "";
                                    $Url = clone $Params;
                                    $controller = "Modules_Webpage_Controllers_NoticiasController";
                                    foreach ($filas as $indice => $campo) {
                                        $id_fila = $campo["codnoticia"];
                                        $titulo = $campo["titulo"];
                                        $descripcion = $campo["descripcion"];
                                        $imagenCodificada = $campo["imagencodificada"];
                                        $mime = $campo["mime"];
                                        $fecha = Moon2_DateTime_Date::format($campo["fecha"], 2);
                                        $hora = Moon2_DateTime_Time::format($campo["hora"], 12);
                                        $tipo = $DOM["TIPOBLOG"][$campo["tipo"]];
                                        $cantidadMegustas = $campo["cantmegusta"];

                                        $Url->add("action", "eliminar");
                                        $Url->add("controller", $controller);
                                        $Url->add("codnoticia", $id_fila);
                                        $params_eliminar = $Url->keyGen();

                                        $Url->add("codnoticia", $id_fila);
                                        $params_actualizar = $Url->keyGen();

                                        //*******************************************************
                                        //parametros para ver la imagen
                                        //*******************************************************
                                        $Url->add("codificado", $imagenCodificada);
                                        $Url->add("opt", 4);
                                        $Url->add("mime", $mime);
                                        $params_imagen = $Url->keyGen();
                                        $ruta_imagen = "../../main/views/getimage.php?" . $params_imagen;
                                        //********************************************************

                                        $mostrarDescripcion = strip_tags($descripcion);
                                        $xhtml .= "<tr id=\"" . $id_fila . "\">\n";
                                        $xhtml .= "<td class=\"text-center\">{$tipo}</td>";
                                        $xhtml .= "<td class=\"text-left\">{$titulo}</td>";
                                        $xhtml .= "<td class=\"text-justify\">{$mostrarDescripcion}</td>";
                                        $xhtml .= "<td class=\"text-center\">{$fecha}</td>";
                                        $xhtml .= "<td class=\"text-center\">{$hora}</td>";
                                        $xhtml .= "<td class=\"text-center\">{$cantidadMegustas}</td>";
                                        $xhtml .= "<td>";
                                        $xhtml .= "   <a title=\"Ver Imagen\" href=\"{$ruta_imagen}\" target=\"_blank\"><i class=\"fa fa-eye text-success\" style=\"font-size: 24px;\"></i></a>&nbsp;";
                                        $xhtml .= "   <a title=\"Editar\" href=\"noticias_editar.php?{$params_actualizar}\"><i class=\"fa fa-edit text-success\" style=\"font-size: 24px;\"></i></a>&nbsp;";
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