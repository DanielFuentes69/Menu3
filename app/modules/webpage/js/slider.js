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