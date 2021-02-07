<?php

class Modules_Tienda_Controllers_CategoriasController extends Moon2_Controllers_Manager {

    public function __construct($parameters, $dom, $pathConfig) {
        parent::__construct($parameters, $dom, $pathConfig);
    }

    protected function buscar() {
        $this->_parameters->delete_param("action");
        $this->_parameters->delete_param("controller");

        $modulo = $this->_path_config["ROOT"]["modules"] . "/tienda";
        $this->redirect($modulo, "categorias_admin", $this->_parameters->get_parameters());
    }

    protected function eliminar() {
        $codCategoria = $this->_parameters->get_parameter("codcategoria", "0");
        $controlCategoria = new Modules_Tienda_Controllers_CategoriasCrudController($this->_parameters, $this->_dom, $this->_path_config, false);

        $params = $controlCategoria->eliminarCategoria($codCategoria);
        $modulo = $this->_path_config["ROOT"]["modules"] . "/tienda";
        $this->redirect($modulo, "categorias_admin", $params);
    }

    protected function crear() {
        $controlCategoria = new Modules_Tienda_Controllers_CategoriasCrudController($this->_parameters, $this->_dom, $this->_path_config, false);
        $params = $controlCategoria->crearCategoria();
        $modulo = $this->_path_config["ROOT"]["modules"] . "/tienda";
        $this->redirectScript($modulo, "categorias_admin", $params);
    }
    
    protected function actualizar() {
        $controlCategoria = new Modules_Tienda_Controllers_CategoriasCrudController($this->_parameters, $this->_dom, $this->_path_config, false);
        $params = $controlCategoria->actualizarCategoria();
        $modulo = $this->_path_config["ROOT"]["modules"] . "/tienda";
        $this->redirectScript($modulo, "categorias_admin", $params);
    }

}

?>