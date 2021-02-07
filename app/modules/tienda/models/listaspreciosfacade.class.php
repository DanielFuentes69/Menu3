<?php

class Modules_Tienda_Model_ListasPreciosFacade implements Moon2_Interfaces_MandatoryModel {

    private $_listasPreciosDB;

    public function __construct() {
        $this->_listasPreciosDB = new Modules_Tienda_ModelDb_ListasPreciosDB();
    }

    // START: Mandatory methods
    public function add($obj) {
        return $this->_listasPreciosDB->add($obj);
    }

    public function update($obj) {
        return $this->_listasPreciosDB->update($obj);
    }

    public function delete($obj) {
        return $this->_listasPreciosDB->delete($obj);
    }

    public function loadOne($obj) {
        return $this->_listasPreciosDB->loadOne($obj);
    }

    public function add_searchField($key, $field) {
        return $this->_listasPreciosDB->add_searchField($key, $field);
    }

    public function load_all(&$rsNumRows, $limit_numrows, $page, $Data = array()) {
        return $this->_listasPreciosDB->load_all($rsNumRows, $limit_numrows, $page, $Data);
    }

    // END: Mandatory methods
    // 
    // *************************************************************************
    // 
    // START: Optional methods

    public function obtenerListasPreciosDisponibles($codProducto, $estado) {
        return $this->_listasPreciosDB->obtenerListasPreciosDisponibles($codProducto, $estado);
    }

    public function obtenerListasPrecios($estado) {
        return $this->_listasPreciosDB->obtenerListasPrecios($estado);
    }

    public function utilizada($codListaPrecio) {
        return $this->_listasPreciosDB->utilizada($codListaPrecio);
    }

    // END: Optional methods
}

//End class
?>