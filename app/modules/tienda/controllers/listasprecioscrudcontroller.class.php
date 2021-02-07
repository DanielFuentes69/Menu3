<?php

class Modules_Tienda_Controllers_ListasPreciosCrudController extends Moon2_Controllers_Manager {

    public function __construct($parameters, $dom, $pathConfig, $externalClass) {
        parent::__construct($parameters, $dom, $pathConfig, $externalClass);
    }

    public function eliminarListaPrecio($codListaPrecio): array {
        $params = ["msg" => 322];
        $listaPrecioFachada = new Modules_Tienda_Model_ListasPreciosFacade();
        if (!$listaPrecioFachada->utilizada($codListaPrecio)) {
            $listaPrecio = new Modules_Tienda_Model_ListasPrecios();
            $listaPrecio->set_codlistaprecio($codListaPrecio);
            if ($listaPrecioFachada->delete($listaPrecio)) {
                $params = ["msg" => 122];
            }
        }
        return $params;
    }

    public function crearListaPrecio(): array {
        $objListaPrecio = new Modules_Tienda_Model_ListasPrecios();
        $listaPrecio = $this->_parameters->set_object($objListaPrecio);

        $params = ["msg" => 344];
        $listaPrecioFachada = new Modules_Tienda_Model_ListasPreciosFacade();
        if ($listaPrecioFachada->add($listaPrecio)) {
            $params = ["msg" => 144];
        }
        return $params;
    }

    public function actualizarListaPrecio(): array {
        $objListaPrecio = new Modules_Tienda_Model_ListasPrecios();
        $listaPrecio = $this->_parameters->set_object($objListaPrecio);

        $params = ["msg" => 364];
        $listaPrecioFachada = new Modules_Tienda_Model_ListasPreciosFacade();
        if ($listaPrecioFachada->update($listaPrecio)) {
            $params = ["msg" => 164];
        }
        return $params;
    }

}

?>