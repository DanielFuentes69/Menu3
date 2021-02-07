<?php

class Modules_Krauff_Model_UsuariosFacade implements Moon2_Interfaces_MandatoryModel {

    private $_userDB;

    public function __construct() {
        $this->_userDB = new Modules_Krauff_ModelDb_usuariosdb();
    }

    public function add($obj) {
        return $this->_userDB->add($obj);
    }

    public function update($obj) {
        return $this->_userDB->update($obj);
    }

    public function delete($obj) {
        return $this->_userDB->delete($obj);
    }

    public function loadOne($obj) {
        return $this->_userDB->loadOne($obj);
    }

    public function add_searchField($key, $field, $type = "") {
        return $this->_userDB->add_searchField($key, $field, $type);
    }

    public function load_all(&$rsNumRows, $limit_numrows, $page, $Data = array()) {
        return $this->_userDB->load_all($rsNumRows, $limit_numrows, $page, $Data);
    }

    public function validate($user, $pass) {
        return $this->_userDB->validate($user, $pass);
    }

    public function get_functionalities($id, $parentId) {
        return $this->_userDB->get_functionalities($id, $parentId);
    }

    public function combousuarios() {
        return $this->_userDB->combousuarios();
    }

    public function asignarfuncionalidades($codusuario) {
        return $this->_userDB->asignarfuncionalidades($codusuario);
    }

    public function update_imagen($imagencodificada, $nombreimagen, $tamanno, $tipomime, $codusuario) {
        return $this->_userDB->update_imagen($imagencodificada, $nombreimagen, $tamanno, $tipomime, $codusuario);
    }

    public function ultimo_codusuario() {
        return $this->_userDB->ultimo_codusuario();
    }

    public function asignar_clave($nombreusuario, $clave, $codusuario) {
        return $this->_userDB->asignar_clave($nombreusuario, $clave, $codusuario);
    }

    public function asignar_ubicacion($direccion, $telefono, $celular, $codubicacion, $email, $codusuario) {
        return $this->_userDB->asignar_ubicacion($direccion, $telefono, $celular, $codubicacion, $email, $codusuario);
    }

    public function editar_usuario($perfil, $nombres, $primerapellido, $segundoapellido, $tipodocumento, $documento, $genero, $estado, $codusuario) {
        return $this->_userDB->editar_usuario($perfil, $nombres, $primerapellido, $segundoapellido, $tipodocumento, $documento, $genero, $estado, $codusuario);
    }

    public function getUsuClave($cod_usuario) {
        return $this->_userDB->getUsuClave($cod_usuario);
    }

    public function cantidadTerceros($codperfil, $codbodega) {
        return $this->_userDB->cantidadTerceros($codperfil, $codbodega);
    }

    public function filtroUsuarios() {
        return $this->_userDB->filtroUsuarios();
    }

    public function allUsuarios($estado, $codubicacion, $tipo, $codempresa) {
        return $this->_userDB->allUsuarios($estado, $codubicacion, $tipo, $codempresa);
    }

    public function existeDocumento($documento) {
        return $this->_userDB->existeDocumento($documento);
    }

    public function existeEmail($email) {
        return $this->_userDB->existeEmail($email);
    }

    public function funcionalidadesCliente($codusuario) {
        return $this->_userDB->funcionalidadesCliente($codusuario);
    }

    public function updateEstado($estado, $codusuario) {
        return $this->_userDB->updateEstado($estado, $codusuario);
    }

    public function comboClientes() {
        return $this->_userDB->comboClientes();
    }

    public function asignarTipoCliente($tipocliente, $codusuario) {
        return $this->_userDB->asignarTipoCliente($tipocliente, $codusuario);
    }

}

?>