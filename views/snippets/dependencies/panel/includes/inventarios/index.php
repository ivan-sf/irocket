<?php 
$modelProducts = new models\Inventory();
$arrayProducts = $modelProducts->array();
$modelPP = new models\Products();
$con = new models\Conexion();
 ?>

<div id="page-wrapper">
        <div class="container-fluid">

            <div class="row bg-title">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h4 class="page-title">Inventarios</h4>
                </div>
                <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                    <ol class="breadcrumb">
                        <li><a href="#">Panel</a></li>
                        <li><a href="#">Inventarios</a></li>
                        <li class="active">Catalogo</li>
                    </ol>
                </div>
            </div>

                
            

                    <button class="btn m-btn--pill btn-badge" type="submit"><a href="<?php echo URL; ?>inventarios/tabla?index" class="">Tabla</a></button>
                    <button class="btn m-btn--pill btn-badge"><a href="<?php echo URL; ?>inventarios/crear">Crear</a></button><br>
                <br>

                <div class="row">
                    

                     <div class="col-lg-6 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row p-t-10 p-b-10">
                                    <!-- Column -->
                                    <div class="col p-r-0">
                                        <h1 class="font-light">
                                            <?php 
                                                $sql2 = "SELECT * FROM products
                                                        WHERE stateBD = 1";
                                                $query2 = $con->returnConsulta($sql2);
                                                $total2 = 0;
                                                while ($array = mysqli_fetch_array($query2)) {
                                                    $total2 += $array['quantityProduct'];
                                                }
                                                echo number_format(mysqli_num_rows($query2));
                                            ?>
                                        </h1>
                                        <h6 class="text-muted">Cantidad total de productos en Inventarios</h6></div>
                                    <!-- Column -->
                                    <div class="col text-right align-self-center">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row p-t-10 p-b-10">
                                    <!-- Column -->
                                    <div class="col p-r-0">
                                        <h1 class="font-light">
                                            <?php 
                                                $sql2 = "SELECT * FROM products
                                                        WHERE stateBD = 1";
                                                $query2 = $con->returnConsulta($sql2);
                                                $total2 = 0;
                                                while ($array = mysqli_fetch_array($query2)) {
                                                    $total2 += $array['quantityProduct'];
                                                }
                                                echo number_format($total2);
                                            ?>
                                        </h1>
                                        <h6 class="text-muted">Cantidad total de items en Inventarios</h6></div>
                                    <!-- Column -->
                                    <div class="col text-right align-self-center">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><br>

                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row p-t-10 p-b-10">
                                    <!-- Column -->
                                    <div class="col p-r-0">
                                        <h1 class="font-light">
                                            <?php 
                                                $id = 1;
                                                $sql = "SELECT * FROM products
                                                        INNER JOIN productdetails
                                                        ON idproducts=products_idproducts 
                                                        WHERE stateBD = 1";
                                                $query = $con->returnConsulta($sql);
                                                $datos = mysqli_num_rows($query);
                                                $total = 0;
                                                while ($array = mysqli_fetch_array($query)) {
                                                    $total += $array['price_buy']*$array['quantityProduct'];
                                                }
                                                $sql2 = "SELECT * FROM movementdepositaccount
                                                        WHERE typeMovement = 9";
                                                $query2 = $con->returnConsulta($sql2);
                                                $total2 = 0;
                                                while ($array = mysqli_fetch_array($query2)) {
                                                    $total2 += $array['saldo'];
                                                }
                                                echo number_format($total);
                                            ?>
                                        </h1>
                                        
                                        <h6 class="text-muted">Valor actual de inventarios</h6></div>
                                    <!-- Column -->
                                    <div class="col text-right align-self-center">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                     <div class="col-lg-4 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row p-t-10 p-b-10">
                                    <!-- Column -->
                                    <div class="col p-r-0">
                                        <h1 class="font-light">
                                            <?php 
                                                $sql2 = "SELECT * FROM movementdepositaccount
                                                        WHERE typeMovement = 9";
                                                $query2 = $con->returnConsulta($sql2);
                                                $total2 = 0;
                                                while ($array = mysqli_fetch_array($query2)) {
                                                    $total2 += $array['saldo'];
                                                }
                                                echo number_format($total2);
                                            ?>
                                        </h1>
                                        <h6 class="text-muted">Cuentas por pagar</h6></div>
                                    <!-- Column -->
                                    <div class="col text-right align-self-center">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                     <div class="col-lg-4 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row p-t-10 p-b-10">
                                    <!-- Column -->
                                    <div class="col p-r-0">
                                        <h1 class="font-light"><?php echo number_format($total+$total2); ?></h1>
                                        <h6 class="text-muted">Balance total de inventarios</h6></div>
                                    <!-- Column -->
                                    <div class="col text-right align-self-center">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                    <?php  if (isset($_GET['success_update'])) {
                    echo "
                    <div class='m-alert m-alert--icon m-alert--air m-alert--square alert alert-success alert-dismissible fade show' role='alert' id='alertabien'>
                    <div class='m-alert__icon'>
                    <i class='flaticon-rocket'></i>
                    </div>
                    <div class='m-alert__text'>
                    <center>
                        <strong>
                    Perfecto !
                    </strong>
                    Se editaron los fondos de la cuenta de depositos correctamente puedes ver el resultado acontinuacion.

                    </center>
                    </div>
                    <div class='m-alert__close'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'></button>
                    </div>
                    </div>";
                }elseif (isset($_GET['error'])) {
                    echo "
                    <div class='m-alert m-alert--icon m-alert--air m-alert--square alert alert-danger alert-dismissible fade show' role='alert' id='alertabien'>
                    <div class='m-alert__icon'>
                    <i class='flaticon-rocket'></i>
                    </div>
                    <div class='m-alert__text'>
                    <center>
                        <strong>
                    Lo sentimos !
                    </strong>
                    El inventario al que intentas acceder no existe o ha sido eliminado.

                    </center>
                    </div>
                    <div class='m-alert__close'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'></button>
                    </div>
                    </div>";
                }?>
                
                


                     <div class="row">
                                

                                <div class="col-lg-12">
                                    <?php $row=mysqli_num_rows($arrayProducts);
                                    if ($row <= 0) { ?>
                                         <center>
                                        <h4><b>No se encontraron inventarios activos.</b></h4>
                                         <button class="btn m-btn--pill btn-success"><a class="text-white" href="<?php echo URL; ?>inventarios/crear">Crear inventarios</a></button>
                                         </center>
                                     <?php } ?>
                                </div>

                                <?php while($datos = mysqli_fetch_array($arrayProducts)) { ?>
                               <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
                                    <div class="white-box">
                                        <div class="product-img">
                                            <img width="190" src="<?php echo URL ?>views/plugins/images/warehouse.png">
                                            <div class="pro-img-overlay">
                                                <a href="<?php echo URL; ?>inventarios/detalles?id=<?php echo $datos['idinventory']; ?>&detalles" class="bg-info"><i class="ti-eye"></i></a> 
                                                <a href="<?php echo URL; ?>inventarios/detalles?id=<?php echo $datos['idinventory']; ?>&configurar" class="bg-warning"><i class="ti-marker-alt"></i></a> 
                                                <a href="<?php echo URL; ?>inventarios/detalles?id=<?php echo $datos['idinventory']; ?>&eliminar" class="bg-danger"><i class="ti-trash"></i></a>
                                            </div>
                                        </div>
                                        <div class="product-text">
                                            <?php $arrayPP = $modelPP->arrayInventory($datos['idinventoryDetails']); ?>
                                            <span class="pro-price bg-danger">
                                                <?php 
                                                    $numPP = mysqli_num_rows($arrayPP);
                                                    echo $numPP;
                                                ?>
                                            </span>
                                            <h3 class="box-title m-b-0"><?php echo $datos['nameInventory']; ?></h3>
                                            <small class="text-muted db"><?php echo $datos['descriptionInventory']; ?></small>
                                        </div>
                                    </div>
                                </div>
                                 <?php } ?>
                                        </div>
            </div>

</div>

<script>
                                    
$(document).ready(function () {
//$("#alertabien").slideUp(5000).delay(5000);

    $('#alertabien').delay(5000).slideToggle(1000, function () {
        $('#alertabien').removeClass("show");
    });
    return false;
});

</script>
