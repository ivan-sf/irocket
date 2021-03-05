<?php namespace models\ajax;
include 'conexion.php';

$documentoviejo = $_POST['documento'];
$documento = $_POST['document'];


$query = "SELECT * FROM userdetails WHERE documentUser=$documento";
$result = mysqli_query($conexion, $query);
$query2 = "SELECT * FROM bills WHERE documentUser=$documentoviejo";
$result2 = mysqli_query($conexion, $query2);
$query3 = "SELECT * FROM notacontable WHERE terceroDocumento=$documentoviejo";
$result3 = mysqli_query($conexion, $query3);

if($result){
	$row = mysqli_num_rows($result);
	$row2 = mysqli_num_rows($result2);
	$row3 = mysqli_num_rows($result3);
}else{
	$row=0;
}

if($documentoviejo==$documento){
	echo "2";
}
else if($row>=1){
	echo "El documento ya esta registrado.";
}else if($documentoviejo!=$documento){
	if($row2>=1 OR $row>=1){
		echo "No puedes modificar el numero de documento de este tercero esta en uso.";
	}else{
		echo "2";
	}
}
else{
    echo "2";
}