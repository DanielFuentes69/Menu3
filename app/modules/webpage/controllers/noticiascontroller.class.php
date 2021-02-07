<?php

class Modules_Webpage_Controllers_NoticiasController extends Moon2_Controllers_Manager {

    public function __construct($parameters, $dom, $path_config) {
        parent::__construct($parameters, $dom, $path_config);
    }

    protected function crear() {
        //**********************************************************************
        //creacion de objetos
        //**********************************************************************
        $Archivo = new Moon2_Files_FileManager();
        $Noticias = new Modules_Webpage_Model_Noticias();
        $NoticiasFacade = new Modules_Webpage_Model_NoticiasFacade();
        //**********************************************************************
        //**********************************************************************
        //recepcion de parametros
        //**********************************************************************
        $msg = 338;
        $archivoProcesar = $this->_parameters->get_parameter("imgnoticias", "0");
        $titulo = $this->_parameters->get_parameter("titulo", "");
        $descripcion = $this->_parameters->get_parameter("descripcion", "0");
        $tipo = $this->_parameters->get_parameter("tipo", "0");
        $tamanno_maximo = 900000000;
        $Archivo->set_realName($archivoProcesar["name"]);
        $extension = strtolower($Archivo->get_extension());
        $tipos_permitidos = array("gif", "png", "jpg");
        //**********************************************************************

        $Archivo->set_folder($this->_path_config["IMAGES_NOTICIAS"]);
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
                    $resolucionImagen = getimagesize($this->_path_config["IMAGES_NOTICIAS"] . "/" . $Archivo->get_hiddName());
                    $anchoImagen = $resolucionImagen[0];
                    $altoImagen = $resolucionImagen[1];
                    //**********************************************************************

                    if ($anchoImagen == 830 && $altoImagen == 476) {
                        $Noticias->set_codusuario($this->_dom["USER_ID"]);
                        $Noticias->set_titulo($titulo);
                        $Noticias->set_descripcion($descripcion);
                        $Noticias->set_imagencodificada($Archivo->get_hiddName());
                        $Noticias->set_mime($Archivo->get_mimetype());
                        $Noticias->set_tamanno($Archivo->get_size());
                        $Noticias->set_nombreimagen($Archivo->get_realName());
                        $Noticias->set_fecha(date("Y-m-d"));
                        $Noticias->set_hora(date("H:i:s"));
                        $Noticias->set_tipo($tipo);
                        $Noticias->set_cantmegusta(0);

                        $msg = 21;
                        if ($NoticiasFacade->add($Noticias)) {
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
        $this->_url = $this->_path_config["ROOT"]["modules"] . "/webpage/views/noticias_admin.php?" . $cadenaUrl;
        header("Location: {$this->_url}");
        exit();
    }

    protected function eliminar() {
        //**********************************************************************
        //recepcion de parametros
        //**********************************************************************
        $obj = new Modules_Webpage_Model_Noticias();
        $obj = $this->_parameters->set_object($obj);
        //**********************************************************************
        //**********************************************************************
        //creacion de objetos
        //**********************************************************************
        $Noticias = new Modules_Webpage_Model_Noticias();
        $NoticiasFacade = new Modules_Webpage_Model_NoticiasFacade();
        $Archivo = new Moon2_Files_FileManager();
        //**********************************************************************
        //**********************************************************************
        //muestra todo el registro del team deacuerdo a su codigo
        //**********************************************************************
        $Noticias->set_codnoticia($obj->get_codnoticia());
        $NoticiasFacade->loadOne($Noticias);
        $imagenCodificada = $Noticias->get_imagencodificada();
        //**********************************************************************

        if ($NoticiasFacade->delete($obj)) {
            $msg = 11;
            //******************************************************************
            //eliminar la imagen de la carpeta web_files
            //******************************************************************
            $rutaArchivo = $this->_path_config["IMAGES_NOTICIAS"] . "/" . $imagenCodificada;
            $Archivo->deleteFile($rutaArchivo);
            //******************************************************************
        } else {
            $msg = 33;
        }

        $this->_parameters->delete_all();
        $this->_parameters->add("msg", $msg);
        $cadenaUrl = $this->_parameters->KeyGen();

        $this->_url = $this->_path_config["ROOT"]["modules"] . "/webpage/views/noticias_admin.php?" . $cadenaUrl;
        header("Location: {$this->_url}");
        exit();
    }

    protected function editar() {
        //**********************************************************************
        //creacion de objetos
        //**********************************************************************
        $Archivo = new Moon2_Files_FileManager();
        $Noticias = new Modules_Webpage_Model_Noticias();
        $NoticiasFacade = new Modules_Webpage_Model_NoticiasFacade();
        //**********************************************************************
        //**********************************************************************
        //recepcion de parametros
        //**********************************************************************
        $msg = 338;
        $archivoProcesar = $this->_parameters->get_parameter("imgnoticias", "0");
        $titulo = $this->_parameters->get_parameter("titulo", "");
        $descripcion = $this->_parameters->get_parameter("descripcion", "");
        $tipo = $this->_parameters->get_parameter("tipo", "0");
        $tamanno_maximo = 2060000;
        $Archivo->set_realName($archivoProcesar["name"]);
        $extension = strtolower($Archivo->get_extension());
        $tipos_permitidos = array("gif", "png", "jpg");
        $codNoticia = $this->_parameters->get_parameter("codnoticia", "0");
        //**********************************************************************
        //**********************************************************************
        //muestra todo el registro del team deacuerdo a su codigo
        //**********************************************************************
        $Noticias->set_codnoticia($codNoticia);
        $NoticiasFacade->loadOne($Noticias);
        $imagenCodificadaActual = $Noticias->get_imagencodificada();
        //**********************************************************************

        $Archivo->set_folder($this->_path_config["IMAGES_NOTICIAS"]);
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
                    $resolucionImagen = getimagesize($this->_path_config["IMAGES_NOTICIAS"] . "/" . $Archivo->get_hiddName());
                    $anchoImagen = $resolucionImagen[0];
                    $altoImagen = $resolucionImagen[1];
                    //**********************************************************************
                    if ($anchoImagen == 830 && $altoImagen == 476) {
                        $Noticias->set_codusuario($this->_dom["USER_ID"]);
                        $Noticias->set_titulo($titulo);
                        $Noticias->set_descripcion($descripcion);
                        $Noticias->set_imagencodificada($Archivo->get_hiddName());
                        $Noticias->set_mime($Archivo->get_mimetype());
                        $Noticias->set_tamanno($Archivo->get_size());
                        $Noticias->set_nombreimagen($Archivo->get_realName());
                        $Noticias->set_fecha(date("Y-m-d"));
                        $Noticias->set_hora(date("H:i:s"));
                        $Noticias->set_tipo($tipo);
                        $Noticias->set_cantmegusta(0);

                        if ($NoticiasFacade->update($Noticias)) {
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
                    $Noticias->set_codusuario($this->_dom["USER_ID"]);
                    $Noticias->set_titulo($titulo);
                    $Noticias->set_descripcion($descripcion);
                    $Noticias->set_imagencodificada($Noticias->get_imagencodificada());
                    $Noticias->set_mime($Noticias->get_mime());
                    $Noticias->set_tamanno($Noticias->get_tamanno());
                    $Noticias->set_nombreimagen($Noticias->get_nombreimagen());
                    $Noticias->set_fecha($Noticias->get_fecha());
                    $Noticias->set_hora($Noticias->get_hora());
                    $Noticias->set_tipo($tipo);
                    $Noticias->set_cantmegusta(0);

                    if ($NoticiasFacade->update($Noticias)) {
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
        $this->_url = $this->_path_config["ROOT"]["modules"] . "/webpage/views/noticias_admin.php?" . $cadenaUrl;
        header("Location: {$this->_url}");
        exit();
    }

    protected function addMeGusta() {
        //**********************************************************************
        //recepcion de parametros
        //**********************************************************************
        $codNoticia = $this->_parameters->get_parameter("codnoticia", 0);
        $retorno = $this->_parameters->get_parameter("retorno", "blog");
        //**********************************************************************
        //**********************************************************************
        //creacion de objetos
        //**********************************************************************
        $Noticias = new Modules_Webpage_Model_Noticias();
        $NoticiasFacade = new Modules_Webpage_Model_NoticiasFacade();
        //**********************************************************************
        //**********************************************************************
        //muestra todo el registro actual de la noticia
        //**********************************************************************
        $Noticias->set_codnoticia($codNoticia);
        $NoticiasFacade->loadOne($Noticias);
        $cantidadActualMeGusta = (int) $Noticias->get_cantmegusta();
        $cantidaFinal = $cantidadActualMeGusta + 1;
        //**********************************************************************
        //**********************************************************************
        //actualizamos el campo cantmegusta
        //**********************************************************************
        if ($NoticiasFacade->updateMeGusta($cantidaFinal, $codNoticia) == TRUE) {
            $msg = 111;
        } else {
            $msg = 333;
        }
        //**********************************************************************

        if ($retorno == "vernoti") {
            $pagina = "/outside/views/ver_noticia.php?";
        } else {
            $pagina = "/outside/views/blog.php?";
        }

        $this->_parameters->delete_all();
        $this->_parameters->add("msg", $msg);
        $this->_parameters->add("codnoticia", $codNoticia);
        $cadenaUrl = $this->_parameters->KeyGen();
        //exit();
        $this->_url = $this->_path_config["ROOT"]["modules"] . $pagina . $cadenaUrl;
        header("Location: {$this->_url}");
        exit();
    }

}

?>