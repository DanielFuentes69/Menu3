<?php
if (!isset($DOM["SECURITY_ID"])) {
    echo "<h1>MOON2 Message:<br />Can not call view, requires the view controller</h1>";
    exit();
}

$cantidad_filas = count($filas);
$perfilUsuario = $DOM["PROFILE_ID"];
$Formulario = new Moon2_Forms_Form();
$Paginador = new Moon2_Pagination_Pager($rsNumRows, $limit_numrows, $num_page, $Params);

$opcionesBusqueda = [];
$opcionesBusqueda["Identificador"] = "Identificador";
?>
<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-sm-7 m-b-xs">

                        </div>
                        <!--Buscador de Registros-->    
                        <form id="frmPedidos" name="frmPedidos" method="post" action="moon2.php" onSubmit="javascript:return managedProccess(this);"> 
                            <input type="hidden" id="action" name="action" value="buscar" />
                            <input type="hidden" id="controller" name="controller" value="Tienda/PedidosController" />
                            <div class="col-sm-2 m-b-xs">
                                <?php echo $Formulario->addObject("MenuList", "nomcampos", $opcionesBusqueda, $columnaBusqueda, "onchange=\"javascript:limpiarbusqueda();\" class='form-control input-sm' style='cursor:pointer;'") ?>
                            </div>      
                            <div class="col-sm-3">
                                <div class="input-group">
                                    <input type="text" placeholder="Buscar" class="input-sm form-control" name="buscar" id="buscar" value="<?php echo $valorBuscar; ?>"> <span class="input-group-btn">
                                        <button type="submit" class="btn btn-sm btn-success"> Buscar</button></span>
                                </div>
                            </div>
                        </form>
                        <div class="col-sm-12 m-b-xs">
                            &nbsp;
                        </div>
                    </div>    
                    <!--Finaliza el Buscador de Registros--> 
                    <?php
                    if ($cantidad_filas > 0) {
                        ?>
                        <div class="table-responsive">
                            <table id="melleva" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th width="16%">Identificador</th>
                                        <th width="8%">Productos</th>
                                        <th width="44%" class="text-center">Cliente</th>
                                        <th width="25%" class="text-center">Correo - celular</th>
                                        <th width="7%" class="text-center">&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $xhtml = "";
                                    $Url = new Moon2_Params_Parameters();
                                    $controller = "Modules_Tienda_Controllers_PedidosController";
                                    foreach ($filas as $indice => $campo) {
                                        $id_fila = $campo["codpedido"];
                                        $identificador = $campo["identificador"];
                                        $cantProductos = $campo["cantproductos"];
                                        $nombreCliente = $campo["nombrecliente"];
                                        $fecha = Moon2_DateTime_Date::format($campo["fecha"], 1);
                                        $hora = Moon2_DateTime_Time::format($campo["hora"], 12);
                                        $documento = $campo["documento"];
                                        $correo = $campo["correo"];
                                        $direccion = $campo["direccion"];
                                        $celular = $campo["celular"];
                                        $despachado = $campo["despachado"];


                                        $estiloEstadoPedido = " class=\"text-success\"";
                                        if ($despachado == $DOM["ESTADOCATEGORIA_TXT"]["ACTIVO"]) {
                                            $estiloEstadoPedido = " class=\"text-muted\"";
                                        }

                                        $Url->add("action", "eliminar");
                                        $Url->add("controller", $controller);
                                        $Url->add("codpedido", $id_fila);
                                        $paramsEliminar = $Url->keyGen();

                                        $Url->add("codpedido", $id_fila);
                                        $paramsActualizar = $Url->keyGen();

                                        $xhtml .= "<tr id=\"" . $id_fila . "\">\n";
                                        $xhtml .= "<td><span{$estiloEstadoPedido}>{$identificador}</span><br />{$fecha} <br /> {$hora}</td>";
                                        $xhtml .= "<td class=\"text-center\">{$cantProductos}</td>";
                                        $xhtml .= "<td>{$nombreCliente}<br />{$documento}<br />{$direccion}</td>";
                                        $xhtml .= "<td>{$correo}<br />{$celular}</td>";
                                        $xhtml .= "<td class=\"text-center\">";
                                        $xhtml .= "   <a title=\"Ver Pedido\" href=\"pedidos_detalle.php?{$paramsActualizar}\"><i class=\"fa fa-edit\" style=\"font-size: 20px;\"></i></a>&nbsp;";
                                        $xhtml .= "   <a href=\"#\" data-toggle=\"modal\" name=\"{$paramsEliminar}\" data-target=\"#myModalDelete\" title=\" {$identificador}\"><i class=\"fa fa-trash-o text-success\" style=\"color: #ff6666; font-size: 20px;\"></i></a>&nbsp;";
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
                <h4 class="modal-title text-center">Nueva categoría</h4>
            </div>
            <div class="modal-body">
                <iframe id="contenedorIframe" width="100%" height="200" src="" data-iframe-src="categorias_crear.php" frameborder="0"></iframe>
            </div>
        </div>
    </div>
</div>
<!--************************************************************************************************-->
<!--************************************************************************************************-->
<!--VENTANA FLOTANTE PARA EDITAR-->
<!--************************************************************************************************-->
<div role="dialog" tabindex="-1" id="VentanaFlotanteEditar" class="modal fade" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span>
                    <span class="sr-only">Cerrar</span></button>
                <h4 class="modal-title text-center">Actualizar categoría</h4>
            </div>
            <div class="modal-body">
                <iframe id="contenedorIframeeditar" width="100%" height="200" src="" data-iframe-src="categorias_editar.php" frameborder="0"></iframe>
            </div>
        </div>
    </div>
</div>
<!--************************************************************************************************-->
<script>
    function limpiarbusqueda() {
        $("#buscar").val("");
        $("#buscar").focus();
    }

    $(function () {
        $('#VentanaFlotanteCrear').on('shown.bs.modal', function (e) {
            var src = $('#contenedorIframe').attr('data-iframe-src');
            $('#contenedorIframe').attr('src', src);
        });

        $('#VentanaFlotanteCrear').on('hidden.bs.modal', function (e) {
            $('#contenedorIframe').attr('src', '');
        });
    });

    $(function () {
        $('#VentanaFlotanteEditar').on('shown.bs.modal', function (e) {
            var url = e.relatedTarget.name;
            var src = $('#contenedorIframeeditar').attr('data-iframe-src');
            src = src + "?" + url;
            $('#contenedorIframeeditar').attr('src', src);
        });
        $('#VentanaFlotanteEditar').on('hidden.bs.modal', function (e) {
            $('#contenedorIframeeditar').attr('src', '');
        });
    });
</script>