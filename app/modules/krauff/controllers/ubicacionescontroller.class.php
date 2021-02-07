<?php

class Modules_Krauff_Controllers_UbicacionesController {

    private $_dom;
    private $_url;
    private $_action;
    private $_parameters;
    private $_path_config;

    public function __construct($parameters, $dom, $path_config) {
        $this->_parameters = $parameters;
        $this->_action = $parameters->get_parameter("action", "");
        $action = $this->_action;
        $rc = new ReflectionClass("Modules_Krauff_Controllers_UbicacionesController");
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
        $message.= "Controller not implemented in class <span style=\"color:red;font-weight: bold\">" . get_class($this) . "</span>";
        echo $message;
        $this->_parameters->show();
        header("Status: 400 Bad request", false, 400);
        exit();
    }

    public function getUrl() {
        return $this->_url;
    }

//******************************************************************************
//START: Controller protected methods
//******************************************************************************
    private function buscar() {
        $combo_campos = "nombre";
        $caja_busqueda = $this->_parameters->get_parameter("buscar", "0");

        $this->_parameters->delete_all();
        $this->_parameters->add("nomcampos", $combo_campos);
        $this->_parameters->add("buscar", $caja_busqueda);
        $cadenaUrl = $this->_parameters->KeyGen();

        $this->_url = $this->_path_config["ROOT"]["modules"] . "/krauff/views/ubicaciones_admin.php?" . $cadenaUrl;
        header("Location: {$this->_url}");
        exit();
    }

//******************************************************************************
//******************************************************************************
//START: Controller private methods
//******************************************************************************
//******************************************************************************
}

//End class
?>