<?php

class Modules_Webpage_Controllers_TeamController extends Moon2_Controllers_Manager {

    public function __construct($parameters, $dom, $path_config) {
        parent::__construct($parameters, $dom, $path_config);
    }

    protected function crear() {
        //**********************************************************************
        //creacion de objetos
        //**********************************************************************
        $Archivo = new Moon2_Files_FileManager();
        $Team = new Modules_Webpage_Model_Team();
        $TeamFacade = new Modules_Webpage_Model_TeamFacade();
        //**********************************************************************
        //**********************************************************************
        //recepcion de parametros
        //**********************************************************************
        $msg = 338;
        $archivoProcesar = $this->_parameters->get_parameter("imagenteam", "0");
        $nombre = $this->_parameters->get_parameter("nombre", "");
        $cargo = $this->_parameters->get_parameter("cargo", "");
        $facebook = $this->_parameters->get_parameter("facebook", "");
        $twitter = $this->_parameters->get_parameter("twitter", "");
        $instagram = $this->_parameters->get_parameter("instagram", "");
        $youtube = $this->_parameters->get_parameter("youtube", "");
        $linkedin = $this->_parameters->get_parameter("linkedin", "No Tiene");
        $tamanno_maximo = 900000000;
        $Archivo->set_realName($archivoProcesar["name"]);
        $extension = strtolower($Archivo->get_extension());
        $tipos_permitidos = array("jpg");
        //**********************************************************************

        $Archivo->set_folder($this->_path_config["IMAGES_TEAM"]);
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
                    $resolucionImagen = getimagesize($this->_path_config["IMAGES_TEAM"] . "/" . $Archivo->get_hiddName());
                    $anchoImagen = $resolucionImagen[0];
                    $altoImagen = $resolucionImagen[1];
                    //**********************************************************************

                    if ($anchoImagen == 170 && $altoImagen == 170) {
                        $Team->set_codusuario($this->_dom["USER_ID"]);
                        $Team->set_nombre($nombre);
                        $Team->set_cargo($cargo);
                        $Team->set_facebook($facebook);
                        $Team->set_twitter($twitter);
                        $Team->set_instagram($instagram);
                        $Team->set_youtube($youtube);
                        $Team->set_linkedin($linkedin);
                        $Team->set_imagencodificada($Archivo->get_hiddName());
                        $Team->set_mime($Archivo->get_mimetype());
                        $Team->set_tamanno($Archivo->get_size());
                        $Team->set_nombreimagen($Archivo->get_realName());
                        $Team->set_fecha(date("Y-m-d"));
                        $Team->set_hora(date("H:i:s"));

                        $msg = 21;
                        if ($TeamFacade->add($Team)) {
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
        $this->_url = $this->_path_config["ROOT"]["modules"] . "/webpage/views/equipotrabajo_admin.php?" . $cadenaUrl;
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
        $obj = new Modules_Webpage_Model_Team();
        $obj = $this->_parameters->set_object($obj);
        //**********************************************************************
        //**********************************************************************
        //creacion de objetos
        //**********************************************************************
        $Team = new Modules_Webpage_Model_Team();
        $TeamFacade = new Modules_Webpage_Model_TeamFacade();
        $Archivo = new Moon2_Files_FileManager();
        //**********************************************************************
        //**********************************************************************
        //muestra todo el registro del team deacuerdo a su codigo
        //**********************************************************************
        $Team->set_codteam($obj->get_codteam());
        $Team = $TeamFacade->loadOne($Team);
        $imagenCodificada = $Team->get_imagencodificada();
        //**********************************************************************

        if ($TeamFacade->delete($obj)) {
            $msg = 11;
            //******************************************************************
            //eliminar la imagen de la carpeta web_files
            //******************************************************************
            $rutaArchivo = $this->_path_config["IMAGES_TEAM"] . "/" . $imagenCodificada;
            $Archivo->deleteFile($rutaArchivo);
            //******************************************************************
        } else {
            $msg = 33;
        }

        $this->_parameters->delete_all();
        $this->_parameters->add("msg", $msg);
        $cadenaUrl = $this->_parameters->KeyGen();

        $this->_url = $this->_path_config["ROOT"]["modules"] . "/webpage/views/equipotrabajo_admin.php?" . $cadenaUrl;
        header("Location: {$this->_url}");
        exit();
    }

    protected function editar() {
        //**********************************************************************
        //creacion de objetos
        //**********************************************************************
        $Archivo = new Moon2_Files_FileManager();
        $Team = new Modules_Webpage_Model_Team();
        $TeamFacade = new Modules_Webpage_Model_TeamFacade();
        //**********************************************************************
        //**********************************************************************
        //recepcion de parametros
        //**********************************************************************
        $msg = 338;
        $archivoProcesar = $this->_parameters->get_parameter("imagenteam", "0");
        $nombre = $this->_parameters->get_parameter("nombre", "");
        $cargo = $this->_parameters->get_parameter("cargo", "");
        $facebook = $this->_parameters->get_parameter("facebook", "");
        $twitter = $this->_parameters->get_parameter("twitter", "");
        $instagram = $this->_parameters->get_parameter("instagram", "");
        $youtube = $this->_parameters->get_parameter("youtube", "");
        $linkedin = $this->_parameters->get_parameter("linkedin", "");
        $tamanno_maximo = 2060000;
        $Archivo->set_realName($archivoProcesar["name"]);
        $extension = strtolower($Archivo->get_extension());
        $tipos_permitidos = array("gif", "png", "jpg");
        $codTeam = $this->_parameters->get_parameter("codteam", "0");
        //**********************************************************************
        //**********************************************************************
        //muestra todo el registro del team deacuerdo a su codigo
        //**********************************************************************
        $Team->set_codteam($codTeam);
        $Team = $TeamFacade->loadOne($Team);
        $imagenCodificadaActual = $Team->get_imagencodificada();
        //**********************************************************************

        $Archivo->set_folder($this->_path_config["IMAGES_TEAM"]);
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
                    $resolucionImagen = getimagesize($this->_path_config["IMAGES_TEAM"] . "/" . $Archivo->get_hiddName());
                    $anchoImagen = $resolucionImagen[0];
                    $altoImagen = $resolucionImagen[1];
                    //**********************************************************************
                    if ($anchoImagen == 170 && $altoImagen == 170) {
                        $Team->set_codusuario($this->_dom["USER_ID"]);
                        $Team->set_nombre($nombre);
                        $Team->set_cargo($cargo);
                        $Team->set_facebook($facebook);
                        $Team->set_twitter($twitter);
                        $Team->set_instagram($instagram);
                        $Team->set_youtube($youtube);
                        $Team->set_linkedin($linkedin);
                        $Team->set_imagencodificada($Archivo->get_hiddName());
                        $Team->set_mime($Archivo->get_mimetype());
                        $Team->set_tamanno($Archivo->get_size());
                        $Team->set_nombreimagen($Archivo->get_realName());
                        $Team->set_fecha(date("Y-m-d"));
                        $Team->set_hora(date("H:i:s"));

                        if ($TeamFacade->update($Team)) {
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
                    $Team->set_codusuario($this->_dom["USER_ID"]);
                    $Team->set_nombre($nombre);
                    $Team->set_cargo($cargo);
                    $Team->set_facebook($facebook);
                    $Team->set_twitter($twitter);
                    $Team->set_instagram($instagram);
                    $Team->set_youtube($youtube);
                    $Team->set_linkedin($linkedin);
                    $Team->set_imagencodificada($Team->get_imagencodificada());
                    $Team->set_mime($Team->get_mime());
                    $Team->set_tamanno($Team->get_tamanno());
                    $Team->set_nombreimagen($Team->get_nombreimagen());
                    $Team->set_fecha($Team->get_fecha());
                    $Team->set_hora($Team->get_hora());

                    if ($TeamFacade->update($Team)) {
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
        $this->_url = $this->_path_config["ROOT"]["modules"] . "/webpage/views/equipotrabajo_admin.php?" . $cadenaUrl;
        $script = "<script>\n";
        $script .= "window.parent.location.href = '{$this->_url}';\n";
        $script .= "</script>\n";
        echo $script;
        exit();
    }

}

?>