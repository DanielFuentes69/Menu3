<?php

class Modules_Webpage_Model_NoticiasFacade implements Moon2_Interfaces_MandatoryModel {

    private $_noticiasDB;

    public function __construct() {
        $this->_noticiasDB = new Modules_Webpage_ModelDb_Noticiasdb();
    }

    public function add($obj) {
        return $this->_noticiasDB->add($obj);
    }

    public function update($obj) {
        return $this->_noticiasDB->update($obj);
    }

    public function delete($obj) {
        return $this->_noticiasDB->delete($obj);
    }

    public function loadOne($obj) {
        return $this->_noticiasDB->loadOne($obj);
    }

    public function add_searchField($key, $field, $type = "") {
        return $this->_noticiasDB->add_searchField($key, $field, $type);
    }

    public function load_all(&$rsNumRows, $limit_numrows, $page, $Data = array()) {
        return $this->_noticiasDB->load_all($rsNumRows, $limit_numrows, $page, $Data);
    }

    public function allNoticias() {
        return $this->_noticiasDB->allNoticias();
    }

    public function noticiasRecientes() {
        return $this->_noticiasDB->noticiasRecientes();
    }

    public function updateMeGusta($cantidadnueva, $codnoticia) {
        return $this->_noticiasDB->updateMeGusta($cantidadnueva, $codnoticia);
    }

}

?>