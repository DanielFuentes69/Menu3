<?php

class Modules_Krauff_ModelDb_PerfilesDb extends Moon2_DBmanager_PDO {

    public function __construct() {
        parent::__construct();
        $this->_Pkey["value"] = 0;
        $this->_table = "perfiles";
        $this->_Pkey["key"] = "codperfil";
        $this->_sequence = $this->_table . "_" . $this->_Pkey["key"] . "_seq";
    }

    public function load_all(&$rsNumRows, $limit_numrows, $page, $Data) {
        $counterFields = "count(p.codperfil)";
        $Fields = "p.codperfil, lower(p.nombreperfil) AS nombreperfil, ";
        $Fields .= "(SELECT COUNT(codusuario) FROM usuarios WHERE codperfil = p.codperfil) AS cantidadusuarios ";
        $From = "FROM perfiles p ";
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

    public function comboperfiles() {
        $sql = "SELECT codperfil, nombreperfil ";
        $sql .= "FROM perfiles ";
        $sql .= "WHERE codperfil IN({$this->_DOM["PERFILES"]["WEBMASTER"]})";
        $funcArray = $this->GetAssoc($sql);
        return $funcArray;
    }

    public function comboPerfilesadm() {
        $sql = "SELECT codperfil, nombreperfil ";
        $sql .= "FROM perfiles ";
        return $this->GetAssoc($sql);
    }

}

//End class
?>