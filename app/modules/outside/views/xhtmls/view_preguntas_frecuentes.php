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
        <h1>Preguntas Frecuentes</h1>
    </div>
</section>
<!--End breadcrumb area-->

<!--Start breadcrumb bottom area-->       
<section class="breadcrumb-bottom-area">
    <div class="container">
        <div class="left pull-left">
            <a href="preguntas_frecuentes.php">Preguntas Frecuentes</a>    
        </div>
        <div class="right pull-right">
            <ul>
                <li><a href="index.php">Inicio</a></li>
                <li><i class="fa fa-angle-right" aria-hidden="true"></i></li>
                <li>Preguntas Frecuentes</li>
            </ul>    
        </div>        
    </div>    
</section>     
<!--End breadcrumb bottom area-->

<!--Start our team area--> 
<section class="our-team-area" style="padding-bottom: 60px;">
    <div class="container">
        <div class="row">
            <div class="accordion-box">
                <?php
                if ($cantidad_filas > 0) {
                    $xhtml = "";
                    $Url = clone $Params;
                    $contador = 1;
                    foreach ($filas as $indice => $campo) {
                        $id_fila = $campo["codpregunta"];
                        $pregunta = strip_tags($campo["pregunta"]);
                        $respuesta = $campo["respuesta"];

                        $xhtml .= "<div class=\"accordion accordion-block\">\n";
                        $xhtml .= " <div class=\"accord-btn\"><h4>{$pregunta}</h4></div>\n";
                        $xhtml .= "     <div class=\"accord-content\">\n";
                        $xhtml .= "         <p>{$respuesta}</p>\n";
                        $xhtml .= "     </div>\n";
                        $xhtml .= " </div>\n";
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
    </div>    
</section>
<!--End our team area-->

<!--************************************************************************************************************-->          
<!--ESTA ES LA SECCION DEL FOOTER -->
<!--************************************************************************************************************-->
<?php
require_once("view_footer.php");
?>
<!--************************************************************************************************************-->