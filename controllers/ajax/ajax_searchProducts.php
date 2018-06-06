<?php namespace models\ajax;

$busquedaInput = $_POST['busquedaInput'];
include 'conexion.php';

$query = "SELECT * FROM products INNER JOIN productdetails ON idproducts=products_idproducts WHERE stateBD=1";
$result = mysqli_query($conexion, $query);
$row = mysqli_num_rows($result);

    

while ($data = mysqli_fetch_assoc($result)) {
	$arreglo["data"][]= $data;
}
echo json_encode($arreglo);

