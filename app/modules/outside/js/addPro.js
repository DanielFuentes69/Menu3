function addPro(code) {
    $("#trVacio").remove();
    var cant = 1;
    var url = "../../../moon2/process/processform.php";

    var parametros = {
        idp: code,
        can: cant,
        SECURITY_ID: "tienda",
        action: 'addShoppingCart',
        controller: 'outside/OutsideController'
    };
    $.ajax({
        url: url,
        data: parametros,
        type: "POST",
        dataType: "json"
    })
            .done(function (data) {
                if (data.exist === true) {
                    $("#tr" + data.cod)
                            .replaceWith('<tr id="tr' + data.cod + '">\n\
                        <td style="color: #000; width: 15%;"><small>' + data.cant + '</small></td>\n\
                        <td style="color: #000; width: 55%;"><small>' + data.nom + '</small></td>\n\
                        <td style="color: #000; width: 20%;"><small>' + data.valor + '</small></td>\n\
                        <td style="width: 10%;"><a onclick="javascript:delPro(\'' + data.cod + '\');"><i class="fa fa-trash" style="color: #e57d20; font-size: 15px;"></i></a></td>\n\
                        </tr>');
                } else {
                    $("#shopTbody")
                            .append('<tr id="tr' + data.cod + '">\n\
                        <td style="color: #000; width: 15%;"><small>' + data.cant + '</small></td>\n\
                        <td style="color: #000; width: 55%;"><small>' + data.nom + '</small></td>\n\
                        <td class=\"text-right\" style="color: #000; width: 20%;"><small>' + data.valor + '</small></td>\n\
                        <td style="width: 10%;"><a onclick="javascript:delPro(\'' + data.cod + '\');"><i class="fa fa-trash" style="color: #e57d20; font-size: 15px; cursor: pointer;" ></i></a></td>\n\
                        </tr>');
                }
                $("#valArtUp").html(data.total);
                $("#valArtDown").html(data.total);
                $("#cantArt").html(data.cantTotal);
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
                toastr.info('El producto fue agregado correctamente al carrito de compras', 'Operación Exitosa:');
            })

            .fail(function (msg) {
                alert("Error:" + msg);
            });
}