<?php

class Modules_Krauff_Model_Usuarios {

    private $_codusuario;               //serial, NOT NULL, Primary key
    private $_codperfil;                //integer, NOT NULL, Foreign Key perfiles(codperfil)
    private $_codubicacion;                //integer, NOT NULL, Foreign Key 
    private $_tipodoc;                  //varchar(2)
    private $_documento;                //varchar(30)
    private $_nombres;                  //varchar(150), NOT NULL
    private $_primerapellido;                  //varchar(150), NOT NULL
    private $_segundoapellido;                  //varchar(150), NOT NULL
    private $_correo;                   //varchar(200), NOT NULL
    private $_direccion;                //varchar(100), NULL
    private $_telefono;                 //int8, NULL
    private $_celular;                  //int8, NULL
    private $_whastapp;                  //varchar(100)
    private $_fechanacimiento;          //date, NULL
    private $_genero;                   /* smallint, NOT NULL, DEFAULT 1, Domains CHECK ckc_genero_usuarios:
      1 Masculino
      2 Femenino */
    private $_nombreusuario;            //varchar(100), NOT NULL
    private $_clave;                    //varchar(50), NOT NULL
    private $_imagencodificada;
    private $_mime;
    private $_tamanno;
    private $_nombreimagen;
    private $_fechacreacion;               //date
    private $_estado;               //int2
    private $_edad;               //int2
    private $_tipousuario;

    public function __construct() {
        
    }

    public function get_codusuario() {
        return $this->_codusuario;
    }

    public function get_codperfil() {
        return $this->_codperfil;
    }

    public function get_codubicacion() {
        return $this->_codubicacion;
    }

    public function get_tipodoc() {
        return $this->_tipodoc;
    }

    public function get_documento() {
        return $this->_documento;
    }

    public function get_nombres() {
        return $this->_nombres;
    }

    public function get_primerapellido() {
        return $this->_primerapellido;
    }

    public function get_segundoapellido() {
        return $this->_segundoapellido;
    }

    public function get_correo() {
        return $this->_correo;
    }

    public function get_direccion() {
        return $this->_direccion;
    }

    public function get_telefono() {
        return $this->_telefono;
    }

    public function get_celular() {
        return $this->_celular;
    }

    public function get_whastapp() {
        return $this->_whastapp;
    }

    public function get_fechanacimiento() {
        return $this->_fechanacimiento;
    }

    public function get_genero() {
        return $this->_genero;
    }

    public function get_nombreusuario() {
        return $this->_nombreusuario;
    }

    public function get_clave() {
        return $this->_clave;
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

    public function get_fechacreacion() {
        return $this->_fechacreacion;
    }

    public function get_estado() {
        return $this->_estado;
    }

    public function get_edad() {
        return $this->_edad;
    }

    public function get_tipousuario() {
        return $this->_tipousuario;
    }

    public function set_codusuario($_codusuario) {
        $this->_codusuario = $_codusuario;
    }

    public function set_codperfil($_codperfil) {
        $this->_codperfil = $_codperfil;
    }

    public function set_codubicacion($_codubicacion) {
        $this->_codubicacion = $_codubicacion;
    }

    public function set_tipodoc($_tipodoc) {
        $this->_tipodoc = $_tipodoc;
    }

    public function set_documento($_documento) {
        $this->_documento = $_documento;
    }

    public function set_nombres($_nombres) {
        $this->_nombres = $_nombres;
    }

    public function set_primerapellido($_primerapellido) {
        $this->_primerapellido = $_primerapellido;
    }

    public function set_segundoapellido($_segundoapellido) {
        $this->_segundoapellido = $_segundoapellido;
    }

    public function set_correo($_correo) {
        $this->_correo = $_correo;
    }

    public function set_direccion($_direccion) {
        $this->_direccion = $_direccion;
    }

    public function set_telefono($_telefono) {
        $this->_telefono = $_telefono;
    }

    public function set_celular($_celular) {
        $this->_celular = $_celular;
    }

    public function set_whastapp($_whastapp) {
        $this->_whastapp = $_whastapp;
    }

    public function set_fechanacimiento($_fechanacimiento) {
        $this->_fechanacimiento = $_fechanacimiento;
    }

    public function set_genero($_genero) {
        $this->_genero = $_genero;
    }

    public function set_nombreusuario($_nombreusuario) {
        $this->_nombreusuario = $_nombreusuario;
    }

    public function set_clave($_clave) {
        $this->_clave = $_clave;
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

    public function set_fechacreacion($_fechacreacion) {
        $this->_fechacreacion = $_fechacreacion;
    }

    public function set_estado($_estado) {
        $this->_estado = $_estado;
    }

    public function set_edad($_edad) {
        $this->_edad = $_edad;
    }

    public function set_tipousuario($_tipousuario) {
        $this->_tipousuario = $_tipousuario;
    }

}

?>