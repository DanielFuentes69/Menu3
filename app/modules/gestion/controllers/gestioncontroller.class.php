<?php

class Modules_Gestion_Controllers_GestionController extends Moon2_Controllers_Manager {

    public function __construct($parameters, $dom, $path_config) {
        parent::__construct($parameters, $dom, $path_config);
    }

    protected function buscarSoportes() {
        //**********************************************************************
        //recepcion de parametros
        //**********************************************************************
        $producto = $this->_parameters->get_parameter("producto", "0");
        $desde = Moon2_DateTime_Date::format($this->_parameters->get_parameter("desde", "0"), 8);
        $hasta = Moon2_DateTime_Date::format($this->_parameters->get_parameter("hasta", "0"), 8);
        //**********************************************************************

        $this->_parameters->delete_all();
        $this->_parameters->add("producto", $producto);
        $this->_parameters->add("desde", $desde);
        $this->_parameters->add("hasta", $hasta);
        $cadenaUrl = $this->_parameters->KeyGen();

        $this->_url = $this->_path_config["ROOT"]["modules"] . "/gestion/views/pagos_clientes.php?" . $cadenaUrl;
        header("Location: {$this->_url}");
        exit();
    }
    
    protected function eliminar() {
        //**********************************************************************
        //recepcion de parametros
        //**********************************************************************
        $obj = new Modules_Webpage_Model_Archivos();
        $obj = $this->_parameters->set_object($obj);
        $producto = $this->_parameters->get_parameter("producto", "0");
        $desde = $this->_parameters->get_parameter("desde", "0");
        $hasta = $this->_parameters->get_parameter("hasta", "0");
        //**********************************************************************
        //**********************************************************************
        //creacion de objetos
        //**********************************************************************
        $Archivos = new Modules_Webpage_Model_Archivos();
        $ArchivosFacade = new Modules_Webpage_Model_ArchivosFacade();
        $Archivo = new Moon2_Files_FileManager();
        //**********************************************************************
        //**********************************************************************
        //muestra todo el registro del archivo
        //**********************************************************************
        $Archivos->set_codarchivo($obj->get_codarchivo());
        $ArchivosFacade->loadOne($Archivos);
        $imagenCodificada = $Archivos->get_imagencodificada();
        //**********************************************************************

        if ($ArchivosFacade->delete($obj)) {
            $msg = 11;
            //******************************************************************
            //eliminar el archivo de la carpeta web_files
            //******************************************************************
            $rutaArchivo = $this->_path_config["SOPORTES_PAGO"] . "/" . $imagenCodificada;
            $Archivo->deleteFile($rutaArchivo);
            //******************************************************************
        } else {
            $msg = 33;
        }

        $this->_parameters->delete_all();
        $this->_parameters->add("msg", $msg);
        $this->_parameters->add("producto", $producto);
        $this->_parameters->add("desde", $desde);
        $this->_parameters->add("hasta", $hasta);
        $cadenaUrl = $this->_parameters->KeyGen();

        $this->_url = $this->_path_config["ROOT"]["modules"] . "/gestion/views/pagos_clientes.php?" . $cadenaUrl;
        header("Location: {$this->_url}");
        exit();
    }

}

?>