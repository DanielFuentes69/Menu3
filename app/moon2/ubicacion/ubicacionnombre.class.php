<?php

class Moon2_Ubicacion_Ubicacionnombre {

    public static function nombreUbicacion($codubicacion) {
        //**********************************************************************
        //creacion de objetos
        //**********************************************************************
        $UbicacionesFacade = new Modules_Krauff_Model_UbicacionesFacade();
        //**********************************************************************
        if ($codubicacion != "") {
            $nombre_ubicacion = $UbicacionesFacade->getNombreubicacion($codubicacion);
            return $nombre_ubicacion;
        }
    }

    public static function formatoUbicacion($codubicacion, $ubicacionhija, $type) {

        if (empty($codubicacion)) {
            $value = "Pendiente";
            return $value;
            exit();
        }
        //**********************************************************************
        //muestra el nombre de las ubicaciones
        //**********************************************************************
        $UbicacionesFacade = new Modules_Krauff_Model_UbicacionesFacade();
        $salida = "";
        $UbicacionesFacade->obtenerRutaubicacion($codubicacion, $salida);
        $nombre_ubicacion = $salida;
        //**********************************************************************

        switch ($type) {
            case 1:
                $array_ubicaciones = explode("-", $nombre_ubicacion);
                $value = strtoupper($ubicacionhija . " - " . $array_ubicaciones[1] . " - " . $array_ubicaciones[0]);
                break;
            case 2:
                $array_ubicaciones = explode("-", $nombre_ubicacion);
                $value = strtoupper($ubicacionhija . " - " . $array_ubicaciones[1]);
                break;
            case 3:
                $array_ubicaciones = explode("-", $nombre_ubicacion);
                $value = strtoupper($ubicacionhija . " - " . $array_ubicaciones[0]);
                break;
            case 4:
                $value = strtolower($ubicacionhija);
                break;
        }
        return $value;
    }

}

?>