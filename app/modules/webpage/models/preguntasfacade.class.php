<?php

class Modules_Webpage_Model_PreguntasFacade implements Moon2_Interfaces_MandatoryModel {

    private $_preguntasDB;

    public function __construct() {
        $this->_preguntasDB = new Modules_Webpage_ModelDb_Preguntasdb();
    }

    public function add($obj) {
        return $this->_preguntasDB->add($obj);
    }

    public function update($obj) {
        return $this->_preguntasDB->update($obj);
    }

    public function delete($obj) {
        return $this->_preguntasDB->delete($obj);
    }

    public function loadOne($obj) {
        return $this->_preguntasDB->loadOne($obj);
    }

    public function add_searchField($key, $field, $type = "") {
        return $this->_preguntasDB->add_searchField($key, $field, $type);
    }

    public function load_all(&$rsNumRows, $limit_numrows, $page, $Data = array()) {
        return $this->_preguntasDB->load_all($rsNumRows, $limit_numrows, $page, $Data);
    }

}

?>