<?php

class Modules_Krauff_ModelDb_Ubicacionesdb extends Moon2_DBmanager_PDO {

    public function __construct() {
        parent::__construct();
        $this->_table = "ubicaciones";
        $this->_Pkey["key"] = "codubicacion";
        $this->_Pkey["value"] = 0;
        $this->_sequence = $this->_table . "_" . $this->_Pkey['key'] . "_seq";
    }

    public function load_all(&$rsNumRows, $limit_numrows, $page, $Data) {
        $counterFields = "count(u.codubicacion)";
        $Fields = "u.codubicacion, lower((u.nombre)) AS lower, u.tipo ";
        $From = "FROM ubicaciones u ";
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

    public function obtenerRutaubicacion($codubicacion, &$salida) {
        if ($codubicacion != 1) {
            $parametros = array($codubicacion);
            $sql = "SELECT codubicacion, lower(nombre) AS nombre FROM ubicaciones WHERE codubicacion IN(SELECT codpadre FROM ubicaciones  WHERE codubicacion = ?)";
            $row = $this->GetRow($sql, $parametros);
            $nombre = $row["nombre"];
            $cod_ubicacionpadre = $row["codubicacion"];
            if ($cod_ubicacionpadre != 1) {
                $salida = $nombre . " - " . $salida;
                $this->obtenerRutaubicacion($cod_ubicacionpadre, $salida);
            }
        }
    }

    public function nombreUbicacion($codubicacion) {
        $parametro = array($codubicacion);
        $sql = "with recursive ubica(codubicacion, codpadre, nombre, tipo, ruta) as (";
        $sql .= "SELECT u.codubicacion,u.codpadre, u.nombre, u.tipo, '' as caracterInicio from ubicaciones u where u.codpadre is null ";
        $sql .= "UNION ";
        $sql .= "SELECT ubi.codubicacion, ubi.codpadre, ubi.nombre, ubi.tipo, ubica.ruta||ubi.nombre||', ' as pth from ubicaciones ubi INNER JOIN ubica on ubica.codubicacion = ubi.codpadre) ";
        $sql .= "select lower(ruta) from ubica WHERE codubicacion = ? ";
        //echo $sql;
        return $this->GetOne($sql, $parametro);
    }

    public function tipoUbicacion($codubicacion, $tipo) {
        $parametros = array($codubicacion, $tipo);
        $sql = "SELECT nombre FROM ubicaciones WHERE codubicacion =? AND tipo=? ";
        return $this->GetOne($sql, $parametros);
    }

    public function getNombreubicacion($codubicacion) {
        $parametros = array($codubicacion);
        $sql = "SELECT lower(nombre) AS nombre FROM ubicaciones WHERE codubicacion = ? ";
        return $this->GetOne($sql, $parametros);
    }

    public function allUbicaciones($tipo) {
        $parametros = array($tipo);
        $sql = "SELECT codubicacion, lower(nombre) AS nombre ";
        $sql .= "FROM ubicaciones ";
        $sql .= "WHERE tipo=? ";
        $sql .= "ORDER BY nombre ASC ";
        return $this->GetAssoc($sql, $parametros);
    }

}

//End class
?>