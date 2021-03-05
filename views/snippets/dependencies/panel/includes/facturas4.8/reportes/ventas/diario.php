<?php 
$con = new models\Conexion();
$fecha=$_GET['fecha'];
$modelMov = new models\Movements();
$modelBills = new models\Bills();
$totalDiaVentas = $modelBills->ingresosDiaPosFD($_GET['fecha']);
$totalDiaVentasElec = $modelBills->ingresosDiaElecFD($_GET['fecha']);
$totalDiaVentasRem = $modelBills->ingresosDiaRemFD($_GET['fecha']);

$comprasDiaPosFD = $modelBills->comprasDiaPosFD($_GET['fecha']);
$comprasDiaElecFD = $modelBills->comprasDiaElecFD($_GET['fecha']);
$comprasDiaRemFD = $modelBills->comprasDiaRemFD($_GET['fecha']);

$totalDiaCompras = $modelBills->comprasDia($_GET['fecha']);
$iva19 = $modelBills->iva19($_GET['fecha']);
$iva5 = $modelBills->iva5($_GET['fecha']);
$iva19C = $modelBills->iva19C($_GET['fecha']);
$iva5C = $modelBills->iva5C($_GET['fecha']);
$listaDevoluciones = $modelMov->listaDevoluciones();


$totalVentasDiario = 0;
$totalVentasDiarioElec = 0;
$totalVentasDiarioRem = 0;

$totalComprasDiario = 0;
$totalComprasDiarioElec = 0;
$totalComprasDiarioRem = 0;

$totalIva19 = 0;
$totalIva5 = 0;

$totalIva19C = 0;
$totalIva5C = 0;

while ($dataA = mysqli_fetch_array($totalDiaVentas)) {
    $totalVentasDiario += $dataA['precioTotal'];
}

while ($dataAA = mysqli_fetch_array($totalDiaVentasElec)) {
    $totalVentasDiarioElec += $dataAA['total'];
}

while ($dataAAA = mysqli_fetch_array($totalDiaVentasRem)) {
    $totalVentasDiarioRem += $dataAAA['precioTotal'];
}

while ($dataA = mysqli_fetch_array($comprasDiaPosFD)) {
    $totalComprasDiario += $dataA['precioTotal'];
}

while ($dataAA = mysqli_fetch_array($comprasDiaElecFD)) {
    $totalComprasDiarioElec += $dataAA['total'];
}

while ($dataAAA = mysqli_fetch_array($comprasDiaRemFD)) {
    $totalComprasDiarioRem += $dataAAA['precioTotal'];
}

while ($dataI19 = mysqli_fetch_array($iva19)) {
    $totalIva19 += $dataI19['impuesto'];
}



while ($dataI5 = mysqli_fetch_array($iva5)) {
    $totalIva5 += $dataI5['impuesto'];
}

while ($dataI19 = mysqli_fetch_array($iva19C)) {
    $totalIva19C += $dataI19['impuesto'];
}



while ($dataI5 = mysqli_fetch_array($iva5C)) {
    $totalIva5C += $dataI5['impuesto'];
}



$atA = $modelMov->dayActiveV($_GET['fecha']);
$atA = $modelMov->dayActiveV($_GET['fecha']);
$atB = $modelMov->dayActiveV($_GET['fecha']);
$atP = $modelMov->dayPassiveV($_GET['fecha']);
$atDA = $modelMov->daytimeActiveD($_GET['fecha']);
$atDP = $modelMov->daytimePassiveD($_GET['fecha']);
$totalA = 0;
while ($dataA = mysqli_fetch_array($atA)) {
    $totalA += $dataA['totalMoney'];
}

$sql = "SELECT * FROM bills INNER JOIN billdetails ON bills.idbills=billdetails.bills_idbills 
WHERE
bills.dateRegister='$fecha' AND bills.typeBill=1 AND stateBillDetail=2 OR
bills.dateRegister='$fecha' AND bills.typeBill=2 AND stateBillDetail=2 OR
bills.dateRegister='$fecha' AND bills.typeBill=3 AND stateBillDetail=2
";
$query = $con->returnConsulta($sql);
$datosA = mysqli_num_rows($query);
$totalB = 0;
while ($datosB=mysqli_fetch_array($query)) {
    $totalB += $datosB['pUnidadCompra']*$datosB['cantidad'];
}
$totalC = $totalVentasDiario+$totalVentasDiarioElec+$totalVentasDiarioRem-$totalB;


/*
 $idBill = $dataA['bills_idbills'];
    $sql = "SELECT * FROM billdetails WHERE bills_idbills='$idBill'";
    $query = $con->returnConsulta($sql);
    $totalB += $dataA['totalMoney'];
*/
$totalP = 0;
while ($dataP = mysqli_fetch_array($atP)) {
    $totalP += $dataP['totalMoney'];
}
$totalDA = 0;
while ($dataDA = mysqli_fetch_array($atDA)) {
    $totalDA += $dataDA['totalMoney'];
}

$totalDP = 0;
while ($dataDP = mysqli_fetch_array($atDP)) {
    $totalDP += $dataDP['totalMoney'];
}

 ?>
<div id="page-wrapper" style="min-height: 923px;">
            <div class="container-fluid">
                <div class="row bg-title">
                    <!-- .page title -->
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Reportes</h4>
                    </div>
                    <!-- /.page title -->
                    <!-- .breadcrumb -->
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <ol class="breadcrumb">
                            <li><a href="#">Reportes</a></li>
                            <li><a href="#">Ventas</a></li>
                            <li class="active">Diario</li>
                        </ol>
                    </div>
                    <!-- /.breadcrumb -->
                </div>
               
                <!-- .row -->
                <div class="row">

                    <div class="col-md-12">
                        <div class="white-box">
                            <form action="views/snippets/layout/pages/facturas/ventas/reportediario.php" method="GET" id="formulario">
                                <div class="row">
                                    <div class="col-lg-6">
                                    <input class="form-control" type="date" id="fecha" name="fecha" value="<?php echo $_GET['fecha'] ?>"><br>
                                    
                                </div>
                                <div class="col-lg-6">
                                    <button type="submit" class="btn btn-block btn-outline btn-success">Consultar</button>
                                    
                                </div>
                                </div>
    
                            </form>
                        </div>

                        <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="white-box text-center bg-success">
                                    <h1 class="text-white counter"><?php echo number_format($totalVentasDiario); ?> </h1>
                                    <p class="text-white">Ingreso total de ventas POS</p>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="white-box text-center bg-success">
                                    <h1 class="text-white counter"><?php echo number_format($totalVentasDiarioElec); ?> </h1>
                                    <p class="text-white">Ingreso total de ventas Electronica</p>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="white-box text-center bg-success">
                                    <h1 class="text-white counter"><?php echo number_format($totalVentasDiarioRem); ?> </h1>
                                    <p class="text-white">Ingreso total de ventas Remision</p>
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-6 col-xs-12">
                                <div class="white-box text-center bg-success">
                                    <h1 class="text-white counter"><?php echo number_format($totalIva19); ?> </h1>
                                    <p class="text-white">Iva 19% Facturas de venta legales</p>
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-6 col-xs-12">
                                <div class="white-box text-center bg-success">
                                    <h1 class="text-white counter"><?php echo number_format($totalIva5); ?> </h1>
                                    <p class="text-white">Iva 5% Facturas de venta legales</p>
                                </div>
                            </div>


                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="white-box text-center bg-danger">
                                    <h1 class="text-white counter"><?php echo number_format($totalComprasDiario); ?> </h1>
                                    <p class="text-white">Gasto total de compras POS</p>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="white-box text-center bg-danger">
                                    <h1 class="text-white counter"><?php echo number_format($totalComprasDiarioElec); ?> </h1>
                                    <p class="text-white">Gasto total de compras Electronica</p>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="white-box text-center bg-danger">
                                    <h1 class="text-white counter"><?php echo number_format($totalComprasDiarioRem); ?> </h1>
                                    <p class="text-white">Gasto total de compras POS</p>
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-6 col-xs-12">
                                <div class="white-box text-center bg-danger">
                                    <h1 class="text-white counter"><?php echo number_format($totalIva19C); ?> </h1>
                                    <p class="text-white">Iva 19% Facturas de compra legales</p>
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-6 col-xs-12">
                                <div class="white-box text-center bg-danger">
                                    <h1 class="text-white counter"><?php echo number_format($totalIva5C); ?> </h1>
                                    <p class="text-white">Iva 5% Facturas de compra legales</p>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="white-box text-center bg-success">
                                    <h1 class="text-white counter"><?php echo number_format($totalDA); ?> </h1>
                                    <p class="text-white">Ingreso total de depositos</p>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="white-box text-center bg-danger">
                                    <h1 class="text-white counter"><?php echo number_format($totalDP); ?> </h1>
                                    <p class="text-white">Retiro total de depositos + Devoluciones</p>
                                </div>
                            </div>

                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="white-box">
                                <h3 class="box-title"><i class="ti-shopping-cart text-success"></i> Devoluciones</h3>
                                <div class="text-center"> <span class="text-muted">Lista de devoluciones</span>
                                    <div class="list-group"><br>
                                        <?php 
                                        $totalDev=0;
                                                while ( $listDeposits = mysqli_fetch_array($listaDevoluciones)) {
                                                $totalDev += $listDeposits['totalMoney'];   ?>
                                        <a href="facturas/detalles?id=<?php echo $listDeposits['bills_idbills']; ?>&detalles">
                                        

                                            <button type="button" class="list-group-item">
                                                <span class="badge badge-success"><?php echo number_format($listDeposits['totalMoney']); ?></span>
                                                <?php if($listDeposits['typeMovement']==2){
                                                    echo "Factura  de venta #" . $listDeposits['bills_idbills']; 
                                                } ?>
                                                <?php if($listDeposits['typeMovement']==1){
                                                    echo "Factura  de compra #" . $listDeposits['bills_idbills']; 
                                                } ?>
                                            </button></a>
                                            <?php } ?>       
                                    </div>
                                </div>
                            </div>
                        </div>   

                        </div>

                        <div class="row">

                            <div class="col-md-6 col-lg-6 col-xs-12">
                                <div class="white-box text-center bg-primary">
                                    <h1 class="text-white counter"><?php echo number_format($totalVentasDiario+$totalVentasDiarioElec+$totalVentasDiarioRem-$totalDev); ?> </h1>
                                    <p class="text-white">Ingreso total ventas</p>
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-6 col-xs-12">
                                <div class="white-box text-center bg-primary">
                                    <h1 class="text-white counter"><?php echo number_format($totalB); ?> </h1>
                                    <p class="text-white">Inversion total compras</p>
                                </div>
                            </div>

                            <div class="col-md-4 col-lg-4 col-xs-12">
                                <div class="white-box text-center bg-success">
                                    <h1 class="text-white counter"><?php echo number_format($totalVentasDiario+$totalVentasDiarioElec+$totalVentasDiarioRem-$totalDev); ?> </h1>
                                    <p class="text-white">Costo productos</p>
                                </div>
                            </div>

                            <div class="col-md-4 col-lg-4 col-xs-12">
                                <div class="white-box text-center bg-danger">
                                    <h1 class="text-white counter"><?php echo number_format($totalB); ?> </h1>
                                    <p class="text-white">Inversion productos</p>
                                </div>
                            </div>

                            <div class="col-md-4 col-lg-4 col-xs-12">
                                <div class="white-box text-center bg-info">
                                    <h1 class="text-white counter"><?php echo number_format($totalC-$totalDev); ?> </h1>
                                    <p class="text-white">Ganancia productos</p>
                                </div>
                            </div>
                        </div>

                       



                  

                    </div>


                   
                    </div>
                </div>
            </div>
        </div>

