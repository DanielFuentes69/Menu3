<?php
if (!isset($DOM["SECURITY_ID"])) {
    echo "<h1>MOON2 Message:<br />Can not call view, requires the view controller</h1>";
    exit();
}
$Paginador = new Moon2_Pagination_Pager($rsNumRows, $limit_numrows, $num_page, $Params);
?>
<style>
    .cortar{
        width: 180px;
        text-overflow:ellipsis;
        white-space:nowrap; 
        overflow:hidden; 
        text-align: right;
    }

    .cortar2{
        width: 210px;
        text-overflow:ellipsis;
        white-space:nowrap; 
        overflow:hidden; 
        text-align: left;
    }
</style>
<!--*******************************************************************************-->
<!--maquetado para escritorio-->
<!--*******************************************************************************-->
<div class="wrapper wrapper-content animated fadeInRight g-hidden-xs-down">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-sm-7 m-b-xs">
                            <?php
                            if ($cod_perfil == $DOM["PERFILES"]["ADMINISTRADOR"]) {
                                ?>
                                <a href="usuarios_crear.php"><button class="btn btn-success dim" type="button" title="Nuevo"><i class="fa fa-plus-square"></i></button></a>
                                <?php
                            }
                            ?>
                            <?php echo $Paginador->showDetails(); ?>
                        </div>
                        <!--Buscador de Registros-->    
                        <form id="frm_usuarios" name="frm_usuarios" method="post" action="moon2.php" onSubmit="javascript:return managedProccess(this);"> 
                            <input type="hidden" id="action" name="action" value="buscar" />
                            <input type="hidden" id="controller" name="controller" value="krauff/usuarioscontroller" />
                            <div class="col-sm-2 m-b-xs">
                                <?php echo $Formulario->addObject("MenuList", "nomcampos", $camposBusqueda, $combo_campos, "onchange=\"javascript:limpiarbusqueda(); \"class='form-control input-sm' style='cursor:pointer;'") ?>
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
                                        <th width="10%" class="text-center">Perfil</th>
                                        <th width="30%" class="text-center">Nombre o razón social</th>
                                        <th width="20%" class="text-center">Teléfonos</th>
                                        <th width="20%" class="text-center">Usuario</th>
                                        <th width="10%" class="text-center">Estado</th>
                                        <th width="10%" class="text-center">&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $xhtml = "";
                                    $Url = clone $Params;
                                    $controller = "Modules_Krauff_Controllers_UsuariosController";
                                    foreach ($filas as $indice => $campo) {
                                        $id_fila = $campo["codusuario"];
                                        $cod_usuario = $campo["codusuario"];
                                        $nombre_perfil = $campo["nombreperfil"];
                                        $nombres_usuario = $campo["nombres"];
                                        $telefono = $campo["telefono"];
                                        $celular = $campo["celular"];
                                        $usuario = $campo["nombreusuario"];
                                        $estado = $DOM["ESTADOUSUARIO"][$campo["estado"]];
                                        $codPerfil = $campo["codperfil"];

                                        $Url->add("action", "eliminar");
                                        $Url->add("controller", $controller);
                                        $Url->add("codusuario", $cod_usuario);
                                        $params_eliminar = $Url->keyGen();

                                        $Url->add("codusuario", $cod_usuario);
                                        $params_actualizar = $Url->keyGen();

                                        $Url->add("codusuario", $cod_usuario);
                                        $params_funcionalidades = $Url->keyGen();

                                        $Url->add("action", "activarUsuario");
                                        $Url->add("controller", $controller);
                                        $Url->add("codusuario", $cod_usuario);
                                        $paramsActivar = $Url->keyGen();

                                        if (empty($telefono)) {
                                            $telefono = "<span class=\"text-danger\">Pendiente</span>";
                                        }

                                        if (empty($celular)) {
                                            $celular = "<span class=\"text-danger\">Pendiente</span>";
                                        }

                                        $classEstado = "";
                                        if ($campo["estado"] == $DOM["ESTADOUSUARIO_TXT"]["ACTIVO"]) {
                                            $classEstado = " class=\"text-center text-navy\"";
                                        } else {
                                            $classEstado = " class=\"text-center text-danger\"";
                                        }

                                        $mostrar_telefonos = "<span class=\"text-success\">Fijos: </span>" . $telefono . "<br />" . "<span class=\"text-success\">Celulares: </span>" . $celular;
                                        $xhtml .= "<tr id=\"" . $id_fila . "\">\n";
                                        $xhtml .= "<td>{$nombre_perfil}</td>";
                                        $xhtml .= "<td class=\"text-capitalize\">{$nombres_usuario}</td>";
                                        $xhtml .= "<td>{$mostrar_telefonos}</td>";
                                        $xhtml .= "<td>{$usuario}</td>";
                                        $xhtml .= "<td {$classEstado}>{$estado}</td>";
                                        $xhtml .= "<td>";

                                        if ($codPerfil == $DOM["PERFILES"]["CLIENTE"]) {
                                            $xhtml .= "   <a data-toggle=\"modal\" name=\"{$paramsActivar}\" data-target=\"#VentanaFlotanteActivar\" title=\"{$nombres_usuario}\"><i class=\"fa fa-check-circle text-success\" style=\"font-size: 24px;\"></i></a>&nbsp;";
                                            $xhtml .= "   <a title=\"Asignar tipo cliente\" data-toggle='modal' name=\"{$params_actualizar}\" data-target='#VentanaFlotanteTipoCliente'><i class=\"fa fa-id-card\" style=\"font-size: 24px;\"></i></a>&nbsp;";
                                        }
                                        $xhtml .= "   <a title=\"Editar Usuario\" href=\"usuarios_editar.php?{$params_actualizar}\"><i class=\"fa fa-edit\" style=\"font-size: 24px;\"></i></a>&nbsp;";
                                        if ($cod_perfil == $DOM["PERFILES"]["ADMINISTRADOR"]) {
                                            $xhtml .= "   <a title=\"Asignar Funcionalidades\" href=\"asignar_funcionalidades.php?{$params_funcionalidades}\"><i class=\"fa fa-users\" style=\"font-size: 24px;\"></i></a>&nbsp;";
                                        }
                                        $xhtml .= "   <a href=\"#\" data-toggle=\"modal\" name=\"{$params_eliminar}\" data-target=\"#myModalDelete\" title=\" {$nombres_usuario}\"><i class=\"fa fa-trash-o text-success\" style=\"font-size: 24px;\"></i></a>&nbsp;";
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
<!--*******************************************************************************-->

<!--*******************************************************************************-->
<!--maquetado para celular-->
<!--*******************************************************************************-->
<div class="wrapper wrapper-content animated fadeInRight g-hidden-sm-up">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-sm-7 m-b-xs">
                            <?php
                            if ($cod_perfil == $DOM["PERFILES"]["ADMINISTRADOR"]) {
                                ?>
                                <a href="usuarios_crear.php"><button class="btn btn-success dim" type="button" title="Nuevo"><i class="fa fa-plus-square"></i></button></a>
                                <?php
                            }
                            ?>
                        </div>
                        <!--Buscador de Registros-->    
                        <form id="frm_usuariosm" name="frm_usuariosm" method="post" action="moon2.php" onSubmit="javascript:return managedProccess(this);"> 
                            <input type="hidden" id="action" name="action" value="buscarM" />
                            <input type="hidden" id="controller" name="controller" value="krauff/usuarioscontroller" />
                            <div class="col-sm-2 m-b-xs">
                                <?php echo $Formulario->addObject("MenuList", "nomcamposm", $camposBusqueda, $combo_campos, "onchange=\"javascript:limpiarbusqueda(); \"class='form-control input-sm' style='cursor:pointer;'") ?>
                            </div>      
                            <div class="col-sm-3">
                                <div class="input-group">
                                    <input type="text" placeholder="Buscar" class="input-sm form-control" name="buscarm" id="buscarm" value="<?php echo $caja_busqueda; ?>"> <span class="input-group-btn">
                                        <button type="submit" class="btn btn-sm btn-success"> Buscar</button></span>
                                </div>
                            </div>
                        </form>
                        <!--Finaliza el Buscador de Registros--> 
                    </div>
                </div>
            </div>
            <?php
            if ($cantidad_filas > 0) {
                ?>
                <div class="row">
                    <?php
                    $xhtml = "";
                    $Url = clone $Params;
                    $controller = "Modules_Krauff_Controllers_UsuariosController";
                    foreach ($filas as $indice => $campo) {
                        $id_fila = $campo["codusuario"];
                        $cod_usuario = $campo["codusuario"];
                        $nombre_perfil = $campo["nombreperfil"];
                        $nombres_usuario = $campo["nombres"];
                        $telefono = $campo["telefono"];
                        $celular = $campo["celular"];
                        $usuario = $campo["nombreusuario"];
                        $estado = $DOM["ESTADOUSUARIO"][$campo["estado"]];

                        $Url->add("action", "eliminar");
                        $Url->add("controller", $controller);
                        $Url->add("codusuario", $cod_usuario);
                        $params_eliminar = $Url->keyGen();

                        $Url->add("codusuario", $cod_usuario);
                        $params_actualizar = $Url->keyGen();

                        $Url->add("codusuario", $cod_usuario);
                        $params_funcionalidades = $Url->keyGen();

                        if (empty($telefono)) {
                            $telefono = "<span class=\"text-danger\">Pendiente</span>";
                        }

                        if (empty($celular)) {
                            $celular = "<span class=\"text-danger\">Pendiente</span>";
                        }

                        //************************************************************************************************************************
                        //toltip para las opciones de cada registro
                        //************************************************************************************************************************
                        $mostrar_opciones = "";
                        $mostrar_opciones .= "<a href='usuarios_editar.php?{$params_actualizar}'>Editar Usuario</a><br />";
                        if ($cod_perfil == $DOM["PERFILES"]["ADMINISTRADOR"]) {
                            $mostrar_opciones .= "<hr style='margin: 10px;'>";
                            $mostrar_opciones .= "<a href='asignar_funcionalidades.php?{$params_funcionalidades}'>Asignar Funcionalidades</a><br />";
                        }
                        $mostrar_opciones .= "<hr style='margin: 10px;'>";
                        $mostrar_opciones .= "<a href='#' data-toggle='modal' name='{$params_eliminar}' data-target='#myModalDelete' title=' {$nombres_usuario}'>Eliminar</a><br />";
                        //************************************************************************************************************************

                        $xhtml .= "<div class=\"col-lg-3\">\n";
                        $xhtml .= " <div class=\"ibox float-e-margins\">\n";
                        $xhtml .= "     <div class=\"ibox-title\">\n";
                        $xhtml .= "         <a data-content=\"{$mostrar_opciones}\" data-html=\"true\" href=\"#\" data-toggle=\"popover\" data-placement=\"right\" data-container=\"body\" data-original-title=\"Seleccione una opción\" aria-describedby=\"popover11776633\">";
                        $xhtml .= "             <i class=\"fa fa-cog text-success dropdown-toggle\" data-toggle=\"dropdown\" title=\"Clic para ver opciones\" style=\"font-size: 22px; cursor: pointer;\"></i>";
                        $xhtml .= "         </a>";
                        $xhtml .= "         <span class=\"pull-right text-capitalize cortar\">{$nombres_usuario}</span>\n";
                        $xhtml .= "     </div>\n";
                        $xhtml .= "     <div class=\"ibox-content\">\n";
                        $xhtml .= "         <span class=\"pull-left text-capitalize cortar2\"><span class=\"text-success\">Perfil:</span> {$nombre_perfil}</span><br/>\n";
                        $xhtml .= "         <span class=\"pull-left text-capitalize cortar2\">{$mostrar_telefonos}</span><br/>\n";
                        $xhtml .= "         <span class=\"pull-left cortar2\"><span class=\"text-success\">Usuario:</span> {$usuario}</span><br/><br/>\n";
                        $xhtml .= "         <span class=\"pull-left cortar2\"><span class=\"text-success\">Estado:</span> {$estado}</span><br/><br/>\n";
                        $xhtml .= "     </div>\n";
                        $xhtml .= " </div>\n";
                        $xhtml .= "</div>\n";
                    }
                    echo $xhtml;
                    ?>
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
<!--*******************************************************************************-->
<!--******************************************************************************************-->
<!-- activa el usuario en el sistema-->
<!--******************************************************************************************-->
<div id="VentanaFlotanteActivar" class="modal inmodal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content animated flipInY">
            <div class="modal-body">
                <strong>¿Está seguro que desea activar el usuario? </strong>
                <span class="edit-content"></span>
            </div>      
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-success">Aceptar</button>
            </div>
        </div>
    </div>
</div>
<!--******************************************************************************************-->
<!--************************************************************************************************-->
<!--VENTANA FLOTANTE PARA ASIGNAR EL TIPO DE CLIENTE-->
<!--************************************************************************************************-->
<div role="dialog" tabindex="-1" id="VentanaFlotanteTipoCliente" class="modal fade" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span>
                    <span class="sr-only">Cerrar</span></button>
                <h4 class="modal-title text-center">Asignar Tipo Cliente</h4>
            </div>
            <div class="modal-body">
                <iframe id="contenedorIframeTipoCliente" width="100%" height="200" src="" data-iframe-src="tipo_cliente.php" frameborder="0"></iframe>
            </div>
        </div>
    </div>
</div>
<!--************************************************************************************************-->