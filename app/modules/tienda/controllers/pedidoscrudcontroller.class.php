<?php

class Modules_Tienda_Controllers_PedidosCrudController extends Moon2_Controllers_Manager {

    public function __construct($parameters, $dom, $pathConfig, $externalClass) {
        parent::__construct($parameters, $dom, $pathConfig, $externalClass);
    }

    public function eliminarPedido($codPedido): array {
        $params = ["msg" => 322];
        $pedidosFachada = new Modules_Tienda_Model_PedidosFacade();
        if ($pedidosFachada->borrarPedido($codPedido)) {
            $params = ["msg" => 122];
        }
        return $params;
    }

}

?>