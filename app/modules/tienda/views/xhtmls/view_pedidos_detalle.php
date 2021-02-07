<?php
if (!isset($DOM["SECURITY_ID"])) {
    echo "<h1>MOON2 Message:<br />Can not call view, requires the view controller</h1>";
    exit();
}
?>
<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <div class="row" style="padding-top: 20px;">
                        <div class="col-xs-12 col-md-9 col-lg-9" >
                            <div class="panel panel-default height">
                                <div class="panel-heading"  style="background-color: #99ccff">Información del cliente</div>
                                <div class="panel-body">
                                    <div class="form-group row">
                                        <label for="doc" class="col-sm-3 col-form-label">Documento</label>
                                        <div class="col-sm-9">
                                            <?php echo $objPedido->get_documento(); ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="doc" class="col-sm-3 col-form-label">Nombre completo</label>
                                        <div class="col-sm-9">
                                            <?php echo $objPedido->get_nombrecliente(); ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="cor" class="col-sm-3 col-form-label">Correo</label>
                                        <div class="col-sm-9">
                                            <?php echo $objPedido->get_correo(); ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="dir" class="col-sm-3 col-form-label">Dirección envío</label>
                                        <div class="col-sm-9">
                                            <?php echo $objPedido->get_direccion(); ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="dir" class="col-sm-3 col-form-label">Celular contacto</label>
                                        <div class="col-sm-9">
                                            <?php echo $objPedido->get_celular(); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-md-3 col-lg-3">
                            <div class="panel panel-default height">
                                <div class="panel-heading">Forma de pago</div>
                                <div class="panel-body">
                                    <strong>Sistema de pago:</strong> Payú<br />
                                    <strong>Sistema seguridad:</strong> 512 bits<br />
                                    <strong>Fecha:</strong> <?php echo Moon2_DateTime_Date::format($objPedido->get_fecha(), 1); ?><br />
                                    <strong>Hora:</strong> <?php echo Moon2_DateTime_Time::format($objPedido->get_hora(), 12); ?><br /><br />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading" style="background-color: #99ccff">
                                    Resumen del pedido
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-condensed">
                                            <thead>
                                                <tr>
                                                    <td style="width: 40%;"><strong>Producto</strong></td>
                                                    <td class="text-center" style="width: 10%;"><strong>Cantidad</strong></td>
                                                    <td class="text-right" style="width: 10%;"><strong>Iva unidad</strong></td>
                                                    <td class="text-right" style="width: 20%;"><strong>Precio unidad</strong></td>
                                                    <td class="text-right" style="width: 20%;"><strong>Subtotal</strong></td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $totalCompra = 0;
                                                $totalImpuesto = 0;
                                                foreach ($registros as $indice => $campo) {
                                                    $ivaMostrar = number_format($campo["impuesto"], 2);
                                                    $totalCompra = $totalCompra + $campo["totalparcial"];
                                                    $precioUnitario = number_format($campo["valor"], 0);
                                                    $valorPantalla = number_format($campo["totalparcial"], 0);
                                                    $totalImpuesto = $totalImpuesto + ($campo["impuesto"] * $campo["cantidad"]);
                                                    $referencia = $campo["referencia"];
                                                    $mostrarProducto = $campo["nombreproducto"] . " / " . $referencia;

                                                    echo "<tr id=\"tr{$campo["coddetallepedido"]}\">\n";
                                                    echo "<td style=\"color: #000;\"><small>{$mostrarProducto}</small></td>\n";
                                                    echo "<td class=\"text-center\" style=\"color: #000;\"><small>{$campo["cantidad"]}</small></td>\n";
                                                    echo "<td class=\"text-right\" style=\"color: #000;\"><small>$ {$ivaMostrar}</small></td>\n";
                                                    echo "<td class=\"text-right\" style=\"color: #000;\"><small>$ {$precioUnitario}</small></td>\n";
                                                    echo "<td class=\"text-right\" style=\"color: #000;\">$ {$valorPantalla}</td>\n";
                                                    echo "</tr>\n";
                                                }
                                                $totalCompraF = "$" . number_format($totalCompra, 0);
                                                $totalImpuestoF = "$" . number_format($totalImpuesto, 2);
                                                ?>
                                                <tr>
                                                    <td class="highrow"></td><td class="highrow"></td><td class="highrow"></td>
                                                    <td class="highrow text-center"><strong>Subtotal</strong></td>
                                                    <td class="highrow text-right"><?php echo $totalCompraF; ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="highrow"></td><td class="highrow"></td><td class="highrow"></td>
                                                    <td class="highrow text-center"><strong>Impuesto</strong></td>
                                                    <td class="highrow text-right"><?php echo $totalImpuestoF; ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="highrow"></td><td class="highrow"></td><td class="highrow"></td>
                                                    <td class="emptyrow text-center"><strong>Total</strong></td>
                                                    <td class="emptyrow text-right"><?php echo $totalCompraF; ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
