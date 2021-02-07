$(document).ready(function () {
    $("#buscar").focus();
});

function limpiarbusqueda() {
    $("#buscar").val("");
    $("#buscar").focus();
}
//****************************************************************************** 
//VENTANA FLOTANTE CREAR
//******************************************************************************
$(document).ready(function () {
    $('#VentanaFlotanteCrear').on('shown.bs.modal', function (e) {
        var src = $('#contenedorIframe').attr('data-iframe-src');
        $('#contenedorIframe').attr('src', src);
    });

    $('#VentanaFlotanteCrear').on('hidden.bs.modal', function (e) {
        $('#contenedorIframe').attr('src', '');
    });
});
//******************************************************************************
//******************************************************************************
//VENTANA FLOTANTE EDITAR
//******************************************************************************
$(document).ready(function () {
    $('#VentanaFlotanteEditar').on('shown.bs.modal', function (e) {
        var url = e.relatedTarget.name;
        var src = $('#contenedorIframeeditar').attr('data-iframe-src');
        src = src + "?" + url;
        $('#contenedorIframeeditar').attr('src', src);
    });
    $('#VentanaFlotanteEditar').on('hidden.bs.modal', function (e) {
        $('#contenedorIframeeditar').attr('src', '');
    });
});
//******************************************************************************