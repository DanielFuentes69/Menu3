<?php

class Modules_Tienda_Model_DetallePedidos {

    private $_coddetallepedido;
    private $_codpedido;
    private $_codproducto;
    private $_cantidad;
    private $_valor;
    private $_impuesto;
    private $_totalparcial;

    public function __construct() {
        
    }

    public function get_coddetallepedido() {
        return $this->_coddetallepedido;
    }

    public function get_codpedido() {
        return $this->_codpedido;
    }

    public function get_codproducto() {
        return $this->_codproducto;
    }

    public function get_cantidad() {
        return $this->_cantidad;
    }

    public function get_valor() {
        return $this->_valor;
    }

    public function get_impuesto() {
        return $this->_impuesto;
    }

    public function get_totalparcial() {
        return $this->_totalparcial;
    }

    public function set_coddetallepedido($_coddetallepedido): void {
        $this->_coddetallepedido = $_coddetallepedido;
    }

    public function set_codpedido($_codpedido): void {
        $this->_codpedido = $_codpedido;
    }

    public function set_codproducto($_codproducto): void {
        $this->_codproducto = $_codproducto;
    }

    public function set_cantidad($_cantidad): void {
        $this->_cantidad = $_cantidad;
    }

    public function set_valor($_valor): void {
        $this->_valor = $_valor;
    }

    public function set_impuesto($_impuesto): void {
        $this->_impuesto = $_impuesto;
    }

    public function set_totalparcial($_totalparcial): void {
        $this->_totalparcial = $_totalparcial;
    }

}

?>