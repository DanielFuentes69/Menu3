<?php

class Modules_Tienda_ModelDb_DetallePedidosDB extends Moon2_DBmanager_PDO {

    public function __construct() {
        parent::__construct();
        $this->_table = "detallepedidos";
        $this->_Pkey["key"] = "coddetallepedido";
        $this->_Pkey["value"] = 0;
        $this->_sequence = $this->_table . "_" . $this->_Pkey['key'] . "_seq";
    }

    public function obtenerDetallePedido($codPedido) {
        $sql = "SELECT p.nombreproducto, p.referencia, d.coddetallepedido, d.codproducto, ";
        $sql .= "d.cantidad, d.valor, d.impuesto, d.totalparcial ";
        $sql .= "FROM productos p INNER JOIN detallepedidos d ON p.codproducto = d.codproducto ";
        $sql .= "WHERE d.codpedido = ? ";
        $sql .= "ORDER BY p.nombreproducto";
        return $this->GetAll($sql, [$codPedido]);
    }

}

?>