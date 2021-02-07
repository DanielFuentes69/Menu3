$(document).ready(function () {
    $("#codperfil").focus();
});

function procesar_imagen(frm) {
    var $image = $(".image-crop > img");
    var obj = $("#" + frm.id);
    $("#imagenAdjunta").val($image.cropper("getDataURL"));
    if (moon2_process(obj)) {
        return true;
    }
    return false;
}
//******************************************************************************
//VENTANA FLOTANTE PARA LA ASIGNACION DE EMPRESAS A LOS USUARIOS
//******************************************************************************
$(document).ready(function () {
    $('#VentanaFlotanteAsignaremp').on('shown.bs.modal', function (e) {
        var url = e.relatedTarget.name;
        var src = $('#contenedorIframe').attr('data-iframe-src');
        src = src + "?" + url;
        $('#contenedorIframe').attr('src', src);
    });
    $('#VentanaFlotanteAsignaremp').on('hidden.bs.modal', function (e) {
        $('#contenedorIframe').attr('src', '');
    });
});
//******************************************************************************
//******************************************************************************
//VENTANA FLOTANTE PARA LAS UBICACIONES
//******************************************************************************
$(document).ready(function () {
    $('#VentanaFlotanteUbi').on('shown.bs.modal', function (e) {
        var url = e.relatedTarget.name;
        var src = $('#contenedorIframeUbi').attr('data-iframe-src');
        src = src + "?" + url;
        $('#contenedorIframeUbi').attr('src', src);
    });
    $('#VentanaFlotanteUbi').on('hidden.bs.modal', function (e) {
        $('#contenedorIframeUbi').attr('src', '');
    });
});
//******************************************************************************
//******************************************************************************
//llama e cierre de las ventanas modales
//******************************************************************************
window.closeModal = function () {
    $('#VentanaFlotanteUbi').modal('hide');
};
//******************************************************************************
//******************************************************************************
//foco caja nombre del usuario al seleccionar el perfil
//******************************************************************************
function focoCajanombres() {
    $('#nombres').focus();
}
//******************************************************************************
//******************************************************************************
//foco caja nombre del usuario al seleccionar el tipo de documento
//******************************************************************************
function focoCajadocumento() {
    $('#documento').focus();
}
//******************************************************************************