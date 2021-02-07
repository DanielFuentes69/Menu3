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
<section class="breadcrumb-area" style="background-image: url(../images/contac.jpg);">
    <div class="container text-center">
        <h1>Contáctenos</h1>
    </div>
</section>
<!--End breadcrumb area-->

<!--Start breadcrumb bottom area-->       
<section class="breadcrumb-bottom-area">
    <div class="container">
        <div class="left pull-left">
            <a href="contactenos.php">Contáctenos</a>    
        </div>
        <div class="right pull-right">
            <ul>
                <li><a href="index.php">Inicio</a></li>
                <li><i class="fa fa-angle-right" aria-hidden="true"></i></li>
                <li>Contáctenos</li>
            </ul>    
        </div>        
    </div>    
</section>     
<!--End breadcrumb bottom area-->

<!--Start Contact area-->
<section class="contact-area">
    <div class="container">
        <div class="row">
            <div class="col-md-5 col-sm-7 col-xs-12">
                <div class="contact-details">
                    <h2>CONTACTO</h2>
                    <div class="contact-info-carousel owl-theme owl-carousel">
                        <div class="item">
                            <div class="contact-details-title">
                                <h5>Departamento Ventas</h5>   
                            </div>
                            <ul class="contact-info">
                                <li>
                                    <div class="icon-box">
                                        <span class="flaticon-signs"></span>
                                    </div>
                                    <div class="text-box">
                                        <p><span>Dirección:</span> Zona Industrial Santa Marta Magdalena</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="icon-box">
                                        <span class="flaticon-email-envelope-back-symbol-on-phone-screen"></span>
                                    </div>
                                    <div class="text-box">
                                        <p>
                                            <span>Teléfonos:</span> 
                                            3175727021 - 3175200585 <br>
                                            info@agrocentersas.com
                                        </p>
                                    </div>
                                </li>
                                <li>
                                    <div class="icon-box">
                                        <span class="flaticon-clock-1"></span>
                                    </div>
                                    <div class="text-box">
                                        <p>
                                            <span>Lun - Vie:</span> 08:00 AM - 05:00 PM <br/>
                                            <span>Sabado:</span> 08:00 AM - 02:00 PM <br/>
                                            <span>Domingo Cerrado</span>
                                        </p>
                                    </div>
                                </li>
                            </ul>					
                        </div>
                        <div class="item">
                            <div class="contact-details-title">
                                <h5>Departamento Ventas</h5>   
                            </div>
                            <ul class="contact-info">
                                <li>
                                    <div class="icon-box">
                                        <span class="flaticon-signs"></span>
                                    </div>
                                    <div class="text-box">
                                        <p><span>Dirección:</span> Zona Industrial Santa Marta Magdalena</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="icon-box">
                                        <span class="flaticon-email-envelope-back-symbol-on-phone-screen"></span>
                                    </div>
                                    <div class="text-box">
                                        <p>
                                            <span>Teléfonos:</span> 
                                            3175727021 - 3175200585 <br>
                                            info@agrocentersas.com
                                        </p>
                                    </div>
                                </li>
                                <li>
                                    <div class="icon-box">
                                        <span class="flaticon-clock-1"></span>
                                    </div>
                                    <div class="text-box">
                                        <p>
                                            <span>Lun - Vie:</span> 08:00 AM - 05:00 PM <br/>
                                            <span>Sabado:</span> 08:00 AM - 02:00 PM <br/>
                                            <span>Domingo Cerrado</span>
                                        </p>
                                    </div>
                                </li>
                            </ul>					
                        </div>
                    </div>
                    <div class="contact-social-links">
                        <ul>
                            <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                        </ul>   
                    </div>
                </div>
            </div>
            <div class="col-md-7 col-sm-12 col-xs-12">
                <div class="send-message-form">
                    <div class="title">
                        <h2>ESCRÍBENOS</h2>
                        <span class="border"></span>
                    </div>

                    <form class="contact-form" id="frm_mail" name="frm_mail" method="post" action="moon2.php" onSubmit="javascript:return managedProccess(this);">       
                        <input type="hidden" id="action" name="action" value="enviarEmail"/>
                        <input type="hidden" id="controller" name="controller" value="outside/outsidecontroller"/>
                        <input type="hidden" id="mensaje" name="mensaje" value="<?php echo $msg; ?>"/>
                        <input type="hidden" id="SECURITY_ID" name="SECURITY_ID" value="enabled"/>
                        <div class="row">
                            <div class="col-md-12">
                                <input type="text" id="nombres" name="nombres" placeholder="Nombres *" required="">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" id="correo" name="correo" placeholder="Email *" required="">
                            </div>
                            <div class="col-md-6">
                                <input type="text" id="celular" name="celular" placeholder="Celular" required="">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <textarea id="mensaje" name="mensaje" placeholder="Escriba su mensaje" required=""></textarea> 
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button class="thm-btn yellow-bg" type="submit">Enviar</button>    
                            </div>
                        </div>
                    </form>    
                </div>
            </div>    
        </div>
    </div>
</section> 
<!--End Contact area-->

<!--************************************************************************************************************-->
<!--ESTA ES LA SECCION DEL FOOTER -->
<!--************************************************************************************************************-->
<?php
require_once("view_footer.php");
?>
<!--************************************************************************************************************-->
<script>

</script>