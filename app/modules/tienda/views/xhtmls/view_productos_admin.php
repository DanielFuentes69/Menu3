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
$opcionesBusqueda["nombreproducto"] = "Producto";
$opcionesBusqueda["referencia"] = "Referencia";
$opcionesBusqueda["nombrecategoria"] = "Categoria";
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
                                <a href="productos_crear.php"><button class="btn btn-success dim"><i class="fa fa-plus-square"></i></button></a>
                                <?php
                            }
                            ?>
                            <?php echo $Paginador->showDetails(); ?>
                        </div>
                        <!--Buscador de Registros-->    
                        <form id="frmCategorias" name="frmCategorias" method="post" action="moon2.php" onSubmit="javascript:return managedProccess(this);"> 
                            <input type="hidden" id="action" name="action" value="buscar" />
                            <input type="hidden" id="controller" name="controller" value="Tienda/ProductosController" />
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
                                        <th width="30%">Producto \ referencia</th>
                                        <th width="14%" class="text-center">Categoría</th>
                                        <th width="25%" class="text-center">Descripción</th>
                                        <th width="5%" class="text-center">Imágenes</th>
                                        <th width="5%" class="text-center">Iva</th>
                                        <th width="15%" class="text-center">Precios</th>
                                        <th width="6%" class="text-center">&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $xhtml = "";
                                    $Url = new Moon2_Params_Parameters();
                                    $controller = "Modules_Tienda_Controllers_ProductosController";
                                    foreach ($filas as $indice => $campo) {
                                        $id_fila = $campo["codproducto"];
                                        $nombreProducto = $campo["nombreproducto"];
                                        $nombreCategoria = $campo["nombrecategoria"];
                                        $referencia = $campo["referencia"];
                                        $descripcion = $campo["descripcion"];
                                        $cantidadImagenes = (int) $campo["cantimagenes"];
                                        $cantidadPrecios = (int) $campo["cantprecios"];
                                        $iva = (int)$campo["iva"];

                                        $cadenaPrecios = "";
                                        if ($cantidadPrecios > 0) {
                                            $productosPreciosFachada = new Modules_Tienda_Model_ProductosFacade();
                                            $arrPrecios = $productosPreciosFachada->obtenerPrecios($id_fila);
                                            foreach ($arrPrecios as $codlistaprecio => $precio) {
                                                $precioTxt = number_format($precio, 0);
                                                $badge = "<p class=\"label label-warning\">$ {$precioTxt}</p>";
                                                $cadenaPrecios = $cadenaPrecios . " " . $badge;
                                            }
                                        } else {
                                            $cadenaPrecios = "<span class=\"text-danger\">No tiene precios</span>";
                                        }
                                        $Url->add("action", "eliminar");
                                        $Url->add("controller", $controller);
                                        $Url->add("codproducto", $id_fila);
                                        $paramsEliminar = $Url->keyGen();

                                        $Url->add("codproducto", $id_fila);
                                        $paramsActualizar = $Url->keyGen();

                                        $xhtml .= "<tr id=\"" . $id_fila . "\">\n";
                                        $xhtml .= "<td>{$nombreProducto}<br /><span class=\"text-success\">Ref:</span> <span class=\"text-muted\"><small>{$referencia}</small></span></td>";
                                        $xhtml .= "<td>{$nombreCategoria}</td>";
                                        $xhtml .= "<td>{$descripcion}</td>";
                                        $xhtml .= "<td class=\"text-center\"><span style=\"font-size: 13px;\" class=\"badge badge-success\">{$cantidadImagenes}</span></td>";
                                        $xhtml .= "<td class=\"text-center\">{$iva}</td>";
                                        $xhtml .= "<td><div style=\"line-height:1.8\">{$cadenaPrecios}</div></td>";
                                        $xhtml .= "<td class=\"text-center\">";
                                        if ($perfilUsuario == $DOM["PERFILES"]["ADMINISTRADOR"]) {
                                            $xhtml .= "   <a title=\"Editar Perfil\" href=\"productos_editar.php?{$paramsActualizar}\"><i class=\"fa fa-edit\" style=\"font-size: 20px;\"></i></a>&nbsp;";
                                        }
                                        if ($cantidadImagenes == 0 && $cantidadPrecios == 0 && $perfilUsuario == $DOM["PERFILES"]["ADMINISTRADOR"]) {
                                            $xhtml .= "   <a href=\"#\" data-toggle=\"modal\" name=\"{$paramsEliminar}\" data-target=\"#myModalDelete\" title=\" {$nombreCategoria}\"><i class=\"fa fa-trash-o text-success\" style=\"color: #ff6666; font-size: 20px;\"></i></a>&nbsp;";
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

<script>
    function limpiarbusqueda() {
        $("#buscar").val("");
        $("#buscar").focus();
    }
</script>