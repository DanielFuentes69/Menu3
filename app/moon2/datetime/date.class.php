<?php

class Moon2_DateTime_Date {

    public static function format($data, $typeString) {
        $type = (int) $typeString;
        $timestamp = strtotime($data);

        if (empty($data)) {
            $value = "";
            return $value;
        }

        switch ($type) {
            case 1:
                $value = date('d', $timestamp) . "-" . self::get_month($timestamp) . "-" . date('Y', $timestamp);
                break;
            case 2:
                $value = date('d', $timestamp) . "-" . date('m', $timestamp) . "-" . date('Y', $timestamp);
                break;
            case 3:
                $value = self::get_weekday_min($timestamp) . ", " . date('d', $timestamp) . " " . self::get_month_min($timestamp) . " " . date('Y', $timestamp);
                break;
            case 4:
                $value = self::get_weekday($timestamp) . ", " . date('d', $timestamp) . "-" . self::get_month_min($timestamp) . "-" . date('Y', $timestamp);
                break;
            case 5:
                $value = self::get_weekday($timestamp) . " " . date('d', $timestamp) . " de " . self::get_month($timestamp) . " del " . date('Y', $timestamp);
                break;
            case 6:
                $dias = array("Domingo", "Lunes", "Mártes", "Miercoles", "Jueves", "Viernes", "Sabado");
                $meses = array("", "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
                $value = " " . $dias[date("w")] . " " . date("d") . " de " . $meses[date("n")] . " de " . date("Y");
                break;
            case 7:
                $value = date('d', $timestamp) . "/" . date('m', $timestamp) . "/" . date('Y', $timestamp);
                break;
            case 8:
                //*********************************************************************************************
                //pasa la fecha de formato dia/mes/anno a anno/mes/dia sin importar el caracter de separacion
                //**********************************************************************************************
                $found = strpos($data, "/");
                if ($found == false) {
                    $valores = explode("-", $data);
                } else {
                    $valores = explode("/", $data);
                }
                $anno = $valores[2];
                $dia = $valores[0];
                $mes = $valores[1];
                $value = $anno . "/" . $mes . "/" . $dia;
                break;
            case 9:
                //*********************************************************************************************
                //pasa la fecha de formato anno/mes/dia a dia/mes/anno sin importar el caracter de separacion
                //*********************************************************************************************
                $found = strpos($data, "/");
                if ($found == false) {
                    $valores = explode("-", $data);
                } else {
                    $valores = explode("/", $data);
                }

                $anno = $valores[0];
                $mes = $valores[1];
                $dia = $valores[2];
                $value = $dia . "/" . $mes . "/" . $anno;
                break;
            case 10:
                $value = date('d', $timestamp) . "/" . date('m', $timestamp) . "/" . date('Y', $timestamp);
                break;
            case 11:
                //*********************************************************************************************
                //pasa la fecha de formato dia/mes/anno a anno/mes/dia sin importar el caracter de separacion
                //**********************************************************************************************
                $found = strpos($data, "/");
                if ($found == false) {
                    $valores = explode("-", $data);
                } else {
                    $valores = explode("/", $data);
                }
                $anno = $valores[2];
                $dia = $valores[0];
                $mes = $valores[1];
                $value = $anno . "-" . $mes . "-" . $dia;
                break;
        }
        return $value;
    }

    private static function get_weekday($timestamp) {
        switch (date('w', $timestamp)) {
            case 0: $day = "Domingo";
                break;
            case 1: $day = "Lunes";
                break;
            case 2: $day = "Martes";
                break;
            case 3: $day = "Miércoles";
                break;
            case 4: $day = "Jueves";
                break;
            case 5: $day = "Viernes";
                break;
            case 6: $day = "Sábado";
                break;
        }
        return $day;
    }

    private static function get_weekday_min($timestamp) {
        switch (date('w', $timestamp)) {
            case 0: $day = "Dom";
                break;
            case 1: $day = "Lun";
                break;
            case 2: $day = "Mar";
                break;
            case 3: $day = "Mié";
                break;
            case 4: $day = "Jue";
                break;
            case 5: $day = "Vie";
                break;
            case 6: $day = "Sáb";
                break;
        }
        return $day;
    }

    public static function get_month($timestamp) {
        switch (date('m', $timestamp)) {
            case "01": $day = "Enero";
                break;
            case "02": $day = "Febrero";
                break;
            case "03": $day = "Marzo";
                break;
            case "04": $day = "Abril";
                break;
            case "05": $day = "Mayo";
                break;
            case "06": $day = "Junio";
                break;
            case "07": $day = "Julio";
                break;
            case "08": $day = "Agosto";
                break;
            case "09": $day = "Septiembre";
                break;
            case "10": $day = "Octubre";
                break;
            case "11": $day = "Noviembre";
                break;
            case "12": $day = "Diciembre";
                break;
        }
        return $day;
    }

    private static function get_month_min($timestamp) {
        switch (date('m', $timestamp)) {
            case "01": $day = "Ene";
                break;
            case "02": $day = "Feb";
                break;
            case "03": $day = "Mar";
                break;
            case "04": $day = "Abr";
                break;
            case "05": $day = "May";
                break;
            case "06": $day = "Jun";
                break;
            case "07": $day = "Jul";
                break;
            case "08": $day = "Ago";
                break;
            case "09": $day = "Sep";
                break;
            case "10": $day = "Oct";
                break;
            case "11": $day = "Nov";
                break;
            case "12": $day = "Dic";
                break;
        }
        return $day;
    }

    public static function get_yearnum($timestamp) {
        $num_day = date("Y", $timestamp);
        return $num_day;
    }

}

//End class
?>