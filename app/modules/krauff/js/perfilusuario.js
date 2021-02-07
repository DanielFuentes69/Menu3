$(document).ready(function(){
$("#FileInput").change(function () {
    $("#Up").click();
    $("#default").hide();
});
});

function consultaproducto(rutaimagen){
    var obj = $("<form>");
    obj.attr("method", "ajax");
    pagina = moon2_process(obj);

    var parametros = {
            "codproducto" : codproducto,
            "action" : 'buscarproducto',
            "controller": 'Pos/ProductosController'
    };
    $.ajax({
            data:  parametros,
            url:   pagina,
            type:  'post',
            beforeSend: function () {
                    //$("#resultado").html("Procesando...");
            },
            success:  function (response) {
                var valores = response.split("@");
                    $('#subtotal').val(valores[0]);
                    $('#iva').val(valores[1]);
                    var arreglo = JSON.parse(valores[2]);
                    $('#descuento').val(valores[3]);
                    $("#subtotal").empty();
                    $.each(arreglo,function(i,item){
                        $("#subtotal").append("<option value='"+item+"'>"+item+"</option>")
                    });
            },
            error: function(response) {
                console.log("Error en el proceso de actualizacion" + response);
            }
    });
}