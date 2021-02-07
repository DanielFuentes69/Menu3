<?php

class Modules_Tienda_Model_ListasPrecios {

    private $_codlistaprecio;
    private $_nombrelistaprecio;
    private $_estado;

    public function __construct() {
        
    }

    public function get_codlistaprecio() {
        return $this->_codlistaprecio;
    }

    public function get_nombrelistaprecio() {
        return $this->_nombrelistaprecio;
    }

    public function get_estado() {
        return $this->_estado;
    }

    public function set_codlistaprecio($_codlistaprecio): void {
        $this->_codlistaprecio = $_codlistaprecio;
    }

    public function set_nombrelistaprecio($_nombrelistaprecio): void {
        $this->_nombrelistaprecio = $_nombrelistaprecio;
    }

    public function set_estado($_estado): void {
        $this->_estado = $_estado;
    }

}

?>