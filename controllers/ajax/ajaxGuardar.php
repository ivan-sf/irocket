<?php namespace models\ajax;

session_start();
include 'conexion.php';
$nombre = $_POST['nombre'];
$codigo = $_POST['codigo'];
$idproducto = $_POST['idproducto'];
$cantidadINV = $_POST['cantidadINV'];
$existencias = $_POST['existencias'];

if(isset($_SESSION['administrador'])){
    $user = $_SESSION['administrador'];
}else if(isset($_SESSION['contable'])){
    $user = $_SESSION['contable'];
}else{
    $user = $_SESSION['adminUserNew'];
}

$query = "SELECT * FROM bills 
        INNER JOIN billdetails 
        ON bills.idbills=billdetails.bills_idbills
        WHERE users_idusers=$user AND stateBillDetail=1 AND typeBill=1
        ORDER BY idbillDetails desc";

$result = mysqli_query($conexion, $query);
$row=mysqli_num_rows($result);
if($existencias==0){
    echo "El producto se encuentra agotado";
}else if($row==0){
    $sql = "SELECT * FROM `bills` WHERE typeBill=1";
    $query = mysqli_query($conexion, $sql);
    $row = mysqli_num_rows($query);
    $numeroFactura = $row+1;
    $dateTime = date("Y-m-d");

    $sql= "INSERT INTO `bills` (`numeroFactura`, `users_idusers`, `cash_idcash`, `idCliente`, `cliente`, `typeBill`, `dateRegister`, `dateUpdate`, `total`, `impuesto`, `pago`, `saldo`, `stateBill`, `userUpdate`) VALUES ('$numeroFactura', '$user', '1', '', '', '1', '$dateTime', '$dateTime', '0', '0', '0', '0', '2', '$user')";
    $query = mysqli_query($conexion, $sql);

    $sql = "SELECT * FROM `bills` WHERE stateBill=2 AND users_idusers=$user AND typeBill=1";
    $query = mysqli_query($conexion, $sql);
    $array = mysqli_fetch_array($query);
    $idFactura = $array['idbills'];

    $sqlUser = "SELECT * FROM `users` INNER JOIN userdetails ON idusers=users_idusers WHERE idusers=$user";
    $query = mysqli_query($conexion, $sqlUser);
    $arrayUser = mysqli_fetch_array($query);
    $nameUser = $arrayUser['nameUser'] . " " . $arrayUser['lastnameUser'];

    $sqlProd = "SELECT * FROM products INNER JOIN productdetails ON products.idproducts=productdetails.products_idproducts WHERE idproducts=$idproducto";
    $query = mysqli_query($conexion, $sqlProd);
    $arrayProd = mysqli_fetch_array($query);
    $idproducto = $arrayProd['idproducts'];
    $codigo = $arrayProd['codeProduct'];
    $nombreProd = $arrayProd['nameProduct'];
    $precioUnidad = $arrayProd['precio'];
    $total = $arrayProd['precio']*$cantidadINV;
    $ivaPorcentaje = $arrayProd['iva'];
    $inventario = $arrayProd['inventory_idinventory'];
    $ubicacionAlmacen = $arrayProd['ubicacionAlmacen'];
    $ubicacionBodega = $arrayProd['ubicacionBodega'];
    $iva=0;
    $sqlInventario = "SELECT * FROM inventory INNER JOIN inventorydetails ON idinventory=inventory_idinventory WHERE idinventory = $inventario";
    $query = mysqli_query($conexion, $sqlInventario);
    $arrayInventario = mysqli_fetch_array($query);
    $nombreInventario = $arrayInventario['nameInventory'];
    
    if($inventario==29){
        $tipoFactura = 2;
    }else{
        $tipoFactura = 1;
    }

    $sqlDetalle="INSERT INTO `billdetails` (`bills_idbills`, `usuarioID`, `usuarioName`, `products_idproducts`, `codigo`, `nombre`, `precioUnidad`, `cantidad`, `precioTotal`, `impuesto`, `ivaPorcentaje`, `dateRegister`, `dateUpdate`, `stateBillDetail`, `typeBillDetail`, `unidadesCajaBD`, `presentacionFarmaceuticaBD`, `concentracionBD`, `laboratorioBD`, `loteBD`, `regSanBD`, `vencimientoBD`, `ubicacionABD`, `ubicacionBBD`, `inventarioID`, `inventarioName`, `pUnidadCompra`, `pUnidadVenta`) VALUES ('$idFactura', '$user', '$nameUser', '$idproducto', '$codigo', '$nombreProd', '$precioUnidad', '$cantidadINV', '$total', '$iva', '$ivaPorcentaje', '$dateTime', '$dateTime', '1', '$tipoFactura', '0', '0', '0', '0', '0', '0', '0', '$ubicacionAlmacen', '$ubicacionBodega', '$inventario', '$nombreInventario', '0', '0');";
    $query = mysqli_query($conexion, $sqlDetalle);
    echo "1";

}else if($row>0){

    $sql = "SELECT * FROM `bills` WHERE typeBill=1";
    $query = mysqli_query($conexion, $sql);
    $row = mysqli_num_rows($query);
    $numeroFactura = $row+1;
    $dateTime = date("Y-m-d");

    $sql= "INSERT INTO `bills` (`numeroFactura`, `users_idusers`, `cash_idcash`, `idCliente`, `cliente`, `typeBill`, `dateRegister`, `dateUpdate`, `total`, `impuesto`, `pago`, `saldo`, `stateBill`, `userUpdate`) VALUES ('$numeroFactura', '$user', '1', '', '', '1', '$dateTime', '$dateTime', '0', '0', '0', '0', '2', '$user')";
    $query = mysqli_query($conexion, $sql);

    $sql = "SELECT * FROM `bills` WHERE stateBill=2 AND users_idusers=$user AND typeBill=1";
    $query = mysqli_query($conexion, $sql);
    $array = mysqli_fetch_array($query);
    $idFactura = $array['idbills'];

    $sqlUser = "SELECT * FROM `users` INNER JOIN userdetails ON idusers=users_idusers WHERE idusers=$user";
    $query = mysqli_query($conexion, $sqlUser);
    $arrayUser = mysqli_fetch_array($query);
    $nameUser = $arrayUser['nameUser'] . " " . $arrayUser['lastnameUser'];

    $sqlProd = "SELECT * FROM products INNER JOIN productdetails ON products.idproducts=productdetails.products_idproducts WHERE idproducts=$idproducto";
    $query = mysqli_query($conexion, $sqlProd);
    $arrayProd = mysqli_fetch_array($query);
    $idproducto = $arrayProd['idproducts'];
    $codigo = $arrayProd['codeProduct'];
    $nombreProd = $arrayProd['nameProduct'];
    $precioUnidad = $arrayProd['precio'];
    $total = $arrayProd['precio']*$cantidadINV;
    $ivaPorcentaje = $arrayProd['iva'];
    $inventario = $arrayProd['inventory_idinventory'];
    $ubicacionAlmacen = $arrayProd['ubicacionAlmacen'];
    $ubicacionBodega = $arrayProd['ubicacionBodega'];
    $iva=0;
    $sqlInventario = "SELECT * FROM inventory INNER JOIN inventorydetails ON idinventory=inventory_idinventory WHERE idinventory = $inventario";
    $query = mysqli_query($conexion, $sqlInventario);
    $arrayInventario = mysqli_fetch_array($query);
    $nombreInventario = $arrayInventario['nameInventory'];
    
    if($inventario==29){
        $tipoFactura = 2;
    }else{
        $tipoFactura = 1;
    }

    $sqlDetalle="INSERT INTO `billdetails` (`bills_idbills`, `usuarioID`, `usuarioName`, `products_idproducts`, `codigo`, `nombre`, `precioUnidad`, `cantidad`, `precioTotal`, `impuesto`, `ivaPorcentaje`, `dateRegister`, `dateUpdate`, `stateBillDetail`, `typeBillDetail`, `unidadesCajaBD`, `presentacionFarmaceuticaBD`, `concentracionBD`, `laboratorioBD`, `loteBD`, `regSanBD`, `vencimientoBD`, `ubicacionABD`, `ubicacionBBD`, `inventarioID`, `inventarioName`, `pUnidadCompra`, `pUnidadVenta`) VALUES ('$idFactura', '$user', '$nameUser', '$idproducto', '$codigo', '$nombreProd', '$precioUnidad', '$cantidadINV', '$total', '$iva', '$ivaPorcentaje', '$dateTime', '$dateTime', '1', '$tipoFactura', '0', '0', '0', '0', '0', '0', '0', '$ubicacionAlmacen', '$ubicacionBodega', '$inventario', '$nombreInventario', '0', '0');";
    $query = mysqli_query($conexion, $sqlDetalle);

    echo "1";
    
}