<?php

class Modules_Tienda_ModelDb_ProductosDB extends Moon2_DBmanager_PDO {

    public function __construct() {
        parent::__construct();
        $this->_table = "productos";
        $this->_Pkey["key"] = "codproducto";
        $this->_Pkey["value"] = 0;
        $this->_sequence = $this->_table . "_" . $this->_Pkey['key'] . "_seq";
    }

    public function load_all(&$rsNumRows, $limit_numrows, $page, $Data) {
        $recordCounter = "count(p.codproducto)";
        $columns = "p.codproducto, p.codcategoria, p.nombreproducto, p.referencia, p.descripcion, c.nombrecategoria, p.iva, ";
        $columns .= "(SELECT count(codimagen) FROM imagenes WHERE codproducto = p.codproducto) as cantimagenes, ";
        $columns .= "(SELECT count(codlistaprecio) FROM precios WHERE codproducto = p.codproducto) as cantprecios, ";
        $columns .= "(SELECT nombrecodificado FROM imagenes WHERE codproducto = p.codproducto LIMIT 1) as nombrecodificado, ";
        $columns .= "(SELECT mime FROM imagenes WHERE codproducto = p.codproducto LIMIT 1) as mime, ";
        $columns .= "(SELECT valor FROM precios WHERE codproducto = p.codproducto AND codlistaprecio = 2 LIMIT 1) as precio ";
        $from = "FROM productos p INNER JOIN categorias c ON c.codcategoria = p.codcategoria ";
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

    public function obtenerPrecios($codProducto) {
        $sql = "SELECT codlistaprecio, valor FROM precios ";
        $sql .= "WHERE codproducto = ? ORDER BY valor";
        return $this->GetAssoc($sql, [$codProducto]);
    }

    public function obtenerNombrePrecios($codProducto) {
        $sql = "SELECT lp.codlistaprecio, lp.nombrelistaprecio, lp.estado, pre.valor ";
        $sql .= "FROM listasprecios lp INNER JOIN precios pre ON lp.codlistaprecio = pre.codlistaprecio ";
        $sql .= "WHERE pre.codproducto = ? ORDER BY valor desc";
        return $this->GetAll($sql, [$codProducto]);
    }

    public function sePuedeBorrar($codProducto) {
        $sqlImagenes = "select count(codimagen) FROM imagenes WHERE codproducto = ?;";
        $cantImagenes = $this->GetOne($sqlImagenes, [$codProducto]);
        if ($cantImagenes > 0) {
            return false;
        }
        $sqlPrecios = "select count(codlistaprecio) FROM precios WHERE codproducto = ?;";
        $cantPrecios = $this->GetOne($sqlPrecios, [$codProducto]);
        if ($cantPrecios > 0) {
            return false;
        }
        // Falta el pedazo cuando está en un pedido, no están esas tablas
        //**********************************************************************
        return true;
    }

    public function obtenerImagenes($codProducto) {
        $sql = "SELECT codimagen, nombrereal, nombrecodificado, mime, tamanno ";
        $sql .= "FROM imagenes WHERE codproducto = ? ORDER BY codimagen";
        return $this->GetAll($sql, [$codProducto]);
    }

    public function eliminarPrecio($codProducto, $codListaPrecio) {
        $sql = "DELETE FROM precios WHERE codproducto = ? AND codlistaprecio = ?";
        return $this->ExecuteSql($sql, [$codProducto, $codListaPrecio]);
    }

    public function crearPrecio($codProducto, $codListaPrecio, $valor) {
        $sql = "INSERT INTO precios(codlistaprecio, codproducto, valor) VALUES (?, ?, ?)";
        return $this->ExecuteSql($sql, [$codListaPrecio, $codProducto, $valor]);
    }

    public function actualizarPrecio($codProducto, $codListaPrecio, $valor) {
        $sql = "UPDATE precios SET valor = ? WHERE codlistaprecio = ? AND codproducto = ?";
        return $this->ExecuteSql($sql, [$valor, $codListaPrecio, $codProducto]);
    }

    public function obtenerPrecioProducto($codProducto, $codListaPrecio) {
        $sql = "SELECT valor FROM precios WHERE codproducto = ? AND codlistaprecio = ?";
        return (float) $this->GetOne($sql, [$codProducto, $codListaPrecio]);
    }

    public function infoProducto($codproducto, $codlistaprecio = "") {
        $condicionLista = "";
        $params = [$codproducto];
        if (!empty($codlistaprecio)) {
            $params = [$codproducto, $codlistaprecio];
            $condicionLista = "AND precios.codlistaprecio = ?";
        }

        $sql = "SELECT pro.nombreproducto, pro.referencia, pro.iva, precios.valor ";
        $sql .= "FROM productos pro INNER JOIN precios ON precios.codproducto = pro.codproducto ";
        $sql .= "WHERE pro.codproducto = ? {$condicionLista}";
        return $this->GetRow($sql, $params);
    }

}

?>