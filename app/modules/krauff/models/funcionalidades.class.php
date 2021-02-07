<?php

class Modules_Krauff_Model_Funcionalidades {

    private $_codfunc;              //serial PRIMARY KEY
    private $_codpadre;             //integer
    private $_nombre;               //varchar(100) NOT NULL
    private $_identificador;        //varchar(30) NOT NULL
    private $_orden;                //integer NOT NULL
    private $_urlpagina;            //varchar(100)
    private $_target;               //varchar(50) NOT NULL DEFAULT '_parent'::character varying
    private $_icono;                //varchar(100)
    private $_tipo;                 //varchar(10) NOT NULL DEFAULT 'text'::character varying

    public function __construct() {
        
    }

    public function get_codfunc() {
        return $this->_codfunc;
    }

    public function get_codpadre() {
        return $this->_codpadre;
    }

    public function get_nombre() {
        return $this->_nombre;
    }

    public function get_identificador() {
        return $this->_identificador;
    }

    public function get_orden() {
        return $this->_orden;
    }

    public function get_urlpagina() {
        return $this->_urlpagina;
    }

    public function get_target() {
        return $this->_target;
    }

    public function get_icono() {
        return $this->_icono;
    }

    public function get_tipo() {
        return $this->_tipo;
    }

    public function set_codfunc($_codfunc) {
        $this->_codfunc = $_codfunc;
    }

    public function set_codpadre($_codpadre) {
        $this->_codpadre = $_codpadre;
    }

    public function set_nombre($_nombre) {
        $this->_nombre = $_nombre;
    }

    public function set_identificador($_identificador) {
        $this->_identificador = $_identificador;
    }

    public function set_orden($_orden) {
        $this->_orden = $_orden;
    }

    public function set_urlpagina($_urlpagina) {
        $this->_urlpagina = $_urlpagina;
    }

    public function set_target($_target) {
        $this->_target = $_target;
    }

    public function set_icono($_icono) {
        $this->_icono = $_icono;
    }

    public function set_tipo($_tipo) {
        $this->_tipo = $_tipo;
    }

}

//End class
?>