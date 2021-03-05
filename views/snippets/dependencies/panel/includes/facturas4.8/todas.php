<?php 
$modelInventory = new models\Bills();
$con = new models\Conexion();
$arrayInventory = $modelInventory->array2();
?>

<div id="page-wrapper">








<div class="container-fluid">

<div class="row bg-title">
<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
	<h4 class="page-title">Facturas</h4>
</div>
<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
	<ol class="breadcrumb">
		<li><a href="#">Panel</a></li>
		<li><a href="#">Facturas</a></li>
		<li class="active">Ver todo</li>
	</ol>
</div>
</div>





<div class="row">
    <div class="col-md-12">
        <div class="white-box">
            <ul class="timeline">
    <?php while($datos = mysqli_fetch_array($arrayInventory)) { ?>
    			<?php 
					if ($datos['idbills']%2==0){ ?>
						<li>
                            <div class="timeline-badge success">

					           <?php 
                        if($datos['typeBill'] == 1){ ?>
                        	<img class="img-responsive" alt="user" src="<?php echo (URL); ?>views/plugins/images/alert5.png"> </div>
                    <?php  }elseif($datos['typeBill'] == 2){ ?>
                        	<img class="img-responsive" alt="user" src="<?php echo (URL); ?>views/plugins/images/alert5.png"> </div>
                   
                   	<?php } ?>

        


        <div class="timeline-panel">
            <div class="timeline-heading">
                <h4 class="timeline-title">
                	
                	<?php 
                        if($datos['typeBill'] == 1){
                            echo "Factura de venta";
                        }elseif($datos['typeBill'] == 2){
                            echo "Factura de compra";
                        }elseif($datos['typeBill'] == 3){
                            echo "Factura de cambio";
                        }elseif($datos['typeBill'] == 4){
                            echo "Factura de devolucion";
                        }
                     ?>

                </h4>
                <p><small class="text-muted"><i class="fa fa-clock-o"></i> <?php echo $datos['fecha']; ?></small> </p>
            </div>
            <div class="timeline-body">
               <?php 
               if ($datos['typeBill'] == 1) { ?>
                <?php echo "Has creado una factura de venta"; ?> 

                <center>
                  <br>

                    <a href=" <?php echo URL; ?>facturas/detalles?id=<?php echo $datos['idbills']; ?>&detalles " class="btn btn-block btn-outline btn-info">Ver factura</a>
                </center>
             <?php  } ?>
              <?php 
               if ($datos['typeBill'] == 2) { ?>
                <?php echo "Has creado una factura de compra"; ?> 

                <center>
                  <br>

                    <a href=" <?php echo URL; ?>facturas/detalles?id=<?php echo $datos['idbills']; ?>&detalles " class="btn btn-block btn-outline btn-info">Ver factura</a>
                </center>
             <?php  } ?>
           
            </div>
        </div>
    </li>
<?php }else{ ?>
	<li class="timeline-inverted">
        <div class="timeline-badge warning">

        			<?php 
                        if($datos['typeBill'] == 1){ ?>
                        	<img class="img-responsive" alt="user" src="<?php echo (URL); ?>views/plugins/images/alert5.png"> 
                    <?php  }elseif($datos['typeBill'] == 2){ ?>
                        	<img class="img-responsive" alt="user" src="<?php echo (URL); ?>views/plugins/images/alert5.png"> 
                   	<?php } ?>


        </div>
        <div class="timeline-panel">
            <div class="timeline-heading">
                <h4 class="timeline-title">
                	
                	<?php 
                        if($datos['typeBill'] == 1){
                            echo "Factura de venta";
                        }elseif($datos['typeBill'] == 2){
                            echo "Factura de compra";
                        }elseif($datos['typeBill'] == 3){
                            echo "Factura de cambio";
                        }elseif($datos['typeBill'] == 4){
                            echo "Factura de devolucion";
                        }
                     ?>

                </h4>
                <p><small class="text-muted"><i class="fa fa-clock-o"></i> <?php echo $datos['fecha']; ?></small> </p>
                
            </div>
            <div class="timeline-body">
               <?php 
               if ($datos['typeBill'] == 1) { ?>
                <?php echo "Has creado una factura de venta"; ?> 

                <center>
                  <br>

                    <a href=" <?php echo URL; ?>facturas/detalles?id=<?php echo $datos['idbills']; ?>&detalles " class="btn btn-block btn-outline btn-info">Ver factura</a>
                </center>
             <?php  } ?>
              <?php 
               if ($datos['typeBill'] == 2) { ?>
                <?php echo "Has creado una factura de compra"; ?> 

                <center>
                  <br>

                    <a href=" <?php echo URL; ?>facturas/detalles?id=<?php echo $datos['idbills']; ?>&detalles " class="btn btn-block btn-outline btn-info">Ver factura</a>
                </center>
             <?php  } ?>
            </div>
        </div>
    </li>
<?php } ?>

 <?php } ?>

               
               
               
            </ul>
        </div>
    </div>
</div>



</div>
</div>