<?php

class Modules_Webpage_ModelDb_Sliderdb extends Moon2_DBmanager_PDO {

    public function __construct() {
        parent::__construct();
        $this->_table = "slider";
        $this->_Pkey["key"] = "codslider";
        $this->_Pkey["value"] = 0;
        $this->_sequence = $this->_table . "_" . $this->_Pkey['key'] . "_seq";
    }

    public function load_all(&$rsNumRows, $limit_numrows, $page, $Data) {
        $counterFields = "count(s.codslider)";
        $Fields = "s.codslider, s.codusuario, s.imagencodificada, s.mime, s.tamanno, s.nombreimagen, s.fecha, s.hora, s.titulo1, s.titulo2 ";
        $From = "FROM slider s ";
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

    public function allImagenesSlider() {
        $sql = "SELECT codslider, imagencodificada, mime, titulo1, titulo2, textoboton, urlboton, descripcion, colortexto, active ";
        $sql .= "FROM slider ";
        return $this->GetAll($sql);
    }

    public function getMinCodslider() {
        $sql = "SELECT MIN(codslider) ";
        $sql .= "FROM slider ";
        return $this->GetOne($sql);
    }

    public function updateActiveSlider($active, $codslider) {
        $parametros = array($active, $codslider);
        $sql = "UPDATE slider SET ";
        $sql .= "active=? ";
        $sql .= "WHERE codslider=? ";
        return $this->ExecuteSql($sql, $parametros);
    }

    public function validaImagenPrincipal() {
        $sql = "SELECT COUNT(codslider) ";
        $sql .= "FROM slider ";
        $sql .= "WHERE active={$this->_DOM["ACTIVETXT"]["SI"]} ";
        return $this->GetOne($sql);
    }

}

?>