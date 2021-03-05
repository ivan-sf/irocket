<?php 
include '../../../../../../config.php';

require __DIR__ . '/../autoload.php'; //Nota: si renombraste la carpeta a algo diferente de "ticket" cambia el nombre en esta línea
use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
date_default_timezone_set('America/Bogota');
$nombre_impresora = "CAJA2"; 


$connector = new WindowsPrintConnector($nombre_impresora);
$printer = new Printer($connector);
$printer->feed(2);

$printer->setJustification(Printer::JUSTIFY_CENTER);

try{
	$array= $con->query("SELECT * FROM company INNER JOIN companydetails ON idcompany=company_idcompany");
	$data = mysqli_fetch_array($array);
	$dataR = $data['rutaLogoCompany'];
	$logo = EscposImage::load("../../../../../../" . $dataR, false);
    $printer->bitImage($logo);
}catch(Exception $e){/*No hacemos nada si hay error*/}

/*
	Ahora vamos a imprimir un encabezado
*/

$array= $con->query("SELECT * FROM company");
$datos = mysqli_fetch_array($array);

$printer->text(ucfirst($datos['nameCompany']) . "\n");
#La fecha también
$printer->setJustification(Printer::JUSTIFY_CENTER);
    $fecha = $_GET['fecha'];
	$array= $con->query("SELECT * FROM bills INNER JOIN billdetails ON idbills=bills_idbills WHERE bills.dateRegister='$fecha' AND typeBill=2 AND billdetails.stateBillDetail=1");
	$data = mysqli_fetch_array($array);
	$datadoc = $data['cliente'];
	if ($datadoc != '') {
		$sql= $con->query("SELECT * FROM users INNER JOIN userdetails 
						ON idusers=users_idusers 
						WHERE idusers='$datadoc'");
		$data1 = mysqli_fetch_array($sql);
		$datar = mysqli_num_rows($sql);
		if ($datar > 0) {
			$printer->text("Cliente: " . ucwords($data1['userName']) . " " . ucfirst($data1['lastnameUser']) . "\n");
			$printer->text("Documento: " . $data1['documentUser'] . "\n");
		}else{
			$printer->text("Cliente: " . $data['cliente'] . "\n");
		}
	}

$printer->text("$fecha \n\n");



/*
	Ahora vamos a imprimir los
	productos
*/
	$array= $con->query("SELECT * FROM bills INNER JOIN billdetails ON idbills=bills_idbills WHERE  bills.dateRegister='$fecha' AND typeBill=2 AND billdetails.stateBillDetail=1");

# Para mostrar el total
$total = 0;
	while ($datos = mysqli_fetch_array($array)) {
		$total += $datos['cantidad'] *$datos['precio_compra'];
		$pago = $datos['pago'];
		$printer->setJustification(Printer::JUSTIFY_LEFT);
    	$printer->text($datos['cantidad'] . "x " . $datos['nombre'] . "\n");
$id = $datos['idbills'];

    	$printer->setJustification(Printer::JUSTIFY_RIGHT);
    	$printer->text(' $' . number_format($datos['cantidad']*$datos['precio_compra']) . "\n");
	}


/*
	Terminamos de imprimir
	los productos, ahora va el total
*/
$printer->text("--------\n");
//$printer->text("PAGO: $". number_format($pago) ."\n");
/*if ($pago > $total) {
	$printer->text("CAMBIO: $". number_format($pago-$total) ."\n");
}else{
	$printer->text("SALDO: $". number_format($pago-$total) ."\n");
}*/
$printer->text("TOTAL: $". number_format($total) ."\n");


/*
	Podemos poner también un pie de página
*/
$printer->setJustification(Printer::JUSTIFY_CENTER);

try{
	$logo = EscposImage::load("barras_prueba.png", false);
    $printer->bitImage($logo);
}catch(Exception $e){/*No hacemos nada si hay error*/}

$printer->text("\nFacturas de compra del dia \n");
//$printer->text("COMPROBANTE #:". number_format($id) ."\n");
/*

/*
	Cortamos el papel. Si nuestra impresora
	no tiene soporte para ello, no generará
	ningún error
*/
$printer->feed(3);

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

    print "<script>window.location='". URL . "contabilidad/compra';</script>";
	//print "<script>window.location='".  URL ."facturas/detalles&id=0&dia=compra?fecha=$fecha';</script>";
