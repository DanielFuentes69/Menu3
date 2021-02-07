<?php

class Modules_Tienda_Model_Pedidos {

    private $_codpedido;
    private $_identificador;
    private $_fecha;
    private $_hora;
    private $_documento;
    private $_nombrecliente;
    private $_correo;
    private $_direccion;
    private $_celular;
    private $_despachado;

    public function __construct() {
        
    }

    public function get_codpedido() {
        return $this->_codpedido;
    }

    public function get_identificador() {
        return $this->_identificador;
    }

    public function get_fecha() {
        return $this->_fecha;
    }

    public function get_hora() {
        return $this->_hora;
    }

    public function get_documento() {
        return $this->_documento;
    }

    public function get_nombrecliente() {
        return $this->_nombrecliente;
    }

    public function get_correo() {
        return $this->_correo;
    }

    public function get_direccion() {
        return $this->_direccion;
    }

    public function get_celular() {
        return $this->_celular;
    }

    public function get_despachado() {
        return $this->_despachado;
    }

    public function set_codpedido($_codpedido): void {
        $this->_codpedido = $_codpedido;
    }

    public function set_identificador($_identificador): void {
        $this->_identificador = $_identificador;
    }

    public function set_fecha($_fecha): void {
        $this->_fecha = $_fecha;
    }

    public function set_hora($_hora): void {
        $this->_hora = $_hora;
    }

    public function set_documento($_documento): void {
        $this->_documento = $_documento;
    }

    public function set_nombrecliente($_nombrecliente): void {
        $this->_nombrecliente = $_nombrecliente;
    }

    public function set_correo($_correo): void {
        $this->_correo = $_correo;
    }

    public function set_direccion($_direccion): void {
        $this->_direccion = $_direccion;
    }

    public function set_celular($_celular): void {
        $this->_celular = $_celular;
    }

    public function set_despachado($_despachado): void {
        $this->_despachado = $_despachado;
    }

}

?>