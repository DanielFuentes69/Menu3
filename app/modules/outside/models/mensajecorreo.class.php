<?php

class Modules_Outside_Model_MensajeCorreo {

    public static function infoemail($nombre, $telefono, $email, $mensaje, $ipServidor) {
        $xhtml = "<div>\n";
        $xhtml .= "<table style=\"background:#ffffff; background-color:#ffffff; border-top:1px solid #ddd; border-left:1px solid #ddd; border-right:1px solid #ddd; border-bottom:1px solid #ddd; width:600px; height:350px\" align=\"center\">\n";
        $xhtml .= "  <tbody>\n";
        $xhtml .= "     <tr>\n";
        $xhtml .= "       <td style=\"font-weight:800; width:480px; height:100px; border-bottom:2px solid #97CA49; text-align:center; color:#97CA49; font-size:24px; padding:10px\">\n";
        $xhtml .= "         Interesado en Adquirir Productos o Servicios";
        $xhtml .= "       </td>";
        $xhtml .= "     </tr>";
        $xhtml .= "     <tr>";
        $xhtml .= "       <td colspan=\"2\" style=\"width:600px; height:150px; color:#000; font-size:15px; line-height:26px; text-align:left; padding-top:10px; padding-left:40px; padding-right:40px; text-align:justify\" valign=\"top\" align=\"justify\">\n";
        $xhtml .= "        <p>Apreciada Agrocenter S.A.S <span style=\"color:#000; font-size:15px; font-weight:800\">";
        $xhtml .= "        </p>";
        $xhtml .= "        <p>El Contacto <strong>{$nombre}</strong>, ha enviado el siguiente mensaje ";
        $xhtml .= "        <strong>{$mensaje}</strong>.";
        $xhtml .= "        </p>\n";
        $xhtml .= "       </td>";
        $xhtml .= "     </tr>";
        $xhtml .= "     <tr>";
        $xhtml .= "       <td colspan=\"2\" style=\"color:#aba9a9; font-size:15px; height:70px; border-top:2px solid #EFEFEF;   padding:10px; text-align:justify\" align=\"justify\">";
        $xhtml .= "         <p>Correo generado automáticamente por la plataforma <i>Intranet Agrocenter S.A.S</i></p>";
        $xhtml .= "       </td>\n";
        $xhtml .= "     </tr>\n";
        $xhtml .= "  </tbody>\n";
        $xhtml .= "</table>\n";
        $xhtml .= "<br />\n";
        $xhtml .= "<table style=\"width:600px; height:150px; background:#ffffff; border-top:1px solid #ddd; border-left:1px solid #ddd; border-right:1px solid #ddd; border-bottom:1px solid #ddd\" align=\"center\">\n";
        $xhtml .= " <tbody>\n";
        $xhtml .= "  <tr>\n";
        $xhtml .= "   <td style=\"padding-left: 10px;\">\n";
        $xhtml .= "    <span style=\"text-transform: uppercase; font-weight: 700;\">{$nombre}</span>\n";
        $xhtml .= "    <br />";
        $xhtml .= "    {$email}";
        $xhtml .= "    <br />";
        $xhtml .= "    {$telefono}";
        $xhtml .= "    <br />";
        $xhtml .= "   </td>";
        $xhtml .= "   <td style=\"width:200px; height:150px; padding:10px; text-align:right\" valign=\"bottom\">\n";
        $xhtml .= "    <span style=\"color:#aba9a9;\"><i>powered by</i></span> <a href=\"https://www.agrocentersas.com\" target=\"_blank\"><img src=\"{$ipServidor}/intranet/app/images/logo.png\" alt=\"powerByAgrocenterSAS\" style=\"border:0\" /></a>\n";
        $xhtml .= "   </td>\n";
        $xhtml .= "  </tr>\n";
        $xhtml .= " </tbody>\n";
        $xhtml .= "</table>";
        $xhtml .= "<p><br /></p>";
        $xhtml .= "</div>\n";
        return $xhtml;
    }

}

?>