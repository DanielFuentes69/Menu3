<?php

class Moon2_ViewManager_Controller {

    private $_name;
    private $_theme;
    private $_type;
    private $_sysmenu;
    private $_dataPath;
    private $_javafiles;
    private $_stylefiles;
    private $_dataDomain;
    private $_initialValue;
    private $_floatmess;
    private $_navigationBar;
    private $_defaultComponent;
    private $_bodyClass;

    public function __construct() {
        global $DOM;
        global $PATH_CONFIG;

        $this->_bodyClass = "";
        $this->_sysmenu = true;
        $this->_type = "SYSTEM";
        $this->_floatmess = array();
        $this->_javafiles = array();
        $this->_stylefiles = array();
        $this->_navigationBar = array();
        $this->_name = "MOON2.4 Page";
        $this->_theme = "inspinia";
        $this->_dataPath = &$PATH_CONFIG;
        $this->_dataDomain = &$DOM;
        $this->_defaultComponent = "";
        $this->_initialValue = $this->_dataDomain["KRAUFF"]["INITIALVALUE"];
        if (!isset($this->_dataDomain["NOMBRE_PARQUEADERO"])) {
            $this->_dataDomain["NOMBRE_PARQUEADERO"] = $this->_dataDomain["SYSTEMNAME"];
        }
    }

    public function open() {
        $menuHtml = "";
        if ($this->_sysmenu) {
            $menuHtml .= $this->cabeceraMenu($this->_initialValue, $this->_dataPath, $this->_dataDomain);
            $menuHtml .= xhtml_notificaciones($this->_dataPath, $this->_dataDomain);
        }
        $html = xhtml_header($this->_name, $this->_dataPath, $this->_theme, $this->_javafiles, $this->_stylefiles);
        $html .= xhtml_body_open($this->_type, $this->_dataPath, $this->_dataDomain, $this->_bodyClass);
        $html .= $menuHtml;
        $html .= $this->buildNavigationbar();
        return $html;
    }

    public function openLogin() {
        $menuHtml = "";
        $html = xhtml_headerlogin($this->_name, $this->_dataPath, $this->_theme, $this->_javafiles, $this->_stylefiles);
        $html .= xhtml_body_open($this->_type, $this->_dataPath, $this->_dataDomain, $this->_bodyClass);
        $html .= $menuHtml;
        return $html;
    }

    public function openFrontend() {
        $menuHtml = "";
        $html = xhtml_headerfrontend($this->_name, $this->_dataPath, $this->_theme, $this->_javafiles, $this->_stylefiles);
        $html .= xhtml_body_open($this->_type, $this->_dataPath, $this->_dataDomain, $this->_bodyClass);
        $html .= $menuHtml;
        return $html;
    }

    public function close() {
        $floatmess = "";
        if (count($this->_floatmess) > 0) {
            $floatmess = "\n<script type=\"text/javascript\">\n";
            $floatmess .= "  var \$showDuration = 400;\n";
            $floatmess .= "  var \$hideDuration = 1000;\n";
            $floatmess .= "  var \$timeOut = 7000;\n";
            $floatmess .= "  var \$extendedTimeOut = 1000;\n";
            $floatmess .= "  var \$extendedTimeOut = 1000;\n";
            $floatmess .= "  var \$showEasing = \"swing\";\n";
            $floatmess .= "  var \$hideEasing = \"linear\";\n";
            $floatmess .= "  var \$showMethod = \"fadeIn\";\n";
            $floatmess .= "  var \$hideMethod = \"fadeOut\";\n";
            $floatmess .= "  toastr.options = {\n";
            $floatmess .= "    closeButton: 'checked',\n";
            $floatmess .= "    progressBar: 'false',\n";
            $floatmess .= "    positionClass: 'toast-top-right',\n";
            $floatmess .= "    onclick: null\n";
            $floatmess .= "   };\n";

            foreach ($this->_floatmess as $key => $value) {
                $floatmess .= "toastr." . $value["type"] . "('" . $value["title"] . "','" . $value["text"] . "');\n";
            }
            $floatmess .= "</script>\n";
        }
        $html = xhtml_body_close($this->_type, $floatmess);
        return $html;
    }

    public function set_theme($_theme) {
        $this->_theme = $_theme;
    }

    public function set_bodyClass($value) {
        $this->_bodyClass = $value;
    }

    public function set_name($name) {
        $this->_name = $name;
    }

    public function set_type($type) {
        $this->_type = $type;
    }

    public function set_sysmenu($value) {
        $this->_sysmenu = $value;
    }

    public function set_component($value) {
        $this->_defaultComponent = $value;
    }

    public function getView() {
        $fileName = substr(strrchr($_SERVER["SCRIPT_NAME"], "/"), 1);
        $view = "xhtmls/view_" . $fileName;
        return $view;
    }

    public function add_style($path) {
        $html = "<link rel=\"stylesheet\" href=\"{$path}\" type=\"text/css\" />";
        $this->_stylefiles[] = $html;
    }

    public function add_javascript($path) {
        $html = "<script language=\"javascript\" src=\"{$path}\" type=\"text/javascript\"></script>";
        $this->_javafiles[] = $html;
    }

    public function floating_message($idMsg, $idDom, $text, $title) {
        if (!empty($idMsg) && $idMsg == $idDom) {
            $type = "";
            $id = substr($idDom, 0, 1);
            foreach ($this->_dataDomain["FMESSAGE"] as $key => $value) {
                if ($id == $value) {
                    $type = $key;
                }
            }
            $this->_floatmess[$idMsg]["type"] = $type;
            $this->_floatmess[$idMsg]["title"] = $title;
            $this->_floatmess[$idMsg]["text"] = $text;
        }
    }

    public function headerTable($dataArray, $order, $Parameters) {
        $tmp_params = clone $Parameters;
        $xhtml = "<thead>\n";
        $xhtml .= "<tr>\n";
        foreach ($dataArray as $key => $value) {
            if (!empty($value["name"])) {
                $icon = " ";
                $tmp_params->add("order", $key);
                $url_params = $tmp_params->keyGen(false, true);
                $xhtml .= "<th" . $value["size"] . ">";
                if (!empty($value["order"]) && $order == $key) {
                    $icon = "<i class=\"icon-arrow-down\"></i> ";
                }
                $xhtml .= "<a href=\"" . $_SERVER['PHP_SELF'] . "?" . $url_params . "\">{$icon}" . "<label class=\"col-sm-12 control-label\">" . $value["name"] . "</label>" . "</a>";
                $xhtml .= "</th>\n";
            } else {
                $xhtml .= "<th>&nbsp;</th>\n";
            }
        }
        $xhtml .= "</tr>\n";
        $xhtml .= "</thead>\n";
        return $xhtml;
    }

    private function cabeceraMenu($parent, $dataPath, $dataDomain) {
        $html = "";
        $html .= "<div id=\"wrapper\">\n";
        $html .= "  <nav class=\"navbar-default navbar-static-side\" role=\"navigation\">\n";
        $html .= "    <div class=\"sidebar-collapse\">\n";
        $html .= "      <ul class=\"nav\" id=\"side-menu\">\n";
        $html .= xhtml_perfil($dataPath, $dataDomain);
        $html .= $this->buildMenu($parent, $dataPath["MAINPAGE"]);
        $html .= "      </ul>\n";
        $html .= "    </div>\n";
        $html .= "  </nav>\n";
        return $html;
    }

//Methods to load the system menu - start
//**************************************************************************************
    public function buildMenu($parent, $mainPage) {
        $active = "";
        if (empty($this->_defaultComponent)) {
            $active = " class=\"special_link\"";
        }
        $html = "";
        $html .= "<li{$active}>\n";
        $html .= "  <a href=\"{$mainPage}/views\"><i class=\"fa fa-windows\" style=\"font-size: 16px;\"></i><span class=\"nav-label\">Inicio</span></a>\n";
        $html .= "</li>\n";
        $arrayData = $this->_dataDomain["MENUSYSTEM"];
        $components = explode("\\", $this->_defaultComponent);
        $components["first-level"] = (isset($components[1])) ? $components[1] : "";
        $components["second-level"] = (isset($components[2])) ? $components[2] : "";
        $components["third-level"] = (isset($components[3])) ? $components[3] : "";
        foreach ($arrayData as $key => $vector) {
            if ($vector["codpadre"] == $parent) {
                $active = "";
                if ($components["first-level"] == $vector["nombre"]) {
                    $active = " class=\"active\"";
                }
                $html .= "<li{$active }>\n";
                $html .= "  <a href=\"#\"><i class=\"{$vector["icono"]}\" style=\"font-size: 16px;\"></i><span class=\"nav-label\">{$vector["nombre"]}</span><span class=\"fa arrow\"></span></a>\n";
                if ($vector["hijos"] > 0) {
                    $html .= $this->secondLevel($arrayData, $vector["codfunc"], $components);
                }
                $html .= "</li>\n";
            }
        }
        return $html;
    }

    private function secondLevel($arrayData, $codfunc, $components) {
        $html = "";
        $html .= "<ul class=\"nav nav-second-level\">\n";
        foreach ($arrayData as $key => $campo) {
            if ($campo["codpadre"] === $codfunc) {
                if ($campo["hijos"] > 0) {
                    $active = "";
                    if ($components["second-level"] == $campo["nombre"]) {
                        $active = " class=\"active \"";
                    }
                    $html .= "<li{$active}>\n";
                    $html .= "  <a href=\"#\"><i class=\"{$campo["icono"]}\"></i>{$campo["nombre"]}<span class=\"fa arrow\"></span></a>\n";
                    $html .= $this->thirdLevel($arrayData, $campo["codfunc"], $components);
                    $html .= "</li>\n";
                } else {
                    $active = "";
                    if ($components["second-level"] == $campo["nombre"]) {
                        $active = " class=\"active special_link\"";
                    }
                    $html .= "<li{$active}><a href=\"" . $this->_dataPath["ROOT"]["modules"] . "/" . $campo["urlpagina"] . "\">" . $campo["nombre"] . "</a></li>\n";
                }
            }
        }
        $html .= "</ul>\n";
        return $html;
    }

    private function thirdLevel($arrayData, $codfunc, $components) {
        $html = "";
        $html .= "<ul class=\"nav nav-third-level\">\n";
        foreach ($arrayData as $key => $campo) {
            if ($campo["codpadre"] === $codfunc) {
                $active = "";

                if ($components["third-level"] == $campo["nombre"]) {
                    $active = " class=\"active special_link\"";
                }
                $html .= "<li{$active }><a href=\"" . $this->_dataPath["ROOT"]["modules"] . "/" . $campo["urlpagina"] . "\">" . $campo["nombre"] . "</a></li>\n";
            }
        }
        $html .= "</ul>";
        return $html;
    }

//**************************************************************************************
//Navigation Bar start
//**************************************************************************************
    public function add_navigation($text, $url) {
        $i = count($this->_navigationBar);
        $this->_navigationBar[$i]["text"] = trim($text);
        $this->_navigationBar[$i]["url"] = $url;
    }

    public function buildNavigationbar() {
        $xhtml = "";
        $total = count($this->_navigationBar);
        if ($total > 0) {
            $last = $total - 1;
            $xhtml .= "<div class=\"row wrapper border-bottom gray-bg g-hidden-xs-down\" style=\"height: 30px; padding-top: 5px;\">\n";
            $xhtml .= "  <div class=\"col-lg-12\">\n";
            $xhtml .= "    <ol class=\"breadcrumb gray-bg\">\n";
            for ($i = 0; $i < $total; $i++) {
                if ($i == $last) {
                    $xhtml .= "<li class=\"active\" style=\"font-size: 13px;\"><strong>" . $this->_navigationBar[$i]["text"] . "</strong></li>\n";
                } else {
                    $xhtml .= "<li style=\"font-size: 13px;\"><a href=\"" . $this->_navigationBar[$i]["url"] . "\">" . $this->_navigationBar[$i]["text"] . "</a></li>\n";
                }
            }
            $xhtml .= "    </ol>\n";
            $xhtml .= "  </div>\n";
            $xhtml .= "</div>\n";
        }
        return $xhtml;
    }

//**************************************************************************************
//Navigation Bar end
}

// End class
?>