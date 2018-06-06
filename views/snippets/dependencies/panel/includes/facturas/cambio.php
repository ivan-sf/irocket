


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
<?php if (isset($_GET['error'])) {
    if ($_GET['error'] == 'sin_producto') {
        echo "<div class='m-alert m-alert--icon m-alert--air m-alert--square alert alert-danger alert-dismissible fade show' role='alert' id='alertabien'>
            <div class='m-alert__icon'>
            <i class='flaticon-rocket'></i>
            </div>
            <div class='m-alert__text'>
            <strong>
            Lo sentimos !
            </strong>
            Debe ingresar un codigo y una cantidad si tiene dudas o problemas contactenos por medio de <a target='_blank' href='<?php URL_SITIO ?> '>nuestro sitio web.</a>
            </div>
            <div class='m-alert__close'>
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'></button>
            </div>
            </div>";
    }elseif ($_GET['error'] == 'no_encontrado') {
        echo "<div class='m-alert m-alert--icon m-alert--air m-alert--square alert alert-danger alert-dismissible fade show' role='alert' id='alertabien'>
            <div class='m-alert__icon'>
            <i class='flaticon-rocket'></i>
            </div>
            <div class='m-alert__text'>
            <strong>
            Lo sentimos !
            </strong>
            el codigo ingresado no existe en la base de datos intente nuevamente si tiene dudas o problemas contactenos por medio de <a target='_blank' href='<?php URL_SITIO ?> '>nuestro sitio web.</a>
            </div>
            <div class='m-alert__close'>
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'></button>
            </div>
            </div>";
    }elseif ($_GET['error'] == 'saldo') {
        echo "<div class='m-alert m-alert--icon m-alert--air m-alert--square alert alert-danger alert-dismissible fade show' role='alert' id='alertabien'>
            <div class='m-alert__icon'>
            <i class='flaticon-rocket'></i>
            </div>
            <div class='m-alert__text'>
            <strong>
            Lo sentimos !
            </strong>
            Esta factura tiene un saldo pendiente no es posible realizar cambios, primero debe cancelar el valor correspondiente. Si tiene dudas o problemas contactenos por medio de <a target='_blank' href='<?php URL_SITIO ?> '>nuestro sitio web.</a>
            </div>
            <div class='m-alert__close'>
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'></button>
            </div>
            </div>";
    }elseif ($_GET['error'] == 'precio') {
        echo "<div class='m-alert m-alert--icon m-alert--air m-alert--square alert alert-danger alert-dismissible fade show' role='alert' id='alertabien'>
            <div class='m-alert__icon'>
            <i class='flaticon-rocket'></i>
            </div>
            <div class='m-alert__text'>
            <strong>
            Lo sentimos !
            </strong>
            el nuevo producto debe tener un precio igual o superior al antiguo. Si tiene dudas o problemas contactenos por medio de <a target='_blank' href='<?php URL_SITIO ?> '>nuestro sitio web.</a>
            </div>
            <div class='m-alert__close'>
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'></button>
            </div>
            </div>";
    } elseif ($_GET['error'] == 'completa') {
        echo "<div class='m-alert m-alert--icon m-alert--air m-alert--square alert alert-danger alert-dismissible fade show' role='alert' id='alertabien'>
            <div class='m-alert__icon'>
            <i class='flaticon-rocket'></i>
            </div>
            <div class='m-alert__text'>
            <strong>
            Lo sentimos !
            </strong>
            no es posible realizar mas cambios en la factura, puede realizar devoluciones. Si tiene dudas o problemas contactenos por medio de <a target='_blank' href='<?php URL_SITIO ?> '> nuestro sitio web.</a>
            </div>
            <div class='m-alert__close'>
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'></button>
            </div>
            </div>";
    }elseif ($_GET['error'] == 'promocion') {
        echo "<div class='m-alert m-alert--icon m-alert--air m-alert--square alert alert-danger alert-dismissible fade show' role='alert' id='alertabien'>
            <div class='m-alert__icon'>
            <i class='flaticon-rocket'></i>
            </div>
            <div class='m-alert__text'>
            <strong>
            Lo sentimos !
            </strong>
            los productos en promocion no estan disponibles en la seccion de cambios. Si tiene dudas o problemas contactenos por medio de <a target='_blank' href='<?php URL_SITIO ?> '> nuestro sitio web.</a>
            </div>
            <div class='m-alert__close'>
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'></button>
            </div>
            </div>";
    } elseif ($_GET['error'] == 'codigo') {
        echo "<div class='m-alert m-alert--icon m-alert--air m-alert--square alert alert-danger alert-dismissible fade show' role='alert' id='alertabien'>
            <div class='m-alert__icon'>
            <i class='flaticon-rocket'></i>
            </div>
            <div class='m-alert__text'>
            <strong>
            Lo sentimos !
            </strong>
            debes ingresar un producto diferente al actual. Si tiene dudas o problemas contactenos por medio de <a target='_blank' href='<?php URL_SITIO ?> '> nuestro sitio web.</a>
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
                    <div class="btn-group m-r-10">
                        <button aria-expanded="false" data-toggle="dropdown" class="btn btn-info dropdown-toggle waves-effect waves-light" type="button">ACCIONES <span class="caret"></span></button>
                        <ul role="menu" class="dropdown-menu">
                            <li><a href="<?php echo URL; ?>facturas/detalles?id=<?php echo $_GET['id']; ?>&detalles">Ver factura</a></li>
                            <li><a href="<?php echo URL; ?>facturas/detalles?id=<?php echo $_GET['id']; ?>&devolucion">Devolucion</a></li>
                            <?php if ($pago<$total) { ?>
                            <li><a href="<?php echo URL; ?>facturas/detalles?id=<?php echo $_GET['id']; ?>&saldo">Abonar saldo</a></li>
                            <?php }  ?>
                        </ul>
                    </div>
                    	<br>	
                   <?php 	
						if ($_GET['cambio'] != '') {
                    ?>
						    <br>  <div class="row">
                	<div class="col-lg-12">
                		<div class="white-box">
                			<h3><b>Cambiar producto</b></h3><br>
                    
                			<div class="form-group m-b-40">
                                <form class="floating-labels" method="POST" onsubmit="return checkSubmit();">
                                     <?php if ($pago<$total) {
                                        $estado = '2';
                                     }else{
                                        $estado = '1';
                                     }?>
                                	<?php 
								        while ($datos3 = mysqli_fetch_array($arrayBillDetail2)) {
								        	$nombre = $datos3['nombre'];
								        	$precio_total = $datos3['precio_c-u'];
								        	$cantidad = $datos3['cantidad'];
                                            $precio_compra = $datos3['precio_total'];
                                            if ($datos['typeBill'] == 1) {
                                                $precioCVProducto = $datos3['precio_c-u'];
                                            }else{
                                                $precioCVProducto = $datos3['precio_compra'];
                                            }
								        }
								    ?>
											
                                         <div class="row">
                                         	<div class="col-lg-3 col-sm-4 col-xs-12">
								    			<center>Nombre producto a cambiar</center>
                                            	<button type="button" class="btn btn-outline btn-default btn-lg btn-block"><?php echo strtoupper($nombre); ?></button>
			                                    
			                                </div>

			                                <div class="col-lg-3 col-sm-4 col-xs-12">
								    			<center>Precio producto a cambiar</center>
                                            	<button type="button" class="btn btn-outline btn-default btn-lg btn-block"><?php echo number_format($precioCVProducto); ?></button>
			                                    
			                                </div>

			                                <div class="col-lg-3 col-sm-4 col-xs-12">
								    			<center>Cantidad producto a cambiar</center>
                                            	<button type="button" class="btn btn-outline btn-default btn-lg btn-block"><?php echo strtoupper($cantidad); ?></button>
			                                    
			                                </div>

			                                <div class="col-lg-3 col-sm-4 col-xs-12">
								    			<center>Precio total producto a cambiar</center>
                                            	<button type="button" class ="btn btn-outline btn-default btn-lg btn-block"><?php echo number_format($precioCVProducto*$cantidad); ?></button>
			                                    
			                                </div>
                                         </div>
                                         <br>
                                         <br>

                                        <div class="form-group m-b-40">
                                            <input autofocus="" name="cNewProd" type="text" class="form-control input-md" id="input1" ><span class="highlight"></span> <span class="bar"></span>
                                            <label for="input1">Codigo nuevo producto</label>
                                        </div>

                                        <div class="form-group m-b-40">
                                            <input type="number" name="qNewProd" class="form-control input-md" id="input1" value="1"><span class="highlight"></span> <span class="bar"></span>
                                            <label for="input1">Cantidad nuevo producto</label>
                                        </div> 

                                           <input type="hidden" name="idBillD" value="<?php echo $_GET['cambio']; ?>">
                                            <input type="hidden" name="idBill" value="<?php echo $_GET['id']; ?>">
                                            <input type="hidden" name="idUser" value="<?php echo 1; ?>">
                                            <input type="hidden" name="estado" value="<?php echo $estado; ?>">
                                            <input type="hidden" name="typeBill" value="<?php echo $datos['typeBill']; ?>">
                                            <input type="hidden" name="cambio" value="<?php echo 1; ?>">


                                        <button class="btn btn-success waves-effect waves-light" type="submit"><b>EJECUTAR CAMBIO</b></button>
                                       	<a href="<?php echo URL; ?>facturas/detalles?id=<?php echo $_GET['id']; ?>&cambio">
                                       		 <button class="btn btn-danger waves-effect waves-light" type="button"><b>CANCELAR</b></button>
                                       	</a>

                                    </form>
                                   </div>
                		</div>
                	</div>
                </div>
					<?php 	}

                    ?>
                    
                    	<br>	


                <div class="white-box printableArea">
                    <h3><b>Cambio <?php if ($datos['typeBill'] == 1) {
                        echo "de venta";
                    }elseif ($datos['typeBill'] == 2) {
                        echo "de compra";
                    } ?></b> 
                    
                    <span class="pull-right">#<?php echo $datos['idbills']; ?></span></h3>


                    <div class="row">
                            <div class="col-md-12">

                                <div class="table-responsive m-t-40" style="clear: both;">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th class="text-center">Producto</th>
                                                <th class="text-center">Valor total</th>
                                                <th class="text-center">Cambio</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $total=0; $i=1; while($datos2 = mysqli_fetch_array($arrayBillDetail)) { ?>
                                            <?php $total = $total + $datos2['precio_total']; ?>
                                            <tr>
                                                <td class="text-center"><?php echo $i++; ?></td>
                                                <td><center><?php echo ucfirst($datos2['nombre']); ?></center></td>
                                                <td><center><?php echo ucfirst($datos2['precio_total']); ?></center></td>
                                                <td>
                                                <center>
                                                	<a href="<?php echo URL; ?>facturas/detalles?id=<?php echo $_GET['id']; ?>&cambio=<?php echo $datos2['idbillDetails'] ?>">
                                                		<button class="btn btn-primary btn-rounded">CAMBIAR PRODUCTO</button>
                                                	</a>
                                                </center>
                                               
                                            	</td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-12">

                               
                                <div class="clearfix"></div>
                                <hr>
                                <div class="text-right">

                                    <a href="<?php echo URL; ?>facturas/detalles?id=<?php echo $_GET['id']; ?>&detalles">
	                                    <button id="print" class="btn btn-default btn-outline" type="button"> <span><i class="fa fa-edit"></i> Ver factura</span> </button>
                                    </a>
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
                         
<script>
    var statSend = false;
function checkSubmit() {
    if (!statSend) {
        statSend = true;
        return true;
    } else {
        
        return false;
    }
}
</script>