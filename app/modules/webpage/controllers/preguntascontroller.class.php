<?php

class Modules_Webpage_Controllers_PreguntasController extends Moon2_Controllers_Manager {

    public function __construct($parameters, $dom, $path_config) {
        parent::__construct($parameters, $dom, $path_config);
    }

    protected function crear() {
        //**********************************************************************
        //recepcion de parametros
        //**********************************************************************
        $obj = new Modules_Webpage_Model_Preguntas();
        $obj = $this->_parameters->set_object($obj);
        //**********************************************************************
        //**********************************************************************
        //creacion de objetos
        //**********************************************************************
        $PreguntasFacade = new Modules_Webpage_Model_PreguntasFacade();
        //**********************************************************************
        $obj->set_codusuario($this->_dom["USER_ID"]);
        if ($PreguntasFacade->add($obj)) {
            $msg = $this->_dom["FMESSAGE"]["success"];
        } else {
            $msg = $this->_dom["FMESSAGE"]["error"];
        }

        $this->_parameters->delete_all();
        $this->_parameters->add("msg", $msg);
        $cadenaUrl = $this->_parameters->KeyGen();
        //exit();
        $this->_url = $this->_path_config["ROOT"]["modules"] . "/webpage/views/preguntas_admin.php?" . $cadenaUrl;
        header("Location: {$this->_url}");
        exit();
    }

    protected function eliminar() {
        //**********************************************************************
        //recepcion de parametros
        //**********************************************************************
        $obj = new Modules_Webpage_Model_Preguntas();
        $obj = $this->_parameters->set_object($obj);
        //**********************************************************************
        //**********************************************************************
        //creacion de objetos
        //**********************************************************************
        $PreguntasFacade = new Modules_Webpage_Model_PreguntasFacade();
        //**********************************************************************
        if ($PreguntasFacade->delete($obj)) {
            $msg = 11;
        } else {
            $msg = 33;
        }

        $this->_parameters->delete_all();
        $this->_parameters->add("msg", $msg);
        $cadenaUrl = $this->_parameters->KeyGen();

        $this->_url = $this->_path_config["ROOT"]["modules"] . "/webpage/views/preguntas_admin.php?" . $cadenaUrl;
        header("Location: {$this->_url}");
        exit();
    }

    protected function editar() {
        //**********************************************************************
        //recepcion de parametros
        //**********************************************************************
        $obj = new Modules_Webpage_Model_Preguntas();
        $obj = $this->_parameters->set_object($obj);
        //**********************************************************************
        //**********************************************************************
        //creacion de objetos
        //**********************************************************************
        $PreguntasFacade = new Modules_Webpage_Model_PreguntasFacade();
        //**********************************************************************
        $obj->set_codusuario($this->_dom["USER_ID"]);
        if ($PreguntasFacade->update($obj)) {
            $msg = 111;
        } else {
            $msg = 333;
        }

        $this->_parameters->delete_all();
        $this->_parameters->add("msg", $msg);
        $cadenaUrl = $this->_parameters->KeyGen();
        //exit();
        $this->_url = $this->_path_config["ROOT"]["modules"] . "/webpage/views/preguntas_admin.php?" . $cadenaUrl;
        header("Location: {$this->_url}");
        exit();
    }

}

?>