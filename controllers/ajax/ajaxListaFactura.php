<?php namespace models\ajax;
session_start();
include 'conexion.php';

    if(isset($_SESSION['administrador'])){
        $user = $_SESSION['administrador'];
    }else if(isset($_SESSION['contable'])){
        $user = $_SESSION['contable'];
    }else{
        $user = $_SESSION['adminUserNew'];
    }
    
    $query = "SELECT * FROM bills 
            INNER JOIN billdetails 
            ON bills.idbills=billdetails.bills_idbills
            WHERE users_idusers=$user AND stateBillDetail=1 AND typeBill=1
            ORDER BY idbillDetails desc";

    $result = mysqli_query($conexion, $query);
    while($row=mysqli_fetch_array($result)){
    $json[]=array(
        'idbills'=>$row['idbills'],
        'nombre'=>$row['nombre'],
        'cantidad'=>$row['cantidad'],
        'precioU'=>$row['precioUnidad'],
        'iva'=>$row['ivaPorcentaje'],
        'precioT'=>$row['precioTotal']
    );
}

if($result){
    $jsonstring=json_encode($json);
    echo $jsonstring;
}else{
    echo "No se encontraron Datos";
}