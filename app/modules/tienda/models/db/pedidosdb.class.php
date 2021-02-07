<?php

class Modules_Tienda_ModelDb_PedidosDB extends Moon2_DBmanager_PDO {

    public function __construct() {
        parent::__construct();
        $this->_table = "pedidos";
        $this->_Pkey["key"] = "codpedido";
        $this->_Pkey["value"] = 0;
        $this->_sequence = $this->_table . "_" . $this->_Pkey['key'] . "_seq";
    }

    public function load_all(&$rsNumRows, $limit_numrows, $page, $Data) {
        $recordCounter = "count(p.codpedido)";
        $columns = "p.codpedido, p.identificador, p.fecha, p.hora, p.documento, p.nombrecliente, p.correo, ";
        $columns .= "p.direccion, p.celular, p.despachado, ";
        $columns .= "(SELECT count(codpedido) FROM detallepedidos WHERE codpedido = p.codpedido) as cantproductos ";
        $from = "FROM pedidos p ";
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

    public function borrarPedido($codPedido) {
        $sql = "DELETE FROM detallepedidos WHERE codpedido = ?";
        $this->ExecuteSql($sql, [$codPedido]);

        $sql = "DELETE FROM pedidos WHERE codpedido = ?";
        return $this->ExecuteSql($sql, [$codPedido]);
    }

}

?>