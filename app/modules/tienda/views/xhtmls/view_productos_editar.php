<?php
if (!isset($DOM["SECURITY_ID"])) {
    echo "<h1>MOON2 Message:<br />Can not call view, requires the view controller</h1>";
    exit();
}
?>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="tabs-container">
                <div class="ibox float-e-margins">
                    <div class="ibox-content">
                        <div class="row">
                            <?php echo $Tabulador->show(); ?>
                            <div class="tab-content" style="padding: 15px 15px 15px 15px;">
                                <?php
                                if ($paso == "1") {
                                    echo $Tabulador->step_header("Datos Básicos");
                                    require("tab_productoseditar_p1.php");
                                    echo $Tabulador->step_footer();
                                }
                                if ($paso == "2") {
                                    echo $Tabulador->step_header("Precios");
                                    require("tab_productoseditar_p2.php");
                                    echo $Tabulador->step_footer();
                                }
                                if ($paso == "3") {
                                    echo $Tabulador->step_header("Imágenes");
                                    require("tab_productoseditar_p3.php");
                                    echo $Tabulador->step_footer();
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>