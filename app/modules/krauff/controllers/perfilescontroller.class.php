<?php

class Modules_Krauff_Controllers_PerfilesController {

    private $_dom;
    private $_url;
    private $_action;
    private $_parameters;
    private $_path_config;

    public function __construct($parameters, $dom, $path_config) {
        $this->_parameters = $parameters;
        $this->_action = $parameters->get_parameter("action", "");
        $action = $this->_action;
        $rc = new ReflectionClass("Modules_Krauff_Controllers_PerfilesController");
        if ($rc->hasMethod($this->_action)) {
            $this->_dom = $dom;
            $this->_path_config = $path_config;
            $this->$action();
        } else {
            $this->stop();
        }
    }

    private function stop() {
        $message = "Moon2 Message:<br/><span style=\"color:red;font-weight: bold\">" . $this->_action . "</span> ";
        $message .= "Controller not implemented in class <span style=\"color:red;font-weight: bold\">" . get_class($this) . "</span>";
        echo $message;
        $this->_parameters->show();
        header("Status: 400 Bad request", false, 400);
        exit();
    }

    public function getUrl() {
        return $this->_url;
    }

// START: Controller private methods
    private function crear() {
        $obj = new Modules_Krauff_Model_Perfiles();
        $obj = $this->_parameters->set_object($obj);

        $FacadePerfiles = new Modules_Krauff_Model_PerfilesFacade();

        if ($FacadePerfiles->add($obj)) {
            $msg = $this->_dom["FMESSAGE"]["success"];
        } else {
            $msg = $this->_dom["FMESSAGE"]["error"];
        }

        $this->_parameters->delete_all();
        $this->_parameters->add("msg", $msg);
        $this->_parameters->add("codperfil", $obj->get_codperfil());
        $cadenaUrl = $this->_parameters->KeyGen();
        //exit();
        $this->_url = $this->_path_config["ROOT"]["modules"] . "/krauff/views/perfiles_admin.php?" . $cadenaUrl;
        $script = "<script>\n";
        $script .= "window.parent.location.href = '{$this->_url}';\n";
        $script .= "</script>\n";
        echo $script;
        exit();
    }

    private function eliminar() {
        $obj = new Modules_Krauff_Model_Perfiles();
        $obj = $this->_parameters->set_object($obj);

        $FacadePerfiles = new Modules_Krauff_Model_PerfilesFacade();

        if ($FacadePerfiles->delete($obj)) {
            $msg = 11;
        } else {
            $msg = 33;
        }

        $this->_parameters->delete_all();
        $this->_parameters->add("msg", $msg);
        $this->_parameters->add("codperfil", $obj->get_codperfil());
        $cadenaUrl = $this->_parameters->KeyGen();

        $this->_url = $this->_path_config["ROOT"]["modules"] . "/krauff/views/perfiles_admin.php?" . $cadenaUrl;
        header("Location: {$this->_url}");
        exit();
    }

    private function editar() {
        $obj = new Modules_Krauff_Model_Perfiles();
        $obj = $this->_parameters->set_object($obj);
        $FacadePerfiles = new Modules_Krauff_Model_PerfilesFacade();

        if ($FacadePerfiles->update($obj)) {
            $msg = 111;
        } else {
            $msg = 333;
        }

        $this->_parameters->delete_all();
        $this->_parameters->add("codperfil", $obj->get_codperfil());
        $this->_parameters->add("msg", $msg);
        $cadenaUrl = $this->_parameters->KeyGen();
        //exit();
        $this->_url = $this->_path_config["ROOT"]["modules"] . "/krauff/views/perfiles_admin.php?" . $cadenaUrl;
        $script = "<script>\n";
        $script.= "window.parent.location.href = '{$this->_url}';\n";
        $script.= "</script>\n";
        echo $script;
        exit();
    }

    private function buscar() {
        $obj = new Modules_Krauff_Model_Perfiles();
        $combo_campos = $this->_parameters->get_parameter("nomcampos", "0");
        $caja_busqueda = $this->_parameters->get_parameter("buscar", "0");

        $this->_parameters->delete_all();
        $this->_parameters->add("codperfil", $obj->get_codperfil());
        $this->_parameters->add("nomcampos", $combo_campos);
        $this->_parameters->add("buscar", $caja_busqueda);
        $cadenaUrl = $this->_parameters->KeyGen();

        $this->_url = $this->_path_config["ROOT"]["modules"] . "/krauff/views/perfiles_admin.php?" . $cadenaUrl;
        header("Location: {$this->_url}");
        exit();
    }

// END: Controller private methods
}

//End class
?>