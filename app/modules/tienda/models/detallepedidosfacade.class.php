<?php

class Modules_Tienda_Model_DetallePedidosFacade implements Moon2_Interfaces_MandatoryModel {

    private $_detallePedidosDB;

    public function __construct() {
        $this->_detallePedidosDB = new Modules_Tienda_ModelDb_DetallePedidosDB();
    }

    // START: Mandatory methods
    public function add($obj) {
        return $this->_detallePedidosDB->add($obj);
    }

    public function update($obj) {
        return $this->_detallePedidosDB->update($obj);
    }

    public function delete($obj) {
        return $this->_detallePedidosDB->delete($obj);
    }

    public function loadOne($obj) {
        return $this->_detallePedidosDB->loadOne($obj);
    }

    public function add_searchField($key, $field) {
        return $this->_detallePedidosDB->add_searchField($key, $field);
    }

    public function load_all(&$rsNumRows, $limit_numrows, $page, $Data = array()) {
        return $this->_detallePedidosDB->load_all($rsNumRows, $limit_numrows, $page, $Data);
    }

    // END: Mandatory methods
    // 
    // *************************************************************************
    // 
    // START: Optional methods
    // 
    public function obtenerDetallePedido($codPedido) {
        return $this->_detallePedidosDB->obtenerDetallePedido($codPedido);
    }

    // END: Optional methods
}

//End class
?>