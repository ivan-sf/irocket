<?php namespace models\ajax;
include 'conexion.php';

$documento = $_POST['documento'];


$query = "SELECT * FROM notacontable WHERE terceroDocumento=$documento";
$result = mysqli_query($conexion, $query);
$query2 = "SELECT * FROM bills WHERE documentUser=$documento";
$result2 = mysqli_query($conexion, $query2);

if($result){
	$row = mysqli_num_rows($result);
	$row2 = mysqli_num_rows($result2);
}else{
	$row=0;
}

if($row>=1 OR $row2>=1){
	echo "El documento del tercero que intenta eliminar esta en uso imposible eliminar.";
}
else{
    echo "2";
}