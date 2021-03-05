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
    $printer->bitImage($logo);
}catch(Exception $e){/*No hacemos nada si hay error*/}


//ENCABEZADO
$array= $con->query("SELECT * FROM company INNER JOIN companydetails ON idcompany=company_idcompany");
$datos = mysqli_fetch_array($array);

$printer->setJustification(Printer::JUSTIFY_CENTER);

$printer->selectPrintMode (Printer::MODE_DOUBLE_WIDTH);
$printer->selectPrintMode (Printer::MODE_EMPHASIZED);
$printer->text("" .  strtoupper($propietario) . "\n");
$array= $con->query("SELECT * FROM bills INNER JOIN billdetails ON idbills=bills_idbills WHERE idbills='$idbills'");	

while ($datos3 = mysqli_fetch_array($array)) {
	$vendedor=$datos3['usuarioName'];
	$id = $datos3['numeroFactura'];
	$cliente = $datos3['cliente'];
	$documentUser = $datos3['documentUser'];
}

$printer->selectPrintMode (Printer::MODE_EMPHASIZED);
$printer->text(strtoupper("N.I.T.:" . $datos['nitCompany']) . "\n");

$printer->text(strtoupper("regimen comun" . "\n"));

$printer->text(strtoupper($datos['cityCompany'] . " " . $datos['directionCompany'] . "\n"));
$printer->text(strtoupper("TELEFONO: " . $datos['phoneCompany'] . "\n"));
if($cliente!=""){
	$printer->text("CLIENTE: " .  strtoupper($cliente) . "\n");
	$printer->text("DOCUMENTO: " .  $documentUser . "\n");
}else{
	$printer->text("CLIENTE: CUANTIAS MENORES" . "\n");
	$printer->text("DOCUMENTO: 222222222" . "\n");
}


$printer->setJustification(Printer::JUSTIFY_CENTER);


$printer->text("Factura de venta POS #: ". $id ."\n");
$printer->text("FECHA " . date("d-m-Y") . "          HORA " . date("H:i:s") . "\n");
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




//IMPOSCONSUMO
$printer->text("----------------------------------------------\n");
$printer->text("Items " . $cantidaditems . "  TOTAL : " . number_format($total) . "\n");

//DISCRIMINACION DE IVA
$printer->setJustification(Printer::JUSTIFY_CENTER);
$printer->text("================================================"."\n");
$printer->text("DISCRIMINACION DE I.V.A\n");
$printer->text("================================================"."\n");
$printer->setJustification(Printer::JUSTIFY_LEFT);

$array19= $con->query("SELECT * FROM bills INNER JOIN billdetails ON idbills=bills_idbills WHERE idbills='$idbills' AND typeBillDetail=1 AND ivaPorcentaje=19");	
$iva19 = 0;
while ($datos = mysqli_fetch_array($array19)) {
	$iva19 += $datos['impuesto'] *$datos['cantidad'];
}
if($iva19>0){
	$printer->text("IVA DEL 19%   " . number_format($iva19) .  "\n");
}

$array5= $con->query("SELECT * FROM bills INNER JOIN billdetails ON idbills=bills_idbills WHERE idbills='$idbills' AND typeBillDetail=1 AND ivaPorcentaje=5");	
$iva5 = 0;
while ($datos = mysqli_fetch_array($array5)) {
	$iva5 += $datos['impuesto'] *$datos['cantidad'];
}
if($iva5>0){
	$printer->text("IVA DEL 5%   " . number_format($iva5) .  "\n");
}


$array0= $con->query("SELECT * FROM bills INNER JOIN billdetails ON idbills=bills_idbills WHERE idbills='$idbills' AND typeBillDetail=1 AND ivaPorcentaje=0 OR idbills='$idbills' AND typeBillDetail=1 AND ivaPorcentaje=''");	
$iva0 = 0;
while ($datos = mysqli_fetch_array($array0)) {
	$iva0 += $datos['impuesto'] *$datos['cantidad'];
}
if($iva0>=1){
	$printer->text("PRODUCTOS EXCLUIDOS \n");
}



//CUENTAS	
$printer->text("EFECTIVO: " . number_format($pago) .  "\n");
$printer->text("CAMBIO:   " . number_format($pago-$total) .  "\n\n");
$printer->text("VENDEDOR(A): " .  ucwords($vendedor) . "\n");
//RESOLUCION
$printer->text("RESOL. DIAN 18764005583791 DE 13/10/2020" ."\n");
$printer->text("PREFIJO RESOLUCION DIAN IN DEL:" ."\n");
$printer->text("1 AL 80000 HABILITA:" ."\n\n");
$printer->setJustification(Printer::JUSTIFY_CENTER);
//FOOTER
$printer->text("ESTIMADO CLIENTE PARA CUALQUIER QUEJA O RECLAMO\nPOR FAVOR PRESENTE ESTA FACTURA EN UN TRANSCURSO DE TIEMPO NO SUPERIOR A 15 DIAS" ."\n GRACIAS POR SU COMPRA \n\n");
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
$printer->text("FECHA " . date("d-m-Y") . "          HORA " . date("H:i:s") . "\n");
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
	$printer->text(strtoupper("      ".$datos['cantidad'] . "    " . $datos['nombre'] . "\n"));
	$printer->text(strtoupper("                      " . $datos['precioUnidad'] . "          " . $datos['precioTotal'] . "\n"));
}


//IMPOSCONSUMO
$printer->text("----------------------------------------------\n");
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



print "<script>window.location='". URL . "contabilidad/venta';</script>";





?>