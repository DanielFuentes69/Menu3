jQuery(document).ready(function () {
    $("#usu").focus();
});

function sendData(frm) {
    var obj = $("#" + frm.id);
    if (moon2_process(obj)) {
        var pass = hex_md5($('#cla').val());
        $('#cla').val(pass);
        return true;
    }
    return false;
}

//******************************************************************************
//VENTANA FLOTANTE PARA REGISTRO DE CLIENTES
//******************************************************************************
$(document).ready(function () {
    $('#VentanaFlotanteRegistroCliente').on('shown.bs.modal', function (e) {
        var url = e.relatedTarget.name;
        var src = $('#contenedorIframeRegistroCliente').attr('data-iframe-src');
        src = src + "?" + url;
        $('#contenedorIframeRegistroCliente').attr('src', src);
    });
    $('#VentanaFlotanteRegistroCliente').on('hidden.bs.modal', function (e) {
        $('#contenedorIframeRegistroCliente').attr('src', '');
    });
});
//******************************************************************************