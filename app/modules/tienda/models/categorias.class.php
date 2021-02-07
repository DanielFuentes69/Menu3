<?php

class Modules_Tienda_Model_Categorias {

    private $_codcategoria;
    private $_nombrecategoria;
    private $_estado;

    public function __construct() {
        
    }

    public function get_codcategoria() {
        return $this->_codcategoria;
    }

    public function get_nombrecategoria() {
        return $this->_nombrecategoria;
    }

    public function get_estado() {
        return $this->_estado;
    }

    public function set_codcategoria($_codcategoria): void {
        $this->_codcategoria = $_codcategoria;
    }

    public function set_nombrecategoria($_nombrecategoria): void {
        $this->_nombrecategoria = $_nombrecategoria;
    }

    public function set_estado($_estado): void {
        $this->_estado = $_estado;
    }

}

?>