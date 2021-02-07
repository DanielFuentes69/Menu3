<?php

class Modules_Webpage_Model_Clientes {

    private $_codcliente;
    private $_codusuario;
    private $_nombre;
    private $_imagencodificada;
    private $_mime;
    private $_tamanno;
    private $_nombreimagen;
    private $_fecha;
    private $_hora;

    public function __construct() {
        
    }

    public function get_codcliente() {
        return $this->_codcliente;
    }

    public function get_codusuario() {
        return $this->_codusuario;
    }

    public function get_nombre() {
        return $this->_nombre;
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

    public function set_codcliente($_codcliente): void {
        $this->_codcliente = $_codcliente;
    }

    public function set_codusuario($_codusuario): void {
        $this->_codusuario = $_codusuario;
    }

    public function set_nombre($_nombre): void {
        $this->_nombre = $_nombre;
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

}

?>