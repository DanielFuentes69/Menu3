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
                        <form id="frm_soportes" name="frm_soportes" method="post" action="moon2.php" onSubmit="javascript:return managedProccess(this);"> 
                            <input type="hidden" id="action" name="action" value="buscarSoportes" />
                            <input type="hidden" id="controller" name="controller" value="gestion/gestioncontroller" />
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Seleccione el producto</label>
                                            <?php echo $Formulario->addObject("MenuList", "producto", $DOM["PRODUCTOSSOPORTESBUSCADOR"], "-8", "class=\"form-control input-sm\" style=\"cursor:pointer; width: 100%;\" tabindex=\"1\""); ?>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group" id="fecdesde">
                                            <label>Fecha Desde</label>
                                            <div class="input-group date">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                                <input type="text" class="form-control input-sm" id="desde" name="desde" tabindex="2" value="<?php echo Moon2_DateTime_Date::format($fechaDesde, 7); ?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group" id="fechasta">
                                            <label>Fecha Hasta</label>
                                            <div class="input-group date">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                                <input type="text" class="form-control input-sm" id="hasta" name="hasta" tabindex="3" value="<?php echo Moon2_DateTime_Date::format($fechaHasta, 7); ?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-1" style="padding-top: 24px;"> 
                                        <button type="submit" class="btn btn-sm btn-success">Buscar</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="col-sm-12 m-b-xs">
                            <?php echo $Paginador->showDetails(); ?>
                        </div>
                    </div>
                    <?php
                    if ($cantidad_filas > 0) {
                        ?>
                        <div class="table-responsive">
                            <table id="melleva" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th width="15%" class="text-center">Producto</th>
                                        <th width="20%" class="text-center">Empresa</th>
                                        <th width="20%" class="text-center">Nombre Soporte</th>
                                        <th width="10%" class="text-center">Fecha</th>
                                        <th width="10%" class="text-center">Hora</th>
                                        <th width="15%" class="text-center">Valor Pago</th>
                                        <th width="10%" class="text-center">&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $xhtml = "";
                                    $Url = clone $Params;
                                    $controller = "Modules_Gestion_Controllers_GestionController";
                                    foreach ($filas as $indice => $campo) {
                                        $id_fila = $campo["codarchivo"];
                                        $nombreArchivo = $campo["nombreimagen"];
                                        $imagenCodificada = $campo["imagencodificada"];
                                        $mime = $campo["mime"];
                                        $fecha = Moon2_DateTime_Date::format($campo["fecha"], 2);
                                        $hora = Moon2_DateTime_Time::format($campo["hora"], 12);
                                        $tipo = $DOM["TIPOARCHIVO"][$campo["tipo"]];
                                        $valorPago = number_format($campo["valorpagado"], 0, ",", ".");
                                        $empresa = $campo["cliente"];

                                        $Url->add("action", "eliminar");
                                        $Url->add("controller", $controller);
                                        $Url->add("codarchivo", $id_fila);
                                        $Url->add("producto", $producto);
                                        $Url->add("desde", $fechaDesde);
                                        $Url->add("hasta", $fechaHasta);
                                        $params_eliminar = $Url->keyGen();

                                        //*******************************************************
                                        //parametros para ver la imagen
                                        //*******************************************************
                                        $Url->add("codificado", $imagenCodificada);
                                        $Url->add("opt", 6);
                                        $Url->add("mime", $mime);
                                        $params_imagen = $Url->keyGen();
                                        $ruta_imagen = "../../main/views/getimage.php?" . $params_imagen;
                                        //********************************************************

                                        $xhtml .= "<tr id=\"" . $id_fila . "\">\n";
                                        $xhtml .= "<td class=\"text-center\">{$tipo}</td>";
                                        $xhtml .= "<td class=\"text-Capitalize\">{$empresa}</td>";
                                        $xhtml .= "<td class=\"text-left\">{$nombreArchivo}</td>";
                                        $xhtml .= "<td class=\"text-center\">{$fecha}</td>";
                                        $xhtml .= "<td class=\"text-center\">{$hora}</td>";
                                        $xhtml .= "<td class=\"text-center\">{$valorPago}</td>";
                                        $xhtml .= "<td>";
                                        $xhtml .= "   <a title=\"Ver Soporte\" href=\"{$ruta_imagen}\" target=\"_blank\"><i class=\"fa fa-search\" style=\"font-size: 24px;\"></i></a>&nbsp;";
                                        $xhtml .= "   <a href=\"#\" data-toggle=\"modal\" name=\"{$params_eliminar}\" data-target=\"#myModalDelete\" title=\" {$nombreArchivo}\"><i class=\"fa fa-trash-o text-success\" style=\"font-size: 24px;\"></i></a>&nbsp;";
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
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span>
                    <span class="sr-only">Cerrar</span></button>
                <h4 class="modal-title text-center">Agregar Archivos</h4>
            </div>
            <div class="modal-body">
                <iframe id="contenedorIframe" width="100%" height="300" src="" data-iframe-src="archivos_crear.php" frameborder="0"></iframe>
            </div>
        </div>
    </div>
</div>
<!--************************************************************************************************-->
<script type="text/javascript">
//******************************************************************************
//inicializa el calendario
//******************************************************************************
    $('#fecdesde .input-group.date').datepicker({
        todayBtn: "linked",
        keyboardNavigation: true,
        forceParse: true,
        calendarWeeks: true,
        autoclose: true
    });
//******************************************************************************
//******************************************************************************
//inicializa el calendario
//******************************************************************************
    $('#fechasta .input-group.date').datepicker({
        todayBtn: "linked",
        keyboardNavigation: true,
        forceParse: true,
        calendarWeeks: true,
        autoclose: true
    });
//******************************************************************************
</script>