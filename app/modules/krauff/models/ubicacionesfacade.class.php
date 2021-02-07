<?php

class Modules_Krauff_Model_UbicacionesFacade implements Moon2_Interfaces_MandatoryModel {

    private $_ubicacionDB;

    public function __construct() {
        $this->_ubicacionDB = new Modules_Krauff_ModelDb_Ubicacionesdb();
    }

    public function add($obj) {
        return $this->_ubicacionDB->add($obj);
    }

    public function update($obj) {
        return $this->_ubicacionDB->update($obj);
    }

    public function delete($obj) {
        return $this->_ubicacionDB->delete($obj);
    }

    public function loadOne($obj) {
        return $this->_ubicacionDB->loadOne($obj);
    }

    public function add_searchField($key, $field, $type = "") {
        return $this->_ubicacionDB->add_searchField($key, $field, $type);
    }

    public function load_all(&$rsNumRows, $limit_numrows, $page, $Data = array()) {
        return $this->_ubicacionDB->load_all($rsNumRows, $limit_numrows, $page, $Data);
    }

    public function nombreUbicacion($codubicacion) {
        return $this->_ubicacionDB->nombreUbicacion($codubicacion);
    }

    public function tipoUbicacion($codubicacion, $tipo) {
        return $this->_ubicacionDB->tipoUbicacion($codubicacion, $tipo);
    }

    public function obtenerRutaubicacion($codubicacion, &$salida) {
        return $this->_ubicacionDB->obtenerRutaubicacion($codubicacion, $salida);
    }

    public function getNombreubicacion($codubicacion) {
        return $this->_ubicacionDB->getNombreubicacion($codubicacion);
    }

    public function allUbicaciones($tipo) {
        return $this->_ubicacionDB->allUbicaciones($tipo);
    }

}

?>