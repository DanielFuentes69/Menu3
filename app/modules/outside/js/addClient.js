function addClient() {
    var url = "../../../moon2/process/processform.php";
    var parametros = $("#frmDataCliente").serialize();

    $.ajax({
        url: url,
        data: parametros,
        type: "POST",
        dataType: "json"
    })
            .done(function (data) {
                if (data.RESULT === "OK") {
                    $("#btnCliente").attr("disabled", true);
                    $("#btnCliente").html("Paso 1 terminado: Puede continuar con el proceso de pago");
                    $("#btnPagar").attr("disabled", false);
                    $("#buyerEmail").val($("#cor").val());

                    var $showDuration = 400;
                    var $hideDuration = 1000;
                    var $timeOut = 7000;
                    var $extendedTimeOut = 1000;
                    var $extendedTimeOut = 1000;
                    var $showEasing = "swing";
                    var $hideEasing = "linear";
                    var $showMethod = "fadeIn";
                    var $hideMethod = "fadeOut";
                    toastr.options = {
                        closeButton: 'checked',
                        progressBar: 'false',
                        positionClass: 'toast-bottom-center',
                        onclick: null
                    };
                    toastr.info('La información del envío fue registrada correctamente', 'Datos cliente registrados:');
                } else {
                    alert("Error al registrar el cliente");
                }

            })
            .fail(function (msg) {
                alert("Error:" + msg);
            });
}