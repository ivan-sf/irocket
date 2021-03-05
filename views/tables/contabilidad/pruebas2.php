<?php

include '../conexion.php';

$query = "SELECT * FROM `bills` WHERE typeBill=1 and stateBill=1";
$result = mysqli_query($conexion, $query);
$row = mysqli_num_rows($result);

    

while ($data = mysqli_fetch_assoc($result)) {
	$arreglo["data"][]= $data;
}
echo json_encode($arreglo);

