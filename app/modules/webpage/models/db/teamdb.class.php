<?php

class Modules_Webpage_ModelDb_Teamdb extends Moon2_DBmanager_PDO {

    public function __construct() {
        parent::__construct();
        $this->_table = "team";
        $this->_Pkey["key"] = "codteam";
        $this->_Pkey["value"] = 0;
        $this->_sequence = $this->_table . "_" . $this->_Pkey['key'] . "_seq";
    }

    public function load_all(&$rsNumRows, $limit_numrows, $page, $Data) {
        $counterFields = "count(t.codteam)";
        $Fields = "t.codteam, t.codusuario, t.nombre, t.cargo, t.facebook, t.twitter, t.instagram, t.youtube,  ";
        $Fields .= "t.linkedin, t.imagencodificada, t.mime,  t.tamanno, t.nombreimagen, t.fecha, t.hora ";
        $From = "FROM team t ";
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

    public function allTeam() {
        $sql = "SELECT codteam, nombre, cargo, facebook, twitter, instagram, youtube, linkedin,  imagencodificada, mime ";
        $sql .= "FROM team ";
        $sql .= "ORDER BY codteam ASC ";
        return $this->GetAll($sql);
    }

}

?>