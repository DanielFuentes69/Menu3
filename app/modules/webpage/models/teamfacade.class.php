<?php

class Modules_Webpage_Model_TeamFacade implements Moon2_Interfaces_MandatoryModel {

    private $_teamDB;

    public function __construct() {
        $this->_teamDB = new Modules_Webpage_ModelDb_Teamdb();
    }

    public function add($obj) {
        return $this->_teamDB->add($obj);
    }

    public function update($obj) {
        return $this->_teamDB->update($obj);
    }

    public function delete($obj) {
        return $this->_teamDB->delete($obj);
    }

    public function loadOne($obj) {
        return $this->_teamDB->loadOne($obj);
    }

    public function add_searchField($key, $field, $type = "") {
        return $this->_teamDB->add_searchField($key, $field, $type);
    }

    public function load_all(&$rsNumRows, $limit_numrows, $page, $Data = array()) {
        return $this->_teamDB->load_all($rsNumRows, $limit_numrows, $page, $Data);
    }

    public function allTeam() {
        return $this->_teamDB->allTeam();
    }

}

?>