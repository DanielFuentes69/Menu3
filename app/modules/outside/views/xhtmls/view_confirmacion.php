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
<!--Start Single news area-->                                                                                 
<section id="news-area" class="single-news-area">
    <div class="container">
        <div class="row">
            <div class="alert alert-success" role="alert">
                <h4 class="alert-heading">Pedido Procesado Correctamente</h4>
                <p>
                    Su pedido será procesado inmediatamente, esperamos hacer su despacho en menos de 24 horas, recuerde que estamos sujetos a los tiempos de las empresas transportadoras.
                </p>
                <hr>
                <p class="mb-0">
                    Si desea realizar un seguimiento de su pedido puede comunicarse a los números telefónicos, 317 520 0585 – 6993454 o escriba al correo electrónico info@agrocentersas.com.
                </p>
                <br/>
                <h4 class="alert-heading">Gracias por su compra</h4>
            </div>
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