<?php

class Modules_Tienda_ModelDb_ListasPreciosDB extends Moon2_DBmanager_PDO {

    public function __construct() {
        parent::__construct();
        $this->_table = "listasprecios";
        $this->_Pkey["key"] = "codlistaprecio";
        $this->_Pkey["value"] = 0;
        $this->_sequence = $this->_table . "_" . $this->_Pkey['key'] . "_seq";
    }

    public function load_all(&$rsNumRows, $limit_numrows, $page, $Data) {
        $recordCounter = "count(lp.codlistaprecio)";
        $columns = "lp.codlistaprecio, lp.nombrelistaprecio, lp.estado, ";
        $columns .= "(SELECT count(codlistaprecio) FROM precios WHERE codlistaprecio = lp.codlistaprecio) as cantlistas  ";
        $from = "FROM listasprecios lp ";
        $where = $this->searchCondition("AND") . " ";
        $order = "ORDER BY {$Data["order"]} ASC";

        $sqlCount = "SELECT {$recordCounter} ";
        $sqlCount .= $from;
        $sqlCount .= $where;
        $rsNumRows = $this->GetOne($sqlCount);

        $sql_full = "SELECT {$columns} ";
        $sql_full .= $from;
        $sql_full .= $where;
        $sql_full .= $order;
        $arr = $this->SelectLimit($sql_full, $limit_numrows, $page);
        return $arr;
    }

    public function obtenerListasPreciosDisponibles($codProducto, $estado) {
        $sql = "SELECT lp.codlistaprecio, lp.nombrelistaprecio ";
        $sql .= "FROM listasprecios lp ";
        $sql .= "WHERE lp.estado = ? AND codlistaprecio NOT IN ";
        $sql .= "(SELECT codlistaprecio FROM precios WHERE codproducto = ?) ";
        $sql .= "ORDER BY lp.nombrelistaprecio";
        return $this->GetAssoc($sql, [$estado, $codProducto]);
    }

    public function obtenerListasPrecios($estado) {
        $sql = "SELECT lp.codlistaprecio, lp.nombrelistaprecio ";
        $sql .= "FROM listasprecios lp ";
        $sql .= "WHERE lp.estado = ? ";
        $sql .= "ORDER BY lp.nombrelistaprecio";
        return $this->GetAssoc($sql, [$estado]);
    }

    public function utilizada($codListaPrecio) {
        $sql = "SELECT count(codlistaprecio) FROM precios WHERE codlistaprecio = ?";
        $cantidad = (int) $this->GetOne($sql, [$codListaPrecio]);
        if ($cantidad > 0) {
            return true;
        }
        return false;
    }

}

?>