<?php

class Modules_Tienda_Model_Imagenes {

    private $_codimagen;
    private $_codproducto;
    private $_nombrereal;
    private $_nombrecodificado;
    private $_mime;
    private $_tamanno;

    public function __construct() {
        
    }

    public function get_codimagen() {
        return $this->_codimagen;
    }

    public function get_codproducto() {
        return $this->_codproducto;
    }

    public function get_nombrereal() {
        return $this->_nombrereal;
    }

    public function get_nombrecodificado() {
        return $this->_nombrecodificado;
    }

    public function get_mime() {
        return $this->_mime;
    }

    public function get_tamanno() {
        return $this->_tamanno;
    }

    public function set_codimagen($_codimagen): void {
        $this->_codimagen = $_codimagen;
    }

    public function set_codproducto($_codproducto): void {
        $this->_codproducto = $_codproducto;
    }

    public function set_nombrereal($_nombrereal): void {
        $this->_nombrereal = $_nombrereal;
    }

    public function set_nombrecodificado($_nombrecodificado): void {
        $this->_nombrecodificado = $_nombrecodificado;
    }

    public function set_mime($_mime): void {
        $this->_mime = $_mime;
    }

    public function set_tamanno($_tamanno): void {
        $this->_tamanno = $_tamanno;
    }

}

?>