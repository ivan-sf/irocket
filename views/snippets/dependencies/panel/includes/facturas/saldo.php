
<div id="page-wrapper" style="min-height: 601px;">
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Facturacion</h4>
            </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="#">Facturas</a></li>
                    <li class="active">Detalles</li>
                </ol>
            </div>
        </div>


        
        <!-- /.row -->
        <div class="row">
            <div class="col-md-12">                
                  <?php $total=0; $pago = $datos['pago']; while($datos2 = mysqli_fetch_array($arrayBillDetail1)) { ?>
                    <?php $total = $total + $datos2['precio_total']; ?> <?php } ?>
                    <div class="btn-group m-r-10">
                        <button aria-expanded="false" data-toggle="dropdown" class="btn btn-info dropdown-toggle waves-effect waves-light" type="button">ACCIONES <span class="caret"></span></button>
                        <ul role="menu" class="dropdown-menu">
                            <li><a href="<?php echo URL; ?>facturas/detalles?id=<?php echo $_GET['id']; ?>&detalles">Ver factura</a></li>
                            <li><a href="<?php echo URL; ?>facturas/detalles?id=<?php echo $_GET['id']; ?>&cambio">Cambio</a></li>
                            <li><a href="<?php echo URL; ?>facturas/detalles?id=<?php echo $_GET['id']; ?>&devolucion">Devolucion</a></li>
                           
                            <li class="divider"></li>
                            <li><a href="<?php echo URL; ?>facturas/detalles?id=<?php echo $_GET['id']; ?>&cancelar">Eliminar factura</a></li>
                        </ul>
                    </div>

                     <?php if ($pago!='a') { ?>
                          <br>  <br>  <div class="row">
                    <div class="col-lg-12">
                        <div class="white-box">
                            <h3><b>Abonar saldo</b></h3><br>
                    
                            <div class="form-group m-b-40">
                                <form class="floating-labels" method="POST">
                                 
                                    <?php 
                                            
                                            $saldo = $pago - $total;
                                      
                                    ?>
                                            
                                         <div class="row">
                                            <div class="col-lg-12 col-sm-4 col-xs-12">
                                                <center>Saldo actual de la factura</center>
                                                <button type="button" class="btn btn-outline btn-default btn-lg btn-block"><?php echo number_format($saldo); ?></button>
                                                
                                            </div>

                                         </div>
                                         <br>
                                         <br>

                                        <div class="form-group m-b-40">
                                            <input autofocus="" name="balance" type="number" class="form-control input-md" id="input1" required=""><span class="highlight"></span> <span class="bar"></span>
                                            <label for="input1">Valor de abono</label>
                                        </div>
                                            <?php $saldo = $total - $pago; ?>
                                            <input type="hidden" name="idBill" value="<?php echo $_GET['id']; ?>">
                                            <input type="hidden" name="idUser" value="<?php echo 1; ?>">
                                            <input type="hidden" name="saldo" value="<?php echo $saldo; ?>">


                                        <button class="btn btn-success waves-effect waves-light" type="submit"><b>EJECUTAR CAMBIO</b></button>
                                        <a href="<?php echo URL; ?>facturas/detalles?id=<?php echo $_GET['id']; ?>&detalles">
                                             <button class="btn btn-danger waves-effect waves-light" type="button"><b>CANCELAR</b></button>
                                        </a>

                                    </form>
                                   </div>
                        </div>
                    </div>
                </div>
                            <?php }  ?>


                  
                    
                <div class="white-box printableArea">
                    <h3><b>Factura <?php if ($datos['typeBill'] == 1) {
                        echo "de venta";
                    }elseif ($datos['typeBill'] == 2) {
                        echo "de compra";
                    } ?></b> 
                    
                    <span class="pull-right">#<?php echo $datos['idbills']; ?></span></h3>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="pull-left">
                                <address>
                                    <h3> &nbsp;<b class="text-danger"><?php echo ucfirst($datosCompany['nameCompany']); ?> </b></h3>
                                    <p class="text-muted m-l-5"><b>Direccion:</b> <?php echo ucfirst($datosCompany['directionCompany']); ?> 
                                        <br> <b>Nit:</b> <?php echo ucfirst($datosCompany['nitCompany']); ?> 
                                        <br> <b>Ciudad:</b> <?php echo ucfirst($datosCompany['cityCompany']); ?> 
                                        <br> <b>Email:</b> <?php echo ucfirst($datosCompany['emailCompany']); ?> 
                                        <br> <b>Telefono:</b> <?php echo ucfirst($datosCompany['phoneCompany']); ?> 
                                    </p>
                                </address>

                                <p class="m-t-30"><b>Fecha de factura:</b> <i class="fa fa-calendar"></i> <?php echo $datos['fecha']; ?></p>
                            </div>
                            <div class="pull-right text-right">
                                <address>
                                    <?php if ($datos['cliente'] == '') {

                                    }else{  ?>
                                    <h4 class="font-bold"><?php echo ucfirst($datosUser['jobTitle']); ?></h4>
                                    <p class="text-muted m-l-30"><b>NIT: </b><?php if ($datosUser['documentUser'] == '') {
                                        echo $datos['cliente'];
                                    }else{
                                        echo $datosUser['documentUser']; ?>
                                        <br> <b>Telefono:</b> <?php echo $datosUser['phone'] ?>
                                        <br> <b>Email:</b> <?php echo $datosUser['email'] ?>
                                        <br> <b>Empresa/razon social:</b> <?php echo ucfirst($datosUser['company']); ?></p>
                                        <?php } ?>

                                        <?php } ?>


                                    </address>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="table-responsive m-t-40" style="clear: both;">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th>Producto</th>
                                                <th class="text-right">Cantidad</th>
                                                <th class="text-right">Valor unidad</th>
                                                <th class="text-right">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $total=0; $i=1; while($datos2 = mysqli_fetch_array($arrayBillDetail)) { ?>
                                            <?php $total = $total + $datos2['precio_total']; ?>
                                            <tr>
                                                <td class="text-center"><?php echo $i++; ?></td>
                                                <td><?php echo ucfirst($datos2['nombre']); ?></td>
                                                <td class="text-right"><?php echo $datos2['cantidad']; ?> </td>
                                                <td class="text-right"><?php echo number_format($datos2['precio_compra']); ?> </td>
                                                <td class="text-right"><?php echo number_format($datos2['precio_total']); ?> </td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-12">

                                <div class="pull-right m-t-30 text-right">
                                    <p>Pago: $<?php echo number_format($datos['pago']); ?></p>
                                    <p>Sub total: $<?php echo number_format($total); ?></p>
                                    <p>IVA (0%) : $0 </p>
                                    <?php 
                                    $pago = $datos['pago'];
                                    if ($pago>$total) { ?>
                                        <p>Cambio: $<?php echo number_format($pago-$total); ?></p>
                                    <?php }else{ ?>
                                        <p>Saldo: $<?php echo number_format($pago-$total); ?></p>
                                    <?php } ?>
                                    <hr>
                                        <h3><b>Total :</b> $<?php echo number_format($total); ?></h3>

                                </div>
                                <div class="clearfix"></div>
                                <hr>
                                <div class="text-right">
                                    <button id="print" class="btn btn-default btn-outline" type="button"> <span><i class="fa fa-print"></i> Imprimir POS</span> </button>
                                    <button id="print" class="btn btn-default btn-outline" type="button"> <span><i class="fa fa-print"></i> Imprimir</span> </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- .row -->
            <!-- /.row -->
            <!-- .right-sidebar -->

            <!-- /.right-sidebar -->
        </div>
        <!-- /.container-fluid -->
    </div>