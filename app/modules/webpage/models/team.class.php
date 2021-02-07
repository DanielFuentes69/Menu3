<?php

class Modules_Webpage_Model_Team {

    private $_codteam;
    private $_codusuario;
    private $_nombre;
    private $_cargo;
    private $_facebook;
    private $_twitter;
    private $_instagram;
    private $_youtube;
    private $_linkedin;
    private $_imagencodificada;
    private $_mime;
    private $_tamanno;
    private $_nombreimagen;
    private $_fecha;
    private $_hora;

    public function __construct() {
        
    }

    public function get_codteam() {
        return $this->_codteam;
    }

    public function get_codusuario() {
        return $this->_codusuario;
    }

    public function get_nombre() {
        return $this->_nombre;
    }

    public function get_cargo() {
        return $this->_cargo;
    }

    public function get_facebook() {
        return $this->_facebook;
    }

    public function get_twitter() {
        return $this->_twitter;
    }

    public function get_instagram() {
        return $this->_instagram;
    }

    public function get_youtube() {
        return $this->_youtube;
    }

    public function get_linkedin() {
        return $this->_linkedin;
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

    public function set_codteam($_codteam) {
        $this->_codteam = $_codteam;
    }

    public function set_codusuario($_codusuario) {
        $this->_codusuario = $_codusuario;
    }

    public function set_nombre($_nombre) {
        $this->_nombre = $_nombre;
    }

    public function set_cargo($_cargo) {
        $this->_cargo = $_cargo;
    }

    public function set_facebook($_facebook) {
        $this->_facebook = $_facebook;
    }

    public function set_twitter($_twitter) {
        $this->_twitter = $_twitter;
    }

    public function set_instagram($_instagram) {
        $this->_instagram = $_instagram;
    }

    public function set_youtube($_youtube) {
        $this->_youtube = $_youtube;
    }

    public function set_linkedin($_linkedin) {
        $this->_linkedin = $_linkedin;
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