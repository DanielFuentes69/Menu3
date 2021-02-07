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
        <h1>Nosotros</h1>
    </div>
</section>
<!--End breadcrumb area-->

<!--Start breadcrumb bottom area-->       
<section class="breadcrumb-bottom-area">
    <div class="container">
        <div class="left pull-left">
            <a href="nosotros.php">Nosotros</a>    
        </div>
        <div class="right pull-right">
            <ul>
                <li><a href="index.php">Inicio</a></li>
                <li><i class="fa fa-angle-right" aria-hidden="true"></i></li>
                <li>Nosotros</li>
            </ul>    
        </div>        
    </div>    
</section>     
<!--End breadcrumb bottom area-->

<!--Start welcome Industry area--> 
<section class="welcome-industry-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="content">
                    <div class="sec-title">
                        <p>BIENVENIDO A AGROCENTER COMPANY SAS</p>
                        <h1>SOBRE NOSOTROS</h1>    
                    </div>
                    <p class="text-justify">
                        Agrocenter Company SAS es una empresa líder en el mercado nacional, especializada en el ensamble y distribución de maquinaria, herramientas y repuestos para el sector Agro-Industrial con tecnología de punta a precios razonables. 
                    </p>
                    <div class="caption-box">
                        <p>No conozco la clave del éxito, pero sé que la clave del fracaso es tratar de complacer a todo el mundo.</p>
                        <h4>- Woody Allen</h4>
                    </div>    
                </div>
            </div>
        </div>
    </div>     
</section>
<!--End welcome Industry area--> 

<!--Start special service area--> 
<section class="special-service-area">
    <div class="container-fluid">
        <div class="row">
            <!--Start single item-->
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <div class="single-item pd-bottom text-center">
                    <span class="flaticon-medal"></span>
                    <h3>Excelente Calidad</h3>
                    <span class="border"></span>
                </div>
            </div>
            <!--End single item-->
            <!--Start single item-->
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <div class="single-item pd-bottom text-center">
                    <span class="flaticon-avatar"></span>
                    <h3>Personal Profesional </h3>
                    <span class="border"></span>  
                </div>
            </div>
            <!--End single item-->  
            <!--Start single item-->
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <div class="single-item pd-bottom-2 text-center">
                    <span class="flaticon-justice"></span>
                    <h3>Credibilidad y Responsabilidad</h3>
                    <span class="border"></span>   
                </div>
            </div>
            <!--End single item-->  
            <!--Start single item-->
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <div class="single-item text-center">
                    <span class="flaticon-people"></span>
                    <h3>Eficiente Equipo de Trabajo</h3>
                    <span class="border"></span> 
                </div>
            </div>
            <!--End single item-->      
        </div>
    </div>    
</section>                            
<!--End special service area-->

<!--Start choosing area-->
<section class="choosing-area">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="content">
                    <div class="sec-title">
                        <p>10 Años de Experiencia</p>
                        <h1>Porque Elegirnos</h1>    
                    </div>
                    <ul>
                        <li>
                            <div class="icon-holder">
                                <span class="flaticon-avatar"></span>    
                            </div>
                            <div class="text-holder">
                                <h3>personal profesional</h3>
                                <span>Agrocenter Company SAS</span>
                                <p class="text-justify">
                                    Contamos con personal altamente calificado para asesorar y brindar el soporte necesario en todos nuestros productos.
                                </p>    
                            </div>
                        </li>
                        <li>
                            <div class="icon-holder">
                                <span class="flaticon-interface-2"></span>    
                            </div>
                            <div class="text-holder">
                                <h3>Confie en Nosotros</h3>
                                <span>Agrocenter Company SAS</span>
                                <p class="text-justify">
                                    Te podemos ayudar a encontrar la mejor solución para tus necesidades y requerimientos del día a día.
                                </p>    
                            </div>
                        </li>
                        <li>
                            <div class="icon-holder">
                                <span class="flaticon-tool-1"></span>    
                            </div>
                            <div class="text-holder">
                                <h3>Somos Expertos</h3>
                                <span>Agrocenter Company SAS</span>
                                <p class="text-justify">
                                    Contamos con una larga trayectoria empresarial para ayudarte en todo lo que necesites.
                                </p>    
                            </div>
                        </li>   
                    </ul>
                </div>
            </div>
            <div class="col-md-4">
                <div class="img-box">
                    <img src="../images/recursos/mujer.png" alt="Awesome Image">
                </div>
            </div>
            <div class="col-md-4">
                <form class="contact-form" id="frm_mail" name="frm_mail" method="post" action="moon2.php" onSubmit="javascript:return managedProccess(this);">       
                    <input type="hidden" id="action" name="action" value="enviarEmailNosotros"/>
                    <input type="hidden" id="controller" name="controller" value="outside/outsidecontroller"/>
                    <input type="hidden" id="mensaje" name="mensaje" value="<?php echo $msg; ?>"/>
                    <input type="hidden" id="SECURITY_ID" name="SECURITY_ID" value="enabled"/>
                    <div class="row">
                        <div class="col-md-12">
                            <input type="text" id="nombres" name="nombres" placeholder="Nombres *" required="">
                        </div>
                        <div class="col-md-12">
                            <input type="text" id="celular" name="celular" placeholder="Celular" required="">
                        </div>
                        <div class="col-md-12">
                            <input type="text" id="correo" name="correo" placeholder="Email *" required="">
                        </div>
                        <div class="col-md-12">
                            <textarea id="mensaje" name="mensaje" placeholder="Escriba su mensaje" required=""></textarea> 
                        </div>
                        <div class="col-md-12">
                            <button class="thm-btn yellow-bg" type="submit">Contáctenos</button>
                        </div>
                    </div> 
                </form>  
            </div>
        </div>
    </div>
</section>                                                           
<!--End choosing area-->
<!--Start caption area-->                                                                              
<section class="caption-area text-center" style="background-image:url(../images/recursos/fondonosotros.jpg);">  
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Conozca nuestras líneas de productos y realiza tu pedido.</h1>
                <a class="thm-btn yellow-bg" href="../../outside/views/tienda.php">Tienda en línea</a>    
            </div>
        </div>
    </div>
</section>                                        
<!--End caption area-->  
<!--************************************************************************************************************-->          
<!--ESTA ES LA SECCION DEL FOOTER -->
<!--************************************************************************************************************-->
<?php
require_once("view_footer.php");
?>
<!--************************************************************************************************************-->