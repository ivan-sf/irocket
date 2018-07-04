<?php
require __DIR__ . '/autoload.php'; //Nota: si renombraste la carpeta a algo diferente de "ticket" cambia el nombre en esta línea
use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
date_default_timezone_set('America/Bogota');

/*
	Este ejemplo imprime un
	ticket de venta desde una impresora térmica
*/


/*
	Una pequeña clase para
	trabajar mejor con
	los productos
	Nota: esta clase no es requerida, puedes
	imprimir usando puro texto de la forma
	que tú quieras
*/
class Producto{

	public function __construct($nombre, $precio, $cantidad){
		$this->nombre = $nombre;
		$this->precio = $precio;
		$this->cantidad = $cantidad;
	}
}

/*
	Vamos a simular algunos productos. Estos
	podemos recuperarlos desde $_POST o desde
	cualquier entrada de datos. Yo los declararé
	aquí mismo
*/
$producto1=" iRocket";
$producto2=" Impresora";
$producto3=" Lector";
$precio1=1200000;
$precio2=130000;
$precio3=70000;
$cantidad1=1;
$cantidad2=1;
$cantidad3=1;
$productos = array(
		new Producto($producto1, $precio1, $cantidad1),
		new Producto($producto2, $precio2, $cantidad2),
		new Producto($producto3, $precio3, $cantidad3),
	);

/*
	Aquí, en lugar de "POS-58" (que es el nombre de mi impresora)
	escribe el nombre de la tuya. Recuerda que debes compartirla
	desde el panel de control
*/

$nombre_impresora = "POS-58"; 


$connector = new WindowsPrintConnector($nombre_impresora);
$printer = new Printer($connector);


/*
	Vamos a imprimir un logotipo
	opcional. Recuerda que esto
	no funcionará en todas las
	impresoras

	Pequeña nota: Es recomendable que la imagen no sea
	transparente (aunque sea png hay que quitar el canal alfa)
	y que tenga una resolución baja. En mi caso
	la imagen que uso es de 250 x 250
*/

# Vamos a alinear al centro lo próximo que imprimamos
$printer->setJustification(Printer::JUSTIFY_CENTER);

/*
	Intentaremos cargar e imprimir
	el logo
*/
try{
	$logo = EscposImage::load("logo.png", false);
    $printer->bitImage($logo);
}catch(Exception $e){/*No hacemos nada si hay error*/}

/*
	Ahora vamos a imprimir un encabezado
*/

$printer->text("Integration Software" . "\n");
$printer->text("Solucion de Software" . "\n");
$printer->text("Factura# 001" . "\n");
#La fecha también
$printer->text(date("Y-m-d H:i:s") . "\n");


/*
	Ahora vamos a imprimir los
	productos
*/

# Para mostrar el total
$total = 0;
foreach ($productos as $producto) {
	$total += $producto->cantidad * $producto->precio;

	/*Alinear a la izquierda para la cantidad y el nombre*/
	$printer->setJustification(Printer::JUSTIFY_LEFT);
    $printer->text($producto->cantidad . "x" . $producto->nombre . "\n");

    /*Y a la derecha para el importe*/
    $printer->setJustification(Printer::JUSTIFY_RIGHT);
    $printer->text(' $' . $producto->precio . "\n");
}

/*
	Terminamos de imprimir
	los productos, ahora va el total
*/
$printer->text("--------\n");
$printer->text("TOTAL: $". $total ."\n\n");


/*
	Podemos poner también un pie de página
*/
$printer->setJustification(Printer::JUSTIFY_CENTER);

try{
	$logo = EscposImage::load("barras_prueba.png.png", false);
    $printer->bitImage($logo);
}catch(Exception $e){/*No hacemos nada si hay error*/}

$printer->text("\nMuchas gracias por su compra");



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
$printer->pulse();

/*
	Para imprimir realmente, tenemos que "cerrar"
	la conexión con la impresora. Recuerda incluir esto al final de todos los archivos
*/
$printer->close();
?>