<?php
if (!isset($DOM["SECURITY_ID"])) {
    echo "<h1>MOON2 Message:<br />Can not call view, requires the view controller</h1>";
    exit();
}
$Paginador = new Moon2_Pagination_Pager($rsNumRows, $limit_numrows, $num_page, $Params);
?>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-sm-7 m-b-xs">
                            <?php
                            if ($cod_perfiluser == $DOM["PERFILES"]["ADMINISTRADOR"]) {
                                ?>
                                <button class="btn btn-success dim" type="button" title="Nuevo" data-toggle="modal" data-target="#VentanaFlotanteCrear"><i class="fa fa-plus-square"></i></button>
                                <?php
                            }
                            ?>
                            <?php echo $Paginador->showDetails(); ?>
                        </div>
                        <!--Buscador de Registros-->    
                        <form id="frm_perfiles" name="frm_perfiles" method="post" action="moon2.php" onSubmit="javascript:return managedProccess(this);"> 
                            <input type="hidden" id="action" name="action" value="buscar" />
                            <input type="hidden" id="controller" name="controller" value="krauff/perfilescontroller" />
                            <div class="col-sm-2 m-b-xs">
                                <?php echo $Formulario->addObject("MenuList", "nomcampos", $camposBusqueda, $combo_campos, "onchange=\"javascript:limpiarbusqueda();\" class='form-control input-sm' style='cursor:pointer;'") ?>
                            </div>      
                            <div class="col-sm-3">
                                <div class="input-group">
                                    <input type="text" placeholder="Buscar" class="input-sm form-control" name="buscar" id="buscar" value="<?php echo $caja_busqueda; ?>"> <span class="input-group-btn">
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
                                        <th width="80%" class="text-center">Nombre</th>
                                        <th width="10%" class="text-center">Usuarios</th>
                                        <th width="10%" class="text-center">&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $xhtml = "";
                                    $Url = clone $Params;
                                    $controller = "Modules_Krauff_Controllers_PerfilesController";
                                    foreach ($filas as $indice => $campo) {
                                        $id_fila = $campo["codperfil"];
                                        $cod_perfil = $campo["codperfil"];
                                        $nombre_perfil = $campo["nombreperfil"];
                                        $cantidad_usuarios = $campo["cantidadusuarios"];

                                        $Url->add("action", "eliminar");
                                        $Url->add("controller", $controller);
                                        $Url->add("codperfil", $cod_perfil);
                                        $params_eliminar = $Url->keyGen();

                                        $Url->add("action", "actualizar");
                                        $Url->add("codperfil", $cod_perfil);
                                        $params_actualizar = $Url->keyGen();

                                        $xhtml .= "<tr id=\"" . $id_fila . "\">\n";
                                        $xhtml .= "<td class=\"text-capitalize\">{$nombre_perfil}</td>";
                                        $xhtml .= "<td class=\"text-center\"><span style=\"font-size: 15px;\" class=\"badge badge-success\">{$cantidad_usuarios}</span></td>";
                                        $xhtml .= "<td>";
                                        if ($cod_perfiluser == $DOM["PERFILES"]["ADMINISTRADOR"]) {
                                            $xhtml .= "   <a title=\"Editar Perfil\" data-toggle='modal' name=\"{$params_actualizar}\" data-target='#VentanaFlotanteEditar'><i class=\"fa fa-edit\" style=\"font-size: 24px;\"></i></a>&nbsp;";
                                        }
                                        if ($cantidad_usuarios == 0) {
                                            $xhtml .= "   <a href=\"#\" data-toggle=\"modal\" name=\"{$params_eliminar}\" data-target=\"#myModalDelete\" title=\" {$nombre_perfil}\"><i class=\"fa fa-trash-o text-success\" style=\"font-size: 24px;\"></i></a>&nbsp;";
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
                <h4 class="modal-title text-center">Nuevo Perfil</h4>
            </div>
            <div class="modal-body">
                <iframe id="contenedorIframe" width="100%" height="200" src="" data-iframe-src="perfiles_crear.php" frameborder="0"></iframe>
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
                <h4 class="modal-title text-center">Editar Perfil</h4>
            </div>
            <div class="modal-body">
                <iframe id="contenedorIframeeditar" width="100%" height="200" src="" data-iframe-src="perfiles_editar.php" frameborder="0"></iframe>
            </div>
        </div>
    </div>
</div>
<!--************************************************************************************************-->