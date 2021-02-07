<?php

class Modules_Tienda_Controllers_CategoriasCrudController extends Moon2_Controllers_Manager {

    public function __construct($parameters, $dom, $pathConfig, $externalClass) {
        parent::__construct($parameters, $dom, $pathConfig, $externalClass);
    }

    public function eliminarCategoria($codCategoria): array {
        $params = ["msg" => 322];
        $categoriasFachada = new Modules_Tienda_Model_CategoriasFacade();
        if (!$categoriasFachada->tieneProductos($codCategoria)) {
            $categoria = new Modules_Tienda_Model_Categorias();
            $categoria->set_codcategoria($codCategoria);
            if ($categoriasFachada->delete($categoria)) {
                $params = ["msg" => 122];
            }
        }
        return $params;
    }

    public function crearCategoria(): array {
        $objCategoria = new Modules_Tienda_Model_Categorias();
        $categoria = $this->_parameters->set_object($objCategoria);

        $params = ["msg" => 344];
        $categoriasFachada = new Modules_Tienda_Model_CategoriasFacade();
        if ($categoriasFachada->add($categoria)) {
            $params = ["msg" => 144];
        }
        return $params;
    }
    
    public function actualizarCategoria(): array {
        $objCategoria = new Modules_Tienda_Model_Categorias();
        $categoria = $this->_parameters->set_object($objCategoria);

        $params = ["msg" => 364];
        $categoriasFachada = new Modules_Tienda_Model_CategoriasFacade();
        if ($categoriasFachada->update($categoria)) {
            $params = ["msg" => 164];
        }
        return $params;
    }

}

?>