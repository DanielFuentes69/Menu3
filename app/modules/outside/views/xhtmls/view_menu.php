
<?php
if (!isset($id_security)) {
    echo "<h1>MOON2 Message:<br />Can not call view, requires the view controller</h1>";
    exit();
}
?>
<!--Start mainmenu area-->
<section class="mainmeu-area stricky">
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-sm-12 col-xs-12">
                <div class="mainmenu-bg clearfix">
                    <nav class="main-menu pull-left">
                        <div class="navbar-header">   	
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div class="navbar-collapse collapse clearfix">
                            <ul class="navigation">
                                <li class="current"><a href="index.php">Inicio</a></li>
                                <li class="dropdown"><a href="#">Compañia</a>
                                    <ul>
                                        <li><a href="nosotros.php">Nosotros</a></li>
                                        <li><a href="equipo.php">Equipo de Trabajo</a></li>
                                        <li><a href="clientes.php">Nuestros Clientes</a></li>
                                        <li><a href="../../krauff/views/login.php">Intranet</a></li>
                                        <li><a href="https://www.agrocentersas.com/webmail" target="_blank">Correo Corporativo</a></li>
                                    </ul>
                                </li>
                                <li><a href="promociones.php">Promociones</a></li>
                                <li><a href="preguntas_frecuentes.php">Preguntas Frecuentes</a></li>
                                <li><a href="blog.php">Blog</a></li>
                                <li><a href="contactenos.php">Contáctenos</a></li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
            <div class="col-md-2 col-sm-12 col-xs-3">
                <div class="quote-button">
                    <a class="thm-btn yellow-bg" href="tienda.php">
                        <i class="fa fa-shopping-cart" aria-hidden="true"></i>Tienda&nbsp;
                        <?php
                        $cantArt = 0;
                        $cookieName = "agroShoppingCart";
                        if (!isset($_COOKIE[$cookieName]) || $_COOKIE[$cookieName] === "[]") {
                            echo "<span id=\"cantArt\" class=\"label label-pill label-primary\"></span>";
                        } else {
                            $arrCarrito = json_decode($_COOKIE[$cookieName], true);
                            $cantArt = count($arrCarrito);
                            echo "<span id=\"cantArt\" class=\"label label-pill label-primary\">{$cantArt}</span>";
                        }
                        ?>
                    </a>
                </div>    
            </div>
        </div>
    </div>
</section>    
<!--End mainmenu area-->     
<script type="text/javascript">
    //**************************************************************************
    //inicializa el chat
    //**************************************************************************

    //**************************************************************************
</script>