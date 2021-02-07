<?php

class Modules_Webpage_Model_Preguntas {

    private $_codpregunta;
    private $_codusuario;
    private $_pregunta;
    private $_respuesta;

    public function __construct() {
        
    }

    public function get_codpregunta() {
        return $this->_codpregunta;
    }

    public function get_codusuario() {
        return $this->_codusuario;
    }

    public function get_pregunta() {
        return $this->_pregunta;
    }

    public function get_respuesta() {
        return $this->_respuesta;
    }

    public function set_codpregunta($_codpregunta): void {
        $this->_codpregunta = $_codpregunta;
    }

    public function set_codusuario($_codusuario): void {
        $this->_codusuario = $_codusuario;
    }

    public function set_pregunta($_pregunta): void {
        $this->_pregunta = $_pregunta;
    }

    public function set_respuesta($_respuesta): void {
        $this->_respuesta = $_respuesta;
    }

}

?>