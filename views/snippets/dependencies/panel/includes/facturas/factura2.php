
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
                  <?php $total=0; $pago = $datos['pago']; while($datos2 = mysqli_fetch_array($arrayBillDetail1)) { ?>
                    <?php $total = $total + $datos2['precio_total']; ?> <?php } ?>


                    <form action="detalles&id=0&dia=venta" method="GET" id="formulario">
                    			<div class="row">
                    				<div class="col-lg-6">
                        	 		<input class="form-control" type="date" id="fecha" name="fecha" value="<?php echo $_GET['fecha'] ?>"><br>
                    				
                    			</div>
                    			<div class="col-lg-6">
                    				<button type="submit" class="btn btn-block btn-outline btn-success">Consultar</button>
                    				
                    			</div>
                    			</div>
	
			                </form>


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
                                                <th class="text-right">Cantidad</th>
                                                <th class="text-right">Valor unidad</th>
                                                <th class="text-right">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $total=0; $i=1; while($datos2 = mysqli_fetch_array($arrayBillDetail2)) { ?>
                                            <?php $total = $total + $datos2['precio_total']; ?>
                                            <tr>
                                                <?php 
                                                if ($datos['typeBill'] == 2) { ?>
                                                <td class="text-center"><?php echo $i++; ?></td>
                                                <td><?php echo ucfirst($datos2['nombre']); ?></td>
                                                <td class="text-right"><?php echo $datos2['cantidad']; ?> </td>
                                                <td class="text-right"><?php echo number_format($datos2['precio_compra']); ?> </td>
                                                <td class="text-right"><?php echo number_format($datos2['precio_compra'] * $datos2['cantidad']); ?> </td>
                                                <?php }else{ ?>
                                                <td class="text-center"><?php echo $datos2['bills_idbills']; ?></td>
                                                <td><?php echo ucfirst($datos2['nombre']); ?></td>
                                                <td class="text-right"><?php echo $datos2['cantidad']; ?> </td>
                                                <td class="text-right"><?php echo number_format($datos2['precio_c-u']); ?> </td>
                                                <td class="text-right"><?php echo number_format($datos2['precio_c-u'] * $datos2['cantidad']); ?> </td>
                                                <?php } ?>
                                                
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
                                    <?php $fecha = $_GET['fecha']; ?>
                                    <form action="<?php URL ?>/irocket/views/snippets/layout/pages/cajas/php/imprimir_venta.php?fecha=<?php echo $fecha; ?>" method="POST">
                                        <input type="hidden" name="imprimir" value="si">
                                        <button type="submit"  class="btn btn-default btn-outline" type="button"> <span><i class="fa fa-print"></i> Imprimir POS</span> </button>
                                    </form>
                                    <br>
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

    <script>
    $(document).ready(function () {
        //$("#alertabien").slideUp(5000).delay(5000);
        $('#alertabien').delay(8000).slideToggle(1000, function () {
            $('#alertabien').removeClass("show");
        });
        return false;
    });

</script>
                         