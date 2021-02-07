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
<!--Start our team area--> 
<section class="our-team-area" style="padding-bottom: 60px;">
    <div class="container">
        <div class="sec-title">
            <p>Nuestro Equipo</p>
            <h1>Conoce a nuestros expertos</h1>    
        </div> 
        <div class="row">
            <?php
            if (empty($arrayTeam)) {
                $mensaje = "";
                $mensaje .= "<br/><div class=\"alert alert-warning text-center\">";
                $mensaje .= "   <strong>ADVERTENCIA</strong>: No existen registros del equipo de trabajo.";
                $mensaje .= "</div><br/>";
                echo $mensaje;
            } else {
                $xhtml2 = "";
                foreach ($arrayTeam as $indice2 => $campo2) {
                    $codTeam = $campo2["codteam"];
                    $nombre = $campo2["nombre"];
                    $cargo = $campo2["cargo"];
                    $facebook = $campo2["facebook"];
                    $twitter = $campo2["twitter"];
                    $instagram = $campo2["instagram"];
                    $youtube = $campo2["youtube"];
                    $linkedin = $campo2["linkedin"];
                    $imagenCodificada = $campo2["imagencodificada"];
                    $mime = $campo2["mime"];
                    //******************************************************************
                    //mostramos la  ruta de la imagen
                    //******************************************************************
                    $Url = new Moon2_Params_Parameters();
                    $Url->add("codificado", $imagenCodificada);
                    $Url->add("opt", 3);
                    $Url->add("mime", $mime);
                    $paramsImagen = $Url->keyGen();
                    $rutaImagen = "../../main/views/getimage.php?" . $paramsImagen;
                    //******************************************************************

                    if (empty($facebook)) {
                        $facebook = "#";
                        $targetFacebook = "";
                    } else {
                        $targetFacebook = "target=\"_blank\"";
                    }

                    if (empty($twitter)) {
                        $twitter = "#";
                        $targetTwitter = "";
                    } else {
                        $targetTwitter = "target=\"_blank\"";
                    }

                    if (empty($instagram)) {
                        $instagram = "#";
                        $targetInstagram = "";
                    } else {
                        $targetInstagram = "target=\"_blank\"";
                    }

                    if (empty($youtube)) {
                        $youtube = "#";
                        $targetYoutube = "";
                    } else {
                        $targetYoutube = "target=\"_blank\"";
                    }

                    if (empty($linkedin)) {
                        $linkedin = "#";
                        $targetLinkedin = "";
                    } else {
                        $targetLinkedin = "target=\"_blank\"";
                    }

                    $xhtml2 .= "<div class=\"col-md-6 col-sm-12 col-xs-12\" style=\"padding-bottom: 40px;\">";
                    $xhtml2 .= "    <div class=\"single-team-member\">";
                    $xhtml2 .= "        <div class=\"img-holder\">";
                    $xhtml2 .= "            <img src=\"{$rutaImagen}\" alt=\"{$nombre}\">";
                    $xhtml2 .= "            <div class=\"overlay-box\">";
                    $xhtml2 .= "                <div class=\"box\">";
                    $xhtml2 .= "                    <div class=\"content\">";
                    $xhtml2 .= "                        <ul class=\"member-social-links\">";
                    $xhtml2 .= "                            <li><a href=\"{$facebook} {$targetFacebook}\"><i class=\"fa fa-facebook\" aria-hidden=\"true\"></i></a></li>";
                    $xhtml2 .= "                            <li><a href=\"{$twitter} {$targetTwitter}\"><i class=\"fa fa-twitter\" aria-hidden=\"true\"></i></a></li>";
                    $xhtml2 .= "                            <li><a href=\"{$instagram} {$targetInstagram}\"><i class=\"fa fa-instagram\" aria-hidden=\"true\"></i></a></li>";
                    $xhtml2 .= "                        </ul>";
                    $xhtml2 .= "                    </div>";
                    $xhtml2 .= "                </div>";
                    $xhtml2 .= "            </div>";
                    $xhtml2 .= "        </div>";
                    $xhtml2 .= "        <div class=\"text-holder\">";
                    $xhtml2 .= "            <h5>{$cargo}</h5>";
                    $xhtml2 .= "            <h3>{$nombre}</h3>";
                    $xhtml2 .= "            <p>{$youtube}</p>";
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
<!--End our team area-->