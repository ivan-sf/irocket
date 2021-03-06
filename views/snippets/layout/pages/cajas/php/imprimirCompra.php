<?php 
date_default_timezone_set('America/Bogota');

	
//DEPENDENCIAS
require __DIR__ . '/../autoload.php'; //Nota: si renombraste la carpeta a algo diferente de "ticket" cambia el nombre en esta línea
use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\CapabilityProfile ;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
date_default_timezone_set('America/Bogota');

//NOMBRE DE IMPRESORA POS COMPARTIDA EN RED
$nombre_impresora = "TITAN2"; 

//CONECTANDO A LA LIBRERIA
$connector = new WindowsPrintConnector($nombre_impresora);
$printer = new Printer($connector);
$array2= $con->query("SELECT * FROM bills INNER JOIN billdetails ON idbills=bills_idbills WHERE idbills='$idbills' AND typeBillDetail=1");	
$rowdata=mysqli_num_rows($array2);
if($rowdata!=0){
//LOGOTIPO
$printer->setJustification(Printer::JUSTIFY_CENTER);

try{
	$array= $con->query("SELECT * FROM company INNER JOIN companydetails ON idcompany=company_idcompany");
	$data = mysqli_fetch_array($array);
	$dataR = $data['rutaLogoCompany'];
	$propietario = $data['propietario'];
	$logo = EscposImage::load("../../../../../../" . $dataR, false);
}catch(Exception $e){/*No hacemos nada si hay error*/}


//ENCABEZADO
$array= $con->query("SELECT * FROM company INNER JOIN companydetails ON idcompany=company_idcompany");
$datos = mysqli_fetch_array($array);

$printer->setJustification(Printer::JUSTIFY_CENTER);

$printer->selectPrintMode (Printer::MODE_DOUBLE_WIDTH);
$printer->selectPrintMode (Printer::MODE_EMPHASIZED);
$array= $con->query("SELECT * FROM bills INNER JOIN billdetails ON idbills=bills_idbills WHERE idbills='$idbills'");	

while ($datos3 = mysqli_fetch_array($array)) {
	$vendedor=$datos3['usuarioName'];
	$id = $datos3['numeroFactura'];
	$descripcion = $datos3['cashName'];
	$cliente = $datos3['cliente'];
	$documentUser = $datos3['documentUser'];
}

$printer->selectPrintMode (Printer::MODE_EMPHASIZED);
$printer->text("FACTURA DE COMPRA \n");

if($cliente!=""){
	$printer->text("PROVEEDOR: " .  strtoupper($cliente) . "\n");
	$printer->text("DOCUMENTO: " .  $documentUser . "\n");
}if($descripcion!=""){
	$printer->text("PROVEEDOR: " .  strtoupper($descripcion) . "\n");
}


$printer->setJustification(Printer::JUSTIFY_CENTER);


$printer->text("Factura de compra POS #: ". $id ."\n");
$printer->text("FECHA            " . date("d-m-Y H:i:s") . "\n");
$printer->setJustification(Printer::JUSTIFY_CENTER);

//FACTURA DESCRIPCION
$printer->setEmphasis(false);
$printer->text("================================================"."\n");
$printer->text("CANT      NOMBRE  PRECIO UNIDAD  PRECIO TOTAL"."\n");
$printer->text("================================================"."\n");

$total = 0;
$cantidaditems = 0;
$iva19 = 0;
$iva5 = 0;

$array2= $con->query("SELECT * FROM bills INNER JOIN billdetails ON idbills=bills_idbills WHERE idbills='$idbills' AND typeBillDetail=1");	

while ($datos = mysqli_fetch_array($array2)) {
	$cantidaditems = $cantidaditems + $datos['cantidad'];
	$total += $datos['cantidad'] *$datos['precioUnidad'];
	$pago = $datos['pago'];
	$printer->setJustification(Printer::JUSTIFY_LEFT);
	$printer->text(strtoupper("   ".$datos['cantidad'] . "      " . $datos['nombre'] . "\n"));
	$printer->text(strtoupper("                       " . $datos['precioUnidad'] . "          " . $datos['precioTotal'] . "\n"));
}



//CUENTAS	
$printer->text("EFECTIVO: " . number_format($pago) .  "\n");
$printer->text("CAMBIO:   " . number_format($pago-$total) .  "\n\n");
$printer->text("VENDEDOR(A): " .  ucwords($vendedor) . "\n");

//FOOTER
$printer->selectPrintMode (Printer::MODE_FONT_B);


$printer->setJustification(Printer::JUSTIFY_CENTER);
$printer->setEmphasis(true);
$printer->text("www.titancomercial.co" ."\n");

//ALIMENTAR PAPEL
$printer->feed(3);

//CORTAR PAPEL
$printer->cut();

}
//REMISION
$printer->setJustification(Printer::JUSTIFY_CENTER);

//FACTURA REMISION

$array2= $con->query("SELECT * FROM bills INNER JOIN billdetails ON idbills=bills_idbills WHERE idbills='$idbills' AND typeBillDetail=2");	
$rowdata=mysqli_num_rows($array2);
if($rowdata!=0){

$array= $con->query("SELECT * FROM bills INNER JOIN billdetails ON idbills=bills_idbills WHERE idbills='$idbills'");	

while ($datos3 = mysqli_fetch_array($array)) {
	$vendedor=$datos3['usuarioName'];
	$id = $datos3['numeroFactura'];
	$cliente = $datos3['cliente'];
	$documentUser = $datos3['documentUser'];
}

$printer->selectPrintMode (Printer::MODE_EMPHASIZED);
$printer->setJustification(Printer::JUSTIFY_CENTER);
$printer->text("REMISION #: ". $id ."\n");
$printer->text("FECHA " . date("d-m-Y") . "\n");
$printer->text("HORA " . date("H:i:s") . "\n");
$printer->setEmphasis(false);
$printer->text("================================================"."\n");
$printer->text("CANT      NOMBRE  PRECIO UNIDAD  PRECIO TOTAL"."\n");
$printer->text("================================================"."\n");

$total = 0;
$cantidaditems = 0;
$iva19 = 0;
$iva5 = 0;

while ($datos = mysqli_fetch_array($array2)) {
	$cantidaditems = $cantidaditems + $datos['cantidad'];
	$total += $datos['cantidad'] *$datos['precioUnidad'];
	$pago = $datos['pago'];
	$printer->setJustification(Printer::JUSTIFY_LEFT);
	$printer->text(strtoupper("   ".$datos['cantidad'] . "      " . $datos['nombre'] . "\n"));
	$printer->text(strtoupper("                       " . $datos['precioUnidad'] . "          " . $datos['precioTotal'] . "\n"));
}


//IMPOSCONSUMO
$printer->text("-------------------------------\n");
$printer->text("Items " . $cantidaditems . "  TOTAL : " . number_format($total) . "\n");

//ALIMENTAR PAPEL

$printer->feed(3);

//CORTAR PAPEL
$printer->cut();

}
//PULSO CAJA REGISTRADORA
//$printer->pulse();
//CERRAR CONEXION
$printer->close();




print "<script>window.location='".  URL ."cajas?caja=ventas&proceso=exitosoYES';</script>";





?>