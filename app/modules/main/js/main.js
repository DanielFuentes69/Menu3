//******************************************************************************
//crea el pedido
//******************************************************************************
$(function () {
    $(document).on('click', 'a.iniciarPedido', function (e) {
        e.preventDefault();
        var $this = $(this);
        var obj = $("<form>");
        obj.attr("method", "GET");
        obj.attr("action", $this.attr('href'));
        moon2_process(obj);
    });
});
//******************************************************************************