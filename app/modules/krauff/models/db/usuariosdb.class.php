<?php

class Modules_Krauff_ModelDb_usuariosdb extends Moon2_DBmanager_PDO {

    public function __construct() {
        parent::__construct();
        $this->_table = "usuarios";
        $this->_Pkey["key"] = "codusuario";
        $this->_Pkey["value"] = 0;
        $this->_sequence = $this->_table . "_" . $this->_Pkey['key'] . "_seq";
    }

    public function getUsuClave($cod_usuario) {
        $parameter = array($cod_usuario);
        $sql = "SELECT u.nombreusuario, u.clave ";
        $sql .= "FROM usuarios u ";
        $sql .= "WHERE u.codusuario = ?;";
        return $this->GetRow($sql, $parameter);
    }

    public function validate($user, $pass) {
        $parameters = array($user, $pass);
        $sql = "SELECT u.codusuario, u.codperfil, u.nombreusuario, concat(u.nombres,' ',u.primerapellido,' ',u.segundoapellido) as nombrecompleto, p.nombreperfil, u.mime, u.imagencodificada ";
        $sql .= "FROM usuarios u INNER JOIN perfiles p ON u.codperfil = p.codperfil ";
        $sql .= "WHERE u.nombreusuario=? AND u.clave=? AND u.estado={$this->_DOM["ESTADOUSUARIO_TXT"]["ACTIVO"]} ";
        $row = $this->GetRow($sql, $parameters);

        if (!empty($row)) {
            $key_user = $row["codusuario"] . "@@" . $user . "@@" . $row["nombrecompleto"] . "@@" . $row["nombreperfil"] . "@@" . $row["codperfil"] . "@@" . $row["mime"] . "@@" . $row["imagencodificada"];
            return $key_user;
        }
        return false;
    }

    public function get_functionalities($id, $parentId) {
        $sql = "SELECT f.codfunc, f.codpadre, f.nombre, f.identificador, f. orden, f.urlpagina, f.target, ";
        $sql .= "f.icono, f.tipo, (select count(*) FROM funcionalidades WHERE codpadre = f.codfunc) as hijos ";
        $sql .= "FROM funcionalidades f ";
        $sql .= "ORDER BY f.orden";
        $allFunc = $this->GetAll($sql);

        $UserfuncArray = $this->user_Functionalities($id);

        $finalArray = array();
        foreach ($allFunc as $key => $vector) {
            if (array_key_exists($vector["codfunc"], $UserfuncArray)) {
                $finalArray[] = $vector;
            }
        }
        return $finalArray;
    }

    private function user_Functionalities($id) {
        $sql = "SELECT codfunc, codusuario FROm rel_funcusuarios WHERE codusuario = ?";
        $funcArray = $this->GetAssoc($sql, array($id));
        return $funcArray;
    }

    public function load_all(&$rsNumRows, $limit_numrows, $page, $Data) {
        $counterFields = "count(u.codusuario)";
        $Fields = "u.codperfil, p.nombreperfil, u.codusuario, concat(lower(u.nombres),' ',lower(u.primerapellido),' ',lower(u.segundoapellido)) AS nombres, u.telefono, u.celular, u.nombreusuario, u.estado ";
        $From = "FROM usuarios u INNER JOIN perfiles p ON u.codperfil = p.codperfil ";
        $Where = $this->searchCondition("AND") . " ";
        $Order = "ORDER BY {$Data["order"]} ASC";

        $sql_count = "SELECT {$counterFields} ";
        $sql_count .= $From;
        $sql_count .= $Where;
        $rsNumRows = $this->GetOne($sql_count);

        $sql_full = "SELECT {$Fields} ";
        $sql_full .= $From;
        $sql_full .= $Where;
        $sql_full .= $Order;
        $arr = $this->SelectLimit($sql_full, $limit_numrows, $page);
        //echo $sql_full;
        return $arr;
    }

    public function combousuarios() {
        $sql = "SELECT u.codusuario, concat(u.nombres,' ',u.primerapellido,' ',u.segundoapellido) AS nombrecliente ";
        $sql .= "FROM usuarios u INNER JOIN empresas e ON u.codempresa = e.codempresa ";
        $sql .= "WHERE e.codempresa = -1 ";
        $funcArray = $this->GetAssoc($sql);
        return $funcArray;
    }

    public function asignarfuncionalidades($codusuario) {
        $sql = "INSERT into rel_funcusuarios (codusuario, codfunc) select {$codusuario},codfunc FROM funcionalidades ";
        return $this->ExecuteSql($sql);
    }

    public function update_imagen($imagencodificada, $nombreimagen, $tamanno, $tipomime, $codusuario) {
        $parametros = array($imagencodificada, $nombreimagen, $tamanno, $tipomime, $codusuario);
        $sql = "UPDATE usuarios SET imagencodificada = ?, nombreimagen = ?, tamanno = ?, mime = ? WHERE codusuario = ?";
        $funcArray = $this->ExecuteSql($sql, $parametros);
        return $funcArray;
    }

    public function ultimo_codusuario() {
        $sql = "SELECT MAX(codusuario) FROM usuarios";
        return $this->GetOne($sql);
    }

    public function asignar_clave($nombreusuario, $clave, $codusuario) {
        $parametros = array($nombreusuario, $clave, $codusuario);
        $sql = "UPDATE usuarios SET nombreusuario = ?, clave = ? WHERE codusuario = ?";
        $funcArray = $this->ExecuteSql($sql, $parametros);

        return $funcArray;
    }

    public function asignar_ubicacion($direccion, $telefono, $celular, $codubicacion, $email, $codusuario) {
        $parametros = array($direccion, $telefono, $celular, $codubicacion, $email, $codusuario);
        $sql = "UPDATE usuarios SET direccion = ?, telefono = ?, celular = ?, codubicacion = ?, correo = ? WHERE codusuario = ?";
        $funcArray = $this->ExecuteSql($sql, $parametros);

        return $funcArray;
    }

    public function editar_usuario($perfil, $nombres, $primerapellido, $segundoapellido, $tipodocumento, $documento, $genero, $estado, $codusuario) {
        $parametros = array($perfil, $nombres, $primerapellido, $segundoapellido, $tipodocumento, $documento, $genero, $estado, $codusuario);
        $sql = "UPDATE usuarios SET codperfil = ?, nombres = ?, primerapellido = ?, segundoapellido = ?, tipodoc = ?, documento = ?, genero = ?, estado = ?  WHERE codusuario = ?";
        return $this->ExecuteSql($sql, $parametros);
    }

    public function cantidadTerceros($codperfil, $codbodega) {
        $parametros = array($codperfil, $codbodega);
        $sql = "SELECT COUNT(u.codusuario) FROM usuarios u ";
        $sql .= "WHERE u.codperfil = ? AND u.codusuario IN (SELECT codusuario FROM usubodega WHERE codbodega = ?) ";
        return $this->GetOne($sql, $parametros);
    }

    public function filtroUsuarios() {
        $perfil_administrador = $this->_DOM["PERFILES"]["ADMINISTRADOR"];
        $perfil_cajero = $this->_DOM["PERFILES"]["CAJERO"];
        $sql = "SELECT u.codusuario, upper(concat(u.nombres,' ',u.primerapellido,' ',u.segundoapellido)) AS nombreusuario ";
        $sql .= "FROM usuarios u ";
        $sql .= "WHERE u.codperfil IN ('{$perfil_administrador}','{$perfil_cajero}') ";
        $sql .= "AND u.codusuario IN (SELECT codusuario FROM usubodega WHERE codbodega = {$this->_DOM["BODEGA_ID"]})";
        return $this->GetAssoc($sql);
    }

    public function allUsuarios($estado, $codubicacion, $tipo, $codempresa) {
        if ($codubicacion == -8) {
            $condicionUbicacion = "";
        } else {
            $condicionUbicacion = " AND codubicacion={$codubicacion} ";
        }


        $sql = "SELECT u.codusuario, lower(u.nombres) AS nombres, u.alias, u.tipodoc, u.documento, u.genero, u.codubicacion, ";
        $sql .= "u.lugartrabajo, u.direccion, u.telefono, u.celular, u.whastapp, u.estado ";
        $sql .= "FROM usuarios u INNER JOIN usuempresas ue ON u.codusuario=ue.codusuario ";
        $sql .= "WHERE u.estado={$estado} AND u.codperfil={$tipo} AND ue.codempresa={$codempresa} {$condicionUbicacion} ";
        return $this->GetAll($sql);
    }

    public function existeDocumento($documento) {
        $parametros = array($documento);
        $sql = "SELECT COUNT(codusuario) ";
        $sql .= "FROM usuarios ";
        $sql .= "WHERE documento=? ";
        return $this->GetOne($sql, $parametros);
    }

    public function existeEmail($email) {
        $parametros = array($email);
        $sql = "SELECT COUNT(codusuario) ";
        $sql .= "FROM usuarios ";
        $sql .= "WHERE correo=? ";
        return $this->GetOne($sql, $parametros);
    }

    public function funcionalidadesCliente($codusuario) {
        $sql1 = "INSERT INTO rel_funcusuarios(codusuario, codfunc, favorito) VALUES({$codusuario}, 7, 2); ";
        $sql2 = "INSERT INTO rel_funcusuarios(codusuario, codfunc, favorito) VALUES({$codusuario}, 40, 2);";
        $this->ExecuteSql($sql1);
        $this->ExecuteSql($sql2);
    }

    public function updateEstado($estado, $codusuario) {
        $parametros = array($estado, $codusuario);
        $sql = "UPDATE usuarios ";
        $sql .= "SET estado=? ";
        $sql .= "WHERE codusuario=? ";
        return $this->ExecuteSql($sql, $parametros);
    }

    public function comboClientes() {
        $sql = "SELECT codusuario, concat(lower(nombres),' ',lower(primerapellido),' ',lower(segundoapellido)) ";
        $sql .= "FROM usuarios ";
        $sql .= "WHERE codperfil={$this->_DOM["PERFILES"]["CLIENTE"]} ";
        return $this->GetAssoc($sql);
    }

    public function asignarTipoCliente($tipocliente, $codusuario) {
        $parametros = array($tipocliente, $codusuario);
        $sql = "UPDATE usuarios SET ";
        $sql .= "tipousuario=? ";
        $sql .= "WHERE codusuario=? ";
        return $this->ExecuteSql($sql, $parametros);
    }

}

?>