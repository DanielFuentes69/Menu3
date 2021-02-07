<?php

class Modules_Webpage_Controllers_PromocionesController extends Moon2_Controllers_Manager {

    public function __construct($parameters, $dom, $path_config) {
        parent::__construct($parameters, $dom, $path_config);
    }

    protected function crear() {
        //**********************************************************************
        //creacion de objetos
        //**********************************************************************
        $Archivo = new Moon2_Files_FileManager();
        $Promociones = new Modules_Webpage_Model_Promociones();
        $PromocionesFacade = new Modules_Webpage_Model_PromocionesFacade();
        //**********************************************************************
        //**********************************************************************
        //recepcion de parametros
        //**********************************************************************
        $msg = 338;
        $archivoProcesar = $this->_parameters->get_parameter("imgpromo", "0");
        $titulo = $this->_parameters->get_parameter("titulo", "");
        $nombreProducto = $this->_parameters->get_parameter("nombreproducto", "");
        $porcentaje = $this->_parameters->get_parameter("porcentaje", "");
        $fechaFin = $this->_parameters->get_parameter("fechafin", "");
        $descripcion = $this->_parameters->get_parameter("descripcion", "");
        $tamanno_maximo = 900000000;
        $Archivo->set_realName($archivoProcesar["name"]);
        $extension = strtolower($Archivo->get_extension());
        $tipos_permitidos = array("gif", "png", "jpg");
        //**********************************************************************

        $Archivo->set_folder($this->_path_config["IMAGES_PROMOCIONES"]);
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
                    $resolucionImagen = getimagesize($this->_path_config["IMAGES_PROMOCIONES"] . "/" . $Archivo->get_hiddName());
                    $anchoImagen = $resolucionImagen[0];
                    $altoImagen = $resolucionImagen[1];
                    //**********************************************************************

                    if ($anchoImagen == 1170 && $altoImagen == 500) {
                        $Promociones->set_codusuario($this->_dom["USER_ID"]);
                        $Promociones->set_titulo($titulo);
                        $Promociones->set_nombreproducto($nombreProducto);
                        $Promociones->set_descripcion($descripcion);
                        $Promociones->set_porcentaje($porcentaje);
                        $Promociones->set_fechafin(Moon2_DateTime_Date::format($fechaFin, 8));
                        $Promociones->set_imagencodificada($Archivo->get_hiddName());
                        $Promociones->set_mime($Archivo->get_mimetype());
                        $Promociones->set_tamanno($Archivo->get_size());
                        $Promociones->set_nombreimagen($Archivo->get_realName());
                        $Promociones->set_fecha(date("Y-m-d"));
                        $Promociones->set_hora(date("H:i:s"));

                        $msg = 21;
                        if ($PromocionesFacade->add($Promociones)) {
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
        $this->_url = $this->_path_config["ROOT"]["modules"] . "/webpage/views/promociones_admin.php?" . $cadenaUrl;
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
        $obj = new Modules_Webpage_Model_Promociones();
        $obj = $this->_parameters->set_object($obj);
        //**********************************************************************
        //**********************************************************************
        //creacion de objetos
        //**********************************************************************
        $Promociones = new Modules_Webpage_Model_Promociones();
        $PromocionesFacade = new Modules_Webpage_Model_PromocionesFacade();
        $Archivo = new Moon2_Files_FileManager();
        //**********************************************************************
        //**********************************************************************
        //muestra todo el registro del team deacuerdo a su codigo
        //**********************************************************************
        $Promociones->set_codpromocion($obj->get_codpromocion());
        $Promociones = $PromocionesFacade->loadOne($Promociones);
        $imagenCodificada = $Promociones->get_imagencodificada();
        //**********************************************************************

        if ($PromocionesFacade->delete($obj)) {
            $msg = 11;
            //******************************************************************
            //eliminar la imagen de la carpeta web_files
            //******************************************************************
            $rutaArchivo = $this->_path_config["IMAGES_PROMOCIONES"] . "/" . $imagenCodificada;
            $Archivo->deleteFile($rutaArchivo);
            //******************************************************************
        } else {
            $msg = 33;
        }

        $this->_parameters->delete_all();
        $this->_parameters->add("msg", $msg);
        $cadenaUrl = $this->_parameters->KeyGen();

        $this->_url = $this->_path_config["ROOT"]["modules"] . "/webpage/views/promociones_admin.php?" . $cadenaUrl;
        header("Location: {$this->_url}");
        exit();
    }

    protected function editar() {
        //**********************************************************************
        //creacion de objetos
        //**********************************************************************
        $Archivo = new Moon2_Files_FileManager();
        $Promociones = new Modules_Webpage_Model_Promociones();
        $PromocionesFacade = new Modules_Webpage_Model_PromocionesFacade();
        //**********************************************************************
        //**********************************************************************
        //recepcion de parametros
        //**********************************************************************
        $msg = 338;
        $archivoProcesar = $this->_parameters->get_parameter("imgpromo", "0");
        $titulo = $this->_parameters->get_parameter("titulo", "");
        $nombreProducto = $this->_parameters->get_parameter("nombreproducto", "");
        $porcentaje = $this->_parameters->get_parameter("porcentaje", "");
        $fechaFin = $this->_parameters->get_parameter("fechafin", "");
        $descripcion = $this->_parameters->get_parameter("descripcion", "");
        $tamanno_maximo = 2060000;
        $Archivo->set_realName($archivoProcesar["name"]);
        $extension = strtolower($Archivo->get_extension());
        $tipos_permitidos = array("gif", "png", "jpg");
        $codPromocion = $this->_parameters->get_parameter("codpromocion", "0");
        //**********************************************************************
        //**********************************************************************
        //muestra todo el registro del team deacuerdo a su codigo
        //**********************************************************************
        $Promociones->set_codpromocion($codPromocion);
        $Promociones = $PromocionesFacade->loadOne($Promociones);
        $imagenCodificadaActual = $Promociones->get_imagencodificada();
        //**********************************************************************

        $Archivo->set_folder($this->_path_config["IMAGES_PROMOCIONES"]);
        if (!in_array($extension, $tipos_permitidos) && $archivoProcesar["error"] != 4) {
            $msg = 31;
        } else {
            $tamanno_archivo = (int) $archivoProcesar["size"];
            if ($tamanno_archivo > $tamanno_maximo && $archivoProcesar["error"] != 4) {
                $msg = 345;
            } else {
                if ($Archivo->loadFile($archivoProcesar) && $archivoProcesar["error"] != 4) {
                    //**********************************************************************
                    //validamos la resolucion de la imagen
                    //**********************************************************************
                    $resolucionImagen = getimagesize($this->_path_config["IMAGES_PROMOCIONES"] . "/" . $Archivo->get_hiddName());
                    $anchoImagen = $resolucionImagen[0];
                    $altoImagen = $resolucionImagen[1];
                    //**********************************************************************
                    if ($anchoImagen == 1170 && $altoImagen == 500) {
                        $Promociones->set_codusuario($this->_dom["USER_ID"]);
                        $Promociones->set_titulo($titulo);
                        $Promociones->set_nombreproducto($nombreProducto);
                        $Promociones->set_descripcion($descripcion);
                        $Promociones->set_porcentaje($porcentaje);
                        $Promociones->set_fechafin(Moon2_DateTime_Date::format($fechaFin, 8));
                        $Promociones->set_imagencodificada($Archivo->get_hiddName());
                        $Promociones->set_mime($Archivo->get_mimetype());
                        $Promociones->set_tamanno($Archivo->get_size());
                        $Promociones->set_nombreimagen($Archivo->get_realName());
                        $Promociones->set_fecha(date("Y-m-d"));
                        $Promociones->set_hora(date("H:i:s"));

                        if ($PromocionesFacade->update($Promociones)) {
                            $msg = 13;
                            //******************************************************************
                            //eliminar la imagen de la carpeta web_files
                            //******************************************************************
                            $rutaArchivo = "/" . $imagenCodificadaActual;
                            $Archivo->deleteFile($rutaArchivo);
                            //******************************************************************
                        } else {
                            $msg = 21;
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
                } else {
                    $Promociones->set_codusuario($this->_dom["USER_ID"]);
                    $Promociones->set_titulo($titulo);
                    $Promociones->set_nombreproducto($nombreProducto);
                    $Promociones->set_descripcion($descripcion);
                    $Promociones->set_porcentaje($porcentaje);
                    $Promociones->set_fechafin(Moon2_DateTime_Date::format($fechaFin, 8));
                    $Promociones->set_imagencodificada($Promociones->get_imagencodificada());
                    $Promociones->set_mime($Promociones->get_mime());
                    $Promociones->set_tamanno($Promociones->get_tamanno());
                    $Promociones->set_nombreimagen($Promociones->get_nombreimagen());
                    $Promociones->set_fecha($Promociones->get_fecha());
                    $Promociones->set_hora($Promociones->get_hora());

                    if ($PromocionesFacade->update($Promociones)) {
                        $msg = 111;
                    } else {
                        $msg = 333;
                    }
                }
            }
        }

        $this->_parameters->delete_all();
        $this->_parameters->add("msg", $msg);
        $cadenaUrl = $this->_parameters->KeyGen();
        //exit();
        $this->_url = $this->_path_config["ROOT"]["modules"] . "/webpage/views/promociones_admin.php?" . $cadenaUrl;
        $script = "<script>\n";
        $script .= "window.parent.location.href = '{$this->_url}';\n";
        $script .= "</script>\n";
        echo $script;
        exit();
    }

}

?>