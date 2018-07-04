<?php 
    $modelInventory = new models\Inventory();
    $modelMovements = new models\Movements();
    $con = new models\Conexion();
    $arrayInventory = $modelInventory->array();
    $dataTodayActive = $modelMovements->todayActive();
    $dataTodayPassive = $modelMovements->todayPassive();
    $dataTodayToCharge = $modelMovements->todayToCharge();
    $dataTodayToPay = $modelMovements->todayToPay();
    $dataTodayListDeposit = $modelMovements->todayListDeposit();
    $dataTodayListRetreats = $modelMovements->todayListRetreats();
    $rowInventory = $modelInventory->row();
    $totalA = 0;
    while ( $totalActive = mysqli_fetch_array($dataTodayActive)) {
         $totalA += $totalActive['totalMoney']; 
     } ;
    $totalP = 0;
    while ( $totalPassive = mysqli_fetch_array($dataTodayPassive)) {
         $totalP += $totalPassive['totalMoney']; 
     } ;
 ?>
<div id="page-wrapper" style="min-height: 953px;">

            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Reportes</h4> </div>
                        


                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                    <ol class="breadcrumb">
                        <li><a href="#">Panel</a></li>
                        <li class="active">Reportes</li>
                    </ol>
                </div>
                    <!-- /.col-lg-12 -->
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="white-box bg-inverse">
                            <h4 class="text-white"><b><center>REPORTES DIARIOS</center></b></h4>
                        </div>
                    </div>
                </div>





                <div class="row">

                    

                    <div class="col-lg-4">
                        <div class="white-box">
                            <h4 class="box-title text-primary">INGRESOS HOY</h4>

                            <ul class="list-inline two-part">
                                <li><i class="ti-shopping-cart text-primary"></i></li>
                                   

                                <h3><li class="text-right text-primary">$<span class="counter"><?php echo number_format($totalA) ?></span></li></h3>
                            </ul>
                        </div>
                        <div class="white-box">
                            <h4 class="box-title text-danger">GASTOS HOY</h4>

                            <ul class="list-inline two-part">
                                <li><i class="ti-cut text-danger"></i></li>
                                   

                                <h3><li class="text-right text-danger">$<span class="counter"><?php echo number_format($totalP) ?></span></li></h3>
                            </ul>
                        </div>
                       
                    </div>

                    <div class="col-lg-8">
                        <div class="white-box">
                            <h3 class="box-title">Balance diario</h3>
                            <div>
                                <canvas id="chart4" height="348" width="697" style="width: 697px; height: 348px;"> </canvas>
                            </div>
                        </div>
                    </div>

                   
                </div>
                <div class="row">
                    <div class="col-lg-12">
                            <div class="white-box text-center">
                                <h1 class="text-success">$<span class="counter"><b><?php echo number_format($totalA-$totalP) ?></b></span></h1>
                                <h2 class="box-title text-success"><b>BALANCE HOY</b></h2>
                            </div>


                    </div>
                </div>
                <?php 
                $modelMov = new models\BillReports();
                $atA = $modelMov->AllBillsDayActive();
                $atP = $modelMov->AllBillsDayPassive();
                $atT = $modelMov->AllBillsDay();
                $totalA = 0;
                $totalRA = mysqli_num_rows($atA);
                $totalRP = mysqli_num_rows($atP);
                $totalRT = mysqli_num_rows($atT);
                while ($dataA = mysqli_fetch_array($atA)) {
                    $totalA += $dataA['totalMoney'];
                }
                
                 ?>
                

               <div class="row">
                    
                    <div class="col-lg-4 col-md-4">
                        <div class="white-box">
                            <h3 class="box-title"># VENTAS HOY</h3>
                            <div class="text-right"> <span class="text-muted">Total ventas del dia</span>
                                <h1><sup><i class="ti-arrow-up text-success"></i></sup> <?php echo $totalRA; ?></h1> </div> 
                           
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="white-box">
                            <h3 class="box-title"># COMPRAS HOY</h3>
                            <div class="text-right"> <span class="text-muted">Total compras del dia</span>
                                <h1><sup><i class="ti-arrow-up text-success"></i></sup> <?php echo $totalRP; ?></h1> </div>
                            
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-4">
                        <div class="white-box">
                            <h3 class="box-title"># FACTURAS HOY</h3>
                            <div class="text-right"> <span class="text-muted">Total facturas del dia</span>
                                <h1><sup><i class="ti-arrow-up text-success"></i></sup> <?php echo $totalRT; ?></h1> </div> 
                        </div>
                    </div>
               </div>

               <div class="row">
                    <div class="col-lg-12">
                        <div class="white-box bg-inverse">
                            <h4 class="text-white"><b><center>REPORTES GENERALES</center></b></h4>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="white-box">
                            <h3 class="box-title"><i class="ti-shopping-cart text-success"></i> Depositos</h3>
                            <div class="text-center"> <span class="text-muted">Lista de depositos</span>
                                <div class="list-group"><br>
                                      <?php 
                                            while ( $listDeposits = mysqli_fetch_array($dataTodayListDeposit)) {?>
                                    <a href="#">
                                      

                                        <button type="button" class="list-group-item">
                                            <span class="badge badge-success"><?php echo number_format($listDeposits['totalMoney']); ?></span>
                                            <?php echo $listDeposits['dataRegister']; ?>
                                        </button></a>
                                        <?php } ?> 
                                        
                                </div>
                            </div>
                           
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="white-box">
                            <h3 class="box-title"><i class="ti-shopping-cart text-success"></i> Retiros</h3>
                            <div class="text-center"> <span class="text-muted">Lista de retiros</span>
                                <div class="list-group"><br>
                                      <?php 
                                            while ( $listRetreats = mysqli_fetch_array($dataTodayListRetreats)) {?>
                                    <a href="#">
                                      

                                        <button type="button" class="list-group-item">
                                            <span class="badge badge-danger"><?php echo number_format($listRetreats['totalMoney']); ?></span>
                                            <?php echo $listRetreats['dataRegister']; ?>
                                        </button></a>
                                        <?php } ?> 
                                        
                                </div>
                            </div>
                           
                        </div>
                    </div>
                </div>



                <div class="row">
                    
                    <div class="col-lg-4 col-md-4">
                        <div class="white-box">
                            <h3 class="box-title">Valor actual de inventarios</h3>
                            <div class="text-right">
                                <h1><sup><i class="ti-arrow-up text-info"></i></sup>

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

                                </h1> </div> 
                           
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="white-box">
                            <h3 class="box-title">Cuentas por pagar de inventarios</h3>
                            <div class="text-right">
                                <h1><sup><i class="ti-arrow-down text-danger"></i></sup>

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

                                </h1> </div> 
                           
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="white-box">
                            <h3 class="box-title">Balance total de inventarios</h3>
                            <div class="text-right">
                                <h1><sup><i class="ti-arrow-up text-success"></i></sup> <?php echo number_format($total+$total2); ?></h1> </div> 
                           
                        </div>
                    </div>
                    

                </div>


                <?php 
                $modelMov = new models\Movements();
                $atA = $modelMov->alltimeActive();
                $atP = $modelMov->alltimePassive();
                $totalA = 0;
                while ($dataA = mysqli_fetch_array($atA)) {
                    $totalA += $dataA['totalMoney'];
                }
                $totalP = 0;
                while ($dataP = mysqli_fetch_array($atP)) {
                    $totalP += $dataP['totalMoney'];
                }
                 ?>
                <div class="row">
                        <div class="col-md-6 col-lg-6 col-xs-12">
                        <div class="white-box">
                            <h3 class="box-title">Balance general</h3>
                            <div id="morris-donut-chart"></div>
                        </div>

                    </div>

                <?php 
                $modelMov = new models\Movements();
                $atA = $modelMov->toPayAll();
                $atP = $modelMov->toChargeAll();
                $totalA = 0;
                while ($dataA = mysqli_fetch_array($atA)) {
                    $totalA += $dataA['saldo'];
                }
                $totalP = 0;
                while ($dataP = mysqli_fetch_array($atP)) {
                    $totalP += $dataP['saldo'];
                }
                 ?>
                    <div class="col-lg-6">
                            <div class="white-box text-center">
                                <br><h1 class="counter"><?php echo number_format($totalA); ?></h1>
                                <p class="text-muted"><b>TOTAL POR PAGAR</b></p><br><br>
                            </div>

                            <div class="white-box text-center">
                               <br> <h1 class="counter"><?php echo number_format($totalP); ?></h1>
                                <p class="text-muted"><b>TOTAL POR COBRAR</b> </p><br><br>
                            </div>

                    </div>

                </div>

                   <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="white-box">
                            <h3 class="box-title"><i class="ti-shopping-cart text-success"></i> Cuentas por cobrar</h3>

                            <div class="text-center"> <span class="text-muted">Presione en la factura</span>

                                <div class="list-group"><br>
                                      <?php 
                                            while ( $totalToCharge = mysqli_fetch_array($dataTodayToCharge)) {?>
                                    <a href="<?php echo URL; ?>facturas/detalles?id=<?php echo $totalToCharge['bills_idbills']; ?>&detalles">
                                      

                                        <button type="button" class="list-group-item">
                                            <span class="badge badge-danger"><?php echo number_format($totalToCharge['saldo']); ?></span>
                                            Factura # <?php echo $totalToCharge['bills_idbills']; ?>
                                        </button></a>
                                        <?php } ?> 
                                        
                                </div>

                            </div>

                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="white-box">
                            <h3 class="box-title"><i class="ti-shopping-cart text-success"></i> Cuentas por pagar</h3>

                            <div class="text-center"> <span class="text-muted">Presione en la factura</span>

                                
                                <div class="list-group"><br>
                                      <?php 
                                            while ( $totalToPay = mysqli_fetch_array($dataTodayToPay)) {?>
                                    <a href="<?php echo URL; ?>facturas/detalles?id=<?php echo $totalToPay['bills_idbills']; ?>&detalles">
                                      

                                        <button type="button" class="list-group-item">
                                            <span class="badge badge-danger"><?php echo number_format($totalToPay['saldo']); ?></span>
                                            Factura # <?php echo $totalToPay['bills_idbills']; ?>
                                        </button></a>
                                        <?php } ?> 
                                        
                                </div>

                            </div>

                        </div>
                    </div>

                  

                         
                    </div>  
                <?php 
                $modelMov = new models\ProductsReports();
                $atA = $modelMov->AllProductsActive();
                $atPB = $modelMov->AllProductsActive();
                $atPS = $modelMov->AllProductsActive();
                $atI = $modelMov->AllProductsInactive();
                $atTP = $modelMov->ProductsTopSale();
                $atTA = $modelMov->ProductsLimit();
                $totalA = mysqli_num_rows($atA);
                $totalI = mysqli_num_rows($atI);
                $totalPB = 0;
                while ($dataA = mysqli_fetch_array($atPB)) {
                    $totalPB += $dataA['totalBuy'];
                }
                $totalPS = 0;
                while ($dataA = mysqli_fetch_array($atPS)) {
                    $totalPS += $dataA['totalSales']+$dataA['totalSales_prom'];
                }
                $totalPI = 0;
                while ($dataA = mysqli_fetch_array($atA)) {
                    if ($dataA['quantityProduct'] >= 0) {
                        $totalPI += $dataA['totalItemsInventory'];
                    }
                }

                 ?>
                <div class="row">
                    <div class="col-lg-6 col-sm-6 col-xs-12">
                        <div class="white-box">
                            <h3 class="box-title">PRODUCTOS REGISTRADOS</h3>
                            <ul class="list-inline two-part">
                                <li><i class="icon-plus text-info"></i></li>
                                <li class="text-right"><span class="counter"><?php echo number_format($totalA); ?></span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-xs-12">
                        <div class="white-box">
                            <h3 class="box-title">PRODUCTOS ELIMINADOS</h3>
                            <ul class="list-inline two-part">
                                <li><i class="icon-close text-info"></i></li>
                                <li class="text-right"><span class="counter"><?php echo number_format($totalI) ?></span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 col-xs-12">
                        <div class="white-box">
                            <h3 class="box-title">ITEMS COMPRADOS</h3>
                            <ul class="list-inline two-part">
                                <li><i class="icon-folder text-purple"></i></li>
                                <li class="text-right"><span class="counter"><?php echo number_format($totalPB); ?></span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 col-xs-12">
                        <div class="white-box">
                            <h3 class="box-title">ITEMS VENDIDOS</h3>
                            <ul class="list-inline two-part">
                                <li><i class="icon-folder-alt text-danger"></i></li>
                                <li class="text-right"><span class="counter"><?php echo number_format($totalPS); ?></span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 col-xs-12">
                        <div class="white-box">
                            <h3 class="box-title">ITEMS EN INVENTARIOS</h3>
                            <ul class="list-inline two-part">
                                <li><i class="ti-wallet text-success"></i></li>
                                <li class="text-right"><span class="counter"><?php echo number_format($totalPI); ?></span></li>
                            </ul>
                        </div>
                    </div>
                </div>
                    
                <div class="row">
                    <div class="col-md-12 col-lg-6 col-sm-12">
                        <div class="white-box">
                          
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <h2><center>Top ventas</center> </h2>
                                    <p><center>5 Productos mas vendidos</center></p>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>NOMBRE</th>
                                            <th>VENTAS</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 0;
                                        while ($dataA = mysqli_fetch_array($atTP)) { $i++?>
                                        <tr>
                                            <?php if ($dataA['totalSales']+$dataA['totalSales_prom']<=0) {
                                                # code...
                                            } else{?>
                                            <td><?php echo $i; ?></td>
                                            <td class="txt-oflo"><?php echo $dataA['nameProduct']; ?></td>
                                            <td><span class="label label-success label-rouded"><?php echo $dataA['totalSales']+$dataA['totalSales_prom']; ?></span> </td>
                                        </tr>
                                        <?php }} ?>
                                        
                                       
                                    </tbody>
                                </table> </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-6 col-sm-12">
                        <div class="white-box">
                          
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <h2><center>Productos agotados</center></h2>
                                    <p><center>Lista de productos no disponibles</center></p>
                                </div>
    
                            </div>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>NOMBRE</th>
                                            <th>VENTAS</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 0;
                                        while ($dataA = mysqli_fetch_array($atTA)) { $i++?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td class="txt-oflo"><?php echo $dataA['nameProduct']; ?></td>
                                            <td><span class="label label-success label-rouded"><?php echo $dataA['quantityProduct']; ?></span> </td>
                                        </tr>
                                        <?php } ?>
                                        
                                       
                                    </tbody>
                                </table> </div>
                        </div>
                    </div>
                </div>


                <?php 
                    $modelMov = new models\UserReports();
                    $atA = $modelMov->allUsersA();
                    $atI = $modelMov->allUsersI();
                    $atC = $modelMov->allUsersC();
                    $atE = $modelMov->allUsersE();
                    $atP = $modelMov->allUsersP();
                    $totalA = mysqli_num_rows($atA);
                    $totalI = mysqli_num_rows($atI);
                    $totalC = mysqli_num_rows($atC);
                    $totalE = mysqli_num_rows($atE);
                    $totalP = mysqli_num_rows($atP);
                ?> 
    
                <div class="row">
                    <div class="col-lg-6 col-sm-6 col-xs-12">
                        <div class="white-box">
                            <h3 class="box-title">USUARIOS REGISTRADOS</h3>
                            <ul class="list-inline two-part">
                                <li><i class="icon-people text-info"></i></li>
                                <li class="text-right"><span class="counter"><?php echo number_format($totalA-1); ?></span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-xs-12">
                        <div class="white-box">
                            <h3 class="box-title">USUARIOS ELIMINADOS</h3>
                            <ul class="list-inline two-part">
                                <li><i class="icon-people text-info"></i></li>
                                <li class="text-right"><span class="counter"><?php echo number_format($totalI); ?></span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 col-xs-12">
                        <div class="white-box">
                            <h3 class="box-title">CLIENTES</h3>
                            <ul class="list-inline two-part">
                                <li><i class="icon-folder text-purple"></i></li>
                                <li class="text-right"><span class="counter"><?php echo number_format($totalC); ?></span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 col-xs-12">
                        <div class="white-box">
                            <h3 class="box-title">PROVEEDORES</h3>
                            <ul class="list-inline two-part">
                                <li><i class="icon-folder-alt text-danger"></i></li>
                                <li class="text-right"><span class="counter"><?php echo number_format($totalP); ?></span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 col-xs-12">
                        <div class="white-box">
                            <h3 class="box-title">EMPLEADOS</h3>
                            <ul class="list-inline two-part">
                                <li><i class="ti-wallet text-success"></i></li>
                                <li class="text-right"><span class="counter"><?php echo number_format($totalE); ?></span></li>
                            </ul>
                        </div>
                    </div>
                </div>
                
               

                    


                
                

                        <!-- /.row -->
                
             


                    

                   
                         


               



                     

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


                                        <script src="<?php echo (URL); ?>views/plugins/bower_components/Chart.js/chartjs.init.js"></script> 
