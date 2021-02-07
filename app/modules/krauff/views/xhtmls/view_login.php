<?php
if (!isset($id_security)) {
    echo "<h1>MOON2 Message:<br />Can not call view, requires the view controller</h1>";
    exit();
}
?>
<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100">
            <form class="login100-form validate-form" style="padding-top: 60px;" id="frmAcceso" name="frmAcceso" method="post" action="moon24.php" onSubmit="javascript:sendData(this);">
                <input type="hidden" id="action" name="action" value="login" />
                <input type="hidden" id="SECURITY_ID" name="SECURITY_ID" value="enabled" />
                <input type="hidden" id="controller" name="controller" value="krauff/usuarioscontroller" />

                <span class="login100-form-title p-b-10 g-hidden-sm-up">
                    <img src="../images/logo.png" style="width: 200px;">
                </span>
                <span class="login100-form-title p-b-2">
                    Iniciar sesión
                </span>
                <div class="text-center p-t-3 p-b-20">
                    <span class="txt2">
                        Bienvenido, empieza con tus credenciales
                    </span>
                </div>
                <div class="wrap-input100">
                    <input class="input100" type="text" name="usu" id="usu" required="">
                    <span class="focus-input100"></span>
                    <span class="label-input100">Email</span>
                </div>
                <div class="wrap-input100">
                    <input class="input100" type="password" name="cla" id="cla" required="">
                    <span class="focus-input100"></span>
                    <span class="label-input100">Contraseña</span>
                </div>

                <div class="container-login100-form-btn">
                    <button class="login100-form-btn" type="submit">
                        Ingresar
                    </button>
                </div><br/>

                <div class="text-center p-t-10 p-b-10">
                    <span class="txt2">
                        Síguenos en:
                    </span>
                </div>

                <div class="login100-form-social flex-c-m">
                    <a href="#" class="login100-form-social-item flex-c-m bg1 m-r-5">
                        <i class="fa fa-facebook-f" aria-hidden="true"></i>
                    </a>

                    <a href="#" class="login100-form-social-item flex-c-m bg2 m-r-5">
                        <i class="fa fa-twitter" aria-hidden="true"></i>
                    </a>

                    <a href="#" class="login100-form-social-item flex-c-m bg3 m-r-5">
                        <i class="fa fa-google" aria-hidden="true"></i>
                    </a>
                </div>
                <div class="text-center p-t-3 p-b-20">
                    <span class="txt2">
                        <a href="https://www.agrocentersas.com">Visitanos en nuestro sitio web --></a>
                    </span>
                </div>
            </form>
            <div class="login100-more" style="background-image: url('../../../moon2/themes/login/images/login.jpg');">
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $('#usu').focus();
</script>