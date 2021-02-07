<?php

class Modules_Tienda_ModelDb_ImagenesDB extends Moon2_DBmanager_PDO {

    public function __construct() {
        parent::__construct();
        $this->_table = "imagenes";
        $this->_Pkey["key"] = "codimagen";
        $this->_Pkey["value"] = 0;
        $this->_sequence = $this->_table . "_" . $this->_Pkey['key'] . "_seq";
    }

}

?>