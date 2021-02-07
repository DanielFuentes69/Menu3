<?php

class Modules_Webpage_Model_Noticias {

    private $_codnoticia;
    private $_codusuario;
    private $_titulo;
    private $_descripcion;
    private $_imagencodificada;
    private $_mime;
    private $_tamanno;
    private $_nombreimagen;
    private $_fecha;
    private $_hora;
    private $_tipo;
    private $_cantmegusta;

    public function __construct() {
        
    }

    public function get_codnoticia() {
        return $this->_codnoticia;
    }

    public function get_codusuario() {
        return $this->_codusuario;
    }

    public function get_titulo() {
        return $this->_titulo;
    }

    public function get_descripcion() {
        return $this->_descripcion;
    }

    public function get_imagencodificada() {
        return $this->_imagencodificada;
    }

    public function get_mime() {
        return $this->_mime;
    }

    public function get_tamanno() {
        return $this->_tamanno;
    }

    public function get_nombreimagen() {
        return $this->_nombreimagen;
    }

    public function get_fecha() {
        return $this->_fecha;
    }

    public function get_hora() {
        return $this->_hora;
    }

    public function get_tipo() {
        return $this->_tipo;
    }

    public function get_cantmegusta() {
        return $this->_cantmegusta;
    }

    public function set_codnoticia($_codnoticia): void {
        $this->_codnoticia = $_codnoticia;
    }

    public function set_codusuario($_codusuario): void {
        $this->_codusuario = $_codusuario;
    }

    public function set_titulo($_titulo): void {
        $this->_titulo = $_titulo;
    }

    public function set_descripcion($_descripcion): void {
        $this->_descripcion = $_descripcion;
    }

    public function set_imagencodificada($_imagencodificada): void {
        $this->_imagencodificada = $_imagencodificada;
    }

    public function set_mime($_mime): void {
        $this->_mime = $_mime;
    }

    public function set_tamanno($_tamanno): void {
        $this->_tamanno = $_tamanno;
    }

    public function set_nombreimagen($_nombreimagen): void {
        $this->_nombreimagen = $_nombreimagen;
    }

    public function set_fecha($_fecha): void {
        $this->_fecha = $_fecha;
    }

    public function set_hora($_hora): void {
        $this->_hora = $_hora;
    }

    public function set_tipo($_tipo): void {
        $this->_tipo = $_tipo;
    }

    public function set_cantmegusta($_cantmegusta): void {
        $this->_cantmegusta = $_cantmegusta;
    }

}

?>