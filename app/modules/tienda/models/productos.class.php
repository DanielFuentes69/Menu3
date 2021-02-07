<?php

class Modules_Tienda_Model_Productos {

    private $_codproducto;
    private $_codcategoria;
    private $_nombreproducto;
    private $_referencia;
    private $_descripcion;
    private $_iva;

    public function __construct() {
        
    }

    public function get_codproducto() {
        return $this->_codproducto;
    }

    public function get_codcategoria() {
        return $this->_codcategoria;
    }

    public function get_nombreproducto() {
        return $this->_nombreproducto;
    }

    public function get_referencia() {
        return $this->_referencia;
    }

    public function get_descripcion() {
        return $this->_descripcion;
    }

    public function get_iva() {
        return $this->_iva;
    }

    public function set_codproducto($_codproducto): void {
        $this->_codproducto = $_codproducto;
    }

    public function set_codcategoria($_codcategoria): void {
        $this->_codcategoria = $_codcategoria;
    }

    public function set_nombreproducto($_nombreproducto): void {
        $this->_nombreproducto = $_nombreproducto;
    }

    public function set_referencia($_referencia): void {
        $this->_referencia = $_referencia;
    }

    public function set_descripcion($_descripcion): void {
        $this->_descripcion = $_descripcion;
    }

    public function set_iva($_iva): void {
        $this->_iva = $_iva;
    }

}

?>