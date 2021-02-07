<?php

class Modules_Webpage_ModelDb_Promocionesdb extends Moon2_DBmanager_PDO {

    public function __construct() {
        parent::__construct();
        $this->_table = "promociones";
        $this->_Pkey["key"] = "codpromocion";
        $this->_Pkey["value"] = 0;
        $this->_sequence = $this->_table . "_" . $this->_Pkey['key'] . "_seq";
    }

    public function load_all(&$rsNumRows, $limit_numrows, $page, $Data) {
        $counterFields = "count(p.codpromocion)";
        $Fields = "p.codpromocion, p.codusuario, p.titulo, p.nombreproducto, p.descripcion, p.porcentaje, p.fechafin, ";
        $Fields .= "p.imagencodificada, p.mime, p.tamanno, p.nombreimagen, p.fecha, p.hora ";
        $From = "FROM promociones p ";
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

    public function allPromociones() {
        $sql = "SELECT p.codpromocion, p.codusuario, p.titulo, p.nombreproducto, p.descripcion, p.porcentaje, p.fechafin, p.imagencodificada, p.mime, p.tamanno, p.nombreimagen, p.fecha, p.hora ";
        $sql .= "FROM promociones p ";
        return $this->GetAll($sql);
    }

}

?>