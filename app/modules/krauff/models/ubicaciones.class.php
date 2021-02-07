<?php

class Modules_Krauff_Model_Ubicaciones {

    private $_codubicacion;               //serial, NOT NULL, Primary key
    private $_codpadre;               //int4, NOT NULL, Fk key
    private $_identificador;               //varchar(10) not null
    private $_nombre;               //varchar(200) not null

    public function __construct() {
        
    }

    function get_codubicacion() {
        return $this->_codubicacion;
    }

    function get_codpadre() {
        return $this->_codpadre;
    }

    function get_identificador() {
        return $this->_identificador;
    }

    function get_nombre() {
        return $this->_nombre;
    }

    function set_codubicacion($_codubicacion) {
        $this->_codubicacion = $_codubicacion;
        return $this;
    }

    function set_codpadre($_codpadre) {
        $this->_codpadre = $_codpadre;
        return $this;
    }

    function set_identificador($_identificador) {
        $this->_identificador = $_identificador;
        return $this;
    }

    function set_nombre($_nombre) {
        $this->_nombre = $_nombre;
        return $this;
    }

}

//End class
?>