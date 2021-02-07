<?php

class Modules_Webpage_Controllers_SliderController extends Moon2_Controllers_Manager {

    public function __construct($parameters, $dom, $path_config) {
        parent::__construct($parameters, $dom, $path_config);
    }

    protected function subirImagen() {
        //**********************************************************************
        //creacion de objetos
        //**********************************************************************
        $Archivo = new Moon2_Files_FileManager();
        $Slider = new Modules_Webpage_Model_Slider();
        $SliderFacade = new Modules_Webpage_Model_SliderFacade();
        //**********************************************************************
        //**********************************************************************
        //recepcion de parametros
        //**********************************************************************
        $msg = 338;
        $archivoProcesar = $this->_parameters->get_parameter("imagenslider", "0");
        $titulo1 = $this->_parameters->get_parameter("titulo1", "");
        $titulo2 = $this->_parameters->get_parameter("titulo2", "");
        $textoBoton = $this->_parameters->get_parameter("textoboton", "");
        $urlBoton = $this->_parameters->get_parameter("urlboton", "");
        $descripcion = $this->_parameters->get_parameter("descripcion", "No Tiene");
        $colorTexto = $this->_parameters->get_parameter("colortexto", "Sin Color");
        $active = $this->_parameters->get_parameter("active", 1);
        $tamanno_maximo = 900000000;
        $Archivo->set_realName($archivoProcesar["name"]);
        $extension = strtolower($Archivo->get_extension());
        $tipos_permitidos = array("jpg");
        //**********************************************************************
        //**********************************************************************
        //valida si ya existe una imagen principal
        //**********************************************************************
        $validaPrincipal = $SliderFacade->validaImagenPrincipal();
        if ($validaPrincipal > 0) {
            $active = $this->_dom["ACTIVETXT"]["NO"];
        }
        //**********************************************************************

        $Archivo->set_folder($this->_path_config["IMAGES_SLIDERMAIN"]);
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
                    $resolucionImagen = getimagesize($this->_path_config["IMAGES_SLIDERMAIN"] . "/" . $Archivo->get_hiddName());
                    $anchoImagen = $resolucionImagen[0];
                    $altoImagen = $resolucionImagen[1];
                    //**********************************************************************

                    if ($anchoImagen == 1920 && $altoImagen == 582) {
                        $Slider->set_codusuario($this->_dom["USER_ID"]);
                        $Slider->set_imagencodificada($Archivo->get_hiddName());
                        $Slider->set_mime($Archivo->get_mimetype());
                        $Slider->set_tamanno($Archivo->get_size());
                        $Slider->set_nombreimagen($Archivo->get_realName());
                        $Slider->set_fecha(date("Y-m-d"));
                        $Slider->set_hora(date("H:i:s"));
                        $Slider->set_titulo1($titulo1);
                        $Slider->set_titulo2($titulo2);
                        $Slider->set_textoboton($textoBoton);
                        $Slider->set_urlboton($urlBoton);
                        $Slider->set_descripcion($descripcion);
                        $Slider->set_colortexto($colorTexto);
                        $Slider->set_active($active);

                        $msg = 21;
                        if ($SliderFacade->add($Slider)) {
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
        $this->_url = $this->_path_config["ROOT"]["modules"] . "/webpage/views/slider_admin.php?" . $cadenaUrl;
        $script = "<script>\n";
        $script .= "window.parent.location.href = '{$this->_url}';\n";
        $script .= "</script>\n";
        echo $script;
        exit();
    }

    protected function eliminarImagen() {
        //**********************************************************************
        //recepcion de parametros
        //**********************************************************************
        $obj = new Modules_Webpage_Model_Slider();
        $obj = $this->_parameters->set_object($obj);
        $codSlider = $this->_parameters->get_parameter("codslider", "0");
        //**********************************************************************
        //**********************************************************************
        //creacion de objetos
        //**********************************************************************
        $Slider = new Modules_Webpage_Model_Slider();
        $SliderFacade = new Modules_Webpage_Model_SliderFacade();
        $Archivo = new Moon2_Files_FileManager();
        //**********************************************************************
        //**********************************************************************
        //muestra todo el registro del slider deacuerdo a su codigo
        //**********************************************************************
        $Slider->set_codslider($obj->get_codslider());
        $Slider = $SliderFacade->loadOne($Slider);
        $imagenCodificada = $Slider->get_imagencodificada();
        //**********************************************************************

        if ($SliderFacade->delete($obj)) {
            $msg = 11;
            //******************************************************************
            //eliminar la imagen de la carpeta web_files
            //******************************************************************
            $rutaArchivo = $this->_path_config["IMAGES_SLIDERMAIN"] . "/" . $imagenCodificada;
            $Archivo->deleteFile($rutaArchivo);
            //******************************************************************
            //******************************************************************
            //establece como principal otra imagen del slider
            //******************************************************************
            $codSliderNuevo = $SliderFacade->getMinCodslider();
            //******************************************************************
            //******************************************************************
            //actualiza el active a principal
            //******************************************************************
            $SliderFacade->updateActiveSlider($this->_dom["ACTIVETXT"]["SI"], $codSliderNuevo);
            //******************************************************************
        } else {
            $msg = 33;
        }

        $this->_parameters->delete_all();
        $this->_parameters->add("msg", $msg);
        $cadenaUrl = $this->_parameters->KeyGen();

        $this->_url = $this->_path_config["ROOT"]["modules"] . "/webpage/views/slider_admin.php?" . $cadenaUrl;
        header("Location: {$this->_url}");
        exit();
    }

}

?>