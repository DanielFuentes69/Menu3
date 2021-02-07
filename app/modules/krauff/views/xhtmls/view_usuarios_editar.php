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
                                echo $Tabulador->step_header("Datos Basicos");
                                if ($Tabulador->dynamicLoad("Datos Basicos")) {
                                    require("tab01_usuarios_p2.php");
                                }
                                echo $Tabulador->step_footer();

                                echo $Tabulador->step_header("Ubicación");
                                if ($Tabulador->dynamicLoad("Ubicación")) {
                                    require("tab02_usuarios_p2.php");
                                }
                                echo $Tabulador->step_footer();

                                echo $Tabulador->step_header("Usuario - Contraseña");
                                if ($Tabulador->dynamicLoad("Usuario - Contraseña")) {
                                    require("tab03_usuarios_p2.php");
                                }
                                echo $Tabulador->step_footer();

                                echo $Tabulador->step_header("Foto");
                                if ($Tabulador->dynamicLoad("Foto")) {
                                    require("tab04_usuarios_p2.php");
                                }
                                echo $Tabulador->step_footer();

                                echo $Tabulador->step_header("Asignar - Empresas");
                                if ($Tabulador->dynamicLoad("Asignar - Empresas")) {
                                    require("tab05_usuarios_p2.php");
                                }
                                echo $Tabulador->step_footer();
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>