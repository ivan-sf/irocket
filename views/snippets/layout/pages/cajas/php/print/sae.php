















$printer->setJustification(Printer::JUSTIFY_CENTER);
$printer->text("Vendedor(a):". strtoupper($vendedor) ."\n");

# Para mostrar el total
$total = 0;
	while ($datos = mysqli_fetch_array($array)) {
		$descuento=$datos['pos'];
		$total += $datos['cantidad'] *$datos['precio_c-u'];
		$pago = $datos['pago'];
		$printer->setJustification(Printer::JUSTIFY_LEFT);
    	$printer->text($datos['cantidad'] . "x " . $datos['nombre'] . "\n");

    	$printer->setJustification(Printer::JUSTIFY_RIGHT);
    	$printer->text(' $' . number_format($datos['cantidad']*$datos['precio_c-u']) . "\n");
	}


/*
	Terminamos de imprimir
	los productos, ahora va el total
*/


if ($descuento==0 OR $descuento=="") {
	$printer->text("--------\n");
$printer->text("PAGO: $". number_format($pago) ."\n");
if ($pago > $total) {
	$printer->text("CAMBIO: $". number_format($pago-$total) ."\n");
}else{
	$printer->text("SALDO: $". number_format($pago-$total) ."\n");
}
}else{
	$printer->text("--------\n");
	
$printer->text("DESCUENTO: $". number_format($descuento) ."\n");	
}


$printer->text("TOTAL: $". number_format($total-$descuento) ."\n");



/*
	Podemos poner también un pie de página
*/
$printer->setJustification(Printer::JUSTIFY_CENTER);

try{
	$logo = EscposImage::load("barras_prueba.png", false);
    $printer->bitImage($logo);
}catch(Exception $e){/*No hacemos nada si hay error*/}

$printer->text("\nMuchas gracias por su compra\n");


/*Alimentamos el papel 3 veces*/

$printer->feed(3);

/*
	Cortamos el papel. Si nuestra impresora
	no tiene soporte para ello, no generará
	ningún error
*/
$printer->cut();

/*
	Por medio de la impresora mandamos un pulso.
	Esto es útil cuando la tenemos conectada
	por ejemplo a un cajón
*/

//$printer->pulse();

/*
	Para imprimir realmente, tenemos que "cerrar"
	la conexión con la impresora. Recuerda incluir esto al final de todos los archivos
*/

$printer->close();








if (isset($_POST['typeBill'])) {
	if ($_POST['typeBill'] == '1') {
		print "<script>window.location='".  URL ."cajas?caja=ventas&proceso=exitoso';</script>";
	}elseif ($_POST['typeBill'] == '2') {
		print "<script>window.location='".  URL ."cajas?caja=compras&proceso=exitoso';</script>";
	}elseif ($_POST['typeBill'] == '3') {
		print "<script>window.location='".  URL ."cajas?caja=cambios&proceso=exitoso';</script>";
	}elseif ($_POST['typeBill'] == '4') {
		print "<script>window.location='".  URL ."cajas?caja=devoluciones&proceso=exitoso';</script>";
	}else{
		print "<script>window.location='".  URL ."cajas?proceso=exitoso';</script>";
	}
}


?>