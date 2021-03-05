<?php 

require __DIR__ . '/../autoload.php'; //Nota: si renombraste la carpeta a algo diferente de "ticket" cambia el nombre en esta línea
use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

$nombre_impresora = "CAJA2"; 

$connector = new WindowsPrintConnector($nombre_impresora);
$printer = new Printer($connector);

$printer->pulse();
$printer->close();

if (isset($_POST['typeBill'])) {
	if ($_POST['typeBill'] == '1') {
		print "<script>window.location='".  'http://192.168.1.110/irocket?' ."cajas?caja=ventas';</script>";
	}elseif ($_POST['typeBill'] == '0') {
		print "<script>window.location='".  'http://192.168.1.110/irocket?' ."cajas?caja=compras';</script>";
	}
}