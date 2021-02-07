<?php

class Modules_Webpage_Model_PromocionesFacade implements Moon2_Interfaces_MandatoryModel {

    private $_promDB;

    public function __construct() {
        $this->_promDB = new Modules_Webpage_ModelDb_Promocionesdb();
    }

    public function add($obj) {
        return $this->_promDB->add($obj);
    }

    public function update($obj) {
        return $this->_promDB->update($obj);
    }

    public function delete($obj) {
        return $this->_promDB->delete($obj);
    }

    public function loadOne($obj) {
        return $this->_promDB->loadOne($obj);
    }

    public function add_searchField($key, $field, $type = "") {
        return $this->_promDB->add_searchField($key, $field, $type);
    }

    public function load_all(&$rsNumRows, $limit_numrows, $page, $Data = array()) {
        return $this->_promDB->load_all($rsNumRows, $limit_numrows, $page, $Data);
    }

    public function allPromociones() {
        return $this->_promDB->allPromociones();
    }

}

?>