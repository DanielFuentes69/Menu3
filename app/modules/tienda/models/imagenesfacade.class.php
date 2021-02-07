<?php

class Modules_Tienda_Model_ImagenesFacade implements Moon2_Interfaces_MandatoryModel {

    private $_imagenesDB;

    public function __construct() {
        $this->_imagenesDB = new Modules_Tienda_ModelDb_ImagenesDB();
    }

    // START: Mandatory methods
    public function add($obj) {
        return $this->_imagenesDB->add($obj);
    }

    public function update($obj) {
        return $this->_imagenesDB->update($obj);
    }

    public function delete($obj) {
        return $this->_imagenesDB->delete($obj);
    }

    public function loadOne($obj) {
        return $this->_imagenesDB->loadOne($obj);
    }

    public function add_searchField($key, $field) {
        return $this->_imagenesDB->add_searchField($key, $field);
    }

    public function load_all(&$rsNumRows, $limit_numrows, $page, $Data = array()) {
        return $this->_imagenesDB->load_all($rsNumRows, $limit_numrows, $page, $Data);
    }

    // END: Mandatory methods
    // 
    // *************************************************************************
    // 
    // START: Optional methods
    // END: Optional methods
}

//End class
?>