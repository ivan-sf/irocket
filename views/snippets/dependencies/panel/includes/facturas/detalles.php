<?php
$model = new models\Bills();
$con = new models\Conexion();
$idGet = $_GET['id'];
if (isset($_GET['fecha'])) {
    $fecha = $_GET['fecha'];
    $array = $model->set("fecha",$fecha);
}
if (isset($_GET['devolucion'])) {
    $idGetDet = $_GET['devolucion'];
}
$array = $model->set("idbill",$idGet);
$data = $model->view();
$datos = mysqli_fetch_array($data);


$set = $model->set("idbill",$idGet);
$arrayBillDetail = $model->viewDetails();
$arrayBillDetailDevolucion = $model->arrayBillDetailDevolucion();
$arrayBillDetail1 = $model->viewDetails();
$arrayBillDetail2 = $model->viewDetailsDayV();
$arrayBillDetail3 = $model->viewDetailsDayC();
$arrayBillDetail4 = $model->viewDetailsDayVV();
if (isset($_GET['cambio'])) {
    $idGet = $_GET['cambio'];
    $set = $model->set("idbill",$idGet);
    $arrayBillDetail2 = $model->viewDetails2();
}elseif (isset($_GET['devolucion'])) {
    $idGet = $_GET['devolucion'];
    $set = $model->set("idbill",$idGet);
    $arrayBillDetail2 = $model->viewDetails2();
}


$modelCompany = new models\Company();
$setCompany = $modelCompany->set("idcompany",1);
$arrayCompany = $modelCompany->view();
$datosCompany = mysqli_fetch_array($arrayCompany);

$modelUser = new models\User();
$docClient = $datos['idCliente'];
if($docClient==''){
    $docClient=6668;
}
$setUser = $modelUser->set("docuser",$docClient);
$arrayUser = $modelUser->viewClient();
$datosUser = mysqli_fetch_array($arrayUser);

$modelContabilidad = new models\Contabilidad();
$arrayUsers = $modelContabilidad->arrayUsers();

?>

<?php 
if (isset($_GET['detalles'])) {
    include "factura.php";
}elseif (isset($_GET['cambio'])) {
    include "cambio.php";
}if (isset($_GET['dia'])) {
    if ($_GET['dia']=='venta') {
        include "factura2.php";
    }elseif ($_GET['dia']=='compra') {
        include "factura3.php";
    }
} elseif (isset($_GET['devolucion'])) {
    include "devolucion.php";
}elseif (isset($_GET['editar'])) {
    include "editar.php";
}elseif (isset($_GET['cancelar'])) {
    include "cancelar.php";
}
 ?>
