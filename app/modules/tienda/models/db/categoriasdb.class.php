<?php

class Modules_Tienda_ModelDb_CategoriasDB extends Moon2_DBmanager_PDO {

    public function __construct() {
        parent::__construct();
        $this->_table = "categorias";
        $this->_Pkey["key"] = "codcategoria";
        $this->_Pkey["value"] = 0;
        $this->_sequence = $this->_table . "_" . $this->_Pkey['key'] . "_seq";
    }

    public function load_all(&$rsNumRows, $limit_numrows, $page, $Data) {
        $recordCounter = "count(c.codcategoria)";
        $columns = "c.codcategoria, c.nombrecategoria, c.estado, ";
        $columns .= "(SELECT count(codproducto) FROM productos WHERE codcategoria = c.codcategoria) as cantproductos  ";
        $from = "FROM categorias c ";
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

    public function obtenerCategorias() {
        $sql = "SELECT c.codcategoria, c.nombrecategoria ";
        $sql .= "FROM categorias c ";
        $sql .= "WHERE c.estado = ? ";
        $sql .= "ORDER BY c.nombrecategoria";
        return $this->GetAssoc($sql, [$this->_DOM["ESTADOCATEGORIA_TXT"]["ACTIVO"]]);
    }

    public function tieneProductos($codCategoria) {
        $sql = "SELECT count(codcategoria) FROM productos WHERE codcategoria = ?";
        $cantidad = (int) $this->GetOne($sql, [$codCategoria]);
        if ($cantidad > 0) {
            return true;
        }
        return false;
    }

}

?>