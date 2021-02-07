<?php
if (!isset($DOM["SECURITY_ID"])) {
    echo "<h1>MOON2 Message:<br />Can not call view, requires the view controller</h1>";
    exit();
}
$imagen_codificada = $Usuario->get_imagencodificada();
$mime = $Usuario->get_mime();

$Url = clone $Params;
$Url->add("codusuario", $cod_usuario);
$params_usuario = $Url->keyGen();

$Url->add("codificado", $imagen_codificada);
$Url->add("opt", 1);
$Url->add("mime", $mime);
$params_imagen = $Url->keyGen();
?>
<div class="wrapper wrapper-content  animated fadeInRight">
    <div class="row">
        <div class="col-sm-4">
            <div class="ibox ">
                <div class="ibox-content">
                    <div class="tab-content">
                        <div id="contact-1" class="tab-pane active">
                            <div class="row m-b-lg">
                                <div class="col-lg-4 text-center">
                                    <h2><?php echo $DOM["FULLUSER_NAME"]; ?></h2>
                                </div>
                                <div class="col-lg-8 text-center">
                                    <strong>
                                        INFORMACI&Oacute;N PERFIL
                                    </strong>
                                    <br><br>
                                    <?php
                                    $ruta_imagen_actualizada = "../../main/views/getimage.php?" . $params_imagen;
                                    $imagen_actualizada = "<img src='{$ruta_imagen_actualizada}' title='Seleccionar Imagen' style='float:right;margin:7px; cursor:pointer; width: 100px;' class='img-circle'/>";
                                    ?>
                                    <div class="m-b-sm">
                                        <label for="FileInput">
                                            <?php echo $imagen_actualizada; ?> 
                                        </label>
                                        <form enctype="multipart/form-data" name="frm_imagenusuario" id="frm_imagenusuario" method="POST" action="moon.php" onsubmit="javascript:return managedProccess(this);">
                                            <input type="hidden" id="action" name="action" value="adjuntarImagen" />
                                            <input type="hidden" id="controller" name="controller" value="krauff/usuarioscontroller" />
                                            <input type="hidden" id="codusuario" name="codusuario" value="<?php echo $DOM["USER_ID"]; ?>" />
                                            <input type="file" id="FileInput" name="FileInput" style="cursor: pointer;  display: none"/>
                                            <input type="submit" id="Up" style="display: none;" />
                                        </form>
                                    </div>                                    
                                </div>

                            </div>
                            <div class="client-status">
                                <div class="full-height-layout">
                                    <strong>Datos Personales</strong>
                                    <ul class="list-group clear-list">
                                        <li class="list-group-item fist-item">
                                            <span class="pull-right"> <?php echo $DOM["PROFILE_NAME"]; ?> </span>
                                            <strong>Perfil</strong>
                                        </li>
                                        <li class="list-group-item">
                                            <span class="pull-right"> <?php echo $Usuario->get_nombreusuario(); ?> </span>
                                            <strong>Nombre Usuario</strong>
                                        </li>
                                        <li class="list-group-item">
                                            <span class="pull-right"> <?php echo $Usuario->get_telefono(); ?> </span>
                                            <strong>Tel&eacute;fono</strong>
                                        </li>
                                        <li class="list-group-item">
                                            <span class="pull-right"> <?php echo $Usuario->get_celular(); ?> </span>
                                            <strong>Celular</strong>
                                        </li>
                                        <li class="list-group-item">
                                            <span class="pull-right"> <?php echo $Usuario->get_direccion(); ?> </span>
                                            <strong>Direcci&oacute;n</strong>
                                        </li>
                                        <li class="list-group-item">
                                            <span class="pull-right"> <?php echo $Usuario->get_correo(); ?> </span>
                                            <strong>Email</strong>
                                        </li>
                                        <li class="list-group-item">
                                        </li>
                                    </ul>      
                                </div>
                            </div>  
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <strong>ACCESOS AL SISTEMA</strong>
                </div>
                <div class="client-detail">
                    <div class="full-height-scroll">
                        <div class="ibox-content inspinia-timeline">

                            <?php
                            $xhtml = "";
                            foreach ($registros_accesos as $indice => $campo) {
                                $hora_ingreso = Moon2_DateTime_Time::format($campo["horaingreso"], 12);
                                $fecha_ingreso = Moon2_DateTime_Date::format($campo["fechaingreso"], 4);
                                $nombre_usuario = $DOM["USER_NAME"];
                                $nombre_plataforma = $DOM["SYSTEMNAME"];

                                $xhtml .= "<div class=\"timeline-item\">";
                                $xhtml .= "<div class=\"row\">";
                                $xhtml .= "<div class=\"col-xs-3 date\">";
                                $xhtml .= "<i class=\"fa fa-user-md\"></i>";
                                $xhtml .= "{$hora_ingreso}";
                                $xhtml .= "<br>";
                                $xhtml .= "<small class=\"text-success\">{$fecha_ingreso}</small>";
                                $xhtml .= "</div>";
                                $xhtml .= "<div class=\"col-xs-7 content no-top-border\">";
                                $xhtml .= "<p class=\"m-b-xs\"><strong>Actividad</strong></p>";
                                $xhtml .= "<p>Inicio Sesión En El Sistema</p>";
                                $xhtml .= "<hr>";
                                $xhtml .= "</div>";
                                $xhtml .= "</div>";
                                $xhtml .= "</div>";
                            }
                            echo $xhtml;
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-2">
            <div class="widget bg-success p-lg text-center">
                <div class="m-b-md">
                    <i class="fa fa-home fa-4x"></i>
                    <h1 class="m-xs"><?php echo $cantidad_accesos; ?></h1>
                    <h3 class="font-bold no-margins">
                        Total
                    </h3>
                    <small>Accesos</small>
                </div>
            </div>
            <div class="widget bg-warning p-lg text-center">
                <div class="m-b-md">
                    <i class="fa fa-hand-o-right fa-4x"></i>
                    <h3 class="m-b-lg"><?php echo Moon2_DateTime_Date::format($Accesos->get_fechaingreso(), 4); ?></h3>
                    <h4 class="m-xs"><?php echo Moon2_DateTime_Time::format($Accesos->get_horaingreso(), 12); ?></h4>
                    <h4 class="font-bold no-margins">
                        Ultimo 
                    </h4>
                    <small>Acceso</small>
                </div>
            </div>
        </div>
    </div>
</div>