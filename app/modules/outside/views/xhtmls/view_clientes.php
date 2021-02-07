<?php
if (!isset($id_security)) {
    echo "<h1>MOON2 Message:<br />Can not call view, requires the view controller</h1>";
    exit();
}
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
        <h1>Nuestros Clientes</h1>
    </div>
</section>
<!--End breadcrumb area-->

<!--Start breadcrumb bottom area-->       
<section class="breadcrumb-bottom-area">
    <div class="container">
        <div class="left pull-left">
            <a href="clientes.php">Nuestros Clientes</a>    
        </div>
        <div class="right pull-right">
            <ul>
                <li><a href="index.php">Inicio</a></li>
                <li><i class="fa fa-angle-right" aria-hidden="true"></i></li>
                <li>Nuestros Clientes</li>
            </ul>    
        </div>        
    </div>    
</section>     
<!--End breadcrumb bottom area-->

<!--Start project area-->
<section id="project-area">
    <div class="container">
        <div class="row project-content masonary-layout filter-layout">
            <?php
            if (empty($arrayClientes)) {
                $mensaje = "";
                $mensaje .= "<br/><div class=\"alert alert-warning text-center\">";
                $mensaje .= "   <strong>ADVERTENCIA</strong>: No existen registros de clientes.";
                $mensaje .= "</div><br/>";
                echo $mensaje;
            } else {
                $xhtml2 = "";
                foreach ($arrayClientes as $indice2 => $campo2) {
                    $codCliente = $campo2["codcliente"];
                    $nombre = $campo2["nombre"];
                    $imagenCodificada = $campo2["imagencodificada"];
                    $mime = $campo2["mime"];
                    //******************************************************************
                    //mostramos la  ruta de la imagen
                    //******************************************************************
                    $Url = new Moon2_Params_Parameters();
                    $Url->add("codificado", $imagenCodificada);
                    $Url->add("opt", 7);
                    $Url->add("mime", $mime);
                    $paramsImagen = $Url->keyGen();
                    $rutaImagen = "../../main/views/getimage.php?" . $paramsImagen;
                    //******************************************************************

                    $xhtml2 .= "<div class=\"col-md-4 col-sm-4 col-xs-12 filter-item agriculture technology chemical\">";
                    $xhtml2 .= "    <div class=\"single-project\">";
                    $xhtml2 .= "        <div class=\"img-holder\">";
                    $xhtml2 .= "            <img src=\"{$rutaImagen}\" alt=\"imagen cliente\">";
                    $xhtml2 .= "            <div class=\"overlay-box\">";
                    $xhtml2 .= "                <div class=\"box\">";
                    $xhtml2 .= "                    <div class=\"content\">";
                    $xhtml2 .= "                        <div class=\"title\">";
                    $xhtml2 .= "                            <h3>{$nombre}</h3>";
                    $xhtml2 .= "                        </div>";
                    $xhtml2 .= "                    </div>";
                    $xhtml2 .= "                </div>";
                    $xhtml2 .= "            </div>";
                    $xhtml2 .= "        </div>";
                    $xhtml2 .= "    </div>";
                    $xhtml2 .= "</div>";
                }
                echo $xhtml2;
            }
            ?>
        </div> 
    </div>    
</section>      
<!--End project Area--> 
<!--************************************************************************************************************-->          
<!--ESTA ES LA SECCION DEL FOOTER -->
<!--************************************************************************************************************-->
<?php
require_once("view_footer.php");
?>
<!--************************************************************************************************************-->