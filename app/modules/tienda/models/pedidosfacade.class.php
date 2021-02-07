<?php

class Modules_Tienda_Model_PedidosFacade implements Moon2_Interfaces_MandatoryModel {

    private $_pedidosDB;

    public function __construct() {
        $this->_pedidosDB = new Modules_Tienda_ModelDb_PedidosDB();
    }

    // START: Mandatory methods
    public function add($obj) {
        return $this->_pedidosDB->add($obj);
    }

    public function update($obj) {
        return $this->_pedidosDB->update($obj);
    }

    public function delete($obj) {
        return $this->_pedidosDB->delete($obj);
    }

    public function loadOne($obj) {
        return $this->_pedidosDB->loadOne($obj);
    }

    public function add_searchField($key, $field) {
        return $this->_pedidosDB->add_searchField($key, $field);
    }

    public function load_all(&$rsNumRows, $limit_numrows, $page, $Data = array()) {
        return $this->_pedidosDB->load_all($rsNumRows, $limit_numrows, $page, $Data);
    }

    // END: Mandatory methods
    // 
    // *************************************************************************
    // 
    // START: Optional methods

    public function borrarPedido($codPedido) {
        return $this->_pedidosDB->borrarPedido($codPedido);
    }

    // END: Optional methods
}

//End class
?>