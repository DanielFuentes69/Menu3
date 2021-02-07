<?php
if (!isset($id_security)) {
    echo "<h1>MOON2 Message:<br />Can not call view, requires the view controller</h1>";
    exit();
}
//******************************************************************************
//consulta el array de las imagenes del slider
//******************************************************************************
$SliderFacade = new Modules_Webpage_Model_SliderFacade();
$arrayImagenes = $SliderFacade->allImagenesSlider();
$tamañoArreglo = count($arrayImagenes);
//******************************************************************************
?>
<!--Start rev slider wrapper-->     
<section class="rev_slider_wrapper">
    <div id="slider1" class="rev_slider"  data-version="5.0">
        <ul>
            <?php
            if (empty($arrayImagenes)) {
                $mensaje = "";
                $mensaje .= "<br/><div class=\"alert alert-warning text-center\">";
                $mensaje .= "   <strong>ADVERTENCIA</strong>: No hay imágenes cargadas para el slider.";
                $mensaje .= "</div><br/>";
                echo $mensaje;
            } else {
                $xhtml2 = "";
                foreach ($arrayImagenes as $indice2 => $campo2) {
                    $codSlider = $campo2["codslider"];
                    $imagenCodificada = $campo2["imagencodificada"];
                    $mime = $campo2["mime"];
                    $titulo1 = $campo2["titulo1"];
                    $titulo2 = $campo2["titulo2"];
                    $textoBoton = $campo2["textoboton"];
                    $urlBoton = $campo2["urlboton"];
                    $descripcion = $campo2["descripcion"];
                    $active = $campo2["active"];
                    //******************************************************************
                    //mostramos la  ruta de la imagen
                    //******************************************************************
                    $Url = new Moon2_Params_Parameters();
                    $Url->add("codificado", $imagenCodificada);
                    $Url->add("opt", 2);
                    $Url->add("mime", $mime);
                    $paramsImagen = $Url->keyGen();
                    $rutaImagen = "../../main/views/getimage.php?" . $paramsImagen;
                    //******************************************************************

                    $xhtml2 .= "<li data-transition=\"slidingoverlayleft\">";
                    $xhtml2 .= "    <img src=\"{$rutaImagen}\"  alt=\"\" width=\"1920\" height=\"580\" data-bgposition=\"top center\" data-bgfit=\"cover\" data-bgrepeat=\"no-repeat\" data-bgparallax=\"1\" >";
                    $xhtml2 .= "    <div class=\"tp-caption tp-resizeme\"";
                    $xhtml2 .= "        data-x=\"right\" data-hoffset=\"0\" ";
                    $xhtml2 .= "        data-y=\"center\" data-voffset=\"-4\"";
                    $xhtml2 .= "        data-transform_idle=\"o:1;\"";
                    $xhtml2 .= "        data-transform_in=\"x:[-175%];y:0px;z:0;rX:0;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0.01;s:3000;e:Power3.easeOut;\"";
                    $xhtml2 .= "        data-transform_out=\"s:1000;e:Power3.easeInOut;s:1000;e:Power3.easeInOut;\"";
                    $xhtml2 .= "        data-mask_in=\"x:[100%];y:0;s:inherit;e:inherit;\"";
                    $xhtml2 .= "        data-splitin=\"none\"";
                    $xhtml2 .= "        data-splitout=\"none\"";
                    $xhtml2 .= "        data-start=\"500\">";
                    $xhtml2 .= "        <div class=\"slide-content-box\">";
                    $xhtml2 .= "            <h1>{$titulo1}</h1>";
                    $xhtml2 .= "            <p>{$titulo2}</p>";
                    $xhtml2 .= "            <div class=\"button\">";
                    $xhtml2 .= "                <a class=\"thm-btn yellow-bg\" href=\"{$urlBoton}\">{$textoBoton}</a>";
                    $xhtml2 .= "            </div>";
                    $xhtml2 .= "        </div>";
                    $xhtml2 .= "    </div>";
                    $xhtml2 .= "</li>";
                }
                echo $xhtml2;
            }
            ?>  
        </ul>
    </div>
</section>
<!--End rev slider wrapper--> 