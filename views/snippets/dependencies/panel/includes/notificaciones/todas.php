<?php 
$modelInventory = new models\Notifications();
$con = new models\Conexion();
$arrayInventory = $modelInventory->array2();
?>

<div id="page-wrapper">








<div class="container-fluid">

<div class="row bg-title">
<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
	<h4 class="page-title">Notificaciones</h4>
</div>
<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
	<ol class="breadcrumb">
		<li><a href="#">Panel</a></li>
		<li><a href="#">Notificaciones</a></li>
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
					if ($datos['idnotifications']%2==0){ ?>
						<li>
                            <div class="timeline-badge success">

					<?php 
                        if($datos['typeNotification'] == 1){ ?>
                        	<img class="img-responsive" alt="user" src="<?php echo URL; ?>views/plugins/images/warehouse_add.jpg"> </div>
                    <?php  }elseif($datos['typeNotification'] == 2){ ?>
                        	<img class="img-responsive" alt="user" src="<?php echo URL; ?>views/plugins/images/warehouse_update.jpg"> </div>
                    <?php }elseif($datos['typeNotification'] == 3){ ?>
                        	<img class="img-responsive" alt="user" src="<?php echo URL; ?>views/plugins/images/warehouse_delete.jpg"> </div>
                    <?php }elseif($datos['typeNotification'] == 4){ ?>
                        	<img class="img-responsive" alt="user" src="<?php echo URL; ?>views/plugins/images/product_add.jpg"> </div>
                   	<?php  }elseif ($datos['typeNotification'] == 5) { ?>
                        	<img class="img-responsive" alt="user" src="<?php echo URL; ?>views/plugins/images/product_update.jpg"> </div>
                  	<?php }elseif ($datos['typeNotification'] == 6) { ?>
                        	<img class="img-responsive" alt="user" src="<?php echo URL; ?>views/plugins/images/product_delete.jpg">  </div>
                   	<?php }elseif ($datos['typeNotification'] == 7) { ?>
                        	<img class="img-responsive" alt="user" src="<?php echo URL; ?>views/plugins/images/company_add.png">  </div>
                   	<?php }elseif ($datos['typeNotification'] == 8) { ?>
                        	<img class="img-responsive" alt="user" src="<?php echo URL; ?>views/plugins/images/admin_add.png">  </div>
                   	<?php }elseif ($datos['typeNotification'] == 9) { ?>
                        	<img class="img-responsive" alt="user" src="<?php echo URL; ?>views/plugins/images/deposit_add.png">  </div>
                   	<?php }elseif ($datos['typeNotification'] == 10) { ?>
                        	<img class="img-responsive" alt="user" src="<?php echo URL; ?>views/plugins/images/cash_add.png">  </div>
                   	<?php }elseif ($datos['typeNotification'] == 11) { ?>
                        	<img class="img-responsive" alt="user" src="<?php echo URL; ?>views/plugins/images/mov_add.png">  </div>
                   	<?php }elseif ($datos['typeNotification'] == 16) { ?>
                        	<img class="img-responsive" alt="user" src="<?php echo URL; ?>views/plugins/images/company_update.png">  </div>
                   	<?php }elseif ($datos['typeNotification'] == 12) { ?>
                        	<img class="img-responsive" alt="user" src="<?php echo URL; ?>views/plugins/images/deposit_retirement.png"></div>
                   	<?php }elseif ($datos['typeNotification'] == 17) { ?>
                        	<img class="img-responsive" alt="user" src="<?php echo URL; ?>views/plugins/images/deposit_update.png">  </div>
                   	<?php }elseif ($datos['typeNotification'] == 18) { ?>
                        	<img class="img-responsive" alt="user" src="<?php echo URL; ?>views/plugins/images/employee_add.png">  </div>
                   	<?php }elseif ($datos['typeNotification'] == 19) { ?>
                        	<img class="img-responsive" alt="user" src="<?php echo URL; ?>views/plugins/images/employee_update.png">  </div>
                   	<?php }elseif ($datos['typeNotification'] == 20) { ?>
                        	<img class="img-responsive" alt="user" src="<?php echo URL; ?>views/plugins/images/employee_delete.png">  </div>
                   	<?php }elseif ($datos['typeNotification'] == 21) { ?>
                        	<img class="img-responsive" alt="user" src="<?php echo URL; ?>views/plugins/images/client_delete.png">  </div>
                   	<?php }elseif ($datos['typeNotification'] == 22) { ?>
                        	<img class="img-responsive" alt="user" src="<?php echo URL; ?>views/plugins/images/client_update.png">  </div>
                   	<?php }elseif ($datos['typeNotification'] == 23) { ?>
                        	<img class="img-responsive" alt="user" src="<?php echo URL; ?>views/plugins/images/client_add.png">  </div>
                   	<?php }elseif ($datos['typeNotification'] == 26) { ?>
                        	<img class="img-responsive" alt="user" src="<?php echo URL; ?>views/plugins/images/provider_delete.png">  </div>
                   	<?php }elseif ($datos['typeNotification'] == 25) { ?>
                          <img class="img-responsive" alt="user" src="<?php echo URL; ?>views/plugins/images/provider_update.png">  </div>
                    <?php }elseif ($datos['typeNotification'] == 24) { ?>
                          <img class="img-responsive" alt="user" src="<?php echo URL; ?>views/plugins/images/provider_add.png">  </div>
                    <?php }elseif ($datos['typeNotification'] == 27) { ?>
                          <img class="img-responsive" alt="user" src="<?php echo URL; ?>views/plugins/images/delete.png">  </div>
                    <?php }elseif ($datos['typeNotification'] == 96) { ?>
                          <img class="img-responsive" alt="user" src="<?php echo URL; ?>views/plugins/images/warning.png">  </div>
                    <?php }elseif ($datos['typeNotification'] == 97) { ?>
                          <img class="img-responsive" alt="user" src="<?php echo URL; ?>views/plugins/images/invisible.png">  </div>
                    <?php }elseif ($datos['typeNotification'] == 98) { ?>
                          <img class="img-responsive" alt="user" src="<?php echo URL; ?>views/plugins/images/visibility.png">  </div>
                    <?php }elseif ($datos['typeNotification'] == 93) { ?>
                          <img class="img-responsive" alt="user" src="<?php echo URL; ?>views/plugins/images/cash-back.png">  </div>
                    <?php }elseif ($datos['typeNotification'] == 94) { ?>
                          <img class="img-responsive" alt="user" src="<?php echo URL; ?>views/plugins/images/return.png">  </div>
                    <?php }elseif ($datos['typeNotification'] == 95) { ?>
                          <img class="img-responsive" alt="user" src="<?php echo URL; ?>views/plugins/images/exchange.png">  </div>
                    <?php } ?>


        


        <div class="timeline-panel">
            <div class="timeline-heading">
                <h4 class="timeline-title">
                	
                	<?php 
                        if($datos['typeNotification'] == 1){
                            echo "Nuevo inventario";
                        }elseif($datos['typeNotification'] == 2){
                            echo "Edito inventario";
                        }elseif($datos['typeNotification'] == 3){
                            echo "Elimino inventario";
                        }elseif($datos['typeNotification'] == 4){
                            echo "Nuevo producto";
                        }elseif($datos['typeNotification'] == 5){
                            echo "Edito producto";
                        }elseif($datos['typeNotification'] == 6){
                            echo "Elimino producto";
                        }elseif($datos['typeNotification'] == 7){
                            echo "Creo empresa";
                        }elseif($datos['typeNotification'] == 8){
                            echo "Creo administrador";
                        }elseif($datos['typeNotification'] == 9){
                            echo "Creo cuenta de deposito";
                        }elseif($datos['typeNotification'] == 10){
                            echo "Creo caja registradora";
                        }elseif($datos['typeNotification'] == 11){
                            echo "Ingreso de deposito";
                        }elseif($datos['typeNotification'] == 16){
                            echo "Edito empresa";
                        }elseif($datos['typeNotification'] == 12){
                            echo "Retiro de deposito";
                        }elseif($datos['typeNotification'] == 17){
                            echo "Edito cuenta de deposito";
                        }elseif($datos['typeNotification'] == 18){
                            echo "Creo empleado";
                        }elseif($datos['typeNotification'] == 19){
                            echo "Edito empleado";
                        }elseif($datos['typeNotification'] == 20){
                            echo "Elimino empleado";
                        }elseif($datos['typeNotification'] == 23){
                            echo "Creo cliente";
                        }elseif($datos['typeNotification'] == 22){
                            echo "Edito cliente";
                        }elseif($datos['typeNotification'] == 21){
                            echo "Elimino cliente";
                        }elseif($datos['typeNotification'] == 24){
                            echo "Creo proveedor";
                        }elseif($datos['typeNotification'] == 25){
                            echo "Edito proveedor";
                        }elseif($datos['typeNotification'] == 26){
                            echo "Elimino proveedor";
                        }elseif($datos['typeNotification'] == 27){
                            echo "Elimino deposito";
                        }elseif($datos['typeNotification'] == 93){
                            echo "Cancelo saldo";
                        }elseif($datos['typeNotification'] == 94){
                            echo "Devolucion";
                        }elseif($datos['typeNotification'] == 95){
                            echo "Cambio";
                        }
                     ?>

                </h4>
                <p><small class="text-muted"><i class="fa fa-clock-o"></i> <?php echo $datos['date_register']; ?></small> </p>
            </div>
            <div class="timeline-body">
               <?php echo $datos['message']; ?> 
               <?php 
               if ($datos['typeNotification'] == 1 OR $datos['typeNotification'] == 2) { ?>
               	<center>
               		<br>

                    <a href=" <?php echo URL; ?>inventarios/detalles?id=<?php echo $datos['inventory_idinventory']; ?>&detalles " class="btn btn-block btn-outline btn-info">Ver detalles</a>
                </center>
             <?php  } ?>
              <?php 
               if ($datos['typeNotification'] == 4 OR $datos['typeNotification'] == 5) { ?>
               	<center>
               		<br>

                    <a href=" <?php echo URL; ?>productos/detalles?id=<?php echo $datos['products_idproducts']; ?>&configurar " class="btn btn-block btn-outline btn-info">Ver detalles</a>
                </center>
             <?php  } ?>
             <?php 
             if ($datos['typeNotification'] == 3 OR $datos['typeNotification'] == 6  OR $datos['typeNotification'] == 20 OR $datos['typeNotification'] == 21 OR $datos['typeNotification'] == 26) { ?>
             	<center>
               		<br>
                    <input href="<?php //echo URL; ?>productos/detalles?id=<?php echo $datos['products_idproducts']; ?> " disabled class="btn btn-block btn-outline btn-danger" value="Ver detalles">
                </center>
            <?php }  ?>
            <?php 
             if ($datos['typeNotification'] == 7 OR $datos['typeNotification'] == 16) { ?>
             	<center>
               		<br>
                    <a href="<?php echo URL; ?>empresa/detalles?id=<?php echo $datos['company_idcompany']; ?> " class="btn btn-block btn-outline btn-info" >Ver detalles</a>
                </center>
            <?php }  ?>
            <?php 
             if ($datos['typeNotification'] == 9 OR $datos['typeNotification'] == 17) { ?>
             	<center>
               		<br>
                    <a href="<?php echo URL; ?>depositos/detalles?id=<?php echo $datos['depositAccount_iddepositAccounts']; ?>&configurar&tipo=activo" class="btn btn-block btn-outline btn-info" >Ver detalles</a>
                </center>
            <?php }  ?>
            <?php 
             if ($datos['typeNotification'] == 18 OR $datos['typeNotification'] == 19) { ?>
             	<center>
               		<br>
                    <a href="<?php echo URL; ?>empleados/detalles?id=<?php echo $datos['users_idusers']; ?>&configurar " class="btn btn-block btn-outline btn-info" >Ver detalles</a>
                </center>
            <?php }  ?>

            <?php 
             if ($datos['typeNotification'] == 23 OR $datos['typeNotification'] == 22) { ?>
             	<center>
               		<br>
                    <a href="<?php echo URL; ?>clientes/detalles?id=<?php echo $datos['users_idusers']; ?>&detalles " class="btn btn-block btn-outline btn-info" >Ver detalles</a>
                </center>
            <?php }  ?>

            <?php 
             if ($datos['typeNotification'] == 25 OR $datos['typeNotification'] == 24) { ?>
              <center>
                  <br>
                    <a href="<?php echo URL; ?>proveedores/detalles?id=<?php echo $datos['users_idusers']; ?>&detalles " class="btn btn-block btn-outline btn-info" >Ver detalles</a>
                </center>
            <?php }  ?>

           

            <?php 
             if ($datos['typeNotification'] == 11 OR $datos['typeNotification'] == 12) { ?>
              <center>
                  <br>
                    <a href="<?php echo URL; ?>depositos/detalles?id=1&fondos" class="btn btn-block btn-outline btn-info" >Ver depositos</a>
                </center>
            <?php }  ?>
             <?php 
             if ($datos['typeNotification'] == 8) { ?>
              <center>
                  <br>
                    <a href="<?php echo URL; ?>empleados/detalles?id=1&configurar&tipo=activo" class="btn btn-block btn-outline btn-info" >Ver perfil</a>
                </center>
            <?php }  ?>

            <?php 
             if ($datos['typeNotification'] == 27) { ?>
              <center>
                  <br>
                    <a href="<?php echo URL; ?>empleados/detalles?id=1&detalles" class="btn btn-block btn-outline btn-info" >Ver deposito eliminado</a>
                </center>
            <?php }  ?>
             <?php 
               if ($datos['typeNotification'] == 96) { ?>
                <center>
                  <br>

                    <a href=" <?php echo URL; ?>productos/detalles?id=<?php echo $datos['products_idproducts']; ?>&configurar " class="btn btn-block btn-outline btn-info">Ver detalles</a>
                </center>
             <?php  } ?>

             <?php 
               if ($datos['typeNotification'] == 97) { ?>
                <center>
                  <br>

                    <a href=" <?php echo URL; ?>productos/detalles?id=<?php echo $datos['products_idproducts']; ?>&configurar " class="btn btn-block btn-outline btn-info">Ver detalles</a>
                </center>
             <?php  } ?>

             <?php 
               if ($datos['typeNotification'] == 98) { ?>
                <center>
                  <br>

                    <a href=" <?php echo URL; ?>productos/detalles?id=<?php echo $datos['products_idproducts']; ?>&configurar " class="btn btn-block btn-outline btn-info">Ver detalles</a>
                </center>
             <?php  } ?>
            

            </div>
        </div>
    </li>
<?php }else{ ?>
	<li class="timeline-inverted">
        <div class="timeline-badge warning">

        			<?php 
                        if($datos['typeNotification'] == 1){ ?>
                        	<img class="img-responsive" alt="user" src="<?php echo URL; ?>views/plugins/images/warehouse_add.jpg"> 
                    <?php  }elseif($datos['typeNotification'] == 2){ ?>
                        	<img class="img-responsive" alt="user" src="<?php echo URL; ?>views/plugins/images/warehouse_update.jpg"> 
                    <?php }elseif($datos['typeNotification'] == 3){ ?>
                        	<img class="img-responsive" alt="user" src="<?php echo URL; ?>views/plugins/images/warehouse_delete.jpg"> 
                    <?php }elseif($datos['typeNotification'] == 4){ ?>
                        	<img class="img-responsive" alt="user" src="<?php echo URL; ?>views/plugins/images/product_add.jpg"> 
                   	<?php  }elseif ($datos['typeNotification'] == 5) { ?>
                        	<img class="img-responsive" alt="user" src="<?php echo URL; ?>views/plugins/images/product_update.jpg"> 
                   	<?php }elseif ($datos['typeNotification'] == 6) { ?>
                        	<img class="img-responsive" alt="user" src="<?php echo URL; ?>views/plugins/images/product_delete.jpg"> 
                   	<?php }elseif ($datos['typeNotification'] == 7) { ?>
                        	<img class="img-responsive" alt="user" src="<?php echo URL; ?>views/plugins/images/company_add.png"> 
                   	<?php }elseif ($datos['typeNotification'] == 8) { ?>
                        	<img class="img-responsive" alt="user" src="<?php echo URL; ?>views/plugins/images/admin_add.png"> 
                   	<?php }elseif ($datos['typeNotification'] == 9) { ?>
                        	<img class="img-responsive" alt="user" src="<?php echo URL; ?>views/plugins/images/deposit_add.png"> 
                   	<?php }elseif ($datos['typeNotification'] == 10) { ?>
                        	<img class="img-responsive" alt="user" src="<?php echo URL; ?>views/plugins/images/cash_add.png"> 
                   	<?php }elseif ($datos['typeNotification'] == 11) { ?>
                        	<img class="img-responsive" alt="user" src="<?php echo URL; ?>views/plugins/images/mov_add.png"> 
                   	<?php }elseif ($datos['typeNotification'] == 16) { ?>
                        	<img class="img-responsive" alt="user" src="<?php echo URL; ?>views/plugins/images/company_update.png"> 
                   	<?php }elseif ($datos['typeNotification'] == 12) { ?>
                        	<img class="img-responsive" alt="user" src="<?php echo URL; ?>views/plugins/images/deposit_retirement.png"> 
                   	<?php }elseif ($datos['typeNotification'] == 17) { ?>
                        	<img class="img-responsive" alt="user" src="<?php echo URL; ?>views/plugins/images/deposit_update.png"> 
                   	<?php }elseif ($datos['typeNotification'] == 18) { ?>
                        	<img class="img-responsive" alt="user" src="<?php echo URL; ?>views/plugins/images/employee_add.png"> 
                   	<?php }elseif ($datos['typeNotification'] == 19) { ?>
                        	<img class="img-responsive" alt="user" src="<?php echo URL; ?>views/plugins/images/employee_update.png"> 
                   	<?php }elseif ($datos['typeNotification'] == 20) { ?>
                        	<img class="img-responsive" alt="user" src="<?php echo URL; ?>views/plugins/images/employee_delete.png"> 
                   	<?php }elseif ($datos['typeNotification'] == 21) { ?>
                        	<img class="img-responsive" alt="user" src="<?php echo URL; ?>views/plugins/images/client_delete.png">  
                   	<?php }elseif ($datos['typeNotification'] == 22) { ?>
                        	<img class="img-responsive" alt="user" src="<?php echo URL; ?>views/plugins/images/client_update.png">  
                   	<?php }elseif ($datos['typeNotification'] == 23) { ?>
                        	<img class="img-responsive" alt="user" src="<?php echo URL; ?>views/plugins/images/client_add.png">  
                   	<?php }elseif ($datos['typeNotification'] == 26) { ?>
                        	<img class="img-responsive" alt="user" src="<?php echo URL; ?>views/plugins/images/provider_delete.png">  
                   	<?php }elseif ($datos['typeNotification'] == 25) { ?>
                        	<img class="img-responsive" alt="user" src="<?php echo URL; ?>views/plugins/images/provider_update.png">  
                   	<?php }elseif ($datos['typeNotification'] == 24) { ?>
                          <img class="img-responsive" alt="user" src="<?php echo URL; ?>views/plugins/images/provider_add.png">  
                    <?php }elseif ($datos['typeNotification'] == 27) { ?>
                          <img class="img-responsive" alt="user" src="<?php echo URL; ?>views/plugins/images/delete.png">  
                    <?php }elseif ($datos['typeNotification'] == 96) { ?>
                          <img class="img-responsive" alt="user" src="<?php echo URL; ?>views/plugins/images/warning.png">  
                    <?php }elseif ($datos['typeNotification'] == 97) { ?>
                          <img class="img-responsive" alt="user" src="<?php echo URL; ?>views/plugins/images/invisible.png">  
                    <?php }elseif ($datos['typeNotification'] == 98) { ?>
                          <img class="img-responsive" alt="user" src="<?php echo URL; ?>views/plugins/images/visibility.png">  
                    <?php }elseif ($datos['typeNotification'] == 93) { ?>
                          <img class="img-responsive" alt="user" src="<?php echo URL; ?>views/plugins/images/cash-back.png">  
                    <?php }elseif ($datos['typeNotification'] == 94) { ?>
                          <img class="img-responsive" alt="user" src="<?php echo URL; ?>views/plugins/images/return.png">  
                    <?php }elseif ($datos['typeNotification'] == 95) { ?>
                          <img class="img-responsive" alt="user" src="<?php echo URL; ?>views/plugins/images/exchange.png">  
                    <?php } ?>



        </div>
        <div class="timeline-panel">
            <div class="timeline-heading">
                <h4 class="timeline-title">
                	
                	<?php 
                        if($datos['typeNotification'] == 1){
                            echo "Nuevo inventario";
                        }elseif($datos['typeNotification'] == 2){
                            echo "Edito inventario";
                        }elseif($datos['typeNotification'] == 3){
                            echo "Elimino inventario";
                        }elseif($datos['typeNotification'] == 4){
                            echo "Nuevo producto";
                        }elseif($datos['typeNotification'] == 5){
                            echo "Edito producto";
                        }elseif($datos['typeNotification'] == 6){
                            echo "Elimino producto";
                        }elseif($datos['typeNotification'] == 7){
                            echo "Creo empresa";
                        }elseif($datos['typeNotification'] == 8){
                            echo "Creo administrador";
                        }elseif($datos['typeNotification'] == 9){
                            echo "Creo cuenta de deposito";
                        }elseif($datos['typeNotification'] == 10){
                            echo "Creo caja registradora";
                        }elseif($datos['typeNotification'] == 11){
                            echo "Ingreso deposito";
                        }elseif($datos['typeNotification'] == 16){
                            echo "Edito empresa";
                        }elseif($datos['typeNotification'] == 12){
                            echo "Retiro de deposito";
                        }elseif($datos['typeNotification'] == 17){
                            echo "Edito cuenta de deposito";
                        }elseif($datos['typeNotification'] == 18){
                            echo "Creo empleado";
                        }elseif($datos['typeNotification'] == 19){
                            echo "Edito empleado";
                        }elseif($datos['typeNotification'] == 20){
                            echo "Elimino empleado";
                        }elseif($datos['typeNotification'] == 23){
                            echo "Creo cliente";
                        }elseif($datos['typeNotification'] == 22){
                            echo "Edito cliente";
                        }elseif($datos['typeNotification'] == 21){
                            echo "Elimino cliente";
                        }elseif($datos['typeNotification'] == 24){
                            echo "Creo proveedor";
                        }elseif($datos['typeNotification'] == 25){
                            echo "Edito proveedor";
                        }elseif($datos['typeNotification'] == 26){
                            echo "Elimino proveedor";
                        }elseif($datos['typeNotification'] == 27){
                            echo "Elimino deposito";
                        }elseif($datos['typeNotification'] == 93){
                            echo "Cancelo saldo";
                        }elseif($datos['typeNotification'] == 94){
                            echo "Devolucion";
                        }elseif($datos['typeNotification'] == 95){
                            echo "Cambio";
                        }
                     ?>

                </h4>
                <p><small class="text-muted"><i class="fa fa-clock-o"></i> <?php echo $datos['date_register']; ?></small> </p>
                
            </div>
            <div class="timeline-body">
              <?php echo $datos['message']; ?> 
               <?php 
               if ($datos['typeNotification'] == 1 OR $datos['typeNotification'] == 2) { ?>
               	<center>
               		<br>

                    <a href=" <?php echo URL; ?>inventarios/detalles?id=<?php echo $datos['inventory_idinventory']; ?>&detalles " class="btn btn-block btn-outline btn-info">Ver detalles</a>
                </center>
             <?php  } ?>
              <?php 
               if ($datos['typeNotification'] == 4 OR $datos['typeNotification'] == 5) { ?>
               	<center>
               		<br>

                    <a href=" <?php echo URL; ?>productos/detalles?id=<?php echo $datos['products_idproducts']; ?>&configurar " class="btn btn-block btn-outline btn-info">Ver detalles</a>
                </center>
             <?php  } ?>
             <?php 
             if ($datos['typeNotification'] == 3 OR $datos['typeNotification'] == 6  OR $datos['typeNotification'] == 20 OR $datos['typeNotification'] == 21 OR $datos['typeNotification'] == 26) { ?>
             	<center>
               		<br>
                    <input href="<?php //echo URL; ?>productos/detalles?id=<?php echo $datos['products_idproducts']; ?> " disabled class="btn btn-block btn-outline btn-danger" value="Ver detalles">
                </center>
            <?php }  ?>
            <?php 
             if ($datos['typeNotification'] == 7 OR $datos['typeNotification'] == 16) { ?>
             	<center>
               		<br>
                    <a href="<?php echo URL; ?>empresa/detalles?id=<?php echo $datos['company_idcompany']; ?> " class="btn btn-block btn-outline btn-info" >Ver detalles</a>
                </center>
            <?php }  ?>
            <?php 
             if ($datos['typeNotification'] == 9 OR $datos['typeNotification'] == 17) { ?>
              <center>
                  <br>
                    <a href="<?php echo URL; ?>depositos/detalles?id=<?php echo $datos['depositAccount_iddepositAccounts']; ?>&configurar&tipo=activo" class="btn btn-block btn-outline btn-info" >Ver detalles</a>
                </center>
            <?php }  ?>
            <?php 
             if ($datos['typeNotification'] == 18 OR $datos['typeNotification'] == 19) { ?>
              <center>
                  <br>
                    <a href="<?php echo URL; ?>empleados/detalles?id=<?php echo $datos['users_idusers']; ?>&configurar " class="btn btn-block btn-outline btn-info" >Ver detalles</a>
                </center>
            <?php }  ?>


            <?php 
             if ($datos['typeNotification'] == 23 OR $datos['typeNotification'] == 22) { ?>
             	<center>
               		<br>
                    <a href="<?php echo URL; ?>clientes/detalles?id=<?php echo $datos['users_idusers']; ?>&detalles " class="btn btn-block btn-outline btn-info" >Ver detalles</a>
                </center>
            <?php }  ?>

            <?php 
             if ($datos['typeNotification'] == 25 OR $datos['typeNotification'] == 24) { ?>
             	<center>
               		<br>
                    <a href="<?php echo URL; ?>proveedores/detalles?id=<?php echo $datos['users_idusers']; ?>&detalles " class="btn btn-block btn-outline btn-info" >Ver detalles</a>
                </center>
            <?php }  ?>
             
            <?php 
             if ($datos['typeNotification'] == 11 OR $datos['typeNotification'] == 12) { ?>
              <center>
                  <br>
                    <a href="<?php echo URL; ?>depositos/detalles?id=1&fondos" class="btn btn-block btn-outline btn-info" >Ver depositos</a>
                </center>
            <?php }  ?>

            <?php 
             if ($datos['typeNotification'] == 8) { ?>
              <center>
                  <br>
                    <a href="<?php echo URL; ?>empleados/detalles?id=1&configurar&tipo=activo" class="btn btn-block btn-outline btn-info" >Ver perfil</a>
                </center>
            <?php }  ?>

            <?php 
             if ($datos['typeNotification'] == 27) { ?>
              <center>
                  <br>
                    <a href="<?php echo URL; ?>empleados/detalles?id=1&detalles" class="btn btn-block btn-outline btn-info" >Ver deposito eliminado</a>
                </center>
            <?php }  ?>

             <?php 
               if ($datos['typeNotification'] == 96) { ?>
                <center>
                  <br>

                    <a href=" <?php echo URL; ?>productos/detalles?id=<?php echo $datos['products_idproducts']; ?>&configurar " class="btn btn-block btn-outline btn-info">Ver detalles</a>
                </center>
             <?php  } ?>

             <?php 
               if ($datos['typeNotification'] == 97) { ?>
                <center>
                  <br>

                    <a href=" <?php echo URL; ?>productos/detalles?id=<?php echo $datos['products_idproducts']; ?>&configurar " class="btn btn-block btn-outline btn-info">Ver detalles</a>
                </center>
             <?php  } ?>

             <?php 
               if ($datos['typeNotification'] == 98) { ?>
                <center>
                  <br>

                    <a href=" <?php echo URL; ?>productos/detalles?id=<?php echo $datos['products_idproducts']; ?>&configurar " class="btn btn-block btn-outline btn-info">Ver detalles</a>
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