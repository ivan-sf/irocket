<?php
    $con = new models\Conexion();

    $codigo=$_GET['codigo'];
    $sql1 = "SELECT * FROM puc WHERE codigo='$codigo'";
    $query1 = $con->returnConsulta($sql1);
    if(mysqli_num_rows($query1)>0){
        $codigo= mysqli_fetch_object($query1);
        $codigo->status=200;
        echo json_encode($codigo);
    }else{
        $error=array('status'=>400);
        echo json_encode((object)$error);
    }