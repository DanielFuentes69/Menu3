<?php

class Modules_Webpage_Model_ClientesFacade implements Moon2_Interfaces_MandatoryModel {

    private $_clientesDB;

    public function __construct() {
        $this->_clientesDB = new Modules_Webpage_ModelDb_Clientesdb();
    }

    public function add($obj) {
        return $this->_clientesDB->add($obj);
    }

    public function update($obj) {
        return $this->_clientesDB->update($obj);
    }

    public function delete($obj) {
        return $this->_clientesDB->delete($obj);
    }

    public function loadOne($obj) {
        return $this->_clientesDB->loadOne($obj);
    }

    public function add_searchField($key, $field, $type = "") {
        return $this->_clientesDB->add_searchField($key, $field, $type);
    }

    public function load_all(&$rsNumRows, $limit_numrows, $page, $Data = array()) {
        return $this->_clientesDB->load_all($rsNumRows, $limit_numrows, $page, $Data);
    }

    public function allClientes() {
        return $this->_clientesDB->allClientes();
    }

}

?>