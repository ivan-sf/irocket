<?php

include '../conexion.php';
$tipo=$_GET['tipo'];
$query = "SELECT * FROM `notacontable` WHERE tipoNotacontable=$tipo AND estadoNotacontable=1";
$result = mysqli_query($conexion, $query);
$row = mysqli_num_rows($result);

    

while ($data = mysqli_fetch_assoc($result)) {
	$arreglo["data"][]= $data;
}
echo json_encode($arreglo);

