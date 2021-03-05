<?php 
include '../../../../../../config.php';
date_default_timezone_set('America/Bogota');

session_start();

$iduser=$_POST['iduser'];
$imprimir=$_POST['imprimir'];
$tipo=$_POST['tipo'];
$descripcion=$_POST['procesarCompraI'];
if($tipo=='POS'){
    $tipoID=4;
}elseif($tipo=='ELECTRONICA'){
    $tipoID=6;
}elseif($tipo=='REMISION'){
    $tipoID=5;
}
$sql = $con->query(
"SELECT * FROM bills 
INNER JOIN billdetails 
ON bills.idbills=billdetails.bills_idbills
WHERE bills.users_idusers='$iduser' AND  bills.typeBill=4 AND  bills.stateBill=2"
);

$iduserpago=$_POST['iduser'];
$sqlpago = $con->query(
"SELECT * FROM bills 
INNER JOIN billdetails 
ON bills.idbills=billdetails.bills_idbills
WHERE bills.users_idusers='$iduser' AND  bills.typeBill=4 AND  bills.stateBill=2"
);
$arraypago = mysqli_fetch_array($sqlpago);
$pago=$arraypago['pago'];
$total=$arraypago['total'];
if($pago==0){
    $pago = $total;
    //print "<script>window.location='". URL . "cajas?caja=ventas&pago=$pago';</script>";
}
while($array = mysqli_fetch_array($sql)){

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
    
    $cantidadTotal=$quantityProduct+$cantidad;

    $sql2 = $con->query("UPDATE `products` SET `quantityProduct` = '$cantidadTotal' WHERE `products`.`idproducts` = $idProducto;");

    if($sql2){
        $sql3 = $con->query("UPDATE `bills` SET `stateBill` = '1',`typeBill` = '$tipoID',`pago` = '$pago',`cashName` = '$descripcion' WHERE `bills`.`idbills` = $idbills");
        $sql4 = $con->query("UPDATE `billdetails` SET `stateBillDetail` = '2' WHERE `billdetails`.`idbillDetails` = $idbillDetails");
        $sql5 = $con->query(" UPDATE `productdetails` SET `totalBuy` = '$cantidadTotal', `totalItem` = '$cantidadTotal' WHERE `productdetails`.`idproductDetails` = $idProducto;");
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
            print "<script>window.location='". URL . "contabilidad/compra';</script>";
            //print "<script>window.location='". URL . "cajas?caja=compras';</script>";
        }
    }

}
if($imprimir=='SI' AND $tipo=='POS'){
    include('imprimirCompra.php');
}elseif($imprimir=='SI' AND $tipo=='REMISION'){
    include('imprimirCompraRemision.php');
}else{
    print "<script>window.location='". URL . "contabilidad/compra';</script>";
    //print "<script>window.location='". URL . "cajas?caja=compras';</script>";
}
    
