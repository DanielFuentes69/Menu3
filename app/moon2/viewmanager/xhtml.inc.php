<?php

function xhtml_header($title, $paths, $theme, $javafiles, $stylesOut) {
    $html = "<!doctype html>\n";
    $html .= "<html lang=\"es-ES\">\n";
    $html .= " <head>\n";
    $html .= "  <meta charset=\"utf-8\">\n";
    $html .= "  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\n";
    $html .= "  <meta http-equiv=\"x-ua-compatible\" content=\"ie=edge\">\n";
    $html .= "  <meta name=\"description\" content=\"Agrocenter SAS | Maquinaria Agrícola | Repuestos Estacionarias | Repuestos Fumigadoras | Repuestos Motores | Repuestos Guadañadoras | Repuestos Motosierras | Repuestos Cortasetos | Respuestos Motor Diesel | Accesorios Cultivador\">\n";
    $html .= "  <meta name=\"keywords\" content=\"Agrocenter SAS, Maquinaria Agrícola, Repuestos Estacionarias, Repuestos Fumigadoras, Repuestos Motores, Repuestos Guadañadoras, Repuestos Motosierras, Repuestos Cortasetos, Respuestos Motor Diesel, Accesorios Cultivador\">\n";
    $html .= "  <meta name=\"author\" content=\"Agrocenter SAS\">\n";
    $html .= "  <title>{$title}</title>\n";
    $html .= "  <link rel=\"icon\" href=\"../../../moon2/themes/inspinia/img/favicon.ico\">\n";
    $html .= xhtml_header_styles($paths, $theme, $stylesOut);
    $html .= xhtml_header_javascripts($paths, $theme, $javafiles);
    $html .= " </head>\n";
    return $html;
}

function xhtml_headerlogin($title, $paths, $theme, $javafiles, $stylesOut) {
    $html = "<!doctype html>\n";
    $html .= "<html lang=\"es-ES\">\n";
    $html .= " <head>\n";
    $html .= "  <meta charset=\"utf-8\">\n";
    $html .= "  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\n";
    $html .= "  <meta http-equiv=\"x-ua-compatible\" content=\"ie=edge\">\n";
    $html .= "  <meta name=\"description\" content=\"Agrocenter SAS | Maquinaria Agrícola | Repuestos Estacionarias | Repuestos Fumigadoras | Repuestos Motores | Repuestos Guadañadoras | Repuestos Motosierras | Repuestos Cortasetos | Respuestos Motor Diesel | Accesorios Cultivador\">\n";
    $html .= "  <meta name=\"keywords\" content=\"Agrocenter SAS, Maquinaria Agrícola, Repuestos Estacionarias, Repuestos Fumigadoras, Repuestos Motores, Repuestos Guadañadoras, Repuestos Motosierras, Repuestos Cortasetos, Respuestos Motor Diesel, Accesorios Cultivador\">\n";
    $html .= "  <meta name=\"author\" content=\"Agrocenter SAS\">\n";
    $html .= "  <title>{$title}</title>\n";
    $html .= "  <link rel=\"icon\" href=\"../../../moon2/themes/login/images/favicon.ico\">\n";
    $html .= xhtml_header_styleslogin($paths, $theme, $stylesOut);
    $html .= xhtml_header_javascriptslogin($paths, $theme, $javafiles);
    $html .= " </head>\n";
    return $html;
}

function xhtml_headerfrontend($title, $paths, $theme, $javafiles, $stylesOut) {
    $html = "<!doctype html>\n";
    $html .= "<html lang=\"es-ES\">\n";
    $html .= " <head>\n";
    $html .= "  <meta charset=\"utf-8\">\n";
    $html .= "  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\n";
    $html .= "  <meta http-equiv=\"x-ua-compatible\" content=\"ie=edge\">\n";
    $html .= "  <meta name=\"description\" content=\"Agrocenter SAS | Maquinaria Agrícola | Repuestos Estacionarias | Repuestos Fumigadoras | Repuestos Motores | Repuestos Guadañadoras | Repuestos Motosierras | Repuestos Cortasetos | Respuestos Motor Diesel | Accesorios Cultivador\">\n";
    $html .= "  <meta name=\"keywords\" content=\"Agrocenter SAS, Maquinaria Agrícola, Repuestos Estacionarias, Repuestos Fumigadoras, Repuestos Motores, Repuestos Guadañadoras, Repuestos Motosierras, Repuestos Cortasetos, Respuestos Motor Diesel, Accesorios Cultivador\">\n";
    $html .= "  <meta name=\"author\" content=\"Agrocenter SAS\">\n";
    $html .= "  <title>{$title}</title>\n";
    $html .= "  <link rel=\"icon\" href=\"../../../moon2/themes/frontend/img/favicon.ico\">\n";
    $html .= "  <script src=\"https://maps.googleapis.com/maps/api/js?key=AIzaSyAHzPSV2jshbjI8fqnC_C4L08ffnj5EN3A\"></script>\n";
    $html .= xhtml_header_stylesfrontend($paths, $theme, $stylesOut);
    $html .= xhtml_header_javascriptsfrontend($paths, $theme, $javafiles);
    $html .= " </head>\n";
    return $html;
}

function xhtml_header_styles($paths, $theme, $stylesOut) {
    $html = "<!-- Style load -->\n";
    $path = $paths["ROOT"]["moon"] . "/themes/{$theme}/";
    $styles = array();
    $styles[] = "css/bootstrap.css";
    $styles[] = "font-awesome/css/font-awesome.css";
    $styles[] = "css/plugins/morris/morris-0.4.3.min.css";
    $styles[] = "css/plugins/toastr/toastr.min.css";
    $styles[] = "css/plugins/jQueryUI/jquery-ui-1.10.4.custom.min.css";
    $styles[] = "css/plugins/jQueryUI/jquery-ui.css";
    $styles[] = "css/animate.css";
    $styles[] = "css/style.css";
    $styles[] = "css/plugins/iCheck/custom.css";
    $styles[] = "css/plugins/colorpicker/bootstrap-colorpicker.min.css";
    $styles[] = "css/plugins/cropper/cropper.min.css";
    $styles[] = "css/plugins/switchery/switchery.css";
    $styles[] = "css/plugins/nouslider/jquery.nouislider.css";
    $styles[] = "css/plugins/datapicker/datepicker3.css";
    $styles[] = "css/plugins/ionRangeSlider/ion.rangeSlider.css";
    $styles[] = "css/plugins/ionRangeSlider/ion.rangeSlider.skinFlat.css";
    $styles[] = "css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css";
    $styles[] = "css/plugins/clockpicker/clockpicker.css";
    $styles[] = "css/plugins/daterangepicker/daterangepicker-bs3.css";
    $styles[] = "css/plugins/blueimp/css/blueimp-gallery.min.css";
    $styles[] = "css/plugins/jasny/jasny-bootstrap.min.css";
    $styles[] = "css/plugins/switchery/switchery.css";
    $styles[] = "css/plugins/select2/select2.min.css";
    $styles[] = "css/resoluciones.css";
    $styles[] = "css/plugins/summernote/summernote-lite.css";
    //$styles[] = "css/plugins/summernote/summernote-bs4.css";

    foreach ($styles as $key => $value) {
        $html .= "<link rel=\"stylesheet\" href=\"{$path}{$value}\" type=\"text/css\" />\n";
    }
    //Calendar begin
    $stylesOut[] = "<link rel=\"stylesheet\" href=\"" . $paths["ROOT"]["moon"] . "/calendar/css/jscal2.css\" type=\"text/css\" />";
    $stylesOut[] = "<link rel=\"stylesheet\" href=\"" . $paths["ROOT"]["moon"] . "/calendar/css/border-radius.css\" type=\"text/css\" />";
    $stylesOut[] = "<link rel=\"stylesheet\" href=\"" . $paths["ROOT"]["moon"] . "/calendar/css/steel.css\" type=\"text/css\" />";
    //Calendar end
    foreach ($stylesOut as $key => $value) {
        $html .= $value . "\n";
    }
    return $html;
}

function xhtml_header_javascripts($paths, $theme, $javafiles) {
    $html = "<!-- Script load -->\n";
    $javas = array();
    //theme
    $path = $paths["ROOT"]["moon"] . "/themes/{$theme}/js/";
    $javas[] = $path . "jquery-2.1.1.js";
    $javas[] = $path . "bootstrap.min.js";
    $javas[] = $path . "plugins/metisMenu/jquery.metisMenu.js";
    $javas[] = $path . "plugins/slimscroll/jquery.slimscroll.min.js";
    $javas[] = $path . "plugins/jquery-ui/jquery-ui.min.js";
    $javas[] = $path . "inspinia.js";
    $javas[] = $path . "plugins/validate/jquery.validate.min.js";
    $javas[] = $path . "plugins/toastr/toastr.min.js";
    $javas[] = $path . "plugins/peity/jquery.peity.min.js";
    $javas[] = $path . "plugins/iCheck/icheck.min.js";
    $javas[] = $path . "demo/peity-demo.js";
    $javas[] = $path . "plugins/cropper/cropper.min.js";
    $javas[] = $path . "plugins/blueimp/jquery.blueimp-gallery.min.js";
    $javas[] = $path . "plugins/jasny/jasny-bootstrap.min.js";
    $javas[] = $path . "plugins/switchery/switchery.js";
    $javas[] = $path . "plugins/datapicker/bootstrap-datepicker.js";
    $javas[] = $path . "plugins/select2/select2.full.min.js";
    $javas[] = $path . "plugins/webcam/webcam.min.js";
    $javas[] = $path . "plugins/away/jquery.away.js";
    $javas[] = $path . "plugins/summernote/summernote-lite.js";
    //$javas[] = $path . "plugins/summernote/summernote-bs4.js";
//    //Calendar begin
    $javas[] = $paths["ROOT"]["moon"] . "/calendar/js/jscal2.js";
    $javas[] = $paths["ROOT"]["moon"] . "/calendar/js/es.js";
//    //Calendar end
    //moon2
    $javas[] = $paths["ROOT"]["moon"] . "/js/moon2.js";
    foreach ($javas as $key => $value) {
        $html .= "<script src=\"{$value}\"></script>\n";
    }

    foreach ($javafiles as $key => $value) {
        $html .= $value . "\n";
    }

    $html .= xhtml_global_java($paths["ROOT"]["moon"]);
    return $html;
}

function xhtml_header_styleslogin($paths, $theme, $stylesOut) {
    $html = "<!-- Style load -->\n";
    $path = $paths["ROOT"]["moon"] . "/themes/{$theme}/";
    $styles = array();
    $styles[] = "vendor/bootstrap/css/bootstrap.min.css";
    $styles[] = "fonts/font-awesome-4.7.0/css/font-awesome.min.css";
    $styles[] = "fonts/Linearicons-Free-v1.0.0/icon-font.min.css";
    $styles[] = "vendor/animate/animate.css";
    $styles[] = "vendor/css-hamburgers/hamburgers.min.css";
    $styles[] = "vendor/animsition/css/animsition.min.css";
    $styles[] = "vendor/select2/select2.min.css";
    $styles[] = "vendor/daterangepicker/daterangepicker.css";
    $styles[] = "css/util.css";
    $styles[] = "css/main.css";
    $styles[] = "css/resoluciones.css";
    $styles[] = "css/particleground.css";

    foreach ($styles as $key => $value) {
        $html .= "<link rel=\"stylesheet\" href=\"{$path}{$value}\" type=\"text/css\" />\n";
    }
    //Calendar begin
    $stylesOut[] = "<link rel=\"stylesheet\" href=\"" . $paths["ROOT"]["moon"] . "/calendar/css/jscal2.css\" type=\"text/css\" />";
    $stylesOut[] = "<link rel=\"stylesheet\" href=\"" . $paths["ROOT"]["moon"] . "/calendar/css/border-radius.css\" type=\"text/css\" />";
    $stylesOut[] = "<link rel=\"stylesheet\" href=\"" . $paths["ROOT"]["moon"] . "/calendar/css/steel.css\" type=\"text/css\" />";
    //Calendar end
    foreach ($stylesOut as $key => $value) {
        $html .= $value . "\n";
    }
    return $html;
}

function xhtml_header_javascriptslogin($paths, $theme, $javafiles) {
    $html = "<!-- Script load -->\n";
    $javas = array();
    //theme
    $path = $paths["ROOT"]["moon"] . "/themes/{$theme}/";
    $javas[] = $path . "vendor/jquery/jquery-3.2.1.min.js";
    $javas[] = $path . "vendor/animsition/js/animsition.min.js";
    $javas[] = $path . "vendor/bootstrap/js/popper.js";
    $javas[] = $path . "vendor/bootstrap/js/bootstrap.min.js";
    $javas[] = $path . "vendor/select2/select2.min.js";
    $javas[] = $path . "vendor/daterangepicker/moment.min.js";
    $javas[] = $path . "vendor/daterangepicker/daterangepicker.js";
    $javas[] = $path . "vendor/countdowntime/countdowntime.js";
    $javas[] = $path . "js/main.js";
    $javas[] = $path . "js/particleground.js";
    $javas[] = $path . "js/jquery.particleground.js";

    $javas[] = $paths["ROOT"]["moon"] . "/calendar/js/jscal2.js";
    $javas[] = $paths["ROOT"]["moon"] . "/calendar/js/es.js";

    $javas[] = $paths["ROOT"]["moon"] . "/js/moon2.js";
    foreach ($javas as $key => $value) {
        $html .= "<script src=\"{$value}\"></script>\n";
    }

    foreach ($javafiles as $key => $value) {
        $html .= $value . "\n";
    }

    $html .= xhtml_global_java($paths["ROOT"]["moon"]);
    return $html;
}

function xhtml_header_stylesfrontend($paths, $theme, $stylesOut) {
    $html = "<!-- carga de estilos-->\n";
    $path = $paths["ROOT"]["moon"] . "/themes/{$theme}/";
    $styles = array();
    $styles[] = "css/style.css";
    $styles[] = "css/responsive.css";
    $styles[] = "css/toastr.min.css";

    foreach ($styles as $key => $value) {
        $html .= "<link rel=\"stylesheet\" href=\"{$path}{$value}\" type=\"text/css\" />\n";
    }

    return $html;
}

function xhtml_header_javascriptsfrontend($paths, $theme, $javafiles) {
    $html = "<!-- Script load -->\n";
    $javas = array();
    //theme
    $path = $paths["ROOT"]["moon"] . "/themes/{$theme}/";
    $javas[] = $path . "js/jquery-1.11.1.min.js";
    $javas[] = $path . "js/bootstrap.min.js";
    $javas[] = $path . "js/jquery.bxslider.min.js";
    $javas[] = $path . "js/jquery.countTo.js";
    $javas[] = $path . "js/owl.carousel.min.js";
    $javas[] = $path . "js/validate.js";
    $javas[] = $path . "js/jquery.mixitup.min.js";
    $javas[] = $path . "js/jquery.easing.min.js";
    $javas[] = $path . "js/gmaps.js";
    $javas[] = $path . "js/map-helper.js";
    $javas[] = $path . "js/jquery.fitvids.js";
    $javas[] = $path . "assets/jquery-ui-1.11.4/jquery-ui.js";
    $javas[] = $path . "assets/fancyapps-fancyBox/source/jquery.fancybox.pack.js";
    $javas[] = $path . "js/jquery.appear.js";
    $javas[] = $path . "assets/revolution/js/jquery.themepunch.tools.min.js";
    $javas[] = $path . "assets/revolution/js/jquery.themepunch.revolution.min.js";
    $javas[] = $path . "assets/revolution/js/extensions/revolution.extension.actions.min.js";
    $javas[] = $path . "assets/revolution/js/extensions/revolution.extension.carousel.min.js";
    $javas[] = $path . "assets/revolution/js/extensions/revolution.extension.kenburn.min.js";
    $javas[] = $path . "assets/revolution/js/extensions/revolution.extension.layeranimation.min.js";
    $javas[] = $path . "assets/revolution/js/extensions/revolution.extension.migration.min.js";
    $javas[] = $path . "assets/revolution/js/extensions/revolution.extension.navigation.min.js";
    $javas[] = $path . "assets/revolution/js/extensions/revolution.extension.parallax.min.js";
    $javas[] = $path . "assets/revolution/js/extensions/revolution.extension.slideanims.min.js";
    $javas[] = $path . "assets/revolution/js/extensions/revolution.extension.video.min.js";
    $javas[] = $path . "js/custom.js";
    $javas[] = $path . "js/toastr.min.js";

    //moon2
    $javas[] = $paths["ROOT"]["moon"] . "/js/moon2.js";
    foreach ($javas as $key => $value) {
        $html .= "<script src=\"{$value}\"></script>\n";
    }

    foreach ($javafiles as $key => $value) {
        $html .= $value . "\n";
    }

    $html .= xhtml_global_java($paths["ROOT"]["moon"]);
    return $html;
}

function xhtml_global_java($path) {
    $html = "<script language=\"javascript\" type=\"text/javascript\">\n";
    $html .= "  var javaPath = \"{$path}\"\n";
    $html .= "</script>\n";
    return $html;
}

function xhtml_body_open($type, $dataPath, $dataDomain, $bodyClass) {
    $html = "";
    $pathModules = $dataPath["ROOT"]["modules"];
    switch ($type) {
        case "FRONTEND":
            $html = "<body class=\"u-body--header-side-static-left\">\n";
            break;
        case "LOGUEO":
            $html = "<body style=\"background-color: #666666;\">";
            break;
        case "FLOAT":
            $html = "<body{$bodyClass}>\n";
            break;
        case "INSIDE":
            $html = "<body class=\"md-skin pace-done fixed-sidebar fixed-nav\">\n";
            break;
        case "LOGIN":
            $html = "<body{$bodyClass}>\n";
            break;
        default:
            $html = "<body{$bodyClass}>\n";
            $html .= "<nav role=\"navigation\" class=\"navbar navbar-inverse\">\n";
            $html .= "   <div class=\"container\">\n";
            $html .= "       <div class=\"navbar-floatm\">\n";
            $html .= "           " . $dataDomain["SYSTEMNAME"] . "\n";
            $html .= "       </div>";
            $html .= "   </div> <!-- /.container -->\n";
            $html .= "</nav>\n";
            break;
    }
    return $html;
}

function xhtml_perfil($dataPath, $dataDomain) {
    $Params = new Moon2_Params_Parameters();
    $quit = $dataPath["QUIT"] . "/login.php?msg=" . urlencode("Sesion finalizada correctamente");
    $pathModules = $dataPath["ROOT"]["modules"];
    $array_nombres = explode(" ", $dataDomain["FULLUSER_NAME"]);
    $nombre_completo_usuario = $array_nombres[0] . " " . $array_nombres[1];
    $imagen_codificada = $dataDomain["USER_IMAGECOD"];
    $mime = $dataDomain["USER_MIME"];

    $Params->add("codificado", $imagen_codificada);
    $Params->add("opt", 1);
    $Params->add("mime", $mime);
    $params_imagen = $Params->keyGen();
    $ruta_imagen_actualizada = "../../main/views/getimage.php?" . $params_imagen;

    $html = "";
    $html .= "<li class=\"nav-header\">\n";
    $html .= "  <div class=\"dropdown profile-element text-center\">\n";
    $html .= "    <span><img alt=\"image\" class=\"img-circle\" src=\"{$ruta_imagen_actualizada}\" style=\"width:80px;\"/></span><br />\n";
    $html .= "    <a href=\"{$pathModules}/krauff/views/perfil_usuario.php\" title=\"Ver mi perfil\">\n";
    $html .= "      <strong class=\"font-bolder\">{$nombre_completo_usuario}</strong>\n";
    $html .= "    </a>\n";
    $html .= "  </div>\n";
    $html .= "  <div class=\"logo-element\">\n";
    $html .= "    MF+\n";
    $html .= "  </div>\n";
    $html .= "</li>\n";
    return $html;
}

function xhtml_notificaciones($dataPath, $dataDomain) {
    $quit = $dataPath["QUIT"] . "/login.php?msg=" . urlencode("Sesion finalizada correctamente");
    $html = "";
    $html .= "<div id=\"page-wrapper\" class=\"gray-bg\">\n";
    $html .= "  <div class=\"row border-bottom\">\n";
    $html .= "      <nav class=\"navbar navbar-fixed-top\" role=\"navigation\" style=\"margin-bottom: 0px;\">\n";
    $html .= "          <div class=\"navbar-header\">\n";
    $html .= "              <a class=\"navbar-minimalize minimalize-styl-2 text-white btn\" style=\"background: #97CA49;\"><i class=\"fa fa-bars\"></i> </a>\n";
    $html .= "              <form role=\"search\" class=\"navbar-form-custom\" action=\"search_results.html\">\n";
    $html .= "                  <div class=\"form-group\" style=\"width:550px;\">\n";
    $html .= "                      <input type=\"text\" readonly=\"\" class=\"form-control welcome-message\" name=\"top-search\" id=\"top-search\" value=\"{$dataDomain["NOMBRE_EMPRESA"]}\">\n";
    $html .= "                  </div>\n";
    $html .= "              </form>\n";
    $html .= "          </div>\n";
    $html .= "          <ul class=\"nav navbar-top-links navbar-right\">\n";
    $html .= "              <li>\n";
    $html .= "                  <a href=\"{$quit}\">\n";
    $html .= "                      <i class=\"fa fa-sign-out\" style=\"font-size: 18px;\"></i> Salir\n";
    $html .= "                  </a>\n";
    $html .= "              </li>\n";
    $html .= "          </ul>\n";
    $html .= "      </nav>\n";
    $html .= "  </div>\n";
    return $html;
}

function xhtml_body_close($type, $floatmess) {
    $html = "";
    switch ($type) {
        case "FLOAT":
            $html = "</body>\n";
            $html .= "</html>\n";
            break;
        case "LOGUEO":
            $html = $floatmess;
            $html .= "</body>\n";
            $html .= "</html>\n";
            break;
        case "FRONTEND":
            $html = $floatmess;
            $html .= "</body>\n";
            $html .= "</html>\n";
            break;
        default:
            $html = xhmtl_modal_delete();
            $html .= $floatmess;
            $html .= "</body>\n";
            $html .= "</html>\n";
            break;
    }
    return $html;
}

function xhmtl_modal_delete() {
    $html = "\n<!-- inicio modal borrar -->\n";
    $html .= "<div id=\"myModalDelete\" class=\"modal inmodal\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">\n";
    $html .= "  <div class=\"modal-dialog\">\n";
    $html .= "    <div class=\"modal-content animated flipInY\">\n";
    $html .= "      <div class=\"modal-body\">\n";
    $html .= "        <strong>¿Está seguro que desea eliminar el registro? </strong>\n";
    $html .= "        <span class=\"edit-content\"></span>\n";
    $html .= "      </div>";
    $html .= "      <div class=\"modal-footer\">\n";
    $html .= "        <button type=\"button\" class=\"btn btn-warning\" data-dismiss=\"modal\">Cancelar</button>\n";
    $html .= "        <button type=\"button\" class=\"btn btn-success\">Aceptar</button>\n";
    $html .= "      </div>\n";
    $html .= "     </div>\n";
    $html .= "   </div>\n";
    $html .= "</div>\n";
    $html .= "<!--fin modal borrar-->\n";

    $html .= "\n<!-- inicio modal borrar2 -->\n";
    $html .= "<div id=\"myModalDelete2\" class=\"modal inmodal\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">\n";
    $html .= "  <div class=\"modal-dialog\">\n";
    $html .= "    <div class=\"modal-content animated flipInY\">\n";
    $html .= "      <div class=\"modal-body\">\n";
    $html .= "        <strong>¿Está seguro que desea eliminar el registro? </strong>\n";
    $html .= "      </div>";
    $html .= "      <div class=\"modal-footer\">\n";
    $html .= "        <button type=\"button\" class=\"btn btn-warning\" data-dismiss=\"modal\">Cancelar</button>\n";
    $html .= "        <button type=\"button\" class=\"btn btn-success\">Aceptar</button>\n";
    $html .= "      </div>\n";
    $html .= "     </div>\n";
    $html .= "   </div>\n";
    $html .= "</div>\n";
    $html .= "<!--fin modal borrar2-->\n";
    return $html;
}

?>