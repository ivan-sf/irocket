<?php
$model = new models\Bills();
$con = new models\Conexion();
$idGet = $_GET['id'];
$array = $model->set("idbill",$idGet);
$data = $model->view();
$datos = mysqli_fetch_array($data);


$set = $model->set("idbill",$idGet);
$arrayBillDetail = $model->viewDetails();
$arrayBillDetail1 = $model->viewDetails();
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
$docClient = $datos['cliente'];
$setUser = $modelUser->set("docuser",$docClient);
$arrayUser = $modelUser->viewClient();
$datosUser = mysqli_fetch_array($arrayUser);


?>

<?php 
if (isset($_GET['detalles'])) {
    include "factura.php";
}elseif (isset($_GET['cambio'])) {
    include "cambio.php";
}elseif (isset($_GET['devolucion'])) {
    include "devolucion.php";
}elseif (isset($_GET['saldo'])) {
    include "saldo.php";
}elseif (isset($_GET['cancelar'])) {
    include "cancelar.php";
}
 ?>
