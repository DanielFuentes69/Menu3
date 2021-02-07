$(document).ready(function () {
    $("#buscar").focus();
    $("#buscarm").focus();
});

function limpiarbusqueda() {
    $("#buscar").val("");
    $("#buscar").focus();
    $("#buscarm").val("");
    $("#buscarm").focus();
}
//******************************************************************************
//activa el usuario en el sistema
//******************************************************************************
$(function () {
    $('#VentanaFlotanteActivar').on('show.bs.modal', function (e) {
        var url = e.relatedTarget.name;
        var titulo = e.relatedTarget.title;
        var $this = $(this);
        $this.find('.edit-content').html(titulo);

        $("#VentanaFlotanteActivar button.btn-success").on("click", function (e) {
            deleteProcess(url);
            //$("#myModalDelete").modal('hide');
        });

    });
});
//******************************************************************************
//******************************************************************************
//VENTANA FLOTANTE PARA ASIGNAR EL TIPO DE CLIENTE
//******************************************************************************
$(document).ready(function () {
    $('#VentanaFlotanteTipoCliente').on('shown.bs.modal', function (e) {
        var url = e.relatedTarget.name;
        var src = $('#contenedorIframeTipoCliente').attr('data-iframe-src');
        src = src + "?" + url;
        $('#contenedorIframeTipoCliente').attr('src', src);
    });
    $('#VentanaFlotanteTipoCliente').on('hidden.bs.modal', function (e) {
        $('#contenedorIframeTipoCliente').attr('src', '');
    });
});
//******************************************************************************