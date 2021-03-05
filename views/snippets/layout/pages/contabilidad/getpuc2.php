<?php
    $con = new models\Conexion();

    $iduser=$_GET['codigo'];
    $sql1 = "SELECT * FROM users INNER JOIN userdetails ON idusers=users_idusers WHERE idusers='$iduser'";
    $query1 = $con->returnConsulta($sql1);
    if(mysqli_num_rows($query1)>0){
        $codigo= mysqli_fetch_object($query1);
        $codigo->status=200;
        echo json_encode($codigo);
    }else{
        $error=array('status'=>400);
        echo json_encode((object)$error);
    }