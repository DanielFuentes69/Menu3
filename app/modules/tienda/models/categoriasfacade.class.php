<?php

class Modules_Tienda_Model_CategoriasFacade implements Moon2_Interfaces_MandatoryModel {

    private $_categoriasDB;

    public function __construct() {
        $this->_categoriasDB = new Modules_Tienda_ModelDb_CategoriasDB();
    }

    // START: Mandatory methods
    public function add($obj) {
        return $this->_categoriasDB->add($obj);
    }

    public function update($obj) {
        return $this->_categoriasDB->update($obj);
    }

    public function delete($obj) {
        return $this->_categoriasDB->delete($obj);
    }

    public function loadOne($obj) {
        return $this->_categoriasDB->loadOne($obj);
    }

    public function add_searchField($key, $field) {
        return $this->_categoriasDB->add_searchField($key, $field);
    }

    public function load_all(&$rsNumRows, $limit_numrows, $page, $Data = array()) {
        return $this->_categoriasDB->load_all($rsNumRows, $limit_numrows, $page, $Data);
    }

    // END: Mandatory methods
    // 
    // *************************************************************************
    // 
    // START: Optional methods
    public function obtenerCategorias() {
        return $this->_categoriasDB->obtenerCategorias();
    }

    public function tieneProductos($codCategoria) {
        return $this->_categoriasDB->tieneProductos($codCategoria);
    }

    // END: Optional methods
}

//End class
?>