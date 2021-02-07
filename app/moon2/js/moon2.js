$(document).ready(function () {

});
function trim(myString) {
    return myString.replace(/^\s+/g, "").replace(/\s+$/g, "");
}

function managedProccess(frm) {
    var obj = $("#" + frm.id);
    if (moon2_process(obj)) {
        return true;
    }
    return false;
}

//******************************************************************************
//Flotante eliminar - Inicio
//******************************************************************************
$(function () {
    $('#myModalDelete').on('show.bs.modal', function (e) {
        var url = e.relatedTarget.name;
        var titulo = e.relatedTarget.title;
        var $this = $(this);
        $this.find('.edit-content').html(titulo);

        $("#myModalDelete button.btn-success").on("click", function (e) {
            deleteProcess(url);
            //$("#myModalDelete").modal('hide');
        });

    });
});
//******************************************************************************

function deleteProcess(url) {
    var obj = $("<form>");
    obj.attr("method", "GET");
    obj.attr("action", url);
    moon2_process(obj);
}

//******************************************************************************
//Moon2 model for processing forms and hyperlinks start
//******************************************************************************
function moon2_process(obj) {
    var path = "";
    var method = obj.attr("method");
    method = method.toLowerCase();
    switch (method) {
        case "post":
            path = javaPath + "/process/processform.php";
            obj.attr("action", path);
            return true;
            break;
        case "get":
            var parameters = obj.attr("action");
            var newpath = javaPath + "/process/processurl.php?";
            location.href = newpath + parameters;
            break;
        case "ajax":
            path = javaPath + "/process/processform.php";
            return path;
            break;
        default:
            alert("There is no Method defined");
    }
    return false;
}
//*****************************************************************************
//Moon2 model for processing forms and hyperlinks end


//pagination start
//*****************************************************************************

//*****************************************************************************
//pagination end

//Begin: Show float message
//******************************************************************************
function mensajeFlotante(tipo, titulo, mensaje) {
    var $showDuration = 400;
    var $hideDuration = 1000;
    var $timeOut = 7000;
    var $extendedTimeOut = 1000;
    var $showEasing = "swing";
    var $hideEasing = "linear";
    var $showMethod = "fadeIn";
    var $hideMethod = "fadeOut";
    toastr.options = {
        closeButton: 'checked',
        progressBar: 'checked',
        positionClass: 'toast-bottom-right',
        onclick: null
    };

    toastr[tipo](mensaje, titulo);
}
//******************************************************************************
//End: Show float message

//Begin: Temporal para verificar propiedades
//******************************************************************************
function mostrarPropiedades(objeto, nombreObjeto) {
    var resultado = "";
    for (var i in objeto) {
        if (objeto.hasOwnProperty(i)) {
            resultado += nombreObjeto + "." + i + " = " + objeto[i] + "\n";
        }
    }
    return resultado;
}
//******************************************************************************

//Begin: Formato de número
//******************************************************************************
function formato_numero(numero, decimales, separador_decimal, separador_miles) {
    numero = parseFloat(numero);
    if (isNaN(numero)) {
        return "";
    }

    if (decimales !== undefined) {
        numero = numero.toFixed(decimales);
    }

    // Convertimos el punto en separador_decimal
    numero = numero.toString().replace(".", separador_decimal !== undefined ? separador_decimal : ",");

    if (separador_miles) {
        // Añadimos los separadores de miles
        var miles = new RegExp("(-?[0-9]+)([0-9]{3})");
        while (miles.test(numero)) {
            numero = numero.replace(miles, "$1" + separador_miles + "$2");
        }
    }

    return numero;
}
//******************************************************************************

//******************************************************************************
//convierte la hora a formato 12 horas
//******************************************************************************
function timeFormat12h(time)
{   // Take a time in 24 hour format and format it in 12 hour format
    var time_part_array = time.split(":");
    var ampm = 'AM';

    if (time_part_array[0] >= 12) {
        ampm = 'PM';
    }

    if (time_part_array[0] > 12) {
        time_part_array[0] = time_part_array[0] - 12;
    }

    //formatted_time = time_part_array[0] + ':' + time_part_array[1] + ':' + time_part_array[2] + ' ' + ampm;
    formatted_time = time_part_array[0] + ':' + time_part_array[1] + ' ' + ampm;

    return formatted_time;
}
//******************************************************************************

//******************************************************************************
//mascara para las cajas de dinero
//******************************************************************************
function mascara(o, f) {
    v_obj = o;
    v_fun = f;
    setTimeout("execmascara()", 1);
}
function execmascara() {
    v_obj.value = v_fun(v_obj.value);
}
function cpf(v) {
    v = v.replace(/([^0-9\.]+)/g, '');
    v = v.replace(/^[\.]/, '');
    v = v.replace(/[\.][\.]/g, '');
    v = v.replace(/\.(\d)(\d)(\d)/g, '.$1$2');
    v = v.replace(/\.(\d{1,2})\./g, '.$1');
    v = v.toString().split('').reverse().join('').replace(/(\d{3})/g, '$1,');
    v = v.split('').reverse().join('').replace(/^[\,]/, '');
    return v;
}
//******************************************************************************