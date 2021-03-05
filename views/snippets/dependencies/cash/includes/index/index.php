
<div class="container-fluid">
<?php 
if(isset($_GET['pago'])){
  if($_GET['pago']==0){
    echo "RECUERDE QUE PARA PROCESAR SU FACTURA DEBE REALIZAR EL PAGO.";
  }
}
?>
	<div class="row">
		<div class="col-md-8">
      <div class="row md-12">
        <div class="col-md-12">
        <?php
  include "includes/facturacion/php/conection.php";
  if ($_GET['caja'] == 'ventas') {
    include 'includes/lista/completa.php';
  } else{
    include 'includes/lista/completaCompras.php';
  }
  ?>

        </div>
        <div class="col-md-6">
        
          <?php //include "includes/lista_de_codigo.php"; ?>
        </div>
      </div>
      <section id="tabla_resultado">
        <!-- AQUI SE DESPLEGARA NUESTRA TABLA DE CONSULTA -->
      </section>
		</div>
		<div class="col-md-4">

      <?php
      
      $facturasSinProcesar = $con->query("SELECT * FROM bills WHERE stateBill=2");
      $arrayfacturasSinProcesar = mysqli_fetch_array($facturasSinProcesar); 
      $rowfacturasSinProcesar = mysqli_num_rows($facturasSinProcesar); 
      if ($_GET['caja'] == 'ventas') {
        include "includes/lista_clientes.php";
        include "includes/procesar.php";
      }elseif ($_GET['caja'] == 'compras') {
        include "includes/lista_proveedores.php";
        include "includes/procesarCompras.php";
      }
      

      if($rowfacturasSinProcesar>=1){ ?>
      <section id="tabla_cliente">
        <!-- AQUI SE DESPLEGARA NUESTRA TABLA DE CONSULTA -->
      </section>
      <section id="tabla_carrito">
        <!-- AQUI SE DESPLEGARA NUESTRA TABLA DE CONSULTA -->
      </section>
      <?php
         include "includes/lista_de_factura.php";
      }else{
        echo "Factura Vacia";
      }
      ?>

		</div>
	</div>
</div>
  
   <script>
   $('body').keyup(function(e) {
    
    if (e.keyCode == 17 || e.keyCode == 119) {
      $("#busqueda").blur()
      $("#busquedaFormu").css("display","none")
      $("#procesarCompra").css("display","")
      $("#procesarCompraI").focus()
    }
    if (e.keyCode == 16 || e.keyCode == 118) {
      $("#busqueda").blur()
      $("#busquedaFormu").css("display","none")
      $("#procesarPago").css("display","")
      $("#pagoCompra").focus()
    }
    if (e.keyCode == 40) {
      $("#busqueda").blur()
      $("#busquedaCodigo").blur()
      $("#cantidadP").focus()
    }
    if(e.keyCode == 37) {
      $("#busqueda").css("display","")
      $("#busqueda").focus()
      $("#busquedaCodigo").css("display","")
      //$("#codigocliente").attr("class","display:''");
      //$("#codigocliente").focus();
    }if(e.keyCode == 39) {
      // $("#procesar").css("display","")
      //$("#codigocliente").attr("class","display:''");
      //$("#codigocliente").focus();
    }if(e.keyCode == 113) {
      $("#FormularioCliente").css("display","")
      $("#busquedaCliente").focus()
      //$("#codigocliente").attr("class","display:''");
      //$("#codigocliente").focus();
    }
    $('#formularioBuscarCodigo').keyup(function(e) {
    if (e.keyCode == 13) {
      $("#busqueda").blur()
      $("#busquedaCodigo").blur()
      $("#cantidadP").focus()
    }
        
    });

    $('#formularioBusquedaProducto').keyup(function(e) {
        if (e.keyCode == 13) {
          $("#busqueda").blur()
          $("#busquedaCodigo").blur()
          $("#cantidadP").focus()
        }
    });
    });

  
    

    </script>