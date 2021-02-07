<?php

class Modules_Webpage_Model_Slider {

    private $_codslider;
    private $_codusuario;
    private $_imagencodificada;
    private $_mime;
    private $_tamanno;
    private $_nombreimagen;
    private $_fecha;
    private $_hora;
    private $_titulo1;
    private $_titulo2;
    private $_textoboton;
    private $_urlboton;
    private $_descripcion;
    private $_colortexto;
    private $_active;

    public function __construct() {
        
    }

    public function get_codslider() {
        return $this->_codslider;
    }

    public function get_codusuario() {
        return $this->_codusuario;
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

    public function get_titulo1() {
        return $this->_titulo1;
    }

    public function get_titulo2() {
        return $this->_titulo2;
    }

    public function get_textoboton() {
        return $this->_textoboton;
    }

    public function get_urlboton() {
        return $this->_urlboton;
    }

    public function get_descripcion() {
        return $this->_descripcion;
    }

    public function get_colortexto() {
        return $this->_colortexto;
    }

    public function get_active() {
        return $this->_active;
    }

    public function set_codslider($_codslider): void {
        $this->_codslider = $_codslider;
    }

    public function set_codusuario($_codusuario): void {
        $this->_codusuario = $_codusuario;
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

    public function set_titulo1($_titulo1): void {
        $this->_titulo1 = $_titulo1;
    }

    public function set_titulo2($_titulo2): void {
        $this->_titulo2 = $_titulo2;
    }

    public function set_textoboton($_textoboton): void {
        $this->_textoboton = $_textoboton;
    }

    public function set_urlboton($_urlboton): void {
        $this->_urlboton = $_urlboton;
    }

    public function set_descripcion($_descripcion): void {
        $this->_descripcion = $_descripcion;
    }

    public function set_colortexto($_colortexto): void {
        $this->_colortexto = $_colortexto;
    }

    public function set_active($_active): void {
        $this->_active = $_active;
    }

}

?>