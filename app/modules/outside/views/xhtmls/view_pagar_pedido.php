<?php
if (!isset($id_security)) {
    echo "<h1>MOON2 Message:<br />Can not call view, requires the view controller</h1>";
    exit();
}
$identificador = uniqid();
?>

<!--************************************************************************************************************-->
<!--ESTA ES LA SECCION DEL HEADER -->
<!--************************************************************************************************************-->
<?php
require_once("view_header.php");
?>
<!--************************************************************************************************************-->
<!--************************************************************************************************************-->
<!--ESTA ES LA SECCION DEL MENU -->
<!--************************************************************************************************************-->
<?php
require_once("view_menu.php");
?>
<!--************************************************************************************************************-->
<!--Start breadcrumb area-->     
<section class="breadcrumb-area" style="background-image: url(../images/tienda.jpg);">
    <div class="container text-center">
        <h1>Compra en linea</h1>
    </div>
</section>
<!--End breadcrumb area-->

<!--Start breadcrumb bottom area-->       
<section class="breadcrumb-bottom-area">
    <div class="container">
        <div class="left pull-left">
            <a href="#">Centro de pago</a>    
        </div>
        <div class="right pull-right">
            <ul>
                <li><a href="index.php">Inicio</a></li>
                <li><i class="fa fa-angle-right" aria-hidden="true"></i></li>
                <li><a href="tienda.php">Tienda</a></li>
                <li><i class="fa fa-angle-right" aria-hidden="true"></i></li>
                <li>Pagar</li>
            </ul>    
        </div>        
    </div>    
</section>     
<!--End breadcrumb bottom area-->

<!--Start business logic-->
<section class="news-content section-padding shop-page">
    <div class="container">
        <div class="row" style="padding-top: 20px;">

            <div class="col-xs-12 col-md-9 col-lg-9" >
                <div class="panel panel-default height">
                    <div class="panel-heading"  style="background-color: #99ccff">Información del cliente</div>
                    <div class="panel-body">
                        <style>
                            .msgError {
                                color: #ff0000;
                                font-size: 10px;
                            }
                        </style>
                        <form id="frmDataCliente" name="frmDataCliente" method="post" action="moon2.php" onSubmit="javascript:return managedProccess(this);" class="form-horizontal">       
                            <input type="hidden" id="action" name="action" value="addOrder"/>
                            <input type="hidden" id="id" name="id" value="<?php echo $identificador; ?>"/>
                            <input type="hidden" id="SECURITY_ID" name="SECURITY_ID" value="tienda" />
                            <input type="hidden" id="controller" name="controller" value="outside/OutsideController" />
                            <div class="form-group row">
                                <label for="doc" class="col-sm-3 col-form-label">Documento</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control input-sm" name="doc" id="doc" minlength="2" maxlength="25" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="doc" class="col-sm-3 col-form-label">Nombre completo</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control input-sm" name="nom" id="nom" minlength="3" maxlength="60" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="cor" class="col-sm-3 col-form-label">Correo</label>
                                <div class="col-sm-9">
                                    <input type="email" class="form-control input-sm" name="cor" id="cor" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="dir" class="col-sm-3 col-form-label">Dirección envío</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control input-sm" name="dir" id="dir">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="dir" class="col-sm-3 col-form-label">Celular contacto</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control input-sm" name="cel" id="cel">
                                </div>
                            </div>
                            <div class="text-right">
                                <button type="submit" id="btnCliente" class="btn btn-success">Registrar información cliente</button>
                            </div>
                        </form>
                        <script type="text/javascript">
                            $(function () {
                                $("#doc").focus();

                                $("#frmDataCliente").validate({
                                    errorElement: 'span',
                                    errorClass: 'msgError',
                                    rules: {
                                        doc: "required",
                                        nom: "required",
                                        cor: "required",
                                        dir: "required",
                                        cel: "required"
                                    },
                                    messages: {
                                        doc: "Documento de identificación requerido",
                                        nom: "Se requiere el nombre completo del cliente",
                                        cor: "Correo electrónico requerido",
                                        dir: "Dirección de envío requerida",
                                        cel: "Número de contacto del cliente"
                                    },
                                    submitHandler: function (form) {
                                        addClient();
                                        return false;
                                    }
                                });
                            });
                        </script>
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-md-3 col-lg-3">
                <div class="panel panel-default height">
                    <div class="panel-heading">Forma de pago</div>
                    <div class="panel-body">
                        <strong>Sistema de pago:</strong> Payú<br />
                        <strong>Sistema seguridad:</strong> 512 bits<br />
                        <strong>Fecha:</strong> <?php echo date("d-m-Y"); ?><br />
                        <strong>Hora:</strong> <?php echo Moon2_DateTime_Time::format(date("H:i:s"), 12); ?><br /><br />
                        <strong>Ayuda:</strong> 317-5200585<br />
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
                                        <td class="text-right" style="width: 20%;"><strong>Precio</strong></td>
                                        <td class="text-right" style="width: 20%;"><strong>Subtotal</strong></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $cantArt = 0;
                                    $totalCompra = 0;
                                    $totalImpuesto = 0;
                                    $cookieName = "agroShoppingCart";
                                    if (!isset($_COOKIE[$cookieName]) || $_COOKIE[$cookieName] === "[]") {
                                        $totalCompraF = "$0";
                                        echo "<tr id=\"trVacio\">\n";
                                        echo "<td style=\"width: 100%;\">Carrito vacío</td>\n";
                                        echo "</tr>\n";
                                    } else {
                                        $arrCarrito = json_decode($_COOKIE[$cookieName], true);
                                        foreach ($arrCarrito as $indice => $campo) {
                                            $totalCompra = $totalCompra + $campo["valorsf"];
                                            $precioUnitario = $campo["precio"];
                                            $valorPantalla = $campo["valor"];
                                            $totalImpuesto = $totalImpuesto + ($campo["valoriva"] * $campo["cant"]);

                                            echo "<tr id=\"tr{$campo["cod"]}\">\n";
                                            echo "<td style=\"color: #000;\"><small>{$campo["nom"]}</small></td>\n";
                                            echo "<td class=\"text-center\" style=\"color: #000;\"><small>{$campo["cant"]}</small></td>\n";
                                            echo "<td class=\"text-right\" style=\"color: #000;\"><small>$ {$precioUnitario}</small></td>\n";
                                            echo "<td class=\"text-right\" style=\"color: #000;\">$ {$valorPantalla}</td>\n";
                                            echo "</tr>\n";
                                        }
                                        $cantArt = count($arrCarrito);
                                        $totalCompraF = "$" . number_format($totalCompra, 0);
                                        $totalImpuestoF = "$" . number_format($totalImpuesto, 2);
                                        echo "<script>$(\"#cantArt\").html({$cantArt});</script>\n";
                                        echo "<script>$(\"#valArtUp\").html(\"{$totalCompraF}\");</script>\n";
                                    }
                                    ?>
                                    <tr>
                                        <td class="highrow"></td>
                                        <td class="highrow"></td>
                                        <td class="highrow text-center"><strong>Subtotal</strong></td>
                                        <td class="highrow text-right"><?php echo $totalCompraF; ?></td>
                                    </tr>
                                    <tr>
                                        <td class="highrow"></td>
                                        <td class="highrow"></td>
                                        <td class="highrow text-center"><strong>Impuesto</strong></td>
                                        <td class="highrow text-right"><?php echo $totalImpuestoF; ?></td>
                                    </tr>
                                    <tr>
                                        <td class="emptyrow"></td>
                                        <td class="emptyrow"></td>
                                        <td class="emptyrow text-center"><strong>Total</strong></td>
                                        <td class="emptyrow text-right"><?php echo $totalCompraF; ?></td>
                                    </tr>
                                    <tr>
                                        <td class="emptyrow">
                                            &nbsp;
                                        </td>
                                        <td class="emptyrow" colspan="2">
                                            <img src="../images/pagar.png" />
                                        </td>
                                        <td>
                                            <?php
                                            $merchantId = "892936";
                                            $taxReturnBase = $totalCompra - $totalImpuesto;
                                            $apiKey = "Kc1K1I3We6RHryDN2RyddQx0Nm";
                                            $signature = md5("{$apiKey}~{$merchantId}~{$identificador}~{$totalCompra}~COP");
                                            ?>
                                            <form method="post" action="https://checkout.payulatam.com/ppp-web-gateway-payu/">
                                                <input name="merchantId"    type="hidden"  value="<?php echo $merchantId; ?>"   >
                                                <input name="accountId"     type="hidden"  value="899482" >
                                                <input name="description"   type="hidden"  value="Agrocenter SaS"  >
                                                <input name="referenceCode" type="hidden"  value="<?php echo $identificador; ?>" >
                                                <input name="amount"        type="hidden"  value="<?php echo $totalCompra; ?>"   >
                                                <input name="tax"           type="hidden"  value="<?php echo $totalImpuesto; ?>"  >
                                                <input name="taxReturnBase" type="hidden"  value="<?php echo $taxReturnBase; ?>" >
                                                <input name="currency"      type="hidden"  value="COP" >
                                                <input name="signature"     type="hidden"  value="<?php echo $signature; ?>"  >
                                                <input name="buyerEmail" id="buyerEmail" type="hidden"  value="" >
                                                <input name="responseUrl"   type="hidden"  value="https://www.agrocentersas.com" >
                                                <input name="confirmationUrl" type="hidden"  value="https://www.agrocentersas.com/intranet/app/modules/outside/views/confirmacion.php" >
                                                <button disabled id="btnPagar" class="btn btn-primary" name="Submit" type="submit">
                                                    <img src="../images/pagarPayu.png" />
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
//Datos reales de la cuenta
//API KEY
//Kc1K1I3We6RHryDN2RyddQx0Nm
//
//API LOGIN
//7KgDJ8uhLxomEfs
//
//Llave pública
//PKfBVn6V1Wb07E0Ut6QgJ39OvI
//echo md5("4Vj8eK4rloUd272L48hsrarnUA~508029~TestPayU~8000~COP");
//echo md5("Kc1K1I3We6RHryDN2RyddQx0Nm~892936~TestPayU~25000~COP");
//ejemplo firmamerchantId: 508029
//ApiKey: 4Vj8eK4rloUd272L48hsrarnUA
//referenceCode: TestPayU
//amount: 8000
//currency: COP
//accountId: 512326
//buyerEmail: test@test.com
//La firma sería:
//"4Vj8eK4rloUd272L48hsrarnUA~508029~TestPayU~8000~COP"
//require_once("../../../moon2/sdkpagos/lib/PayU.php");
//$response = PayUReports::doPing();
//$response->code;
//
//echo "<pre>";
//print_r($response);
//echo "</pre>";
?>
<!--End business logic-->

<!--************************************************************************************************************-->
<!--ESTA ES LA SECCION DEL FOOTER -->
<!--************************************************************************************************************-->
<?php
require_once("view_footer.php");
?>
<!--************************************************************************************************************-->
<script>

</script>