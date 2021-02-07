<?php

class Modules_Tienda_Controllers_ListasPreciosController extends Moon2_Controllers_Manager {

    public function __construct($parameters, $dom, $pathConfig) {
        parent::__construct($parameters, $dom, $pathConfig);
    }

    protected function buscar() {
        $this->_parameters->delete_param("action");
        $this->_parameters->delete_param("controller");

        $modulo = $this->_path_config["ROOT"]["modules"] . "/tienda";
        $this->redirect($modulo, "listas_precios_admin", $this->_parameters->get_parameters());
    }

    protected function eliminar() {
        $codListaPrecio = $this->_parameters->get_parameter("codlistaprecio", "0");
        $controlListaPrecio = new Modules_Tienda_Controllers_ListasPreciosCrudController($this->_parameters, $this->_dom, $this->_path_config, false);

        $params = $controlListaPrecio->eliminarListaPrecio($codListaPrecio);
        $modulo = $this->_path_config["ROOT"]["modules"] . "/tienda";
        $this->redirect($modulo, "listas_precios_admin", $params);
    }

    protected function crear() {
        $controlListaPrecio = new Modules_Tienda_Controllers_ListasPreciosCrudController($this->_parameters, $this->_dom, $this->_path_config, false);
        $params = $controlListaPrecio->crearListaPrecio();
        $modulo = $this->_path_config["ROOT"]["modules"] . "/tienda";
        $this->redirectScript($modulo, "listas_precios_admin", $params);
    }
    
    protected function actualizar() {
        $controlListaPrecio = new Modules_Tienda_Controllers_ListasPreciosCrudController($this->_parameters, $this->_dom, $this->_path_config, false);
        $params = $controlListaPrecio->actualizarListaPrecio();
        $modulo = $this->_path_config["ROOT"]["modules"] . "/tienda";
        $this->redirectScript($modulo, "listas_precios_admin", $params);
    }

}

?>