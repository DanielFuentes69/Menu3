<?php

class Modules_Outside_Controllers_OutsideController extends Moon2_Controllers_Manager {

    public function __construct($parameters, $dom, $path_config) {
        parent::__construct($parameters, $dom, $path_config);
    }

    protected function enviarEmail() {
        //**********************************************************************
        //Recepcion de parametros
        //**********************************************************************
        $cajaNombres = $this->_parameters->get_parameter("nombres", "0");
        $cajaEmail = $this->_parameters->get_parameter("correo", "0");
        $cajaTelefono = $this->_parameters->get_parameter("celular", "0");
        $cajaMensaje = $this->_parameters->get_parameter("mensaje", "0");
        $ipServidor = $this->_dom["IPSERVIDOR"];
        //**********************************************************************
        //**********************************************************************
        //mensaje a enviar por email
        //**********************************************************************
        $textoMensaje = Modules_Outside_Model_MensajeCorreo::infoemail($cajaNombres, $cajaTelefono, $cajaEmail, $cajaMensaje, $ipServidor);
        //**********************************************************************
        //**********************************************************************
        $correo_destino = "ventas@agrocentersas.com";
        $asunto_correo = "Contacto web Agrocenter S.A.S";
        $objCorreo = new Moon2_Mail_Email($this->_dom["MAILFROM"], $correo_destino, $asunto_correo, $textoMensaje, "", "info@agrocentersas.com");
        if (preg_match("/Win/i", $_SERVER["SERVER_SOFTWARE"])) {
            echo $textoMensaje;
            exit();
        } else {
            $msg = 128;
            $objCorreo->sendMail();
            $this->_parameters->delete_all();
            $this->_parameters->add("msg", $msg);
            $cadenaUrl = $this->_parameters->KeyGen();
            //exit();
            //$this->_url = $this->_path_config["ROOT"]["modules"] . "/outside/views/contactenos.php?" . $cadenaUrl;
            //header("Location: https://www.disaluminios.com/intranet/app/modules/outside/views/contactenos.php?msg=enviado correctamente");
            echo "<br/>MENSAJE ENVIADO CORRECTAMENTE";
            exit();
        }
    }

    protected function enviarEmailNosotros() {
        //**********************************************************************
        //Recepcion de parametros
        //**********************************************************************
        $cajaNombres = $this->_parameters->get_parameter("nombres", "0");
        $cajaEmail = $this->_parameters->get_parameter("correo", "0");
        $cajaTelefono = $this->_parameters->get_parameter("celular", "0");
        $cajaMensaje = $this->_parameters->get_parameter("mensaje", "0");
        $ipServidor = $this->_dom["IPSERVIDOR"];
        //**********************************************************************
        //**********************************************************************
        //mensaje a enviar por email
        //**********************************************************************
        $textoMensaje = Modules_Outside_Model_MensajeCorreo::infoemail($cajaNombres, $cajaTelefono, $cajaEmail, $cajaMensaje, $ipServidor);
        //**********************************************************************
        //**********************************************************************
        $correo_destino = "ventas@agrocentersas.com";
        $asunto_correo = "Contacto web Agrocenter S.A.S";
        $objCorreo = new Moon2_Mail_Email($this->_dom["MAILFROM"], $correo_destino, $asunto_correo, $textoMensaje, "", "info@agrocentersas.com");
        if (preg_match("/Win/i", $_SERVER["SERVER_SOFTWARE"])) {
            echo $textoMensaje;
            exit();
        } else {
            $msg = 128;
            $objCorreo->sendMail();
            $this->_parameters->delete_all();
            $this->_parameters->add("msg", $msg);
            $cadenaUrl = $this->_parameters->KeyGen();
            //exit();
            //$this->_url = $this->_path_config["ROOT"]["modules"] . "/outside/views/index.php?" . $cadenaUrl;
            //header("Location: https://www.disaluminios.com/intranet/app/modules/outside/views/nosotros.php?msg=enviado correctamente");
            echo "<br/>MENSAJE ENVIADO CORRECTAMENTE";
            exit();
        }
    }

    protected function addShoppingCart() {
        $cantidad = (int) $this->_parameters->get_parameter("can", "0");
        $codigosTxt = $this->_parameters->get_parameter("idp", "0");

        $codProducto = $codigosTxt;
        $codListaPrecio = 2;

        $facadeTienda = new Modules_Tienda_Model_ProductosFacade();
        $result = $facadeTienda->infoProducto($codProducto, $codListaPrecio);

        $iva = (float) $result["iva"];
        $valor = (float) $result["valor"];

        $subTotal = $cantidad * $valor;
        $valorIvaTmp = ($valor - ($valor / (1 + ($iva / 100))) );
        $valorIva = round($valorIvaTmp, 2, PHP_ROUND_HALF_EVEN);

        $arrParaCookie = [];
        $arrParaCookie["cod"] = $codigosTxt;
        $arrParaCookie["cant"] = (int) $cantidad;
        $arrParaCookie["nom"] = $result["nombreproducto"];
        $arrParaCookie["preciosf"] = $valor;
        $arrParaCookie["precio"] = number_format($valor, 0);
        $arrParaCookie["valorsf"] = $subTotal;
        $arrParaCookie["valor"] = number_format($subTotal, 0);
        $arrParaCookie["valoriva"] = $valorIva;
        $arrParaCookie["total"] = 0;
        $arrParaCookie["cantTotal"] = 0;

        $cookieName = "agroShoppingCart";
        $carritoCompras = [];

        $encontrado = false;
        if (!empty($_COOKIE[$cookieName]) && $_COOKIE[$cookieName] !== "[]") {
            $carritoCompras = json_decode($_COOKIE[$cookieName], true);

            foreach ($carritoCompras as $ind => $campo) {
                $nuevaCantidad = $campo["cant"];
                $nuevoValor = $nuevaCantidad * $campo["valorsf"];
                if ($campo["cod"] == $codigosTxt) {
                    $encontrado = true;
                    $nuevaCantidad = $cantidad + $campo["cant"];
                    $nuevoValor = $nuevaCantidad * $valor;
                    $carritoCompras[$ind]["cant"] = $nuevaCantidad;
                    $carritoCompras[$ind]["valorsf"] = $nuevoValor;
                    $carritoCompras[$ind]["valor"] = number_format($nuevoValor, 0);
                    $arrParaCookie["valor"] = number_format($nuevoValor, 0);

                    $arrParaCookie["exist"] = true;
                    $arrParaCookie["cant"] = $nuevaCantidad;
                }
            }
        }

        if (!$encontrado) {
            $carritoCompras[] = $arrParaCookie;
        }
        $arrParaCookie["cantTotal"] = count($carritoCompras);
        $valorAcumulado = $this->getTotal($carritoCompras);
        $arrParaCookie["total"] = "$" . number_format($valorAcumulado, 0);
        $cookieValue = json_encode($arrParaCookie);

        setcookie($cookieName, json_encode($carritoCompras), time() + (86400 * 2), "/"); // 86400 = 1 day
        $_COOKIE[$cookieName] = json_encode($carritoCompras);
        echo $cookieValue;
    }

    private function getTotal($carritoCompras) {
        $total = 0;
        foreach ($carritoCompras as $ind => $campo) {
            $total = $total + $campo["valorsf"];
        }
        return $total;
    }

    protected function delShoppingCart() {
        $codigosTxt = $this->_parameters->get_parameter("idp", "0");

        $cookieName = "agroShoppingCart";
        $carritoCompras = json_decode($_COOKIE[$cookieName], true);

        foreach ($carritoCompras as $indice => $campo) {
            if ($campo["cod"] == $codigosTxt) {
                unset($carritoCompras[$indice]);
            }
        }

        setcookie($cookieName, json_encode($carritoCompras), time() + (86400 * 2), "/"); // 86400 = 1 day
        $_COOKIE[$cookieName] = json_encode($carritoCompras);

        $arrParaCookie = [];
        $arrParaCookie["cantTotal"] = count($carritoCompras);
        $valorAcumulado = $this->getTotal($carritoCompras);
        $arrParaCookie["total"] = "$" . number_format($valorAcumulado, 0);
        $cookieValue = json_encode($arrParaCookie);
        if (empty($carritoCompras)) {
            $arrParaCookie["VACIO"] = "OK";
        } else {
            $arrParaCookie["VACIO"] = "NO";
        }
        echo $cookieValue;
    }

    protected function addOrder() {
        $identificador = $this->_parameters->get_parameter("id", "0");
        $documento = $this->_parameters->get_parameter("doc", "0");
        $nombreCliente = $this->_parameters->get_parameter("nom", "0");
        $correo = $this->_parameters->get_parameter("cor", "0");
        $direccion = $this->_parameters->get_parameter("dir", "0");
        $celular = $this->_parameters->get_parameter("cel", "0");

        $objPedido = new Modules_Tienda_Model_Pedidos();
        $objPedido->set_fecha(date("Y-m-d"));
        $objPedido->set_hora(date("H:i:s"));
        $objPedido->set_identificador($identificador);
        $objPedido->set_documento($documento);
        $objPedido->set_nombrecliente($nombreCliente);
        $objPedido->set_correo($correo);
        $objPedido->set_direccion($direccion);
        $objPedido->set_celular($celular);
        $objPedido->set_despachado(2);

        $pedidoFachada = new Modules_Tienda_Model_PedidosFacade();

        if ($pedidoFachada->add($objPedido)) {
            $codPedido = $objPedido->get_codpedido();
            $cookieName = "agroShoppingCart";
            $carritoCompras = [];
            if (!empty($_COOKIE[$cookieName]) && $_COOKIE[$cookieName] !== "[]") {
                $carritoCompras = json_decode($_COOKIE[$cookieName], true);

                foreach ($carritoCompras as $ind => $campo) {
                    $codProducto = $campo["cod"];
                    $cantidad = $campo["cant"];
                    $precio = $campo["preciosf"];
                    $impuesto = $campo["valoriva"];
                    $totalParcial = $campo["valorsf"];

                    $objDetallePedido = new Modules_Tienda_Model_DetallePedidos();
                    $objDetallePedido->set_codpedido($codPedido);
                    $objDetallePedido->set_codproducto($codProducto);
                    $objDetallePedido->set_cantidad($cantidad);
                    $objDetallePedido->set_valor($precio);
                    $objDetallePedido->set_impuesto($impuesto);
                    $objDetallePedido->set_totalparcial($totalParcial);

                    $detallePedidoFachada = new Modules_Tienda_Model_DetallePedidosFacade();
                    $detallePedidoFachada->add($objDetallePedido);
                }
            }
            $arrRespuesta = [];
            $arrRespuesta["RESULT"] = "OK";
            echo json_encode($arrRespuesta);
        } else {
            $arrRespuesta = [];
            $arrRespuesta["RESULT"] = "ERROR";
            echo json_encode($arrRespuesta);
        }
    }

}

?>