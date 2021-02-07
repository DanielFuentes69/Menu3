<?php
class Modules_Krauff_ModelDb_AccesosDb extends Moon2_DBmanager_PDO{

public function __construct(){
    parent::__construct();
    $this->_table = "accesos";
    $this->_Pkey["key"] = "codacceso";
    $this->_Pkey["value"] = 0;
    $this->_sequence = $this->_table."_".$this->_Pkey['key']."_seq";
}

public function consultar_registros_accessos($codusuario){
    $parametros = array($codusuario);
    $sql = "SELECT * FROM accesos WHERE codusuario = ? ORDER BY codacceso DESC";
    $funcarray = $this->GetAll($sql,$parametros);
    return $funcarray; 
}

public function contar_registros_accessos($codusuario){
    $parametros = array($codusuario);
    $sql = "SELECT COUNT(*) FROM accesos WHERE codusuario = ?";
    $funcarray = $this->GetOne($sql,$parametros);
    return $funcarray; 
}

public function ultimo_acceso_sistema($codusuario){
    $parametros = array($codusuario);
    $sql = "SELECT MAX(codacceso) FROM accesos WHERE codusuario = ?";
    $funcarray = $this->GetOne($sql,$parametros);
    return $funcarray; 
}

}//End class
?>