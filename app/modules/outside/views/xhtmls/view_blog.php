<?php
if (!isset($id_security)) {
    echo "<h1>MOON2 Message:<br />Can not call view, requires the view controller</h1>";
    exit();
}
$Paginador = new Moon2_Pagination_Pager2($rsNumRows, $limit_numrows, $num_page, $Params);
?>
<!--************************************************************************************************************-->
<!--ESTA ES LA SECCION DEL HEADER -->
<!--************************************************************************************************************-->
<?php
require_once("view_header.php");
?>
<!--************************************************************************************************************-->
<!--************************************************************************************************************-->
<!--ESTA ES LA SECCION DEL MENU -->
<!--************************************************************************************************************-->
<?php
require_once("view_menu.php");
?>
<!--************************************************************************************************************-->
<!--Start breadcrumb area-->     
<section class="breadcrumb-area" style="background-image: url(../images/recursos/breadcrumb-bg.jpg);">
    <div class="container text-center">
        <h1>Blog</h1>
    </div>
</section>
<!--End breadcrumb area-->

<!--Start breadcrumb bottom area-->       
<section class="breadcrumb-bottom-area">
    <div class="container">
        <div class="left pull-left">
            <a href="blog.php">Blog</a>    
        </div>
        <div class="right pull-right">
            <ul>
                <li><a href="index.php">Inicio</a></li>
                <li><i class="fa fa-angle-right" aria-hidden="true"></i></li>
                <li>Blog</li>
            </ul>    
        </div>        
    </div>    
</section>     
<!--End breadcrumb bottom area-->

<!--Start Single news area-->                                                                                 
<section id="news-area" class="single-news-area">
    <div class="container">
        <div class="row">
            <?php
            if ($cantidad_filas > 0) {
                $xhtml = "";
                $Url = clone $Params;
                $controller = "Modules_Webpage_Controllers_NoticiasController";
                foreach ($filas as $indice => $campo) {
                    $id_fila = $campo["codnoticia"];
                    $titulo = $campo["titulo"];
                    $descripcion = $campo["descripcion"];
                    $imagenCodificada = $campo["imagencodificada"];
                    $mime = $campo["mime"];
                    $fecha = Moon2_DateTime_Date::format($campo["fecha"], 2);
                    $hora = Moon2_DateTime_Time::format($campo["hora"], 12);
                    $tipo = $DOM["TIPOBLOG"][$campo["tipo"]];
                    $nombreUsuario = $campo["nomusuario"];
                    $cantidadMegustas = $campo["cantmegusta"];
                    //**********************************************************
                    //parametros para ver la imagen
                    //**********************************************************
                    $UrlRecientes = new Moon2_Params_Parameters();
                    $UrlRecientes->add("codificado", $imagenCodificada);
                    $UrlRecientes->add("opt", 4);
                    $UrlRecientes->add("mime", $mime);
                    $params_imagen = $UrlRecientes->keyGen();
                    $ruta_imagen = "../../main/views/getimage.php?" . $params_imagen;
                    //**********************************************************

                    $mostrarDescripcion = strip_tags($descripcion);
                    $xhtml .= "<div class=\"col-lg-12 col-md-8 col-sm-12 col-xs-12\">\n";
                    $xhtml .= " <div class=\"blog-post\">\n";
                    $xhtml .= "     <div class=\"single-blog-post\">\n";
                    $xhtml .= "         <div class=\"img-holder\">\n";
                    $xhtml .= "             <img src=\"{$ruta_imagen}\" alt=\"Blog\">\n";
                    $xhtml .= "         </div>\n";
                    $xhtml .= "         <div class=\"text-holder\">\n";
                    $xhtml .= "             <h2 class=\"blog-title\">\n";
                    $xhtml .= "                 {$titulo}\n";
                    $xhtml .= "             </h2>\n";
                    $xhtml .= "             <ul class=\"meta-info\">\n";
                    $xhtml .= "                 <li><i class=\"fa fa-clock-o\" aria-hidden=\"true\"></i>{$fecha}</li>\n";
                    $xhtml .= "                 <li><i class=\"fa fa-clock-o\" aria-hidden=\"true\"></i>{$hora}</li>\n";
                    $xhtml .= "                 <li><i class=\"fa fa-tags\" aria-hidden=\"true\"></i>{$tipo}</li>\n";
                    $xhtml .= "                 <li><i class=\"fa fa-heart\" aria-hidden=\"true\" onclick=\"addMegusta({$id_fila})\" style=\"cursor: pointer;\"></i>{$cantidadMegustas} Me Gusta</li>\n";
                    $xhtml .= "             </ul><br/>\n";
                    $xhtml .= "             <div class=\"text-justify\">\n";
                    $xhtml .= "                 <p>{$mostrarDescripcion}</p>\n";
                    $xhtml .= "             </div>\n";
                    $xhtml .= "         </div>\n";
                    $xhtml .= "     </div>\n";
                    $xhtml .= " </div>\n";
                    $xhtml .= "</div>\n";
                }
                echo $xhtml;

                echo $Paginador->showNavigation();
                ?>

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
</section>                                  
<!--End Single news area--> 

<!--************************************************************************************************************-->          
<!--ESTA ES LA SECCION DEL FOOTER -->
<!--************************************************************************************************************-->
<?php
require_once("view_footer.php");
?>
<!--************************************************************************************************************-->
<script type="text/javascript">
    function addMegusta(codNoticia) {
        var ruta = javaPath + "/process/processform.php";
        var frmstr = '<form id="megusta" method="post" action=' + ruta + '>';
        frmstr += '<input type="hidden" id="codnoticia" name="codnoticia" value="' + codNoticia + '"/>';
        frmstr += '<input type="hidden" id="action" name="action" value="addMeGusta"/>';
        frmstr += '<input type="hidden" id="SECURITY_ID" name="SECURITY_ID" value="enabled"/>'
        frmstr += '<input type="hidden" name="controller" value="webpage/noticiascontroller"/></form>';
        $('body').append(frmstr);
        $('#megusta').find('input[name="data"]').val('123');
        $('#megusta').submit();
    }
</script>