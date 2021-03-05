<?php 
include '../../../../../../config.php';
date_default_timezone_set('America/Bogota');

session_start();

$iduser=$_POST['iduser'];
$tipo=$_POST['tipo'];
$imprimir=$_POST['imprimir'];
$descripcion=$_POST['procesarCompraI'];
if($tipo=='POS'){
    $tipoID=1;
}elseif($tipo=='ELECTRONICA'){
    $tipoID=3;
}elseif($tipo=='REMISION'){
    $tipoID=2;
}
$sqlARR = $con->query(
"SELECT * FROM bills 
INNER JOIN billdetails 
ON bills.idbills=billdetails.bills_idbills
WHERE bills.users_idusers='$iduser' AND  bills.typeBill=1 AND  bills.stateBill=2"
);

$iduserpago=$_POST['iduser'];
$sqlpago = $con->query(
"SELECT * FROM bills 
INNER JOIN billdetails 
ON bills.idbills=billdetails.bills_idbills
WHERE bills.users_idusers='$iduser' AND  bills.typeBill=1 AND  bills.stateBill=2"
);
$arraypago = mysqli_fetch_array($sqlpago);
$pago=$arraypago['pago'];
$total=$arraypago['total'];
if($pago==0){
    $pago = $total;
    //print "<script>window.location='". URL . "cajas?caja=ventas&pago=$pago';</script>";
}

while($array = mysqli_fetch_array($sqlARR)){

    $cantidad = $array['cantidad'];
    $idProducto = $array['products_idproducts'];
    $idbills = $array['idbills'];
    $idbillDetails = $array['idbillDetails'];

    $sqlProducto = $con->query("SELECT * FROM products 
    INNER JOIN productdetails 
    ON products.idproducts=productdetails.products_idproducts
    WHERE products.idproducts=$idProducto");
    $arrayProducto = mysqli_fetch_array($sqlProducto);
    $rowProducto = mysqli_num_rows($sqlProducto);
    $quantityProduct = $arrayProducto['quantityProduct'];
    $ventas = $arrayProducto['totalSales'];
    
    $cantidadTotal=$quantityProduct-$cantidad;
    $cantidadVentas=$cantidad+$ventas;

    $sql2 = $con->query("UPDATE `products` SET `quantityProduct` = '$cantidadTotal' WHERE `products`.`idproducts` = $idProducto;");

    if($sql2){

        $queryDet = $con->query("SELECT * FROM `billdetails` WHERE bills_idbills=$idbills AND typeBillDetail=1 AND stateBillDetail=2");
        $total=0;
        $totalImpuesto=0;	
        $totalCosto=0;	
        while ($dataDet= mysqli_fetch_array($queryDet)) {
            $totalCosto+=$dataDet['pUnidadCompra']*$dataDet['cantidad'];
            $total+=$dataDet['precioTotal'];
            $totalImpuesto+=$dataDet['impuesto']*$dataDet['cantidad'];
        }

        $totalSinIva=$total-$totalImpuesto;

      
        
        $query19 = $con->query("SELECT * FROM `billdetails` WHERE bills_idbills=$idbills AND ivaPorcentaje=19 AND typeBillDetail=1 AND stateBillDetail=2");
        $total19=0;
        $totalImpuesto19=0;	
        $totalCos19=0;	
        while ($datos19= mysqli_fetch_array($query19)) {
            $totalCos19+=$datos19['pUnidadCompra']*$datos19['cantidad'];
            $total19+=$datos19['precioTotal'];
            $totalImpuesto19+=$datos19['impuesto']*$datos19['cantidad'];
        }
        $totalSinIva19=$total19-$totalImpuesto19;
        $totalIvaCos19=$totalCos19/1.19;

        $query5 = $con->query("SELECT * FROM `billdetails` WHERE bills_idbills=$idbills AND ivaPorcentaje=5 AND typeBillDetail=1 AND stateBillDetail=2");
        $total5=0;
        $totalImpuesto5=0;	
        $totalCos5=0;	
        while ($datos5= mysqli_fetch_array($query5)) {
            $totalCos5+=$datos5['pUnidadCompra']*$datos5['cantidad'];
            $total5+=$datos5['precioTotal'];
            $totalImpuesto5+=$datos5['impuesto']*$datos5['cantidad'];
        }
        $totalSinIva5=$total5-$totalImpuesto5;
        $totalIvaCos5=$totalCos5/1.05;

        $query0 = $con->query("SELECT * FROM `billdetails` WHERE bills_idbills=$idbills  AND ivaPorcentaje=0 AND typeBillDetail=1 AND stateBillDetail=2");
        $total0=0;
        $totalImpuesto0=0;	
        $totalCos0=0;	
        while ($datos0= mysqli_fetch_array($query0)) {
            $totalCos0+=$datos0['pUnidadCompra']*$datos0['cantidad'];
            $total0+=$datos0['precioTotal'];
            $totalImpuesto0+=$datos0['impuesto']*$datos0['cantidad'];
        }
        $totalSinIva0=$total0-$totalImpuesto0;
        $totalIvaCos0=$totalCos0;

        $queryNoR = $con->query("SELECT * FROM `billdetails` WHERE bills_idbills=$idbills AND typeBillDetail=1 AND stateBillDetail=2");
        $totalNoR=0;
        $totalImpuestoNoR=0;

        
        while ($dataNoR= mysqli_fetch_array($queryNoR)) {
            $totalNoR+=$dataNoR['precioTotal'];
            $totalImpuestoNoR+=$dataNoR['impuesto']*$dataNoR['cantidad'];
            $ivaPorc=$dataNoR['ivaPorcentaje'];
        }
        $totalSinIvaNoR=$totalNoR-$totalImpuestoNoR;
		$totalCostoSinIva=$totalIvaCos19+$totalIvaCos5+$totalIvaCos0;

        
        
        $sql3 = $con->query("UPDATE `bills` SET `baseIvaNoR` = '$totalSinIvaNoR', `baseIva0` = '$totalSinIva0',`ivaNoR` = '$totalImpuestoNoR',`total` = '$total',`baseIva5` = '$totalSinIva5', `iva5V` = '$totalImpuesto5',`baseIva19` = '$totalSinIva19', `iva19V` = '$totalImpuesto19',`precioCostoSiniVA` = '$totalCostoSinIva',`precioCostoConiVA` = '$totalCosto',`totalSinIva` = '$totalSinIva',`stateBill` = '1',`typeBill` = '$tipoID',`pago` = '$pago',`cashName` = '$descripcion' WHERE `bills`.`idbills` = $idbills");
        
        $sql4 = $con->query("UPDATE `billdetails` SET `stateBillDetail` = '2' WHERE `billdetails`.`idbillDetails` = $idbillDetails");





  






        $sql5 = $con->query(" UPDATE `productdetails` SET `totalSales` = '$cantidadVentas', `totalItem` = '$cantidadTotal' WHERE `productdetails`.`idproductDetails` = $idProducto;");
        if($sql5){
            $sql6 = $con->query("SELECT * FROM bills 
            INNER JOIN billdetails 
            ON bills.idbills=billdetails.bills_idbills
            WHERE bills.idbills='$idbills'");
            $array6=$array = mysqli_fetch_array($sql6);
            $typeBill = $array6['typeBill'];
            $sql6 = $con->query("SELECT * FROM bills where typeBill=$typeBill AND stateBill=1");
            $rowsql6 = mysqli_num_rows($sql6)+1;
            $sql7 = $con->query("UPDATE `bills` SET `numeroFactura` = '$rowsql6' WHERE `bills`.`idbills` = $idbills");
            /*$sql8 = $con->query("SELECT * FROM billdetails 
            WHERE bills_idbills='$idbills' AND billdetails.typeBillDetail=1");*/
            $sql8 = $con->query("SELECT * FROM billdetails WHERE bills_idbills='$idbills' AND typeBillDetail=1");
            $rowsq8 = mysqli_num_rows($sql8);
            if($rowsq8==0){
                $sql9 = $con->query("SELECT * FROM bills where typeBill=2 AND stateBill=1");
                $rowsql9 = mysqli_num_rows($sql9)+1;
                $sql9 = $con->query("UPDATE `bills` SET `typeBill` = 2, numeroFactura=$rowsql9 WHERE `bills`.`idbills` = $idbills");
            }else{

            }
            
        }
        
    }  
    
    





}











if($imprimir=='SI' AND $tipo=='POS'){
    include('imprimirVenta.php');
}elseif($imprimir=='SI' AND $tipo=='REMISION'){
    include('imprimirVentaRemision.php');
}else{
    print "<script>window.location='". URL . "contabilidad/venta';</script>";
}

    


