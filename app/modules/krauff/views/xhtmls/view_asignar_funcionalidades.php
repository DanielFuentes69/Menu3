<?php
if (!isset($DOM["SECURITY_ID"])) {
    echo "<h1>MOON2 Message:<br />Can not call view, requires the view controller</h1>";
    exit();
}
?>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-6">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <div class="row">
                        <form id="frm_asigfunc" method="post" action="moon2.php" onSubmit="javascript:return managedProccess(this);">
                            <input type="hidden" id="codusuario" name="codusuario" value="<?php echo $cod_usuario; ?>"/>
                            <div class="col-sm-12">
                                <div class="col-sm-12">
                                    <div class="bg-muted p-xs b-r-sm text-uppercase"><span class="label label-success pull-left" style="font-size: 13px;">USUARIO: </span>&nbsp;&nbsp;<?php echo $nombres_completousuario; ?></div>
                                </div>
                                <div class="col-sm-12">
                                    &nbsp;
                                </div>
                                <div class="col-sm-12">
                                    <div class="alert alert-info text-justify" style="padding: 10px 10px 10px 10px;">
                                        Active o desactive los permisos desplegando el menú deseado y así, asignar las funcionalidades del usuario, para terminar, haga que el usuario seleccionado inicie nuevamente sesión.
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-7">
                                <?php
                                $xhtml = "";
                                $xhtml .= "<div class=\"panel-body\">\n";
                                $xhtml .= " <div class=\"panel-group\" id=\"accordion\">\n";
                                foreach ($array_funcionalidades as $indice => $campo) {
                                    $cod_funcionalidad = $campo["codfunc"];
                                    $nombre_funcionalidad = $campo["nombre"];

                                    //**************************************************************
                                    //consulta las funcionalidades hijas
                                    //**************************************************************
                                    $array_funchijas = $FuncionalidadesFacade->obtenerFunchijas($cod_funcionalidad);
                                    //**************************************************************

                                    $xhtml .= " <div class=\"panel panel-default\">\n";
                                    $xhtml .= "     <div class=\"panel-heading\">\n";
                                    $xhtml .= "         <h5 class=\"panel-title\">\n";
                                    $xhtml .= "             <a data-toggle=\"collapse\" data-parent=\"#accordion\" href=\"#{$cod_funcionalidad}\" class=\"collapsed text-uppercase\">{$nombre_funcionalidad}</a>\n";
                                    $xhtml .= "         </h5>\n";
                                    $xhtml .= "     </div>\n";
                                    $xhtml .= "     <div id=\"{$cod_funcionalidad}\" class=\"panel-collapse collapse\">\n";
                                    $xhtml .= "         <div class=\"panel-body\">\n";
                                    foreach ($array_funchijas as $indice2 => $campo2) {
                                        $cod_funchija = $campo2["codfunc"];
                                        $cod_padre = $campo2["codpadre"];
                                        $nombre_funchija = $campo2["nombre"];

                                        //******************************************************************************
                                        //validamos que el usuario tenga activa esa funcionalidad
                                        //******************************************************************************
                                        $existeFuncionalidad = $FuncionalidadesFacade->validarFuncionalidad($cod_funchija, $cod_usuario);
                                        if ($existeFuncionalidad > 0) {
                                            $checked = "checked=\"\"";
                                        } else {
                                            $checked = "";
                                        }
                                        //******************************************************************************

                                        $xhtml .= "         <div class=\"checkbox checkbox-primary\">\n";
                                        $xhtml .= "             <input id=\"{$cod_funchija}\" {$checked} type=\"checkbox\" style=\"cursor: pointer;\">\n";
                                        $xhtml .= "                 <label style=\"font-size: 14px;\" for=\"{$cod_funchija}\">\n";
                                        $xhtml .= "                 {$nombre_funchija}\n";
                                        $xhtml .= "                 </label>\n";
                                        $xhtml .= "         </div>\n";
                                    }
                                    $xhtml .= "      </div>\n";
                                    $xhtml .= "  </div>\n";
                                    $xhtml .= "</div>\n";
                                }
                                $xhtml .= " </div>\n";
                                $xhtml .= "</div>\n";
                                echo $xhtml;
                                ?>  
                            </div> 
                        </form>
                    </div>
                </div>
            </div>
        </div>                      
    </div>
</div>    




