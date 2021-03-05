<script src="views/plugins/bower_components/jquery/dist/jquery.min.js"></script>


<?php 
if(isset($_GET['cliente'])){
?>
<div id="FormularioCliente" style="display:">
<?php

    ?>
    <form method="get" style="padding: 12px 20px;" class="" style="display: block;" id="formularioBusquedaProducto" action="cajas?caja=compras">
        
        <input class="form-control" value="compras" type="hidden" autofocus name="caja" id="caja" placeholder="Buscar cliente">
        <input class="form-control" type="text" autofocus name="cliente" id="busquedaCliente" placeholder="Buscar cliente">

    </form>

<?php
$cliente = $_GET['cliente'];
if($cliente != "" && $cliente != 1){

$sql = $con->query("SELECT * FROM users 
INNER JOIN userdetails 
ON users.idusers=userdetails.users_idusers
WHERE 
users.stateBD = 1 AND userdetails.tipoProveedor=1 AND users.userName LIKE  '%$cliente%' OR
users.stateBD = 1 AND userdetails.tipoProveedor=1 AND userdetails.nameUser LIKE  '%$cliente%' OR
users.stateBD = 1 AND userdetails.tipoProveedor=1 AND userdetails.lastnameUser LIKE  '%$cliente%'  OR
users.stateBD = 1 AND userdetails.tipoProveedor=1 AND userdetails.documentUser LIKE  '%$cliente%' 
ORDER BY users.idusers desc");
$row1 = mysqli_num_rows($sql);
?>

<table class="table stylish-table">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Documento</th>
            <th>Opcion</th>
        </tr>
    </thead>
</table>

<?php
while($array = mysqli_fetch_array($sql)){ ?>
<table class="table stylish-table">
    <tbody>
        <td><?php echo $array['nameUser'] ?></td>
        <td><?php echo $array['lastnameUser'] ?></td>
        <td><?php echo $array['documentUser'] ?></td>
        <td>
            <form method="POST" action="views/snippets/layout/pages/cajas/php/addtoClienteCompra.php">
            <input type="hidden" name="SESSION" value="<?php 
                if(isset($_SESSION['adminUserNew'])){
                  echo $_SESSION['adminUserNew'];
                }else{
                  echo $_SESSION['administrador'];
                }
               ?>">
                <input type="hidden" value="<?php echo $array['nameUser']?>" name="nameUser">
                <input type="hidden" value="<?php echo $array['lastnameUser']?>" name="lastnameUser">
                <input type="hidden" value="<?php echo $array['documentUser']?>" name="documentUser">
                <input type="hidden" value="<?php echo $array['idusers']?>" name="idusers">
                <button class="btn waves-effect waves-light btn-rounded btn-outline-success">
                    &#10004	
                </button>
            </form>
            
        </td>
    </tbody>
</table>
    
<?php
}
}else{
    if(isset($_SESSION['adminUserNew'])){
        $iduser = $_SESSION['adminUserNew'];
    }else{
        $iduser = $_SESSION['administrador'];
    }
    $sql = $con->query("SELECT * FROM `bills` WHERE stateBill=2 AND users_idusers=$iduser AND typeBill=4");
    $array = mysqli_fetch_array($sql);
    $row = mysqli_num_rows($sql);
    $idFactura = $array['idbills'];
    
    $sql = $con->query("UPDATE `bills` SET `idCliente` = '', `cliente` = 'N/A', `documentUser` = 'N/A' WHERE `bills`.`idbills` = $idFactura;");
    print "<script>window.location='". URL . "cajas?caja=compras';</script>";

}
?>
</div>
<?php
}else{
?>
    <div id="FormularioCliente" style="display:none">
<?php

    ?>
    <form method="get" style="padding: 12px 20px;" class="" style="display: block;" id="formularioBusquedaProducto" action="cajas?caja=compras">

    <input class="form-control" type="text" autofocus name="cliente" id="busquedaCliente" placeholder="Buscar cliente">
    <input class="form-control" value="compras" type="hidden" autofocus name="caja" id="caja" placeholder="Buscar cliente">

    </form>


</div>
<?php
}
?>
