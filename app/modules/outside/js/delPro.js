function delPro(code) {
    var row = $("#tr" + code);
    var url = "../../../moon2/process/processform.php";
    var parametros = {
        idp: code,
        SECURITY_ID: "tienda",
        action: 'delShoppingCart',
        controller: 'outside/OutsideController'
    };
    $.ajax({
        url: url,
        data: parametros,
        type: "POST",
        dataType: "json"
    })
            .done(function (data) {
                row.remove();
                if (data.vacio === "OK") {
                    $("#shopTbody")
                            .append('<tr id="trVacio">\n\
                            <td colspan=\"4\">Carrito vacío</td>\n\
                            </tr>');
                }
                $("#valArtUp").html(data.total);
                $("#valArtDown").html(data.total);
                $("#cantArt").html(data.cantTotal);
            })

            .fail(function (msg) {
                alert("Error:" + msg);
            });
}