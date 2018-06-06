<?php
/*
* Este archio muestra los productos en una tabla.
*/
session_start();
include '../../../../../../config.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="<?php echo URL; ?>views/snippets/layout/pages/cajas/bootstrap.min.css">
</head>
<body>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h1>Productos</h1>
			<a href="./cart.php" class="btn btn-warning">Ver Carrito</a>
			<br><br>
<?php
/*
* Esta es la consula para obtener todos los productos de la base de datos.
*/
$products = $con->query("select * from irocket.products");
?>
<table class="table table-bordered">
<thead>
	<th>Producto</th>
	<th>Precio</th>
	<th></th>
</thead>
<?php 
/*
* Apartir de aqui hacemos el recorrido de los productos obtenidos y los reflejamos en una tabla.
*/
while($r=$products->fetch_object()):?>
<tr>
	<td><?php echo $r->codeProduct;?></td>
	<td>$ <?php echo $r->precio; ?></td>
	<td style="width:260px;">
	<?php
	$found = false;

	if(isset($_SESSION["cart"])){ foreach ($_SESSION["cart"] as $c) { if($c["product_id"]==$r->idproducts){ $found=true; break; }}}
	?>
	<?php if($found):?>
		<a href="cart.php" class="btn btn-info">Agregado</a>
	<?php else:?>
	<form class="form-inline" method="post" action="<?php echo URL; ?>views/snippets/layout/pages/cajas/php/addtocart.php">
	<input type="hidden" name="product_id" value="<?php echo $r->idproducts; ?>">
	  <div class="form-group">
	    <input type="number" name="q" value="1" style="width:100px;" min="1" class="form-control" placeholder="Cantidad">
	  </div>
	  <button type="submit" class="btn btn-primary">Agregar al carrito</button>
	</form>	
	<?php endif; ?>
	</td>
</tr>
<?php endwhile; ?>
</table>
<br><br><hr>

		</div>
	</div>
</div>
</body>
</html>
<?php include "cart.php"; ?>