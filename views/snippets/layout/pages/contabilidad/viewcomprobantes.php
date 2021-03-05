<?php 
    $con = new models\Conexion();
    $comprobante = $_POST['comprobante'];
    $sql = "SELECT * FROM comprobantes WHERE tipo=$comprobante";
    $query = $con->returnConsulta($sql);
    while ($data = mysqli_fetch_object($query)) {
        $arreglo = $data;
    }
    echo json_encode($arreglo);