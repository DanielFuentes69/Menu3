<?php
if (!isset($id_security)) {
    echo "<h1>MOON2 Message:<br />Can not call view, requires the view controller</h1>";
    exit();
}
$Paginador = new Moon2_Pagination_Pager($rsNumRows, $limit_numrows, $num_page, $Params);
?>
<style>
    .section-padding {
        padding: 30px 0;
    }
    .single-shop-item {
        text-align: center;
    }

    .shop-page .has-divider {
        border-top: 1px solid #F4F4F4;
        margin-top: 25px;
        padding-top: 25px;
    }

    .single-shop-item .img-box {
        background: #F4F4F4;
        padding: 44px 0;
        text-align: center;
        margin-bottom: 18px;
        position: relative;
    }

    .single-shop-item .img-box img {
        transition: all 0.5s ease;
        transform: scale(1);
    }
    .single-shop-item .overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-size: cover;
        transition: all 0.5s ease;
        opacity: 0;
        border-bottom: 0px solid #fbca00;
        overflow: hidden;
    }

    .single-shop-item .star-box {
        margin: 0;
        padding: 0;
        list-style: none;
        margin-top: 5px;
    }

    .single-shop-item .overlay .box {
        display: table;
        width: 100%;
        height: 100%;
    }

    .single-shop-item .price {
        margin-top: 8px;
        margin-bottom: 10px;
    }

    .single-shop-item .price span {
        font-size: 15px;
        font-weight: bold;
        color: #012f5d;
    }

    .single-shop-item .thm-btn {
        width: 100%;
        line-height: 55px;
    }

    .single-shop-item .star-box {
        margin: 0;
        padding: 0;
        list-style: none;
        margin-top: 5px;
    }

    .thm-btn {
        /*border: none;*/
        outline: none;
        background: #146961;
        font-size: 15px;
    }

    .single-shop-item .thm-btn {
        line-height: 35px;
    }

    .thm-btn.thm-blue-bg:hover {
        background: #1D822F;
        color: #fff;
    }

    .single-sidebar-box {
        margin-bottom: 15px;
    }

    .single-sidebar-box.search-widget form {
        background: #F4F4F4;
        width: 100%;
        height: 55px;
    }

    .single-sidebar-box.search-widget form input {
        background: none;
        border: none;
        outline: none;
        width: 70%;
        float: left;
        height: 100%;
        padding-left: 20px;
    }
    .single-sidebar-box.search-widget form button {
        background: #012f5d;
        color: #fbca00;
        font-size: 16px;
        width: 55px;
        border: none;
        outline: none;
        height: 55px;
        line-height: 55px;
        float: right;
        transition: all 0.5s ease;
    }

    .single-sidebar-box {
        margin-bottom: 20px;
    }

    .single-sidebar-box .title {
        background: url(../images/sidebar-title-bg.jpg) repeat top left;
        padding-left: 20px;
    }

    .single-sidebar-box .title h3 {
        font-size: 24px;
        font-weight: 900;
        color: #272727;
        text-transform: uppercase;
        margin: 0;
        line-height: 60px;
    }

    .single-sidebar-box.category-widget ul {
        margin: 0;
        padding: 0;
        list-style: none;
        margin-top: 30px;
    }

    .single-sidebar-box.category-widget ul li {
        list-style: none;
        border-bottom: 1px solid #F5F5F5;
    }

    .single-sidebar-box.category-widget ul li a {
        display: block;
        font-size: 16px;
        line-height: 35px;
        color: #272727;
        transition: all 0.5s ease;
        padding-left: 5px;
    }

    .single-sidebar-box.category-widget ul li a:hover {
        color: #fbca00;
        border: 1px solid #fbca00;
    }

    .single-sidebar-box.category-widget ul li a::before {
        content: '';
        width: 9px;
        height: 9px;
        background: transparent;
        border: 1px solid #fbca00;
        border-radius: 50%;
        display: inline-block;
        margin-right: 15px;
        transition: all 0.5s ease;
    }

    .resaltado {
        background: transparent;
        border: 1px solid #fbca00;
    }

    .shop-page .has-divider {
        margin-top: 0px;
    }

</style>
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
<section class="breadcrumb-area" style="background-image: url(../images/tienda.jpg);">
    <div class="container text-center">
        <h1>Compra en linea</h1>
    </div>
</section>
<!--End breadcrumb area-->

<!--Start breadcrumb bottom area-->       
<section class="breadcrumb-bottom-area">
    <div class="container">
        <div class="left pull-left">
            <a href="contactenos.php">Nuestra tienda</a>    
        </div>
        <div class="right pull-right">
            <ul>
                <li><a href="index.php">Inicio</a></li>
                <li><i class="fa fa-angle-right" aria-hidden="true"></i></li>
                <li>Tienda</li>
            </ul>    
        </div>        
    </div>    
</section>     
<!--End breadcrumb bottom area-->

<!--Start business logic-->
<section class="news-content section-padding shop-page">
    <div class="container">
        <div class="row">
            <?php echo $Paginador->showDetails(); ?>
            <div class="col-md-9">
                <div class="row">
                    <?php
                    foreach ($arregloProductos as $indice => $campo) {
                        $codProducto = $campo["codproducto"];
                        $imagen_codificada = $campo["nombrecodificado"];
                        $mime = $campo["mime"];

                        $Url = new Moon2_Params_Parameters();
                        $Url->add("codificado", $imagen_codificada);
                        $Url->add("opt", 8);
                        $Url->add("mime", $mime);
                        $urlImagen = $Url->keyGen();
                        $ruta_imagen_actualizada = "../../main/views/getimage.php?" . $urlImagen;
                        $imagen_actualizada = "<img style=\"height: 180px; display: block; margin: 0 auto;\" src='{$ruta_imagen_actualizada}' />";
                        ?>
                        <div class="col-md-4 has-divider col-sm-6">
                            <div class="single-shop-item">
                                <div class="img-box">
                                    <?php echo $imagen_actualizada; ?>
                                </div>
                                <div class="content">
                                    <span style="color: #000"><?php echo $campo["nombreproducto"] ?></span>
                                    <div class="price">
                                        <span>$ <?php echo number_format($campo["precio"], 0); ?></span>
                                    </div>
                                    <a onclick="javascript:addPro('<?php echo $codProducto; ?>');" class="thm-blue-bg thm-btn" style="cursor: pointer;">Agregar carrito</a>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <br />
                <?php echo $Paginador->showNavigation(); ?>
            </div>
            <div class="col-md-3">
                <div class="single-sidebar-box search-widget">
                    <form id="frmBuscar" name="frmBuscar" method="post" action="moon2.php" onSubmit="javascript:return managedProccess(this);"> 
                        <input type="hidden" id="action" name="action" value="tiendaBuscar" />
                        <input type="hidden" id="SECURITY_ID" name="SECURITY_ID" value="tienda" />
                        <input type="hidden" id="controller" name="controller" value="Tienda/ProductosController" />
                        <input type="text" name="buscar" id="buscar" />
                        <button type="submit"><i class="fa fa-search"></i></button>
                    </form>
                </div>
                <div class="single-sidebar-box category-widget">
                    <div class="title">
                        <h3>Categorías</h3>
                    </div>
                    <ul>
                        <?php
                        $estilo = "";
                        if (empty($codCategoria)) {
                            $estilo = "resaltado";
                        }
                        $xhtml = "<li><a class=\"{$estilo}\" href=\"tienda.php\">Todas</a></li>\n";
                        ;
                        foreach ($arregloCategorias as $codCategoriaInterna => $nombreCategoria) {
                            $urlCategoriaObj = new Moon2_Params_Parameters();
                            $urlCategoriaObj->add("codcategoria", $codCategoriaInterna);
                            $urlCategoria = $urlCategoriaObj->keyGen();

                            $estilo = "";
                            if ($codCategoria == $codCategoriaInterna) {
                                $estilo = "resaltado";
                            }
                            $xhtml .= "<li><a class=\"{$estilo}\" href=\"tienda.php?{$urlCategoria}\">{$nombreCategoria}</a></li>\n";
                        }
                        echo $xhtml;
                        ?>
                    </ul>
                </div>

                <div class="single-sidebar-box category-widget">
                    <div class="title">
                        <h3>Carrito</h3>
                    </div>
                    <div class="table-responsive"  style="padding-top: 20px;">
                        <table class="table">
                            <tbody id="shopTbody">
                                <?php
                                $cantArt = 0;
                                $totalCompra = 0;
                                $cookieName = "agroShoppingCart";
                                if (!isset($_COOKIE[$cookieName]) || $_COOKIE[$cookieName] === "[]") {
                                    $totalCompraF = "$0";
                                    echo "<tr id=\"trVacio\">\n";
                                    echo "<td style=\"width: 100%;\">Carrito vacío</td>\n";
                                    echo "</tr>\n";
                                } else {
                                    $arrCarrito = json_decode($_COOKIE[$cookieName], true);
                                    foreach ($arrCarrito as $indice => $campo) {
                                        $totalCompra = $totalCompra + $campo["valorsf"];
                                        $valorPantalla = $campo["valor"];

                                        echo "<tr id=\"tr{$campo["cod"]}\">\n";
                                        echo "<td style=\"color: #000; width: 15%;\"><small>{$campo["cant"]}</small></td>\n";
                                        echo "<td style=\"color: #000; width: 55%;\"><small>{$campo["nom"]}</small></td>\n";
                                        echo "<td class=\"text-right\" style=\"color: #000; width: 20%;\"><small>{$valorPantalla}</small></td>\n";
                                        echo "<td style=\"width: 10%;\"><a onclick=\"javascript:delPro('{$campo["cod"]}');\"><i class=\"fa fa-trash\" style=\"color: #e57d20; font-size: 15px; cursor: pointer;\"></i></a></td>\n";
                                        echo "</tr>\n";
                                    }
                                    $cantArt = count($arrCarrito);
                                    $totalCompraF = "$" . number_format($totalCompra, 0);
                                    echo "<script>$(\"#cantArt\").html({$cantArt});</script>\n";
                                    echo "<script>$(\"#valArtUp\").html(\"{$totalCompraF}\");</script>\n";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <strong style="color: #000; font-size: 16px;">Total: <span id="valArtDown">$0</span></strong>
                        <?php echo "<script>$(\"#valArtDown\").html(\"{$totalCompraF}\");</script>\n"; ?>
                    </div>
                    <div class="modal-footer">
                        <a href="pagar_pedido.php">
                            <button type="button" class="btn btn-success btn-sm" tabindex="50">IR A PAGAR</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--End business logic-->

<!--************************************************************************************************************-->
<!--ESTA ES LA SECCION DEL FOOTER -->
<!--************************************************************************************************************-->
<?php
require_once("view_footer.php");
?>
<!--************************************************************************************************************-->