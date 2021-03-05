<?php

include 'conexion.php';

$query = "SELECT * FROM userdetails INNER JOIN users ON idusers=users_idusers WHERE userdetails.tipoProveedor=1 AND users.stateBD=1";
$result = mysqli_query($conexion, $query);
$row = mysqli_num_rows($result);

    

while ($data = mysqli_fetch_assoc($result)) {
	$arreglo["data"][]= $data;
}
echo json_encode($arreglo);

