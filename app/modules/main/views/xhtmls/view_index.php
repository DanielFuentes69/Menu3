<?php
if (!isset($DOM["SECURITY_ID"])) {
    echo "<h1>MOON2 Message:<br />Can not call view, requires the view controller</h1>";
    exit();
}
?>
<link rel="stylesheet" href="../style/adicionales.css" type="text/css" />
<div class="wrapper wrapper-content animated fadeInRight">
    <?php
    foreach ($DOM["MENUSYSTEM"] as $indicePerfil => $camposPerfil) {
        if ($camposPerfil["identificador"] == "MNTO_SLIDER") {
            ?>
            <div class="col-lg-3">
                <a href="../../webpage/views/slider_admin.php">
                    <div class="widget style1 bg-success" style="height: 118px; padding: 25px;">
                        <div class="row">
                            <div class="col-xs-4">
                                <i class="fa fa-dashboard fa-5x"></i>
                            </div>
                            <div class="col-xs-8 text-right">
                                <span style="font-size: 18px;"> Gestionar Slider </span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <?php
            break;
        }
    }
    ?>

    <?php
    foreach ($DOM["MENUSYSTEM"] as $indicePerfil => $camposPerfil) {
        if ($camposPerfil["identificador"] == "MNTO_TEAM") {
            ?>
            <div class="col-lg-3">
                <a href="../../webpage/views/equipotrabajo_admin.php">
                    <div class="widget style1 bg-danger" style="height: 118px; padding: 25px;">
                        <div class="row">
                            <div class="col-xs-4">
                                <i class="fa fa-users fa-5x"></i>
                            </div>
                            <div class="col-xs-8 text-right">
                                <span style="font-size: 18px;"> Gestionar Equipo </span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <?php
            break;
        }
    }
    ?>

    <?php
    foreach ($DOM["MENUSYSTEM"] as $indicePerfil => $camposPerfil) {
        if ($camposPerfil["identificador"] == "MNTO_BLOG") {
            ?>
            <div class="col-lg-3">
                <a href="../../webpage/views/noticias_admin.php">
                    <div class="widget style1 bg-primary" style="height: 118px; padding: 25px;">
                        <div class="row">
                            <div class="col-xs-4">
                                <i class="fa fa-bullhorn fa-5x"></i>
                            </div>
                            <div class="col-xs-8 text-right">
                                <span style="font-size: 18px;"> Gestionar Blog </span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <?php
            break;
        }
    }
    ?>

    <?php
    foreach ($DOM["MENUSYSTEM"] as $indicePerfil => $camposPerfil) {
        if ($camposPerfil["identificador"] == "MNTO_CLI") {
            ?>
            <div class="col-lg-3">
                <a href="../../webpage/views/clientes_admin.php">
                    <div class="widget style1 bg-warning" style="height: 118px; padding: 25px;">
                        <div class="row">
                            <div class="col-xs-4">
                                <i class="fa fa-user-circle fa-5x"></i>
                            </div>
                            <div class="col-xs-8 text-right">
                                <span style="font-size: 18px;"> Gestionar Clientes </span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <?php
            break;
        }
    }
    ?>

    <?php
    foreach ($DOM["MENUSYSTEM"] as $indicePerfil => $camposPerfil) {
        if ($camposPerfil["identificador"] == "MNTO_PRE") {
            ?>
            <div class="col-lg-3">
                <a href="../../webpage/views/preguntas_admin.php">
                    <div class="widget style1 bg-warning" style="height: 118px; padding: 25px;">
                        <div class="row">
                            <div class="col-xs-4">
                                <i class="fa fa-book fa-5x"></i>
                            </div>
                            <div class="col-xs-8 text-right">
                                <span style="font-size: 18px;"> Gestionar Preguntas </span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <?php
            break;
        }
    }
    ?>

    <?php
    foreach ($DOM["MENUSYSTEM"] as $indicePerfil => $camposPerfil) {
        if ($camposPerfil["identificador"] == "MNTO_PROM") {
            ?>
            <div class="col-lg-3">
                <a href="../../webpage/views/promociones_admin.php">
                    <div class="widget style1 bg-primary" style="height: 118px; padding: 25px;">
                        <div class="row">
                            <div class="col-xs-4">
                                <i class="fa fa-shopping-cart fa-5x"></i>
                            </div>
                            <div class="col-xs-8 text-right">
                                <span style="font-size: 18px;"> Gestionar Promociones </span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <?php
            break;
        }
    }
    ?>

    <?php
    foreach ($DOM["MENUSYSTEM"] as $indicePerfil => $camposPerfil) {
        if ($camposPerfil["identificador"] == "MNTO_PRO") {
            ?>
            <div class="col-lg-3">
                <a href="../../tienda/views/productos_admin.php">
                    <div class="widget style1 bg-danger" style="height: 118px; padding: 25px;">
                        <div class="row">
                            <div class="col-xs-4">
                                <i class="fa fa-barcode fa-5x"></i>
                            </div>
                            <div class="col-xs-8 text-right">
                                <span style="font-size: 18px;"> Productos </span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <?php
            break;
        }
    }
    ?>

    <?php
    foreach ($DOM["MENUSYSTEM"] as $indicePerfil => $camposPerfil) {
        if ($camposPerfil["identificador"] == "MNTO_PED") {
            ?>
            <div class="col-lg-3">
                <a href="../../tienda/views/pedidos_admin.php">
                    <div class="widget style1 bg-success" style="height: 118px; padding: 25px;">
                        <div class="row">
                            <div class="col-xs-4">
                                <i class="fa fa-qrcode fa-5x"></i>
                            </div>
                            <div class="col-xs-8 text-right">
                                <span style="font-size: 18px;"> Pedidos </span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <?php
            break;
        }
    }
    ?>
</div>