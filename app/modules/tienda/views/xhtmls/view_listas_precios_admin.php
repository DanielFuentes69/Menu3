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
$opcionesBusqueda["nombrelistaprecio"] = "Nombre";
?>
<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-sm-7 m-b-xs">
                            <?php
                            if ($perfilUsuario == $DOM["PERFILES"]["ADMINISTRADOR"]) {
                                ?>
                                <button class="btn btn-success dim" type="button" title="Nuevo" data-toggle="modal" data-target="#VentanaFlotanteCrear"><i class="fa fa-plus-square"></i></button>
                                <?php
                            }
                            ?>
                            <?php echo $Paginador->showDetails(); ?>
                        </div>
                        <!--Buscador de Registros-->    
                        <form id="frmCategorias" name="frmCategorias" method="post" action="moon2.php" onSubmit="javascript:return managedProccess(this);"> 
                            <input type="hidden" id="action" name="action" value="buscar" />
                            <input type="hidden" id="controller" name="controller" value="Tienda/ListasPreciosController" />
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
                    </div>    
                    <!--Finaliza el Buscador de Registros--> 
                    <?php
                    if ($cantidad_filas > 0) {
                        ?>
                        <div class="table-responsive">
                            <table id="melleva" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th width="50%">Listas registradas</th>
                                        <th width="20%" class="text-center">Estado</th>
                                        <th width="20%" class="text-center">Utilizada</th>
                                        <th width="10%" class="text-center">&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $xhtml = "";
                                    $Url = new Moon2_Params_Parameters();
                                    $controller = "Modules_Tienda_Controllers_ListasPreciosController";
                                    foreach ($filas as $indice => $campo) {
                                        $id_fila = $campo["codlistaprecio"];
                                        $nombreLista = $campo["nombrelistaprecio"];
                                        $estadoLista = $DOM["ESTADOLISTASPRECIOS"][$campo["estado"]];
                                        $cantidadUsos = $campo["cantlistas"];

                                        $estiloEstadoLista = " class=\"text-success\"";
                                        if ($campo["estado"] != $DOM["ESTADOLISTASPRECIOS_TXT"]["ACTIVO"]) {
                                            $estiloEstadoLista = " class=\"text-muted\"";
                                        }

                                        $Url->add("action", "eliminar");
                                        $Url->add("controller", $controller);
                                        $Url->add("codlistaprecio", $id_fila);
                                        $paramsEliminar = $Url->keyGen();

                                        $Url->add("action", "actualizar");
                                        $Url->add("codlistaprecio", $id_fila);
                                        $paramsActualizar = $Url->keyGen();

                                        $xhtml .= "<tr id=\"" . $id_fila . "\">\n";
                                        $xhtml .= "<td>{$nombreLista}</td>";
                                        $xhtml .= "<td{$estiloEstadoLista}>{$estadoLista}</td>";
                                        $xhtml .= "<td class=\"text-center\"><span style=\"font-size: 13px;\" class=\"badge badge-success\">{$cantidadUsos}</span></td>";
                                        $xhtml .= "<td class=\"text-center\">";
                                        if ($perfilUsuario == $DOM["PERFILES"]["ADMINISTRADOR"]) {
                                            $xhtml .= "   <a title=\"Editar Perfil\" data-toggle='modal' name=\"{$paramsActualizar}\" data-target='#VentanaFlotanteEditar'><i class=\"fa fa-edit\" style=\"font-size: 20px;\"></i></a>&nbsp;";
                                        }
                                        if ($cantidadUsos == 0 && $perfilUsuario == $DOM["PERFILES"]["ADMINISTRADOR"]) {
                                            $xhtml .= "   <a href=\"#\" data-toggle=\"modal\" name=\"{$paramsEliminar}\" data-target=\"#myModalDelete\" title=\" {$nombreLista}\"><i class=\"fa fa-trash-o text-success\" style=\"color: #ff6666; font-size: 20px;\"></i></a>&nbsp;";
                                        } else {
                                            $xhtml .= "   <i class=\"fa fa-trash-o text-success\" style=\"color: #cdcdcb; font-size: 20px;\"></i>";
                                        }
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
                <h4 class="modal-title text-center">Nueva lista de precio</h4>
            </div>
            <div class="modal-body">
                <iframe id="contenedorIframe" width="100%" height="200" src="" data-iframe-src="listaprecio_crear.php" frameborder="0"></iframe>
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
                <h4 class="modal-title text-center">Actualizar lista de precio</h4>
            </div>
            <div class="modal-body">
                <iframe id="contenedorIframeeditar" width="100%" height="200" src="" data-iframe-src="listaprecio_editar.php" frameborder="0"></iframe>
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