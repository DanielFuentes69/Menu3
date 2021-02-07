<?php

class Modules_Webpage_Model_SliderFacade implements Moon2_Interfaces_MandatoryModel {

    private $_sliderDB;

    public function __construct() {
        $this->_sliderDB = new Modules_Webpage_ModelDb_Sliderdb();
    }

    public function add($obj) {
        return $this->_sliderDB->add($obj);
    }

    public function update($obj) {
        return $this->_sliderDB->update($obj);
    }

    public function delete($obj) {
        return $this->_sliderDB->delete($obj);
    }

    public function loadOne($obj) {
        return $this->_sliderDB->loadOne($obj);
    }

    public function add_searchField($key, $field, $type = "") {
        return $this->_sliderDB->add_searchField($key, $field, $type);
    }

    public function load_all(&$rsNumRows, $limit_numrows, $page, $Data = array()) {
        return $this->_sliderDB->load_all($rsNumRows, $limit_numrows, $page, $Data);
    }

    public function allImagenesSlider() {
        return $this->_sliderDB->allImagenesSlider();
    }

    public function getMinCodslider() {
        return $this->_sliderDB->getMinCodslider();
    }

    public function updateActiveSlider($active, $codslider) {
        return $this->_sliderDB->updateActiveSlider($active, $codslider);
    }

    public function validaImagenPrincipal() {
        return $this->_sliderDB->validaImagenPrincipal();
    }

}

?>