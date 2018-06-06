<div class="row">


  <?php
/*
* Este archio muestra los productos en una tabla.
*/
include "facturacion/php/conection.php";
?>

<div class="col-md-12">



  <?php 
  $products = $con->query("SELECT * FROM irocket.products 
    INNER JOIN irocket.productdetails 
    ON products.idproducts=productdetails.products_idproducts
    INNER JOIN irocket.inventory
    ON products.inventory_idinventory=inventory.idinventory
    INNER JOIN irocket.inventorydetails
    ON products.inventory_idinventory=inventorydetails.inventory_idinventory 
    WHERE products.stateBD = 1 OR products.stateBD = 9
    ORDER BY products.idproducts desc");
    $datos = mysqli_fetch_array($products); ?>
    <?php
    $found = false;
    if(isset($_SESSION["cart"])){ foreach ($_SESSION["cart"] as $c) { if($c["product_id"]==$datos['idproducts']){ $found=true; break; }}}
    ?>
    <?php if($found):?>

      <form class="form-inline" method="post" onsubmit="return checkSubmit();" id="formulariocarro" action="<?php echo URL; ?>views/snippets/layout/pages/cajas/php/addtocart.php">
        <div class="form-group">
         <input type="hidden" name="codeProduct" id="codeProduct" value="">
         <input type="hidden" name="codeClient" id="codeClient" value="">
         <input type="hidden" name="priceBuy" id="priceBuy" value="">
         <input type="hidden" name="caja" id="codeClient" value="<?php echo $_GET['caja'] ?>">
         <input type="hidden" name="product_id" id="product_id" value="">
         <input type="hidden" name="precio" id="precio" value="">
         <input type="hidden" name="precio2" id="precio2" value="">
         <input type="hidden" name="precio_promotion" id="precio_promotion" value="">
         <input type="hidden" name="nameProduct" id="nameProduct" value="">
         <input type="hidden" name="codeProduct_promotion" id="codeProduct_promotion" value="">
         <input type="hidden" name="q" value="" id="cantidadcarro" style="width:70px" min="1" class="form-control" placeholder="Cantidad">
         <input type="hidden" class="btn btn-primary" style="width:100%;" ><center><span style="font-size:8pt;">
         </div>
       </form> 
     <?php else:?>
      <form class="form-inline" method="post" id="formulariocarro" onsubmit="return checkSubmit();" action="<?php echo URL; ?>views/snippets/layout/pages/cajas/php/addtocart.php">
        <div class="form-group">
          <input type="hidden" name="codeProduct" id="codeProduct" value="">
          <input type="hidden" name="priceBuy" id="priceBuy" value="">
          <input type="hidden" name="codeClient" id="codeClient" value="">
          <input type="hidden" name="caja" id="codeClient" value="<?php echo $_GET['caja'] ?>">
          <input type="hidden" name="product_id" id="product_id" value="">
          <input type="hidden" name="precio" id="precio" value="">
          <input type="hidden" name="precio2" id="precio2" value="">
          <input type="hidden" name="precio_promotion" id="precio_promotion" value="">
          <input type="hidden" name="nameProduct" id="nameProduct" value="">
          <input type="hidden" name="codeProduct_promotion" id="codeProduct_promotion" value="">
          <input type="hidden" name="q" value="" id="cantidadcarro" style="width:70px" min="1" class="form-control" placeholder="Cantidad">
          <input type="hidden" class="btn btn-primary" style="width:100%;" ><center><span style="font-size:8pt;">
          </div>
        </form> 
      <?php endif; ?>





    </div>
    <div class="col-lg-11">
     <table>
       <thead>
         <th>
          <div>
            












            <div id="display1">
              <form method="POST" onsubmit="return checkSubmit();" id="formulariocodigo" style='font-size:pt; margin-left:15px;margin-top:-15px;'>

                <small>
                  <small>
                    <?php 
                    if (isset($_SESSION["client"])) {
                     $documentoClient = $_SESSION["client"];
                   }else{
                    $documentoClient = '00000000000000000000';
                  }
                  $client = $con->query("SELECT * FROM irocket.userdetails WHERE userdetails.documentUser='$documentoClient'");
                  $rowclient = mysqli_num_rows($client);
                  $arrayclient = mysqli_fetch_array($client);
                  ?>




                  <br>
                  <input class="form-control" type="text" id="codigo" placeholder="Codigo producto" name="codigo" name="" >
                  <br><input class="" type="hidden" id="precioX" placeholder="Precio del producto" name="precioX" >


                  <span class="spanbr"></span><small><b><center><br>Cantidad</center> <span style="margin: 0em"></span></b></small>
                  <input class="btn dropdown-toggle  btn-outline" type="number" value="1" id="cantidadform" align="right" width="48" height="48" name="" ><br>

                  <center><input type="button" id="botoncodigo" name="botoncodigo" class="btn btn-primary" style="margin: 5" value="AGREGAR">
                    <input type="button" id="botonSiguiente1" name="botonSiguiente1" class="btn btn-success" style="margin: 5px" value="SIGUIENTE">  </center>




                  <input class="btn btn-warning" type="button" id="botonCliente" style="margin:px;" value="Cliente">




                </small>
              </small>
            </form>
            </div>





        <div id="display2" style="display: none;">
          <?php if ($_GET['caja'] == 'ventas') { ?>
            <form style='font-size:pt; margin-left:15px;margin-top:-15px;' onsubmit="return checkSubmit();" id="formularioPago" action="<?php echo URL; ?>cajas?caja=ventas" method='POST'>
              <input type="text" id="pago" name="pago" autofocus="" class="btn dropdown-toggle  btn-outline" placeholder="Pago" name="" >  <br>
            <center>
              <input class="btn btn-danger" id="btnAtras1" type="button" value="ATRAS" style="margin-top: 10px">
              <input class="btn btn-success" id="btnPago" type="button" value="CONTINUAR" style="margin-top: 10px">
            </center>
          </form>
          <?php }elseif ($_GET['caja'] == 'compras') { ?>
             <form style='font-size:pt; margin-left:15px;margin-top:-15px;' onsubmit="return checkSubmit();" id="formularioPago" action="<?php echo URL; ?>cajas?caja=compras" method='POST'>
              <input type="text" id="pago" name="pago" autofocus="" class="btn dropdown-toggle  btn-outline" placeholder="Pago" name="" >  <br>
            <center>
              <input class="btn btn-danger" id="btnAtras1" type="button" value="ATRAS" style="margin-top: 10px">
              <input class="btn btn-success" id="btnPago" type="button" value="CONTINUAR" style="margin-top: 10px;">
            </center>
          </form>
          <?php } ?>
          
        </div>





        <div id="display3" style="display: none;">
          <form class="form-horizontal" onsubmit="return checkSubmit();" id="formProcess" method="post" action="<?php echo URL; ?>views/snippets/layout/pages/cajas/php/process.php"  style=''>
           <input type="hidden" name="product_id" value="<?php echo $r->idproducts; ?>">
           <input type="hidden" name="precio" value="<?php echo $r->precio; ?>">
           <input type="hidden" name="precio_promotion" value="<?php echo $r->precio_promotion; ?>">
           <input type="hidden" name="q" value="1" min="1" class="form-control" placeholder="Cantidad">
           <div class="form-group">
            <div class="col-sm-5">
              <input type="hidden" name="email" required class="form-control" id="inputEmail3" placeholder="Email del cliente">
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-13">
              <input type="text" id="codigocliente" name="codigocliente" autofocus="" class="btn dropdown-toggle  btn-outline" placeholder="Documento" name="" style="width: 95%">  <br>
              <input type="hidden" id="pagoForm" name="pagoForm" autofocus="" class="btn dropdown-toggle  btn-outline" > 

              <?php 
              if (isset($_GET['caja'])) {
                if ($_GET['caja'] == 'ventas') { ?> 
                <?php 
                ?>
                <input type="hidden" id="typeBill" name="typeBill" placeholder="" value="1" >
                <?php   }elseif ($_GET['caja'] == 'compras') { ?> 
                <input type="hidden" id="typeBill" name="typeBill" placeholder="" value="2" >
                <?php   }elseif ($_GET['caja'] == 'cambios') { ?> 
                <input type="hidden" id="typeBill" name="typeBill" placeholder="" value="3" >
                <?php   }elseif ($_GET['caja'] == 'devoluciones') { ?> 
                <input type="hidden" id="typeBill" name="typeBill" placeholder="" value="4" >
                <?php   } } ?>  <br>

                <center>
                  <button type="button" id="btnAtras2"  style="width: 90%; margin-bottom: 10px; margin-top: -15px" class="btn btn-danger">ATRAS</button>
                  <button type="submit" id="processSale"  style="width: 90%; margin-bottom: 10px" class="btn btn-success">PROCESAR</button>
                <input class="btn btn-info" id="btnClient" type="hidden" value="Cliente">
                </center>
              </div>
            </div>
          </form>
        </div>














          </div>
      </th>
      <th>
       <?php 
       if (isset($_GET['caja'])) {
        if ($_GET['caja']=='ventas') {
          $total = 0;

          if (isset($_SESSION['cart'])) {
           foreach ($_SESSION["cart"] as $c) { 
            $total += $c['pu'] * $c['q'];
          }
          if ($total == 0) {
          
          }else{
            echo "<h1 style='font-size:23pt; margin:10px'><input class='btn col-lg-12' style='font-size:15pt; width=100%' id='pagoText' type='text' value='".""."'></h1>";
            echo "<h1 style='font-size:23pt; margin:10px'><input class='btn col-lg-12' style='font-size:15pt; width=100%' id='pagoX' type='text' value='".$total."'></h1>";
            echo "<h1 style='font-size:23pt; margin:10px'><input class='btn col-lg-12' style='font-size:15pt; width=100%' id='pagoTotalText' type='text' value='".""."'></h1>";
          }
        }
      }elseif ($_GET['caja']=='compras') {
        $total = 0;
        
        if (isset($_SESSION['cart'])) {
         foreach ($_SESSION["cart"] as $c) { 
          $total += $c['pc'] * $c['q'];
        }
        if ($total == 0) {
          
        }else{
            echo "<h1 style='font-size:23pt; margin:10px'><input class='btn col-lg-12' style='font-size:15pt; width=100%' id='pagoText' type='text' value='".""."'></h1>";
            echo "<h1 style='font-size:23pt; margin:10px'><input class='btn col-lg-12' style='font-size:15pt; width=100%' id='pagoX' type='text' value='".$total."'></h1>";
            echo "<h1 style='font-size:23pt; margin:10px'><input class='btn col-lg-12' style='font-size:15pt; width=100%' id='pagoTotalText' type='text' value='".""."'></h1>";
            
        }
        
      }
    }
  }

  ?>
</th>
</thead>
</table>
</div>
<div class="col-lg-12">
 <div class="table-responsive m-t-10" style="clear: both;">
  <small>
   <small>
    <small>

      <?php
/*
* Esta es la consula para obtener todos los productos de la base de datos.
*/
$products = $con->query("select * from irocket.products");
if(isset($_SESSION["cart"]) && !empty($_SESSION["cart"])):
  ?>
  <table class="table table-hover">
    <thead>
      <tr>
        <th class="text-center"><b>Nombre</b></th>
        <th class="text-right"><b>Cantidad</b></th>
        <th class="text-right"><b>Valor c/u</b></th>
        <th class="text-right"><b>Total</b></th>
        <th class="text-right"><b></b></th>
      </tr>
    </thead>
    <?php 
/*
* Apartir de aqui hacemos el recorrido de los productos obtenidos y los reflejamos en una tabla.
*/
foreach($_SESSION["cart"] as $c):
  $products = $con->query("SELECT * FROM irocket.products 
    INNER JOIN irocket.productdetails 
    ON products.idproducts=productdetails.products_idproducts
    INNER JOIN irocket.inventory
    ON products.inventory_idinventory=inventory.idinventory
    INNER JOIN irocket.inventorydetails
    ON products.inventory_idinventory=inventorydetails.inventory_idinventory 
    WHERE products.stateBD = 1 and products.idproducts=$c[product_id]
    OR products.stateBD = 9 and products.idproducts=$c[product_id]
    ORDER BY products.idproducts desc");
  $r = $products->fetch_object();
  ?>
  <?php 
  if (isset($_GET['caja'])) {
    if ($_GET['caja']=='ventas') { ?>
    <tbody>
      <tr>
        <td class="text-center"><?php echo ucfirst($c["nombreProducto"]);?></td>
        <td class="text-center"> <?php echo $c["q"]; ?> </td>
        <td class="text-center"> $<?php echo number_format($c["pu"]); ?>  </td>
        <td class="text-center"> $<?php echo number_format($c["q"]*$c["pu"]); ?> </td>
        <td class="text-center"> 
          <?php
          $found = false;
          $total = 0;
          foreach ($_SESSION["cart"] as $c) { if($c["product_id"]==$r->idproducts){ $found=true; break; }}
          $total = $r->precio*$c["q"];
          ?>
          <form method="get" action="<?php echo URL; ?>views/snippets/layout/pages/cajas/php/delfromcart.php">
            <input type="hidden" name="id" class="idproduct" value="<?php echo $c["product_id"]; ?>">
         <input type="hidden" name="caja" id="codeClient" value="<?php echo $_GET['caja'] ?>">

            <button  type="submit" class="btn btn-danger"><small>x</small></button> 
          </form>
        </td>
      </tr>
    </tbody>
    <?php }else if ($_GET['caja']=='compras') { ?>
    <tbody>
      <tr>
        <td class="text-center"><?php echo ucfirst($c["nombreProducto"]);?></td>
        <td class="text-center"> <?php echo $c["q"]; ?> </td>
        <td class="text-center"> $<?php echo number_format($c["pc"]); ?>  </td>
        <td class="text-center"> $<?php echo number_format($c["q"]*$c["pc"]); ?> </td>
        <td class="text-center"> 
          <?php
          $found = false;
          $total = 0;
          foreach ($_SESSION["cart"] as $c) { if($c["product_id"]==$r->idproducts){ $found=true; break; }}
          $total = $r->precio*$c["q"];
          ?>
          <form method="get" action="<?php echo URL; ?>views/snippets/layout/pages/cajas/php/delfromcart.php">
            <input type="hidden" name="id" class="idproduct" value="<?php echo $c["product_id"]; ?>">
         <input type="hidden" name="caja" id="codeClient" value="<?php echo $_GET['caja'] ?>">

            <button  type="submit" class="btn btn-danger"><small>x</small></button> 
          </form>
        </td>
      </tr>
    </tbody>
    <?php } } ?>





    <?php
    $found = false;
    foreach ($_SESSION["cart"] as $c) { if($c["product_id"]==$r->idproducts){ $found=true; break; }}
    ?>
    
  </td>
</tr>
<?php endforeach; ?>
</table>

<div class="col-md-12">
  <div class="pull-right text-right" style="margin-right:2em">
    <?php 
    if (isset($_GET['caja'])) { ?>
    <?php if ($_GET['caja']=='ventas') { ?>
    <p>Subtotal: $<?php
    $total = 0;
    foreach ($_SESSION["cart"] as $c) { 
      $total += $c['pu'] * $c['q'];
    }
    echo number_format($total);
    ?></p>
    
    <b>Total:</b> $<?php 
    $count = count($_SESSION['cart']);
    $total = 0;
    
    foreach ($_SESSION["cart"] as $c) { 
      $total += $c['pu'] * $c['q'];
    }
    echo number_format($total);
  }elseif ($_GET['caja']=='compras') { ?>
  <p>Subtotal: $<?php
  $total = 0;
  foreach ($_SESSION["cart"] as $c) { 
    $total += $c['pc'] * $c['q'];
  }
  echo number_format($total);
  ?></p>

  <b>Total:</b> $<?php 
  $count = count($_SESSION['cart']);
  $total = 0;

  foreach ($_SESSION["cart"] as $c) { 
    $total += $c['pc'] * $c['q'];
  }
  echo number_format($total);
}
} ?>
</div>


</div>


<?php else:?>
  <p class="alert alert-dark">Aun no ha ingresado productos.</p>
<?php endif;?>
</small>
</small>
</small>
</div>
</div>
</div>
<script src="<?php echo (URL); ?>views/plugins/bower_components/jquery/dist/jquery.min.js"></script>

<script>
$(document).ready(function () {
  $("#busqueda").focus() 
})

 $("#botonCliente").attr("type","hidden");

 
 $("#btnClient").click(function () {
  $("#codigocliente").attr("type","text");
  $("#codigocliente").focus();
})

 $("#btnPago").click(function () {
    if ($("#pago").val()!='') {
    $("#display2").css("display","none")
      $("#display3").css("display","")
      $("#pagoForm").val($("#pago").val())
      var valor = $("#pago").val()
      $("#pagoText").val(valor)
      var valortotal = $("#pagoX").val()
      var vali = parseInt(valor)-parseInt(valortotal)
      $("#pagoTotalText").val(vali)
      $("#codigocliente").focus() 
    }  
  })


 $('#formularioPago').keyup(function(e) {
  if(e.keyCode == 16) {//SHIFT
    if ($("#pago").val()!='') {
     $("#display2").css("display","none")
      $("#display3").css("display","")
      $("#pagoForm").val($("#pago").val())
      var valor = $("#pago").val()
      $("#pagoText").val(valor)
      var valortotal = $("#pagoX").val()
      var vali = parseInt(valor)-parseInt(valortotal)
      $("#pagoTotalText").val(vali)
      $("#codigocliente").focus() 
    }
  }
});

 $('body').keyup(function(e) {
  if(e.keyCode == 37) {//ALT
    
      $("#busqueda").focus() 
   
  }
});



  $('body').keyup(function(e) {
  if(e.keyCode == 39) {//ALT
    
      $("#codigo").focus() 
   
  }
});

 $('#formularioPago').keyup(function(e) {
  if(e.keyCode == 13) {//ENTER
      if ($("#pago").val()!='') {
     $("#display2").css("display","none")
      $("#display3").css("display","")
      $("#pagoForm").val($("#pago").val())
      var valor = $("#pago").val()
      $("#pagoText").val(valor)
      var valortotal = $("#pagoX").val()
      var vali = parseInt(valor)-parseInt(valortotal)
      $("#pagoTotalText").val(vali)
      $("#codigocliente").focus() 
    }
  }
});

 $('#formularioPago').keyup(function(e) {
  if(e.keyCode == 17) {//CTRL
      $("#display2").css("display","none")
      $("#display1").css("display","")
      $("#codigo").focus()
    }
});

  $('#btnAtras1').click(function() {
        $("#display2").css("display","none")
      $("#display1").css("display","")
      $("#codigo").focus()
  });

  $('#formProcess').keyup(function(e) {
  if(e.keyCode == 17) {//CTRL
      $("#display3").css("display","none")
      $("#display2").css("display","")
      $("#pago").focus()
    }
});


  $('#btnAtras2').click(function() {
      $("#display3").css("display","none")
      $("#display2").css("display","")
      $("#pago").focus()
});

 $('#formulariocodigo').keyup(function(e) {
  if(e.keyCode == 16) {//SHIFT
    var valor = $("#pagoX").val()
    if (valor >= 0) {
      $("#display1").css("display","none")
      $("#display2").css("display","")
      $("#pagoText").html("<center>0</center>")
      $("#pago").focus()
    }else{
      $("#display1").css("display","none")
      $("#display2").css("display","")
      $("#display2").css("margin-top","30px")
      $("#pagoText").html("<center>0</center>")
      $("#pago").focus()
    }
    
  }
});

 $('#botonSiguiente1').click(function() {
    var valor = $("#pagoX").val()
    if (valor >= 0) {
      $("#display1").css("display","none")
      $("#display2").css("display","")
      $("#pagoText").html("<center>0</center>")
      $("#pago").focus()
    }else{
      $("#display1").css("display","none")
      $("#display2").css("display","")
      $("#display2").css("margin-top","30px")
      $("#pagoText").html("<center>0</center>")
      $("#pago").focus()
    }
    
});

 $('#formProcess').keyup(function(e) {
  if(e.keyCode == 16) {//SHIFT
    $('#formProcess').submit()
  }
});

 $('#formulariocodigo').keyup(function(e) {
  if(e.keyCode == 32) {//SPACE
    $("#cantidadform").val("");
    $("#cantidadform").focus();
  }
});

 $('#formProcess').keyup(function(e) {
  if(e.keyCode == 32) {//SPACE
    $("#pago").focus();
  }
});

 $('body').keyup(function(e) {
  if(e.keyCode == 112) {//F1
    $("#codigo").focus();
  }
});

 $('body').keyup(function(e) {
  if(e.keyCode == 113) {//F2
    $("#cantidadform").focus();
  }
});

 $('body').keyup(function(e) {
  if(e.keyCode == 114) {//F3
    $("#pago").attr("type","text");
    $("#pago").focus();
  }
});

 $('#formulariocodigo').keyup(function(e) {
  if(e.keyCode == 13) {
    var datos = $("#formulariocodigo").serialize();
    var codigo = $("#codigo").val();
    if (codigo == 'x') {
      $("#precioX").attr("type","text");
      $("#precioX").focus();
      $(".spanbr").html("<br>")
      if ($("#precioX").val() != '') {
        var code= 'code';
        if (codigo == 'x') {
          if ($(".idproduct").val() != '') {
            var id= '1';
          }if ($(".idproduct").val() != '' && $('.idproduct').size() == 1) {
            var id= '2';
          }if ($(".idproduct").val() != '' && $('.idproduct').size() == 2) {
            var id= '3';
          }if ($(".idproduct").val() != '' && $('.idproduct').size() == 3) {
            var id= '4';
          }if ($(".idproduct").val() != '' && $('.idproduct').size() == 4) {
            var id= '5';
          }if ($(".idproduct").val() != '' && $('.idproduct').size() == 5) {
            var id= '6';
          }if ($(".idproduct").val() != '' && $('.idproduct').size() == 6) {
            var id= '7';
          }if ($(".idproduct").val() != '' && $('.idproduct').size() == 7) {
            var id= '8';
          }if ($(".idproduct").val() != '' && $('.idproduct').size() == 8) {
            var id= '9';
          }
        }
        var codeProm= 'xp';
        var precio= '1000';
        var precio_compra= '1';
        var precio_prom= '1';
        var precioProm= '1';
        var cantidad= '1';
        var name= 'producto';
        $("#codeProduct").val(code);
        $("#precio").val($("#precioX").val());
        $("#precio2").val(precio_compra);
        $("#codeClient").val($("#codigocliente").val());
        $("#precio_promotion").val(precioProm);
        $("#nameProduct").val(name);
        $("#codeProduct_promotion").val(codeProm);
        $("#cantidadcarro").val($("#cantidadform").val());
        $("#product_id").val(id);
        if ($("#product_id").val() == '') {

        }else{
          $("#formulariocarro").submit();
        }
      }
    }

    $.ajax({
      type: "post",
      dataType: 'json',
      data: {"codigo" : codigo},
      url: URL_APP+"/irocket/controllers/ajax/ajax_factura_venta.php",
      success:function (data) {
       var code= data.data[0].codeProduct;
       var id= data.data[0].idproducts;
       var codeProm= data.data[0].codeProduct_promotion;
       var precio= data.data[0].precio;
       var precio_compra= data.data[0].price_buy;
       var precio_prom= data.data[0].price_buy;
       var precioProm= data.data[0].precio_promotion;
       var cantidad= data.data[0].quantityProduct;
       var name= data.data[0].nameProduct;
       $("#codeProduct").val(code);
       $("#precio").val(precio);
       $("#precio2").val(precio_compra);
       $("#codeClient").val($("#codigocliente").val());
       $("#precio_promotion").val(precioProm);
       $("#nameProduct").val(name);
       $("#codeProduct_promotion").val(codeProm);
       $("#cantidadcarro").val($("#cantidadform").val());
       $("#product_id").val(id);
       if ($("#product_id").val() == '') {

       }else{
        $("#formulariocarro").submit();
      }
    },error:function () {
      producto_promocion();
    }
  });  
  }
});

 function producto_promocion() {
  var datos = $("#formulariocodigo").serialize();
  var codigo = $("#codigo").val();

  $.ajax({
    type: "post",
    dataType: 'json',
    data: {"codigo" : codigo},
    url: URL_APP+"/irocket/controllers/ajax/ajax_factura_venta_prom.php",
    success:function (data) {
     var code= data.data[0].codeProduct;
     var id= data.data[0].idproducts;
     var codeProm= data.data[0].codeProduct_promotion;
     var precio= data.data[0].precio_promotion;
     var precio_compra= data.data[0].price_buy;
     var precio_prom= data.data[0].price_buy;
     var precioProm= data.data[0].precio_promotion;
     var cantidad= data.data[0].quantityProduct;
     var name= data.data[0].nameProduct;
     $("#codeProduct").val(code);
     $("#precio").val(precio);
     $("#precio2").val(precio_compra);
     $("#codeClient").val($("#codigocliente").val());
     $("#precio_promotion").val(precioProm);
     $("#nameProduct").val(name);
     $("#codeProduct_promotion").val(codeProm);
     $("#cantidadcarro").val($("#cantidadform").val());
     $("#product_id").val(id);
     if ($("#product_id").val() == '') {

     }else{
      $("#formulariocarro").submit();
    }
  },error:function () {
    producto_promocion();
  }
});
}

$("#botoncodigo").click(function() {
  var datos = $("#formulariocodigo").serialize();
  var codigo = $("#codigo").val();

  $.ajax({
    type: "post",
    dataType: 'json',
    data: {"codigo" : codigo},
    url: URL_APP+"/irocket/controllers/ajax/ajax_factura_venta.php",
    success:function (data) {
     var code= data.data[0].codeProduct;
     var id= data.data[0].idproducts;
     var codeProm= data.data[0].codeProduct_promotion;
     var precio= data.data[0].precio;
     var precio_compra= data.data[0].price_buy;
     var precio_prom= data.data[0].price_buy;
     var precioProm= data.data[0].precio_promotion;
     var cantidad= data.data[0].quantityProduct;
     var name= data.data[0].nameProduct;

     $("#codeProduct").val(code);
     $("#codeClient").val($("#codigocliente").val());
     $("#precio").val(precio);
     $("#precio2").val(precio_compra);
     $("#precio3").val(precio_compra);
     $("#precio_promotion").val(precioProm);
     $("#nameProduct").val(name);
     $("#codeProduct_promotion").val(codeProm);
     $("#cantidadcarro").val($("#cantidadform").val());
     $("#product_id").val(id);

     if ($("#product_id").val() == '') {

     }else{
      $("#formulariocarro").submit();
    }
  }
});         




});




</script>



                         

<script>
    var statSend = false;
function checkSubmit() {
    if (!statSend) {
        statSend = true;
        return true;
    } else {
        return false;
    }
}
</script>