<?php

class Modules_Krauff_Model_FuncionalidadesFacade implements Moon2_Interfaces_MandatoryModel {

    private $_funcDB;

    public function __construct() {
        $this->_funcDB = new Modules_Krauff_ModelDb_FuncionalidadesDb();
    }

// START: Mandatory methods
    public function add($obj) {
        return $this->_funcDB->add($obj);
    }

    public function update($obj) {
        return $this->_funcDB->update($obj);
    }

    public function delete($obj) {
        return $this->_funcDB->delete($obj);
    }

    public function loadOne($obj) {
        return $this->_funcDB->loadOne($obj);
    }

    public function add_searchField($key, $field, $type = "") {
        return $this->_funcDB->add_searchField($key, $field, $type);
    }

    public function load_all(&$rsNumRows, $limit_numrows, $page, $Data = array()) {
        return $this->_funcDB->load_all($rsNumRows, $limit_numrows, $page, $Data);
    }

// END: Mandatory methods
// START: User-defined methods
    public function getComponent($nodo) {
        return $this->_funcDB->getComponent($nodo);
    }

    public function obtener_nodo($idnode, &$seleccionados) {
        return $this->_funcDB->obtener_nodo($idnode, $seleccionados);
    }

    public function actualizar_padre($cod_func, $cod_padre) {
        return $this->_funcDB->actualizar_padre($cod_func, $cod_padre);
    }

    public function obtener_nodo_simple($cod_padre) {
        return $this->_funcDB->obtener_nodo_simple($cod_padre);
    }

    public function ordenar_nodo_simple($arreglo) {
        return $this->_funcDB->ordenar_nodo_simple($arreglo);
    }

    public function deleteFuncionalidad($codusuario, $codfuncionalidad) {
        return $this->_funcDB->deleteFuncionalidad($codusuario, $codfuncionalidad);
    }

    public function addFuncionalidad($codusuario, $codfuncionalidad) {
        return $this->_funcDB->addFuncionalidad($codusuario, $codfuncionalidad);
    }

    public function user_Functionalities($id) {
        return $this->_funcDB->user_Functionalities($id);
    }

    public function obtenerFunchijas($codfuncpadre) {
        return $this->_funcDB->obtenerFunchijas($codfuncpadre);
    }

    public function validarFuncionalidad($codfunc, $codusuario) {
        return $this->_funcDB->validarFuncionalidad($codfunc, $codusuario);
    }

    public function obtenerCodpadre($codfunchija) {
        return $this->_funcDB->obtenerCodpadre($codfunchija);
    }

    public function existeFunchijas($codpadre, $codusuario) {
        return $this->_funcDB->existeFunchijas($codpadre, $codusuario);
    }

    public function existeCodpadre($codpadre, $codusuario) {
        return $this->_funcDB->existeCodpadre($codpadre, $codusuario);
    }

// END: User-defined methods
}

//End class
?>