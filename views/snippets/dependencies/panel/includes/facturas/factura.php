
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
<?php if (isset($_GET['success'])) {
    if ($_GET['success'] == 'deposito') {
        echo "<div class='m-alert m-alert--icon m-alert--air m-alert--square alert alert-success alert-dismissible fade show' role='alert' id='alertabien'>
            <div class='m-alert__icon'>
            <i class='flaticon-rocket'></i>
            </div>
            <div class='m-alert__text'>
            <strong>
            Genial !
            </strong>
            has ingresado el abono de saldo correctamente. Si tiene dudas o problemas contactenos por medio de <a target='_blank' href='<?php URL_SITIO ?> '>nuestro sitio web.</a>
            </div>
            <div class='m-alert__close'>
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'></button>
            </div>
            </div>";
    }  
}
?>  
        <!-- /.row -->
        <div class="row">
            <div class="col-md-12">                
                  <?php $totalFact=0;
                  $totalIva=0;
                   $pago = $datos['pago']; while($datos2 = mysqli_fetch_array($arrayBillDetail1)) { ?>
                    <?php $totalFact = $totalFact + $datos2['precioTotal'];
                    $totalIva = $totalIva + $datos2['impuesto'] *  $datos2['cantidad'];
                    $totalFact=$totalFact; ?>
                     <?php } ?>
                    <div class="btn-group m-r-10">
                        <button aria-expanded="false" data-toggle="dropdown" class="btn btn-info dropdown-toggle waves-effect waves-light" type="button">ACCIONES <span class="caret"></span></button>
                        <ul role="menu" class="dropdown-menu">
                            
                            <li><a href="<?php echo URL; ?>facturas/detalles?id=<?php echo $_GET['id']; ?>&devolucion">Devolucion</a></li>


                            <?php if ($datos['typeBill'] == 1) { ?>
                                <li><a href="<?php echo URL; ?>contabilidad/ver?tipo=documento&numero=<?php echo $datos['numeroFactura']; ?>&comprobante=1">Ver comprobante</a></li>
                            <?php }elseif ($datos['typeBill'] == 2) {?>
                            <?php } elseif ($datos['typeBill'] == 3) {?>
                                <li><a href="<?php echo URL; ?>contabilidad/ver?tipo=documento&numero=<?php echo $datos['numeroFactura']; ?>&comprobante=5000">Ver comprobante</a></li>
                            <?php } elseif ($datos['typeBill'] == 4) {?>
                                <li><a href="<?php echo URL; ?>contabilidad/ver?tipo=documento&numero=<?php echo $datos['numeroFactura']; ?>&comprobante=2">Ver comprobante</a></li>
                            <?php } elseif ($datos['typeBill'] == 5) {?>
                            <?php } elseif ($datos['typeBill'] == 6) {?>
                                <li><a href="<?php echo URL; ?>contabilidad/ver?tipo=documento&numero=<?php echo $datos['numeroFactura']; ?>&comprobante=5001">Ver comprobante</a></li>
                            <?php } ?>



                            <li><a href="<?php echo URL; ?>facturas/detalles?id=<?php echo $_GET['id']; ?>&editar">Editar</a></li>
                                
                            <!--
                            <li class="divider"></li>
                            <li><a href="<?php //echo URL; ?>facturas/detalles?id=<?php //echo $_GET['id']; ?>&cancelar">Eliminar factura</a></li>-->
                        </ul>
                    </div>
                  
                    <br><br>
                <div class="white-box printableArea">
                    <h3><b>Factura <?php if ($datos['typeBill'] == 1) {
                        echo "de venta POS";
                    }elseif ($datos['typeBill'] == 2) {
                        echo "de venta remision";
                    } elseif ($datos['typeBill'] == 3) {
                        echo "de venta electronica";
                    } elseif ($datos['typeBill'] == 4) {
                        echo "de compra POS";
                    } elseif ($datos['typeBill'] == 5) {
                        echo "de compra remision";
                    } elseif ($datos['typeBill'] == 6) {
                        echo "de compra electronica";
                    } ?></b> 
                    
                    <span class="pull-right">#<?php echo $datos['numeroFactura']; ?></span></h3>
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

                                <p class="m-t-30"><b>Fecha de factura:</b> <i class="fa fa-calendar"></i> <?php echo $datos['dateRegister']; ?></p>
                            </div>
                            <div class="pull-right text-right">
                                <address>
                                    <?php if ($datos['cliente'] == '') {

                                    }else{  ?>
                                    <h4 class="font-bold"><?php echo ucwords($datosUser['nameUser']) . " " . ucwords($datosUser['lastnameUser']); ?></h4>
                                    <p class="text-muted m-l-30"><b>NIT: </b><?php if ($datosUser['documentUser'] == '') {
                                        echo $datos['documento'];
                                    }else{
                                        echo $datosUser['documento']."-".$datosUser['dv']; ?>
                                        <br> <b>Nombre:</b> <?php echo ucfirst($datosUser['userName']) ?>
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
                                                <th>IVA %</th>
                                                <th>IVA VALOR</th>
                                                <th class="text-right">Cantidad</th>
                                                <th class="text-right">Valor unidad</th>
                                                <th class="text-right">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <p class="text-danger"></p>
                                            <?php $total=0;  $i=1; while($datos2 = mysqli_fetch_array($arrayBillDetail)) { ?>
                                            <?php $total = $total + $datos2['precioTotal']; ?>
                                            <tr>
                                                <?php 
                                                if ($datos['typeBill'] == 2) { ?>
                                                <td class="text-center"><?php echo $i++; ?></td>
                                                <td><?php echo ucfirst($datos2['nombre']); ?></td>
                                                <td><?php echo ucfirst($datos2['ivaPorcentaje']); ?>%</td>
                                                <td><?php echo number_format($datos2['impuesto']*$datos2['cantidad'], 2, ',', ' '); ?></td>
                                                <td class="text-right"><?php echo $datos2['cantidad']; ?> </td>
                                                <td class="text-right"><?php echo number_format($datos2['precioUnidad'], 2, ',', ' '); ?> </td>
                                                <td class="text-right"><?php echo number_format($datos2['precioUnidad'] * $datos2['cantidad'], 2, ',', ' '); ?> </td>
                                                <?php }else{ ?>
                                                <td class="text-center"><?php echo $i++; ?></td>
                                                <td><?php echo ucfirst($datos2['nombre']); ?></td>
                                                <td><?php echo ucfirst($datos2['ivaPorcentaje']); ?>%</td>
                                                <td><?php echo number_format($datos2['impuesto']*$datos2['cantidad'], 2, ',', ' '); ?></td>
                                                <td class="text-right"><?php echo $datos2['cantidad']; ?> </td>
                                                <td class="text-right"><?php echo number_format($datos2['precioUnidad'], 2, ',', ' '); ?> </td>
                                                <td class="text-right"><?php echo number_format($datos2['precioUnidad'] * $datos2['cantidad'], 2, ',', ' '); ?> </td>
                                                <?php } ?>
                                            </tr>
                                            <?php } ?>
                                            
                                        </tbody>
                                    </table>


                                    <table class="table table-hover">
                                        
                                        <tbody>
                                            <p class="text-danger"></p>
                                            <?php $total=0;  $i=1; while($datos2 = mysqli_fetch_array($arrayBillDetailDevolucion)) { ?>
                                            <?php $total = $total + $datos2['precioTotal']; ?>
                                            <tr>
                                                <?php 
                                                if ($datos['typeBill'] == 2) { ?>
                                                <td class="text-danger" class="text-center"><?php echo $i++; ?></td>
                                                <td class="text-danger"><?php echo ucfirst($datos2['nombre']); ?></td>
                                                <td class="text-danger"><?php echo ucfirst($datos2['ivaPorcentaje']), 2, ',', ' '; ?>%</td>
                                                <td class="text-danger"><?php echo number_format($datos2['impuesto']*$datos2['cantidad'], 2, ',', ' '); ?></td>
                                                <td class="text-danger" class="text-right"><?php echo $datos2['cantidad']; ?> </td>
                                                <td class="text-danger" class="text-right"><?php echo number_format($datos2['precioUnidad'], 2, ',', ' '); ?> </td>
                                                <td class="text-danger" class="text-right"><?php echo number_format($datos2['precioUnidad'] * $datos2['cantidad'], 2, ',', ' '); ?> </td>
                                                <?php }else{ ?>
                                                <td class="text-danger" class="text-center"><?php echo $i++; ?></td>
                                                <td class="text-danger"><?php echo ucfirst($datos2['nombre']); ?></td>
                                                <td class="text-danger"><?php echo ucfirst($datos2['ivaPorcentaje']); ?>%</td>
                                                <td class="text-danger"><?php echo number_format($datos2['impuesto']*$datos2['cantidad'], 2, ',', ' '); ?></td>
                                                <td class="text-danger" class="text-right"><?php echo $datos2['cantidad']; ?> </td>
                                                <td class="text-danger" class="text-right"><?php echo number_format($datos2['precioUnidad'], 2, ',', ' '); ?> </td>
                                                <td class="text-danger" class="text-right"><?php echo number_format($datos2['precioUnidad'] * $datos2['cantidad'], 2, ',', ' '); ?> </td>
                                                <?php } ?>
                                            </tr>
                                            <?php } ?>
                                            
                                        </tbody>
                                    </table></div>
                            </div>
                            <div class="col-md-12">

                                <div class="pull-right m-t-30 text-right">
                                    <?php 
                                     ?>
                                    <p><?php $resta= $totalFact-$totalIva; ?></p>
                                    <p>Sub total: $<?php echo number_format($resta, 2, ',', ' '); ?></p>
                                    <p>IVA: $<?php echo number_format($totalIva, 2, ',', ' '); ?></p>
                                    <p>Pago: $<?php echo number_format($datos['pago'], 2, ',', ' '); ?></p>
                                    <?php 
                                    $pago = $datos['pago'];
                                    if ($pago>$total) { ?>
                                        <p><?php $cambio=$pago-$totalFact; ?></p>
                                        <p>Cambio: $<?php echo number_format($cambio, 2, ',', ' '); ?></p>
                                    <?php }else{ ?>
                                        <p><?php echo $saldo=$pago-$totalFact; ?></p>
                                        <p>Saldo: $<?php echo number_format($saldo, 2, ',', ' '); ?></p>
                                    <?php } ?>
                                    <hr>
                                        <h3><b>Total :</b> $<?php echo number_format($totalFact, 2, ',', ' '); ?></h3>

                                </div>
                                <div class="clearfix"></div>
                                <hr>
                                <div class="text-right">
                                    <div class="text-right">
                                    <?php $idBill = $_GET['id']; ?>




                                    <?php if ($datos['typeBill'] == 1) { ?>
                                        <form action="<?php URL ?>/irocket/views/snippets/layout/pages/cajas/php/imprimir_venta_fac_copia.php?id=<?php echo $idBill; ?>" method="POST">
                                        <input type="hidden" name="imprimir" value="si">
                                        <button type="submit"  class="btn btn-default btn-outline" type="button"> <span><i class="fa fa-print"></i> Imprimir POS</span> </button>
                                        </form>
                                    <?php }elseif ($datos['typeBill'] == 2) {
                                        ?>
                                         <form action="<?php URL ?>/irocket/views/snippets/layout/pages/cajas/php/imprimir_venta_fac_rem_copia.php?id=<?php echo $idBill; ?>" method="POST">
                                         <input type="hidden" name="imprimir" value="si">
                                         <button type="submit"  class="btn btn-default btn-outline" type="button"> <span><i class="fa fa-print"></i> Imprimir POS</span> </button>
                                         </form>
                                     <?php 
                                    } elseif ($datos['typeBill'] == 3) {
                                        ?>
                                         <form action="<?php URL ?>/irocket/views/snippets/layout/pages/cajas/php/imprimir_venta_fac_elec.php?id=<?php echo $idBill; ?>" method="POST">
                                         <input type="hidden" name="imprimir" value="si">
                                         <button type="submit"  class="btn btn-default btn-outline" type="button"> <span><i class="fa fa-print"></i> Imprimir POS</span> </button>
                                         </form>
                                     <?php 
                                    } elseif ($datos['typeBill'] == 4) {
                                        ?>
                                            <form action="<?php URL ?>/irocket/views/snippets/layout/pages/cajas/php/imprimir_compra_pos.php?id=<?php echo $idBill; ?>" method="POST">
                                            <input type="hidden" name="imprimir" value="si">
                                            <button type="submit"  class="btn btn-default btn-outline" type="button"> <span><i class="fa fa-print"></i> Imprimir POS</span> </button>
                                            </form>
                                        <?php 
                                    } elseif ($datos['typeBill'] == 5) {
                                        ?>
                                            <form action="<?php URL ?>/irocket/views/snippets/layout/pages/cajas/php/imprimir_compra_rem.php?id=<?php echo $idBill; ?>" method="POST">
                                            <input type="hidden" name="imprimir" value="si">
                                            <button type="submit"  class="btn btn-default btn-outline" type="button"> <span><i class="fa fa-print"></i> Imprimir POS</span> </button>
                                            </form>
                                        <?php                                      
                                    } elseif ($datos['typeBill'] == 6) {
                                        ?>
                                        <form action="<?php URL ?>/irocket/views/snippets/layout/pages/cajas/php/imprimir_compra_elec.php?id=<?php echo $idBill; ?>" method="POST">
                                        <input type="hidden" name="imprimir" value="si">
                                        <button type="submit"  class="btn btn-default btn-outline" type="button"> <span><i class="fa fa-print"></i> Imprimir POS</span> </button>
                                        </form>
                                    <?php  
                                    } ?>




                                    
                                    <br>
                                    <button id="print" class="btn btn-default btn-outline" type="button"> <span><i class="fa fa-print"></i> Imprimir</span> </button>
                                </div>
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

    <script>
    $(document).ready(function () {
        //$("#alertabien").slideUp(5000).delay(5000);
        $('#alertabien').delay(8000).slideToggle(1000, function () {
            $('#alertabien').removeClass("show");
        });
        return false;
    });

</script>
                         