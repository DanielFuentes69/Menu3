<?php

class Modules_Webpage_ModelDb_Clientesdb extends Moon2_DBmanager_PDO {

    public function __construct() {
        parent::__construct();
        $this->_table = "clientes";
        $this->_Pkey["key"] = "codcliente";
        $this->_Pkey["value"] = 0;
        $this->_sequence = $this->_table . "_" . $this->_Pkey['key'] . "_seq";
    }

    public function load_all(&$rsNumRows, $limit_numrows, $page, $Data) {
        $counterFields = "count(c.codcliente)";
        $Fields = "c.codcliente, c.codusuario, lower(c.nombre) AS nombre, c.imagencodificada, c.mime, c.tamanno, c.nombreimagen, c.fecha, c.hora ";
        $From = "FROM clientes c ";
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

    public function allClientes() {
        $sql = "SELECT c.codcliente, c.codusuario, c.nombre, c.imagencodificada, c.mime, c.tamanno, c.nombreimagen, c.fecha, c.hora ";
        $sql .= "FROM clientes c ";
        $sql .= "ORDER BY c.codcliente ASC ";
        return $this->GetAll($sql);
    }

}

?>