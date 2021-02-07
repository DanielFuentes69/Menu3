<?php

class Modules_Krauff_Controllers_UsuariosController {

    private $_url;
    private $_parameters;
    private $_dom;
    private $_path_config;

    public function __construct($parameters, $dom, $path_config) {
        $action = $parameters->get_parameter("action", "");
        $rc = new ReflectionClass("Modules_Krauff_Controllers_UsuariosController");
        if ($rc->hasMethod($action)) {
            $this->_dom = $dom;
            $this->_parameters = $parameters;
            $this->_path_config = $path_config;
            $this->$action();
        } else {
            $this->stop();
        }
    }

    private function stop() {
        echo "Moon2 Message:<br/>Controller not implemented";
        header("Status: 400 Bad request", false, 400);
        exit();
    }

    public function getUrl() {
        return $this->_url;
    }

    private function login() {
        $Test = new Moon2_DBmanager_PDO(true);
        $error = $Test->get_msgError();
        if (empty($error)) {
            $nombreusuario = $this->_parameters->get_parameter("usu", "");
            $clave = $this->_parameters->get_parameter("cla", "");
            $Usuario = new Modules_Krauff_Model_UsuariosFacade();
            $informacion_usuario = $Usuario->validate($nombreusuario, $clave);

            if ($informacion_usuario === false) {
                $message = 11;
                $this->_url = $this->_path_config["QUIT"] . "/response.php?msg=" . $message;
                header("Location: {$this->_url}");
            } else {
                $information = explode("@@", $informacion_usuario);
                $cod_usuario = $information[0];
                $cod_perfil = $information[4];

                $Accesos = new Modules_Krauff_Model_Accesos();
                $Accesos->set_codusuario($cod_usuario);
                $Accesos->set_fechaingreso(date("Y/m/d"));
                $Accesos->set_horaingreso(date("H:i:s"));
                $Accesos->set_ipoculta($_SERVER["REMOTE_ADDR"]);
                $Accesos->set_ipvisible($_SERVER["REMOTE_ADDR"]);

                $AccesosFacade = new Modules_Krauff_Model_AccesosFacade();
                $AccesosFacade->add($Accesos);

                $vector_funcionalidades = $Usuario->get_functionalities($cod_usuario, $this->_dom["KRAUFF"]["INITIALVALUE"]);
                $cantidad = count($vector_funcionalidades);

                if ($cantidad == 0) {
                    $message = 13;
                    $this->_url = $this->_path_config["QUIT"] . "/response.php?msg=" . $message;
                    header("Location: {$this->_url}");
                } else {
                    session_start();
                    $page = "views/index.php";
                    $obj_funcionalidades = Moon2_ViewManager_Functionalities::get_Instance();
                    $obj_funcionalidades->set_funcArray($vector_funcionalidades);
                    $_SESSION[$this->_dom["SESION1"]] = $informacion_usuario;
                    $_SESSION[$this->_dom["SESION2"]] = md5($informacion_usuario);
                    $_SESSION[$this->_dom["SESION3"]] = serialize($obj_funcionalidades);
                    $this->_url = $this->_path_config["MAINPAGE"] . "/" . $page;
                    header("Location: {$this->_url}");
                }
            }
        } else {
            $message = utf8_encode(urlencode($error));
            $this->_url = $this->_path_config["QUIT"] . "/response.php?msg=" . $message;
            header("Location: {$this->_url}");
        }
    }

    private function crear() {
        //**********************************************************************
        //recepcion de parametros
        //**********************************************************************
        $obj = new Modules_Krauff_Model_Usuarios();
        $obj = $this->_parameters->set_object($obj);
        //**********************************************************************
        //**********************************************************************
        //creacion de objetos
        //**********************************************************************
        $FacadeUsuarios = new Modules_Krauff_Model_UsuariosFacade();
        //**********************************************************************
        $obj->set_fechacreacion(date("Y-m-d"));
        $obj->set_estado($this->_dom["ESTADOUSUARIO_TXT"]["ACTIVO"]);
        if ($FacadeUsuarios->add($obj)) {
            $msg = $this->_dom["FMESSAGE"]["success"];
            $cod_usuario = $FacadeUsuarios->ultimo_codusuario();
            $FacadeUsuarios->asignarfuncionalidades($cod_usuario);
        } else {
            $msg = $this->_dom["FMESSAGE"]["error"];
        }

        $this->_parameters->delete_all();
        $this->_parameters->add("msg", $msg);
        $this->_parameters->add("codusuario", $cod_usuario);
        $this->_parameters->add("p", "2");
        $cadenaUrl = $this->_parameters->KeyGen();
        //exit();
        $this->_url = $this->_path_config["ROOT"]["modules"] . "/krauff/views/usuarios_editar.php?" . $cadenaUrl;
        header("Location: {$this->_url}");
        exit();
    }

    private function editar() {
        $estado = $this->_parameters->get_parameter("estado", 0);
        $obj = new Modules_Krauff_Model_Usuarios();
        $FacadeUsuarios = new Modules_Krauff_Model_UsuariosFacade();
        $obj = $this->_parameters->set_object($obj);
        $cod_usuario = $obj->get_codusuario();

        if ($FacadeUsuarios->editar_usuario($obj->get_codperfil(), $obj->get_nombres(), $obj->get_primerapellido(), $obj->get_segundoapellido(), $obj->get_tipodoc(), $obj->get_documento(), $obj->get_genero(), $estado, $cod_usuario) == TRUE) {
            $msg = 15;
        } else {
            $msg = 37;
        }

        $this->_parameters->delete_all();
        $this->_parameters->add("msg", $msg);
        $this->_parameters->add("codusuario", $cod_usuario);
        $this->_parameters->add("p", "1");
        $cadenaUrl = $this->_parameters->KeyGen();
        //exit();
        $this->_url = $this->_path_config["ROOT"]["modules"] . "/krauff/views/usuarios_editar.php?" . $cadenaUrl;
        header("Location: {$this->_url}");
        exit();
    }

    private function eliminar() {
        $obj = new Modules_Krauff_Model_Usuarios();
        $obj = $this->_parameters->set_object($obj);

        $FacadeUsuarios = new Modules_Krauff_Model_UsuariosFacade();
        $msg = 33;
        if ($FacadeUsuarios->delete($obj)) {
            $msg = 11;
        }

        $this->_parameters->delete_all();
        $this->_parameters->add("msg", $msg);
        $cadenaUrl = $this->_parameters->KeyGen();
        //exit();
        $this->_url = $this->_path_config["ROOT"]["modules"] . "/krauff/views/usuarios_admin.php?" . $cadenaUrl;
        header("Location: {$this->_url}");
        exit();
    }

    private function buscar() {
        $combo_campos = $this->_parameters->get_parameter("nomcampos", "0");
        $caja_busqueda = $this->_parameters->get_parameter("buscar", "0");

        $this->_parameters->delete_all();
        $this->_parameters->add("nomcampos", $combo_campos);
        $this->_parameters->add("buscar", $caja_busqueda);
        $cadenaUrl = $this->_parameters->KeyGen();

        $this->_url = $this->_path_config["ROOT"]["modules"] . "/krauff/views/usuarios_admin.php?" . $cadenaUrl;
        header("Location: {$this->_url}");
        exit();
    }

    private function buscarM() {
        $combo_campos = $this->_parameters->get_parameter("nomcamposm", "0");
        $caja_busqueda = $this->_parameters->get_parameter("buscarm", "0");

        $this->_parameters->delete_all();
        $this->_parameters->add("nomcampos", $combo_campos);
        $this->_parameters->add("buscar", $caja_busqueda);
        $cadenaUrl = $this->_parameters->KeyGen();

        $this->_url = $this->_path_config["ROOT"]["modules"] . "/krauff/views/usuarios_admin.php?" . $cadenaUrl;
        header("Location: {$this->_url}");
        exit();
    }

    private function adjuntarImagen() {
        $msg = 33; //El primer Bit indica que es error, el segundo es el mensaje
        $archivo_procesar = $this->_parameters->get_parameter("FileInput", NULL);
        $tamanno_maximo = 1030000; //Un mega aproximadamente
        $Archivo = new Moon2_Files_FileManager();
        $Archivo->set_realName($archivo_procesar["name"]);
        $extension = strtolower($Archivo->get_extension());
        $tipos_permitidos = array("jpg", "png", "gif");
        $Archivo->set_folder($this->_path_config["IMAGES_PERFIL"]);
        if (!in_array($extension, $tipos_permitidos)) {
            $msg = 31;
        } else {
            $tamanno_archivo = (int) $archivo_procesar["size"];
            if ($tamanno_archivo > $tamanno_maximo || $tamanno_archivo === 0) {
                $msg = 34;
            } else {
                if ($Archivo->loadFile($archivo_procesar)) {
                    $cod_usuario = $this->_parameters->get_parameter("codusuario", "");
                    $imagen_codificada = $Archivo->get_hiddName();
                    $nombre_imagen = $Archivo->get_realName();
                    $mime = $Archivo->get_mimetype();
                    $tamaño_imagen = $Archivo->get_size();

                    $msg = 21; //El primer Bit indica warning, el segundo es el mensaje
                    $FacadeUsuarios = new Modules_Krauff_Model_UsuariosFacade();
                    if ($FacadeUsuarios->update_imagen($imagen_codificada, $nombre_imagen, $tamaño_imagen, $mime, $cod_usuario)) {
                        $msg = 13; //El primer bit indica que es success, el segundo es el mensaje
                    }
                }
            }
        }
        $this->_parameters->delete_all();
        $this->_parameters->add("msg", $msg);
        $this->_parameters->add("codusuario", $cod_usuario);
        $cadenaUrl = $this->_parameters->KeyGen();

        $this->_url = $this->_path_config["ROOT"]["modules"] . "/krauff/views/perfil_usuario.php?" . $cadenaUrl;
        header("Location: {$this->_url}");
    }

    private function asignar_clave() {
        $obj = new Modules_Krauff_Model_Usuarios();
        $obj = $this->_parameters->set_object($obj);
        $cod_usuario = $obj->get_codusuario();
        $view = $this->_parameters->get_parameter("view", 0);
        $FacadeUsuarios = new Modules_Krauff_Model_UsuariosFacade();

        //**********************************************************************
        //muestra todo el registro del usuario deacuerdo al codigo del mismo
        //**********************************************************************
        $Usuario = new Modules_Krauff_Model_Usuarios();
        $Usuario->set_codusuario($cod_usuario);
        $Usuario = $FacadeUsuarios->loadOne($Usuario);
        //**********************************************************************

        $clave_anterior = $Usuario->get_clave();
        $nombre_usuario = $obj->get_nombreusuario();
        $clave_sincifrar = $obj->get_clave();
        $clave_cifrada = md5($clave_sincifrar);

        if ($clave_sincifrar != $clave_anterior) {
            $resultado = $FacadeUsuarios->asignar_clave(strtolower($nombre_usuario), $clave_cifrada, $cod_usuario);
        } else {
            $resultado = $FacadeUsuarios->asignar_clave(strtolower($nombre_usuario), $clave_anterior, $cod_usuario);
        }

        if ($resultado == TRUE) {
            $msg = 12;
        } else {
            $msg = 34;
        }

        $pagina = "";
        if ($view == "admin") {
            $pagina = "/krauff/views/usuarios_editar.php?";
        } else {
            $pagina = "/krauff/views/editar_perfilusuario.php?";
        }

        $this->_parameters->delete_all();
        $this->_parameters->add("msg", $msg);
        $this->_parameters->add("codusuario", $cod_usuario);
        $this->_parameters->add("p", "4");
        $cadenaUrl = $this->_parameters->KeyGen();
        //exit();
        $this->_url = $this->_path_config["ROOT"]["modules"] . "{$pagina}" . $cadenaUrl;
        header("Location: {$this->_url}");
        exit();
    }

    private function asignar_ubicacion() {
        $obj = new Modules_Krauff_Model_Usuarios();
        $obj = $this->_parameters->set_object($obj);
        $cod_usuario = $obj->get_codusuario();
        $FacadeUsuarios = new Modules_Krauff_Model_UsuariosFacade();

        if ($FacadeUsuarios->asignar_ubicacion($obj->get_direccion(), $obj->get_telefono(), $obj->get_celular(), $obj->get_codubicacion(), $obj->get_correo(), $cod_usuario) == TRUE) {
            $msg = 14;
        } else {
            $msg = 36;
        }

        $this->_parameters->delete_all();
        $this->_parameters->add("msg", $msg);
        $this->_parameters->add("codusuario", $cod_usuario);
        $this->_parameters->add("p", "3");
        $cadenaUrl = $this->_parameters->KeyGen();
        //exit();
        $this->_url = $this->_path_config["ROOT"]["modules"] . "/krauff/views/usuarios_editar.php?" . $cadenaUrl;
        header("Location: {$this->_url}");
        exit();
    }

    private function adjuntarImagenUsuario() {
        $FacadeUsuarios = new Modules_Krauff_Model_UsuariosFacade();
        $cod_usuario = $this->_parameters->get_parameter("codusuario", "");

        //trae todo el registro completo del usuario dependiendo del codigo del usuario
        $Usuario = new Modules_Krauff_Model_Usuarios();
        $Usuario->set_codusuario($cod_usuario);
        $Usuario = $FacadeUsuarios->loadOne($Usuario);

        $nombre_completo_usuario = $Usuario->get_nombres() . $Usuario->get_primerapellido() . $Usuario->get_segundoapellido();
        $nombre_completo_usuario = str_replace(' ', '', $nombre_completo_usuario);

        //****************************************************************************
        //procesa la imagen y la deja lista para poder subirla al servidor
        //****************************************************************************
        $data = $this->_parameters->get_parameter("imagenAdjunta", NULL);
        $data = str_replace('data:image/png;base64,', '', $data);
        $data = str_replace(' ', '+', $data);
        $data = base64_decode($data);
        //****************************************************************************

        $im = imagecreatefromstring($data);
        if ($im !== false) {
            $nombre_aleatorio = uniqid(rand(), true) . str_replace(" ", "", microtime());
            $nombre_imagen_codificado = $nombre_aleatorio . ".png";
            $ruta_nombre = $this->_path_config["IMAGES_PERFIL"] . "/" . $nombre_imagen_codificado;
            imagepng($im, $ruta_nombre);

            //datos de la imagen
            $arreglo_info = getimagesize($ruta_nombre);
            $tamanno = filesize($ruta_nombre) / 1024;
            $mime = $arreglo_info["mime"];
        } else {
            $msg = 35;
        }

        if ($FacadeUsuarios->update_imagen($nombre_imagen_codificado, $nombre_completo_usuario . ".png", $tamanno, $mime, $cod_usuario)) {
            $msg = 13; //El primer bit indica que es success, el segundo es el mensaje
        }

        $this->_parameters->delete_all();
        $this->_parameters->add("msg", $msg);
        $this->_parameters->add("codusuario", $cod_usuario);
        $this->_parameters->add("p", "4");
        $cadenaUrl = $this->_parameters->KeyGen();

        $this->_url = $this->_path_config["ROOT"]["modules"] . "/krauff/views/usuarios_editar.php?" . $cadenaUrl;
        header("Location: {$this->_url}");
    }

    private function crearCuentaCliente() {
        //**********************************************************************
        //recepcion de parametros
        //**********************************************************************
        $obj = new Modules_Krauff_Model_Usuarios();
        $obj = $this->_parameters->set_object($obj);
        //**********************************************************************
        //**********************************************************************
        //creacion de objetos
        //**********************************************************************
        $FacadeUsuarios = new Modules_Krauff_Model_UsuariosFacade();
        //**********************************************************************
        //**********************************************************************
        //validamos si el documento existe
        //**********************************************************************
        $existeDocumento = $FacadeUsuarios->existeDocumento($obj->get_documento());
        //**********************************************************************
        //**********************************************************************
        //validamos si existe el email del cliente
        //**********************************************************************
        $existeEmail = $FacadeUsuarios->existeEmail($obj->get_correo());
        //**********************************************************************
        if ($existeDocumento > 0) {
            $msg = 388;
        } else if ($existeEmail > 0) {
            $msg = 323;
        } else {
            $obj->set_correo(strtolower($obj->get_correo()));
            $obj->set_fechacreacion(date("Y-m-d"));
            $obj->set_codperfil($this->_dom["PERFILES"]["CLIENTE"]);
            $obj->set_estado($this->_dom["ESTADOUSUARIO_TXT"]["INACTIVO"]);
            if ($FacadeUsuarios->add($obj)) {
                $msg = $this->_dom["FMESSAGE"]["success"];
            } else {
                $msg = $this->_dom["FMESSAGE"]["error"];
            }
        }

        $this->_parameters->delete_all();
        $this->_parameters->add("msg", $msg);
        $cadenaUrl = $this->_parameters->KeyGen();
        //exit();
        $this->_url = $this->_path_config["ROOT"]["modules"] . "/krauff/views/login.php?" . $cadenaUrl;
        $script = "<script>\n";
        $script .= "window.parent.location.href = '{$this->_url}';\n";
        $script .= "</script>\n";
        echo $script;
        exit();
    }

    private function activarUsuario() {
        //**********************************************************************
        //recepcion de parametros
        //**********************************************************************
        $codUsuario = $this->_parameters->get_parameter("codusuario", "");
        //**********************************************************************
        //**********************************************************************
        //creacion de objetos
        //**********************************************************************
        $Usuarios = new Modules_Krauff_Model_Usuarios();
        $UsuariosFacade = new Modules_Krauff_Model_UsuariosFacade();
        //**********************************************************************
        //**********************************************************************
        //muestra todo el registro del usuario deacuerdo a su codigo
        //**********************************************************************
        $Usuarios->set_codusuario($codUsuario);
        $Usuarios = $UsuariosFacade->loadOne($Usuarios);
        $email = $Usuarios->get_correo();
        $documento = $Usuarios->get_documento();
        //**********************************************************************

        if ($UsuariosFacade->asignar_clave($email, md5($documento), $codUsuario) == TRUE) {
            //******************************************************************
            //cambia el estado activo del usuario
            //******************************************************************
            $UsuariosFacade->updateEstado($this->_dom["ESTADOUSUARIO_TXT"]["ACTIVO"], $codUsuario);
            //******************************************************************
            //******************************************************************
            //asignamos funcionalidades de pedidos al usuario
            //******************************************************************
            $UsuariosFacade->funcionalidadesCliente($codUsuario);
            //******************************************************************
            //**********************************************************************
            //mensaje a enviar por email
            //**********************************************************************
            $textoMensaje = Modules_Krauff_Model_MensajeCorreo::infoemail($email, $documento, "Mertel Importaciones S.A.S", "Cra 15 # 19 - 31 Bucaramanga", "PBX +57 6719001");
            //**********************************************************************
            //**********************************************************************
            //envio del correo electronico
            //**********************************************************************
            $correoDestino = $email;
            $asuntoCorreo = "Usuario y Contraseña Intranet Mertel Importaciones";
            $objCorreo = new Moon2_Mail_Email("info@mertelimportaciones.com.co", $correoDestino, $asuntoCorreo, $textoMensaje, "", "info@mertelimportaciones.com.co");
            if (preg_match("/Win/i", $_SERVER["SERVER_SOFTWARE"])) {
                echo $textoMensaje;
                exit();
            } else {
                $objCorreo->sendMail();
            }
            //**********************************************************************
            $msg = 137;
        } else {
            $msg = 357;
        }

        $this->_parameters->delete_all();
        $this->_parameters->add("msg", $msg);
        $cadenaUrl = $this->_parameters->KeyGen();
        //exit();
        $this->_url = $this->_path_config["ROOT"]["modules"] . "/krauff/views/usuarios_admin.php?" . $cadenaUrl;
        header("Location: {$this->_url}");
        exit();
    }

    private function tipoCliente() {
        //**********************************************************************
        //recepcion de parametros
        //**********************************************************************
        $codUsuario = $this->_parameters->get_parameter("codusuario", "");
        $tipoCliente = $this->_parameters->get_parameter("tipousuario", "");
        //**********************************************************************
        //**********************************************************************
        //creacion de objetos
        //**********************************************************************
        $UsuariosFacade = new Modules_Krauff_Model_UsuariosFacade();
        //**********************************************************************
        if ($UsuariosFacade->asignarTipoCliente($tipoCliente, $codUsuario) == TRUE) {
            $msg = 140;
        } else {
            $msg = 340;
        }

        $this->_parameters->delete_all();
        $this->_parameters->add("msg", $msg);
        $cadenaUrl = $this->_parameters->KeyGen();
        //exit();
        $this->_url = $this->_path_config["ROOT"]["modules"] . "/krauff/views/usuarios_admin.php?" . $cadenaUrl;
        $script = "<script>\n";
        $script .= "window.parent.location.href = '{$this->_url}';\n";
        $script .= "</script>\n";
        echo $script;
        exit();
    }

}

//End class
?>