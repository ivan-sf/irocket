<?php
date_default_timezone_set('America/Bogota');

include '../../../../../../config.php';
session_start();
$nameProduct =$_POST['nameProduct'];
$cantidadP =$_POST['cantidadP'];
$precioVenta =$_POST['precioVenta'];
$precioCompra =$_POST['precioCompra'];
$total=$cantidadP*$precioVenta;
$inventory_idinventory =$_POST['inventory_idinventory'];
$iva =$_POST['iva'];
$ivaPorcentaje =$_POST['iva'];
if($iva==19){
    $iva=$precioVenta/1.19;
    $iva=$precioVenta-$iva;
}elseif($iva==5){
    $iva=$precioVenta/1.05;
    $iva=$precioVenta-$iva;
}elseif($iva==0){
    $iva=0;
}
$products_idproducts =$_POST['products_idproducts'];
$lote =$_POST['lote'];
$codigo =$_POST['codigo'];
$SESSION =$_POST['SESSION'];
$SESSIONCAJA =$_POST['SESSIONCAJA'];
$vencimiento =$_POST['vencimiento'];


$ubicacionAlmacen =$_POST['ubicacionAlmacen'];
$ubicacionBodega =$_POST['ubicacionBodega'];
$unidadesCaja =$_POST['unidadesCaja'];
$presentacionFarmaceutica =$_POST['presentacionFarmaceutica'];
$consentracion =$_POST['consentracion'];
$laboratorio =$_POST['laboratorio'];
$registroSanitario =$_POST['registroSanitario'];
$inventory_idinventory =$_POST['inventory_idinventory'];


$sql = $con->query("SELECT * FROM `bills` WHERE users_idusers = $SESSION AND typeBill=4 AND stateBill=2");
$array = mysqli_fetch_array($sql);
$row1 = mysqli_num_rows($sql);
if($row1==0){
    $sql = $con->query("SELECT * FROM `bills` WHERE typeBill=4");
    $array = mysqli_fetch_array($sql);
    $row = mysqli_num_rows($sql);
    $numeroFactura = $row+1;
    $dateTime = date("Y-m-d");
    $dateTime2 = date("Y-m-d:");

    $sql = $con->query("INSERT INTO `bills` (`numeroFactura`, `users_idusers`, `cash_idcash`, `idCliente`, `cliente`, `typeBill`, `dateRegister`, `dateUpdate`, `total`, `impuesto`, `pago`, `saldo`, `stateBill`, `userUpdate`) VALUES ('$numeroFactura', '$SESSION', '1', '', '', '4', '$dateTime', '$dateTime2', '0', '$iva', '0', '0', '2', '$SESSION');");

    $sql = $con->query("SELECT * FROM `bills` WHERE stateBill=2 AND users_idusers=$SESSION AND typeBill=4");
    $array = mysqli_fetch_array($sql);
    $row = mysqli_num_rows($sql);
    $idFactura = $array['idbills'];

    $sqlUser = $con->query("SELECT * FROM `users` INNER JOIN userdetails ON idusers=users_idusers WHERE idusers=1");
    $arrayUser = mysqli_fetch_array($sqlUser);
    $rowUser = mysqli_num_rows($sqlUser);
    $nameUser = $arrayUser['nameUser'] . " " . $arrayUser['lastnameUser'];
    if($vencimiento=='automatico'){
        
        $sqlVencimiento = $con->query("SELECT * FROM products 
		INNER JOIN productdetails 
		ON products.idproducts=productdetails.products_idproducts
		WHERE idproducts=$products_idproducts");
        $arrayVencimiento = mysqli_fetch_array($sqlVencimiento);
        $rowVencimiento = mysqli_num_rows($sqlVencimiento);
        $vencimiento1=$arrayVencimiento['fechaVencimiento'];
        $vencimiento2=$arrayVencimiento['fechaVencimiento2'];
        $vencimiento3=$arrayVencimiento['fechaVencimiento3'];
        $vencimiento4=$arrayVencimiento['fechaVencimiento4'];
        $vencimiento5=$arrayVencimiento['fechaVencimiento5'];
        $vencimiento6=$arrayVencimiento['fechaVencimiento6'];
        $vencimiento7=$arrayVencimiento['fechaVencimiento7'];
        $vencimiento8=$arrayVencimiento['fechaVencimiento8'];
        $vencimiento9=$arrayVencimiento['fechaVencimiento9'];
        $vencimiento10=$arrayVencimiento['fechaVencimiento10'];
        $vencimiento10=$arrayVencimiento['fechaVencimiento10'];
        $totalItem=$arrayVencimiento['totalItem'];
        /*if($totalItem==0){
            $vence = $vencimiento1;
        }*/
        if($vencimiento2==''){
            $vence = $vencimiento1;
        }if($vencimiento2!='' && $vencimiento3==''){
            $vence = $vencimiento2;
        }if($vencimiento3!='' && $vencimiento4==''){
            $vence = $vencimiento3;
        }
    }else{
        $vence = $vencimiento;
    }
    //INVENTARIO DE REMISION
    if($inventory_idinventory==18){
        $tipoFactura = 1;
    }else{
        $tipoFactura = 1;
    }
    $sqlInventario = $con->query("SELECT * FROM inventory INNER JOIN inventorydetails ON idinventory=inventory_idinventory WHERE idinventory = $inventory_idinventory");
    $arrayInventario = mysqli_fetch_array($sqlInventario);
    $rowInventario = mysqli_num_rows($sqlInventario);
    $nombreInventario = $arrayInventario['nameInventory'];
    $sql = $con->query("INSERT INTO `billdetails` (`bills_idbills`, `usuarioID`, `usuarioName`, `products_idproducts`, `codigo`, `nombre`, `precioUnidad`, `cantidad`, `precioTotal`, `impuesto`, `ivaPorcentaje`, `dateRegister`, `dateUpdate`, `stateBillDetail`, `typeBillDetail`, `unidadesCajaBD`, `presentacionFarmaceuticaBD`, `concentracionBD`, `laboratorioBD`, `loteBD`, `regSanBD`, `vencimientoBD`, `ubicacionABD`, `ubicacionBBD`, `inventarioID`, `inventarioName`, `pUnidadCompra`, `pUnidadVenta`) VALUES ('$idFactura', '$SESSION', '$nameUser', '$products_idproducts', '$codigo', '$nameProduct', '$precioVenta', '$cantidadP', '$total', '$iva', '$ivaPorcentaje', '$dateTime', '$dateTime', '1', '$tipoFactura', '$unidadesCaja', '$presentacionFarmaceutica', '$consentracion', '$laboratorio', '$lote', '$registroSanitario', '$vence', '$ubicacionAlmacen', '$ubicacionBodega', '$inventory_idinventory', '$nombreInventario', '$precioCompra', '$precioVenta');");

    $sqlUpdate = $con->query("SELECT * FROM `billdetails` WHERE bills_idbills=$idFactura");
    ;
    $rowUpdate = mysqli_num_rows($sqlUpdate);

    $total = 0;
    $totalImpuesto = 0;
	while ($datos = mysqli_fetch_array($sqlUpdate)) {
		$total += $datos['precioTotal'];
		$totalImpuesto += $datos['impuesto']*$datos['cantidad'];
	}

    $sqlUpdate = $con->query("UPDATE `bills` SET `total` = '$total',`impuesto` = '$totalImpuesto',`pago` = '0' WHERE `idbills` = $idFactura;");


    

    print "<script>window.location='". URL . "cajas?caja=compras';</script>";

}else{
    $dateTime = date("Y-m-d");
    $sql = $con->query("SELECT * FROM `bills` WHERE stateBill=2 AND users_idusers=$SESSION AND typeBill=4");
    $array = mysqli_fetch_array($sql);
    $row = mysqli_num_rows($sql);
    $idFactura = $array['idbills'];

    $sqlUser = $con->query("SELECT * FROM `users` INNER JOIN userdetails ON idusers=users_idusers WHERE idusers=1");
    $arrayUser = mysqli_fetch_array($sqlUser);
    $rowUser = mysqli_num_rows($sqlUser);
    $nameUser = $arrayUser['nameUser'] . " " . $arrayUser['lastnameUser'];


    $sqlVencimiento = $con->query("SELECT * FROM products 
    INNER JOIN productdetails 
    ON products.idproducts=productdetails.products_idproducts
    WHERE idproducts=$products_idproducts");
    $arrayVencimiento = mysqli_fetch_array($sqlVencimiento);
    $rowVencimiento = mysqli_num_rows($sqlVencimiento);

    if($lote=='automatico'){
        $lote=$arrayVencimiento['lote'];
        
    }
    if($vencimiento=='automatico'){
        
       
        $vencimiento1=$arrayVencimiento['fechaVencimiento'];
        $vencimiento2=$arrayVencimiento['fechaVencimiento2'];
        $vencimiento3=$arrayVencimiento['fechaVencimiento3'];
        $vencimiento4=$arrayVencimiento['fechaVencimiento4'];
        $vencimiento5=$arrayVencimiento['fechaVencimiento5'];
        $vencimiento6=$arrayVencimiento['fechaVencimiento6'];
        $vencimiento7=$arrayVencimiento['fechaVencimiento7'];
        $vencimiento8=$arrayVencimiento['fechaVencimiento8'];
        $vencimiento9=$arrayVencimiento['fechaVencimiento9'];
        $vencimiento10=$arrayVencimiento['fechaVencimiento10'];
        $vencimiento10=$arrayVencimiento['fechaVencimiento10'];
        $totalItem=$arrayVencimiento['totalItem'];
        /*if($totalItem==0){
            $vence = $vencimiento1;
        }*/
        if($vencimiento2==''){
            $vence = $vencimiento1;
        }if($vencimiento2!='' && $vencimiento3==''){
            $vence = $vencimiento2;
        }if($vencimiento3!='' && $vencimiento4==''){
            $vence = $vencimiento3;
        }
    }else{
        $vence = $vencimiento;
    }
    //INVENTARIO DE REMISION
    if($inventory_idinventory==18){
        $tipoFactura = 1;
    }else{
        $tipoFactura = 1;
    }
    $sqlInventario = $con->query("SELECT * FROM inventory INNER JOIN inventorydetails ON idinventory=inventory_idinventory WHERE idinventory = $inventory_idinventory");
    $arrayInventario = mysqli_fetch_array($sqlInventario);
    $rowInventario = mysqli_num_rows($sqlInventario);
    $nombreInventario = $arrayInventario['nameInventory'];

    
    $sql = $con->query("INSERT INTO `billdetails` (`bills_idbills`, `usuarioID`, `usuarioName`, `products_idproducts`, `codigo`, `nombre`, `precioUnidad`, `cantidad`, `precioTotal`, `impuesto`, `ivaPorcentaje`, `dateRegister`, `dateUpdate`, `stateBillDetail`, `typeBillDetail`, `unidadesCajaBD`, `presentacionFarmaceuticaBD`, `concentracionBD`, `laboratorioBD`, `loteBD`, `regSanBD`, `vencimientoBD`, `ubicacionABD`, `ubicacionBBD`, `inventarioID`, `inventarioName`, `pUnidadCompra`, `pUnidadVenta`) VALUES ('$idFactura', '$SESSION', '$nameUser', '$products_idproducts', '$codigo', '$nameProduct', '$precioVenta', '$cantidadP', '$total', '$iva', '$ivaPorcentaje', '$dateTime', '$dateTime', '1', '$tipoFactura', '$unidadesCaja', '$presentacionFarmaceutica', '$consentracion', '$laboratorio', '$lote', '$registroSanitario', '$vence', '$ubicacionAlmacen', '$ubicacionBodega', '$inventory_idinventory', '$nombreInventario', '$precioCompra', '$precioVenta');");

    $sqlUpdate = $con->query("SELECT * FROM `billdetails` WHERE bills_idbills=$idFactura");
    ;
    $rowUpdate = mysqli_num_rows($sqlUpdate);

    $total = 0;
    $totalImpuesto = 0;
	while ($datos = mysqli_fetch_array($sqlUpdate)) {
		$total += $datos['precioTotal'];
		$totalImpuesto += $datos['impuesto']*$datos['cantidad'];
	}

    $sqlUpdate = $con->query("UPDATE `bills` SET `total` = '$total',`impuesto` = '$totalImpuesto',`pago` = '0',`saldo` = '0' WHERE `idbills` = $idFactura;");

    

    print "<script>window.location='". URL . "cajas?caja=compras';</script>";
}
?>