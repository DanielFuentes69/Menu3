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
                            <a href="preguntas_crear.php"><button class="btn btn-success dim" type="button" title="Nueva Pregunta"><i class="fa fa-plus-square"></i></button></a>
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
                                        <th width="35%" class="text-center">Pregunta</th>
                                        <th width="55%" class="text-center">Respuesta</th>
                                        <th width="10%" class="text-center">&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $xhtml = "";
                                    $Url = clone $Params;
                                    $controller = "Modules_Webpage_Controllers_PreguntasController";
                                    foreach ($filas as $indice => $campo) {
                                        $id_fila = $campo["codpregunta"];
                                        $pregunta = strip_tags($campo["pregunta"]);
                                        $respuesta = strip_tags($campo["respuesta"]);

                                        $Url->add("action", "eliminar");
                                        $Url->add("controller", $controller);
                                        $Url->add("codpregunta", $id_fila);
                                        $params_eliminar = $Url->keyGen();

                                        $Url->add("codpregunta", $id_fila);
                                        $params_actualizar = $Url->keyGen();

                                        $xhtml .= "<tr id=\"" . $id_fila . "\">\n";
                                        $xhtml .= "<td class=\"text-left\">{$pregunta}</td>";
                                        $xhtml .= "<td class=\"text-justify\">{$respuesta}</td>";
                                        $xhtml .= "<td>";
                                        $xhtml .= "   <a title=\"Editar\" href=\"preguntas_editar.php?{$params_actualizar}\"><i class=\"fa fa-edit text-success\" style=\"font-size: 24px;\"></i></a>&nbsp;";
                                        $xhtml .= "   <a href=\"#\" data-toggle=\"modal\" name=\"{$params_eliminar}\" data-target=\"#myModalDelete\" title=\" {$pregunta}\"><i class=\"fa fa-trash-o text-success\" style=\"font-size: 24px;\"></i></a>&nbsp;";
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