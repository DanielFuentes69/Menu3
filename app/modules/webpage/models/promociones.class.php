<?php

class Modules_Webpage_Model_Promociones {

    private $_codpromocion;
    private $_codusuario;
    private $_titulo;
    private $_nombreproducto;
    private $_descripcion;
    private $_porcentaje;
    private $_fechafin;
    private $_imagencodificada;
    private $_mime;
    private $_tamanno;
    private $_nombreimagen;
    private $_fecha;
    private $_hora;

    public function __construct() {
        
    }

    public function get_codpromocion() {
        return $this->_codpromocion;
    }

    public function get_codusuario() {
        return $this->_codusuario;
    }

    public function get_titulo() {
        return $this->_titulo;
    }

    public function get_nombreproducto() {
        return $this->_nombreproducto;
    }

    public function get_descripcion() {
        return $this->_descripcion;
    }

    public function get_porcentaje() {
        return $this->_porcentaje;
    }

    public function get_fechafin() {
        return $this->_fechafin;
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

    public function set_codpromocion($_codpromocion) {
        $this->_codpromocion = $_codpromocion;
    }

    public function set_codusuario($_codusuario) {
        $this->_codusuario = $_codusuario;
    }

    public function set_titulo($_titulo) {
        $this->_titulo = $_titulo;
    }

    public function set_nombreproducto($_nombreproducto) {
        $this->_nombreproducto = $_nombreproducto;
    }

    public function set_descripcion($_descripcion) {
        $this->_descripcion = $_descripcion;
    }

    public function set_porcentaje($_porcentaje) {
        $this->_porcentaje = $_porcentaje;
    }

    public function set_fechafin($_fechafin) {
        $this->_fechafin = $_fechafin;
    }

    public function set_imagencodificada($_imagencodificada) {
        $this->_imagencodificada = $_imagencodificada;
    }

    public function set_mime($_mime) {
        $this->_mime = $_mime;
    }

    public function set_tamanno($_tamanno) {
        $this->_tamanno = $_tamanno;
    }

    public function set_nombreimagen($_nombreimagen) {
        $this->_nombreimagen = $_nombreimagen;
    }

    public function set_fecha($_fecha) {
        $this->_fecha = $_fecha;
    }

    public function set_hora($_hora) {
        $this->_hora = $_hora;
    }

}

?>