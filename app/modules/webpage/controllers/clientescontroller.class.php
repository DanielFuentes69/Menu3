<?php

class Modules_Webpage_Controllers_ClientesController extends Moon2_Controllers_Manager {

    public function __construct($parameters, $dom, $path_config) {
        parent::__construct($parameters, $dom, $path_config);
    }

    protected function crear() {
        //**********************************************************************
        //creacion de objetos
        //**********************************************************************
        $Archivo = new Moon2_Files_FileManager();
        $Clientes = new Modules_Webpage_Model_Clientes();
        $ClientesFacade = new Modules_Webpage_Model_ClientesFacade();
        //**********************************************************************
        //**********************************************************************
        //recepcion de parametros
        //**********************************************************************
        $msg = 338;
        $archivoProcesar = $this->_parameters->get_parameter("imagencliente", "0");
        $nombre = $this->_parameters->get_parameter("nombre", "");
        $tamanno_maximo = 900000000;
        $Archivo->set_realName($archivoProcesar["name"]);
        $extension = strtolower($Archivo->get_extension());
        $tipos_permitidos = array("gif", "png", "jpg");
        //**********************************************************************

        $Archivo->set_folder($this->_path_config["IMAGES_CLIENTES"]);
        if (!in_array($extension, $tipos_permitidos)) {
            $msg = 31;
        } else {
            $tamanno_archivo = (int) $archivoProcesar["size"];
            if ($tamanno_archivo > $tamanno_maximo || $tamanno_archivo === 0) {
                $msg = 345;
            } else {
                if ($Archivo->loadFile($archivoProcesar)) {
                    //**********************************************************************
                    //validamos la resolucion de la imagen
                    //**********************************************************************
                    $resolucionImagen = getimagesize($this->_path_config["IMAGES_CLIENTES"] . "/" . $Archivo->get_hiddName());
                    $anchoImagen = $resolucionImagen[0];
                    $altoImagen = $resolucionImagen[1];
                    //**********************************************************************

                    if ($anchoImagen == 370 && $altoImagen == 270) {
                        $Clientes->set_codusuario($this->_dom["USER_ID"]);
                        $Clientes->set_nombre($nombre);
                        $Clientes->set_imagencodificada($Archivo->get_hiddName());
                        $Clientes->set_mime($Archivo->get_mimetype());
                        $Clientes->set_tamanno($Archivo->get_size());
                        $Clientes->set_nombreimagen($Archivo->get_realName());
                        $Clientes->set_fecha(date("Y-m-d"));
                        $Clientes->set_hora(date("H:i:s"));

                        $msg = 21;
                        if ($ClientesFacade->add($Clientes)) {
                            $msg = 13;
                        }
                    } else {
                        //******************************************************************
                        //eliminar la imagen de la carpeta web_files
                        //******************************************************************
                        $rutaArchivo = "/" . $Archivo->get_hiddName();
                        $Archivo->deleteFile($rutaArchivo);
                        //******************************************************************
                        $msg = 396;
                    }
                }
            }
        }

        $this->_parameters->delete_all();
        $this->_parameters->add("msg", $msg);
        $cadenaUrl = $this->_parameters->KeyGen();
        //exit();
        $this->_url = $this->_path_config["ROOT"]["modules"] . "/webpage/views/clientes_admin.php?" . $cadenaUrl;
        $script = "<script>\n";
        $script .= "window.parent.location.href = '{$this->_url}';\n";
        $script .= "</script>\n";
        echo $script;
        exit();
    }

    protected function eliminar() {
        //**********************************************************************
        //recepcion de parametros
        //**********************************************************************
        $obj = new Modules_Webpage_Model_Clientes();
        $obj = $this->_parameters->set_object($obj);
        //**********************************************************************
        //**********************************************************************
        //creacion de objetos
        //**********************************************************************
        $Clientes = new Modules_Webpage_Model_Clientes();
        $ClientesFacade = new Modules_Webpage_Model_ClientesFacade();
        $Archivo = new Moon2_Files_FileManager();
        //**********************************************************************
        //**********************************************************************
        //muestra todo el registro del cliente deacuerdo a su codigo
        //**********************************************************************
        $Clientes->set_codcliente($obj->get_codcliente());
        $ClientesFacade->loadOne($Clientes);
        $imagenCodificada = $Clientes->get_imagencodificada();
        //**********************************************************************

        if ($ClientesFacade->delete($obj)) {
            $msg = 11;
            //******************************************************************
            //eliminar la imagen de la carpeta web_files
            //******************************************************************
            $rutaArchivo = $this->_path_config["IMAGES_CLIENTES"] . "/" . $imagenCodificada;
            $Archivo->deleteFile($rutaArchivo);
            //******************************************************************
        } else {
            $msg = 33;
        }

        $this->_parameters->delete_all();
        $this->_parameters->add("msg", $msg);
        $cadenaUrl = $this->_parameters->KeyGen();

        $this->_url = $this->_path_config["ROOT"]["modules"] . "/webpage/views/clientes_admin.php?" . $cadenaUrl;
        header("Location: {$this->_url}");
        exit();
    }

}

?>