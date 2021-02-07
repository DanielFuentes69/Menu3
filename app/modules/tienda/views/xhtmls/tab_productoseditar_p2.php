<?php
if (!isset($DOM["SECURITY_ID"])) {
    echo "<h1>MOON2 Message:<br />Can not call view, requires the view controller</h1>";
    exit();
}
$perfilUsuario = $DOM["PROFILE_ID"];

$objProducto = new Modules_Tienda_Model_Productos();
$objProducto->set_codproducto($codProducto);

$productosFachada = new Modules_Tienda_Model_ProductosFacade();
$productosFachada->loadOne($objProducto);

$arrPrecios = $productosFachada->obtenerNombrePrecios($codProducto);
$cantidad_filas = count($arrPrecios);

$paramCrear = new Moon2_Params_Parameters();
$paramCrear->add("codproducto", $codProducto);
$urlCrearPrecio = $paramCrear->keyGen();

$listasPreciosFachada = new Modules_Tienda_Model_ListasPreciosFacade();
$arrListasPreciosDisponibles = $listasPreciosFachada->obtenerListasPreciosDisponibles($codProducto, $DOM["ESTADOLISTASPRECIOS_TXT"]["ACTIVO"]);
?>
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
                        Advertencia: El producto no tiene precios asociados.
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </li>
</ul>

<div class="wrapper wrapper-content" style="padding-left: 0px;padding-right: 0px;padding-top: 0px;">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <?php
                    if (count($arrListasPreciosDisponibles) > 0 && $perfilUsuario == $DOM["PERFILES"]["ADMINISTRADOR"]) {
                        ?>
                        <div class=" m-b-xs">
                            <button class="btn btn-success dim" type="button" title="Nuevo" name="<?php echo $urlCrearPrecio; ?>" data-toggle="modal" data-target="#VentanaFlotanteCrear"><i class="fa fa-plus-square"></i></button>
                        </div>
                        <?php
                    }
                    ?>  

                    <?php
                    if ($cantidad_filas > 0) {
                        ?>
                        <div class="table-responsive">
                            <table id="melleva" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th width="50%">Lista de precio</th>
                                        <th width="20%" class="text-center">Estado</th>
                                        <th width="20%" class="text-center">Valor</th>
                                        <th width="10%" class="text-center">&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $xhtml = "";
                                    $Url = new Moon2_Params_Parameters();
                                    $controller = "Modules_Tienda_Controllers_ProductosController";
                                    foreach ($arrPrecios as $indice => $campo) {
                                        $id_fila = $campo["codlistaprecio"];
                                        $nombreListaPrecio = $campo["nombrelistaprecio"];
                                        $estadoListaPrecio = $DOM["ESTADOLISTASPRECIOS"][$campo["estado"]];
                                        $valorListaPrecio = $campo["valor"];
                                        $valorListaPrecioTXT = number_format($campo["valor"], 2);

                                        $estiloEstado = " class=\"text-success\"";
                                        if ($campo["estado"] != $DOM["ESTADOCATEGORIA_TXT"]["ACTIVO"]) {
                                            $estiloEstado = " class=\"text-muted\"";
                                        }

                                        $Url->add("action", "eliminarPrecio");
                                        $Url->add("controller", $controller);
                                        $Url->add("codlistaprecio", $id_fila);
                                        $Url->add("codproducto", $codProducto);
                                        $paramsEliminar = $Url->keyGen();

                                        $Url->add("action", "actualizar");
                                        $Url->add("codlistaprecio", $id_fila);
                                        $Url->add("codproducto", $codProducto);
                                        $paramsActualizar = $Url->keyGen();

                                        $xhtml .= "<tr id=\"" . $id_fila . "\">\n";
                                        $xhtml .= "<td>{$nombreListaPrecio}</td>";
                                        $xhtml .= "<td{$estiloEstado}>{$estadoListaPrecio}</td>";
                                        $xhtml .= "<td class=\"text-center\">$ {$valorListaPrecioTXT}</td>";
                                        $xhtml .= "<td class=\"text-center\">";
                                        if ($perfilUsuario == $DOM["PERFILES"]["ADMINISTRADOR"]) {
                                            $xhtml .= "   <a title=\"Editar Precio\" data-toggle='modal' name=\"{$paramsActualizar}\" data-target='#VentanaFlotanteEditar'><i class=\"fa fa-edit\" style=\"font-size: 20px;\"></i></a>&nbsp;";
                                        }
                                        if ($perfilUsuario == $DOM["PERFILES"]["ADMINISTRADOR"]) {
                                            $xhtml .= "   <a href=\"#\" data-toggle=\"modal\" name=\"{$paramsEliminar}\" data-target=\"#myModalDelete\" title=\" {$nombreListaPrecio}\"><i class=\"fa fa-trash-o text-success\" style=\"color: #ff6666; font-size: 20px;\"></i></a>&nbsp;";
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
                        <?php
                    } else {
                        ?>
                        <div class="alert alert-warning alert-dismissable">
                            <button data-dismiss="alert" class="close" type="button">×</button>
                            <strong>ADVERTENCIA: </strong> No se encontraron precios para este producto
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
                <h4 class="modal-title text-center">Nuevo precio</h4>
            </div>
            <div class="modal-body">
                <iframe id="contenedorIframe" width="100%" height="230" src="" data-iframe-src="precios_crear.php" frameborder="0"></iframe>
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
                <h4 class="modal-title text-center">Actualizar precio</h4>
            </div>
            <div class="modal-body">
                <iframe id="contenedorIframeeditar" width="100%" height="230" src="" data-iframe-src="precios_editar.php" frameborder="0"></iframe>
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
            var url = e.relatedTarget.name;
            var src = $('#contenedorIframe').attr('data-iframe-src');
            src = src + "?" + url;
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

