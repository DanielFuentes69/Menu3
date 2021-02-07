<?php

class Modules_Tienda_Model_ProductosFacade implements Moon2_Interfaces_MandatoryModel {

    private $_productosDB;

    public function __construct() {
        $this->_productosDB = new Modules_Tienda_ModelDb_ProductosDB();
    }

    // START: Mandatory methods
    public function add($obj) {
        return $this->_productosDB->add($obj);
    }

    public function update($obj) {
        return $this->_productosDB->update($obj);
    }

    public function delete($obj) {
        return $this->_productosDB->delete($obj);
    }

    public function loadOne($obj) {
        return $this->_productosDB->loadOne($obj);
    }

    public function add_searchField($key, $field) {
        return $this->_productosDB->add_searchField($key, $field);
    }

    public function load_all(&$rsNumRows, $limit_numrows, $page, $Data = array()) {
        return $this->_productosDB->load_all($rsNumRows, $limit_numrows, $page, $Data);
    }

    // END: Mandatory methods
    // 
    // *************************************************************************
    // 
    // START: Optional methods

    public function obtenerNombrePrecios($codProducto) {
        return $this->_productosDB->obtenerNombrePrecios($codProducto);
    }

    public function obtenerPrecios($codProducto) {
        return $this->_productosDB->obtenerPrecios($codProducto);
    }

    public function sePuedeBorrar($codProducto) {
        return $this->_productosDB->sePuedeBorrar($codProducto);
    }

    public function obtenerImagenes($codProducto) {
        return $this->_productosDB->obtenerImagenes($codProducto);
    }

    public function eliminarPrecio($codProducto, $codListaPrecio) {
        return $this->_productosDB->eliminarPrecio($codProducto, $codListaPrecio);
    }

    public function crearPrecio($codProducto, $codListaPrecio, $valor) {
        return $this->_productosDB->crearPrecio($codProducto, $codListaPrecio, $valor);
    }

    public function actualizarPrecio($codProducto, $codListaPrecio, $valor) {
        return $this->_productosDB->actualizarPrecio($codProducto, $codListaPrecio, $valor);
    }

    public function obtenerPrecioProducto($codProducto, $codListaPrecio) {
        return $this->_productosDB->obtenerPrecioProducto($codProducto, $codListaPrecio);
    }

    public function infoProducto($codproducto, $codlistaprecio = "") {
        return $this->_productosDB->infoProducto($codproducto, $codlistaprecio = "");
    }

    // END: Optional methods
}

//End class
?>