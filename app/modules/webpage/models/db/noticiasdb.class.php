<?php

class Modules_Webpage_ModelDb_Noticiasdb extends Moon2_DBmanager_PDO {

    public function __construct() {
        parent::__construct();
        $this->_table = "noticias";
        $this->_Pkey["key"] = "codnoticia";
        $this->_Pkey["value"] = 0;
        $this->_sequence = $this->_table . "_" . $this->_Pkey['key'] . "_seq";
    }

    public function load_all(&$rsNumRows, $limit_numrows, $page, $Data) {
        $counterFields = "count(n.codnoticia)";
        $Fields = "n.codnoticia, n.codusuario, lower(n.titulo) AS titulo, n.descripcion, n.imagencodificada, n.mime, n.tamanno, n.nombreimagen, n.fecha, n.hora, n.tipo, n.cantmegusta, ";
        $Fields .= "(SELECT lower(nombres) AS nombres FROM usuarios WHERE codusuario=n.codusuario) AS nomusuario ";
        $From = "FROM noticias n ";
        $Where = $this->searchCondition("AND") . " ";
        $Order = "ORDER BY {$Data["order"]} DESC";

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

    public function allNoticias() {
        $sql = "SELECT n.codnoticia, n.codusuario, n.titulo, n.descripcion, n.imagencodificada, n.mime, n.tamanno, n.nombreimagen, n.fecha, n.hora ";
        $sql .= "FROM noticias n ";
        return $this->GetAll($sql);
    }

    public function noticiasRecientes() {
        $sql = "SELECT n.codnoticia, n.codusuario, lower(n.titulo) AS titulo, n.descripcion, n.imagencodificada, n.mime, n.tamanno, n.nombreimagen, n.fecha, n.hora, n.tipo, n.cantmegusta ";
        $sql .= "FROM noticias n ";
        $sql .= "ORDER BY n.codnoticia DESC LIMIT 6 ";
        return $this->GetAll($sql);
    }

    public function updateMeGusta($cantidadnueva, $codnoticia) {
        $parametros = array($cantidadnueva, $codnoticia);
        $sql = "UPDATE noticias ";
        $sql .= "SET cantmegusta=? ";
        $sql .= "WHERE codnoticia=? ";
        return $this->ExecuteSql($sql, $parametros);
    }

}

?>