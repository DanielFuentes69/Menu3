<?php

class Modules_Krauff_Model_MensajeCorreo {

    public static function infoemail($nombreUsuario, $documento, $nombreEmpresa, $direccion, $telefono) {
        $url = "https://www.mertelimportaciones.com.co/site/app/modules/krauff/views/login.php";
        $xhtml = "<div>";
        $xhtml .= "Bienvenido a la Intranet Mertel Impotaciones.";
        $xhtml .= "<br /><br />";
        $xhtml .= "Señor usuario adjunto a este correo encontrara su USUARIO y CONTRASEÑA necesarios para ingresar a la Intranet Mertel Importaciones ";
        $xhtml .= "donde usted podra generar pedidos en linea.";
        $xhtml .= "<br /><br />";
        $xhtml .= "<table border = '1'>";
        $xhtml .= " <thead>";
        $xhtml .= "     <tr>";
        $xhtml .= "         <th width='20%'>Usuario</th>";
        $xhtml .= "         <th width='20%'>Contraseña</th>";
        $xhtml .= "     </tr>";
        $xhtml .= " </thead>";
        $xhtml .= " <tbody>";
        $xhtml .= "     <tr>";
        $xhtml .= "         <td align='center'>{$nombreUsuario}</td>";
        $xhtml .= "         <td align='center'>{$documento}</td>";
        $xhtml .= "     </tr>";
        $xhtml .= " </tbody>";
        $xhtml .= "</table>";
        $xhtml .= "<br/><br/>";
        $xhtml .= "<span>Para ingresar a la Intranet Mertel Importaciones dirijase al siguiente link :</span>";
        $xhtml .= "<br/>";
        $xhtml .= "<strong><a href='{$url}'>https://www.mertelimportaciones.com.co</a></strong>";
        $xhtml .= "<br/><br/><br/>";
        $xhtml .= "<span>Atentamente,</span>";
        $xhtml .= "<br/><br/><br/>";
        $xhtml .= "<strong>{$nombreEmpresa}</strong>";
        $xhtml .= "<br/>";
        $xhtml .= "<span>Dirección: {$direccion}</span>";
        $xhtml .= "<br/>";
        $xhtml .= "<span>Teléfonos : {$telefono}</span>";
        $xhtml .= "</div>";
        return $xhtml;
    }

}

//End class
?>