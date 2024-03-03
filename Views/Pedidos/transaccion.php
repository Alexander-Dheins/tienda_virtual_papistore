<?php headerAdmin($data); ?>
<div id="divModal"></div>
<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-file-text-o"></i> <?= $data['page_title'] ?></h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item"><a href="<?= base_url(); ?>/pedidos"> Pedidos</a></li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="tile">
        <?php
          //dep($data['objTransaccion']);
          if(empty($data['objTransaccion'])){
        ?>
        <p>Datos no encontrados</p>
        <?php }else{

            $trs = $data['objTransaccion']->purchase_units[0];
            $cl = $data['objTransaccion']->payer;
            $idTransaccion = $trs->payments->captures[0]->id;
            $fecha = $trs->payments->captures[0]->create_time;
            $estado = $trs->payments->captures[0]->status;
            $monto = $trs->payments->captures[0]->amount->value;
            $moneda = $trs->payments->captures[0]->amount->currency_code;
            //Datos del cliente
            $nombreCliente = $cl->name->given_name.' '.$cl->name->surname;
            $emailCliente = $cl->email_address;
            $telCliente = isset($cl->phone) ? $cl->phone->phone_number->national_number : "";
            $codCiudad =  $cl->address->country_code;

            $direccion1 = $trs->shipping->address->address_line_1;
            $direccion2 = $trs->shipping->address->admin_area_2;
            $direccion3 = $trs->shipping->address->admin_area_1;
            $codPostal = $trs->shipping->address->postal_code;
            //Correo Comercio
            $emailComercio = $trs->payee->email_address;
            //Detalle
            $descripcion = $trs->description;
            $montoDetalle = $trs->amount->value; 
            //Detalle montos 
            $totalCompra =  $trs->payments->captures[0]->seller_receivable_breakdown->gross_amount->value;
            $comision =  $trs->payments->captures[0]->seller_receivable_breakdown->paypal_fee->value; 
            $importeNeto =  $trs->payments->captures[0]->seller_receivable_breakdown->net_amount->value;
            //Reembolso
            $reembolso = false;
            if(isset($trs->payments->refunds)){
                $reembolso = true;
                $importeBruto = $trs->payments->refunds[0]->seller_payable_breakdown->gross_amount->value;
                $comisionPaypal = $trs->payments->refunds[0]->seller_payable_breakdown->paypal_fee->value;
                $importeNeto = $trs->payments->refunds[0]->seller_payable_breakdown->net_amount->value;
                $fechaReembolso = $trs->payments->refunds[0]->update_time;
            }


         ?>
        <section id="sPedido" class="invoice">
          <div class="row mb-4">
            <div class="col-6">
              <h2 class="page-header"><img src="<?= media(); ?>/images/img-paypal.jpg" ></h2>
            </div>
            <?php if(!$reembolso){
                    if($_SESSION['permisosMod']['u'] and $_SESSION['userData']['idrol'] != RCLIENTES ){
             ?>
            <div class="col-6 text-right">
              <button class="btn btn-outline-primary" onclick="fntTransaccion('<?= $idTransaccion ?>');"><i class="fa fa-reply-all" aria-hidden="true"></i> Hacer Reembolso </button>
            </div>
            <?php   }
                 } ?>
          </div>
          <div class="row invoice-info">
            <div class="col-4">
              <address><strong>Transacción: <?= $idTransaccion; ?></strong><br><br>
                <strong>Fecha: <?= $fecha; ?></strong><br>
                <strong>Estado: <?= $estado; ?></strong><br>
                <strong>Importe bruto: <?= $monto; ?></strong><br>
                <strong>Moneda: <?= $moneda; ?></strong><br>
              </address>
            </div>
            <div class="col-4">
              <address><strong>Enviado por:</strong><br><br>
                <strong>Nombre:</strong> <?= $nombreCliente ?> <br>
                <strong>Teléfono:</strong> <?= $telCliente ?> <br>
                <strong>Dirección:</strong> <?= $direccion1 ?> <br>
                <?= $direccion2.', '.$direccion3.' '.$codPostal ?> <br>
                 <?= $codCiudad ?>
               </address>
            </div>
            <div class="col-4"><strong>Enviado a:</strong> <br><br>
                <strong>Email: </strong> <?= $emailComercio ?> <br>
            </div>
          </div>
          <div class="row">
            <div class="col-12 table-responsive">
            <?php if($reembolso){ ?>
              <table class="table table-sm">
                <thead class="thead-light">
                  <tr>
                    <th>Movimiento</th>
                    <th class="text-right">Importe bruto</th>
                    <th class="text-right">Comisión</th>
                    <th class="text-right">Importe neto</th>
                  </tr>
                </thead>
                <tbody>
                <?php if( $_SESSION['userData']['idrol'] == RCLIENTES ) { ?>
                  <tr>
                    <td><?= $fechaReembolso.' Reembolso para '.$nombreCliente ?></td>
                    <td class="text-right">- <?= $importeBruto.' '.$moneda ?></td>
                    <td class="text-right">0.00 </td>
                    <td class="text-right">- <?= $importeBruto.' '.$moneda ?></td>
                  </tr>
              <?php }else{ ?>
                  <tr>
                    <td><?= $fechaReembolso.' Reembolso para '.$nombreCliente ?></td>
                    <td class="text-right">- <?= $importeBruto.' '.$moneda ?></td>
                    <td class="text-right">- <?= $comisionPaypal.' '.$moneda ?> </td>
                    <td class="text-right">- <?= $importeNeto.' '.$moneda ?></td>
                  </tr>
                  <tr>
                    <td><?= $fechaReembolso ?> Cancelación de la comisión de PayPal</td>
                    <td class="text-right"><?= $comisionPaypal.' '.$moneda ?></td>
                    <td class="text-right">0.00 <?= $moneda ?></td>
                    <td class="text-right"><?= $comisionPaypal.' '.$moneda ?></td>
                  </tr>
                <?php } ?>
                </tbody>
              </table>
            <?php } ?>


              <table class="table table-sm">
                <thead class="thead-light">
                  <tr>
                    <th>Detalle pedido</th>
                    <th class="text-right">Cantidad</th>
                    <th class="text-right">Precio</th>
                    <th class="text-right">Subtotal</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><?= $descripcion ?></td>
                    <td class="text-right">1</td>
                    <td class="text-right"><?= $monto.' '.$moneda ?></td>
                    <td class="text-right"><?= $monto.' '.$moneda ?></td>
                  </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="3" class="text-right">Total de la compra:</th>
                        <td class="text-right"><?= $monto.' '.$moneda ?></td>
                    </tr>
                </tfoot>
              </table>
              <?php if( $_SESSION['userData']['idrol'] != RCLIENTES ){ ?>
              <table class="table table-sm">
                  <thead class="thead-light">
                      <tr>
                        <th colspan="2">Detalles del pago</th>
                      </tr>
                  </thead>
                  <tbody>
                       <tr>
                          <td width="250"><strong>Total de la compra</strong></td>
                          <td><?= $totalCompra.' '.$moneda ?></td>
                      </tr>
                      <tr>
                          <td><strong>Comisión de PayPal</strong></td>
                          <td>- <?= $comision.' '.$moneda ?></td>
                      </tr>
                      <tr>
                          <td><strong>Importe neto</strong></td>
                          <td><?= $importeNeto.' '.$moneda ?></td>
                      </tr>
                  </tbody>
              </table>
                <?php } ?>

            </div>
          </div>
          <div class="row d-print-none mt-2">
            <div class="col-12 text-right"><a class="btn btn-primary" href="javascript:window.print('#sPedido');" ><i class="fa fa-print"></i> Imprimir</a></div>
          </div>
        </section>
        <?php } ?>
      </div>
    </div>
  </div>
</main>
<?php footerAdmin($data); ?>