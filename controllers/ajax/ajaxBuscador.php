<?php namespace models\ajax;
include 'conexion.php';

$inpBusq = $_POST['inpBusq'];
$palabras = explode(" ", $inpBusq);
  $contadorPala = count($palabras);
  if ($contadorPala == 1) {
    $query = "SELECT * FROM products 
        INNER JOIN productdetails 
        ON products.idproducts=productdetails.products_idproducts
        WHERE 
        products.stateBD = 1 AND products.codeProduct = '$palabras[0]'OR
        products.stateBD = 1 AND products.codeProduct_promotion = '$palabras[0]'OR
        products.stateBD = 1 AND products.codeProduct_promotion2 = '$palabras[0]'OR
        products.stateBD = 1 AND products.codeProduct_4 = '$palabras[0]'OR
        products.stateBD = 1 AND products.codeProduct_5 = '$palabras[0]'OR
        products.stateBD = 1 AND products.codeProduct_6 = '$palabras[0]'OR
        products.stateBD = 1 AND products.codeProduct_7 = '$palabras[0]'OR
        products.stateBD = 1 AND products.codeProduct_8 = '$palabras[0]'OR
        products.stateBD = 1 AND products.codeProduct_9 = '$palabras[0]'OR
        products.stateBD = 1 AND products.codeProduct_10 = '$palabras[0]' 
        LIMIT 1";
  } elseif ($contadorPala == 2) {
    $query = "SELECT * FROM products 
        INNER JOIN productdetails 
        ON products.idproducts=productdetails.products_idproducts
        WHERE 
        products.stateBD = 1 AND products.codeProduct LIKE '%$palabras[0]%'OR
        products.stateBD = 1 AND products.codeProduct_promotion LIKE '%$palabras[0]%'OR
        products.stateBD = 1 AND products.codeProduct_promotion2 LIKE '%$palabras[0]%'OR
        products.stateBD = 1 AND products.codeProduct_4 LIKE '%$palabras[0]%'OR 
        products.stateBD = 1 AND products.codeProduct_5 LIKE '%$palabras[0]%'OR
        products.stateBD = 1 AND products.codeProduct_6 LIKE '%$palabras[0]%'OR
        products.stateBD = 1 AND products.codeProduct_7 LIKE '%$palabras[0]%'OR
        products.stateBD = 1 AND products.codeProduct_8 LIKE '%$palabras[0]%'OR
        products.stateBD = 1 AND products.codeProduct_9 LIKE '%$palabras[0]%'OR
        products.stateBD = 1 AND products.codeProduct_10 LIKE '%$palabras[0]%' OR
        products.stateBD = 1 AND productdetails.nameProduct LIKE '%$palabras[0]%'AND
        products.stateBD = 1 AND productdetails.nameProduct LIKE '%$palabras[1]%'
        LIMIT 20";
  } elseif ($contadorPala == 3) {
    $query = "SELECT * FROM products 
  INNER JOIN productdetails 
  ON products.idproducts=productdetails.products_idproducts
  WHERE 
  products.stateBD = 1 AND products.codeProduct LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_promotion LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_promotion2 LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_4 LIKE '%$palabras[0]%'OR 
  products.stateBD = 1 AND products.codeProduct_5 LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_6 LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_7 LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_8 LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_9 LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_10 LIKE '%$palabras[0]%' OR
  products.stateBD = 1 AND productdetails.nameProduct LIKE '%$palabras[0]%'AND
  products.stateBD = 1 AND productdetails.nameProduct LIKE '%$palabras[1]%'AND
  products.stateBD = 1 AND productdetails.nameProduct LIKE '%$palabras[2]%'
  LIMIT 20";
  } elseif ($contadorPala == 4) {
    $query = "SELECT * FROM products 
  INNER JOIN productdetails 
  ON products.idproducts=productdetails.products_idproducts
  WHERE 
  products.stateBD = 1 AND products.codeProduct LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_promotion LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_promotion2 LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_4 LIKE '%$palabras[0]%'OR 
  products.stateBD = 1 AND products.codeProduct_5 LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_6 LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_7 LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_8 LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_9 LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_10 LIKE '%$palabras[0]%' OR
  products.stateBD = 1 AND productdetails.nameProduct LIKE '%$palabras[0]%'AND
  products.stateBD = 1 AND productdetails.nameProduct LIKE '%$palabras[1]%'AND
  products.stateBD = 1 AND productdetails.nameProduct LIKE '%$palabras[2]%'AND
  products.stateBD = 1 AND productdetails.nameProduct LIKE '%$palabras[3]%'
  LIMIT 20";
  } elseif ($contadorPala == 5) {
    $query = "SELECT * FROM products 
  INNER JOIN productdetails 
  ON products.idproducts=productdetails.products_idproducts
  WHERE 
  products.stateBD = 1 AND products.codeProduct LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_promotion LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_promotion2 LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_4 LIKE '%$palabras[0]%'OR 
  products.stateBD = 1 AND products.codeProduct_5 LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_6 LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_7 LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_8 LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_9 LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_10 LIKE '%$palabras[0]%' OR
  products.stateBD = 1 AND productdetails.nameProduct LIKE '%$palabras[0]%'AND
  products.stateBD = 1 AND productdetails.nameProduct LIKE '%$palabras[1]%'AND
  products.stateBD = 1 AND productdetails.nameProduct LIKE '%$palabras[2]%'AND
  products.stateBD = 1 AND productdetails.nameProduct LIKE '%$palabras[3]%'AND
  products.stateBD = 1 AND productdetails.nameProduct LIKE '%$palabras[4]%'
  LIMIT 20";
  } elseif ($contadorPala == 6) {
    $query = "SELECT * FROM products 
  INNER JOIN productdetails 
  ON products.idproducts=productdetails.products_idproducts
  WHERE 
  products.stateBD = 1 AND products.codeProduct LIKE '%$palabras[0]%'OR 
  products.stateBD = 1 AND products.codeProduct LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_promotion LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_promotion2 LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_4 LIKE '%$palabras[0]%'OR 
  products.stateBD = 1 AND products.codeProduct_5 LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_6 LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_7 LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_8 LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_9 LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_10 LIKE '%$palabras[0]%' OR
  products.stateBD = 1 AND productdetails.nameProduct LIKE '%$palabras[0]%'AND
  products.stateBD = 1 AND productdetails.nameProduct LIKE '%$palabras[1]%'AND
  products.stateBD = 1 AND productdetails.nameProduct LIKE '%$palabras[2]%'AND
  products.stateBD = 1 AND productdetails.nameProduct LIKE '%$palabras[3]%'AND
  products.stateBD = 1 AND productdetails.nameProduct LIKE '%$palabras[4]%'AND
  products.stateBD = 1 AND productdetails.nameProduct LIKE '%$palabras[5]%'
  LIMIT 20";
  } elseif ($contadorPala == 7) {
    $query = "SELECT * FROM products 
  INNER JOIN productdetails 
  ON products.idproducts=productdetails.products_idproducts
  WHERE 
  products.stateBD = 1 AND products.codeProduct LIKE '%$palabras[0]%'OR 
  products.stateBD = 1 AND products.codeProduct LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_promotion LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_promotion2 LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_4 LIKE '%$palabras[0]%'OR 
  products.stateBD = 1 AND products.codeProduct_5 LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_6 LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_7 LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_8 LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_9 LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_10 LIKE '%$palabras[0]%' OR
  products.stateBD = 1 AND productdetails.nameProduct LIKE '%$palabras[0]%'AND
  products.stateBD = 1 AND productdetails.nameProduct LIKE '%$palabras[1]%'AND
  products.stateBD = 1 AND productdetails.nameProduct LIKE '%$palabras[2]%'AND
  products.stateBD = 1 AND productdetails.nameProduct LIKE '%$palabras[3]%'AND
  products.stateBD = 1 AND productdetails.nameProduct LIKE '%$palabras[4]%'AND
  products.stateBD = 1 AND productdetails.nameProduct LIKE '%$palabras[5]%'AND
  products.stateBD = 1 AND productdetails.nameProduct LIKE '%$palabras[6]%'
  LIMIT 20";
  } elseif ($contadorPala == 8) {
    $query = "SELECT * FROM products 
  INNER JOIN productdetails 
  ON products.idproducts=productdetails.products_idproducts
  WHERE 
  products.stateBD = 1 AND products.codeProduct LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_promotion LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_promotion2 LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_4 LIKE '%$palabras[0]%'OR 
  products.stateBD = 1 AND products.codeProduct_5 LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_6 LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_7 LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_8 LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_9 LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_10 LIKE '%$palabras[0]%' OR
  products.stateBD = 1 AND productdetails.nameProduct LIKE '%$palabras[0]%'AND
  products.stateBD = 1 AND productdetails.nameProduct LIKE '%$palabras[1]%'AND
  products.stateBD = 1 AND productdetails.nameProduct LIKE '%$palabras[2]%'AND
  products.stateBD = 1 AND productdetails.nameProduct LIKE '%$palabras[3]%'AND
  products.stateBD = 1 AND productdetails.nameProduct LIKE '%$palabras[4]%'AND
  products.stateBD = 1 AND productdetails.nameProduct LIKE '%$palabras[5]%'AND
  products.stateBD = 1 AND productdetails.nameProduct LIKE '%$palabras[6]%'AND
  products.stateBD = 1 AND productdetails.nameProduct LIKE '%$palabras[7]%'
  LIMIT 20";
  } elseif ($contadorPala == 9) {
    $query = "SELECT * FROM products 
  INNER JOIN productdetails 
  ON products.idproducts=productdetails.products_idproducts
  WHERE 
  products.stateBD = 1 AND products.codeProduct LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_promotion LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_promotion2 LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_4 LIKE '%$palabras[0]%'OR 
  products.stateBD = 1 AND products.codeProduct_5 LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_6 LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_7 LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_8 LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_9 LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_10 LIKE '%$palabras[0]%' OR
  products.stateBD = 1 AND productdetails.nameProduct LIKE '%$palabras[0]%'AND
  products.stateBD = 1 AND productdetails.nameProduct LIKE '%$palabras[1]%'AND
  products.stateBD = 1 AND productdetails.nameProduct LIKE '%$palabras[2]%'AND
  products.stateBD = 1 AND productdetails.nameProduct LIKE '%$palabras[3]%'AND
  products.stateBD = 1 AND productdetails.nameProduct LIKE '%$palabras[4]%'AND
  products.stateBD = 1 AND productdetails.nameProduct LIKE '%$palabras[5]%'AND
  products.stateBD = 1 AND productdetails.nameProduct LIKE '%$palabras[6]%'AND
  products.stateBD = 1 AND productdetails.nameProduct LIKE '%$palabras[7]%'AND
  products.stateBD = 1 AND productdetails.nameProduct LIKE '%$palabras[8]%'
  LIMIT 20";
  } elseif ($contadorPala == 10) {
    $query = "SELECT * FROM products 
  INNER JOIN productdetails 
  ON products.idproducts=productdetails.products_idproducts
  WHERE 
  products.stateBD = 1 AND products.codeProduct LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_promotion LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_promotion2 LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_4 LIKE '%$palabras[0]%'OR 
  products.stateBD = 1 AND products.codeProduct_5 LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_6 LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_7 LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_8 LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_9 LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_10 LIKE '%$palabras[0]%' OR
  products.stateBD = 1 AND productdetails.nameProduct LIKE '%$palabras[0]%'AND
  products.stateBD = 1 AND productdetails.nameProduct LIKE '%$palabras[1]%'AND
  products.stateBD = 1 AND productdetails.nameProduct LIKE '%$palabras[2]%'AND
  products.stateBD = 1 AND productdetails.nameProduct LIKE '%$palabras[3]%'AND
  products.stateBD = 1 AND productdetails.nameProduct LIKE '%$palabras[4]%'AND
  products.stateBD = 1 AND productdetails.nameProduct LIKE '%$palabras[5]%'AND
  products.stateBD = 1 AND productdetails.nameProduct LIKE '%$palabras[6]%'AND
  products.stateBD = 1 AND productdetails.nameProduct LIKE '%$palabras[7]%'AND
  products.stateBD = 1 AND productdetails.nameProduct LIKE '%$palabras[8]%'
  products.stateBD = 1 AND productdetails.nameProduct LIKE '%$palabras[9]%'
  LIMIT 0";
  } elseif ($contadorPala > 10) {
    $query = "SELECT * FROM products 
  INNER JOIN productdetails 
  ON products.idproducts=productdetails.products_idproducts
  WHERE 
  products.stateBD = 1 AND products.codeProduct LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_promotion LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_promotion2 LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_4 LIKE '%$palabras[0]%'OR 
  products.stateBD = 1 AND products.codeProduct_5 LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_6 LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_7 LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_8 LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_9 LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_10 LIKE '%$palabras[0]%' OR
  products.stateBD = 1 AND productdetails.nameProduct LIKE '%$q%'
  LIMIT 0";
  }

$result = mysqli_query($conexion, $query);
while($row=mysqli_fetch_array($result)){
    $json[]=array(
        'idproducts'=>$row['idproducts'],
        'nombre'=>$row['nameProduct'],
        'codigo'=>$row['codeProduct'],
        'iva'=>$row['iva'],
        'totalEx'=>$row['totalItem'],
        'precio1'=>$row['precio'],
        'precio2'=>$row['precio_promotion2'],
        'precio3'=>$row['precio3']
    );
}

if($result){
    $jsonstring=json_encode($json);
    echo $jsonstring;
}else{
    echo "No se encontraron Datos";
}