
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
            <form action="" method="POST">              
                  <?php $total=0; $pago = $datos['pago']; while($datos2 = mysqli_fetch_array($arrayBillDetail1)) { ?>
                    <?php $total = $total + $datos2['precioTotal'];
                    $total=$total; ?>
                     <?php } ?>
                    <div class="btn-group m-r-10">
                        <button aria-expanded="false" data-toggle="dropdown" class="btn btn-info dropdown-toggle waves-effect waves-light" type="button">ACCIONES <span class="caret"></span></button>
                        <ul role="menu" class="dropdown-menu">
                            
                            <li><a href="<?php echo URL; ?>facturas/detalles?id=<?php echo $_GET['id']; ?>&detalles">Ver factura</a></li>
                            <?php if ($pago<$total) { ?>
                            <li><a href="<?php echo URL; ?>facturas/detalles?id=<?php echo $_GET['id']; ?>&saldo">Abonar saldo</a></li>
                            <?php }  ?>
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
                                    <h4 class="font-bold"><input type="text" value="<?php echo ucwords($datosUser['nameUser']) . " " . ucwords($datosUser['lastnameUser']); ?>" class="form-control tercero"></h4>
                                    <p class="text-muted m-l-30"><b>NIT: </b><?php if ($datosUser['documentUser'] == '') {
                                        echo $datos['cliente'];
                                    }else{ ?>
                                    
                                        <b class="documentoTercero"><?php echo $datosUser['documentUser']; ?></b>
                                        <input type="hidden" name="idCliente" id="idClienteTercero">
                                        <input type="hidden" name="cliente" id="clienteTercero">
                                        <input type="hidden" name="documentUser" id="documentUserTercero">
                                        
                                        
                                        
                                        <br> <b>Telefono:</b> 
                                        <b class="telefonoTercero"><?php echo $datosUser['phone'] ?></b>
                                        <br> <b>Email:</b> 
                                        <b class="emailTercero"><?php echo $datosUser['email'] ?></b>
                                        <br> <b>Empresa/razon social:</b> 
                                        <b class="empresaTercero"><?php echo ucfirst($datosUser['company']); ?></b>
                                        <?php } ?>

                                        <?php } ?>
                                        <input type="submit" class="btn btn-warning btn-block" value="GUARDAR">


                                    </address>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="table-responsive m-t-40" style="clear: both;">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th>Codigo</th>
                                                <th>Producto</th>
                                                <th>IVA %</th>
                                                <th>IVA VALOR</th>
                                                <th class="text-right">Cantidad</th>
                                                <th class="text-right">Valor unidad</th>
                                                <th class="text-right">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $total=0; $totaliva=0; $i=1; while($datos2 = mysqli_fetch_array($arrayBillDetail)) { ?>
                                            <?php $total = $total + $datos2['precioTotal']; ?>
                                            <?php $totaliva = $totaliva + $datos2['impuesto']; ?>
                                            <tr>
                                                <?php 
                                                if ($datos['typeBill'] == 4 OR $datos['typeBill'] == 5 OR $datos['typeBill'] == 6) { ?>
                                                <td class="text-center"><?php echo $i++; ?></td>
                                                <td>
                                                    <input type="text" value="<?php echo ucfirst($datos2['codigo']); ?>" name="codigoNuevo[]" class="form-control">
                                                    <input type="hidden" value="<?php echo ucfirst($datos2['codigo']); ?>" name="codigoViejo[]" class="form-control">
                                                </td>
                                                <td><?php echo ucfirst($datos2['nombre']); ?></td>
                                               
                                                <td><?php echo ucfirst($datos2['ivaPorcentaje']); ?>%</td>
                                                <td><?php echo ucfirst($datos2['impuesto']); ?></td>
                                                <td class="text-right"><?php echo $datos2['cantidad']; ?> </td>
                                                <td class="text-right"><?php echo number_format($datos2['precioUnidad']); ?> </td>
                                                <td class="text-right"><?php echo number_format($datos2['precioUnidad'] * $datos2['cantidad']); ?> 
                                                <?php }else{ ?>
                                                <td class="text-center"><?php echo $i++; ?></td>

                                                <td>
                                                    <input type="text" value="<?php echo ucfirst($datos2['codigo']); ?>" name="codigoNuevo[]" class="form-control">
                                                    <input type="hidden" value="<?php echo ucfirst($datos2['codigo']); ?>" name="codigoViejo[]" class="form-control">
                                                </td>

                                                <td><?php echo ucfirst($datos2['nombre']); ?></td>
                                                <td><?php echo ucfirst($datos2['ivaPorcentaje']); ?>%</td>
                                                <td><?php echo ucfirst($datos2['impuesto']); ?></td>

                                                <td class="text-right">
                                                    <input type="number" value="<?php echo $datos2['cantidad']; ?>" name="cantidadNueva[]" class="form-control">
                                                    <input type="hidden" value="<?php echo $datos2['cantidad']; ?>" name="cantidadVieja[]" class="form-control">
                                                </td>

                                                <td class="text-right"><?php echo number_format($datos2['precioUnidad']); ?> </td>
                                                <td class="text-right"><?php echo number_format($datos2['precioUnidad'] * $datos2['cantidad']); ?> </td>
                                               
                                                <?php } ?>
                                                
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-12">

                                <div class="pull-right m-t-30 text-right">
                                    <?php 
                                     ?>
                                    <p>Sub total: $<?php echo number_format($total); ?></p>
                                    <p>IVA 19%: $<?php echo number_format($totaliva); ?></p>
                                    <p>IVA 5%: $<?php echo number_format($totaliva); ?></p>
                                    <p>Pago: $<?php echo number_format($datos['pago']); ?></p>
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
                                
                                <input type="submit" class="btn btn-warning btn-block" value="GUARDAR">

                                </form>
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
        <?php 
        $array2 = array();
        while ( $dataUser = mysqli_fetch_array($arrayUsers)) { ?>
            <?php
                $nombre = $dataUser['nameUser'] ." ". $dataUser['lastnameUser'];
                $idusers = $dataUser['idusers'];
                $iduser = $dataUser['idusers']." - ".$dataUser['nameUser'] ." ". $dataUser['lastnameUser']." ". $dataUser['documentUser'];
                array_push( $array2,$iduser);
            ?>
        <?php } 
        ?>
        <!-- /.container-fluid -->
    </div>

    <script>
    $(document).ready(function () {

        var items =
            <?= json_encode($array2); ?>
            
            $(".tercero").autocomplete({
                source:items,
                select: function(event,item){
                    var params = {
                        codigo:item.item.value
                    };
                    $.get("getPuc2",params, function(response){
                        var json = JSON.parse(response);
                        //console.log(json)
                        if(json.status==200){
                            //console.log(json.nameUser)
                            $(".nombreTercero").val(json.nameUser+" "+json.lastnameUser);
                            $(".idTercero").val(json.users_idusers);
                            $("#idClienteTercero").val(json.idusers);
                            $("#clienteTercero").val(json.nameUser+" "+json.lastnameUser);
                            $("#documentUserTercero").val(json.documentUser);
                            $(".documentoTercero").html(json.documentUser);
                            $(".telefonoTercero").html(json.phone);
                            $(".emailTercero").html(json.email);
                            $(".empresaTercero").html(json.company);
                            




                            $(".tag1").focus( );
                            //console.log(json)
                        }else{
                            //console.log(0)
                        }
                    });
                }
            });
        //$("#alertabien").slideUp(5000).delay(5000);
        $('#alertabien').delay(8000).slideToggle(1000, function () {
            $('#alertabien').removeClass("show");
        });
        
    });

</script>
                         