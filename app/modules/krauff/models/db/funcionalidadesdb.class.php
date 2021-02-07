<?php

class Modules_Krauff_ModelDb_FuncionalidadesDb extends Moon2_DBmanager_PDO {

    private $_ruta = "";

    public function __construct() {
        parent::__construct();
        $this->_Pkey["value"] = 0;
        $this->_table = "funcionalidades";
        $this->_Pkey["key"] = "codfunc";
        $this->_sequence = $this->_table . "_" . $this->_Pkey["key"] . "_seq";
    }

    public function obtener_nodo($indicednode, &$seleccionados) {
        $params = array($indicednode);
        $sql = "SELECT f.codfunc, f.codpadre, f.nombre, f.identificador, f.orden, f.urlpagina, f.target, f.icono, f.tipo, ";
        $sql .= "(SELECT count(codfunc) FROM funcionalidades WHERE codpadre = f.codfunc) as cant ";
        $sql .= "FROM {$this->_table} f WHERE codpadre = ? ";
        $sql .= "ORDER BY f.orden";

        $indice = 0;
        $arrData = array();
        $arr = $this->GetAssoc($sql, $params);
        foreach ($arr as $cod_func => $campo) {
            $hijos = $campo["cant"];
            $arrData[$indice]["title"] = $campo["nombre"];
            $arrData[$indice]["key"] = $cod_func;
            $keys = array_values($seleccionados);
            if (in_array($cod_func, $keys)) {
                $arrData[$indice]["select"] = true;
            }
            if ($hijos > 0) {
                $arrData[$indice]["isFolder"] = TRUE;
                $arrData[$indice]["children"] = $this->obtener_nodo($cod_func, $seleccionados);
            }
            $indice++;
        }
        return $arrData;
    }

    public function actualizar_padre($cod_func, $cod_padre) {
        $pamametros = array($cod_padre, $cod_func);
        $sql = "UPDATE funcionalidades SET codpadre = ? WHERE codfunc = ?";
        $result = $this->ExecuteSql($sql, $pamametros);
        return $result;
    }

    public function obtener_nodo_simple($cod_padre) {
        $pamametros = array($cod_padre);
        $sql = "SELECT codfunc,nombre FROM funcionalidades WHERE codpadre = ? order BY orden";
        $arr = $this->GetAll($sql, $pamametros);
        return $arr;
    }

    public function ordenar_nodo_simple($arreglo) {
        $this->_conexion->beginTransaction();
        foreach ($arreglo as $indice => $campo) {
            $pamametros = array($indice, $campo["codfunc"]);
            $sql = "UPDATE funcionalidades set orden = ? WHERE codfunc = ?";
            $result = $this->ExecuteSql($sql, $pamametros);
            if ($result == false) {
                $this->_conexion->rollBack();
                return false;
            }
        }
        $result = $this->_conexion->commit();
        return $result;
    }

    public function deleteFuncionalidad($codusuario, $codfuncionalidad) {
        $pamametros = array($codusuario, $codfuncionalidad);
        $sql = "DELETE FROM rel_funcusuarios WHERE codusuario = ? AND codfunc = ?";
        return $this->ExecuteSql($sql, $pamametros);
    }

    public function addFuncionalidad($codusuario, $codfuncionalidad) {
        $pamametros = array($codusuario, $codfuncionalidad);
        $sql = "INSERT INTO rel_funcusuarios(codusuario, codfunc) ";
        $sql .= "VALUES(?,?)";
        return $this->ExecuteSql($sql, $pamametros);
    }

//public function getComponent($nodo){
//    $sql = "with recursive func(codfunc, codpadre, nombre, ruta) as ";
//    $sql.= "(";
//    $sql.= "  SELECT f.codfunc,f.codpadre, f.nombre, '\' as path from funcionalidades f where f.codpadre is null";
//    $sql.= "  UNION";
//    $sql.= "  SELECT f.codfunc, f.codpadre, f.nombre, func.ruta||f.nombre||'\' as pth from funcionalidades f";
//    $sql.= "    inner join func on func.codfunc = f.codpadre";
//    $sql.= ")";
//    $sql.= "select ruta from func where nombre=?";
//    $components = $this->GetOne($sql, array($nodo));
//    return $components;
//}
//Sin recursive por SQL
//\General\Perfiles\
    public function getComponent($nodo) {
        $this->_ruta = "\\" . $nodo;
        $this->getCaminoPorNombre($nodo);
        $arreglo = explode("\\", $this->_ruta);

        $this->_ruta = "\\";
        $cantidad = count($arreglo);
        for ($i = $cantidad; $i >= 0; $i--) {
            if (!empty($arreglo[$i])) {
                $this->_ruta .= $arreglo[$i] . "\\";
            }
        }
        return $this->_ruta;
    }

    private function getCaminoPorNombre($nodo) {
        $sql = "SELECT codpadre from funcionalidades WHERE nombre = ?";
        $codpadre = $this->GetOne($sql, array($nodo));
        $this->getCaminoPorCodigo($codpadre);
        return $this->_ruta;
    }

    private function getCaminoPorCodigo($codfunc) {
        if ($codfunc != 1) {
            $sql = "SELECT nombre from funcionalidades WHERE codfunc = ?";
            $nombre = $this->GetOne($sql, array($codfunc));
            $this->_ruta .= "\\" . $nombre;
            $this->getCaminoPorNombre($nombre);
        }
    }

    public function user_Functionalities($id) {
        $sql = "SELECT codfunc, codusuario FROM rel_funcusuarios WHERE codusuario = ?";
        $funcArray = $this->GetAssoc($sql, array($id));
        return $funcArray;
    }

    public function obtenerFunchijas($codfuncpadre) {
        $parametros = array($codfuncpadre);
        $sql = "SELECT codfunc, codpadre, nombre, identificador, orden, urlpagina, target, icono, tipo  ";
        $sql .= "FROM funcionalidades ";
        $sql .= "WHERE codpadre = ? order BY orden ";
        return $this->GetAll($sql, $parametros);
    }

    public function validarFuncionalidad($codfunc, $codusuario) {
        $parametros = array($codfunc, $codusuario);
        $sql = "SELECT COUNT(codfunc) FROM rel_funcusuarios WHERE codfunc=? AND codusuario=? ";
        //echo $sql;
        return $this->GetOne($sql, $parametros);
    }

    public function obtenerCodpadre($codfunchija) {
        $parametros = array($codfunchija);
        $sql = "SELECT codpadre FROM funcionalidades WHERE codfunc=? ";
        return $this->GetOne($sql, $parametros);
    }

    public function existeFunchijas($codpadre, $codusuario) {
        $parametros = array($codpadre, $codusuario);
        $sql = "SELECT COUNT(rel.codfunc) ";
        $sql .= "FROM funcionalidades f INNER JOIN rel_funcusuarios rel ON f.codfunc = rel.codfunc ";
        $sql .= "WHERE f.codpadre=? AND rel.codusuario=? ";
        return $this->GetOne($sql, $parametros);
    }

    public function existeCodpadre($codpadre, $codusuario) {
        $parametros = array($codpadre, $codusuario);
        $sql = "SELECT COUNT(codfunc) FROM rel_funcusuarios WHERE codfunc=? AND codusuario=? ";
        return $this->GetOne($sql, $parametros);
    }

}

//End class
?>