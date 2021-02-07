<?php

class Modules_Tienda_Controllers_ProductosController extends Moon2_Controllers_Manager {

    public function __construct($parameters, $dom, $pathConfig) {
        parent::__construct($parameters, $dom, $pathConfig);
    }

    protected function buscar() {
        $this->_parameters->delete_param("action");
        $this->_parameters->delete_param("controller");

        $modulo = $this->_path_config["ROOT"]["modules"] . "/tienda";
        $this->redirect($modulo, "productos_admin", $this->_parameters->get_parameters());
    }
    
    protected function tiendaBuscar() {
        $this->_parameters->delete_param("action");
        $this->_parameters->delete_param("controller");
        $this->_parameters->delete_param("SECURITY_ID");

        $modulo = $this->_path_config["ROOT"]["modules"] . "/outside";
        $this->redirect($modulo, "tienda", $this->_parameters->get_parameters());
    }

    protected function eliminar() {
        $codProducto = $this->_parameters->get_parameter("codproducto", "0");
        $controlProducto = new Modules_Tienda_Controllers_ProductosCrudController($this->_parameters, $this->_dom, $this->_path_config, false);

        $params = $controlProducto->eliminarProducto($codProducto);
        $modulo = $this->_path_config["ROOT"]["modules"] . "/tienda";
        $this->redirect($modulo, "productos_admin", $params);
    }

    protected function crear() {
        $paginaRegreso = "productos_editar";
        $controlProducto = new Modules_Tienda_Controllers_ProductosCrudController($this->_parameters, $this->_dom, $this->_path_config, false);
        $params = $controlProducto->crearProducto();
        if ($params["msg"] == 344) {
            $paginaRegreso = "productos_crear";
        }
        $modulo = $this->_path_config["ROOT"]["modules"] . "/tienda";
        $this->redirectScript($modulo, $paginaRegreso, $params);
    }

    protected function actualizar() {
        $controlProducto = new Modules_Tienda_Controllers_ProductosCrudController($this->_parameters, $this->_dom, $this->_path_config, false);
        $params = $controlProducto->actualizarProducto();
        $modulo = $this->_path_config["ROOT"]["modules"] . "/tienda";
        $this->redirectScript($modulo, "productos_editar", $params);
    }

    protected function cargarImagen() {
        $base64 = $this->_parameters->get_parameter("imagenAdjunta", NULL);
        $codProducto = $this->_parameters->get_parameter("codproducto", "0");
        $controlProducto = new Modules_Tienda_Controllers_ProductosCrudController($this->_parameters, $this->_dom, $this->_path_config, false);
        $params = $controlProducto->cargarImagen($codProducto, $base64);

        $modulo = $this->_path_config["ROOT"]["modules"] . "/tienda";
        $this->redirectScript($modulo, "productos_editar", $params);
    }

    protected function eliminarImagen() {
        $codImagen = $this->_parameters->get_parameter("codimagen", "0");
        $codProducto = $this->_parameters->get_parameter("codproducto", "");
        $controlProducto = new Modules_Tienda_Controllers_ProductosCrudController($this->_parameters, $this->_dom, $this->_path_config, false);
        $params = $controlProducto->eliminarImagen($codProducto, $codImagen);

        $modulo = $this->_path_config["ROOT"]["modules"] . "/tienda";
        $this->redirectScript($modulo, "productos_editar", $params);
    }

    protected function eliminarPrecio() {
        $codProducto = $this->_parameters->get_parameter("codproducto", "");
        $codListaPrecio = $this->_parameters->get_parameter("codlistaprecio", "0");
        $controlProducto = new Modules_Tienda_Controllers_ProductosCrudController($this->_parameters, $this->_dom, $this->_path_config, false);
        $params = $controlProducto->eliminarPrecio($codProducto, $codListaPrecio);

        $modulo = $this->_path_config["ROOT"]["modules"] . "/tienda";
        $this->redirectScript($modulo, "productos_editar", $params);
    }
    
    protected function crearPrecio() {
        $valorPrecio = $this->_parameters->get_parameter("valor", "");
        $valor = str_replace(',', '', $valorPrecio);
        $codProducto = $this->_parameters->get_parameter("codproducto", "");
        $codListaPrecio = $this->_parameters->get_parameter("codlistaprecio", "0");
        
        $controlProducto = new Modules_Tienda_Controllers_ProductosCrudController($this->_parameters, $this->_dom, $this->_path_config, false);
        $params = $controlProducto->crearPrecio($codProducto, $codListaPrecio, $valor);

        $modulo = $this->_path_config["ROOT"]["modules"] . "/tienda";
        $this->redirectScript($modulo, "productos_editar", $params);
    }
    
    protected function actualizarPrecio() {
        $valorPrecio = $this->_parameters->get_parameter("valor", "0");
        $valor = str_replace(',', '', $valorPrecio);
        $codProducto = $this->_parameters->get_parameter("codproducto", "0");
        $codListaPrecio = $this->_parameters->get_parameter("codlistaprecio", "0");
        
        $controlProducto = new Modules_Tienda_Controllers_ProductosCrudController($this->_parameters, $this->_dom, $this->_path_config, false);
        $params = $controlProducto->actualizarPrecio($codProducto, $codListaPrecio, $valor);

        $modulo = $this->_path_config["ROOT"]["modules"] . "/tienda";
        $this->redirectScript($modulo, "productos_editar", $params);
    }

}

?>