<?php

class Modules_Tienda_Controllers_PedidosController extends Moon2_Controllers_Manager {

    public function __construct($parameters, $dom, $pathConfig) {
        parent::__construct($parameters, $dom, $pathConfig);
    }

    protected function buscar() {
        $this->_parameters->delete_param("action");
        $this->_parameters->delete_param("controller");

        $modulo = $this->_path_config["ROOT"]["modules"] . "/tienda";
        $this->redirect($modulo, "pedidos_admin", $this->_parameters->get_parameters());
    }

    protected function eliminar() {
        $codPedido = $this->_parameters->get_parameter("codpedido", "0");
        $controlPedido = new Modules_Tienda_Controllers_PedidosCrudController($this->_parameters, $this->_dom, $this->_path_config, false);

        $params = $controlPedido->eliminarPedido($codPedido);
        $modulo = $this->_path_config["ROOT"]["modules"] . "/tienda";
        $this->redirect($modulo, "pedidos_admin", $params);
    }

}

?>