<?php

class Modules_Tienda_Controllers_ProductosCrudController extends Moon2_Controllers_Manager {

    public function __construct($parameters, $dom, $pathConfig, $externalClass) {
        parent::__construct($parameters, $dom, $pathConfig, $externalClass);
    }

    public function eliminarProducto($codProducto): array {
        $params = ["msg" => 322];
        $productosFachada = new Modules_Tienda_Model_ProductosFacade();
        if ($productosFachada->sePuedeBorrar($codProducto)) {
            $producto = new Modules_Tienda_Model_Productos();
            $producto->set_codproducto($codProducto);
            if ($productosFachada->delete($producto)) {
                $params = ["msg" => 122];
            }
        }
        return $params;
    }

    public function eliminarImagen($codProducto, $codImagen): array {
        $params = ["codproducto" => $codProducto, "msg" => 335, "p" => 3];
        $imagenesFachada = new Modules_Tienda_Model_ImagenesFacade();
        $imagen = new Modules_Tienda_Model_Imagenes();
        $imagen->set_codimagen($codImagen);
        $imagenesFachada->loadOne($imagen);
        $rutaCompleta = $this->_path_config["IMAGES_PRODUCTOS"] . "/" . $imagen->get_nombrecodificado();
        if ($imagenesFachada->delete($imagen)) {
            unlink($rutaCompleta);
            $params = ["codproducto" => $codProducto, "msg" => 135, "p" => 3];
        }
        return $params;
    }

    public function eliminarPrecio($codProducto, $codListaPrecio): array {
        $params = ["codproducto" => $codProducto, "msg" => 339, "p" => 2];
        $productosFachada = new Modules_Tienda_Model_ProductosFacade();

        if ($productosFachada->eliminarPrecio($codProducto, $codListaPrecio)) {
            $params = ["codproducto" => $codProducto, "msg" => 139, "p" => 2];
        }
        return $params;
    }

    public function crearPrecio($codProducto, $codListaPrecio, $valor): array {
        $params = ["codproducto" => $codProducto, "msg" => 331, "p" => 2];
        $productosFachada = new Modules_Tienda_Model_ProductosFacade();

        if ($productosFachada->crearPrecio($codProducto, $codListaPrecio, $valor)) {
            $params = ["codproducto" => $codProducto, "msg" => 131, "p" => 2];
        }
        return $params;
    }

    public function actualizarPrecio($codProducto, $codListaPrecio, $valor): array {
        $params = ["codproducto" => $codProducto, "msg" => 337, "p" => 2];
        $productosFachada = new Modules_Tienda_Model_ProductosFacade();

        if ($productosFachada->actualizarPrecio($codProducto, $codListaPrecio, $valor)) {
            $params = ["codproducto" => $codProducto, "msg" => 137, "p" => 2];
        }
        return $params;
    }

    public function crearProducto(): array {
        $objProducto = new Modules_Tienda_Model_Productos();
        $producto = $this->_parameters->set_object($objProducto);

        $params = ["msg" => 344];
        $productosFachada = new Modules_Tienda_Model_ProductosFacade();
        if ($productosFachada->add($producto)) {
            $params = ["msg" => 144, "codproducto" => $producto->get_codproducto()];
        }
        return $params;
    }

    public function actualizarProducto(): array {
        $objProducto = new Modules_Tienda_Model_Productos();
        $producto = $this->_parameters->set_object($objProducto);

        $params = ["msg" => 364];
        $productosFachada = new Modules_Tienda_Model_ProductosFacade();
        if ($productosFachada->update($producto)) {
            $params = ["msg" => 164, "codproducto" => $producto->get_codproducto()];
        }
        return $params;
    }

    public function cargarImagen($codProducto, $base64): array {
        $base64Tmp = str_replace('data:image/png;base64,', '', $base64);
        $base64TmpCorregido = str_replace(' ', '+', $base64Tmp);
        $data = base64_decode($base64TmpCorregido);

        $resultado = $this->crearImagenWebFiles($codProducto, $data);
        if ($resultado === false) {
            $params = ["codproducto" => $codProducto, "msg" => 383, "p" => 3];
        } else {
            $objImagen = new Modules_Tienda_Model_Imagenes();
            $imagenFachada = new Modules_Tienda_Model_ImagenesFacade();

            $objImagen->set_codproducto($codProducto);
            $objImagen->set_nombrereal($resultado["name"]);
            $objImagen->set_nombrecodificado($resultado["name"]);
            $objImagen->set_tamanno($resultado["size"]);
            $objImagen->set_mime($resultado["mime"]);

            $params = ["codproducto" => $codProducto, "msg" => 393, "p" => 3];
            if ($imagenFachada->add($objImagen)) {
                $params = ["codproducto" => $codProducto, "msg" => 183, "p" => 3];
            }
        }
        return $params;
    }

    private function crearImagenWebFiles($codProducto, $data) {
        $resultado = [];
        $imagen = imagecreatefromstring($data);
        if ($imagen !== false) {
            $nombreArchivo = "pro_" . $codProducto . "_" . uniqid() . ".png";
            $rutaCompleta = $this->_path_config["IMAGES_PRODUCTOS"] . "/" . $nombreArchivo;
            imagepng($imagen, $rutaCompleta);

            $infoArchivo = getimagesize($rutaCompleta);
            $tamanno = filesize($rutaCompleta) / 1024;
            $mime = $infoArchivo["mime"];
            $resultado = ["name" => $nombreArchivo, "size" => $tamanno, "mime" => $mime];
            return $resultado;
        }
        return false;
    }

}

?>