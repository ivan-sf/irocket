<?php
if(isset($_SESSION['adminUserNew'])){
  $iduser= $_SESSION['adminUserNew'];
}else{
  $iduser= $_SESSION['administrador'];
}
$sql = $con->query("SELECT * FROM bills
WHERE users_idusers = $iduser AND stateBill=2  AND typeBill=4");
$row1 = mysqli_num_rows($sql);
$arrayBill = mysqli_fetch_array($sql);
if($row1>=1){
    $total=$arrayBill['total'];
    $pago=$arrayBill['pago'];
    $impuesto=$arrayBill['impuesto'];
    $saldo=$arrayBill['saldo'];
    $cliente=$arrayBill['cliente'];    
}

?>

<div class="row">
<div class="col-lg-6">
        <div class="card bg-danger text-white">
            <div class="card-body">
                <div class="d-flex">
                    <div class="stats">
                        <?php
                        if($row1>=1){
                        ?>
                        <h1 class="text-white"><?php echo number_format($total); ?></h1>
                            <h3 class="text-white">TOTAL COMPRA</h3>
                        <?php
                        }else{
                        ?>
                        <h1 class="text-white">0</h1>
                            <h3 class="text-white">TOTAL COMPRA</h3>
                        <?php
                        } ?>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card bg-danger text-white">
            <div class="card-body">
                <div class="d-flex">
                    <div class="stats">
                        <?php
                        if($row1>=1){
                        ?>
                        <h1 class="text-white"><?php echo number_format($pago); ?></h1>
                            <h3 class="text-white">TOTAL PAGO</h3>
                        <?php
                        }else{
                        ?>
                        <h1 class="text-white">0</h1>
                            <h3 class="text-white">TOTAL PAGO</h3>
                        <?php
                        } ?>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card bg-danger text-white">
            <div class="card-body">
                <div class="d-flex">
                    <div class="stats">
                        <?php
                        if($row1>=1){
                        ?>
                        <h3 class="text-white"><?php echo number_format($impuesto); ?></h3>
                            <h5 class="text-white">TOTAL IMPUESTO</h5>
                        <?php
                        }else{
                        ?>
                        <h3 class="text-white">0</h3>
                            <h5 class="text-white">TOTAL IMPUESTO</h5>
                        <?php
                        } ?>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card bg-danger text-white">
            <div class="card-body">
                <div class="d-flex">
                    <div class="stats">
                        <?php
                        if($row1>=1){
                        ?>
                        <h3 class="text-white"><?php echo number_format($saldo); ?></h3>
                            <h5 class="text-white">TOTAL SALDO/CAMBIO</h5>
                        <?php
                        }else{
                        ?>
                        <h3 class="text-white">0</h3>
                            <h5 class="text-white">TOTAL SALDO/CAMBIO</h5>
                        <?php
                        } ?>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
if(isset($_SESSION['adminUserNew'])){
  $iduser= $_SESSION['adminUserNew'];
}else{
  $iduser= $_SESSION['administrador'];
}
$sql = $con->query("SELECT * FROM users 
INNER JOIN userdetails 
ON users.idusers=userdetails.users_idusers
WHERE users.stateBD = 1 AND users.idusers = $iduser");
$row1 = mysqli_num_rows($sql);
$array = mysqli_fetch_array($sql);
$nombreVendedor = $array['nameUser'] . " " . $array['lastnameUser'];
?>

<div class="col-lg-6">
<div class="card bg-info text-white">
        <div class="card-body">
            <div class="d-flex">
                <div class="stats">
                    <h4 class="text-white"><?php echo ucwords($nombreVendedor); ?></h4>
                </div>
            </div>
        </div>
    </div>
    
</div>
<div class="col-lg-6">
<div class="card bg-info text-white">
        <div class="card-body">
            <div class="d-flex">
                <div class="stats">
                <?php
                if($row1>=1 && isset($cliente)){
                ?>
                    <h4 class="text-white"><?php echo ucwords($cliente); ?></h4>
                    <?php
                }else{
                ?>
                    <h4 class="text-white">Presione F2</h4>
                <?php
                }
                ?>
                
                </div>
            </div>
        </div>
    </div>
    </div>
</div>