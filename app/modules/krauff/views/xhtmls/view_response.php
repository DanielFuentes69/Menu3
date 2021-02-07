<?php
if (!isset($id_security)) {
    echo "<h1>MOON2 Message:<br />Can not call view, requires the view controller</h1>";
    exit();
}
$message = "";
if (isset($_GET["msg"])) {
    switch ($_GET["msg"]) {
        case 11:
            $message = "Error el usuario o password es incorrecto.";
            break;
        case 12:
            $message = "No tiene parqueaderos asignados.";
            break;
        case 13:
            $message = "Usted no tiene componentes asignados.";
            break;
    }
}
?>
<div class="middle-box text-center animated fadeInDown">
    <div class="ibox-content">
        <h2>Acceso Denegado</h2>
        <h3 class="font-bold"><?php echo $message; ?></h3>

        <div class="error-desc">
            Sistema de seguridad de la plataforma Activo.<br/>
            Ir a la página de inicio de sesión: <p><br/></p><a href="login.php" class="btn btn-success block full-width m-b">Acceso</a>
        </div>
    </div>
</div>
