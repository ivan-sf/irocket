<?php 
session_start();
if(isset($_SESSION['UserNew']) AND isset($_SESSION['cash']) OR isset($_SESSION['adminUserNew']) AND isset($_SESSION['cash'])){
    $modelUser = new models\User();
    $modelInventory = new models\Inventory();
    $con = new models\Conexion();
    $array = $modelUser->inner();
    $sql = "";
    $arrayInventory = $modelInventory->array();
    $rowInventory = $modelInventory->row();

    $modelInventory = new models\Notifications();
    $con = new models\Conexion();
    $arrayInventory = $modelInventory->array();
}elseif(isset($_SESSION['UserNew']) AND isset($_SESSION['cash']) OR isset($_SESSION['adminUserNew']) AND !isset($_SESSION['cash'])){
    header("location:" . URL . "login");
}else{
    header("location:" . URL . "login");
}

require "views/snippets/templates/cash/template.php";
?>

<body>

    <?php
        include "views/snippets/dependencies/cash/includes/facturas/index.php";
    ?>

</body>
</html>
