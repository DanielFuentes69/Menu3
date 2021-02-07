<?php
if (!isset($id_security)) {
    echo "<h1>MOON2 Message:<br />Can not call view, requires the view controller</h1>";
    exit();
}
//******************************************************************************
//muestra el array con todos los team
//******************************************************************************
$TeamFacade = new Modules_Webpage_Model_TeamFacade();
$arrayTeam = $TeamFacade->allTeam();
//******************************************************************************
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
        <h1>Promociones</h1>
    </div>
</section>
<!--End breadcrumb area-->

<!--Start breadcrumb bottom area-->       
<section class="breadcrumb-bottom-area">
    <div class="container">
        <div class="left pull-left">
            <a href="promociones.php">Promociones</a>    
        </div>
        <div class="right pull-right">
            <ul>
                <li><a href="index.php">Inicio</a></li>
                <li><i class="fa fa-angle-right" aria-hidden="true"></i></li>
                <li>Promociones</li>
            </ul>    
        </div>        
    </div>    
</section>     
<!--End breadcrumb bottom area-->

<!--Start project area-->
<section id="project-area" class="project-single-area">
    <div class="container">
         <?php
            if (empty($arrayPromociones)) {
                $mensaje = "";
                $mensaje .= "<br/><div class=\"alert alert-warning text-center\">";
                $mensaje .= "   <strong>ADVERTENCIA</strong>: No existen registros de promociones.";
                $mensaje .= "</div><br/>";
                echo $mensaje;
            } else {
                $xhtml2 = "";
                foreach ($arrayPromociones as $indice2 => $campo2) {
                    $codPromocion = $campo2["codpromocion"];
                    $titulo = $campo2["titulo"];
                    $nombreProducto = $campo2["nombreproducto"];
                    $descripcion = $campo2["descripcion"];
                    $porcentaje = $campo2["porcentaje"];
                    $fechaFin = Moon2_DateTime_Date::format($campo2["fechafin"], 1);
                    $imagenCodificada = $campo2["imagencodificada"];
                    $mime = $campo2["mime"];

                    //******************************************************************
                    //mostramos la  ruta de la imagen
                    //******************************************************************
                    $Url = new Moon2_Params_Parameters();
                    $Url->add("codificado", $imagenCodificada);
                    $Url->add("opt", 5);
                    $Url->add("mime", $mime);
                    $paramsImagen = $Url->keyGen();
                    $rutaImagen = "../../main/views/getimage.php?" . $paramsImagen;
                    //******************************************************************

                    $xhtml2 .= "<div class=\"row\">";
                    $xhtml2 .= "    <div class=\"col-md-12\">";
                    $xhtml2 .= "        <div id=\"project-single-carousel\" class=\"carousel slide\" data-ride=\"carousel\">";
                    $xhtml2 .= "            <div class=\"carousel-inner\" role=\"listbox\">";
                    $xhtml2 .= "                <div class=\"item active\">";
                    $xhtml2 .= "                    <div class=\"single-item\">";
                    $xhtml2 .= "                        <div class=\"img-holder\">";
                    $xhtml2 .= "                            <img src=\"{$rutaImagen}\" alt=\"Imagen promoción\">";
                    $xhtml2 .= "                        </div>";
                    $xhtml2 .= "                    </div>";
                    $xhtml2 .= "                </div>";
                    $xhtml2 .= "            </div>";
                    $xhtml2 .= "        </div>";
                    $xhtml2 .= "    </div>";
                    $xhtml2 .= "</div>";
                    $xhtml2 .= "<div class=\"row\">";
                    $xhtml2 .= "    <div class=\"col-md-8\">";
                    $xhtml2 .= "        <div class=\"content\">";
                    $xhtml2 .= "            <div class=\"sec-title-two\">";
                    $xhtml2 .= "                <h2>{$titulo}</h2>";
                    $xhtml2 .= "                <span class=\"border\"></span>";
                    $xhtml2 .= "            </div>";
                    $xhtml2 .= "            <p class=\"text-justify\">{$descripcion}</p>";
                    $xhtml2 .= "        </div>";
                    $xhtml2 .= "    </div>";
                    $xhtml2 .= "    <div class=\"col-md-4\">";
                    $xhtml2 .= "        <div class=\"single-project-info\">";
                    $xhtml2 .= "            <ul>";
                    $xhtml2 .= "                <li><span>Producto :</span>{$nombreProducto}</li>";
                    $xhtml2 .= "                <li><span>Descuento %:</span>{$porcentaje}</li>";
                    $xhtml2 .= "                <li><span>Fin Promoción :</span>{$fechaFin}</li>";
                    $xhtml2 .= "            </ul>";
                    $xhtml2 .= "        </div>";
                    $xhtml2 .= "    </div>";
                    $xhtml2 .= "</div><br/><br/>";                   
                }
                echo $xhtml2;
            }
            ?>        
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